<?php

class Facility_model extends CI_Model {

    protected $table_name = "";

    public function __construct() {
        $this->table_name = "facilities";
        parent::__construct();
    }

    public function facilities_get($id = 0) {
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
    public function facilities_add($data)
    {
        $this->db->insert($this->table_name,$data);
        return $this->db->insert_id();
    }
    public function facilities_update($id, $data)
    {
        $this->db->where('id' , $id);
        $this->db->update($this->table_name,$data);
    }
}