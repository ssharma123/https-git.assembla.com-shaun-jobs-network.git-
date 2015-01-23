<?php

class Employers_subscription_model extends CI_Model {

    protected $table_name = "";

    public function __construct() {
        $this->table_name = "employers_subscription";
        parent::__construct();
    }

    public function subscription_get($id = 0) {
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
    public function subscription_add($data)
    {
        $this->db->insert($this->table_name,$data);
        return $this->db->insert_id();
    }
    public function subscription_update($id, $data)
    {
        $this->db->where('id' , $id);
        $this->db->update($this->table_name,$data);
    }
    function subscription_get_by_subscription_id($sub_id){
        $this->db->where('subsription_id',$sub_id);
        $r = $this->db->get($this->table_name);
        if ($r->num_rows() > 0) {
            return $r->row_array();
        }
        return false;
    }
    function subscription_get_by_user_id($user_id){
        $this->db->where('user_id',$user_id);
        $r = $this->db->get($this->table_name);
        if ($r->num_rows() > 0) {
            return $r->row_array();
        }
        return false;
    }
    public function subscription_log_save($data)
    {
        $this->db->insert('employers_subscription_logs',$data);
        return $this->db->insert_id();
    }
}