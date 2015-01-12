<style>
    .wrap {
    width: 1170px !important;
}
.imageContainer {
    float: left;
    height: 0;
    margin-bottom: 20px;
    padding-bottom: 120%;
    position: relative;
    width: 100%;
}
.containedImage {
    height: 100%;
    left: 0;
    position: absolute;
    width: 100%;
}
.lowerBG {
    background: none repeat scroll 0 0 #aaa;
    border: 1px solid rgba(150, 150, 150, 0.35);
    border-radius: 0;
}
.lowerBG h2.text-center {
    margin-top: 5px;
}
.formBG {
    background: none repeat scroll 0 0 #eee;
    border: medium none;
    margin: -1px;
    min-height: 300px;
    padding: 20px;
}
.formLighterBG {
    background: none repeat scroll 0 0 #eee;
    border: 1px solid rgba(150, 150, 150, 0.35);
}
.progressDotGroup {
    margin-bottom: 10px;
    margin-top: 10px;
}
.progressDot {
    background-color: #ddd;
    border-radius: 100%;
    display: inline-block;
    height: 12px;
    margin-left: 4px;
    margin-right: 4px;
    width: 12px;
}
.progressActive {
    background-color: #f00;
}
.dashedBorder {
    border-bottom: 2px dashed #999;
    margin: 10px auto 0;
    width: 50%;
}
.formButton {
    margin-left: 20px;
    margin-right: 20px;
    width: 20%;
}
.inlineControl {
    display: inline;
    margin-right: 20px;
}
.inlineControlLabel {
    font-weight: 500;
    margin-right: 10px;
}
.btn-purple {
    background-color: #af78e0;
    color: white;
}
.btn-purple:hover {
    background-color: #af70d0;
    color: white;
}
.btn-purple:active {
    background-color: #af70d0;
    color: white;
}
.btn-blue {
    background-color: #79a7dd;
    color: white;
}
.btn-blue:hover {
    background-color: #79a0d0;
    color: white;
}
.btn-blue:active {
    background-color: #79a0d0;
    color: white;
}
.well-blue {
    background-color: #b3d2e0;
    border-color: #555;
}
.well-yellow {
    background-color: #fbfbdb;
    border-color: #555;
}
.well-purple {
    background-color: #d6c2e8;
    border-color: #555;
}
.containedImage {
    height: 100%;
    left: 0;
    position: absolute;
    width: 100%;
}
.sec_row {
    border-bottom: 1px solid #a4a4a4;
    font-size: 16px;
    padding: 15px 2px 2px;
    width: 100%;
}
.sec1 {
    float: left;
    width: 80%;
}
.sec2 {
    float: left;
    width: 10%;
}
.sec3 {
    float: left;
    width: 10%;
}
</style>
<?php echo load_js("employee_dashboard.js"); ?>
<div class="container ng-scope" ng-controller="DashboardCtrl" style="padding: 50px; min-height: 400px; background-color: #f7f7f7">
    <div>
        <div class="row">
            <!-- Image & details -->
            <div class="col-sm-2 col-xs-3">
                <div class="imageContainer" style="font-size: 18px; border: 1px solid black; background-color: #aaa">
                    <img class="containedImage" ng-src="">
                </div>

                <div class="text-left" style="margin: 0px">
                    <h3 class="ng-binding">Numan Hassan</h3>
                    <a class="btn btn-lg btn-primary" ng-click="createJobPost()">New Job Post</a>
                    <input type="hidden" id="selectedApplicant" value="">
                </div>

            </div>

            <div class="col-sm-10">

                <ul class="nav nav-pills nav-justified" style="cursor: auto">
                    <li class="active"><a class="employerdashbordTabs" href="javascript:void(0)" id="tabJobPost">Job Post</a></li>
                    <li><a class="employerdashbordTabs" href="javascript:void(0)" id="tabStatus">Status</a></li>
                    <li><a class="employerdashbordTabs" href="javascript:void(0)" id="tabMatches">Matches</a></li>
                    <li><a class="employerdashbordTabs" href="javascript:void(0)" id="tabSetting">Settings</a></li>
                </ul>
                <div class="clearfix"></div>
                <hr>
                <div>
                    <div class="employerdashbordTabs-items" id="tabJobPost-item" >
                        <h2 class="text-center" style="padding: 20px">Your Job Posts <span class="label label-primary ng-binding"></span></h2>
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
                        <div style="padding: 8px; border-bottom: #ddd; background-color: #6a6666; margin-bottom: 1px" ng-repeat="job in jobs" class="ng-scope">
						<div class="row">
							<div>
								<div class="col col-sm-2 text-center ng-binding">
									Dol3WdIH7L
									<div class="ng-hide" ng-show="job.applicants.length &gt; 0" style="text-align: left; padding-left: 16px; ">
										<a ng-click="showMatches(job.job.id)" style="color: #FFF"><i class="fa fa-plus-square"></i> Matches</a>
									</div>
								</div>
								<div class="col col-sm-4 ng-binding">
									PHP Developer
								</div>
								<div class="col col-sm-2 ng-binding">
									Allergy and Immunology
								</div>
								<div class="col col-sm-2 ng-binding">
									01/05/2015 @ 4:46PM
								</div>
								<div class="col col-sm-2 text-right">
									<a href="#/newJobPost/Dol3WdIH7L" class="btn btn-xs btn-warning"><strong>Edit</strong></a> 
									<a href="" class="btn btn-xs btn-danger" ng-click="removeJob(job)"><strong>Delete</strong></a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div ng-show="job.applicants.length &gt; 0" style="background: #FFF; padding: 5px; display: none;" class="leftBarMain ng-hide" id="jobCDol3WdIH7L">
								<!-- ngRepeat: applicant in job.applicants -->
							</div>
						</div>

					</div>

                        <!-- ngRepeat: job in jobs -->


                        <div style="padding: 20px; background-color: #353333; border-radius: 0">
                        </div>
                    </div>
                    <div class="col col-sm-4 employerdashbordTabs-items" id="tabStatus-item" style="display: none; width: 100%;">
                        Headline
                    </div>
                    <div class="col col-sm-2 employerdashbordTabs-items" id="tabMatches-item" style="display: none; width: 100%;">
                        Comming soon
                    </div>
                    <div class="col col-sm-2 employerdashbordTabs-items" id="tabSetting-item" style="display: none; width: 100%;">
                        <div>
                                <div class="sec_row">
                                        <div class="sec1"><strong>Notifications</strong></div>
                                        <div class="sec2"><i class="fa fa-envelope"></i> <strong>Email</strong></div>
                                        <div class="sec3"><i class="fa fa-mobile-phone"></i> <strong>Phone</strong></div>
                                        <div class="clearfix"></div>
                                </div>
                                <div class="sec_row">
                                        <div class="sec1">When there is a match</div>
                                        <div class="sec2"><input type="checkbox" ng-model="userNotifications.match.email" class="ng-pristine ng-valid"></div>
                                        <div class="sec3"><input type="checkbox" ng-model="userNotifications.match.phone" class="ng-pristine ng-valid"></div>
                                        <div class="clearfix"></div>
                                </div>
                                <div class="sec_row">
                                        <div class="sec1">When I have an interview offer</div>
                                        <div class="sec2"><input type="checkbox" ng-model="userNotifications.interview.email" class="ng-pristine ng-valid"></div>
                                        <div class="sec3"><input type="checkbox" ng-model="userNotifications.interview.phone" class="ng-pristine ng-valid"></div>
                                        <div class="clearfix"></div>
                                </div>
                                <div class="sec_row">
                                        <div class="sec1">When I am offered a face to face interview</div>
                                        <div class="sec2"><input type="checkbox" ng-model="userNotifications.face2face.email" class="ng-pristine ng-valid"></div>
                                        <div class="sec3"><input type="checkbox" ng-model="userNotifications.face2face.phone" class="ng-pristine ng-valid"></div>
                                        <div class="clearfix"></div>
                                </div>
                                <div class="sec_row">
                                        <div class="sec1">When a job offer is made</div>
                                        <div class="sec2"><input type="checkbox" ng-model="userNotifications.job.email" class="ng-pristine ng-valid"></div>
                                        <div class="sec3"><input type="checkbox" ng-model="userNotifications.job.phone" class="ng-pristine ng-valid"></div>
                                        <div class="clearfix"></div>
                                </div>
                                <div class="sec_row">
                                        <div class="sec1">All other status updates</div>
                                        <div class="sec2"><input type="checkbox" ng-model="userNotifications.status.email" class="ng-pristine ng-valid"></div>
                                        <div class="sec3"><input type="checkbox" ng-model="userNotifications.status.phone" class="ng-pristine ng-valid"></div>
                                        <div class="clearfix"></div>
                                </div>
                                <div>
                                        <br><br>
                                        <div ng-show="eState == 'email'" class="ng-binding">
                                                <strong>Email:</strong> numan@test.com <a ng-click="eState = 'email_c'">Change Email</a>
                                                <br><br>
                                        </div>
 
                                        <div ng-show="pState == 'password'" class="">
                                                <strong>Password:</strong> <a ng-click="pState = 'password_c'; password = ''; password_c = '';">Change Password</a>
                                        </div>
                                        <div ng-show="pState == 'password_c'" class="ng-hide">
                                                <strong>Password:</strong> <input type="password" placeholder="Password" ng-model="password" id="password" class="ng-pristine ng-valid"> <input type="password" placeholder="Confirm Password" ng-model="password_c" id="password_c" class="ng-pristine ng-valid"> <a ng-click="updatePassword()" class="btn btn-sm btn-success">Change</a> <a ng-click="pState = 'password'">Cancel</a>
                                        </div>
                                </div>
                                <div>
                                        <br>
                                        <div class="text-right">
                                                <a ng-click="updateSettings()" class="btn btn-blue">Update</a>
                                        </div>
                                        <div class="clearfix"></div>
                                </div>



                        </div>
                    </div>
                </div>

<!--                <div class="ng-hide" ng-show="state == 'jobDetails'">
                    <h2 class="text-center ng-binding">Job Posting:  </h2>

                    <div class="row" >
                        <h3>Pending Applications <span class="label label-info ng-binding"></span></h3> <hr>
                         ngRepeat: application in selectedJob.get('pendingApplications') 
                    </div>

                    <div class="row">
                        <h3>Current Applications <span class="label label-warning ng-binding"></span></h3> <hr>
                         ngRepeat: application in selectedJob.get('applications') 
                    </div>

                    <div class="text-center" style="padding-bottom: 80px">
                        <a class="btn btn-primary btn-lg" href="" ng-click="state = 'jobs'">Back to Jobs</a>
                    </div>

                </div>-->

                <!--				<div>
                                                        <h3>RIVS INFO</h3>
                                                        <hr />
                                                        <div ng-repeat="rivsJob in rivsJobs.aaOutput.aaJobs">
                                                                {{rivsJob.sName}} <br />
                                                        </div>
                                                </div>-->

            </div>
        </div>
    </div>

</div>