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
            

            
            $jobs_sorted_array = array();
            if($jobs_data){
                
                $jobs = $jobs_data;
                
                echo "<pre>"; print_r($jobs); echo "</pre>"; 

                foreach($jobs as $key => $row){ 

                    $row = $row['meta'];
                    $doc_id = $row['docId'];
                    $score = $row['score'];
                    $rawscore = $row['rawscore'];
                    
                    echo "<pre>"; print_r($row); echo "</pre>"; die;

                    
                }
                
                
//                usort($jobs_sorted_array, "jobs_sort_by_percent" );
                

                
                foreach($jobs_sorted_array as $key => $row){ 
                    if(isset($row['employer_id'])){
                        $facility = get_facility_info_by_job($row['employer_id']);
                        $row['city']= $facility['city'];
                        $row['state']= $facility['state'];
                    }
                    else{
                        $row['city']= "";
                        $row['state']= "";
                    }
                    
                    
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