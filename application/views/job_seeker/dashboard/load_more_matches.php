<?php

$jobs_sorted_array = array();
if($jobs){

    foreach($jobs as $key => $row){ 

        $doc_id = $row['docId'];
        $score = $row['score'];
        $rawscore = $row['rawscore'];
        $meta = $row['meta'];
        $calculation = $row['calculation'];


        $jobs_sorted_array[$key] = $row;
        $jobs_sorted_array[$key]["percent"] = manage_job_percentage( $row , 500);


    }
    if(count($jobs) == $total_count){
        $next_page++;
    }

    usort($jobs_sorted_array, "jobs_sort_by_percent" );

    foreach($jobs_sorted_array as $key => $row){



        $doc_id = $row['docId'];
        $score = $row['score'];
        $rawscore = $row['rawscore'];
        $meta = $row['meta'];
        $calculation = $row['calculation'];



        if(isset($meta['employer_id'])){
            $facility = get_facility_info_by_job($meta['employer_id']);
            $meta['city']= $facility['city'];
            $meta['state']= $facility['state'];
        }
        else{
            $meta['city']= "";
            $meta['state']= "";
        }




        $percent = $row["percent"];

        $percent_class = get_match_class($percent);
        $percent_color = get_match_color($percent);

        ?>
        <div class="p-container-inner-box job_match_div" style="cursor: pointer; " data-id="<?php echo $meta['id']; ?>" data-percent="<?php echo $percent; ?>" data-dashboard="yes" >
            <div class="<?php echo $percent_class; ?>">
                <div class="p-first-box">
                    <div class="p-first-box-main">
                        <div class="p-first-box-main-inner">
                            <div class="p-main-text-div ng-binding"><?php echo $meta['patients_per_day']; ?>+</div>
                        </div>
                    </div>
                </div>
                <div class="p-second-box">
                    <div class="p-title-bar ng-binding"><?php echo trim_str(stripslashes($meta['job_headline']),60); ?> </div>
                    <div class="p-title-bar-detail ng-binding"><?php echo $meta['city'].",".$meta['state']?><br>

                        $<?php echo show_salary($meta['salary_range_min']); ?> 
                        <?php
                        if($meta['salary_range_max'] == 0){
                            echo "+";
                        } 
                        else { ?>
                        - $<?php echo show_salary($meta['salary_range_max']); ?>    
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