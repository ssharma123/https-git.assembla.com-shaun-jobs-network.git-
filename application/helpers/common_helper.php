<?php


if(!function_exists('formate_date')) {
    function formate_date($datetime,$formate = ""){
        $default_formate = ($formate == "") ? "F j, Y, g:i a" : $formate;
        $formated_datetime = date($default_formate,$datetime);
        return $formated_datetime;
    }
}


if (!function_exists('upload_img_thumb')) {

    function upload_img_thumb($image, $w = '', $h = '') {
        if ($image != "") {
            $img = explode('.', $image);
            $thumb = $img[0] . "_" . $w . "_" . $h . "." . $img[1];
            return $thumb;
        }
    }

}


function ago($time) { 
    $timediff=time()-$time; 

    $days=intval($timediff/86400);
    $remain=$timediff%86400;
    $hours=intval($remain/3600);
    $remain=$remain%3600;
    $mins=intval($remain/60);
    $secs=$remain%60;

    if ($secs>=0) $timestring = "0m".$secs."s";
    if ($mins>0) $timestring = $mins."m".$secs."s";
    if ($hours>0) $timestring = $hours."u".$mins."m";
    if ($days>0) $timestring = $days."d".$hours."u";

    return $timestring; 
}



if (!function_exists('trim_str')) {

    function trim_str($str, $char_length = 150, $suffix = "...", $prefix = "") {
        $output = $str;
        $length = strlen($str);
        if($length > $char_length){
            $output = $prefix;
            $output .= substr($str,0,$char_length);
            $output .= $suffix;
        }
        return $output;
    }

}

if(!function_exists('filter')) 
{
    function filter($output){
        $output=stripslashes($output);
        $output=htmlentities($output);
        $output=strip_tags($output);
        return utf8_encode($output);
    }
}

/* GET data from countries , cites , states */
if(!function_exists('get_states')) 
{
    function get_states($where = "" ){
        $that = & get_instance();
        
        if( is_array($where) ){
            $that->db->where($where);
        } 
        $r = $that->db->get("states");
        if($r->num_rows()>0){
            $rows = $r->result_array();
            return $rows;
        }
        return FALSE;
        
    }
}
if(!function_exists('get_countries')) 
{
    function get_countries($where = "" ){
        $that = & get_instance();
        
        if( is_array($where) ){
            $that->db->where($where);
        } 
        $r = $that->db->get("countries");
        if($r->num_rows()>0){
            $rows = $r->result_array();
            return $rows;
        }
        return FALSE;
        
    }
}
/* ** */

if(!function_exists('get_specialties')) 
{
    function get_specialties($id = 0, $where = "" ){
        $that = & get_instance();
        
        if($id > 0){
            $that->db->where("id",$id);
        }
        if( is_array($where) ){
            $that->db->where($where);
        } 
        $r = $that->db->get("specialties");
        if($r->num_rows()>0){
            if($r->num_rows()==1){
                $rows = $r->row_array();
            }
            else{
                $rows = $r->result_array();
            }
            return $rows;
        }
        return FALSE;
        
    }
}

/* GET data from countries , cites , states END */


/**************************************************************/

