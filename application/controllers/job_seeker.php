<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Job_seeker extends MY_Job_seekerController {

    function __construct() {
        parent::__construct();
        $this->load->model('jobseeker_model', 'jobseeker');
        $this->load->model('jobs_model', 'jobs');
         
    }

    public function index() {
        $this->layout = "job_seeker";
        
        // check already login
        $session = $this->session->all_userdata();
        if (isset($session['jobseeker'])) {
            redirect('job_seeker_dashboard');
        }
        
        $data["states"] = $this->get_states();
        $data["locations"] = get_locations_home_page();
        
        $this->load->view('job_seeker/home', $data);
    }
    
    public function let_start_popup(){
        $this->layout = "blank";
        $data["specialties"] = $this->get_specialties('parent');
        

        $html = $this->load->view("job_seeker/lets_get_started_popup", $data , TRUE);
        
        $rsp = array( "html" => $html );
        echo json_encode($rsp);
        die;
    }
    
    public function match(){
        $this->layout = "job_seeker";
        // check already login
        $session = $this->session->all_userdata();
        if (isset($session['jobseeker'])) {
            redirect('job_seeker_dashboard');
        }
        require 'application/libraries/Sajari/sajari.php';
        $sajari = new Sajari();
        $data = array();
        
        $data = $this->input->post();
        
        if($this->input->post()){

            $meta = array();
            $scales = "";
            $data['kilometer'] = 0;
            
            if(isset($data['specialty']) && $data['specialty'] != ""){
                $meta["specialty"]  = $data["specialty"];
            }
            if(isset($data['sub_specialty']) && $data['sub_specialty'] != ""){
                $meta["sub_specialty"]  = $data["sub_specialty"];
            }

            if(isset($data['salary_range']) && $data['salary_range'] != ""){
                $salary_range_array = explode("-", $data['salary_range']);
                $min = $salary_range_array[0];
                $min = $min * 1000;
                $meta["salary_range_min"]  = $min;

                $scales = 'salary_range_min,'.$min.',26000,1,0';

                if(isset($salary_range_array[1])){
                    $max = $salary_range_array[1];
                    $max = $max * 1000;
                    $meta["salary_range_max"]  = $max;


                    $scales .= '|salary_range_max,'.$max.',26000,1,0';
                }
            }

            if( isset($data['departmant_size']) && $data['departmant_size']!="" ){
                $meta["departmant_size"]  = $data["departmant_size"];
            }


            if( (isset($data['state']) && $data['state'] != "") && (isset($data['miles']) && $data['miles'] != "") ){
                // miles to kilometer
                $kilometer = $data['miles'] * 1.60934;
                $data['kilometer'] = $kilometer;
                $city = $data['state'];
                $this->load->library("google/google_geolocation");
                $location = $this->google_geolocation->get_logitute_latitude( array( "address"=> $city."+US" ) );

                if(isset($location['lat']) && isset($location['lng'])){
                    $lat = $location['lat'];
                    $lng = $location['lng'];

                    $meta['lat'] = $lat;
                    $meta['lng'] = $lng;
                }
            }

            $params = array(
                'meta' => $meta,
                'scales' => $scales
            );

            $rsp = $sajari->sajari_search($params);

            $data["jobs_data"] = FALSE;
            if( isset($rsp["response"]["results"]) ){
                $data["jobs_data"] = $rsp["response"]["results"];
            }

    //        $data["jobs"] = $this->jobs->top_matches($data);

            $this->load->view('job_seeker/match', $data);

        }
        else{
            redirect("job_seeker");
        }
        
    }
    public function get_top_match_job_details(){
        $this->layout = "blank";
        $data = array();
        $session = $this->session->all_userdata();
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;
        
        $data = $this->input->post();
        $data["row"] = $this->jobs->jobs_get_details($data['id']);
        
        $data["saved"] = false;
        if($jobseeker_id != 0){
            $where["jobseeker_id"] = $jobseeker_id;
            $where["job_id"] = $data['id'];
            $where["saved"] = 1;
            $data["saved"] = $this->jobs->jobseekers_jobs_status_get(0 , $where);
        }
        
        $html = $this->load->view('job_seeker/job_details', $data, TRUE);
        
        $rsp = array( "html" => $html );
        echo json_encode($rsp);
        die;
    }
    public function do_not_interested_job_btn(){
        $this->layout = "blank";
        $data = array();
        $msg = "";
        $status = "";
        $session = $this->session->all_userdata();
        if(!isset($session['jobseeker'])){
            redirect('job_seeker/signin');
        }
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;
        
        $job_id = $this->input->post("job_id");
        if($job_id){
            
            $save_data["jobseeker_id"] = $jobseeker_id;
            $save_data["job_id"] = $job_id;
            $save_data["not_interested"] = 1;
            
            // jobseekers_jobs_status
            $where["jobseeker_id"] = $jobseeker_id;
            $where["job_id"] = $job_id;
            $r = $this->jobs->jobseekers_jobs_status_get(0 , $where);
            if($r){
                $id = $r['id'];
                unset($save_data["jobseeker_id"]);
                unset($save_data["job_id"]);
                $this->jobs->jobseekers_jobs_status_update($id , $save_data);
                $status = "ok";
            }
            else{
                $this->jobs->jobseekers_jobs_status_add($save_data);
                $status = "ok";
            }
            
        }
        
        
        $rsp = array( "status" => $status );
        echo json_encode($rsp);
        die;
    }
    public function do_save_job_btn(){
        $this->layout = "blank";
        $data = array();
        $msg = "";
        $status = "";
        $session = $this->session->all_userdata();
        if(!isset($session['jobseeker'])){
            redirect('job_seeker/signin');
        }
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;
        
        $job_id = $this->input->post("job_id");
        if($job_id){
            $job = $this->jobs->jobs_get($job_id);
            $save_data["jobseeker_id"] = $jobseeker_id;
            $save_data["job_id"] = $job_id;
            $save_data["saved"] = 1;
            
            // jobseekers_jobs_status
            $where["jobseeker_id"] = $jobseeker_id;
            $where["job_id"] = $job_id;
            $r = $this->jobs->jobseekers_jobs_status_get(0 , $where);
            if($r){
                $id = $r['id'];
                unset($save_data["jobseeker_id"]);
                unset($save_data["job_id"]);
                $this->jobs->jobseekers_jobs_status_update($id , $save_data);
                $status = "ok";
            }
            else{
                $this->jobs->jobseekers_jobs_status_add($save_data);
                $status = "ok";
            }
            if($status == "ok"){
                
                $job_applied_data['employer_id'] = $job["employer_id"];
                $job_applied_data['jobseeker_id'] = $jobseeker_id; 
                $job_applied_data['job_id'] = $job_id;
                $job_applied_data['applied'] = 0;
                $job_applied_data['matched'] = 0;
                $job_applied_data['interview'] = 0;
                $job_applied_data['interview_complete'] = 0;
                $job_applied_data['face_2_face'] = 0;
                $job_applied_data['job_offer'] = 0;
                $job_applied_data['created_at'] = time();
                $this->jobs->jobs_applied_add($job_applied_data);
            }
            
        }
        
        $rsp = array( "status" => $status );
        echo json_encode($rsp);
        die;
    }
    public function do_apply_job_btn(){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        $this->layout = "blank";
        $data = array();
        $msg = "";
        $status = "";
        $session = $this->session->all_userdata();
        if(!isset($session['jobseeker'])){
            redirect('job_seeker/signin');
        }
        $jobseeker_id = (isset($session['jobseeker']['id'])) ? $session['jobseeker']['id'] : 0;
        
        $job_id = $this->input->post("job_id");
        if($job_id){
            $job = $this->jobs->jobs_get($job_id);
            $save_data["jobseeker_id"] = $jobseeker_id;
            $save_data["job_id"] = $job_id;
            $save_data["applied"] = 1;
            
            // jobseekers_jobs_status
            $where["jobseeker_id"] = $jobseeker_id;
            $where["job_id"] = $job_id;
            $r = $this->jobs->jobseekers_jobs_status_get(0 , $where);
            if($r){
                $id = $r[0]['id'];
                unset($save_data["jobseeker_id"]);
                unset($save_data["job_id"]);
                $this->jobs->jobseekers_jobs_status_update($id , $save_data);
                $status = "ok";
            }
            else{
                $this->jobs->jobseekers_jobs_status_add($save_data);
                $status = "ok";
            }

            if($status == "ok"){
                $job_applied_data['employer_id'] = $job["employer_id"];
                $job_applied_data['jobseeker_id'] = $jobseeker_id; 
                $job_applied_data['job_id'] = $job_id;
                $job_applied_data['applied'] = 1;
                $job_applied_data['matched'] = 0;
                $job_applied_data['interview'] = 0;
                $job_applied_data['interview_complete'] = 0;
                $job_applied_data['face_2_face'] = 0;
                $job_applied_data['job_offer'] = 0;
                $job_applied_data['created_at'] = time();
                
                $where_2['employer_id'] = $job["employer_id"];
                $where_2['jobseeker_id'] = $jobseeker_id; 
                $where_2['job_id'] = $job_id;
                
                $job_applied = $this->jobs->jobs_applied_get(0 , $where_2);
                if($job_applied){
                    $update_data["applied"] = 1;
                    $this->jobs->jobs_applied_update($job_applied[0]["id"] , $update_data);
                }
                else{
                    $this->jobs->jobs_applied_add($job_applied_data);
                }
                
                // send email to employer for job apply
                $this->load->model('employers_settings_model', 'employer_settings');
                $this->load->model('employer_model', 'employer');
                        
                $setting = $this->employer_settings->employers_setttings_get_by_employer($job_applied_data['employer_id']);
                $send_email = TRUE;
                if( (isset($setting['when_status_update_email']) && $setting['when_status_update_email'] == 1) || $setting == FALSE ){
                    $send_email = TRUE;
                }
                else{
                    $send_email = FALSE;
                }
                if($send_email){
                    $employer = $this->employer->employers_get($job_applied_data['employer_id']);
                    $jobseeker = $this->jobseeker->jobseekers_get($job_applied_data['jobseeker_id']);
                    $email_data['to'] = $employer['email'];
                    $email_data['subject'] = "Job Applied";

                    $job = $this->jobs->jobs_get($job_applied_data['job_id']);
                    $patterns = array(
                        '{JOBSEEKER_NAME}' => $jobseeker['first_name'].' '.$jobseeker['last_name'],
                        '{JOB_HEADING}' => $job['job_headline'],
                        '{JOB_INTERNAL_ID}' => $job['internal_id']
                    );
                    send_template_email("job/interview_accept",$email_data, $patterns);
                }
                $send_text = TRUE;
                if( (isset($setting['when_status_update_phone']) && $setting['when_status_update_phone'] == 1) || $setting == FALSE ){
                    $send_text = TRUE;
                }
                else{
                    $send_text = FALSE;
                }
                if($send_text){
                    $employer = $this->employer->employers_get($job_applied_data['employer_id']);
                    $jobseeker = $this->jobseeker->jobseekers_get($job_applied_data['jobseeker_id']);
                    $job = $this->jobs->jobs_get($job_applied_data['job_id']);

                    $this->load->library('twilio');
                    $from = '+13126354633';
                    $to = $employer['billing_phone'];

                    $message = $jobseeker['first_name'].' '.$jobseeker['last_name']."have applied for the job"."\n";
                    $message .= "Job Heading : ".$job['job_headline']."\n";
                    $message .= "Job Internal ID : ".$job['internal_id']."\n";
                    $response = $this->twilio->sms($from, $to, $message);
                }
                
            }
            
        }
        
        $rsp = array( "status" => $status );
        echo json_encode($rsp);
        die;
    }
    public function job_applied_popup(){
        $this->layout = "blank";
        $data = array();
        
        $session = $this->session->all_userdata();
        if(!isset($session['jobseeker'])){
            redirect('job_seeker/signin');
        }
        
        $html = $this->load->view('job_seeker/job_applied_popup', $data, TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    
    public function signup(){
        // check already login
        $session = $this->session->all_userdata();
        if (isset($session['jobseeker'])) {
            redirect('job_seeker_dashboard');
        }
        
        
        $this->layout = "job_seeker";
        $data = array();
        $msg = "";
        $status = "";
        
        if($this->input->post()){
            
            $data = $this->input->post();
            
            $this->load->library('form_validation');    
            $config = array(
                array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'trim|required|xss_clean'),
                array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'trim|required|xss_clean'),
                array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|xss_clean|callback_jobseeker_email_exist'),
                array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|xss_clean'),
                array('field' => 'phone', 'label' => 'Phone', 'rules' => 'trim|required|xss_clean')
            );
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() === TRUE) {
                
                
                $save_data['first_name'] = $this->db->escape_str($this->input->post("first_name"));
                $save_data['last_name'] = $this->db->escape_str($this->input->post("last_name"));
                $save_data['email'] = $this->db->escape_str($this->input->post('email'));
                $save_data['password'] = md5($this->input->post("password"));
                $save_data['phone'] = $this->db->escape_str($this->input->post('phone'));
                
                $save_data['created_at'] = time();
                
                $jobseeker_id = $this->jobseeker->jobseekers_add($save_data);

                // Send Register email Here
                $email_data['to'] = $save_data['email'];
                $email_data['subject'] = "Welcome";
                $email_data["password"] = $this->input->post("password");

                $patterns = array(
                    '{EMAIL}' => $save_data['email'],
                    '{PASSWORD}' => $email_data["password"]
                );
                send_template_email("job_seeker/register",$email_data, $patterns);

                if($jobseeker_id > 0){
                    $status = 'ok';
                    $msg = 'Signup successfully';
                    
                    $jobseeker = $this->jobseeker->jobseekers_get($jobseeker_id);
                    unset($jobseeker['password']);
                    $this->session->set_userdata('user_id', $jobseeker['id']);
                    $this->session->set_userdata('user_type', 'jobseeker');
                    $this->session->set_userdata('jobseeker', $jobseeker);
                    
                    redirect("job_seeker_dashboard");
                }
            }
            else{
                $msg = validation_errors();
                $status = "error";
            }
        }
        
        
        $data["msg"] = $msg;
        $data["status"] = $status;
        $this->load->view('job_seeker/signup', $data);
        
    }
    
    public function jobseeker_email_exist($email) {
        $isValid = false;
        $jobseeker = $this->jobseeker->jobseekers_get_by_email($email);
        if ($jobseeker) {
            $this->form_validation->set_message('jobseeker_email_exist', 'This %s is already in use.');
        } else {
            $isValid = true;
        }
        return $isValid;
    }
    
    public function signin() {
        $data["facilities"] = $this->get_facilities_name();
        $msg = '';
        $status = '';

        // check already login
        $session = $this->session->all_userdata();
        if (isset($session['jobseeker'])) {
            redirect('job_seeker_dashboard');
        }

        if ($this->input->post()) {
            
            $data = $this->input->post();
            $email = $this->input->post("signin_email");
            $password = $this->input->post("signin_password");

            $jobseeker = $this->jobseeker->jobseekers_get_by_email_pass($email, $password);
            if ($jobseeker) {
                unset($jobseeker['password']);

                $this->session->set_userdata('user_id', $jobseeker['id']);
                $this->session->set_userdata('user_type', 'jobseeker');
                $this->session->set_userdata('jobseeker', $jobseeker);
                redirect('job_seeker_dashboard');
            } 
            else {
                $msg = 'Wrong email or password';
                $status = 'error';
            }
        }

        $data['msg'] = $msg;
        $data['status'] = $status;
        $this->layout = "job_seeker";
        $this->load->view('job_seeker/signin', $data);
    }
    public function signout() {
        
        $this->layout = "blank";
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_type');
        $this->session->unset_userdata('jobseeker');
        redirect('job_seeker');
        
    }
    
    public function facebook_connect() {
        $this->layout = 'blank';
        $status = '';
        $data['facebook_id'] = $this->input->post('id');
        $data['first_name'] = $this->input->post('first_name');
        $data['last_name'] = $this->input->post('last_name');
        $data['email'] = ($this->input->post('email')) ? $this->input->post('email') : '';
        $no_email = ($this->input->post('no_email')) ? $this->input->post('no_email') : '';
        $freez_time = time();
        $data['created_at'] = $freez_time;
        $data['updated_at'] = $freez_time;
        $random_pass = random_string('alnum', 10);
        $data['password'] = md5($random_pass);
        
            
        $user_exist = $this->jobseeker->jobseekers_get_by_facebook_id($data['facebook_id']);

        if($no_email == "true"){
            
            if (!$user_exist) {
                $status = 'error';
                
            }
            else{
                $jobseeker = $user_exist;
                unset($jobseeker['password']);
                $this->session->set_userdata('user_id', $jobseeker['id']);
                $this->session->set_userdata('user_type', 'jobseeker');
                $this->session->set_userdata('jobseeker', $jobseeker);
                $status = 'ok';
            }
        }
        else{
            if (!$user_exist) {

                $user_exist_email = $this->jobseeker->jobseekers_get_by_email($data['email']);
                if ($user_exist_email) {
                    $update_data['facebook_id'] = $data['facebook_id'];
                    $r = $this->jobseeker->jobseekers_update($user_exist_email['id'], $update_data);
                } else {
                    $r = $this->jobseeker->jobseekers_add($data);
                    // Send Register email Here
                    $email_data['to'] = $data['email'];
                    $email_data['subject'] = "Welcome";
                    $email_data["password"] = $random_pass;

                    $patterns = array(
                        '{EMAIL}' => $data['email'],
                        '{PASSWORD}' => $email_data["password"]
                    );
                    send_template_email("employer/register", $email_data, $patterns);
                }

                if ($r) {
                    $id = $r;
                    $jobseeker = $this->jobseeker->jobseekers_get($id);
                    unset($jobseeker['password']);
                    $this->session->set_userdata('user_id', $jobseeker['id']);
                    $this->session->set_userdata('user_type', 'jobseeker');
                    $this->session->set_userdata('jobseeker', $jobseeker);
                    $status = 'ok';
                    // send email Create account  
                } else {
                    $status = 'error';
                }
            } else {
                $jobseeker = $user_exist;
                unset($jobseeker['password']);
                $this->session->set_userdata('user_id', $jobseeker['id']);
                $this->session->set_userdata('user_type', 'jobseeker');
                $this->session->set_userdata('jobseeker', $jobseeker);
                $status = 'ok';
            }
        }

        echo json_encode(array('status' => $status));
        die;
    }

    public function linkedin_connect() {
         
        
        $this->layout = 'blank';
        $status = '';
        require APPPATH.'libraries/linkedin/linkedin.php';

        $linkedin_config['callback_url'] = base_url('job_seeker/linkedin_connect_callback');
        $linkedin_config['base_url'] = base_url('job_seeker/linkedin_connect');
        
        $linkedin_api_key = $this->config->item("linkedin_api_key");
        $linkedin_secret = $this->config->item("linkedin_secret");
        
        $linkedin_config['linkedin_api_key'] = $linkedin_api_key;
        $linkedin_config['linkedin_secret'] = $linkedin_secret;

        # First step is to initialize with your consumer key and secret. We'll use an out-of-band oauth_callback
        $linkedin = new LinkedIn($linkedin_config['linkedin_api_key'], $linkedin_config['linkedin_secret'], $linkedin_config['callback_url']);

        $state = isset($_REQUEST["state"]) ? $_REQUEST["state"] : 'start';
        $mobile_user_id = isset($_REQUEST["post_id"]) ? $_REQUEST["post_id"] : '';
        # Now we retrieve a request token. It will be set as $linkedin->request_token
        $linkedin->getRequestToken();
        $this->session->set_userdata('requestToken',serialize($linkedin->request_token));  
        $this->session->set_userdata('oauth_state',$state);
        $this->session->set_userdata('linkedin_post_id',$mobile_user_id);
        header("Location: " . $linkedin->generateAuthorizeUrl());
        
        echo json_encode(array('status' => $status));
        die;
    }
    
    public function linkedin_connect_callback(){
        $this->layout = 'blank';
         
        
        require APPPATH.'libraries/linkedin/linkedin.php';
        
        $linkedin_config['callback_url'] = base_url('job_seeker/linkedin_connect_callback');
        $linkedin_config['base_url'] = base_url('job_seeker/linkedin_connect');
        
        $linkedin_api_key = $this->config->item("linkedin_api_key");
        $linkedin_secret = $this->config->item("linkedin_secret");
        
        $linkedin_config['linkedin_api_key'] = $linkedin_api_key;
        $linkedin_config['linkedin_secret'] = $linkedin_secret;
        
        $linkedin = new LinkedIn($linkedin_config['linkedin_api_key'], $linkedin_config['linkedin_secret'], $linkedin_config['callback_url']);
        
        $oauth_state = $this->session->userdata('oauth_state');
        $requestToken = $this->session->userdata('requestToken');
        $linkedin_post_id = $this->session->userdata('linkedin_post_id');
        $oauth_access_token = $this->session->userdata('oauth_access_token');
        
        if (isset($_GET['oauth_verifier'])) {
            $this->session->set_userdata('oauth_verifier',$_GET['oauth_verifier']);
            $linkedin->request_token = unserialize($requestToken);
            $linkedin->oauth_verifier = $this->session->userdata('oauth_verifier');
            $token = $linkedin->getAccessToken($_GET['oauth_verifier']);
            $this->session->set_userdata( 'oauth_access_token',serialize($linkedin->access_token) );
            header("Location: " . $linkedin_config['callback_url']);
            exit();
        } else {
            $linkedin->request_token = unserialize($requestToken);
            $linkedin->oauth_verifier = $this->session->userdata('oauth_verifier');
            $linkedin->access_token = unserialize($oauth_access_token);
        }
        
//        ~/connections
        $xml= $linkedin->getProfile("~:(id,first-name,last-name,email-address)");
        $xml= new SimpleXmlElement($xml);
        
        
        $linkedin_user = get_object_vars($xml);
        $linkedin_id = ( isset($linkedin_user['id']) ) ? $linkedin_user['id'] : "" ;
        $first_name = ( isset($linkedin_user['first-name']) ) ? $linkedin_user['first-name'] : "" ;
        $last_name = ( isset($linkedin_user['last-name']) ) ? " ".$linkedin_user['last-name'] : "" ;
        $email = ( isset($linkedin_user['email-address']) ) ? $linkedin_user['email-address'] : "" ;
        
        if( $linkedin_id != "" && $first_name != "" && $email != "") {
            $html = '<!DOCTYPE html><script>
                var linkedin_id = "' . $linkedin_id . '" ;
                var first_name = "' . $first_name . '" ;
                var last_name = "' . $last_name . '" ;
                var email = "' . $email . '" ;
                self.opener.connect_with_linkedin_jobseeker(linkedin_id, first_name, last_name, email);
                self.close();
                </script>';
            echo $html;
        }
        else{
            echo "Error: something went wrong please try again";
        }
        die;
    }
    public function linkedin_connect_save(){
        $this->layout = 'blank';
        $status = '';
        $data['linkedin_id'] = $this->input->post('id');
        $data['first_name'] = $this->input->post('first_name');
        $data['last_name'] = $this->input->post('last_name');
        $data['email'] = $this->input->post('email');
        $freez_time = time();
        $data['created_at'] = $freez_time;
        $data['updated_at'] = $freez_time;
        $random_pass = random_string('alnum', 10);
        $data['password'] = md5($random_pass);

        $user_exist = $this->jobseeker->jobseekers_get_by_linkedin_id($data['linkedin_id']);
        if (!$user_exist) {

            $user_exist_email = $this->jobseeker->jobseekers_get_by_email($data['email']);
            if ($user_exist_email) {
                $update_data['linkedin_id'] = $data['linkedin_id'];
                $r = $this->jobseeker->jobseekers_update($user_exist_email['id'], $update_data);
            } else {
                $r = $this->jobseeker->jobseekers_add($data);
                
                // Send Register email Here
                $email_data['to'] = $data['email'];
                $email_data['subject'] = "Welcome";
                $email_data["password"] = $random_pass;

                $patterns = array(
                    '{EMAIL}' => $data['email'],
                    '{PASSWORD}' => $email_data["password"]
                );
                send_template_email("employer/register",$email_data, $patterns);
            }

            if ($r) {
                $id = $r;
                $jobseeker = $this->jobseeker->jobseekers_get($id);
                unset($jobseeker['password']);
                $this->session->set_userdata('user_id', $jobseeker['id']);
                $this->session->set_userdata('user_type', 'jobseeker');
                $this->session->set_userdata('jobseeker', $jobseeker);
                $status = 'ok';
                // send email Create account  
            } else {
                $status = 'error';
            }
        } else {
            $jobseeker = $user_exist;
            unset($jobseeker['password']);
            $this->session->set_userdata('user_id', $jobseeker['id']);
            $this->session->set_userdata('user_type', 'jobseeker');
            $this->session->set_userdata('jobseeker', $jobseeker);
            $status = 'ok';
        }

        echo json_encode(array('status' => $status));
        die;
    }
    public function forget_password(){
        // check already login
        $session = $this->session->all_userdata();
        if (isset($session['employer'])) {
            redirect('job_seeker_dashboard');
        }
        
        
        $this->layout = "job_seeker";
        $this->title .= " - Recover Password";
        
        $status = $this->session->flashdata("status");
        $msg = $this->session->flashdata("msg");
        $type_form = $this->session->flashdata("type_form");
        $post_data = $this->session->flashdata("post_data");
        
        $data = $post_data;
        $data['status'] = $status;
        $data['msg'] = $msg;
        $data['type_form'] = $type_form;
        
        $this->load->view("job_seeker/forget_password", $data);
        
    }
    public function forget_password_process($type){
        $status = '';
        $msg = '';
        $post_data = '';
        
        if($this->input->post()){
            $post_data = $this->input->post();
        }
        
        if($type == "sms"){
            
            
            $email = $this->input->post("forgot_email");
            $sms_phone = $this->input->post("sms_phone");
            $jobseeker = $this->jobseeker->jobseekers_get_by_email($email);
            if($jobseeker){
                
                
            
                $random_pass = random_string('alnum', 10);
                
                $save_data['password'] = md5($random_pass);
                $this->jobseeker->jobseekers_update($jobseeker['id'], $save_data);
                
                $this->load->library('twilio');
                $from = '+13126354633';
                $to = $sms_phone;
                $message = "Email : ".$jobseeker['email']." Password: ".$random_pass;
                $response = $this->twilio->sms($from, $to, $message);

                if($response->IsError){
//                    echo 'Error: ' . $response->ErrorMessage;
                    $status = 'error';
                    $msg = $response->ErrorMessage;
                }
                else{
                    $status = 'ok';
                    $msg = "Text sent successfully";
                }
                
                
                
            }
            else{
                $status = 'error';
                $msg = "Email does not exist";
            }
            
        }
        else if($type == "email"){
            
            $email = $this->input->post("forgot_email");
            $jobseeker = $this->jobseeker->jobseekers_get_by_email($email);
            if($jobseeker){
            
                $random_pass = random_string('alnum', 10);
                
                $save_data['password'] = md5($random_pass);
                $this->jobseeker->jobseekers_update($jobseeker['id'], $save_data);
                
//                $email_data['to'] = "numan.hassan@purelogics.net";
                $email_data['to'] = $jobseeker['email'];
                $email_data['subject'] = "Forgot Password";

                $patterns = array(
                    '{EMAIL}' => $jobseeker['email'],
                    '{PASSWORD}' => $random_pass
                );

                send_template_email("job_seeker/forget_password",$email_data, $patterns);
                
                $status = 'ok';
                $msg = "Email sent successfully";
                
            }
            else{
                $status = 'error';
                $msg = "Email does not exist";
            }
            
        }
        else if($type == "call"){
            
            $email = $this->input->post("forgot_email");
            $call_phone = $this->input->post("call_phone");
            $jobseeker = $this->jobseeker->jobseekers_get_by_email($email);
            if($jobseeker){
            
                $random_pass = random_string('alnum', 10);
                
                $save_data['password'] = md5($random_pass);
                $this->jobseeker->jobseekers_update($jobseeker['id'], $save_data);
                
//                $email_data['to'] = "numan.hassan@purelogics.net";
                $email_data['to'] = "support@medmatch.com";
                $email_data['subject'] = "Forgot Password - Call to number";

                $patterns = array(
                    '{EMAIL}' => $jobseeker['email'],
                    '{PASSWORD}' => $random_pass,
                    '{CALL_PHONE}' => $call_phone
                );

                send_template_email("job_seeker/call_password",$email_data, $patterns);
                
                $status = 'ok';
                $msg = "Email sent successfully";
                
            }
            else{
                $status = 'error';
                $msg = "Email does not exist";
            }
            
        }
        
        
        $this->session->set_flashdata("status",$status);
        $this->session->set_flashdata("msg",$msg);
        $this->session->set_flashdata("type_form",$type);
        $this->session->set_flashdata("post_data",$post_data);
        
        redirect("job_seeker/forget_password");
        
    }
 

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */