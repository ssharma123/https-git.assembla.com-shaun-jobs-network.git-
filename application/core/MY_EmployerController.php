<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_EmployerController extends CI_Controller {

    var $js = array();
    var $js_top = array();
    var $css = array();
    var $globalSettings = NULL;
    var $pageLoadScript = '';
    var $title = 'Med Match';
    var $meta_title = 'Med Match';
    var $meta_description = 'Med Match';
    var $meta_keyword = 'Med Match';
    var $google_analytics = '';
    var $availableColors = NULL;
    var $availableSizes = NULL;

    function __construct() {
        parent::__construct();
        $params = $this->router->fetch_method();
        $excluded_auth = array();

        $this->globalSettings = $this->config->item('global_settings');
        $this->load->helper('common');
    }

    public function siteAuthenticate() {
        if (!$this->session->userdata('id')) {
            redirect('/');
        }
    }

}
