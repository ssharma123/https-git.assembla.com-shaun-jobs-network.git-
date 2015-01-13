<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function load_js($file, $path_to_file = '')
{
	$CI =& get_instance();
        if($path_to_file != ""){
            $src = base_url($path_to_file.$file.'?v='.time());
        }
        else{
            $src = base_url('assets/js/'.$file.'?v='.time());
        }
	return '<script type="text/javascript" src="'.$src.'"></script>'."\n";
}

function load_css($file , $path_to_file = '')
{
	$CI =& get_instance();
        if($path_to_file != ""){
            $href = base_url($path_to_file.$file.'?v='.time());
        }
        else{
            $href = base_url('assets/css/'.$file.'?v='.time());
        }
	return '<link href="'.$href.'" type="text/css" rel="stylesheet" />'."\n";
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