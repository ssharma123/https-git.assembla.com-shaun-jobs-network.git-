
<?php echo load_css("employer_dashboard.css","assets/css/employer/"); ?>
<?php echo load_js("job_seeker_dashboard.js"); ?>
<div class="container"  style="padding: 50px; min-height: 400px; background-color: #f7f7f7">
    <div>
        <div class="row">
            <!-- Image & details -->
            <div class="col-sm-2 col-xs-3">
                <div class="imageContainer" style="font-size: 18px; border: 1px solid black; background-color: #aaa">
                    <?php
                    $src = (isset($jobseeker['profile_image']) && $jobseeker['profile_image'] != "")  ? " src='".base_url("uploads/employers/profiles/".upload_img_thumb($jobseeker['profile_image'],150,185))."' " : "" ;
                    ?>
                    <img class="containedImage" <?php echo $src; ?> >
                </div>

                <div class="text-left" style="margin: 0px">
                    <h3 class="ng-binding"><?php echo $jobseeker['first_name']." ".$jobseeker['last_name']; ?></h3>
                      
                    <input type="hidden" id="selectedApplicant" value="">
                </div>

            </div>

            <div class="col-sm-10">

                <ul class="nav nav-pills nav-justified" style="cursor: auto">
                    
                    <?php if($jobseeker['profile_complete'] == 1) { ?>
                    <li><a class="" href="javascript:void(0)" id="tabJobPost">Profile</a></li>
                    <li><a class="" href="javascript:void(0)" id="tabStatus">Status</a></li>
                    <li><a class="" href="javascript:void(0)" id="tabMatches">Matches</a></li>
                    <li><a class="" href="javascript:void(0)" id="tabSetting">Settings</a></li>
                    <?php 
                    } 
                    else { ?>
                    <li><a style="border-radius: 6px; width: 25%;" class="" href="javascript:void(0)" id="get_started_tab">Profile</a></li>
                    <script>
                        show_welcome_popup_jobseeker();
                    </script>
                    <?php    
                    } ?>
                    
                    
                </ul>
                <div class="clearfix"></div>
                <hr>
                <div>
                    <div id="tabContent_rsp" style="display: none;"></div>
                    <div id="tabContent">
                        
                        <?php if($jobseeker['profile_complete'] == 0) { ?>
                        <div style="margin-top: -17px; padding: 10px;" >
                            <h2 style="margin-top: 5px;" class="text-left">Ready to get matched to your dream job?</h2>
                            <br><br> 
                            <div class="col-sm-10 col-sm-offset-1 text-center">
                                <p style="font-size: 24px; font-weight: 200; color: #ff5500">
                                    <em style="font-size: 22px; font-style: italic;">Start by creating your profile. You'll only have to do this once, and you'll be able to apply to multiple jobs with a click of a button!</em>
                                </p>
                                <a id="lets_get_started_btn" style="width: 60%; font-size: 24px" class="btn btn-lg btn-primary profile_steps_continue" data-step="continue-step0" >Let's Get Started </a>
                            </div>
                            <div class="col-sm-10 col-sm-offset-1 text-center round_border">
                                <p class="text-left">
                                    <span class="red">Hey!</span> We care about your privacy.  We only use the information provided for the purposes of finding you the best job matches, and only connect to facilities you want.  Check out our <a>Privacy Policy</a> for details on what &amp; when we share your data.  We’ve got you covered!
                                </p>
                            </div>
                            <div style="margin-top: 25px;" class="col-sm-9 col-sm-offset-4 text-left">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <?php echo load_img("uploadyourcv.jpg") ?>
                                    </div>
                                    <div style="margin-left: 10px; font-size: 11px;" class="col-sm-9 alternative_option">
                                        <p class="text-left">Alternative Option - <strong>Coming Soon</strong><br><br>Upload, and we will auto populate some<br>fields for you, it's just easier sometimes.</p>
                                    </div>
                                </div>

                            </div>

                            <div class="clearfix"></div>

                        </div>
                        <?php } ?>
                        
                    </div>
                </div>


            </div>
        </div>
    </div>

</div>