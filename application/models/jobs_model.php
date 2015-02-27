<?php

class Jobs_model extends CI_Model {

    protected $table_name = "";

    public function __construct() {
        $this->table_name = "jobs";
        parent::__construct();
    }

    public function jobs_get($id = 0) {
        if($id>0){
            $this->db->where('id',$id);
        }
        $r = $this->db->get($this->table_name);
        if ($r->num_rows() > 0) {
            
            if($id>0){
                return $r->row_array();
            }else{
                return $r->result_array();
            }
        }
        return false;
    }   
    public function jobs_add($data)
    {
        foreach ($data as $key => $val){
            $data[$key] = $this->db->escape_str($val);
        }
        $this->db->insert($this->table_name,$data);
        return $this->db->insert_id();
    }
    public function jobs_update($id, $data)
    {
        foreach ($data as $key => $val){
            $data[$key] = $this->db->escape_str($val);
        }
        $this->db->where('id' , $id);
        $this->db->update($this->table_name,$data);
        return $id;
    }
    public function jobs_delete($id){
        $this->db->where('id',$id);
        $this->db->delete($this->table_name);
    }
    public function jobs_get_by_employer($employer_id){
        $this->db->where('employer_id',$employer_id);
        $this->db->where('active',"1");
        $this->db->join("specialties","specialties.id = jobs.specialty");
        $this->db->select($this->table_name.".*,specialties.name as specialties_name");
        $this->db->order_by($this->table_name.".id","DESC");
        $r = $this->db->get($this->table_name);
        if ($r->num_rows() > 0) {
            return $r->result_array();
        }
        return false;
    }
    
    public function jobs_applied_by_employer($employer_id , $job_id = 0){
        if($job_id != 0){
            $this->db->where('jobs_applied.job_id',$job_id);
        }
        $this->db->select("jobs_applied.*,
            jobs_applied.id AS job_applied_id,
            jobs.internal_id,
            jobseekers.first_name,
            jobseekers.last_name,
            jobseekers.prof_suffix,
            jobseekers.city,
            jobseekers.state,
            jobseekers.zip,
            jobseekers.phone,
            jobseekers.alt_phone,
            jobseekers.profile_image,
            jobseekers.specialty
            ");
        $this->db->where('jobs_applied.applied',"1");
        $this->db->where('jobs_applied.employer_id',$employer_id);
        $this->db->join("jobs","jobs_applied.job_id = jobs.id");
        $this->db->join("jobseekers","jobseekers.id = jobs_applied.jobseeker_id");
        $r = $this->db->get("jobs_applied");
        if ($r->num_rows() > 0) {
            return $r->result_array();
        }
        return false;
    }
    
    public function jobs_applied_get($id = 0, $where_array = array() ) {
        if($id>0){
            $this->db->where('id',$id);
        }
        if( count($where_array)>0 ){
            $this->db->where( $where_array );
        }
        $r = $this->db->get("jobs_applied");
        if ($r->num_rows() > 0) {
            
            if($id>0){
                return $r->row_array();
            }else{
                return $r->result_array();
            }
        }
        return false;
    }
    public function jobs_applied_add($data)
    {
        $this->db->insert("jobs_applied",$data);
        return $this->db->insert_id();
    }
    public function jobs_applied_update($id, $data)
    {
        foreach ($data as $key => $val){
            $data[$key] = $this->db->escape_str($val);
        }
        $this->db->where('id' , $id);
        $this->db->update("jobs_applied",$data);
        return $id;
    }
    public function jobs_applied_delete($id){
        $this->db->where('id',$id);
        $this->db->delete("jobs_applied");
    }
    
    public function jobs_applied_by_jobseeker($jobseeker_id , $where_array = array() ){
        
        if( count($where_array)>0 ){
            $this->db->where( $where_array );
        }
        $select = "jobs.*,jobs_applied.id AS job_applied_id,
                   jobs_applied.applied,
                   jobs_applied.matched,
                   jobs_applied.interview,
                   jobs_applied.interview_complete,
                   jobs_applied.face_2_face,
                   jobs_applied.job_offer  ";
        $this->db->select($select);
        $this->db->where('jobs_applied.jobseeker_id',$jobseeker_id);
        $this->db->join("jobs","jobs_applied.job_id = jobs.id");
        $this->db->order_by("jobs_applied.id","DESC");
        $r = $this->db->get("jobs_applied");
        if ($r->num_rows() > 0) {
            return $r->result_array();
        }
        return false;
    }
    
    public function top_matches($data){
        
        $where = "";
        
//        if ( isset($data["salary_range"]) && $data["salary_range"] != "" ){
//            $salary = $data["salary_range"];
//            $salary_range = explode("-", $salary);
//            $min = $salary_range[0];
//            $where .= " AND j.salary_range_min >= '$min' ";
//            $max = NULL;
//            if(isset($salary_range[1])){
//                $max = $salary_range[1];
//                $where .= " AND j.salary_range_max <= '$max' ";
//            }
//        }
        
        $q = "SELECT j.*,
            ef.state,ef.city
            FROM jobs j
            JOIN employers e ON j.employer_id = e.id
            JOIN employers_facilities ef ON j.employer_id = ef.employer_id
            WHERE 1 ".$where."
            ORDER BY j.id DESC ";
        $r = $this->db->query($q);
        if ($r->num_rows() > 0) {
            return $r->result_array();
        }
        return FALSE;
        
    }
    public function top_matches_dashboard($data){
        $session = $this->session->all_userdata();
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;
        
        $where = " j.id NOT IN (SELECT job_id FROM jobseekers_jobs_status WHERE jobseeker_id = '$jobseeker_id' AND ( not_interested = 1 OR applied = 1 ) ) ";
        
        $q = "SELECT j.*,
            ef.state,ef.city
            FROM jobs j
            JOIN employers e ON j.employer_id = e.id
            JOIN employers_facilities ef ON j.employer_id = ef.employer_id
            WHERE 1 AND ".$where."
            ORDER BY j.id DESC ";
        $r = $this->db->query($q);
        if ($r->num_rows() > 0) {
            return $r->result_array();
        }
        return FALSE;
        
    }
    
    function jobs_get_details($id){
        $q = "SELECT j.*,
            ef.state,ef.city
            FROM jobs j
            JOIN employers e ON j.employer_id = e.id
            JOIN employers_facilities ef ON j.employer_id = ef.employer_id
            WHERE j.id = '$id' ";
        $r = $this->db->query($q);
        if ($r->num_rows() > 0) {
            return $r->row_array();
        }
        return FALSE;
    }
    
    
    public function jobseekers_jobs_status_get($id = 0, $where_array = array() ) {
        if($id>0){
            $this->db->where('id',$id);
        }
        if( count($where_array)>0 ){
            $this->db->where( $where_array );
        }
        $r = $this->db->get("jobseekers_jobs_status");
        if ($r->num_rows() > 0) {
            
            if($id>0){
                return $r->row_array();
            }else{
                return $r->result_array();
            }
        }
        return false;
    }   
    public function jobseekers_jobs_status_add($data)
    {
        $this->db->insert("jobseekers_jobs_status",$data);
        return $this->db->insert_id();
    }
    public function jobseekers_jobs_status_update($id, $data)
    {
        $this->db->where('id' , $id);
        $this->db->update("jobseekers_jobs_status",$data);
        return $id;
    }

    
}