<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employee_dashboard extends MY_EmployerController {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {

        $this->layout = "employer_dashboard";
        
        $session = $this->session->all_userdata();
        if(!isset($session['employer'])){
            redirect('employer/signin');
        }
        
        $data['employer'] = $session['employer'];
        
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

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */