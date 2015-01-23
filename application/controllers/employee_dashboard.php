<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employee_dashboard extends MY_EmployerController {

    
    function __construct() {
        parent::__construct();
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

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */