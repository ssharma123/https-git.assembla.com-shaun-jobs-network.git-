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

if(!function_exists('get_locations_home_page')) 
{
    function get_locations_home_page(){
        $that = & get_instance();
        $q = " SELECT *,COUNT(*) AS total FROM `cities` WHERE `country` LIKE 'US' GROUP BY name HAVING total = 1  ";
        $r = $that->db->query($q);
        if($r->num_rows()>0){
            $rows = $r->result_array();
            foreach ($rows as $val){
                $temp = array();
                $temp['id'] = $val['name'];
                $temp['name'] = $val['name'];
                $output[] = $temp;
            }
            return json_encode($output);
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
if(!function_exists('get_facility_info_by_job')) 
{
    function get_facility_info_by_job($employer_id){
        $that = & get_instance();
        $q = "SELECT city , state FROM employers_facilities WHERE employer_id = '$employer_id' ";
        $r = $that->db->query($q);
        if($r->num_rows()>0){
            $row = $r->row_array();
            return $row;
        }
        return FALSE;
    }
}


if(!function_exists('get_match_class')) 
{
    function get_match_class($percent){
        $class = "grey";
        if($percent > 90){
            $class = "red";
        }
        else if($percent > 80){
            $class = "orange";
        }
        else if($percent > 70){
            $class = "yellow";
        }
        else if($percent > 60){
            $class = "green";
        }
        else if($percent > 50){
            $class = "blue";
        } 
        return $class;
    }
}
if(!function_exists('get_match_color')) 
{
    function get_match_color($percent){
        $color = "#666666";
        if($percent > 90){
            $color = "#C7585F";
        }
        else if($percent > 80){
            $color = "#EB7D24";
        }
        else if($percent > 70){
            $color = "#FFB404";
        }
        else if($percent > 60){
            $color = "#2DCC70";
        }
        else if($percent > 50){
            $color = "#38B3B0";
        } 
        return $color;
    }
}
if(!function_exists('jobs_sort_by_percent')){
    function jobs_sort_by_percent($a, $b){
        $a = $a['percent'];
        $b = $b['percent'];
        if ($a == $b)
        {
            return 0;
        }
        return ($a > $b) ? -1 : 1;
    }
}
if(!function_exists('show_salary')){
    function show_salary($salary){
        $output = "";
        if($salary === 0){
            return $output;
        }
        else if($salary > 1000){
            $output = ceil($salary / 1000)."K";
        }
        else{
            $output = $salary;
        }
        return $output;
    }
}

function manage_job_percentage( $row, $kilometer){
    
    $percent = ($row['rawscore'] * $row['score']) * 100;
    
    if( isset($row['calculation']['geohit']) && $row['calculation']['geohit'] != "" ){
        var_dump("****");
        $geohit = $row['calculation']['geohit'];
        var_dump($geohit);
        if($geohit == "true"){
            $percent = $percent + 15;
        }
        else if($geohit == "false"){
            var_dump($kilometer);
            if($kilometer !== 0){
                var_dump($row['calculation']['haversine']);
                if(isset($row['calculation']['haversine']) && $row['calculation']['haversine'] > 0){
                    $distance = $row['calculation']['haversine'];
                    if($distance <= $kilometer){
                        $percent = $percent + 15;
                    }
                }
            }
        }
        else{
            
        }
        var_dump("****");
    }
    
    $percent = (int) ceil( $percent );
    if($percent>100){
        $percent = 100;
    }
    else if($percent<=0){
        $percent = 0; 
    }
    
    return $percent;
}
    

/* GET data from countries , cites , states END */


/**************************************************************/

