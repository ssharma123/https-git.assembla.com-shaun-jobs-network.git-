<?php

class Jobseeker_model extends CI_Model {

    protected $table_name = "";

    public function __construct() {
        $this->table_name = "jobseekers";
        parent::__construct();
    }

    public function jobseekers_get($id = 0) {
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
    public function jobseekers_add($data)
    {
        $this->db->insert($this->table_name,$data);
        return $this->db->insert_id();
    }
    public function jobseekers_update($id, $data)
    {
        $this->db->where('id' , $id);
        $this->db->update($this->table_name,$data);
        return $id;
    }
    
    function jobseekers_get_by_email($email){
        $this->db->where('email',$email);
        $r = $this->db->get($this->table_name);
        if ($r->num_rows() > 0) {
            return $r->row_array();
        }
        return false;
    }
    function jobseekers_get_by_facebook_id($facebook_id){
        $this->db->where('facebook_id',$facebook_id);
        $r = $this->db->get($this->table_name);
        if ($r->num_rows() > 0) {
            return $r->row_array();
        }
        return false;
    }
    function jobseekers_get_by_linkedin_id($linkedin_id){
        $this->db->where('linkedin_id',$linkedin_id);
        $r = $this->db->get($this->table_name);
        if ($r->num_rows() > 0) {
            return $r->row_array();
        }
        return false;
    }
    function jobseekers_get_by_email_pass($email , $pass){
        $this->db->where('email',$this->db->escape_str($email));
        $this->db->where('password',md5( $this->db->escape_str($pass) ));
        $r = $this->db->get($this->table_name);
        if ($r->num_rows() > 0) {
            return $r->row_array();
        }
        return false;
    }
    
    function get_jobseekers_email_for_edit($id , $email){
        $this->db->where('email',$this->db->escape_str($email));
        $this->db->where('id != ', $this->db->escape_str($id) );
        $r = $this->db->get($this->table_name);
        if ($r->num_rows() > 0) {
            return $r->row_array();
        }
        return false;
    }
}