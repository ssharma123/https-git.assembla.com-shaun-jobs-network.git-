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
        
        $data["specialties"] = $this->get_specialties('parent');
        
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
            $save_data['issued_on'] = $this->input->post('issued_on');
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
                            '.$save_data['issued_on'].'<br>
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
    
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */