<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employer extends MY_EmployerController {

    function __construct() {
        parent::__construct();
        $this->load->model('facility_model', 'facility');
        $this->load->model('employer_model', 'employer');
        $this->load->model('employer_facility_model', 'employer_facility');
    }

    public function index() {
        $this->layout = "employer";
        $data["facilities"] = $this->get_facilities_name();
        $this->load->view('employer/home', $data);
    }

    public function signin() {
        $data["facilities"] = $this->get_facilities_name();
        $msg = '';
        $status = '';

        // check already login
        $session = $this->session->all_userdata();
        if (isset($session['employer'])) {
            redirect('employee_dashboard');
        }

        if ($this->input->post()) {
            
            $data = $this->input->post();
            $email = $this->input->post("signin_email");
            $password = $this->input->post("signin_password");

            $employer = $this->employer->employers_get_by_email_pass($email, $password);
            if ($employer) {
                unset($employer['password']);

                $this->session->set_userdata('user_id', $employer['id']);
                $this->session->set_userdata('user_type', 'employer');
                $this->session->set_userdata('employer', $employer);
                redirect('employee_dashboard');
            } else {
                $msg = 'Wrong email or password';
                $status = 'error';
            }
        }

        $data['msg'] = $msg;
        $data['status'] = $status;
        $this->layout = "employer";
        $this->load->view('employer/signin', $data);
    }

    public function signout() {
        $this->layout = "blank";
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_type');
        $this->session->unset_userdata('employer');
        redirect('');
    }

    public function signup($step = 1) {
        // check already login
        $session = $this->session->all_userdata();
        if (isset($session['employer'])) {
            redirect('employee_dashboard');
        }
        
        

        $this->layout = "employer";
        $data = array();
        $data["facilities"] = $this->get_facilities_name();
        $status = "";
        $msg = "";
        if ($step >= 1 && $step <= 2) {

            if ($step == 1) {
                if (!$this->input->post()) {
                    redirect('employer');
                }
            }

            if ($step == 2) {
                
                if (!$this->input->post() && !$this->input->get()) {
                    redirect('employer');
                }

                $data['facility_name'] = '';
                $data['signup1_email'] = '';
                $data['signup1_facility'] = '';
                $data['signup1_facility_id'] = '';

                $no_password = $this->input->get_post('no_password');
                $social_connect = ($this->input->get('social_connect')) ? $this->input->get('social_connect') : "";
                $data['social_connect'] = $social_connect;
                
                $data['no_password'] = $no_password;
                if ($this->input->post('signup1-name')) {
                    $data['signup1_name'] = $this->input->post('signup1-name');
                    $data['signup1_email'] = $this->input->post('signup1-email');
                    $data['signup1_facility'] = $this->input->post('signup1-facility');
                    $data['signup1_facility_id'] = $this->input->post('signup1-facility_id');
                } 
                else if ($this->input->get_post('signup_name')) {
                    $data['signup1_name'] = $this->input->get_post('signup_name');
                    $data['signup1_email'] = $this->input->get_post('signup_email');
                    $data['signup1_facility'] = $this->input->get_post('signup_facility');
                    $data['signup1_facility_id'] = $this->input->get_post('signup_facility_id');
                    
                    $data['facebook_id'] = $this->input->get_post('facebook_id');
                    $data['linkedin_id'] = $this->input->get_post('linkedin_id');
                }
                $data['signup_phone'] = ($this->input->post('signup_phone')) ? $this->input->post('signup_phone') : '';

                if (isset($no_password) && $no_password == "yes") {
                    $data['password'] = '';
                } else {
                    $data['password'] = base64_encode($this->input->post('password'));
                }

                $form_process = $this->input->post("form_process");
                $post = $this->input->post();
                if (isset($form_process) && $form_process == "yes") {

                    $this->load->library('form_validation');
                    $config = array(
                        array('field' => 'signup_name', 'label' => 'Name', 'rules' => 'trim|required|xss_clean'),
                        array('field' => 'signup_email', 'label' => 'Email', 'rules' => 'trim|required|xss_clean|callback_employer_email_exist'),
                        array('field' => 'password', 'label' => 'password', 'rules' => 'trim|required|xss_clean'),
                        array('field' => 'billing_name', 'label' => 'Billing Name', 'rules' => 'trim|required|xss_clean'),
                        array('field' => 'billing_phone', 'label' => 'Billing Phone', 'rules' => 'trim|required|xss_clean'),
                        array('field' => 'billing_email', 'label' => 'Billing Email', 'rules' => 'trim|required|xss_clean'),
                        array('field' => 'signup_facility', 'label' => 'Billing Email', 'rules' => 'trim|required|xss_clean'),
                        array('field' => 'facility_address', 'label' => 'Address', 'rules' => 'trim|required|xss_clean'),
                        array('field' => 'facility_zipCode', 'label' => 'Zip Code', 'rules' => 'trim|required|xss_clean'),
                        array('field' => 'facility_city', 'label' => 'City', 'rules' => 'trim|required|xss_clean'),
                        array('field' => 'facility_state', 'label' => 'State', 'rules' => 'trim|required|xss_clean'),
                        array('field' => 'facility_num_of_employee', 'label' => 'Number of employer', 'rules' => 'trim|required|xss_clean'),
                        array('field' => 'facility_num_of_bed', 'label' => 'Number of bed', 'rules' => 'trim|required|xss_clean'),
                    );
                    $this->form_validation->set_error_delimiters('', '');
                    $this->form_validation->set_rules($config);
                    if ($this->form_validation->run() === TRUE) {

                        $save_data['name'] = $this->db->escape_str($this->input->post("signup_name"));
                        $save_data['email'] = $this->db->escape_str($this->input->post('signup_email'));

                        if (isset($no_password) && $no_password == "yes") {
                            $save_data['password'] = md5($this->input->post("password"));
                        } else {
                            $save_data['password'] = md5(base64_decode($this->input->post("password")));
                        }

                        $save_data['billing_name'] = $this->db->escape_str($this->input->post('billing_name'));
                        $save_data['billing_phone'] = $this->db->escape_str($this->input->post('billing_phone'));
                        $save_data['billing_email'] = $this->db->escape_str($this->input->post('billing_email'));
                        $save_data['created_at'] = time();
                        $save_data['updated_at'] = time();

                        $employer_id = $this->employer->employers_add($save_data);
                        
                        // Send Register email Here
                        $email_data['to'] = $save_data['email'];
                        $email_data['subject'] = "Welcome";
                        
                        if (isset($no_password) && $no_password == "yes") {
                            $email_data["password"] = $this->input->post("password");
                        }
                        else{
                            $email_data["password"] = base64_decode($this->input->post("password"));
                        }
                        $patterns = array(
                            '{EMAIL}' => $save_data['email'],
                            '{PASSWORD}' => $email_data["password"]
                        );
                        send_template_email("employer/register",$email_data, $patterns);

                        $save_data_fac['employer_id'] = $employer_id;

                        $facility_id = $this->db->escape_str($this->input->post('signup_facility_id'));
                        if ($facility_id == 0) {
                            $facility_data['name'] = $this->db->escape_str($this->input->post('signup_facility'));
                            $facility_data['city'] = 'none';
                            $facility_data['object_id'] = '';
                            $facility_data['created_at'] = time();
                            $facility_data['updated_at'] = time();
                            
                            $exist_facility = $this->facility->facilities_get_by_name($facility_data['name']);
                            if($exist_facility){
                                $facility_id = $exist_facility['id'];
                            }
                            else{
                                $facility_id = $this->facility->facilities_add($facility_data);
                            }
                        }

                        $save_data_fac['facility_id'] = $facility_id;
                        $save_data_fac['name'] = $this->db->escape_str($this->input->post('signup_facility'));
                        $save_data_fac['address'] = $this->db->escape_str($this->input->post('facility_address'));
                        $save_data_fac['zipCode'] = $this->db->escape_str($this->input->post('facility_zipCode'));
                        $save_data_fac['city'] = $this->db->escape_str($this->input->post('facility_city'));
                        $save_data_fac['state'] = $this->db->escape_str($this->input->post('facility_state'));
                        $save_data_fac['num_of_employee'] = $this->db->escape_str($this->input->post('facility_num_of_employee'));
                        $save_data_fac['num_of_bed'] = $this->db->escape_str($this->input->post('facility_num_of_bed'));

                        $this->employer_facility->employers_facility_add($save_data_fac);

                        if ($employer_id > 0) {

                            unset($save_data['password']);

                            $this->session->set_userdata('user_id', $save_data['id']);
                            $this->session->set_userdata('user_type', 'employer');
                            $employer = $this->employer->employers_get($employer_id);
                            unset($employer['password']);
                            
                            $this->session->set_userdata('employer', $employer);
                            redirect('employee_dashboard');
                        }
                    } else {
                        $msg = validation_errors();
                        $status = "error";
                    }
                }
            }
            $data['status'] = $status;
            $data['msg'] = $msg;
            

            $this->load->view('employer/signup_' . $step, $data);
        } else {
            redirect('employer');
        }
    }

    public function employer_popup() {
        $this->layout = "blank";
        $html = $this->load->view('employer/signup_popup', array(), TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }

    public function email_exist() {
        $this->layout = "blank";
        $email = $this->input->post('email');
        $this->load->model('employer_model', 'employer');
        $employer = $this->employer->employer_get_by_email($email);
        if ($employer) {
            $status = "ok";
        } else {
            $status = "error";
        }
        $output = array("status" => $status);
        echo json_encode($output);
        die;
    }

    public function employer_email_exist($email) {
        $isValid = false;
        $employer = $this->employer->employer_get_by_email($email);
        if ($employer) {
            $this->form_validation->set_message('employer_email_exist', 'This %s is already in use.');
        } else {
            $isValid = true;
        }
        return $isValid;
    }

    public function employer_signup_btm_form() {

        // check already login
//        $session = $this->session->all_userdata();
//        if (isset($session['employer'])) {
//            redirect('employee_dashboard');
//        }


        $this->layout = "blank";
        $msg = "";
        $status = "";

        $this->load->library('form_validation');
        $config = array(
            array('field' => 'signup_name', 'label' => 'Name', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'signup_email', 'label' => 'Email', 'rules' => 'trim|required|xss_clean|callback_employer_email_exist'),
            array('field' => 'password', 'label' => 'Email', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'billing_name', 'label' => 'Billing Name', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'billing_phone', 'label' => 'Billing Phone', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'billing_email', 'label' => 'Billing Email', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'signup_facility', 'label' => 'Billing Email', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'facility_address', 'label' => 'Address', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'facility_zipCode', 'label' => 'Zip Code', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'facility_city', 'label' => 'City', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'facility_num_of_employee', 'label' => 'Number of employer', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'facility_num_of_bed', 'label' => 'Number of bed', 'rules' => 'trim|required|xss_clean'),
        );
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() === TRUE) {

            $save_data['name'] = $this->db->escape_str($this->input->post("signup_name"));
            $save_data['email'] = $this->db->escape_str($this->input->post('signup_email'));
            $save_data['password'] = md5($this->input->post("password"));

            $save_data['billing_name'] = $this->db->escape_str($this->input->post('billing_name'));
            $save_data['billing_phone'] = $this->db->escape_str($this->input->post('billing_phone'));
            $save_data['billing_email'] = $this->db->escape_str($this->input->post('billing_email'));
            $save_data['created_at'] = time();
            $save_data['updated_at'] = time();
            $employer_id = $this->employer->employers_add($save_data);
            
            // Send Register email Here
            $email_data['to'] = $save_data['email'];
            $email_data['subject'] = "Welcome";
            $email_data["password"] = $this->input->post("password");
                
            $patterns = array(
                '{EMAIL}' => $save_data['email'],
                '{PASSWORD}' => $email_data["password"]
            );
            send_template_email("employer/register",$email_data, $patterns);

            $save_data_fac['employer_id'] = $employer_id;

            $facility_id = $this->db->escape_str($this->input->post('signup_facility_id'));
            if ($facility_id == 0) {
                $facility_data['name'] = $this->db->escape_str($this->input->post('signup_facility'));
                $facility_data['city'] = 'none';
                $facility_data['object_id'] = '';
                $facility_data['created_at'] = time();
                $facility_data['updated_at'] = time();
                
                $exist_facility = $this->facility->facilities_get_by_name($facility_data['name']);
                if($exist_facility){
                    $facility_id = $exist_facility['id'];
                }
                else{
                    $facility_id = $this->facility->facilities_add($facility_data);
                }
            }

            $save_data_fac['facility_id'] = $facility_id;
            $save_data_fac['name'] = $this->db->escape_str($this->input->post('signup_facility'));
            $save_data_fac['address'] = $this->db->escape_str($this->input->post('facility_address'));
            $save_data_fac['zipCode'] = $this->db->escape_str($this->input->post('facility_zipCode'));
            $save_data_fac['city'] = $this->db->escape_str($this->input->post('facility_city'));
            $save_data_fac['num_of_employee'] = $this->db->escape_str($this->input->post('facility_num_of_employee'));
            $save_data_fac['num_of_bed'] = $this->db->escape_str($this->input->post('facility_num_of_bed'));

            $this->employer_facility->employers_facility_add($save_data_fac);

            if ($employer_id > 0) {
                $status = 'ok';
                $msg = 'Signup successfully';
                $this->session->set_userdata('user_id', $employer_id);
                $this->session->set_userdata('user_type', 'employer');
                unset($save_data['password']);
                $employer = $this->employer->employers_get($employer_id);
                unset($employer['password']);
                $this->session->set_userdata('employer', $employer);
            }
        } else {
            $msg = validation_errors();
            $status = "error";
        }
        $output = array("status" => $status, "msg" => $msg);
        echo json_encode($output);
        die;
    }

    public function facebook_connect() {
        $this->layout = 'blank';
        $status = '';
        $redirect = '';
        $data['facebook_id'] = $this->input->post('id');
        $data['name'] = $this->input->post('name');
        $data['email'] = ($this->input->post('email')) ? $this->input->post('email') : '';
        $no_email = ($this->input->post('no_email')) ? $this->input->post('no_email') : '';
        $freez_time = time();
        $data['created_at'] = $freez_time;
        $data['updated_at'] = $freez_time;
        $data['active'] = 1;
        $random_pass = random_string('alnum', 10);
        $data['password'] = md5($random_pass);
        
        $user_exist = $this->employer->employer_get_by_facebook_id($data['facebook_id']);
        
        if($no_email == "true"){
            if (!$user_exist) {
                $status = 'error';
            }
            else{
                $employer = $user_exist;
                unset($employer['password']);
                $this->session->set_userdata('user_id', $employer['id']);
                $this->session->set_userdata('user_type', 'employer');
                $this->session->set_userdata('employer', $employer);
                $status = 'ok';
            }
        }
        else{
            if (!$user_exist) {

                $user_exist_email = $this->employer->employer_get_by_email($data['email']);
                if ($user_exist_email) {
                    $update_data['facebook_id'] = $data['facebook_id'];
                    $r = $this->employer->employers_update($user_exist_email['id'], $update_data);
                } else {
                    
                    $query['signup_name'] = $data['name'];
                    $query['signup_email'] = $data['email'];
                    $query['facebook_id'] = $data['facebook_id'];
                    $query['no_password'] = "yes";
                    $query['social_connect'] = "true";
                    $status = 'ok';
                    $redirect = site_url( 'employer/signup/2?'.http_build_query($query) );
                    
//                    $r = $this->employer->employers_add($data);
//                    // Send Register email Here
//                    $email_data['to'] = $data['email'];
//                    $email_data['subject'] = "Welcome";
//                    $email_data["password"] = $random_pass;
//
//                    $patterns = array(
//                        '{EMAIL}' => $data['email'],
//                        '{PASSWORD}' => $email_data["password"]
//                    );
//                    send_template_email("employer/register",$email_data, $patterns);
                     
                     
                }
                if($redirect == ""){
                    if ($r) {
                        $id = $r;
                        $employer = $this->employer->employers_get($id);
                        unset($employer['password']);
                        $this->session->set_userdata('user_id', $employer['id']);
                        $this->session->set_userdata('user_type', 'employer');
                        $this->session->set_userdata('employer', $employer);
                        $status = 'ok';
                        // send email Create account  
                    } else {
                        $status = 'error';
                    }
                }
            } else {
                $employer = $user_exist;
                unset($employer['password']);
                $this->session->set_userdata('user_id', $employer['id']);
                $this->session->set_userdata('user_type', 'employer');
                $this->session->set_userdata('employer', $employer);
                $status = 'ok';
            }
            
        }
            
         

        echo json_encode(array('status' => $status, 'redirect'=>$redirect));
        die;
    }

    public function linkedin_connect() {
         
        
        $this->layout = 'blank';
        $status = '';
        require APPPATH.'libraries/linkedin/linkedin.php';

        $linkedin_config['callback_url'] = base_url('employer/linkedin_connect_callback');
        $linkedin_config['base_url'] = base_url('employer/linkedin_connect');
        
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
        
        $linkedin_config['callback_url'] = base_url('employer/linkedin_connect_callback');
        $linkedin_config['base_url'] = base_url('employer/linkedin_connect');
        
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
        $name = ( isset($linkedin_user['first-name']) ) ? $linkedin_user['first-name'] : "" ;
        $name .= ( isset($linkedin_user['last-name']) ) ? " ".$linkedin_user['last-name'] : "" ;
        $email = ( isset($linkedin_user['email-address']) ) ? $linkedin_user['email-address'] : "" ;
        
        if( $linkedin_id != "" && $name != "" && $email != "") {
            $html = '<!DOCTYPE html><script>
                var linkedin_id = "' . $linkedin_id . '" ;
                var name = "' . $name . '" ;
                var email = "' . $email . '" ;
                self.opener.connect_with_linkedin(linkedin_id, name, email);
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

        $user_exist = $this->employer->employer_get_by_linkedin_id($data['linkedin_id']);
        if (!$user_exist) {

            $user_exist_email = $this->employer->employer_get_by_email($data['email']);
            if ($user_exist_email) {
                $update_data['linkedin_id'] = $data['linkedin_id'];
                $r = $this->employer->employers_update($user_exist_email['id'], $update_data);
            } else {
                $r = $this->employer->employers_add($data);
                
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
                $employer = $this->employer->employers_get($id);
                unset($employer['password']);
                $this->session->set_userdata('user_id', $employer['id']);
                $this->session->set_userdata('user_type', 'employer');
                $this->session->set_userdata('employer', $employer);
                $status = 'ok';
                // send email Create account  
            } else {
                $status = 'error';
            }
        } else {
            $employer = $user_exist;
            unset($employer['password']);
            $this->session->set_userdata('user_id', $employer['id']);
            $this->session->set_userdata('user_type', 'employer');
            $this->session->set_userdata('employer', $employer);
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
        
        
        $this->layout = "employer";
        $this->title .= " - Recover Password";
        
        $status = $this->session->flashdata("status");
        $msg = $this->session->flashdata("msg");
        $type_form = $this->session->flashdata("type_form");
        $post_data = $this->session->flashdata("post_data");
        
        $data = $post_data;
        $data['status'] = $status;
        $data['msg'] = $msg;
        $data['type_form'] = $type_form;
        
        $this->load->view("employer/forget_password", $data);
        
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

                send_template_email("employer/forget_password",$email_data, $patterns);
                
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

                send_template_email("employer/call_password",$email_data, $patterns);
                
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
        
        redirect("employer/forget_password");
        
    }

    public function faq() {
        $this->layout = "employer";
        $this->title .= " - FAQ";
        $this->load->view("employer/faq");
    }

    public function how_it_works() {
        $this->layout = "employer";
        $this->title .= " - Who it works";
        $this->load->view("employer/how_it_works");
    }
    
    public function terms_of_use(){
        $this->layout = "employer";
        $this->title .= " - Terms of use";
        $this->load->view("employer/terms_of_use");
    }
    public function terms_condition(){
        $this->layout = "employer";
        $this->title .= " - Terms & Condition";
        $this->load->view("employer/terms_condition");
    }
    
    public function contact_us_map_popup(){
        $this->layout = "blank";
        $html = $this->load->view('employer/contact_us_map_popup', array(), TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    public function contact_us_map_popup_process(){
        $this->layout = "blank";
        $msg = "";
        $status = "";
                
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone_number = $this->input->post('phone_number');
        $message = $this->input->post('message');
        
        $this->load->library('form_validation');
        $config = array(
            array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'phone_number', 'label' => 'Phone Number', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'message', 'label' => 'Message', 'rules' => 'trim|required|xss_clean')
        );
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() === TRUE) {
            
            $status = "ok";
            
//                $email_data['to'] = "numan.hassan@purelogics.net";
                $email_data['to'] = "support@medmatch.com";
                $email_data['subject'] = "Contact Us";

                $patterns = array(
                    '{NAME}' => $name,
                    '{EMAIL}' => $email,
                    '{PHONE}' => $phone_number,
                    '{MESSAGE}' => $message
                );

                send_template_email("employer/contact_us/",$email_data, $patterns);
                
                $status = 'ok';
                $msg = "Email sent successfully";
            
        } else {
            $msg = validation_errors();
            $status = "error";
        }
        
        $rsp = array("status" => $status, "msg" => $msg);
        echo json_encode($rsp);
        die;
         
    }
    public function contact_us_email_popup(){
        $this->layout = "blank";
        $html = $this->load->view('employer/contact_us_email_popup', array(), TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    public function contact_us_email_popup_process(){
        $this->layout = "blank";
        $msg = "";
        $status = "";
                
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone_number = $this->input->post('phone_number');
        $message = $this->input->post('message');
        
        $this->load->library('form_validation');
        $config = array(
            array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'phone_number', 'label' => 'Phone Number', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'message', 'label' => 'Message', 'rules' => 'trim|required|xss_clean')
        );
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() === TRUE) {
            
            $status = "ok";
            
//                $email_data['to'] = "numan.hassan@purelogics.net";
                $email_data['to'] = "support@medmatch.com";
                $email_data['subject'] = "Contact Us";
                $email_data['from'] = $email;
                $patterns = array(
                    '{NAME}' => $name,
                    '{EMAIL}' => $email,
                    '{PHONE}' => $phone_number,
                    '{MESSAGE}' => $message
                );

                send_template_email("employer/contact_us",$email_data, $patterns);
                
                $status = 'ok';
                $msg = "Email sent successfully";
            
        } else {
            $msg = validation_errors();
            $status = "error";
        }
        
        $rsp = array("status" => $status, "msg" => $msg);
        echo json_encode($rsp);
        die;
         
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */