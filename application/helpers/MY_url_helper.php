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

function load_img($src, $alt = "" , $height ="", $width="", $style = "")
{
	$CI =& get_instance();
        $img = '<img src="'.base_url('assets/img/'.$src.'?v='.time());
        
        if($alt != ""){
            $img = $img. ' alt="'.$alt.'" ';
        }
        if($height != ""){
            $img = $img. ' height="'.$height.'" ';
        }
        if($width != ""){
            $img = $img. ' width="'.$width.'" ';
        }
        if($style != ""){
            $img = $img. ' style="'.$style.'" ';
        }
        $img =  $img . ' />';
	return $img."\n";
}