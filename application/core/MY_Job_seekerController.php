<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Job_seekerController extends MY_SiteController {

    var $js = array();
    var $js_top = array();
    var $css = array();
    var $globalSettings = NULL;
    var $pageLoadScript = '';
//    var $title = 'Med Match';
//    var $meta_title = 'Med Match';
//    var $meta_description = 'Med Match';
//    var $meta_keyword = 'Med Match';
//    var $google_analytics = '';

    function __construct() {
        
//        $this->title = $this->title.' - Employer';
        
        parent::__construct();
        $params = $this->router->fetch_method();
        $excluded_auth = array();

//        $this->globalSettings = $this->config->item('global_settings');
        $this->load->helper('common');
    }

    public function siteAuthenticate() {
        if (!$this->session->userdata('id')) {
            redirect('/');
        }
    }

}
