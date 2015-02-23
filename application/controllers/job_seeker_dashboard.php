<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Job_seeker_dashboard extends MY_Job_seekerController {

    
    function __construct() {
        parent::__construct();
        $this->load->model('jobs_model', 'jobs');
        $this->load->model('jobseeker_model', 'jobseeker');
        $this->load->model('jobseeker_licence_model', 'jobseeker_licence');
        $this->load->model('jobseeker_certification_model', 'jobseeker_certification');
        $this->load->model('jobseeker_degree_model', 'jobseeker_degree');
        $this->load->model('jobseeker_residency_model', 'jobseeker_residency');
        $this->load->model('jobseeker_fellowship_model', 'jobseeker_fellowship');
        $this->load->model('jobseeker_practice_model', 'jobseeker_practice');
        $this->load->model('jobseeker_search_locations_model', 'location');
        $this->load->model('specialty_model', 'specialty');
    }
    
    public function index() {

        $this->layout = "jobseeker_dashboard";
        
        $session = $this->session->all_userdata();
        if(!isset($session['jobseeker'])){
            redirect('job_seeker/signin');
        }
        
        $data['jobseeker'] = $this->jobseeker->jobseekers_get($session['jobseeker']['id']);
        
        
        $this->load->view('job_seeker/job_seeker_dashboard', $data);
        
    }
    
    public function tab_profile(){
        $this->layout = "blank";
        $data = array();
        
        $session = $this->session->all_userdata();
        if(!isset($session['jobseeker'])){
            redirect('job_seeker/signin');
        }
        
        $html = $this->load->view('job_seeker/dashboard/tab_profile', $data, TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    public function tab_status(){
        $this->layout = "blank";
        $data = array();
        
        $session = $this->session->all_userdata();
        if(!isset($session['jobseeker'])){
            redirect('job_seeker/signin');
        }
        
        $html = $this->load->view('job_seeker/dashboard/tab_status', $data, TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    public function tab_matches(){
        $this->layout = "blank";
        $data = array();
        
        $session = $this->session->all_userdata();
        if(!isset($session['jobseeker'])){
            redirect('job_seeker/signin');
        }
        
        $html = $this->load->view('job_seeker/dashboard/tab_matches', $data, TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    public function tab_settings(){
        $this->layout = "blank";
        $data = array();
        
        $session = $this->session->all_userdata();
        if(!isset($session['jobseeker'])){
            redirect('job_seeker/signin');
        }
        
        $html = $this->load->view('job_seeker/dashboard/tab_settings', $data, TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    
    public function welcome(){
        $this->layout = "blank";
        $data = array();
        
        $session = $this->session->all_userdata();
        if(!isset($session['jobseeker'])){
            redirect('job_seeker/signin');
        }
        
        $html = $this->load->view('job_seeker/dashboard/welcome', $data, TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    public function welcome_popup(){
        $this->layout = "blank";
        
        $html = $this->load->view('job_seeker/welcome_popup', array(), TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    
    public function profile_step_1(){
        $this->layout = "blank";
        $data = array();
        
        $session = $this->session->all_userdata();
        if(!isset($session['jobseeker'])){
            redirect('job_seeker/signin');
        }
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;
        
        $data["jobseeker"] = $this->jobseeker->jobseekers_get($jobseeker_id);
        
        $html = $this->load->view('job_seeker/profile/step_1', $data, TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    public function save_profile_step_1(){
        $session = $this->session->all_userdata();
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;

        $this->layout = "blank";
        $msg = "";
        $status = "";
        $this->load->library('form_validation');
        $config = array(
            array('field' => 'first_name', 'label' => 'first name', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'last_name', 'label' => 'last name', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'prof_suffix', 'label' => 'prof suffix', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'address', 'label' => 'address', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'apt', 'label' => 'Apt', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'city', 'label' => 'City', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'state', 'label' => 'State', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'zip', 'label' => 'Zip', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'phone', 'label' => 'Phone', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'alt_phone', 'label' => 'Alternate phone', 'rules' => 'trim|required|xss_clean')
        );
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() === TRUE) {
            
            
            $save_data['first_name'] = $this->input->post('first_name');
            $save_data['last_name'] = $this->input->post('last_name');
            $save_data['mid_name'] = $this->input->post('mid_name');
            $save_data['prefix'] = $this->input->post('prefix');
            $save_data['suffix'] = $this->input->post('suffix');
            $save_data['prof_suffix'] = $this->input->post('prof_suffix');
            $save_data['address'] = $this->input->post('address');
            $save_data['apt'] = $this->input->post('apt');
            $save_data['city'] = $this->input->post('city');
            $save_data['state'] = $this->input->post('state');
            $save_data['zip'] = $this->input->post('zip');
            $save_data['phone'] = $this->input->post('phone');
            $save_data['alt_phone'] = $this->input->post('alt_phone');
            $save_data['step'] = 1;
            $save_data['updated_at'] = time();
            
            $id = $jobseeker_id;
            if($id){
                $this->jobseeker->jobseekers_update($id , $save_data);
                $status = "ok";
            }
            else{
                $status = "error";
                $msg = "Oops something went wrong please try again";
            }
            
        } else {
            $msg = validation_errors();
            $status = "error";
        }
        
        

        $array = array(
            "status" => $status,
            "msg" => $msg
        );
        echo json_encode($array); die;
    }
    public function profile_step_2(){
        $this->layout = "blank";
        $data = array();
        $session = $this->session->all_userdata();
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;
        
        $data["jobseeker"] = $this->jobseeker->jobseekers_get($jobseeker_id);
        
        $data["specialties"] = $this->get_specialties('parent');
        if( isset($data["jobseeker"]["specialty"]) && $data["jobseeker"]["specialty"] != ""){
            $data['sub_specialty'] = $this->specialty->specialties_get_by_type( "sub" , $data["jobseeker"]["specialty"] );
        }
        
        $html = $this->load->view('job_seeker/profile/step_2', $data, TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    public function save_profile_step_2(){
        $session = $this->session->all_userdata();
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;

        $this->layout = "blank";
        $msg = "";
        $status = "";
        $this->load->library('form_validation');
        $config = array(
            array('field' => 'experince_level', 'label' => 'experince level', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'specialty', 'label' => 'specialty', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'sub_specialty', 'label' => 'sub specialty', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'board_status', 'label' => 'board status', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'degree', 'label' => 'degree', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'resident_status', 'label' => 'resident status', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'npi_number', 'label' => 'npi number', 'rules' => 'trim|required|xss_clean')
        );
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() === TRUE) {
            
            
            $save_data['experince_level'] = $this->input->post('experince_level');
            $save_data['specialty'] = $this->input->post('specialty');
            $save_data['sub_specialty'] = $this->input->post('sub_specialty');
            $save_data['board_status'] = $this->input->post('board_status');
            $save_data['degree'] = $this->input->post('degree');
            $save_data['resident_status'] = $this->input->post('resident_status');
            $save_data['npi_number'] = $this->input->post('npi_number');
            
            $save_data['step'] = 2;
            $save_data['updated_at'] = time();
            
            $id = $jobseeker_id;
            if($id){
                $this->jobseeker->jobseekers_update($id , $save_data);
                $status = "ok";
            }
            else{
                $status = "error";
                $msg = "Oops something went wrong please try again";
            }
            
        } else {
            $msg = validation_errors();
            $status = "error";
        }
        
        

        $array = array(
            "status" => $status,
            "msg" => $msg
        );
        echo json_encode($array); die;
    }
    public function profile_step_3(){
        $this->layout = "blank";
        $data = array();
        $session = $this->session->all_userdata();
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;
        
        $data["specialties"] = $this->get_specialties('parent');
        
        $where_array["jobseeker_id"] = $jobseeker_id;
        $data["certifications"] = $this->jobseeker_certification->jobseekers_certifications_get(0, $where_array);
        $data["licences"] = $this->jobseeker_licence->jobseekers_licences_get(0, $where_array);
        
        $data["total_license"] = ( $data["licences"] ) ? count($data["licences"]) : 0 ;
        $data["total_cert"] = ( $data["certifications"] ) ? count($data["certifications"]) : 0 ;
    
        $html = $this->load->view('job_seeker/profile/step_3', $data, TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    
    public function add_license_process(){
        $session = $this->session->all_userdata();
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;

        $this->layout = "blank";
        $msg = "";
        $status = "";
        $html = "";
        $this->load->library('form_validation');
        $config = array(
            array('field' => 'licence_type', 'label' => 'licence type', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'licence_number', 'label' => 'licence number', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'issued_on', 'label' => 'issued on', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'state', 'label' => 'state', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'federal', 'label' => 'federal', 'rules' => 'trim|required|xss_clean')
        );
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() === TRUE) {
            
            
            $save_data['jobseeker_id'] = $jobseeker_id;
            $save_data['licence_type'] = $this->input->post('licence_type');
            $save_data['licence_number'] = $this->input->post('licence_number');
            $save_data['issued_on'] = strtotime( $this->input->post('issued_on') );
            $save_data['state'] = $this->input->post('state');
            $save_data['federal'] = $this->input->post('federal');
            $save_data['created_at'] = time();
            
            $id = $this->jobseeker_licence->jobseekers_licences_add($save_data);
            if($id){
                
                $status = "ok";
                
                
                $html = '<div class="row well-blue padding_5" data-val="'.$id.'" >
                        <div class="col col-sm-5 text-left">
                            <strong>'.$save_data['licence_type'].'</strong><br>
                            '.$save_data['licence_number'].'
                        </div>
                        <div class="col col-sm-5 text-left">
                            '.date("Y-m-d",$save_data['issued_on']).'<br>
                            '.$save_data['state'].'
                        </div>
                        <div class="col col-sm-2 text-left">
                            <a class="remove_license btn btn-danger btn-sm">Remove</a>
                        </div>
                    </div>';
            }
            else{
                $status = "error";
                $msg = "Oops something went wrong please try again";
            }
            
        } else {
            $msg = validation_errors();
            $status = "error";
        }
        
        

        $array = array(
            "status" => $status,
            "msg" => $msg,
            "html" => $html
        );
        echo json_encode($array); die;
    }
    public function add_certification_process(){
        $session = $this->session->all_userdata();
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;

        $this->layout = "blank";
        $msg = "";
        $status = "";
        $html = "";
        $this->load->library('form_validation');
        $config = array(
            array('field' => 'name', 'label' => 'name', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'issued_on', 'label' => 'issued on', 'rules' => 'trim|required|xss_clean')
        );
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() === TRUE) {
            
            
            $save_data['jobseeker_id'] = $jobseeker_id;
            $save_data['name'] = $this->input->post('name');
            $save_data['issued_on'] = strtotime( $this->input->post('issued_on') );
            $save_data['created_at'] = time();
            
            $id = $this->jobseeker_certification->jobseekers_certifications_add($save_data);
            if($id){
                $status = "ok";
                $html = '<div class="row well-purple padding_5" data-val="'.$id.'" >
                        <div class="col col-sm-5 text-left">
                            <strong>'.$save_data['name'].'</strong><br>
                        </div>
                        <div class="col col-sm-5 text-left">
                            '.date("Y-m-d",$save_data['issued_on']).'  
                        </div>
                        <div class="col col-sm-2 text-left">
                            <a class="remove_certification btn btn-danger btn-sm">Remove</a>
                        </div>
                    </div>';
            }
            else{
                $status = "error";
                $msg = "Oops something went wrong please try again";
            }
            
        } else {
            $msg = validation_errors();
            $status = "error";
        }
        
        

        $array = array(
            "status" => $status,
            "msg" => $msg,
            "html" => $html
        );
        echo json_encode($array); die;
    }
    
    public function delete_certification(){
        $this->layout = "blank";
        $msg = "";
        $status = "";
        
        $id = ($this->input->post("id")) ? $this->input->post("id") : 0 ;
        $r = $this->jobseeker_certification->jobseekers_certifications_get($id);
        
        if($r){
            $r = $this->jobseeker_certification->jobseekers_certifications_delete($id);
            $status = "ok";
            $msg = "Deleted successfully";
        }
        else{
            $status = "error";
            $msg = "Data not found";
        }
            
        $array = array(
            "status" => $status,
            "msg" => $msg
        );
        echo json_encode($array); die;
    }
    public function delete_license(){
        $this->layout = "blank";
        $msg = "";
        $status = "";
        
        $id = ($this->input->post("id")) ? $this->input->post("id") : 0 ;
        $r = $this->jobseeker_licence->jobseekers_licences_get($id);
        
        if($r){
            $r = $this->jobseeker_licence->jobseekers_licences_delete($id);
            $status = "ok";
            $msg = "Deleted successfully";
        }
        else{
            $status = "error";
            $msg = "Data not found";
        }
            
        $array = array(
            "status" => $status,
            "msg" => $msg
        );
        echo json_encode($array); die;
    }
    
    public function profile_step_4(){
        $this->layout = "blank";
        $data = array();
        $session = $this->session->all_userdata();
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;
        
        $data["specialties"] = $this->get_specialties('parent');
        
        $where_array["jobseeker_id"] = $jobseeker_id;

        $data["degrees"] = $this->jobseeker_degree->jobseekers_degrees_get(0, $where_array);
        $data["residencys"] = $this->jobseeker_residency->jobseekers_residency_get(0, $where_array);
        $data["fellowships"] = $this->jobseeker_fellowship->jobseekers_fellowships_get(0, $where_array);
        
        $data["total_degrees"] = ( $data["degrees"] ) ? count($data["degrees"]) : 0 ;
        $data["total_residencys"] = ( $data["residencys"] ) ? count($data["residencys"]) : 0 ;
        $data["total_fellowships"] = ( $data["fellowships"] ) ? count($data["fellowships"]) : 0 ;
        
        $data["specialties"] = $this->get_specialties('parent');
        
    
        $html = $this->load->view('job_seeker/profile/step_4', $data, TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    
    public function add_degree_process(){
        $session = $this->session->all_userdata();
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;

        $this->layout = "blank";
        $msg = "";
        $status = "";
        $html = "";
        $this->load->library('form_validation');
        $config = array(
            array('field' => 'school', 'label' => 'School', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'degree', 'label' => 'Degree', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'city', 'label' => 'City', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'state', 'label' => 'State', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'country', 'label' => 'Country', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'year', 'label' => 'Year', 'rules' => 'trim|required|xss_clean')
        );
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() === TRUE) {
            
            
            $save_data['jobseeker_id'] = $jobseeker_id;
            $save_data['school'] = $this->input->post('school');
            $save_data['degree'] = $this->input->post('degree');
            $save_data['city'] =  $this->input->post('city');
            $save_data['state'] = $this->input->post('state');
            $save_data['country'] = $this->input->post('country');
            $save_data['year'] = strtotime($this->input->post('year')."-01-01") ;
            $save_data["med_school"] = ($this->input->post("med_school") == "true") ?  "yes" : "no" ;
            $save_data['created_at'] = time();
            
            $id = $this->jobseeker_degree->jobseekers_degrees_add($save_data);
            if($id){
                
                $status = "ok";
                
                $med_school = ( $save_data["med_school"] == "yes" ) ? " (Med School)" : ""; 
                $html = '<div class="row well-blue padding_5" data-val="'.$id.'" >
                        <div class="col col-sm-5 text-left">
                            <strong>'.$save_data['degree'].'</strong><br>
                            '.$save_data["school"].$med_school.'
                        </div>
                        <div class="col col-sm-5 text-left">
                            '.date("Y",$save_data['year']).'<br>
                            '.$save_data["city"].",".$save_data["state"].",".$save_data["country"].'
                        </div>
                        <div class="col col-sm-2 text-left">
                            <a class="remove_degree btn btn-danger btn-sm">Remove</a>
                        </div>
                    </div>';
            }
            else{
                $status = "error";
                $msg = "Oops something went wrong please try again";
            }
            
        } else {
            $msg = validation_errors();
            $status = "error";
        }
        
        

        $array = array(
            "status" => $status,
            "msg" => $msg,
            "html" => $html
        );
        echo json_encode($array); die;
    }
    
    public function delete_degree(){
        $this->layout = "blank";
        $msg = "";
        $status = "";
        
        $id = ($this->input->post("id")) ? $this->input->post("id") : 0 ;
        $r = $this->jobseeker_degree->jobseekers_degrees_get($id);
        
        if($r){
            $r = $this->jobseeker_degree->jobseekers_degrees_delete($id);
            $status = "ok";
            $msg = "Deleted successfully";
        }
        else{
            $status = "error";
            $msg = "Data not found";
        }
            
        $array = array(
            "status" => $status,
            "msg" => $msg
        );
        echo json_encode($array); die;
    }
    
    public function add_residency_process(){
        $session = $this->session->all_userdata();
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;

        $this->layout = "blank";
        $msg = "";
        $status = "";
        $html = "";
        $this->load->library('form_validation');
        $config = array(
            array('field' => 'institution', 'label' => 'Institution', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'date_from', 'label' => 'From Date', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'date_to', 'label' => 'To Date', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'city', 'label' => 'City', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'state', 'label' => 'State', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'country', 'label' => 'Country', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'specialty', 'label' => 'Specialty', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'sub_specialty', 'label' => 'Sub specialty', 'rules' => 'trim|required|xss_clean')
        );
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() === TRUE) {
            
            
            $save_data['jobseeker_id'] = $jobseeker_id;
            $save_data['institution'] = $this->input->post('institution');
            $save_data['date_from'] = strtotime($this->input->post('date_from'));
            $save_data['date_to'] =  strtotime($this->input->post('date_to'));
            $save_data['city'] = $this->input->post('city');
            $save_data['state'] = $this->input->post('state');
            $save_data['country'] = $this->input->post('country');
            $save_data['speciality'] = $this->input->post('specialty');
            $save_data['sub_speciality'] = $this->input->post('sub_specialty');
            $save_data['created_at'] = time();
            
            $id = $this->jobseeker_residency->jobseekers_residency_add($save_data);
            if($id){
                
                $status = "ok";
                $speciality =  get_specialties($save_data["speciality"]);
                $sub_speciality =  get_specialties($save_data["sub_speciality"]);
                $speciality_name = ( isset($speciality['name']) ) ? $speciality['name'] : "";
                $speciality_name .= ( isset($sub_speciality['name']) ) ? ", ".$sub_speciality['name'] : "";
                
                $html = '<div class="row well-purple padding_5" data-val="'.$id.'" >
                        <div class="col col-sm-5 text-left">
                            <strong>'.$save_data['institution'].'</strong><br>
                            '.$save_data["city"].",".$save_data["state"].",".$save_data["country"].'
                        </div>
                        <div class="col col-sm-5 text-left">
                            '.$speciality_name.'<br>
                            '.date("Y-m-d",$save_data['date_from'])."-".date("Y-m-d",$save_data['date_to']).'
                        </div>
                        <div class="col col-sm-2 text-left">
                            <a class="remove_residency btn btn-danger btn-sm">Remove</a>
                        </div>
                    </div>';
            }
            else{
                $status = "error";
                $msg = "Oops something went wrong please try again";
            }
            
        } else {
            $msg = validation_errors();
            $status = "error";
        }
        
        

        $array = array(
            "status" => $status,
            "msg" => $msg,
            "html" => $html
        );
        echo json_encode($array); die;
    }
    
    public function delete_residency(){
        $this->layout = "blank";
        $msg = "";
        $status = "";
        
        $id = ($this->input->post("id")) ? $this->input->post("id") : 0 ;
        $r = $this->jobseeker_residency->jobseekers_residency_get($id);
        
        if($r){
            $r = $this->jobseeker_residency->jobseekers_residency_delete($id);
            $status = "ok";
            $msg = "Deleted successfully";
        }
        else{
            $status = "error";
            $msg = "Data not found";
        }
            
        $array = array(
            "status" => $status,
            "msg" => $msg
        );
        echo json_encode($array); die;
    }
    
    public function add_fellowship_process(){
        $session = $this->session->all_userdata();
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;

        $this->layout = "blank";
        $msg = "";
        $status = "";
        $html = "";
        $this->load->library('form_validation');
        $config = array(
            array('field' => 'institution', 'label' => 'Institution', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'date_from', 'label' => 'From Date', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'date_to', 'label' => 'To Date', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'city', 'label' => 'City', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'state', 'label' => 'State', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'country', 'label' => 'Country', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'specialty', 'label' => 'Specialty', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'sub_specialty', 'label' => 'Sub specialty', 'rules' => 'trim|required|xss_clean')
        );
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() === TRUE) {
            
            
            $save_data['jobseeker_id'] = $jobseeker_id;
            $save_data['institution'] = $this->input->post('institution');
            $save_data['date_from'] = strtotime($this->input->post('date_from'));
            $save_data['date_to'] =  strtotime($this->input->post('date_to'));
            $save_data['city'] = $this->input->post('city');
            $save_data['state'] = $this->input->post('state');
            $save_data['country'] = $this->input->post('country');
            $save_data['speciality'] = $this->input->post('specialty');
            $save_data['sub_speciality'] = $this->input->post('sub_specialty');
            $save_data['created_at'] = time();
            
            $id = $this->jobseeker_fellowship->jobseekers_fellowships_add($save_data);
            if($id){
                
                $status = "ok";
                $speciality =  get_specialties($save_data["speciality"]);
                $sub_speciality =  get_specialties($save_data["sub_speciality"]);
                $speciality_name = ( isset($speciality['name']) ) ? $speciality['name'] : "";
                $speciality_name .= ( isset($sub_speciality['name']) ) ? ", ".$sub_speciality['name'] : "";
                
                $html = '<div class="row well-yellow padding_5" data-val="'.$id.'" >
                        <div class="col col-sm-5 text-left">
                            <strong>'.$save_data['institution'].'</strong><br>
                            '.$save_data["city"].",".$save_data["state"].",".$save_data["country"].'
                        </div>
                        <div class="col col-sm-5 text-left">
                            '.$speciality_name.'<br>
                            '.date("Y-m-d",$save_data['date_from'])."-".date("Y-m-d",$save_data['date_to']).'
                        </div>
                        <div class="col col-sm-2 text-left">
                            <a class="remove_fellowship btn btn-danger btn-sm">Remove</a>
                        </div>
                    </div>';
            }
            else{
                $status = "error";
                $msg = "Oops something went wrong please try again";
            }
            
        } else {
            $msg = validation_errors();
            $status = "error";
        }
        
        

        $array = array(
            "status" => $status,
            "msg" => $msg,
            "html" => $html
        );
        echo json_encode($array); die;
    }
    
    public function delete_fellowship(){
        $this->layout = "blank";
        $msg = "";
        $status = "";
        
        $id = ($this->input->post("id")) ? $this->input->post("id") : 0 ;
        $r = $this->jobseeker_fellowship->jobseekers_fellowships_get($id);
        
        if($r){
            $r = $this->jobseeker_fellowship->jobseekers_fellowships_delete($id);
            $status = "ok";
            $msg = "Deleted successfully";
        }
        else{
            $status = "error";
            $msg = "Data not found";
        }
            
        $array = array(
            "status" => $status,
            "msg" => $msg
        );
        echo json_encode($array); die;
    }
    
    public function profile_step_5(){
        $this->layout = "blank";
        $data = array();
        $session = $this->session->all_userdata();
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;
        
        $data["specialties"] = $this->get_specialties('parent');
        
        $where_array["jobseeker_id"] = $jobseeker_id;

        $data["practices"] = $this->jobseeker_practice->jobseekers_practices_get(0, $where_array);
        
        $data["total_practices"] = ( $data["practices"] ) ? count($data["practices"]) : 0 ;
        
    
        $html = $this->load->view('job_seeker/profile/step_5', $data, TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    
    
    public function add_practice_process(){
        $session = $this->session->all_userdata();
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;

        $this->layout = "blank";
        $msg = "";
        $status = "";
        $html = "";
        $this->load->library('form_validation');
        $config = array(
            array('field' => 'job_title', 'label' => 'Job title', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'city', 'label' => 'City', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'state', 'label' => 'State', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'hospital_name', 'label' => 'Hospital name', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'facility_type', 'label' => 'Facility type', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'start_date', 'label' => 'Start date', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'end_date', 'label' => 'End date', 'rules' => 'trim|required|xss_clean')
        );
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() === TRUE) {
            
            
            $save_data['jobseeker_id'] = $jobseeker_id;
            $save_data['job_title'] = $this->input->post('job_title');
            $save_data['city'] = $this->input->post('city');
            $save_data['state'] =  $this->input->post('state');
            $save_data['hospital_name'] = $this->input->post('hospital_name');
            $save_data['facility_type'] = $this->input->post('facility_type');
            $save_data['start_date'] = strtotime($this->input->post('start_date')) ;
            $save_data['end_date'] = strtotime($this->input->post('end_date')) ;
            $save_data['created_at'] = time();
            
            $id = $this->jobseeker_practice->jobseekers_practices_add($save_data);
            if($id){
                
                $status = "ok";
                
                $html = '<div class="row well-blue padding_5" data-val="'.$id.'" >
                        <div class="col col-sm-5 text-left">
                            <strong>'.$save_data['hospital_name'].'</strong><br>
                            '.$save_data["facility_type"].",".$save_data["job_title"].'
                        </div>
                        <div class="col col-sm-5 text-left">
                            '.date("Y-m-d",$save_data["start_date"])."-".date("Y-m-d",$save_data["end_date"]).'<br>
                            '.$save_data["city"].",".$save_data["state"].'
                        </div>
                        <div class="col col-sm-2 text-left">
                            <a class="remove_practice btn btn-danger btn-sm">Remove</a>
                        </div>
                    </div>';
            }
            else{
                $status = "error";
                $msg = "Oops something went wrong please try again";
            }
            
        } else {
            $msg = validation_errors();
            $status = "error";
        }
        
        

        $array = array(
            "status" => $status,
            "msg" => $msg,
            "html" => $html
        );
        echo json_encode($array); die;
    }
    
    public function delete_practice(){
        $this->layout = "blank";
        $msg = "";
        $status = "";
        
        $id = ($this->input->post("id")) ? $this->input->post("id") : 0 ;
        $r = $this->jobseeker_practice->jobseekers_practices_get($id);
        
        if($r){
            $r = $this->jobseeker_practice->jobseekers_practices_delete($id);
            $status = "ok";
            $msg = "Deleted successfully";
        }
        else{
            $status = "error";
            $msg = "Data not found";
        }
            
        $array = array(
            "status" => $status,
            "msg" => $msg
        );
        echo json_encode($array); die;
    }
    
    public function profile_step_6(){
        $this->layout = "blank";
        $data = array();
        $session = $this->session->all_userdata();
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;
        $where_array["jobseeker_id"] = $jobseeker_id;
        $data["specialties"] = $this->get_specialties('parent');
        
        $where_array["jobseeker_id"] = $jobseeker_id;
        $data["locations"] = $this->location->jobseekers_search_locations_get(0 , $where_array);

        $data['jobseeker'] = $this->jobseeker->jobseekers_get($jobseeker_id);
        
        $html = $this->load->view('job_seeker/profile/step_6', $data, TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    
    public function save_profile_step_6(){
        $session = $this->session->all_userdata();
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;

        $this->layout = "blank";
        $msg = "";
        $status = "";
        $this->load->library('form_validation');
        $config = array(
            array('field' => 'position_type', 'label' => 'Position type', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'service', 'label' => 'Service', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'institution_type', 'label' => 'Institution type', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'patient_per_day', 'label' => 'Patient Per Day', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'salary', 'label' => 'Salary', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'availability', 'label' => 'Availability', 'rules' => 'trim|required|xss_clean'),
        );
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() === TRUE) {
            
            $save_data['position_type'] = $this->input->post('position_type');
            $save_data['service'] = $this->input->post('service');
            $save_data['institution_type'] = $this->input->post('institution_type');
            $save_data['patient_per_day'] = $this->input->post('patient_per_day');
            $save_data['salary'] = $this->input->post('salary');
            $save_data['availability'] = $this->input->post('availability');
            
            $save_data['step'] = 6;
            $save_data['updated_at'] = time();
            
            $id = $jobseeker_id;
            if($id){
                $this->jobseeker->jobseekers_update($id , $save_data);
                $status = "ok";
            }
            else{
                $status = "error";
                $msg = "Oops something went wrong please try again";
            }
            
        } else {
            $msg = validation_errors();
            $status = "error";
        }
        
        

        $array = array(
            "status" => $status,
            "msg" => $msg
        );
        echo json_encode($array); die;
    }
    
    public function add_search_location(){
        $session = $this->session->all_userdata();
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;

        $this->layout = "blank";
        $msg = "";
        $status = "";
        $html = "";
        $this->load->library('form_validation');
        $config = array(
            array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required|xss_clean')
        );
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() === TRUE) {
            
            
            $save_data['jobseeker_id'] = $jobseeker_id;
            $save_data['name'] = $this->input->post('name');
            $save_data['created_at'] = time();
            
            $id = $this->location->jobseekers_search_locations_add($save_data);
            if($id){
                
                $status = "ok";
                $html = '<div class="well-blue padding_5" data-val="'.$id.'">
                            <div class="col col-sm-8 text-left">
                                '.$save_data['name'].'
                            </div>
                            <div class="col col-sm-2 text-right">
                                <a class="remove_location btn btn-danger btn-sm">Remove</a>
                            </div>
                            <div style="clear: both;"></div>
                        </div>';
            }
            else{
                $status = "error";
                $msg = "Oops something went wrong please try again";
            }
            
        } else {
            $msg = validation_errors();
            $status = "error";
        }
        
        

        $array = array(
            "status" => $status,
            "msg" => $msg,
            "html" => $html
        );
        echo json_encode($array); die;
    }
    
    public function delete_location(){
        $this->layout = "blank";
        $msg = "";
        $status = "";
        
        $id = ($this->input->post("id")) ? $this->input->post("id") : 0 ;
        $r = $this->location->jobseekers_search_locations_get($id);
        
        if($r){
            $r = $this->location->jobseekers_search_locations_delete($id);
            $status = "ok";
            $msg = "Deleted successfully";
        }
        else{
            $status = "error";
            $msg = "Data not found";
        }
            
        $array = array(
            "status" => $status,
            "msg" => $msg
        );
        echo json_encode($array); die;
    }
    function upload_document(){
        $this->layout = "blank";
        
        $jobseeker_id = ( $this->input->post("jobseeker_id") ) ? $this->input->post("jobseeker_id") : 0 ;
        
        $status = '';
        $msg = '';
        $this->load->library('custom_image_lib');
        
        if(isset($_FILES['file_document']['name'][0]) && $_FILES['file_document']['name'][0] != ""){
            
            $old_file = pathinfo($_FILES['file_document']['name'][0], PATHINFO_FILENAME);
            $old_ext = pathinfo($_FILES['file_document']['name'][0], PATHINFO_EXTENSION);

            $lib_config['new_file_name'] = $jobseeker_id."_document_".$old_file.".".$old_ext;
            $lib_config['allowed_types'] = '*';
            $this->custom_image_lib->config($lib_config);

            $file_document = $this->custom_image_lib->upload($_FILES['file_document'], 'uploads/jobseeker/file_document/');
            
            
            if($file_document){
                $status = "ok";
                $msg = "success";

                $save_data['file_document'] = $file_document[0];
                $this->jobseeker->jobseekers_update($jobseeker_id , $save_data);
            }
            else{
                $status = "error";
                $msg = "oops something went wrong";
            }
        }
        else{
            $status = "ok";
            $msg = "File not selected";
        }
        
        $rsp = array(
            "status" => $status,
            "msg" => $msg
        );
        
        echo json_encode($rsp); die;
        
    }
    
    
    public function profile_step_7(){
        $this->layout = "blank";
        $data = array();
        $session = $this->session->all_userdata();
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;

        $data['jobseeker'] = $this->jobseeker->jobseekers_get($jobseeker_id);
        
        $html = $this->load->view('job_seeker/profile/step_7', $data, TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    public function save_profile_step_7(){
        $session = $this->session->all_userdata();
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;

        $this->layout = "blank";
        $msg = "";
        $status = "";
         
            
        $save_data['criteria_1'] = (($this->input->post('criteria_1'))) ? $this->input->post('criteria_1') : "";
        $save_data['criteria_2'] = (($this->input->post('criteria_2'))) ? $this->input->post('criteria_2') : "";
        $save_data['criteria_3'] = (($this->input->post('criteria_3'))) ? $this->input->post('criteria_3') : "";
        $save_data['criteria_4'] = (($this->input->post('criteria_4'))) ? $this->input->post('criteria_4') : "";
        $save_data['ultimate_motivation'] = (($this->input->post('ultimate_motivation'))) ? $this->input->post('ultimate_motivation') : "";
        $save_data['selective_active_why'] = (($this->input->post('selective_active_why'))) ? $this->input->post('selective_active_why') : "";
        $save_data['ideal_job'] = (($this->input->post('ideal_job'))) ? $this->input->post('ideal_job') : "";

        $save_data['step'] = 7;
        $save_data['profile_complete'] = 1;
        $save_data['updated_at'] = time();

        $id = $jobseeker_id;
        if($id){
            $this->jobseeker->jobseekers_update($id , $save_data);
            $status = "ok";
        }
        else{
            $status = "error";
            $msg = "Oops something went wrong please try again";
        }
            

        $array = array(
            "status" => $status,
            "msg" => $msg
        );
        echo json_encode($array); die;
    }
    public function profile_step_8(){
        $this->layout = "blank";
        $data = array();
        $session = $this->session->all_userdata();
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;

        $data['jobseeker'] = $this->jobseeker->jobseekers_get($jobseeker_id);
        
        $html = $this->load->view('job_seeker/profile/step_8', $data, TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    
    function upload_profile_image(){
        $this->layout = "blank";
        
        $jobseeker_id = ( $this->input->post("jobseeker_id") ) ? $this->input->post("jobseeker_id") : 0 ;
        
        $status = '';
        $msg = '';
        $this->load->library('custom_image_lib');
        $lib_config['create_thumb'] = true;
        $lib_config['thumb_sizes'] = array(
           array('width' => 150, 'height' => 185)
        );
        $this->custom_image_lib->config($lib_config);
        
        $profile_images = $this->custom_image_lib->upload($_FILES['profile_image'], 'uploads/jobseeker/profiles/');
        
        if($profile_images){
            $file = pathinfo($profile_images[0], PATHINFO_FILENAME);
            $ext = pathinfo($profile_images[0], PATHINFO_EXTENSION);
            $thumbnail_name =  $file."_".$lib_config['thumb_sizes'][0]["width"]."_".$lib_config['thumb_sizes'][0]["height"].".".$ext;
            $thumbnail_name = $thumbnail_name."?v=".time();
            $status = "ok";
            $msg = "success";
            
            $save_data['profile_image'] = $profile_images[0];
            $this->jobseeker->jobseekers_update($jobseeker_id, $save_data);
        }
        else{
            $status = "error";
            $msg = "oops something went wrong";
        }
        
        $rsp = array(
            "status" => $status,
            "thumbnail_name" => $thumbnail_name,
            "image_name" => $profile_images[0],
            "msg" => $msg
        );
        
        echo json_encode($rsp); die;
        
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */