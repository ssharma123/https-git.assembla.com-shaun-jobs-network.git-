<?php

class Jobseeker_search_locations_model extends CI_Model {

    protected $table_name = "";

    public function __construct() {
        $this->table_name = "jobseekers_search_locations";
        parent::__construct();
    }
    public function jobseekers_search_locations_get($id = 0, $where_array = array() ) {
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
    public function jobseekers_search_locations_add($data)
    {
        $this->db->insert($this->table_name,$data);
        return $this->db->insert_id();
    }
    public function jobseekers_search_locations_update($id, $data)
    {
        $this->db->where('id' , $id);
        $this->db->update($this->table_name,$data);
        return $id;
    }
    public function jobseekers_search_locations_delete($id){
        $this->db->where('id',$id);
        $this->db->delete($this->table_name);
    }
     
     
}