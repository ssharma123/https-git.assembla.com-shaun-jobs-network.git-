<?php

class Jobseeker_notifications_model extends CI_Model {

    protected $table_name = "";

    public function __construct() {
        $this->table_name = "jobseeker_notifications";
        parent::__construct();
    }
    public function jobseeker_notifications_get($id = 0, $where_array = array() ) {
        if($id>0){
            $this->db->where('id',$id);
        }
        if( count($where_array)>0 ){
            $this->db->where( $where_array );
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
    public function jobseeker_notifications_total( $where_array = array() ) {
        
        $this->db->select(" COUNT(*) AS total ");
        if( count($where_array)>0 ){
            $this->db->where( $where_array );
        }
        $r = $this->db->get($this->table_name);
        if ($r->num_rows() > 0) {
            $row = $r->row_array();
            return $row["total"];
        }
        return 0;
    }
    public function jobseeker_notifications_add($data)
    {
        $this->db->insert($this->table_name,$data);
        return $this->db->insert_id();
    }
    public function jobseeker_notifications_update($id, $data)
    {
        $this->db->where('id' , $id);
        $this->db->update($this->table_name,$data);
        return $id;
    }
    public function jobseeker_notifications_delete($id){
        $this->db->where('id',$id);
        $this->db->delete($this->table_name);
    }
    
    public function jobseeker_notifications_get_by_jobseeker( $jobseeker_id ) {
        
        $this->db->where("is_read","0");
        $this->db->where('jobseeker_notifications.jobseeker_id',$jobseeker_id);
        
        $this->db->join("jobs","jobseeker_notifications.job_id = jobs.id");
        $this->db->join("jobs_applied","jobseeker_notifications.job_applied_id = jobs_applied.id");
        $this->db->select($this->table_name.".* , jobs_applied.f2f_date_1,jobs_applied.f2f_date_2,jobs_applied.f2f_date_3, jobs.job_headline, jobs.title ");
        
        $this->db->order_by($this->table_name.".id","DESC");
        
        $r = $this->db->get($this->table_name);
        if ($r->num_rows() > 0) {
            return $r->result_array();
        }
        return false;
    }
     
}