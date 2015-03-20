<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employee_dashboard extends MY_EmployerController {

    
    function __construct() {
        parent::__construct();
        $this->load->model('jobs_model', 'jobs');
        $this->load->model('employer_model', 'employer');
        $this->load->model('employer_facility_model', 'employer_facility');
        $this->load->model('employers_settings_model', 'settings');
        $this->load->model('employers_subscription_model', 'employers_subscription');
        $this->load->model('specialty_model', 'specialty');
        $this->load->model('jobseeker_settings_model', 'jobseeker_settings');
    }
    
    public function index() {

        $this->layout = "employer_dashboard";
        
        $session = $this->session->all_userdata();
        if(!isset($session['employer'])){
            redirect('employer/signin');
        }
        
        $data['employer'] = $this->employer->employers_get($session['employer']['id']);
        $data['employers_facilities'] = $this->employer_facility->employers_facility_get_by_employer_id($session['employer']['id']);
        
        $sub_data = $this->employers_subscription->subscription_get_by_user_id($data['employer']['id']);
        $data['sub_data'] = $sub_data;
        
        $data['jobs'] = $this->jobs->jobs_get_by_employer($data['employer']['id']);
        $total_jobs = 0;
        if($data['jobs']){
            $total_jobs = count($data['jobs']);
        }
        $data['total_jobs'] = $total_jobs;
        
        $this->load->view('employer/employer_dashboard', $data);
    }
    
    public function dashboard_job_list(){
        $this->layout = "blank";
        $data = array();
        
        $session = $this->session->all_userdata();
        if(!isset($session['employer'])){
            redirect('employer/signin');
        }
        
        $this->update_2_hours_pending_interview();
        
        $data['employer'] = $session['employer'];
        
        $sub_data = $this->employers_subscription->subscription_get_by_user_id($data['employer']['id']);
        $data['sub_data'] = $sub_data;
        
        $data['jobs'] = $this->jobs->jobs_get_by_employer($data['employer']['id']);
        
        $job_applied = array();
        if($data['jobs']){
            foreach($data['jobs'] as $row){
                $applied = $this->jobs->jobs_applied_by_employer($data['employer']['id'] , $row['id']);
                if($applied){
                    $job_applied[$row['id']] = $applied;
                }
            }
        }
        $data["job_applied"] = $job_applied;
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
    public function dashboard_settings(){
        $this->layout = "blank";
        $data = array();
        
        $session = $this->session->all_userdata();
        if(!isset($session['employer'])){
            redirect('employer/signin');
        }
        
        $data['employer'] = $session['employer'];
        
        $sub_data = $this->employers_subscription->subscription_get_by_user_id($data['employer']['id']);
        $data['sub_data'] = $sub_data;
        
        $data["setting"] = $this->settings->employers_setttings_get_by_employer($data['employer']['id']);
        $data['is_default'] = TRUE;
        if($data["setting"]){
            $data['is_default'] = FALSE;
        }
        
        $html = $this->load->view('employer/dashboard/settings', $data, TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    public function dashboard_status(){
        $this->layout = "blank";
        $data = array();
        
        $session = $this->session->all_userdata();
        if(!isset($session['employer'])){
            redirect('employer/signin');
        }
        
        $data['employer'] = $session['employer'];
        
        $sub_data = $this->employers_subscription->subscription_get_by_user_id($data['employer']['id']);
        $data['sub_data'] = $sub_data;
        
        $data['jobs'] = $this->jobs->jobs_applied_by_employer($data['employer']['id']);
        $html = $this->load->view('employer/dashboard/status_tab', $data, TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    public function dashboard_matches(){
        $this->layout = "blank";
        $data = array();
        
        $session = $this->session->all_userdata();
        if(!isset($session['employer'])){
            redirect('employer/signin');
        }
        
        $data['employer'] = $session['employer'];
        
        $sub_data = $this->employers_subscription->subscription_get_by_user_id($data['employer']['id']);
        $data['sub_data'] = $sub_data;
        
        $data["setting"] = $this->settings->employers_setttings_get_by_employer($data['employer']['id']);
        
        $html = $this->load->view('employer/dashboard/matches_tab', $data, TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    public function update_settings(){
        $this->layout = "blank";
        
        $status = "error";
        $msg = "oops something went wrong, please try again";
        
        $session = $this->session->all_userdata();
        if(!isset($session['employer'])){
            redirect('employer/signin');
        }
        
        $employer = $session['employer'];
        
        $save_data['employer_id'] = $employer['id'];
        
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
        
        

        $setting = $this->settings->employers_setttings_get_by_employer($save_data['employer_id']);

        if($setting){
            $save_data['updated_at'] = time();
            unset($save_data['employer_id']);
            $this->settings->employers_setttings_update($setting['id'], $save_data);
            $status = "ok";
            $msg = "saved successfully";
        }
        else{
            $save_data['created_at'] = time();
            $this->settings->employers_setttings_add($save_data);
            $status = "ok";
            $msg = "saved successfully";
        }
        
        $rsp = array(
            "status" => $status,
            "msg" => $msg
        );
        echo json_encode($rsp); die;
    }
    
    public function update_2_hours_pending_interview(){
        $r = $this->db->query("SELECT id,job_applied_id,interview_accept_date FROM jobs_applied_pending_interviews ORDER BY id DESC ");
        $now = time();
        if($r->num_rows() > 0){
            
            $rows = $r->result_array();
            foreach($rows as $row){
                $check_date = $row['interview_accept_date'];
                $check_date = strtotime('+2 hours', $check_date);
                if($now > $check_date){
                    $applied_id = $row['job_applied_id'];
                    $apply = $this->jobs->jobs_applied_get($applied_id);
                    if($apply){
                        $update_data["interview"] = 1;
                        $update_data["interview_complete"] = 1;
                        $this->jobs->jobs_applied_update($apply['id'] , $update_data);
                        $jobseeker_id = $apply["jobseeker_id"];
                        $employer_id = $apply["employer_id"];
                        
                        // delete from 
                        $this->db->where("id",$row['id']);
                        $this->db->delete("jobs_applied_pending_interviews");
                    }
                }
            }
            
        }
    }
    public function update_employer_emails(){
        $this->layout = "blank";
        
        $status = "error";
        $msg = "oops something went wrong, please try again";
        
        $session = $this->session->all_userdata();
        if(!isset($session['employer'])){
            redirect('employer/signin');
        }
        
        $employer = $session['employer'];
        
        $employer_id = $employer['id'];
        
        $this->load->library('form_validation');
        $config = array(
            array('field' => 'change_email', 'label' => 'Email', 'rules' => 'trim|required|valid_email|xss_clean')
        );
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() === TRUE) {
        
            $save_data["email"] = $this->input->post("change_email");

            $email_exist = $this->employer->get_employer_email_for_edit($employer_id, $save_data["email"]);
            if(!$email_exist){
                
                $this->employer->employers_update($employer_id , $save_data);
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
    public function update_employer_password(){
        $this->layout = "blank";
        
        $status = "error";
        $msg = "oops something went wrong, please try again";
        
        $session = $this->session->all_userdata();
        if(!isset($session['employer'])){
            redirect('employer/signin');
        }
        
        $employer = $session['employer'];
        
        $employer_id = $employer['id'];
        
        $this->load->library('form_validation');
        $config = array(
            array('field' => 'change_password', 'label' => 'Email', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'confirm_change_password', 'label' => 'Email', 'rules' => 'trim|required|xss_clean')
        );
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() === TRUE) {
        
            $save_data["password"] = md5($this->input->post("change_password"));

            $employer_exist = $this->employer->employers_get($employer_id);
            if($employer_exist){
                
                $this->employer->employers_update($employer_id , $save_data);
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
        $this->session->unset_userdata("job_mode_type");
        $this->session->unset_userdata("job_recent_id");
        
        $job_id = ($this->input->post("recent_job_id")) ? $this->input->post("recent_job_id") : 0;
        
        $data["specialties"] = $this->get_specialties('parent');
        
        if($job_id != 0){
            $data["job"] = $this->jobs->jobs_get($job_id);
            $this->session->set_userdata("job_recent_id",$job_id);
            
            $data['sub_specialty'] = $this->specialty->specialties_get_by_type("sub" , $data['job']["specialty"]);
            $this->session->set_userdata("job_mode_type","update");
        }
        else{
            $this->session->set_userdata("job_mode_type","add");
        }
        
        $html = $this->load->view('employer/job/post_step_1', $data, TRUE);

        $array = array(
            "status" => "ok",
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    public function save_job_post_step_1(){
        $session = $this->session->all_userdata();
        $empoyer_id = (isset($session['employer']['id'])) ? $session['employer']['id'] : 0;

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
            
            $save_data['employer_id'] = $empoyer_id;
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
            
            $id = $this->session->userdata("job_recent_id");
            if($id){
                unset($save_data['step']);
                unset($save_data['created_at']);
                $save_data['updated_at'] = time();
                $this->jobs->jobs_update($id , $save_data);
            }
            else{
                $id = $this->jobs->jobs_add($save_data);
            }
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
        
        $id = $this->session->userdata("job_recent_id");
        if($id){
            $data["job"] = $this->jobs->jobs_get($id);
        }
        
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
        $mode_type = $this->session->userdata("job_mode_type");
        
        if($mode_type == "update"){
            unset($save_data['step']);
            $mode = "update";
        }
        
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
        
        $id = $this->session->userdata("job_recent_id");
        if($id){
            $data["job"] = $this->jobs->jobs_get($id);
        }
        
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
            
            $mode_type = $this->session->userdata("job_mode_type");
            if($mode_type == "update"){
                unset($save_data['step']);
                $mode = "update";
            }
            
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
        
        $id = $this->session->userdata("job_recent_id");
        if($id){
            $data["job"] = $this->jobs->jobs_get($id);
        }
        
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
            
            $mode_type = $this->session->userdata("job_mode_type");
            if($mode_type == "update"){
                unset($save_data['step']);
                $mode = "update";
            }
        
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
        
        $id = $this->session->userdata("job_recent_id");
        if($id){
            $data["job"] = $this->jobs->jobs_get($id);
        }
        
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
        $mode = "";                
        $this->load->helper("sajari");
             
        $save_data["citizen"] = ($this->input->post("citizen") == "true") ?  "yes" : "no" ;
        $save_data["green_card"] = ($this->input->post("green_card") == "true") ?  "yes" : "no" ;
        $save_data["visa"] = ($this->input->post("visa") == "true") ?  "yes" : "no" ;
        $save_data['description'] = $this->input->post('description');
        $save_data['step'] = 5;
        

        $id = $this->session->userdata("job_recent_id");
        
        $mode_type = $this->session->userdata("job_mode_type");
        if($mode_type == "update"){
            unset($save_data['step']);
            $mode = "update";
        }
        $id = $this->jobs->jobs_update($id , $save_data);

        if($id > 0){
            $status = "ok";
            
            $job = $this->jobs->jobs_get($id); 
            
            $facility = $this->employer_facility->employers_facility_get_by_employer_id($job['employer_id']);
            if($facility){
                $city = ( isset($facility['city']) ) ? $facility['city'] : "";
                $state = ( isset($facility['state']) ) ? $facility['state'] : ""; 
                $this->load->library("google/google_geolocation");
                $location = $this->google_geolocation->get_logitute_latitude( array( "address"=> $city."+".$state."+US" ) );

                if(isset($location['lat']) && isset($location['lng'])){
                    $lat = $location['lat'];
                    $lng = $location['lng'];
                    $save_data_lat_lng['lat'] = $lat;
                    $save_data_lat_lng['lng'] = $lng;
                    $this->jobs->jobs_update($id , $save_data_lat_lng);
                }
            }
            
            if($job['sajari_doc_id'] == ""){
                // ADD to sajari
                $params = array(
                    'meta' => $job
                );
                $rsp = sajari_api("sajari_add", $params);
                $sajari_doc_id = $rsp->result;
                $save_data = array();
                $save_data["sajari_doc_id"] = $sajari_doc_id;
                $id = $this->jobs->jobs_update($id , $save_data);
            }
            else{
                // UPDATE to sajari 
                $params = array(
                    'meta' => $job,
                    'id' => $job['sajari_doc_id']
                );
                $rsp = sajari_api("sajari_replace", $params);
            }
        }
        else{
            $status = "error";
            $msg = "Oops something went wrong please try again";
        }
            
        $array = array(
            "status" => $status,
            "msg" => $msg,
            "mode" => $mode
        );
        echo json_encode($array); die;
    }
    
    public function job_post_step_6(){
        $this->layout = "blank";
        $data = array();
        
        $id = $this->session->userdata("job_recent_id");
        if($id){
            $data["job"] = $this->jobs->jobs_get($id);
        }
        
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
        $this->load->helper("sajari");
        
        $id = $this->session->userdata("job_recent_id");
        $data['job_recent_id'] = $id;
        $job = $this->jobs->jobs_get($id); 
        $data['job'] = $job;
        $data["employer"] = $this->employer->employers_get($job['employer_id']);
        
        $html = $this->load->view('employer/job/post_step_7', $data, TRUE);
        
        if($id > 0){
            
            $save_data['step'] = 7;
            $save_data['active'] = 1;
            $save_data['created_at'] = time();
            
            $facility = $this->employer_facility->employers_facility_get_by_employer_id($data["employer"]['id']);
            if($facility){
                $city = ( isset($facility['city']) ) ? $facility['city'] : "";
                $state = ( isset($facility['state']) ) ? $facility['state'] : ""; 
                $this->load->library("google/google_geolocation");
                $location = $this->google_geolocation->get_logitute_latitude( array( "address"=> $city."+".$state."+US" ) );

                if(isset($location['lat']) && isset($location['lng'])){
                    $lat = $location['lat'];
                    $lng = $location['lng'];
                    $save_data['lat'] = $lat;
                    $save_data['lng'] = $lng;
                }
            }
            
            $id = $this->jobs->jobs_update($id , $save_data);
            
            if($job['sajari_doc_id'] == ""){
                // ADD to sajari
                $params = array(
                    'meta' => $job
                );
                $rsp = sajari_api("sajari_add", $params);
                $sajari_doc_id = $rsp->result;
                $save_data = array();
                $save_data["sajari_doc_id"] = $sajari_doc_id;
                $id = $this->jobs->jobs_update($id , $save_data);
            }
            else{
                // UPDATE to sajari 
                $params = array(
                    'meta' => $job,
                    'id' => $job['sajari_doc_id']
                );
                $rsp = sajari_api("sajari_replace", $params);
            }
            
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
        
        $employer_id = ( $this->input->post("employer_id") ) ? $this->input->post("employer_id") : 0 ;
        
        $status = '';
        $msg = '';
        $this->load->library('custom_image_lib');
        $lib_config['create_thumb'] = true;
        $lib_config['thumb_sizes'] = array(
           array('width' => 150, 'height' => 185)
        );
        $this->custom_image_lib->config($lib_config);
        
        $profile_images = $this->custom_image_lib->upload($_FILES['profile_image'], 'uploads/employers/profiles/');
        
        if($profile_images){
            $file = pathinfo($profile_images[0], PATHINFO_FILENAME);
            $ext = pathinfo($profile_images[0], PATHINFO_EXTENSION);
            $thumbnail_name =  $file."_".$lib_config['thumb_sizes'][0]["width"]."_".$lib_config['thumb_sizes'][0]["height"].".".$ext;
            $thumbnail_name = $thumbnail_name."?v=".time();
            $status = "ok";
            $msg = "success";
            
            $save_data['profile_image'] = $profile_images[0];
            $this->employer->employers_update($employer_id, $save_data);
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
    public function delete_job(){
        $this->layout = "blank";
        $msg = "";
        $status = "";
        
        $id = ($this->input->post("job_id")) ? $this->input->post("job_id") : 0 ;
        $r = $this->jobs->jobs_get($id);
        
        if($r){
            $r = $this->jobs->jobs_delete($id);
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
    
    public function update_job_status(){
        $this->layout = "blank";
        $status = "";
        $msg = "oops something went wrong";
        $html = "";
        
        $session = $this->session->all_userdata();

        $employer_id = ( isset($session['employer']['id']) ) ? $session['employer']['id'] : 0 ;
        $employer = $this->employer->employers_get($employer_id);
        if($employer){
            $sub_data = $this->employers_subscription->subscription_get_by_user_id($employer['id']);
            if( !( isset($sub_data['status']) && $sub_data['status'] == "active") ){
                // user is not subscribe 
                $status = "not_subscribe";
                $msg = "user not subscribe";
                $html = $this->load->view('employer/payment_popup', array(), TRUE);
            }
            
        }
        
        if($status != "not_subscribe"){
                    
            $type = $this->input->post("type") ? $this->input->post("type") : "";
            $id = $this->input->post("id") ? $this->input->post("id") : "";

            if($type != "" && $id > 0){

                $job_apply = $this->jobs->jobs_applied_get($id);
                if($job_apply){

                    if($type === "matched"){
                        $save_data['matched'] = 1;
                        $this->jobs->jobs_applied_update($id, $save_data);
                        $status = "ok";
                        $msg = "Saved successfully";
                        
                        $this->job_applied_status_matched($job_apply);
                    }
                    else if($type === "interview"){
                        $save_data['interview'] = 1;
                        $this->jobs->jobs_applied_update($id, $save_data);
                        $status = "ok";
                        $msg = "Saved successfully";
                        
                        $this->job_applied_status_interview($job_apply);
                    }
                    else if($type === "interview_complete"){
//                        $save_data['interview_complete'] = 1;
//                        $this->jobs->jobs_applied_update($id, $save_data);
//                        $status = "ok";
//                        $msg = "Saved successfully";
                    }
                    else if ($type === "face_2_face" || $type === "job_offer"){
                        $status = "ok";
                        $msg = "Saved successfully";
                        
                        if($type === "face_2_face"){
                            
                            
                        }
                    }



                }
            }
        }
        $rsp = array(
            "status" => $status,
            "msg" => $msg,
            "html" => $html
        );
        echo json_encode($rsp); die;
    }
    function job_applied_status_matched($job_apply){
        $this->load->model('jobseeker_model', 'jobseeker');
        
        // if job seeker setting is yes or default
        $setting = $this->jobseeker_settings->jobseekers_setttings_get_by_jobseeker($job_apply['jobseeker_id']);
        $send_email = TRUE;
        if( (isset($setting['when_match_email']) && $setting['when_match_email'] == 1) || $setting == FALSE ){
            $send_email = TRUE;
        }
        else{
            $send_email = FALSE;
        }
        if($send_email){
            $jobseeker = $this->jobseeker->jobseekers_get($job_apply['jobseeker_id']);
            $email_data['to'] = $jobseeker['email'];
            $email_data['subject'] = "Job Matched";

            $job = $this->jobs->jobs_get($job_apply['job_id']);
            $patterns = array(
                '{JOB_HEADING}' => $job['job_headline'],
                '{JOB_INTERNAL_ID}' => $job['internal_id']
            );
            send_template_email("job/matched",$email_data, $patterns);
        }
        
        // send text to jobseeker
        $send_text = TRUE;
        if( (isset($setting['when_match_phone']) && $setting['when_match_phone'] == 1 ) || $setting == FALSE ){
            $send_text = TRUE;
        }
        else{
            $send_text = FALSE;
        }
        
        if($send_text){
            
            $jobseeker = $this->jobseeker->jobseekers_get($job_apply['jobseeker_id']);
            $job = $this->jobs->jobs_get($job_apply['job_id']);
            
            $this->load->library('twilio');
            $from = '+13126354633';
            $to = $jobseeker['phone'];
            
            $message = "Job was Matched "."\n";
            $message .= "Job Heading : ".$job['job_headline']."\n";
            $message .= "Job Internal ID : ".$job['internal_id']."\n";
            $response = $this->twilio->sms($from, $to, $message);
            
        }
        
        
    }
    function job_applied_status_interview($job_apply){
        $this->load->model('jobseeker_model', 'jobseeker');
        
        // if job seeker setting is yes or default
        $setting = $this->jobseeker_settings->jobseekers_setttings_get_by_jobseeker($job_apply['jobseeker_id']);
        $send_email = TRUE;
        if( (isset($setting['when_interview_offer_email']) && $setting['when_interview_offer_email'] == 1 ) || $setting == FALSE ){
            $send_email = TRUE;
        }
        else{
            $send_email = FALSE;
        }
        
        if($send_email){
            $jobseeker = $this->jobseeker->jobseekers_get($job_apply['jobseeker_id']);
            $email_data['to'] = $jobseeker['email'];
            $email_data['subject'] = "Job Interview";
            $email_data['job_applied_id'] = $job_apply['id'];
            $job = $this->jobs->jobs_get($job_apply['job_id']);

            $patterns = array(
                '{JOB_HEADING}' => $job['job_headline'],
                '{JOB_INTERNAL_ID}' => $job['internal_id']
            );
            send_template_email("job/interview",$email_data, $patterns);
        }
        
        // send text to jobseeker
        $send_text = TRUE;
        if( ( isset($setting['when_interview_offer_phone']) && $setting['when_interview_offer_phone'] == 1) || $setting == FALSE ){
            $send_text = TRUE;
        }
        else{
            $send_text = FALSE;
        }
        if($send_text){
            
            $jobseeker = $this->jobseeker->jobseekers_get($job_apply['jobseeker_id']);
            $job = $this->jobs->jobs_get($job_apply['job_id']);
            
            $this->load->library('twilio');
            $from = '+13126354633';
            $to = $jobseeker['phone'];
            
            $message = "You have been offered an interview "."\n";
            $message .= "Job Heading : ".$job['job_headline']."\n";
            $message .= "Job Internal ID : ".$job['internal_id']."\n";
            $response = $this->twilio->sms($from, $to, $message);
            
        }
    }
    
    function job_applied_status_face_2_face($job_apply){
        error_reporting(E_ALL);
ini_set('display_errors', 1);

        $this->load->model('jobseeker_model', 'jobseeker');
        $this->load->model('jobseeker_notifications_model', 'notification');
        
        // You're on a roll.  You have been offered a face to face.
        $noti_data["jobseeker_id"] = $job_apply["jobseeker_id"];
        $noti_data["employer_id"] = $job_apply["employer_id"];
        $noti_data["job_id"] = $job_apply["job_id"];
        $noti_data["job_applied_id"] = $job_apply["id"];
        $this->notification->jobseeker_notifications_add($noti_data);
        
        // if job seeker setting is yes or default
        $setting = $this->jobseeker_settings->jobseekers_setttings_get_by_jobseeker($job_apply['jobseeker_id']);
        $send_email = TRUE;
        if( (isset($setting['when_face_2_face_offer_email']) && $setting['when_face_2_face_offer_email'] == 1) || $setting == FALSE ){
            $send_email = TRUE;
        }
        else{
            $send_email = FALSE;
        }
        
        if($send_email){
            $jobseeker = $this->jobseeker->jobseekers_get($job_apply['jobseeker_id']);
            $email_data['to'] = $jobseeker['email'];
            $email_data['subject'] = "Job - Face 2 Face";
            $email_data['job_applied_id'] = $job_apply['id'];

            $job = $this->jobs->jobs_get($job_apply['job_id']);
            $job_apply = $this->jobs->jobs_applied_get($job_apply['id']);
            $patterns = array(
                '{JOB_HEADING}' => $job['job_headline'],
                '{JOB_INTERNAL_ID}' => $job['internal_id'],
                '{DATE_1}' => formate_date($job_apply['f2f_date_1']),
                '{DATE_2}' => formate_date($job_apply['f2f_date_2']),
                '{DATE_3}' => formate_date($job_apply['f2f_date_3'])
            );
            send_template_email("job/face_2_face",$email_data, $patterns);
        }
        
        // send text to jobseeker
        $send_text = TRUE;
        if( (isset($setting['when_face_2_face_offer_phone']) && $setting['when_face_2_face_offer_phone'] == 1) || $setting == FALSE ){
            $send_text = TRUE;
        }
        else{
            $send_text = FALSE;
        }
        if($send_text){
            $jobseeker = $this->jobseeker->jobseekers_get($job_apply['jobseeker_id']);
            $job = $this->jobs->jobs_get($job_apply['job_id']);
            $job_apply = $this->jobs->jobs_applied_get($job_apply['id']);
            
            $this->load->library('twilio');
            $from = '+13126354633';
            $to = $jobseeker['phone'];
            
            $message = "You're on a roll.  You have been offered a face to face. "."\n";
            $message .= "Job Heading : ".$job['job_headline']."\n";
            $message .= "Job Internal ID : ".$job['internal_id']."\n";
            $message .= "Date 1 : ".$job_apply['f2f_date_1']."\n";
            $message .= "Date 2 : ".$job_apply['f2f_date_2']."\n";
            $message .= "Date 3 : ".$job_apply['f2f_date_3']."\n";
            $response = $this->twilio->sms($from, $to, $message);
        }
    }
    
    public function popup_face_2_face(){
        $this->layout = "blank";
        
        $data['id'] = $this->input->post("id") ? : 0 ;
        $data['btn_id'] = $this->input->post("btn_id") ? : 0 ;
        
        $html = $this->load->view('employer/dashboard/popup_face_2_face', $data, TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    function save_face_2_face_dates(){
        $this->layout = "blank";
        
        $status = "";
        $msg = "oops something went wrong";
        
        $id = $this->input->post("id") ? $this->input->post("id") : 0;
        $date_1 = $this->input->post("date_1") ? $this->input->post("date_1") : 0;
        $date_2 = $this->input->post("date_2") ? $this->input->post("date_2") : 0;
        $date_3 = $this->input->post("date_3") ? $this->input->post("date_3") : 0;
        
        
        $job_apply = $this->jobs->jobs_applied_get($id);
        if($job_apply){
            $save_data['f2f_date_1'] = strtotime($date_1);
            $save_data['f2f_date_2'] = strtotime($date_2);
            $save_data['f2f_date_3'] = strtotime($date_3);
            $save_data['face_2_face'] = 1;
            $this->jobs->jobs_applied_update($id, $save_data);
            
            $status = "ok";
            $msg = "saved successfully";
            
            $this->job_applied_status_face_2_face($job_apply);
        }
        
        
        $rsp = array(
            "status" => $status,
            "msg" => $msg
        );
        echo json_encode($rsp); die;
    }
    public function popup_job_offer(){
        $this->layout = "blank";
        
        $data['id'] = $this->input->post("id") ? : 0 ;
        $data['btn_id'] = $this->input->post("btn_id") ? : 0 ;
        
        $html = $this->load->view('employer/dashboard/popup_job_offer', $data, TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    
    function upload_job_offer(){
        $this->layout = "blank";
        
        $id = ( $this->input->post("id") ) ? $this->input->post("id") : 0 ;
        
        $status = '';
        $msg = '';
        $this->load->library('custom_image_lib');
        
        if($_FILES['job_letter']['name'][0] != ""){
            
            $old_file = pathinfo($_FILES['job_letter']['name'][0], PATHINFO_FILENAME);
            $old_ext = pathinfo($_FILES['job_letter']['name'][0], PATHINFO_EXTENSION);

            $lib_config['new_file_name'] = $id."_job_letter_".$old_file.".".$old_ext;
            $lib_config['allowed_types'] = 'pdf|doc|docx';
            $this->custom_image_lib->config($lib_config);

            $job_offers = $this->custom_image_lib->upload($_FILES['job_letter'], 'uploads/employers/job_offers/');
            
            
            if($job_offers){
                $status = "ok";
                $msg = "success";

                $save_data['job_offer_letter'] = $job_offers[0];
                $save_data['job_offer'] = 1;
                $this->jobs->jobs_applied_update($id, $save_data);
            }
            else{
                $status = "error";
                $msg = "Please Upload file pdf or doc type";
            }
        }
        else{
            $status = "error";
            $msg = "File not selected";
        }
        
        $rsp = array(
            "status" => $status,
            "msg" => $msg
        );
        
        echo json_encode($rsp); die;
        
    }
    public function delete_job_applied(){
        $this->layout = "blank";
        $msg = "";
        $status = "";
        
        $id = ($this->input->post("job_app_id")) ? $this->input->post("job_app_id") : 0 ;
        $job_apply = $this->jobs->jobs_applied_get($id);
        
        if($job_apply){
            $r = $this->jobs->jobs_applied_delete($id);
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
    function sajari_api($file = "sajari_search"){
        // $file = "sajari_search"
        // $file = "sajari_add"
        // $file = "sajari_get"
        $this->load->library("Sajari/sajari");
        
        $params = $this->input->post();
        $rsp = $this->sajari->sajari_request( $file , $params);
        print_r($rsp);
        

    } 

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */