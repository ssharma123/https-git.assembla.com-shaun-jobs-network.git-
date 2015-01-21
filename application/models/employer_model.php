<?php

class Employer_model extends CI_Model {

    protected $table_name = "";

    public function __construct() {
        $this->table_name = "employers";
        parent::__construct();
    }

    public function employers_get($id = 0) {
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
    public function employers_add($data)
    {
        $this->db->insert($this->table_name,$data);
        return $this->db->insert_id();
    }
    public function employers_update($id, $data)
    {
        $this->db->where('id' , $id);
        $this->db->update($this->table_name,$data);
        return $id;
    }
    
    function employer_get_by_email($email){
        $this->db->where('email',$email);
        $r = $this->db->get($this->table_name);
        if ($r->num_rows() > 0) {
            return $r->row_array();
        }
        return false;
    }
    function employer_get_by_facebook_id($facebook_id){
        $this->db->where('facebook_id',$facebook_id);
        $r = $this->db->get($this->table_name);
        if ($r->num_rows() > 0) {
            return $r->row_array();
        }
        return false;
    }
    function employers_get_by_email_pass($email , $pass){
        $this->db->where('email',$this->db->escape_str($email));
        $this->db->where('password',md5( $this->db->escape_str($pass) ));
        $r = $this->db->get($this->table_name);
        if ($r->num_rows() > 0) {
            return $r->row_array();
        }
        return false;
    }
}