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
        $this->load->model('jobseeker_settings_model', 'settings');
        $this->load->model('jobseeker_notifications_model', 'notification');
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
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;
        $data["jobseeker"] = $this->jobseeker->jobseekers_get($jobseeker_id);
        
        $data["specialties"] = $this->get_specialties('parent');
        if( isset($data["jobseeker"]["specialty"]) && $data["jobseeker"]["specialty"] != ""){
            $data['sub_specialty'] = $this->specialty->specialties_get_by_type( "sub" , $data["jobseeker"]["specialty"] );
        }
        
        $where_array["jobseeker_id"] = $jobseeker_id; 
        $data["certifications"] = $this->jobseeker_certification->jobseekers_certifications_get(0, $where_array);
        $data["licences"] = $this->jobseeker_licence->jobseekers_licences_get(0, $where_array);
        $data["total_license"] = ( $data["licences"] ) ? count($data["licences"]) : 0 ;
        $data["total_cert"] = ( $data["certifications"] ) ? count($data["certifications"]) : 0 ;
        
        $data["degrees"] = $this->jobseeker_degree->jobseekers_degrees_get(0, $where_array);
        $data["residencys"] = $this->jobseeker_residency->jobseekers_residency_get(0, $where_array);
        $data["fellowships"] = $this->jobseeker_fellowship->jobseekers_fellowships_get(0, $where_array);
        $data["total_degrees"] = ( $data["degrees"] ) ? count($data["degrees"]) : 0 ;
        $data["total_residencys"] = ( $data["residencys"] ) ? count($data["residencys"]) : 0 ;
        $data["total_fellowships"] = ( $data["fellowships"] ) ? count($data["fellowships"]) : 0 ;
        $data["practices"] = $this->jobseeker_practice->jobseekers_practices_get(0, $where_array);
        $data["total_practices"] = ( $data["practices"] ) ? count($data["practices"]) : 0 ;
        
        $where_noti["is_read"] = "0";
        $where_noti["jobseeker_id"] = $jobseeker_id; 
        $data["total_notification"] = $this->notification->jobseeker_notifications_total( $where_noti );
        
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
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;
        
        
        $data["jobs_applies"] = $this->jobs->jobs_applied_by_jobseeker($jobseeker_id);
        
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
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;
        $data["jobseeker"] = $this->jobseeker->jobseekers_get($jobseeker_id);
        $match_data['salary'] = $data["jobseeker"]['salary'];
        
        $data["jobs"] = $this->jobs->top_matches_dashboard($match_data);
        
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
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;
        
        $data["setting"] = $this->settings->jobseekers_setttings_get_by_jobseeker( $jobseeker_id );
        $html = $this->load->view('job_seeker/dashboard/tab_settings', $data, TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    
    public function notification_page(){
        $this->layout = "blank";
        $data = array();
        
        $session = $this->session->all_userdata();
        if(!isset($session['jobseeker'])){
            redirect('job_seeker/signin');
        }
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;
        
        
        $data["notifications"] = $this->notification->jobseeker_notifications_get_by_jobseeker($jobseeker_id );
        
        $html = $this->load->view('job_seeker/dashboard/notification_page', $data, TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    public function notification_select_date(){
        $selected_date = $this->input->post("selected_date");
        $id = $this->input->post("id");
        $status = "";
        $msg = "";
        
        $r = $this->notification->jobseeker_notifications_get($id);
        if($r){
            $save["is_read"] = 1;
            $save["selected_date"] = 1;
            $this->notification->jobseeker_notifications_update($id , $save);
            $status = "ok";
            $msg = "saved successfully";
            
            $save_data["face_2_face_selected"] = $selected_date;
            $this->jobs->jobs_applied_update( $r['job_applied_id'], $save_data);
        }
        else{
            $status= "error";
            $msg = "oops something went wrong";
        }
        $rsp = array(
            "status" => $status,
            "msg" => $msg
        );
        
        echo json_encode($rsp); die;
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
        $html2 = "";
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
                $is_profile = $this->input->post("is_profile");
                if( isset($is_profile) && $is_profile == "true" ){
                    $html = '<div class="row-wrapper well-blue padding_5" data-val="'.$id.'" >
                        <div class="col col-sm-5 text-left">
                            <strong>'.$save_data['licence_type'].'</strong><br>
                            '.$save_data['licence_number'].'
                        </div>
                        <div class="col col-sm-4 text-left">
                            '.date("Y-m-d",$save_data['issued_on']).'<br>
                            '.$save_data['state'].'
                        </div>
                        <div class="col col-sm-2 text-left">
                            <a class="remove_license btn btn-danger btn-sm">Remove</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>';
                    $html2 = '<div class="row-wrapper well-blue padding_5" data-val="'.$id.'" >
                        <div class="col col-sm-5 text-left">
                            <strong>'.$save_data['licence_type'].'</strong><br>
                            '.$save_data['licence_number'].'
                        </div>
                        <div class="col col-sm-4 text-left">
                            '.date("Y-m-d",$save_data['issued_on']).'<br>
                            '.$save_data['state'].'
                        </div>
                        <div class="col col-sm-2 text-left">
                        </div>
                        <div class="clearfix"></div>
                    </div>';
                }
                else{
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
            "html" => $html,
            "html2" => $html2
            
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
        $html2 = "";
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
                $is_profile = $this->input->post("is_profile");
                if( isset($is_profile) && $is_profile == "true" ){
                    $html = '<div class="row-wrapper well-purple padding_5" data-val="'.$id.'" >
                            <div class="col col-sm-5 text-left">
                                <strong>'.$save_data['name'].'</strong><br>
                            </div>
                            <div class="col col-sm-4 text-left">
                                '.date("Y-m-d",$save_data['issued_on']).'  
                            </div>
                            <div class="col col-sm-2 text-left">
                                <a class="remove_certification btn btn-danger btn-sm">Remove</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>';
                    $html2 = '<div class="row-wrapper well-purple padding_5" data-val="'.$id.'" >
                            <div class="col col-sm-5 text-left">
                                <strong>'.$save_data['name'].'</strong><br>
                            </div>
                            <div class="col col-sm-4 text-left">
                                '.date("Y-m-d",$save_data['issued_on']).'  
                            </div>
                            <div class="col col-sm-2 text-left">
                            </div>
                            <div class="clearfix"></div>
                        </div>';
                }
                else{
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
            "html" => $html,
            "html2" => $html2
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
        $html2 = "";
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
                
                $is_profile = $this->input->post("is_profile");
                if( isset($is_profile) && $is_profile == "true" ){
                    $html = '<div class="row-wrapper well-blue padding_5" data-val="'.$id.'" >
                            <div class="col col-sm-5 text-left">
                                <strong>'.$save_data['degree'].'</strong><br>
                                '.$save_data["school"].$med_school.'
                            </div>
                            <div class="col col-sm-4 text-left">
                                '.date("Y",$save_data['year']).'<br>
                                '.$save_data["city"].",".$save_data["state"].",".$save_data["country"].'
                            </div>
                            <div class="col col-sm-2 text-left">
                                <a class="remove_degree btn btn-danger btn-sm">Remove</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>';
                    $html2 = '<div class="row-wrapper well-blue padding_5" data-val="'.$id.'" >
                            <div class="col col-sm-5 text-left">
                                <strong>'.$save_data['degree'].'</strong><br>
                                '.$save_data["school"].$med_school.'
                            </div>
                            <div class="col col-sm-4 text-left">
                                '.date("Y",$save_data['year']).'<br>
                                '.$save_data["city"].",".$save_data["state"].",".$save_data["country"].'
                            </div>
                            <div class="col col-sm-2 text-left">
                            </div>
                            <div class="clearfix"></div>
                        </div>';
                }
                else{
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
            "html" => $html,
            "html2" => $html2
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
        $html2 = "";
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
                
                $is_profile = $this->input->post("is_profile");
                if( isset($is_profile) && $is_profile == "true" ){
                    $html = '<div class="row-wrapper well-purple padding_5" data-val="'.$id.'" >
                        <div class="col col-sm-5 text-left">
                            <strong>'.$save_data['institution'].'</strong><br>
                            '.$save_data["city"].",".$save_data["state"].",".$save_data["country"].'
                        </div>
                        <div class="col col-sm-4 text-left">
                            '.$speciality_name.'<br>
                            '.date("Y-m-d",$save_data['date_from'])."-".date("Y-m-d",$save_data['date_to']).'
                        </div>
                        <div class="col col-sm-2 text-left">
                            <a class="remove_residency btn btn-danger btn-sm">Remove</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>';
                    $html2 = '<div class="row-wrapper well-purple padding_5" data-val="'.$id.'" >
                        <div class="col col-sm-5 text-left">
                            <strong>'.$save_data['institution'].'</strong><br>
                            '.$save_data["city"].",".$save_data["state"].",".$save_data["country"].'
                        </div>
                        <div class="col col-sm-4 text-left">
                            '.$speciality_name.'<br>
                            '.date("Y-m-d",$save_data['date_from'])."-".date("Y-m-d",$save_data['date_to']).'
                        </div>
                        <div class="col col-sm-2 text-left">
                            <a class="remove_residency btn btn-danger btn-sm">Remove</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>';
                }
                else{
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
            "html" => $html,
            "html2" => $html2
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
        $html2 = "";
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
                
                $is_profile = $this->input->post("is_profile");
                if( isset($is_profile) && $is_profile == "true" ){
                    $html = '<div class="row-wrapper well-yellow padding_5" data-val="'.$id.'" >
                        <div class="col col-sm-5 text-left">
                            <strong>'.$save_data['institution'].'</strong><br>
                            '.$save_data["city"].",".$save_data["state"].",".$save_data["country"].'
                        </div>
                        <div class="col col-sm-4 text-left">
                            '.$speciality_name.'<br>
                            '.date("Y-m-d",$save_data['date_from'])." - ".date("Y-m-d",$save_data['date_to']).'
                        </div>
                        <div class="col col-sm-2 text-left">
                            <a class="remove_fellowship btn btn-danger btn-sm">Remove</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>';
                    $html2 = '<div class="row-wrapper well-yellow padding_5" data-val="'.$id.'" >
                        <div class="col col-sm-5 text-left">
                            <strong>'.$save_data['institution'].'</strong><br>
                            '.$save_data["city"].",".$save_data["state"].",".$save_data["country"].'
                        </div>
                        <div class="col col-sm-4 text-left">
                            '.$speciality_name.'<br>
                            '.date("Y-m-d",$save_data['date_from'])." - ".date("Y-m-d",$save_data['date_to']).'
                        </div>
                        <div class="col col-sm-2 text-left">
                        </div>
                        <div class="clearfix"></div>
                    </div>';
                }
                else{
                    $html = '<div class="row well-yellow padding_5" data-val="'.$id.'" >
                        <div class="col col-sm-5 text-left">
                            <strong>'.$save_data['institution'].'</strong><br>
                            '.$save_data["city"].",".$save_data["state"].",".$save_data["country"].'
                        </div>
                        <div class="col col-sm-5 text-left">
                            '.$speciality_name.'<br>
                            '.date("Y-m-d",$save_data['date_from'])." - ".date("Y-m-d",$save_data['date_to']).'
                        </div>
                        <div class="col col-sm-2 text-left">
                            <a class="remove_fellowship btn btn-danger btn-sm">Remove</a>
                        </div>
                    </div>';
                }
                
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
            "html" => $html,
            "html2" => $html2
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
        $html2 = "";
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
                
                $is_profile = $this->input->post("is_profile");
                if( isset($is_profile) && $is_profile == "true" ){
                    $html = '<div class="row-wrapper well-blue padding_5" data-val="'.$id.'" >
                            <div class="col col-sm-5 text-left">
                                <strong>'.$save_data['hospital_name'].'</strong><br>
                                '.$save_data["facility_type"].",".$save_data["job_title"].'
                            </div>
                            <div class="col col-sm-4 text-left">
                                '.date("Y-m-d",$save_data["start_date"])." - ".date("Y-m-d",$save_data["end_date"]).'<br>
                                '.$save_data["city"].",".$save_data["state"].'
                            </div>
                            <div class="col col-sm-2 text-left">
                                <a class="remove_practice btn btn-danger btn-sm">Remove</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>';
                    $html2 = '<div class="row-wrapper well-blue padding_5" data-val="'.$id.'" >
                            <div class="col col-sm-5 text-left">
                                <strong>'.$save_data['hospital_name'].'</strong><br>
                                '.$save_data["facility_type"].",".$save_data["job_title"].'
                            </div>
                            <div class="col col-sm-4 text-left">
                                '.date("Y-m-d",$save_data["start_date"])." - ".date("Y-m-d",$save_data["end_date"]).'<br>
                                '.$save_data["city"].",".$save_data["state"].'
                            </div>
                            <div class="col col-sm-2 text-left">
                            </div>
                            <div class="clearfix"></div>
                        </div>';
                }
                else{
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
            "html" => $html,
            "html2" => $html2
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
            $lib_config['allowed_types'] = 'pdf|doc|docx';
            
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
                $msg = "Please Upload file pdf or doc type";
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
    
    public function update_settings(){
        $this->layout = "blank";
        
        $status = "error";
        $msg = "oops something went wrong, please try again";
        
        $session = $this->session->all_userdata();
        
        if(!isset($session['jobseeker'])){
            redirect('job_seeker/sigin');
        }
        $jobseeker = $session['jobseeker'];
        $save_data['jobseeker_id'] = $jobseeker['id'];
        
        $save_data["when_match_email"] = ($this->input->post("when_match_email") == "true") ?  1 : 0 ;
        $save_data["when_match_phone"] = ($this->input->post("when_match_phone") == "true") ?  1 : 0 ;
        $save_data["when_interview_offer_email"] = ($this->input->post("when_interview_offer_email") == "true") ?  1 : 0 ;
        $save_data["when_interview_offer_phone"] = ($this->input->post("when_interview_offer_phone") == "true") ?  1 : 0 ;
        $save_data["when_face_2_face_offer_email"] = ($this->input->post("when_face_2_face_offer_email") == "true") ?  1 : 0 ;
        $save_data["when_face_2_face_offer_phone"] = ($this->input->post("when_face_2_face_offer_phone") == "true") ?  1 : 0 ;
        $save_data["when_job_offer_email"] = ($this->input->post("when_job_offer_email") == "true") ?  1 : 0 ;
        $save_data["when_job_offer_phone"] = ($this->input->post("when_job_offer_phone") == "true") ?  1 : 0 ;
        $save_data["when_status_update_email"] = ($this->input->post("when_status_update_email") == "true") ?  1 : 0 ;
        $save_data["when_status_update_phone"] = ($this->input->post("when_status_update_phone") == "true") ?  1 : 0 ;
        
        

        $setting = $this->settings->jobseekers_setttings_get_by_jobseeker($save_data['jobseeker_id']);

        if($setting){
            $save_data['updated_at'] = time();
            unset($save_data['jobseeker_id']);
            $this->settings->jobseekers_setttings_update($setting['id'], $save_data);
            $status = "ok";
            $msg = "saved successfully";
        }
        else{
            $save_data['created_at'] = time();
            $this->settings->jobseekers_setttings_add($save_data);
            $status = "ok";
            $msg = "saved successfully";
        }
        
        $rsp = array(
            "status" => $status,
            "msg" => $msg
        );
        echo json_encode($rsp); die;
    }
    public function update_jobseeker_emails(){
        $this->layout = "blank";
        
        $status = "error";
        $msg = "oops something went wrong, please try again";
        
        $session = $this->session->all_userdata();
        if(!isset($session['jobseeker'])){
            redirect('job_seeker/sigin');
        }
        $jobseeker = $session['jobseeker'];
        $jobseeker_id = $jobseeker['id'];
        
        $this->load->library('form_validation');
        $config = array(
            array('field' => 'change_email', 'label' => 'Email', 'rules' => 'trim|required|valid_email|xss_clean')
        );
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() === TRUE) {
        
            $save_data["email"] = $this->input->post("change_email");

            $email_exist = $this->jobseeker->get_jobseekers_email_for_edit($jobseeker_id, $save_data["email"]);
            if(!$email_exist){
                
                $this->jobseeker->jobseekers_update($jobseeker_id , $save_data);
                $status = "ok";
                $msg = "saved successfully";
                
            }
            else{
                $status = "error";
                $msg = "email already exist";
            }
            
        } else {
            $msg = validation_errors();
            $status = "error";
        }
        
        $rsp = array(
            "status" => $status,
            "msg" => $msg
        );
        echo json_encode($rsp); die;
    }
    public function update_jobseeker_password(){
        $this->layout = "blank";
        
        $status = "error";
        $msg = "oops something went wrong, please try again";
        
        $session = $this->session->all_userdata();
        if(!isset($session['jobseeker'])){
            redirect('job_seeker/sigin');
        }
        $jobseeker = $session['jobseeker'];
        $jobseeker_id = $jobseeker['id'];
        
        $this->load->library('form_validation');
        $config = array(
            array('field' => 'change_password', 'label' => 'Email', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'confirm_change_password', 'label' => 'Email', 'rules' => 'trim|required|xss_clean')
        );
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() === TRUE) {
        
            $save_data["password"] = md5($this->input->post("change_password"));

            $employer_exist = $this->jobseeker->jobseekers_get($jobseeker_id);
            if($employer_exist){
                
                $this->jobseeker->jobseekers_update($jobseeker_id , $save_data);
                $status = "ok";
                $msg = "saved successfully";
                
            }
            else{
                $status = "error";
                $msg = "Unable to save password";
            }
            
        } else {
            $msg = validation_errors();
            $status = "error";
        }
        
        $rsp = array(
            "status" => $status,
            "msg" => $msg
        );
        echo json_encode($rsp); die;
    }
    
    public function contact_info_save(){
        $session = $this->session->all_userdata();
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;

        $this->layout = "blank";
        $msg = "";
        $status = "";
        $html = "";
        $this->load->library('form_validation');
        $config = array(
            array('field' => 'first_name', 'label' => 'first name', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'last_name', 'label' => 'last name', 'rules' => 'trim|required|xss_clean'),
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
            $save_data['address'] = $this->input->post('address');
            $save_data['apt'] = $this->input->post('apt');
            $save_data['city'] = $this->input->post('city');
            $save_data['state'] = $this->input->post('state');
            $save_data['zip'] = $this->input->post('zip');
            $save_data['phone'] = $this->input->post('phone');
            $save_data['alt_phone'] = $this->input->post('alt_phone');
            
            $id = $jobseeker_id;
            if($id){
                $this->jobseeker->jobseekers_update($id , $save_data);
                $status = "ok";
                $jobseeker = $this->jobseeker->jobseekers_get($jobseeker_id);
                
                $html = '<div style="float: left; width: 85%; padding-left: 10px;">
                    <h1 class="profile_heading1" >'.$jobseeker['first_name'].' '.$jobseeker['last_name'].'</h1>
                    <div class="contact_info_text" >
                        <span >'.$jobseeker['address'].'</span> '.$jobseeker['city'].",".$jobseeker['state'].'
                    </div>
                </div>
                <div>
                    <a id="contact_info_edit_link" class="edit_link"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                </div>
                <div class="clearfix"></div>';
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
    public function profession_save(){
        $session = $this->session->all_userdata();
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;

        $this->layout = "blank";
        $msg = "";
        $status = "";
        $html = "";
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
            
            $id = $jobseeker_id;
            if($id){
                $this->jobseeker->jobseekers_update($id , $save_data);
                $status = "ok";
                
                $jobseeker = $this->jobseeker->jobseekers_get($jobseeker_id);
                
                $spec_name = get_specialties($jobseeker["specialty"]);
                $spec_name = $spec_name['name'];
                $sub_spec_name = get_specialties($jobseeker["sub_specialty"]);
                $sub_spec_name = $sub_spec_name['name'];
                $html = '<div style="float: left; width: 85%; padding-left: 10px; font-size: 15px;">
                    <h3 class="profile_heading2" >Profession (#'.$jobseeker["npi_number"].')</h3>
                    <div style="padding-left: 25px;">
                        <ul>
                            <li class="ng-binding">
                                Profession: Physician
                            </li>
                            <li class="ng-binding">
                                Specialty: '.$spec_name.'
                            </li>
                            <li class="ng-binding">
                                Sub Specialty: '.$sub_spec_name.'
                            </li>
                            <li class="ng-binding">
                                Experience Level: '.str_replace("_"," ",ucfirst($jobseeker["experince_level"])).'
                            </li>
                        </ul>
                    </div>
                </div>
                <div>
                    <a id="profession_edit_link" class="edit_link"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                </div>
                <div class="clearfix"></div>';
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
    
    public function select_date_face2face($job_applied_id = 0, $selected_date = ""){
        
        if($job_applied_id != 0 && $selected_date != ""){
            
            $apply = $this->jobs->jobs_applied_get($job_applied_id);
            if($apply){
                if($apply["face_2_face_selected"] == 0){
                    $possible_date = array("date_1","date_2","date_3");
                    if(in_array($selected_date, $possible_date)){
                        $key = "f2f_".$selected_date;
                        $date = $apply[$key];
                        $save_data["face_2_face_selected"] = $date;
                        $this->jobs->jobs_applied_update($apply["id"] , $save_data);
                        
                        // delete notification for select date 
                        $where['job_applied_id'] = $apply["id"];
                        $notification = $this->notification->jobseeker_notifications_get(0 , $where);
                        if($notification){
                            $save["is_read"] = 1;
                            $save["selected_date"] = 1;
                            $this->notification->jobseeker_notifications_update($notification[0]['id'] , $save);
                        }
                        
                        $this->session->set_flashdata("select_date_status","ok");
                        $this->session->set_flashdata("select_date_msg","You have successfully selected the date ");
                        
                        // check already login
                        $session = $this->session->all_userdata();
                        if (isset($session['jobseeker'])) {
                            redirect('job_seeker_dashboard');
                        }
                        $jobseeker = $this->jobseeker->jobseekers_get($apply['jobseeker_id']);
                        if ($jobseeker) {
                            unset($jobseeker['password']);

                            $this->session->set_userdata('user_id', $jobseeker['id']);
                            $this->session->set_userdata('user_type', 'jobseeker');
                            $this->session->set_userdata('jobseeker', $jobseeker);
                            redirect('job_seeker_dashboard');
                        }
                    }
                }
                
            }
            redirect('job_seeker/signin');
            
        }
        redirect('job_seeker/signin');
        
    }
    
    function offer_interview($status = "", $job_applied_id = 0){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        if($status != "" && $job_applied_id != 0){
            
            // interview accept
            if($status == "accept"){
                
                require_once APPPATH.'libraries/RIVS/class.rivs.php';
	
                $Rivs = new RIVS('o37w1r7suxll4aue3kcf3g179qdpf1v44206u8yo5j');
                
                $rivs_jobs = $this->db->get("rivs_jobs");
                
                if($rivs_jobs->num_rows() == 0){
                    $oResult = $Rivs->call('job.list');
                    if( isset($oResult["aaOutput"]) && count($oResult["aaOutput"]) > 0 ){
                        $jobs = $oResult["aaOutput"]["aaJobs"];

                        foreach($jobs as $key=>$job){
                            if(isset($job["sStatus"]) && $job["sStatus"] == "Active"){
                                $job_ids[$key]['job_id'] = $job['iId'];
                            }
                        }
                        $this->db->insert_batch("rivs_jobs",$job_ids);
                        
                    }
                }
                $q = "SELECT * FROM rivs_jobs ORDER BY RAND() LIMIT 1";
                $r = $this->db->query($q);
                $row = $r->row_array();
                $rand_job_id = $row['job_id'];
                
                // get insert if not application id
                
                $job_apply = $this->jobs->jobs_applied_get($job_applied_id);

                if($job_apply){
                    
                    $already = $this->if_already_accepted_interview($job_applied_id);
                    if($already){
                        redirect('job_seeker_dashboard');
                    }
                    
                    $jobseeker = $this->jobseeker->jobseekers_get($job_apply['jobseeker_id']);
                    
                    if($jobseeker){
                        
                        $rvis_app_id = $jobseeker["rvis_app_id"];
                        if($rvis_app_id == "0"){

                            $req_data["iJob"] = $rand_job_id;
                            $req_data["iStatus"] = "1";
                            $req_data["sNameFirst"] = $jobseeker['first_name'];
                            $req_data["sNameLast"] = $jobseeker['last_name'];
                            $req_data["sEmail"] = $jobseeker['email'];
                            $req_data["sIp"] = $this->input->ip_address();
                            $req_data["sBrowser"] = $this->input->user_agent();

                            $result = $Rivs->call('application.create',$req_data);

                            if( isset($result['aaOutput']) ){
                                $rsp = $result['aaOutput'];
                                if( isset($rsp['iApplication']) ){
                                    $save_data["rvis_app_id"] = $rsp['iApplication'];
                                    $this->jobseeker->jobseekers_update($job_apply['jobseeker_id'], $save_data);
                                    $rvis_app_id = $rsp['iApplication'];
                                }
                            }
                        }
                        
                        // API call for video interview
                        if( isset($rvis_app_id) && $rvis_app_id != "" ) { 
                            $result = NULL;
                            $req_data["iApplication"] = $rvis_app_id;
                            $req_data["bNotify"] = TRUE;
                            $result = $Rivs->call("interviewautomatedvideo.create",$req_data);

                            if( isset($result['aaOutput']) ){
                                $rsp = $result['aaOutput'];

                                if( isset( $rsp["iId"] ) && isset( $rsp["sLink"] ) ){
                                    
                                    $interview_data["job_applied_id"] = $job_apply["id"];
                                    $interview_data["rvis_app_id"] = $rvis_app_id;
                                    $interview_data["rvis_video_id"] = $rsp["iId"];
                                    $interview_data["rvis_link"] = $rsp["sLink"];
                                    $interview_data["created_at"] = time();
                                    $this->db->insert("jobseekers_video_interview",$interview_data);
                                    
                                    $jobseeker = $this->jobseeker->jobseekers_get($job_apply['jobseeker_id']);
                                    $email_data['to'] = $jobseeker['email'];
                                    $email_data['to'] = 'numan.hassan@purelogics.net';
                                    $email_data['subject'] = "Job Interview Details";
                                    $email_data['link'] = $interview_data["rvis_link"];
                                    $job = $this->jobs->jobs_get($job_apply['job_id']);

                                    $patterns = array(
                                        '{JOB_HEADING}' => $job['job_headline'],
                                        '{JOB_INTERNAL_ID}' => $job['internal_id']
                                    );
                                    send_template_email("job/video_link",$email_data, $patterns);
                                }
                            }
                        }
                        
                        
                        $this->session->set_flashdata("select_date_status","ok");
                        $this->session->set_flashdata("select_date_msg","You have successfully accepted the interview ");
                        
                        // check already login
                        $session = $this->session->all_userdata();
                        if (isset($session['jobseeker'])) {
                            redirect('job_seeker_dashboard');
                        }
                        if ($jobseeker) {
                            unset($jobseeker['password']);

                            $this->session->set_userdata('user_id', $jobseeker['id']);
                            $this->session->set_userdata('user_type', 'jobseeker');
                            $this->session->set_userdata('jobseeker', $jobseeker);
                            redirect('job_seeker_dashboard');
                        }
                        

                    }
                }
                
            }
            else{
                redirect('job_seeker_dashboard');
            }
        }
    }
    function if_already_accepted_interview($job_applied_id){
        $this->db->where("job_applied_id",$job_applied_id);
        $r = $this->db->get("jobseekers_video_interview");
        if($r->num_rows() > 0){
            return TRUE;
        }
        return FALSE;
    }
    
    function offer_interview_webhook(){
        
//        $post = $this->input->post();
        $data['data'] =  "test";
        $this->db->insert("webhook_logs",$data);
        
        // suppose video ID 
        $rvis_video_id = 0;
        
        $this->db->where("rvis_video_id",$rvis_video_id);
        $this->db->limit("1");
        $r = $this->db->get("jobseekers_video_interview");
        if($r->num_rows() > 0){
            $row = $r->row_array();
            
            // mark interview link as read
            $interview_data['is_complete'] = 1;
            $this->db->where("id",$row['id']);
            $this->db->update("",$interview_data);
            
            
            if( isset($row['job_applied_id']) && $row['job_applied_id'] != "" ){
                
                $apply = $this->jobs->jobs_applied_get($row['job_applied_id'] );
                if($apply){
                    $update_data["interview"] = 1;
                    $update_data["interview_complete"] = 1;
                    $this->jobs->jobs_applied_update($apply['id'] , $update_data);
                    $jobseeker_id = $apply["jobseeker_id"];
                    $id = $apply["id"];
                    
                    $q = "SELECT jobs_applied.* FROM jobs_applied WHERE jobseeker_id = '$jobseeker_id' AND id != '$id' AND id IN ( SELECT job_applied_id FROM jobseekers_video_interview )  ";
                    $r = $this->db->query($q);
                    if($r->num_rows() > 0){
                        $applies = $r->result_array();
                        foreach($applies as $apply){
                            $update_data = array();
                            $update_data["matched"] = 1;
                            $update_data["interview"] = 1;
                            $update_data["interview_complete"] = 1;
                            $this->jobs->jobs_applied_update($apply['id'] , $update_data);
                            
                            // get employer detail and mail him
                            $this->load->model('employer_model', 'employer');
                            $employer = $this->employer->employers_get($apply['employer_id']);
                            $jobseeker = $this->employer->employers_get($apply['jobseeker_id']);
                            if($employer && $jobseeker){
                                // email employer
                                
                                $email_data['to'] = $employer['email'];
                                $email_data['to'] = 'numan.hassan@purelogics.net';
                                $email_data['subject'] = "Job Interview Complete";
                                $email_data['link'] = $interview_data["rvis_link"];
                                $job = $this->jobs->jobs_get($apply['job_id']);

                                $patterns = array(
                                    '{JOB_HEADING}' => $job['job_headline'],
                                    '{JOB_INTERNAL_ID}' => $job['internal_id']
                                );
                                send_template_email("job/interview_complete",$email_data, $patterns);
                                
                            }
                            
                        }
                        
                    }
                }
            }
        }
        
        return true;
        
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */