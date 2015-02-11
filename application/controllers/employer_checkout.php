<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employer_checkout extends MY_EmployerController {

     
    function __construct() {
        parent::__construct();
        $this->load->model('employers_subscription_model', 'employers_subscription');
    }
    
    public function index() {

        $this->layout = "employer";
        
        $session = $this->session->all_userdata();
        if(!isset($session['employer'])){
            redirect('employer/signin');
        }
        
        $data['employer'] = $session['employer'];
        $employer = $session['employer'];
        $user_id = isset($employer['id']) ?  $employer['id'] : 0;
        $sub_data = $this->employers_subscription->subscription_get_by_user_id($user_id);
        $data['sub_data'] = $sub_data;
        
        $this->load->view('employer/checkout', $data);
    }
    public function checkout_process(){
        $this->layout = 'blank';
        $session = $this->session->all_userdata();
        if(!isset($session['employer'])){
            redirect('employer/signin');
        }
        
        
        $config = $this->config->item('site_setting');;
        $paypal_config = $config['paypal'];
//        var_dump($paypal_config);
        // static amount 
        $ip = $_SERVER['REMOTE_ADDR'];
        $data_array['amount'] = 10;
        $data_array = $this->input->post();
        $profile_start_date = date("Y-m-d H:i:s");
//        var_dump($data_array); die;
        
        require_once APPPATH.'libraries/paypal/paypal.class.php';
        
        if($this->input->post()){
            
            $data_array['expirey'] = $this->input->post('expMonth').$this->input->post('expYear');
            
            //$paypal_config['paypal_api_email'],$MYCC_GLOBAL['paypal_api_pass'],$MYCC_GLOBAL['paypal_api_signature'],$MYCC_GLOBAL['paypal_env_end'],true
            $paypal = new paypal($paypal_config['username'], $paypal_config['password'], $paypal_config['signature'], 'sandbox', FALSE);
            $paypal->setOption("METHOD","CreateRecurringPaymentsProfile");
            $paypal->setOption("AMT",$data_array['amount']);
            $paypal->setOption("PROFILESTARTDATE",$profile_start_date);
            $paypal->setOption("BILLINGPERIOD",("Day")); // Day , Month
            $paypal->setOption("BILLINGFREQUENCY",("1"));

            $paypal->setOption("CREDITCARDTYPE",$data_array['ccType']);
            $paypal->setOption("ACCT",$data_array['cc']);
            $paypal->setOption("EXPDATE",$data_array['expirey']);
            $paypal->setOption("CVV2",$data_array['cvv']);
            $paypal->setOption("FIRSTNAME",$data_array['first_name']);
            $paypal->setOption("LASTNAME",$data_array['last_name']);	
            $paypal->setOption("STREET",$data_array['address']);	
            $paypal->setOption("CITY",$data_array['city']);	
            $paypal->setOption("STATE",$data_array['state']);	
            $paypal->setOption("ZIP",$data_array['zip']);	
            $paypal->setOption("COUNTRYCODE",($data_array['country_code']));	
            $paypal->setOption("CURRENCYCODE",("USD"));
            $paypal->setOption("IPADDRESS",$ip);
            $paypal->setOption("INITAMT",$data_array['amount']);

            $paypal->setOption("DESC",'MedMatchMembership');
        
            if($rData = $paypal->startTransection()) {
//                echo "<pre>"; print_r($rData); echo "</pre>"; die;

                if(isset($rData['ACK']) && $rData['ACK']=="Success") {
                    
                    $employer = $session['employer'];
                    $subcription_id = isset($rData['PROFILEID']) ? $rData['PROFILEID'] : '';
                    $save_data['user_id'] = isset($employer['id']) ?  $employer['id'] : '';
                    $save_data['subsription_id'] = $subcription_id;
                    $save_data['status'] = 'pending';
                    $time = time();
                    $save_data['start_date'] = $time;
                    $save_data['end_date'] = strtotime('+1 month',$time);
                    $save_data['created_at'] = $time;
                    
                    if($save_data['user_id'] != "" && $save_data['subsription_id'] != ""){
                        
                        $id = $this->employers_subscription->subscription_add($save_data);
                        if($id){
                            $status = 'ok';
                            $msg = "You have subscribed successfully, your subscription will be activated soon";
                        }
                    }
                    else{
                        $status = 'error';
                        $msg = "oops somthing went wrong. Please try again";
                    }
                }
                else if( isset($rData['ACK']) && ( $rData['ACK'] == "Failure" || $rData['ACK'] == "FailureWithWarning" ) ){
                    $status = 'error';    
                    $msg = isset($rData['L_LONGMESSAGE0']) ? $rData['L_LONGMESSAGE0'] : 'oops somthing went wrong. Unable to complete process with paypal' ;
                }
                else{
                     $status = 'error';
                     $msg = "oops somthing went wrong. Please try again";
                }
            }
            else{
                $status = 'error';
                $msg = "oops somthing went wrong. Please try again";
            }
            $status = rawurlencode($status);
            $msg = rawurlencode($msg);
            redirect('employer_checkout/thankyou/'.$status.'/'.$msg);

        
        }else{
            redirect('employer');
        }
    }
    
    public function paypal_ipn_listner(){
        
//        recurring_payment_profile_created
//        recurring_payment_profile_cancel
//        recurring_payment_profile_modify
//        recurring_payment
//        recurring_payment_skipped
//        recurring_payment_failed
//        recurring_payment_suspended_due_to_max_failed_payment
        
        $this->layout = 'blank';
        if($this->input->post()){
            $post_data = $this->input->post();
            $subscription_id = '';
            $txn_type = '';
            foreach ($post_data as $key => $value) {
                if ($key == 'recurring_payment_id') {
                    $subscription_id = $value;
                }
                if ($key == 'txn_type') {
                    $txn_type = $value;
                }
            }
            
            if($subscription_id != "" && $txn_type == 'recurring_payment_profile_created'){
                
                // recurring_payment_profile_created
                $sub = $this->employers_subscription->subscription_get_by_subscription_id($subscription_id);
                if($sub){
                    $update_data['status'] = 'active';
                    $this->employers_subscription->subscription_update($sub['id'],$update_data);
                }
                
            }
            else if($subscription_id != "" && $txn_type == 'recurring_payment_suspended_due_to_max_failed_payment'){
                // remove subsriptions 
                // insert it in subsription history
                $sub = $this->employers_subscription->subscription_get_by_subscription_id($subscription_id);
                if($sub){
                    $this->employers_subscription->subscription_delete($sub['id']);
                    $save_data = $sub;
                    $save_data["reason"] = $txn_type;
                    $this->employers_subscription->subscription_history_save($save_data);
                }
            }
            
            else if($subscription_id != "" && $txn_type == 'recurring_payment_profile_cancel'){
                // remove subsriptions 
                // insert it in subsription history
                $sub = $this->employers_subscription->subscription_get_by_subscription_id($subscription_id);
                if($sub){
                    $this->employers_subscription->subscription_delete($sub['id']);
                    $save_data = $sub;
                    $save_data["reason"] = $txn_type;
                    $this->employers_subscription->subscription_history_save($save_data);
                }
            }
            
            $log_data['subscription_id'] = $subscription_id;
            $log_data['txn_type'] = $txn_type;
            $log_data['data'] = json_encode($post_data);
            $log_data['created_at'] = time();
            $sub = $this->employers_subscription->subscription_log_save($log_data);
            
        }
    }
    
    public function thankyou($status = '', $msg = ''){
        $this->layout = 'employer';
        
        $status = rawurldecode($status);
        $msg = rawurldecode($msg);
        
        $data['status'] = $status;
        $data['msg'] = $msg;
        
        $this->load->view('employer/thankyou', $data );
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */