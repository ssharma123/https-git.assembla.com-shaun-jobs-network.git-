<style>
    .job_status_btn{
        margin: 5px;
    }
    .margin_5{
        margin-top: 5px;
        margin-bottom: 5px;
    }
    .delete_job_padding{
        padding-top: 14px;
    }
    .profile_img_thumb{
        width: 60px;
        height: 60px;
        float: left;
    }
</style>
<div>
    
    <h2 class="text-center" style="padding: 20px">
        Your Applicants  
    </h2>
    <div style="padding: 20px; border-bottom: #ddd; background-color: #353333; font-size: 1.2em; font-weight: bold; border-radius: 0" class="text-center">
        <div class="row">
            <div class="col col-sm-4">
                Applicant
            </div>
            <div class="col col-sm-1">
                Job ID
            </div>
            <div class="col col-sm-5">
                Status
            </div>
            <div class="col col-sm-1">
                Decline/Reject
            </div> 
        </div>
    </div>
    <div style="" class="ng-scope">
        <div class="row">
            <div class="col col-lg-12">
            <?php 
            if($jobs){
            foreach ($jobs as $key=>$row) { ?>

                <div class="status-list-item" id="job-applied-list-item_<?php echo $row['job_applied_id']; ?>" >
                    
                    <div class="col col-sm-4 delete_job_padding" style="width: 30%">
                        <div class="profile_img_thumb">
                            <?php 
                            $src = (isset($row['profile_image']) && $row['profile_image'] != "")  ? " src='".base_url("uploads/jobseeker/profiles/".upload_img_thumb($row['profile_image'],150,185))."' " : "" ;
                            ?>
                            <img <?php echo $src; ?> >
                        </div>
                        <div style="font-size: 12px; float: left; width: 130px; vertical-align: top; padding-left: 15px;" class="">
                            <span style="color: #5298fc" class=""><?php echo $row["prof_suffix"].". ".$row["first_name"];?></span>
                            <br><?php 
                            $speciality =  get_specialties($row["specialty"]); 
                            $spec_name = ( isset($speciality['name']) ) ? $speciality['name'] : "";
                            echo $spec_name."<br>".$row["city"].",".$row["state"];?>										
                        </div>
                    </div>
                    <div class="col col-sm-1 text-center delete_job_padding" style="width: 10%">
                        <?php echo $row["internal_id"]; ?>
                    </div>
                    <div class="col col-sm-6">
                        <div style="float: left; padding-top: 14px;">
                            <?php
                            $matched_class = ($row['matched'] == 1 ) ? " btn-success " : "btn-danger update_job_status" ;
                            $interview_class = ($row['interview'] == 1 ) ? " btn-success " : "btn-danger update_job_status" ;
                            $interview_complete_class = ($row['interview_complete'] == 1 ) ? " btn-success " : "btn-danger " ;
                            $face_2_face_class = ($row['face_2_face'] == 1 ) ? " btn-success " : "btn-danger update_job_status" ;
                            $job_offer_class = ($row['job_offer'] == 1 ) ? " btn-success " : "btn-danger update_job_status" ;

                            ?>
                            <span class="btn btn-sm btn-success">Applied</span>
                            <span  class="btn btn-sm <?php echo $matched_class; ?> " data-type="matched" data-id="<?php echo $row['job_applied_id']; ?>" >Matched</span>
                            <span class="btn btn-sm <?php echo $interview_class; ?> " data-type="interview" data-id="<?php echo $row['job_applied_id']; ?>">Interview</span>
                            <span class="btn btn-sm <?php echo $interview_complete_class; ?> " data-type="interview_complete" data-id="<?php echo $row['job_applied_id']; ?>" >Interview Complete</span>
                            <span id="job_applied_Face2Face_<?php echo $row['job_applied_id']; ?>" class="btn btn-sm <?php echo $face_2_face_class; ?> " data-type="face_2_face" data-id="<?php echo $row['job_applied_id']; ?>">Face 2 Face</span>
                            <span id="job_applied_jobOffer_<?php echo $row['job_applied_id']; ?>" class="btn btn-sm margin_5 <?php echo $job_offer_class; ?> " data-type="job_offer" data-id="<?php echo $row['job_applied_id']; ?>">Job Offer</span>
                                    
                        </div>
                    </div>
                     
                    <div class="col col-sm-1 text-right delete_job_padding">
                         
                        <a href="javascript:void(0)" class="delete_job_applied" data-value="<?php echo $row['job_applied_id']; ?>">
                            <span class="btn btn-xs btn-danger">
                                <span class="glyphicon glyphicon-trash"></span>
                            </span>
                        </a>
                        
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                 
             
            <?php }
            } ?>


        </div>
        </div>
    </div>

    <!-- ngRepeat: job in jobs -->


    <div style="padding: 20px; background-color: #353333; border-radius: 0">
    </div>
</div>




