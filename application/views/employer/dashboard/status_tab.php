<style>
    .job_status_btn{
        margin: 5px;
    }
</style>
<div >
    
    <h2 class="text-center" style="padding: 20px">
        Your Applicants  
    </h2>
    <div style="padding: 20px; border-bottom: #ddd; background-color: #353333; font-size: 1.2em; font-weight: bold; border-radius: 0" class="text-center">
        <div class="row">
            <div class="col col-sm-2">
                Applicant
            </div>
            <div class="col col-sm-4">
                Job ID
            </div>
            <div class="col col-sm-2">
                Status
            </div>
             
        </div>
    </div>
    <div style="" class="ng-scope">
        <div class="row">
            <div class="col col-lg-12">
            <?php foreach ($jobs as $key=>$row) { ?>

                <div class="status-list-item">
                    
                    <div class="col col-sm-2 ">
                        <div style="float: left; width: 150px; vertical-align: top; font-size: 12px; padding-left: 5px; padding-top: 5px;" class="">
                            <span style="color: #5298fc" class="">Dr. Farhan</span>
                            <br>Emergency Medicine<br>Lahore, FL										
                        </div>
                    </div>
                    <div class="col col-sm-2 text-center ">
                        <?php echo $row["internal_id"]; ?>
                    </div>
                    <div class="col col-sm-7">
                        <div style="float: left; padding-top: 14px;">
                            <?php
                            $matched_class = ($row['matched'] == 1 ) ? " btn-success " : "btn-danger" ;
                            $interview_class = ($row['interview'] == 1 ) ? " btn-success " : "btn-danger" ;
                            $interview_complete_class = ($row['interview_complete'] == 1 ) ? " btn-success " : "btn-danger" ;
                            $face_2_face_class = ($row['face_2_face'] == 1 ) ? " btn-success " : "btn-danger" ;
                            $job_offer_class = ($row['job_offer'] == 1 ) ? " btn-success " : "btn-danger" ;

                            ?>
                            <span class="btn btn-sm btn-success job_status_btn">Applied</span>
                            <span  class="btn btn-sm <?php echo $matched_class; ?> job_status_btn">Matched</span>
                            <span class="btn btn-sm <?php echo $interview_class; ?> job_status_btn">Interview</span>
                            <span class="btn btn-sm <?php echo $interview_complete_class; ?> job_status_btn">Interview Complete</span>
                            <span class="btn btn-sm <?php echo $face_2_face_class; ?> job_status_btn">Face 2 Face</span>
                            <span  class="btn btn-sm <?php echo $job_offer_class; ?> job_status_btn">Job Offer</span>
                        </div>
                    </div>
                     
                    <div class="col col-sm-1 text-right">
                         
                        <a href="javascript:void(0)">
                            <span class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></span>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                 
             
            <?php } ?>


        </div>
        </div>
    </div>

    <!-- ngRepeat: job in jobs -->


    <div style="padding: 20px; background-color: #353333; border-radius: 0">
    </div>
</div>




