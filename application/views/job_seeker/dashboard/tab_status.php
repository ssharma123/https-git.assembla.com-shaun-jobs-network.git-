<style>
    .p-third-box{
        width: auto !important;
        background: none !important; 
        height: auto !important;
    }
    .margin_5{
        margin: 5px;
    }
</style>
<div class="row-wrapper">
    
    <?php
    if($jobs_applies) { 
        foreach($jobs_applies as $row){ ?>
            <div class="p-container-inner-box " id="<?php echo $row['job_applied_id']; ?>">
                <div class="red">
                    <div class="p-first-box col col-sm-3">
                        <div class="p-first-box-main">
                            <div class="p-first-box-main-inner">
                                <div class="p-main-text-div ng-binding"><?php echo $row["patients_per_day"]; ?>+</div>
                            </div>
                        </div>
                    </div>
                    <div class="p-second-box col col-sm-3">
                        <div class="p-title-bar ng-binding"><?php echo trim_str($row["job_headline"], 70); ?></div>
                        <div class="p-title-bar-detail ng-binding">San Francisco<br>$<?php echo $row["salary_range_min"]; ?>K - $<?php echo $row["salary_range_max"]; ?>K</div>
                    </div>
                    <div class=" col col-sm-4">
                        <?php
                            $matched_class = ($row['matched'] == 1 ) ? " btn-success " : "btn-danger " ;
                            $interview_class = ($row['interview'] == 1 ) ? " btn-success " : "btn-danger " ;
                            $interview_complete_class = ($row['interview_complete'] == 1 ) ? " btn-success " : "btn-danger " ;
                            $face_2_face_class = ($row['face_2_face'] == 1 ) ? " btn-success " : "btn-danger " ;
                            $job_offer_class = ($row['job_offer'] == 1 ) ? " btn-success " : "btn-danger " ;

                        ?>
                        <span class="btn btn-sm margin_5 btn-success">Applied</span>
                        <span class="btn btn-sm margin_5 <?php echo $matched_class; ?> ">Matched</span>
                        <span class="btn btn-sm margin_5 <?php echo $interview_class; ?>">Interview</span>
                        <span class="btn btn-sm margin_5 <?php echo $interview_complete_class; ?>">Interview Complete</span>
                        <span class="btn btn-sm margin_5 <?php echo $face_2_face_class; ?>">Face 2 Face</span>
                        <span class="btn btn-sm margin_5 <?php echo $job_offer_class; ?>">Job Offer</span>
                    </div>
                    <div style="clear: left;"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        <?php 
        } 
    } ?>
    
</div>