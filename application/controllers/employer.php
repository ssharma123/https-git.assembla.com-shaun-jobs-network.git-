<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employer extends MY_EmployerController {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            $this->layout = "employer";
            $this->load->view('employer/home');
	}
        
        public function signin()
	{
            $this->layout = "employer";
            $this->load->view('employer/signin');
	}
        public function signup($step = 1)
	{
            $this->layout = "employer";
            if($step == 1){
                $this->load->view('employer/signup_1');
            }
            else if($step == 2){
                $this->load->view('employer/signup_2');
            }
            else{
                redirect('employer');
            }
	}
        
        function employer_popup(){
            $this->layout = "blank";
            $html = $this->load->view('employer/signup_popup',array(),TRUE);
            
            $array = array(
              "html" => $html
            );
            echo json_encode($array); die;
        }
        
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */