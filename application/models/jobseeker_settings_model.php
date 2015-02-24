<?php

class Jobseeker_settings_model extends CI_Model {

    protected $table_name = "";

    public function __construct() {
        $this->table_name = "jobseekers_settings";
        parent::__construct();
    }

    public function jobseekers_setttings_get($id = 0) {
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
    public function jobseekers_setttings_add($data)
    {
        $this->db->insert($this->table_name,$data);
        return $this->db->insert_id();
    }
    public function jobseekers_setttings_update($id, $data)
    {
        $this->db->where('id' , $id);
        $this->db->update($this->table_name,$data);
    }
    function jobseekers_setttings_get_by_jobseeker($jobseeker_id){
        
        $this->db->where("jobseeker_id",$jobseeker_id);
        $r = $this->db->get($this->table_name);
        if ($r->num_rows() > 0) {
            return $r->row_array();
        }
        return false;
    }
    
    
}