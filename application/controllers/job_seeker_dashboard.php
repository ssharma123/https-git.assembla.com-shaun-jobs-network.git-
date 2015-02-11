<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Job_seeker_dashboard extends MY_Job_seekerController {

    
    function __construct() {
        parent::__construct();
        $this->load->model('jobs_model', 'jobs');
        $this->load->model('jobseeker_model', 'jobseeker');
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
        
        $html = $this->load->view('job_seeker/profile/step_1', $data, TRUE);

        $array = array(
            "html" => $html
        );
        echo json_encode($array);
        die;
    }
    
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */