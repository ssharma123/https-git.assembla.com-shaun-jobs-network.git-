<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employer extends MY_EmployerController {
 
    
        function __construct() {
            parent::__construct();
            $this->load->model('facility_model','facility');
            $this->load->model('employer_model','employer');
            $this->load->model('employer_facility_model','employer_facility');
        }
        
	public function index()
	{
            $this->layout = "employer";
            $data["facilities"] = $this->get_facilities_name();
            $this->load->view('employer/home',$data);
	}
        
        public function signin()
	{
            $msg = '';
            $status = '';
            
            // check already login
            $session = $this->session->all_userdata();
            if(isset($session['employer'])){
                redirect('employee_dashboard');
            }
            
            if($this->input->post()){
                $email = $this->input->post("signin_email");
                $password = $this->input->post("signin_password");
                
                $employer = $this->employer->employers_get_by_email_pass($email , $password);
                if($employer){
                    unset($employer['password']);
                    
                    $this->session->set_userdata('user_id',$employer['id']);
                    $this->session->set_userdata('user_type','employer');
                    $this->session->set_userdata('employer',$employer);
                    redirect('employee_dashboard');
                }
                else{
                    $msg = 'Wrong email or password';
                    $status = 'error';
                }
            }
            
            $data['msg'] = $msg;
            $data['status'] = $status;
            $this->layout = "employer";
            $this->load->view('employer/signin',$data);
	}
        
        public function signout(){
            $this->layout = "blank";
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('user_type');
            $this->session->unset_userdata('employer');
            redirect('');
        }
        public function signup($step = 1)
	{
            // check already login
            $session = $this->session->all_userdata();
            if(isset($session['employer'])){
                redirect('employee_dashboard');
            }
            
            $this->layout = "employer";
            $data = array();
            $status = "";
            $msg = "";
            if($step >= 1 && $step <= 2){
                
                if($step == 1){
                    if(!$this->input->post()){
                        redirect('employer');
                    }
                }
                
                if($step == 2){
                    
                    if(!$this->input->post()){
                        redirect('employer');
                    }
                    
                    $data['facility_name'] = '';
                    $data['signup1_email'] = '';
                    $data['signup1_facility'] = '';
                    $data['signup1_facility_id'] = '';

                    $no_password = $this->input->post('no_password');
                    $data['no_password'] = $no_password;
                    if($this->input->post('signup1-name')){
                        $data['signup1_name'] = $this->input->post('signup1-name');
                        $data['signup1_email'] = $this->input->post('signup1-email');
                        $data['signup1_facility'] = $this->input->post('signup1-facility');
                        $data['signup1_facility_id'] = $this->input->post('signup1-facility_id');
                    }
                    else if($this->input->post('signup_name')){
                        $data['signup1_name'] = $this->input->post('signup_name');
                        $data['signup1_email'] = $this->input->post('signup_email');
                        $data['signup1_facility'] = $this->input->post('signup_facility');
                        $data['signup1_facility_id'] = $this->input->post('signup_facility_id');
                    }
                    $data['signup_phone'] = ($this->input->post('signup_phone')) ? $this->input->post('signup_phone') : '';
                    
                    if(isset($no_password) && $no_password == "yes"){
                        $data['password'] = '';
                    }
                    else{
                        $data['password'] = base64_encode($this->input->post('password'));
                    }
                    
                    $form_process = $this->input->post("form_process");
                    $post = $this->input->post();
                    if(isset($form_process) && $form_process == "yes"){
                        
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
                            array('field' => 'facility_num_of_employee', 'label' => 'Number of employer', 'rules' => 'trim|required|xss_clean'),
                            array('field' => 'facility_num_of_bed', 'label' => 'Number of bed', 'rules' => 'trim|required|xss_clean'),
                        );
                        $this->form_validation->set_error_delimiters('', '');
                        $this->form_validation->set_rules($config);
                        if ( $this->form_validation->run() === TRUE ) {
                        
                            $save_data['name'] = $this->db->escape_str( $this->input->post("signup_name") );
                            $save_data['email'] = $this->db->escape_str( $this->input->post('signup_email') );
                            
                            if(isset($no_password) && $no_password == "yes"){
                                $save_data['password'] = md5( $this->input->post("password") );
                            }
                            else{
                                $save_data['password'] = md5( base64_decode($this->input->post("password")) );
                            }
                            
                            $save_data['billing_name'] = $this->db->escape_str( $this->input->post('billing_name') );
                            $save_data['billing_phone'] = $this->db->escape_str( $this->input->post('billing_phone') );
                            $save_data['billing_email'] = $this->db->escape_str( $this->input->post('billing_email') );
                            $save_data['created_at'] = time();
                            $save_data['updated_at'] = time();
                                
                            $employer_id = $this->employer->employers_add($save_data);
                            
                            $save_data_fac['employer_id'] = $employer_id;
                            
                            $facility_id = $this->db->escape_str( $this->input->post('signup_facility_id') );
                            if($facility_id == 0){
                                $facility_data['name'] = $this->db->escape_str( $this->input->post('signup_facility') );
                                $facility_data['city'] = 'none';
                                $facility_data['object_id'] = '';
                                $facility_data['created_at'] = time();
                                $facility_data['updated_at'] = time();
                                $this->facility->facilities_add($facility_data);
                            } 
                            
                            $save_data_fac['facility_id'] = $facility_id;
                            $save_data_fac['name'] = $this->db->escape_str( $this->input->post('signup_facility') );
                            $save_data_fac['address'] = $this->db->escape_str( $this->input->post('facility_address') );
                            $save_data_fac['zipCode'] = $this->db->escape_str( $this->input->post('facility_zipCode') );
                            $save_data_fac['city'] = $this->db->escape_str( $this->input->post('facility_city') );
                            $save_data_fac['num_of_employee'] = $this->db->escape_str( $this->input->post('facility_num_of_employee') );
                            $save_data_fac['num_of_bed'] = $this->db->escape_str( $this->input->post('facility_num_of_bed') );
                            
                            $this->employer_facility->employers_facility_add($save_data_fac);
                            
                            if($employer_id > 0){
                                
                                unset($save_data['password']);
                    
                                $this->session->set_userdata('user_id',$save_data['id']);
                                $this->session->set_userdata('user_type','employer');
                                $this->session->set_userdata('employer',$save_data);
                                redirect('employee_dashboard');
                            }
                            
                        }
                        else {
                            $msg = validation_errors();
                            $status = "error";
                        }
                        
                    }
                }
                $data['status'] = $status;
                $data['msg'] = $msg;
                $this->load->view('employer/signup_'.$step, $data);
            }
            else{
                redirect('employer');
            }
	}
        
        public function employer_popup(){
            $this->layout = "blank";
            $html = $this->load->view('employer/signup_popup',array(),TRUE);
            
            $array = array(
              "html" => $html
            );
            echo json_encode($array); die;
        }
        
        
        public function email_exist(){
            $this->layout = "blank";
            $email = $this->input->post('email');
            $this->load->model('employer_model','employer');
            $employer = $this->employer->employer_get_by_email($email);
            if($employer){
                $status="ok";
            }
            else{
                $status="error";
            }
            $output = array("status" => $status);
            echo json_encode($output); die;
        }
        public function employer_email_exist($email) {
            $isValid = false;
            $employer = $this->employer->employer_get_by_email($email);
            if($employer){
                $this->form_validation->set_message('employer_email_exist', 'This %s is already in use.');
            }
            else{
                $isValid = true;
            }
            return $isValid;
        }
        
        public function employer_signup_btm_form(){
            
            // check already login
            $session = $this->session->all_userdata();
            if(isset($session['employer'])){
                redirect('employee_dashboard');
            }
            
            
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
            if ( $this->form_validation->run() === TRUE ) {

                $save_data['name'] = $this->db->escape_str( $this->input->post("signup_name") );
                $save_data['email'] = $this->db->escape_str( $this->input->post('signup_email') );
                $save_data['password'] = md5( $this->input->post("password") );

                $save_data['billing_name'] = $this->db->escape_str( $this->input->post('billing_name') );
                $save_data['billing_phone'] = $this->db->escape_str( $this->input->post('billing_phone') );
                $save_data['billing_email'] = $this->db->escape_str( $this->input->post('billing_email') );
                $save_data['created_at'] = time();
                $save_data['updated_at'] = time();
                $employer_id = $this->employer->employers_add($save_data);

                $save_data_fac['employer_id'] = $employer_id;

                $facility_id = $this->db->escape_str( $this->input->post('signup_facility_id') );
                if($facility_id == 0){
                    $facility_data['name'] = $this->db->escape_str( $this->input->post('signup_facility') );
                    $facility_data['city'] = 'none';
                    $facility_data['object_id'] = '';
                    $facility_data['created_at'] = time();
                    $facility_data['updated_at'] = time();
                    $this->facility->facilities_add($facility_data);
                } 

                $save_data_fac['facility_id'] = $facility_id;
                $save_data_fac['name'] = $this->db->escape_str( $this->input->post('signup_facility') );
                $save_data_fac['address'] = $this->db->escape_str( $this->input->post('facility_address') );
                $save_data_fac['zipCode'] = $this->db->escape_str( $this->input->post('facility_zipCode') );
                $save_data_fac['city'] = $this->db->escape_str( $this->input->post('facility_city') );
                $save_data_fac['num_of_employee'] = $this->db->escape_str( $this->input->post('facility_num_of_employee') );
                $save_data_fac['num_of_bed'] = $this->db->escape_str( $this->input->post('facility_num_of_bed') );

                $this->employer_facility->employers_facility_add($save_data_fac);

                if($employer_id > 0){
                    $status = 'ok';
                    $msg = 'Signup successfully';
                    $this->session->set_userdata('user_id',$save_data['id']);
                    $this->session->set_userdata('user_type','employer');
                    $this->session->set_userdata('employer',$save_data);
                }

            }
            else {
                $msg = validation_errors();
                $status = "error";
            }
            $output = array("status" => $status, "msg" => $msg);
            echo json_encode($output); die;
        }
        
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */