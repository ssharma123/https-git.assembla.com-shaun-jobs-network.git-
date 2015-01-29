<div >
    
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
            <?php foreach ($jobs as $row) { ?>

            <div class="job-list-item">
                    <div class="col col-sm-2 text-center ng-binding">
                        <?php echo $row["internal_id"]; ?>
                        <div class="ng-hide" style="text-align: left; padding-left: 16px; ">
                            <a style="color: #FFF"><i class="fa fa-plus-square"></i> Matches</a>
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
                        <a href="#/newJobPost/Dol3WdIH7L" class="btn btn-xs btn-warning"><strong>Edit</strong></a> 
                        <a href="" class="btn btn-xs btn-danger" ng-click="removeJob(job)"><strong>Delete</strong></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
             
            <?php } ?>

            <?php /*
              <div ng-show="job.applicants.length & gt;
              0" style="background: none repeat scroll 0% 0% rgb(255, 255, 255); padding: 5px;" class="leftBarMain" id="">
              <?php
              $class_popup = 'paynow_temp';
              if ($sub_data) {
              $class_popup = '';
              }
              ?>
              <a href="javascript:void(0)" class="<?php echo $class_popup; ?>">
              <div class="leftBar ng-scope" ng-repeat="applicant in job.applicants" style="padding-left: 30px;">
              <div style="border: 1px solid #e4e4e4; border-left: none;">
              <div style="float: left; width: 60px; height: 60px;">
              <img src="http://files.parsetfss.com/ed8c4e67-ce56-4481-9e90-04e2faab9f96/tfss-e1d18eef-f7ad-4dc6-add1-6b7eea6ca9ec-01.png" ng-src="http://files.parsetfss.com/ed8c4e67-ce56-4481-9e90-04e2faab9f96/tfss-e1d18eef-f7ad-4dc6-add1-6b7eea6ca9ec-01.png">
              </div>
              <div class="ng-binding" style="float: left; width: 150px; vertical-align: top; font-size: 12px; padding-left: 5px; padding-top: 5px;">
              <span class="ng-binding" style="color: #5298fc">Dr. Farhan</span><br>Emergency Medicine<br>Lahore, FL
              </div>
              <div style="float: left; padding-top: 14px;">
              <span class="btn btn-sm btn-success">Applied</span>&nbsp;&nbsp;&nbsp;<span class="btn btn-sm btn-success" ng-click="buttonPressed(job.job.id, applicant, 'matched')">Matched</span>&nbsp;&nbsp;&nbsp;<span class="btn btn-sm btn-success" ng-click="buttonPressed(job.job.id, applicant, 'interview', $index, job.job.get('rivsJobID'))">Interview</span>&nbsp;&nbsp;&nbsp;
              <span class="btn btn-sm btn-success" ng-click="buttonPressed(job.job.id, applicant, 'interviewc')">Interview Complete</span>&nbsp;&nbsp;&nbsp;<span class="btn btn-sm btn-success" ng-click="buttonPressed(job.job.id, applicant, 'face')">Face 2 Face</span>&nbsp;&nbsp;&nbsp;<span class="btn btn-sm btn-danger" ng-click="buttonPressed(job.job.id, applicant, 'job')">Job Offer</span>&nbsp;&nbsp;&nbsp;<span class="btn btn-xs btn-danger" ng-click="rejectApplication(applicant.id, applicant)"><i class="fa fa-times">&nbsp;</i></span>
              </div>
              <div class="clearfix"></div>
              </div>

              </div><!-- end ngRepeat: applicant in job.applicants -->
              </a>
              </div>
             */ ?>

        </div>
        </div>
    </div>

    <!-- ngRepeat: job in jobs -->


    <div style="padding: 20px; background-color: #353333; border-radius: 0">
    </div>
</div>




