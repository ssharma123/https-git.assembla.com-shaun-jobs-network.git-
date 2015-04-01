<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crons extends CI_Controller {

	 
	public function send_email_to_non_active_employer()
	{
            $time = time();
            $five_days_time = strtotime('-5 days',$time);
            $ten_days_time = strtotime('-10 days',$time);
            $sixty_days_time = strtotime('-60 days',$time);
            
            $q = "SELECT * FROM employers WHERE login_time < $five_days_time AND email_send_5_days = '0' ";
            $r = $this->db->query($q);
            if($r->num_rows() > 0){
                $users = $r->result_array();
                foreach ($users as $user){
                    // send email to that user
                }
            }
            
            $q = "SELECT * FROM employers WHERE login_time < $ten_days_time AND email_send_10_days = '0' ";
            $r = $this->db->query($q);
            if($r->num_rows() > 0){
                $users = $r->result_array();
                foreach ($users as $user){
                    // send email to that user
                }
            }
            
            
            $q = "SELECT * FROM employers WHERE login_time < $sixty_days_time AND email_send_60_days = '0' ";
            $r = $this->db->query($q);
            if($r->num_rows() > 0){
                $users = $r->result_array();
                foreach ($users as $user){
                    // send email to that user
                }
            }
            die;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */