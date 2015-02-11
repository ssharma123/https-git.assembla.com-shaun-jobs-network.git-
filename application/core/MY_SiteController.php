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
    
    var $states = array();

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
        
        // default time zone
        if( ! ini_get('date.timezone') )
        {
            date_default_timezone_set('GMT');
        }
        
        $this->load->helper('common');
        
        // load states 
        $this->init_states();
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
    
    public function init_states(){
        $states = array(
            'AL'=>'Alabama',
            'AK'=>'Alaska',
            'AZ'=>'Arizona',
            'AR'=>'Arkansas',
            'CA'=>'California',
            'CO'=>'Colorado',
            'CT'=>'Connecticut',
            'DE'=>'Delaware',
            'DC'=>'District of Columbia',
            'FL'=>'Florida',
            'GA'=>'Georgia',
            'HI'=>'Hawaii',
            'ID'=>'Idaho',
            'IL'=>'Illinois',
            'IN'=>'Indiana',
            'IA'=>'Iowa',
            'KS'=>'Kansas',
            'KY'=>'Kentucky',
            'LA'=>'Louisiana',
            'ME'=>'Maine',
            'MD'=>'Maryland',
            'MA'=>'Massachusetts',
            'MI'=>'Michigan',
            'MN'=>'Minnesota',
            'MS'=>'Mississippi',
            'MO'=>'Missouri',
            'MT'=>'Montana',
            'NE'=>'Nebraska',
            'NV'=>'Nevada',
            'NH'=>'New Hampshire',
            'NJ'=>'New Jersey',
            'NM'=>'New Mexico',
            'NY'=>'New York',
            'NC'=>'North Carolina',
            'ND'=>'North Dakota',
            'OH'=>'Ohio',
            'OK'=>'Oklahoma',
            'OR'=>'Oregon',
            'PA'=>'Pennsylvania',
            'RI'=>'Rhode Island',
            'SC'=>'South Carolina',
            'SD'=>'South Dakota',
            'TN'=>'Tennessee',
            'TX'=>'Texas',
            'UT'=>'Utah',
            'VT'=>'Vermont',
            'VA'=>'Virginia',
            'WA'=>'Washington',
            'WV'=>'West Virginia',
            'WI'=>'Wisconsin',
            'WY'=>'Wyoming',
        );
        
        $this->states = $states;
    }
    
    public function get_states(){
        $states = $this->states;
        if($states){
            foreach ($states as $key => $val){
                $temp = array();
                $temp['id'] = $key;
                $temp['name'] = $val;
                $output[] = $temp;
            }
        }
        return json_encode($output);
    }

}
