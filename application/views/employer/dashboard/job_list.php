<style>
    .matches_link{
        cursor: pointer;
    }
</style>
<div>
    
    <h2 class="text-center" style="padding: 20px">
        Your Job Posts <span class="label label-primary ng-binding orange_bg"><?php echo $total_jobs; ?></span>
    </h2>
    <div style="padding: 20px; border-bottom: #ddd; background-color: #353333; font-size: 1.2em; font-weight: bold; border-radius: 0" class="text-center">
        <div class="row">
            <div class="col col-sm-2">
                Job ID
            </div>
            <div class="col col-sm-4">
                Headline
            </div>
            <div class="col col-sm-2">
                Specialty
            </div>
            <div class="col col-sm-2">
                Created At
            </div>
        </div>
    </div>
    <div style="" class="ng-scope">
        <div class="row">
            <div class="col col-lg-12">
            <?php if($jobs) { 
                foreach ($jobs as $key=>$row) { ?>

                <div class="job-list-item" id="job-list-item_<?php echo $row["id"]; ?>">
                    <div class="col col-sm-2 text-center ng-binding">
                        <?php echo $row["internal_id"]; ?>
                        <div class="ng-hide" style="text-align: left; padding-left: 16px; ">
                            <a href="javascript:void(0)" class="matches_link" style="color: #FFF">
                                <span class="glyphicon glyphicon-plus-sign"></span>
                                Matches
                            </a>
                        </div>
                    </div>
                    <div class="col col-sm-4 ng-binding">
                        <?php echo $row["job_headline"]; ?>
                    </div>
                    <div class="col col-sm-2 ng-binding">
                        <?php echo $row["specialties_name"]; ?>
                    </div>
                    <div class="col col-sm-2 ng-binding">
                        <?php echo formate_date($row["created_at"]); ?>
                    </div>
                    <div class="col col-sm-2 text-right">
                        <a href="javascript:void(0)" class="edit_job_dashboard" data-value="<?php echo $row["id"]; ?>">
                            <span class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span></span>
                        </a>
                        <a href="javascript:void(0)" class="delete_job_dashboard" data-value="<?php echo $row["id"]; ?>" >
                            <span class="btn btn-xs btn-danger" ><span class="glyphicon glyphicon-trash"></span></span>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                
                <?php 
                if( isset( $job_applied[$row["id"]]) ) { 
                    $job_applies = $job_applied[$row["id"]];
                    
                    foreach($job_applies as $apply){ 
                ?>
                    <div style="background: none repeat scroll 0% 0% rgb(255, 255, 255); padding: 5px; display: none;" class="applied_jobs_div" >
                            <div>
                                <div style="border: 1px solid #e4e4e4; border-left: none;">
                                    <div style="float: left; width: 60px; height: 60px;">
                                        <img ng-src="">
                                    </div>
                                    <div style="float: left; width: 150px; vertical-align: top; font-size: 12px; padding-left: 5px; padding-top: 5px;" class="ng-binding">
                                        <span style="color: #5298fc" class="ng-binding">Dr. Farhan</span>
                                        <br>Emergency Medicine<br>Lahore, FL										
                                    </div>
                                    <div style="float: left; padding-top: 14px;">

                                        <?php
                                        $matched_class = ($apply['matched'] == 1 ) ? " btn-success " : "btn-danger" ;
                                        $interview_class = ($apply['interview'] == 1 ) ? " btn-success " : "btn-danger" ;
                                        $interview_complete_class = ($apply['interview_complete'] == 1 ) ? " btn-success " : "btn-danger" ;
                                        $face_2_face_class = ($apply['face_2_face'] == 1 ) ? " btn-success " : "btn-danger" ;
                                        $job_offer_class = ($apply['job_offer'] == 1 ) ? " btn-success " : "btn-danger" ;

                                        ?>
                                        <span class="btn btn-sm btn-success">Applied</span>
                                        <span  class="btn btn-sm <?php echo $matched_class; ?> ">Matched</span>
                                        <span class="btn btn-sm <?php echo $interview_class; ?> ">Interview</span>
                                        <span class="btn btn-sm <?php echo $interview_complete_class; ?> ">Interview Complete</span>
                                        <span class="btn btn-sm <?php echo $face_2_face_class; ?> ">Face 2 Face</span>
                                        <span  class="btn btn-sm <?php echo $job_offer_class; ?> ">Job Offer</span>
                                        <span class="btn btn-xs btn-danger">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </span>

                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                            </div><!-- end ngRepeat: applicant in job.applicants -->
                        </div>
                <?php } 
                
                } ?>
             
            <?php } 
            } ?>


        </div>
        </div>
    </div>

    <!-- ngRepeat: job in jobs -->


    <div style="padding: 20px; background-color: #353333; border-radius: 0">
    </div>
</div>




