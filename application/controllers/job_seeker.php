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