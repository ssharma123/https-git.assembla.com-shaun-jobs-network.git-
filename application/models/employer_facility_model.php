<?php

class Employer_facility_model extends CI_Model {

    protected $table_name = "";

    public function __construct() {
        $this->table_name = "employers_facilities";
        parent::__construct();
    }

    public function employers_facility_get($id = 0) {
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
    public function employers_facility_add($data)
    {
        $this->db->insert($this->table_name,$data);
        return $this->db->insert_id();
    }
    public function employers_facility_update($id, $data)
    {
        $this->db->where('id' , $id);
        $this->db->update($this->table_name,$data);
    }
    function employers_facility_get_by_employer_id($employer_id){
        $this->db->where('employer_id',$employer_id);
        $this->db->join("facilities","facilities.id = ".$this->table_name.".facility_id");
        $r = $this->db->get($this->table_name);
        if ($r->num_rows() > 0) {
            return $r->row_array();
        }
        return false;
    }
     
}