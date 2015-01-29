<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(! function_exists('send_template_email'))
{
	function send_template_email($type , $email_data = array() , $patterns = array() )
	{

		$that = & get_instance();
		
                $email_template = $that->config->item("email_template",'site_setting');
                
                $subject = $email_data['subject'];
                $to = $email_data['to'];
                
                $from = $email_template['from_email'];
                if(isset($email_data['from'])){
                    $from = $email_data['from'];
                }
                
                if(isset($email_data['body']) && $email_data['body'] != ''){
                    $body = $email_data['body'];
                }
                else{
                    $body = $that->load->view("email_templates/".$type,array(),TRUE);
                    if(count($patterns) > 0){
                        $body = replace_body_patters($body , $patterns);
                    }
                }
                var_dump($email_data);
                echo $body;
                die;
                
                $email_from_title = (isset($email_data['email_from_title'])) ? $email_data['email_from_title'] : "" ;
            
                $config['mailtype'] = 'html';
                $config['charset'] = 'iso-8859-1';
                $config['wordwrap'] = TRUE;
                $that->load->library('email');
                $that->email->initialize($config);
                $that->email->from($from, $email_from_title);
                $that->email->to($to);
                $that->email->subject($subject);
                $that->email->message($body);
                try {
                    $that->email->send();
                    //echo $CI->email->print_debugger(); die;
                } catch(Exception $ex){
                    echo $that->email->print_debugger();
                    exit;
                }		
	}
}

if (!function_exists('replace_body_patters')) {

    function replace_body_patters($body, $patterns) {
        foreach ($patterns as $key => $value) {
            $body = str_replace($key, $value, $body);
        }

        return $body;
    }

}