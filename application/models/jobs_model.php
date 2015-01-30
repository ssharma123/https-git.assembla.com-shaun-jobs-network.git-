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
    public function jobs_get_by_employer($employer_id){
        $this->db->where('employer_id',$employer_id);
        $this->db->where('active',"1");
        $this->db->join("specialties","specialties.id = jobs.specialty");
        $this->db->select($this->table_name.".*,specialties.name as specialties_name");
        $r = $this->db->get($this->table_name);
        if ($r->num_rows() > 0) {
            return $r->result_array();
        }
        return false;
    }
    
    public function jobs_applied_by_employer($employer_id){
        $this->db->where('jobs_applied.employer_id',$employer_id);
        $this->db->join("jobs","jobs_applied.job_id = jobs.id");
        $r = $this->db->get("jobs_applied");
        if ($r->num_rows() > 0) {
            return $r->result_array();
        }
        return false;
    }
    
}