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
                        <?php echo stripslashes($row["internal_id"]); ?>
                        <div class="ng-hide" style="text-align: left; padding-left: 16px; ">
                            <a href="javascript:void(0)" class="matches_link" style="color: #FFF">
                                <?php 
                                if( isset( $job_applied[$row["id"]]) ) { ?>
                                <span class="glyphicon glyphicon-plus-sign"></span>
                                <?php
                                } else { ?>
                                <span class="">&nbsp;&nbsp;&nbsp;</span>
                                <?php } ?>
                                Matches
                            </a>
                        </div>
                    </div>
                    <div class="col col-sm-4 ng-binding">
                        <?php echo stripslashes($row["job_headline"]); ?>
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
                    
                ?>
                    <div style="background: none repeat scroll 0% 0% rgb(255, 255, 255); padding: 5px; display: none;" class="applied_jobs_div" >
                        <?php 
                        foreach($job_applies as $apply){ ?>
                        <div  id="job-applied-list-item_<?php echo $apply['job_applied_id']; ?>" >
                            <div style="border: 1px solid #e4e4e4; border-left: none;">
                                <div style="float: left; width: 60px; height: 60px;">
                                    <?php 
                                    $src = (isset($apply['profile_image']) && $apply['profile_image'] != "")  ? " src='".base_url("uploads/jobseeker/profiles/".upload_img_thumb($apply['profile_image'],150,185))."' " : "" ;
                                    ?>
                                    <img <?php echo $src; ?> >
                                </div>
                                <div style="float: left; width: 150px; vertical-align: top; font-size: 12px; padding-left: 5px; padding-top: 5px;" class="ng-binding">
                                    <span style="color: #5298fc" class="ng-binding"><?php echo $apply["prof_suffix"].". ".$apply["first_name"];?></span>
                                    <br><?php 
                                    $speciality =  get_specialties($apply["specialty"]); 
                                    $spec_name = ( isset($speciality['name']) ) ? $speciality['name'] : "";
                                    echo $spec_name."<br>".$apply["city"].",".$apply["state"];?>											
                                </div>
                                <div style="float: left; padding-top: 14px;"  >

                                    <?php
                                    $matched_class = ($apply['matched'] == 1 ) ? " btn-success " : "btn-danger update_job_status" ;
                                    $interview_class = ($apply['interview'] == 1 ) ? " btn-success " : "btn-danger update_job_status" ;
                                    $interview_complete_class = ($apply['interview_complete'] == 1 ) ? " btn-success " : "btn-danger " ;
                                    $face_2_face_class = ($apply['face_2_face'] == 1 ) ? " btn-success " : "btn-danger update_job_status" ;
                                    $job_offer_class = ($apply['job_offer'] == 1 ) ? " btn-success " : "btn-danger update_job_status" ;

                                    ?>
                                    <span class="btn btn-sm btn-success">Applied</span>
                                    <span  class="btn btn-sm <?php echo $matched_class; ?> " data-type="matched" data-id="<?php echo $apply['job_applied_id']; ?>" >Matched</span>
                                    <span class="btn btn-sm <?php echo $interview_class; ?> " data-type="interview" data-id="<?php echo $apply['job_applied_id']; ?>">Interview</span>
                                    <span class="btn btn-sm <?php echo $interview_complete_class; ?> " data-type="interview_complete" data-id="<?php echo $apply['job_applied_id']; ?>" >Interview Complete</span>
                                    <span id="job_applied_Face2Face_<?php echo $apply['job_applied_id']; ?>" class="btn btn-sm <?php echo $face_2_face_class; ?> " data-type="face_2_face" data-id="<?php echo $apply['job_applied_id']; ?>">Face 2 Face</span>
                                    <span id="job_applied_jobOffer_<?php echo $apply['job_applied_id']; ?>" class="btn btn-sm <?php echo $job_offer_class; ?> " data-type="job_offer" data-id="<?php echo $apply['job_applied_id']; ?>">Job Offer</span>
                                    <a href="javascript:void(0)" class="delete_job_applied" data-value="<?php echo $apply['job_applied_id']; ?>">
                                        <span class="btn btn-xs btn-danger">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </span>
                                    </a>

                                </div>
                                <div class="clearfix"></div>
                            </div>

                        </div><!-- end ngRepeat: applicant in job.applicants -->
                        <?php } ?>
                    </div>
                <?php
                
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




