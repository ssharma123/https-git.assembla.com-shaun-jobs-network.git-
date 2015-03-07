<div id="" class="ng-scope">
    <div class="bg_section-11">
        <div class="section-one">
            <hr size="1" width="20%" text-align="center" color="#000000">
            <h1>Top Matches</h1>

            <div class="clear"></div>

        </div>
    </div>
    <div class="wrap">
        <div class="main">
            <div class="content" style="position: relative;">

            </div>
        </div>
    </div>
</div>
<div style="padding-bottom: 100px;" class="ng-scope">

    <!-- Before matches are retrieved.. -->
    <h2 class="text-primary text-center" style="display: none;">Searching..</h2>
    

    <div class="">
        <div class="p-container-slider" id="job_match_list_id">
            <div>
                <div class="p-first-box" style="padding-left: 50px"><h4>Facility</h4></div>
                <div class="p-second-box">&nbsp;</div>
                <div style="float: left; width: 25px;">&nbsp;</div>
                <div class="p-third-box" style="height: auto; padding-left: 30px"><h4>You Match</h4></div>
                <div class="p-fourth-box" style="padding: 0">&nbsp;</div>
                <div style="clear: both;"></div>
            </div>
            
            
            <?php
            
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            $jobs_sorted_array = array();
            if($jobs_data){
                
                $jobs = $jobs_data['results'];
                foreach($jobs as $key => $obj){ 
                    $obj_array = (array) $obj;

                    $row = (array)$obj_array['meta'];
                    $doc_id = $obj_array['docId'];
                    $score = $obj_array['score'];
                    $rawscore = $obj_array['rawscore'];
                    
                    $percent = 0;
                    
                    $points_matched = 0;
                    $total_points = 7;
                    
                    // check salary range
                    if ( isset($salary_range) && $salary_range != "" ){
                        $salary_range_array = explode("-", $salary_range);
                        $min = $salary_range_array[0];
                        
                        if(isset($salary_range_array[1])){
                            $max = $salary_range_array[1];
                            if( $min >= $row['salary_range_min'] && $max <= $row['salary_range_max']){
                                $points_matched++;
                            }
                        }
                        else{
                            if( $min >= $row['salary_range_min'] && $min <= $row['salary_range_max']){
                                $points_matched++;
                            }
                        }
                        
                    }
                    
                    
                    // check Speciality
                    if( isset($specialty) && $specialty!="" ){
                        if($specialty == $row["specialty"]){
                            $points_matched++;
                        }
                    }
                    // check sub speciality
                    if( isset($sub_specialty) && $sub_specialty!="" ){
                        if($sub_specialty == $row["sub_specialty"]){
                            $points_matched++;
                        }
                    }
                    // department size
                    if( isset($departmant_size) && $departmant_size!="" ){
                        if( $departmant_size == "small" && $row["department_size"] == "0-5" ){
                            $points_matched++;
                        }
                        else if( $departmant_size == "medium" && ( $row["department_size"] == "5-10" || $row["department_size"] == "10-20" ) ){
                            $points_matched++;
                        }
                        else if( $departmant_size == "large" && ( $row["department_size"] == "20-40" || $row["department_size"] == "40+" ) ){
                            $points_matched++;
                        }
                    }
                    
                    // check location & miles 
                    if( (isset($state) && $state!="") && (isset($miles) && $miles!="") ){
                        // which filed to match for jobs
                        // get two points lat lng and calculate distance between two lat lng
                        $points_matched++;
                        if( (strcasecmp($row["state"],$state) == 0 ) || (strcasecmp($row["city"],$state) == 0 ) ){
                            $points_matched++;
                        }
                        
                    }
                    
                    // availability
                    if( isset($availability) && $availability!="" ){
                        // which filed to match for jobs 
                        $points_matched++;
                    }
                    // current_employed
                    if( isset($current_employed) && $current_employed!="" ){
                        // which filed to match for jobs
                        $points_matched++;
                    }
                    
                    $percent = ($points_matched / $total_points ) * 100;
                    $percent = ceil($percent);
                    if($percent < 0){
                        $percent = 0;
                    }
                    if($percent > 100){
                        $percent = 100;
                    }
//                    $percent_class = get_match_class($percent);
//                    $percent_color = get_match_color($percent);
                    
                     
                    
                    $jobs_sorted_array[$key] = (array)$obj_array['meta'];
                    $jobs_sorted_array[$key]['score'] = $score;
                    $jobs_sorted_array[$key]['rawscore'] = $rawscore;
                    $jobs_sorted_array[$key]['percent'] = $percent;
//                    $jobs_sorted_array[$key]['percent_class']= $percent_class;
//                    $jobs_sorted_array[$key]['percent_color']= $percent_color;
                }
                
                
                usort($jobs_sorted_array, "jobs_sort_by_percent" );
                

                
                foreach($jobs_sorted_array as $key => $row){ 
                    $facility = get_facility_info_by_job($row['employer_id']);
                    $row['city']= $facility['city'];
                    $row['state']= $facility['state'];
                    
                    
                    $percent = $row['rawscore'] * 100;
                            
                    $percent_class = get_match_class($percent);
                    $percent_color = get_match_color($percent);
                    
                    ?>
                <div class="p-container-inner-box job_match_div" style="cursor: pointer; " data-id="<?php echo $row['id']; ?>" data-percent="<?php echo $percent; ?>" data-dashboard="no" >
                    <div class="<?php echo $percent_class; ?>">
                        <div class="p-first-box">
                            <div class="p-first-box-main">
                                <div class="p-first-box-main-inner">
                                    <div class="p-main-text-div ng-binding"><?php echo $row['patients_per_day']; ?>+</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-second-box">
                            <div class="p-title-bar ng-binding"><?php echo trim_str($row['job_headline'],60); ?> </div>
                            <div class="p-title-bar-detail ng-binding"><?php echo $row['city'].",".$row['state']?><br>
                                
                                $<?php echo show_salary($row['salary_range_min']); ?> 
                                <?php
                                if($row['salary_range_max'] == 0){
                                    echo "+";
                                } 
                                else { ?>
                                - $<?php echo show_salary($row['salary_range_max']); ?>    
                                <?php 
                                } ?>
                                
                            </div>
                        </div>
                        <div style="float: left; width: 25px;">&nbsp;</div>
                        <div class="p-third-box">
                            <div class="demo">
                                <div style="display: inline; width: 80px; height: 80px;">
                                    <input data-readOnly="true" data-fgColor="<?php echo $percent_color; ?>" class="knob" data-width="100" data-displayInput="true" value="<?php echo $percent; ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="p-fourth-box">
                            <a href="#">
                                <span style="font-size: 35px; font-weight: normal; color: #4a4a4a;" class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                </div>
                <?php 
                }
            } ?>
            				
        </div>
        
        
        <div class="p-container-slider" id="job_match_detail_block" style="display: none;" >
            
        </div>

    </div>

    <!-- Once matches are retrieved -->

    <!-- End of search results -->
    <br><br>
</div>
<?php echo load_js("jquery.knob.min.js"); ?>
<script>
    $(".knob").knob({
        'draw' : function () { 
                $(this.i).val(this.cv + '%')
        }
    })
    $(".knob").show();
</script>