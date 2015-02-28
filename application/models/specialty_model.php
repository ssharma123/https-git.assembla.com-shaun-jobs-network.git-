<?php

class Specialty_model extends CI_Model {

    protected $table_name = "";

    public function __construct() {
        $this->table_name = "specialties";
        parent::__construct();
    }

    public function specialties_get($id = 0) {
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
    public function specialties_add($data)
    {
        $this->db->insert($this->table_name,$data);
        return $this->db->insert_id();
    }
    public function specialties_update($id, $data)
    {
        $this->db->where('id' , $id);
        $this->db->update($this->table_name,$data);
    }
    function specialties_get_by_type($type , $parent_id){
        if($type == "parent"){
            $this->db->where("parent_id","0");
        }
        else if($type == "sub"){
            $this->db->where("parent_id",$parent_id);
        }
        $this->db->order_by("name","ASC");
        $r = $this->db->get($this->table_name);
        if ($r->num_rows() > 0) {
            return $r->result_array();
        }
        return false;
    }
}