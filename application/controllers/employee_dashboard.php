<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employee_dashboard extends MY_EmployerController {

    
    function __construct() {
        parent::__construct();
        $this->load->model('jobs_model', 'jobs');
        $this->load->model('employer_model', 'employer');
        $this->load->model('employers_subscription_model', 'employers_subscription');
    }
    
    public function index() {

        $this->layout = "employer_dashboard";
        
        $session = $this->session->all_userdata();
        if(!isset($session['employer'])){
            redirect('employer/signin');
        }
        
        $data['employer'] = $session['employer'];
        
        $sub_data = $this->employers_subscription->subscription_get_by_user_id($data['employer']['id']);
        $data['sub_data'] = $sub_data;
        
        $this->load->view('employer/employer_dashboard', $data);
    }
    
    public function dashboard_job_list(){
        $this->layout = "blank";
        $data = array();
        
        $session = $this->session->all_userdata();
        if(!isset($session['employer'])){
            redirect('employer/signin');
        }
        
        $data['employer'] = $session['employer'];
        
        $sub_data = $this->employers_subscription->subscription_get_by_user_id($data['employer']['id']);
        $data['sub_data'] = $sub_data;
        
        $data['jobs'] = $this->jobs->jobs_get_by_employer($data['employer']['id']);
        $total_jobs = 0;
        if($data['jobs']){
            $total_jobs = count($data['jobs']);
        }
        $data['total_jobs'] = $total_jobs;
        
        $html = $this->load->view('employer/dashboard/job_list', $data, TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    
    public function payment_popup(){
        $this->layout = "blank";
        
        $html = $this->load->view('employer/payment_popup', array(), TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    public function welcome_popup(){
        $this->layout = "blank";
        
        $html = $this->load->view('employer/welcome_popup', array(), TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    public function job_post_step_1(){
        $this->layout = "blank";
        
        $data["specialties"] = $this->get_specialties('parent');
         
        $html = $this->load->view('employer/job/post_step_1', $data, TRUE);

        $array = array(
            "status" => "ok",
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    public function save_job_post_step_1(){
        $this->layout = "blank";
        $msg = "";
        $status = "";
        $this->load->library('form_validation');
        $config = array(
            array('field' => 'internal_id', 'label' => 'Internal ID', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'specialty', 'label' => 'Specialty', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'sub_specialty', 'label' => 'Sub Specialty', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'job_headline', 'label' => 'Job headline', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'fill_by', 'label' => 'fill by', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'position_type', 'label' => 'position type', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'prefered_designation', 'label' => 'Prefered designation', 'rules' => 'trim|required|xss_clean')
        );
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() === TRUE) {
            
            $save_data['employer_id'] = $this->session->userdata("user_id");
            $save_data['internal_id'] = $this->input->post('internal_id');
            $save_data['specialty'] = $this->input->post('specialty');
            $save_data['sub_specialty'] = $this->input->post('sub_specialty');
            $save_data['job_headline'] = $this->input->post('job_headline');
            $save_data['title'] = $this->input->post('title');
            $save_data['fill_by'] = $this->input->post('fill_by');
            $save_data['position_type'] = $this->input->post('position_type');
            $save_data['employment_length'] = $this->input->post('employment_length');
            $save_data['prefered_designation'] = $this->input->post('prefered_designation');
            $save_data['step'] = 1;
            $save_data['created_at'] = time();
            
            $id = $this->jobs->jobs_add($save_data);
            if($id > 0){
                $status = "ok";
                $this->session->set_userdata("job_recent_id",$id);
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
    
    public function job_post_step_2(){
        $this->layout = "blank";
        $data = array();
         
        $html = $this->load->view('employer/job/post_step_2', $data, TRUE);

        $array = array(
            "status" => "ok",
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    
    public function save_job_post_step_2(){
        $this->layout = "blank";
        $msg = "";
        $status = "";
        
        
        $save_data["active_license_requires_certification"] = ($this->input->post("active_license_requires_certification") == "true") ?  "yes" : "no" ;
        $save_data["requires_bls_certification"] = ($this->input->post("requires_bls_certification") == "true") ?  "yes" : "no" ;
        $save_data["accept_ji_certification"] = ($this->input->post("accept_ji_certification") == "true") ?  "yes" : "no" ;
        $save_data['step'] = 2;
        $id = $this->session->userdata("job_recent_id");
        $id = $this->jobs->jobs_update($id , $save_data);
        
        if($id > 0){
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
    
    public function job_post_step_3(){
        $this->layout = "blank";
        $data = array();
         
        $html = $this->load->view('employer/job/post_step_3', $data, TRUE);

        $array = array(
            "status" => "ok",
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    
    public function save_job_post_step_3(){
        $this->layout = "blank";
        $msg = "";
        $status = "";
        
        
        $this->load->library('form_validation');
        $config = array(
            array('field' => 'department_size', 'label' => 'Department Size', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'patients_per_day', 'label' => 'Patients Per Day', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'work_schedule', 'label' => 'Work Schedule', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'call_schedule', 'label' => 'Call Schedule', 'rules' => 'trim|required|xss_clean')
        );
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() === TRUE) {
            $save_data['department_size'] = $this->input->post('department_size');
            $save_data['patients_per_day'] = $this->input->post('patients_per_day');
            $save_data["in_patient"] = ($this->input->post("in_patient") == "true") ?  "yes" : "no" ;
            $save_data["out_patient"] = ($this->input->post("out_patient") == "true") ?  "yes" : "no" ;
            $save_data['work_schedule'] = $this->input->post('work_schedule');
            $custom_work_schedule = $this->input->post('custom_work_schedule');
            if($save_data['work_schedule'] == "custom"){
                $save_data['work_schedule'] = $custom_work_schedule;
            }
            $save_data['call_schedule'] = $this->input->post('call_schedule');
            $save_data['step'] = 3;
            
            $id = $this->session->userdata("job_recent_id");
            $id = $this->jobs->jobs_update($id , $save_data);

            if($id > 0){
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
    
    public function job_post_step_4(){
        $this->layout = "blank";
        $data = array();
        $html = $this->load->view('employer/job/post_step_4', $data, TRUE);
        $array = array(
            "status" => "ok",
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    
    public function save_job_post_step_4(){
        $this->layout = "blank";
        $msg = "";
        $status = "";
                
        $this->load->library('form_validation');
        $config = array(
            array('field' => 'salary_range', 'label' => 'Salary Range', 'rules' => 'trim|required|xss_clean'),
        );
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() === TRUE) {
            
            $save_data['salary_range'] = $this->input->post('salary_range');
            
            if($save_data['salary_range'] == "custom"){
                $save_data['salary_range_min'] = $this->input->post('salary_range_min');
                $save_data['salary_range_max'] = $this->input->post('salary_range_max');
            }
            else{
                $salary_range = explode("-", $save_data['salary_range']);
                $save_data['salary_range_min'] = isset($salary_range[0]) ? $salary_range[0] : 0 ;
                $save_data['salary_range_max'] = isset($salary_range[1]) ? $salary_range[1] : 0 ;
            }
            $save_data['bonus'] = $this->input->post('bonus');
            $save_data['pay_frequency'] = $this->input->post('pay_frequency');
            $save_data["benifits_401k"] = ($this->input->post("benifits_401k") == "true") ?  "yes" : "no" ;
            $save_data["benifits_cme_allowance"] = ($this->input->post("benifits_cme_allowance") == "true") ?  "yes" : "no" ;
            $save_data["benifits_loan"] = ($this->input->post("benifits_loan") == "true") ?  "yes" : "no" ;
            $save_data['vacation_days'] = $this->input->post('vacation_days');
            $save_data['employment_term'] = $this->input->post('employment_term');
            $save_data['step'] = 4;
            
            $id = $this->session->userdata("job_recent_id");
            $id = $this->jobs->jobs_update($id , $save_data);

            if($id > 0){
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
    
    public function job_post_step_5(){
        $this->layout = "blank";
        $data = array();
        $html = $this->load->view('employer/job/post_step_5', $data, TRUE);
        $array = array(
            "status" => "ok",
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    
    public function save_job_post_step_5(){
        $this->layout = "blank";
        $msg = "";
        $status = "";
                
            
             
        $save_data["citizen"] = ($this->input->post("citizen") == "true") ?  "yes" : "no" ;
        $save_data["green_card"] = ($this->input->post("green_card") == "true") ?  "yes" : "no" ;
        $save_data["visa"] = ($this->input->post("visa") == "true") ?  "yes" : "no" ;
        $save_data['description'] = $this->input->post('description');
        $save_data['step'] = 5;
        

        $id = $this->session->userdata("job_recent_id");
        $id = $this->jobs->jobs_update($id , $save_data);

        if($id > 0){
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
    
    public function job_post_step_6(){
        $this->layout = "blank";
        $data = array();
        $html = $this->load->view('employer/job/post_step_6', $data, TRUE);
        $array = array(
            "status" => "ok",
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    
    public function save_job_post_step_6(){
        $this->layout = "blank";
        $msg = "";
        $status = "";
                
            
             
        $save_data['auth_first_name'] = $this->input->post('auth_first_name');
        $save_data['auth_last_name'] = $this->input->post('auth_last_name');
        $save_data["agree_to_term"] = ($this->input->post("agree_to_term") == "true") ?  "yes" : "no" ;
        $save_data['step'] = 6;
        

        $id = $this->session->userdata("job_recent_id");
        $id = $this->jobs->jobs_update($id , $save_data);

        if($id > 0){
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
    
    public function job_post_step_7(){
        $this->layout = "blank";
        
        
        $id = $this->session->userdata("job_recent_id");
        $data['job_recent_id'] = $id;
        $job = $this->jobs->jobs_get($id); 
        $data['job'] = $job;
        $data["employer"] = $this->employer->employers_get(7);
        
        $html = $this->load->view('employer/job/post_step_7', $data, TRUE);
        
        if($id > 0){
            $save_data['step'] = 7;
            $save_data['active'] = 1;
            $save_data['created_at'] = time();
            $id = $this->jobs->jobs_update(0 , $save_data);
        }
        
        
        
        $array = array(
            "status" => "ok",
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    
    function upload_profile_image(){
        $this->layout = "blank";
        
        $this->load->library('custom_image_lib');
        $lib_config['create_thumb'] = true;
        $lib_config['thumb_sizes'] = array(
           array('width' => 50, 'height' => 50),
           array('width' => 215, 'height' => 215),
           array('width' => 300, 'height' => 200)
        );
        $this->custom_image_lib->config($lib_config);
        
        $profile_images = $this->custom_image_lib->upload($_FILES['profile_image'], 'uploads/employers/profiles/');
        echo "zzzZZZZZZz"; die;
//        $file_dir = "vehicle_images/";
//
//        $config['upload_path'] = './vehicle_images/';
//        $config['allowed_types'] = 'gif|jpg|png';
//        $config['max_size'] = '1000000';
//        $config['overwrite'] = TRUE;
//        $config['remove_spaces'] = TRUE;
//        $config['encrypt_name'] = FALSE;
//
//        $this->load->library('upload', $config);
//
//        if (!$this->upload->do_upload('Filedata')) {
//            echo $this->upload->display_errors();
//        } else {
//
//            $errors = $this->upload->display_errors();
//
//            $upload_info = $this->upload->data();
//
//            // Insert file information into database
//            $insert_data = array(
//                'vImg_vehicle_id_fk' => $this->input->post('vehicleID'),
//                'vImg_filename' => $upload_info['file_name'],
//                'vImg_filepath' => $upload_info['file_path'],
//                'vImg_primary' => 1,
//                'vImg_directory' => $file_dir
//            );
//            $this->db->insert('vehicle_images', $insert_data);
//        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */