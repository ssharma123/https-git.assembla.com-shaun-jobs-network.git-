<div class="row-wrapper">
    
    
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
            
            
            if($jobs){
                
//                echo "<pre>"; print_r($jobs); echo "</pre>";  

                $salary = $jobseeker['salary'];
                $specialty = $jobseeker['specialty'];
                $sub_specialty = $jobseeker['sub_specialty'];
                $departmant_size = $jobseeker['institution_type'];
                
                $state = $jobseeker['state'];
                $city = $jobseeker['city'];
                $zip = $jobseeker['zip'];
                
                $availability = $jobseeker["availability"];
                $current_employed = "";
                
                
                foreach($jobs as $key => $row){ 
                    $percent = 0;
                    
                    $points_matched = 0;
                    $total_points = 7;
                    
                    
                    // check salary range
                    if( isset($salary) && $salary!="" ){
                        if( $salary >= $row['salary_range_min'] && $salary <= $row['salary_range_max']){
                            $points_matched++;
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
                        if( $departmant_size == "academic_institution" && $row["department_size"] == "0-5" ){
                            $points_matched++;
                        }
                        else if( ($departmant_size == "clinic" || $departmant_size == "private_practice" ) && ( $row["department_size"] == "5-10" || $row["department_size"] == "10-20" ) ){
                            $points_matched++;
                        }
                        else if( ($departmant_size == "group_practice" || $departmant_size == "hospital" ) && ( $row["department_size"] == "20-40" || $row["department_size"] == "40+" ) ){
                            $points_matched++;
                        }
                    }
                    
                    // check location & miles 
                    if( ( $state!="" && $city != "" ) ){
                        // which filed to match for jobs
                        // get two points lat lng and calculate distance between two lat lng
                        
                        if( strcasecmp ($row["state"], $state) == 0){
                            $points_matched++;
                        }
                        if( strcasecmp ($row["city"], $city) == 0 ){
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
                    $percent_class = get_match_class($percent);
                    $percent_color = get_match_color($percent);
                    
                    $jobs[$key]['percent'] = $percent;
                    $jobs[$key]['percent_class'] = $percent_class;
                    $jobs[$key]['percent_color'] = $percent_color;
                }
                
                usort($jobs, "jobs_sort_by_percent" );
                
                foreach($jobs as $row){ 
                    ?>
                <div class="p-container-inner-box job_match_div" style="cursor: pointer; " data-id="<?php echo $row['id']; ?>" data-percent="<?php echo $row['percent']; ?>" data-dashboard="yes" >
                    <div class="<?php echo $row['percent_class']; ?>">
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
                                    <input data-readOnly="true" data-fgColor="<?php echo $row['percent_color']; ?>" class="knob" data-width="100" data-displayInput="true" value="<?php echo $row['percent']; ?>" >
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
    
</div>
<?php echo load_js("jquery.knob.min.js"); ?>
<script>
    $(".knob").knob({
        'draw' : function () { 
                $(this.i).val(this.cv + '%')
        }
    })
    $(".knob").show();
    
    $("#tabContent").on("click","#back_job_details",function(){
        $(".job_match_div_tab").show();
        $("#job_match_detail_block").hide();
    });
    $("#tabContent").on("click",".job_match_div_tab",function(){
        // get id 
        // get job details data 
        $(".job_match_div_tab").hide();
        $("#job_match_detail_block").show();
        // show detail data
        
    });
</script>