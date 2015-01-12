<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee_dashboard extends MY_EmployerController {

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
            
                $this->layout = "employer_dashboard";
                
		$this->load->view('employer_dashboard');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */