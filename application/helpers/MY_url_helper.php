<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function load_js($file)
{
	$CI =& get_instance();
	return '<script type="text/javascript" src="'.base_url('assets/js/'.$file.'?v='.time()).'"></script>'."\n";
}

function load_css($file)
{
	$CI =& get_instance();
	return '<link href="'.base_url('assets/css/'.$file.'?v='.time()).'" type="text/css" rel="stylesheet" />'."\n";
}

function load_img($file)
{
	$CI =& get_instance();
	return '<img src="'.base_url('assets/img/'.$file.'?v='.time()).'" style="'.$style.'" />'."\n";
}