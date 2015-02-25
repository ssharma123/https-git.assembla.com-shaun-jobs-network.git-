<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Job_seeker extends MY_Job_seekerController {

    function __construct() {
        parent::__construct();
        $this->load->model('jobseeker_model', 'jobseeker');
         
    }

    public function index() {
        $this->layout = "job_seeker";
        $data["states"] = $this->get_states();
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
        $data = array();
        $this->load->view('job_seeker/match', $data);
        
    }
    public function signup(){
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
        $freez_time = time();
        $data['created_at'] = $freez_time;
        $data['updated_at'] = $freez_time;
        $data['active'] = 1;
        $random_pass = random_string('alnum', 10);
        $data['password'] = md5($random_pass);
        
        if($data['email'] != ""){
            $user_exist = $this->jobseeker->jobseekers_get_by_facebook_id($data['facebook_id']);
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
        }
        else{
            $status = 'error';
        }

        echo json_encode(array('status' => $status));
        die;
    }

    public function linkedin_connect() {
         
        
        $this->layout = 'blank';
        $status = '';
        require APPPATH.'libraries/linkedin/linkedin.php';

        $linkedin_config['callback_url'] = base_url('employer/linkedin_connect_callback');
        $linkedin_config['base_url'] = base_url('employer/linkedin_connect');
        $linkedin_config['linkedin_api_key'] = "78j2kaieeedqhd";
        $linkedin_config['linkedin_secret'] = "78DO283omKfQ0zkt";

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
        
        $linkedin_config['callback_url'] = base_url('employer/linkedin_connect_callback');
        $linkedin_config['base_url'] = base_url('employer/linkedin_connect');
        $linkedin_config['linkedin_api_key'] = "78j2kaieeedqhd";
        $linkedin_config['linkedin_secret'] = "78DO283omKfQ0zkt";
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
        
        if( $linkedin_id != "" && $name != "" && $email != "") {
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
        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');
        $freez_time = time();
        $data['created_at'] = $freez_time;
        $data['updated_at'] = $freez_time;
        $data['active'] = 1;
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
            redirect('employee_dashboard');
        }
        
        
        $this->layout = "job_seeker";
        $this->title .= " - Recover Passwrd";
        
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
            $employer = $this->employer->employer_get_by_email($email);
            if($employer){
                
                
            
                $random_pass = random_string('alnum', 10);
                
                $save_data['password'] = md5($random_pass);
                $this->employer->employers_update($employer['id'], $save_data);
                
                $this->load->library('twilio');
                $from = '+13126354633';
                $to = $sms_phone;
                $message = "Email : ".$employer['email']." Password: ".$random_pass;
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
            $employer = $this->employer->employer_get_by_email($email);
            if($employer){
            
                $random_pass = random_string('alnum', 10);
                
                $save_data['password'] = md5($random_pass);
                $this->employer->employers_update($employer['id'], $save_data);
                
//                $email_data['to'] = "numan.hassan@purelogics.net";
                $email_data['to'] = $employer['email'];
                $email_data['subject'] = "Forgot Password";

                $patterns = array(
                    '{EMAIL}' => $employer['email'],
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
            $employer = $this->employer->employer_get_by_email($email);
            if($employer){
            
                $random_pass = random_string('alnum', 10);
                
                $save_data['password'] = md5($random_pass);
                $this->employer->employers_update($employer['id'], $save_data);
                
//                $email_data['to'] = "numan.hassan@purelogics.net";
                $email_data['to'] = "support@medmatch.com";
                $email_data['subject'] = "Forgot Password - Call to number";

                $patterns = array(
                    '{EMAIL}' => $employer['email'],
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