<?php echo load_js("jquery-1.10.2.min.js"); ?>

<?php 
    echo load_css('jquery.fancybox.css?v=2.1.4','assets/js/fancybox/');
    echo load_css('jquery.fancybox-buttons.css?v=1.0.5','assets/js/fancybox/helpers/');
    echo load_css('jquery.fancybox-thumbs.css?v=1.0.7','assets/js/fancybox/helpers/');
?>
<?php 
    // fancybox JS files
    echo load_js("jquery.fancybox.js?v=2.1.4","assets/js/fancybox/");
    echo load_js("jquery.fancybox-buttons.js?v=1.0.5","assets/js/fancybox/helpers/");
    echo load_js("jquery.fancybox-thumbs.js?v=1.0.7","assets/js/fancybox/helpers/");
    echo load_js("jquery.fancybox-media.js?v=1.0.5","assets/js/fancybox/helpers/");
?>

<?php echo load_css("employer_dashboard.css","assets/css/employer/"); ?>
<?php echo load_js("employee_dashboard.js"); ?>
<div class="container ng-scope" ng-controller="DashboardCtrl" style="padding: 50px; min-height: 400px; background-color: #f7f7f7">
    <div>
        <div class="row">
            <!-- Image & details -->
            <div class="col-sm-2 col-xs-3">
                <div class="imageContainer" style="font-size: 18px; border: 1px solid black; background-color: #aaa">
                    <?php
//                    var_dump($employer['profile_image']);
                    $src = (isset($employer['profile_image']) && $employer['profile_image'] != "")  ? " src='".base_url("uploads/employers/profiles/".$employer['profile_image'])."' " : "" ;
                    ?>
                    <img class="containedImage" <?php echo $src; ?> >
                </div>

                <div class="text-left" style="margin: 0px">
                    <h3 class="ng-binding"><?php echo $employer['name']; ?></h3>
                    <?php
                    if($sub_data){
                        echo "( Pro member )<br><br>";
                    }
                    ?>
                    <a class="btn btn-lg btn-primary" ng-click="" id="new-job-post-btn">New Job Post</a>
                    
                    <input type="hidden" id="selectedApplicant" value="">
                </div>

            </div>

            <div class="col-sm-10">

                <ul class="nav nav-pills nav-justified" style="cursor: auto">
                    <li><a class="" href="javascript:void(0)" id="tabJobPost">Job Post</a></li>
                    <li><a class="" href="javascript:void(0)" id="tabStatus">Status</a></li>
                    <li><a class="" href="javascript:void(0)" id="tabMatches">Matches</a></li>
                    <li><a class="" href="javascript:void(0)" id="tabSetting">Settings</a></li>
                </ul>
                <div class="clearfix"></div>
                <hr>
                <div>
                    
                    <div class="employerdashbordTabs-items" id="welcome-item" style="display: block;" >
                        <h4 class="text-left ng-binding" style="margin-top: 5px;">Hi <?php $name = explode(' ',$employer['name']); echo $name[0]; ?></h4>
                        <p class="text-left">
                                We are happy that you joined the only community created to put internal recruiters<br>directly in contact with physician job-seekers!<br><br>Since this is your first time with us, we will talk you through the process of inputting a job into the system. If you ever need help, make sure to use the chat window at the bottom of the<br>screen here, and someone will gladly help you along the way.
                        </p>
                        <br><br>
                        <p class="text-left" style="margin: 0 auto 10px; width: 70%">
                        <span style="color: #f00; font-weight: bold">Note:</span><br>
                        We belive that transparency is key when matching ideal candidates with your job opening. Physicians seek this hones form of communication, as i am sure you would as well. All data points will be required to be filled out about the job. We appreciate your understanding and know this will ultimately help find your next model employee.
                        </p>
                        <br><br>
                        <br><br>
                        <p class="text-left" style="margin: 0 auto 10px; width: 70%; text-align: right; padding-right: 25px;">
                                <a id="new-job-post-btn2" ng-click="" class="btn btn-lg btn-primary">New Job Post</a>
                        </p>
                        <div class="clearfix"></div>
                        
                        <script>
                            show_welcome_popup();
                        </script>

                    </div>
                    
                    
                    <div class="col col-sm-4 employerdashbordTabs-items" id="tabStatus-item" style="display: none; width: 100%;">
                        Headline
                    </div>
                    <div class="col col-sm-2 employerdashbordTabs-items" id="tabMatches-item" style="display: none; width: 100%;">
                        Comming soon
                    </div>


                    <div class="col col-sm-2 employerdashbordTabs-items new-job-post-div" id="new-job-post-btn-item" style="display: none; width: 100%;">
                        <div id="form-content">
                            <div class="form-wrap">
                                <div class="form-section employerForm">
                                    <div id="rsp_post-job-container" style="display:none;"></div>
                                    <div style="width: 100%; margin: 0 auto; display: none;" id="post-job-container">
                                    </div>

                                </div>
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