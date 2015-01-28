<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_SiteController extends CI_Controller {

    var $js = array();
    var $js_top = array();
    var $css = array();
    var $site_setting = array();
    var $pageLoadScript = '';
    var $title = '';
    var $meta_title = '';
    var $meta_description = '';
    var $meta_keyword = '';
    var $google_analytics = '';

    function __construct() {
        parent::__construct();
        $params = $this->router->fetch_method();
        $excluded_auth = array();

        $this->config->load('site_setting',TRUE);
        $settings = $this->config->item('site_setting');
        $site = $settings['site'];
        $this->title = $site['title'];
        $this->meta_title = $site['meta_title'];
        $this->meta_description = $site['meta_description'];
        $this->meta_keyword = $site['meta_keyword'];
        
        $this->load->helper('common');
    }

    public function siteAuthenticate() {
        if (!$this->session->userdata('id')) {
            redirect('/');
        }
    }
    
    public function get_facilities_name(){
        $this->load->model('facility_model','facility');
        $facilities = $this->facility->facilities_get();
        $output = array();
        if($facilities){
            foreach ($facilities as $val){
                $temp = array();
                $temp['id'] = $val['id'];
                $temp['name'] = $val['name'];
                $output[] = $temp;
            }
        }

        return json_encode($output);
        
    }
    public function get_specialties($type = 'all'){
        $this->load->model('specialty_model','specialty');
        
        $parent_id = ( $this->input->post('parent_id') ) ? $this->input->post('parent_id') : 0 ;
        $specialties = $this->specialty->specialties_get_by_type($type, $parent_id);
        
        $options = $this->input->post("options");
        if($options){
            $html = "";
            foreach($specialties as $row){
                $html .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
            }
            $array = array(
                "status" => "ok",
                "html" => $html
            );
            echo json_encode($array);
            die;
        }
        else{
            return $specialties;
        }
        
        
    }

}
