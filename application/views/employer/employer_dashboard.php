<?php echo load_css("employer_dashboard.css","assets/css/employer/"); ?>
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
                    <a class="btn btn-lg btn-primary" ng-click="" id="new-job-post-btn">New Job Post</a>
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
                                        <div class="ng-hide" ng-show="job.applicants.length & gt; 0" style="text-align: left; padding-left: 16px; ">
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
                                <div ng-show="job.applicants.length & gt; 0" style="background: #FFF; padding: 5px; display: none;" class="leftBarMain ng-hide" id="jobCDol3WdIH7L">
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

                    <div class="col col-sm-2 employerdashbordTabs-items" id="new-job-post-btn-item" style="display: none; width: 100%;">
                        <div id="form-content">
                            <div class="form-wrap">
                                <div class="form-section employerForm">
                                    <form class="ng-pristine ng-valid ng-valid-required">
                                        <div style="width: 100%; margin: 0 auto;">
                                            
                                            <div class="post-job-steps" id="post-job-step1" style="display: none; width: 100%;">
                                                    <!--										<p><img src="img/form-page/first-step.png" /></p>-->
                                                <h3>Let's start by getting the basics of the job...</h3>
                                                <div style="min-height: 300px;">
                                                    <fieldset style="float: none; margin: 0 auto; padding: 0; width: 100%;">
                                                        <div class="filter">
                                                            <div style="float: left; width: 48%">
                                                                <label>Job ID</label> <input type="text" placeholder="Auto Generated by us" readonly="" ng-model="posting.id" id="jobID" class="ng-pristine ng-valid">
                                                            </div>
                                                            <div style="float: left; width: 48%">
                                                                <label style="width: 30%">Internal Job ID<sup>*</sup></label> <input type="text" ng-model="posting.internalId" id="jobInternalID" class="ng-pristine ng-valid">
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="filter">
                                                            <div style="float: left; width: 48%">
                                                                <label>Specialty<sup>*</sup></label> 
                                                                <select ng-options="option.get('name') for option in specialties" ng-model="posting.specialty" id="specialty" class="ng-pristine ng-valid"><option value="" class="">Select</option><option value="0">Allergy and Immunology</option><option value="1">Anesthesiology</option><option value="2">Colon and Rectal Surgery</option><option value="3">Dermatology</option><option value="4">Emergency Medicine</option><option value="5">Family Medicine</option><option value="6">Internal Medicine</option><option value="7">Medical Genetics</option><option value="8">Neurological Surgery</option><option value="9">Neurology</option><option value="10">Nuclear Medicine</option><option value="11">Obstetrics and Gynecology</option><option value="12">Opthalmology</option><option value="13">Orthopaedic Surgery</option><option value="14">Otolaryngology</option><option value="15">Pathology</option><option value="16">Pediatrics</option><option value="17">Physical Medicine and Rehabilitation</option><option value="18">Plastic Surgery</option><option value="19">Preventive Medicine</option><option value="20">Psychiatry</option><option value="21">Radiology</option><option value="22">Surgery - General</option><option value="23">Thoracic and Cardiac Surgery</option><option value="24">Urology</option></select>
                                                            </div>
                                                            <div style="float: left; width: 48%">
                                                                <label style="width: 30%">Sub Specialty<sup>*</sup></label> <select ng-options="option for option in posting.specialty.get('subspecialties')" ng-model="posting.subSpecialty" id="subSpecialty" class="ng-pristine ng-valid"><option value="" class="">Select</option></select>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="filter">
                                                            <label style="width: 12%">Job Headline<sup>*</sup></label> <input type="text" ng-model="posting.headline" id="postingTitle" class="ng-pristine ng-valid">
                                                        </div>
                                                        <div class="filter">
                                                            <div style="float: left; width: 48%">
                                                                <label>Position or Title<sup>*</sup></label> <input type="text" ng-model="posting.position" id="position" class="ng-pristine ng-valid">
                                                            </div>
                                                            <div style="float: left; width: 48%">
                                                                <label style="width: 30%">Fill By<sup>*</sup></label> <input type="date" readonly="" style="width: 46%;" close-text="Close" ng-required="true" date-disabled="disabled(date, mode)" datepicker-options="dateOptions" max-date="'2015-06-22'" min-date="minDate" is-open="opened" ng-model="posting.fillBy" datepicker-popup="dd-MMMM-yyyy" id="fillBy" class="ng-isolate-scope ng-pristine ng-valid ng-valid-required ng-valid-date" required="required">
                                                                
                                                                
                                                                <span style="display: inline-block" class="input-group-btn">
                                                                        <button ng-click="open($event)" class="btn btn-default" type="button"><i class="glyphicon glyphicon-calendar"></i></button>
                                                                </span>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="filter">
                                                            <div style="float: left; width: 48%">
                                                                <label>Position Type<sup>*</sup></label> <select ng-options="option for option in positionTypes" ng-model="posting.positionType" id="positionType" class="ng-pristine ng-valid"><option value="" class="">Select</option><option value="0">Full Time</option><option value="1">Part Time</option><option value="2">Locum</option><option value="3">Temporary</option></select>
                                                            </div>
                                                            <div style="float: left; width: 48%">
                                                                <div ng-show="posting.positionType == 'Temporary'" class="ng-hide">
                                                                    <label style="width: 30%">Length of Employment<sup>*</sup></label> <input type="text" ng-model="posting.employmentLength" id="employmentLength" class="ng-pristine ng-valid"> </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="filter">
                                                            <label style="width: 12%">Preference on Designation</label> <select style="width: 29%" ng-options="option for option in degrees" ng-model="posting.degree" id="degree" class="ng-pristine ng-valid"><option value="" class="">Select</option><option value="0">D.O.</option><option value="1">M.D.</option></select>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div style="text-align: center; margin-top: 20px;">
                                                    <a href="javascript:void(0)" class="btn btn-lg btn-primary post-form-continue-btn" id="continue-step1" data-stepTo="2">Continue</a>
                                                </div>
                                            </div>
                                            
                                            <div class="post-job-steps" id="post-job-step2" style="display: none; width: 100%;">
                                                    <!--										<p><img src="img/form-page/second-step.png" /></p>-->
                                                <h3>Licensing &amp; Credentials</h3>
                                                <div style="min-height: 300px;">
                                                    <fieldset style="float: none; margin: 0 auto; padding: 0; width: 100%; padding-left: 100px;">
                                                        <div class="filter">
                                                            <label>Active License Required?</label> <input type="checkbox" ng-model="posting.activeLicenseRequired" id="activeLicenseRequired" class="ng-pristine ng-valid">
                                                        </div>
                                                        <div class="filter">
                                                            <label>Requires BLS Certification?</label> <input type="checkbox" ng-model="posting.requiresBLScertification" id="requiresBLScertification" class="ng-pristine ng-valid">
                                                        </div>
                                                        <div class="filter">
                                                            <label>Accept J1?</label> <input type="checkbox" ng-model="posting.acceptsj1s" id="acceptsj1s" class="ng-pristine ng-valid">
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div style="text-align: center; margin-top: 20px;">
                                                    <a href="javascript:void(0)" class="post-form-back" data-backTo="1">Back</a> &nbsp;  &nbsp; <a href="javascript:void(0)" class="btn btn-lg btn-primary post-form-continue-btn" id="continue-step2" data-stepTo="3">Continue</a>
                                                </div>
                                            </div>
                                            
                                            <div class="post-job-steps" id="post-job-step3" style="display: none; width: 100%;">
                                                    <!--										<p><img src="img/form-page/third-step.png" /></p>-->
                                                <h3>Work Culture</h3>
                                                <div style="min-height: 300px;">
                                                    <fieldset style="float: none; margin: 0 auto; padding: 0; width: 100%; padding-left: 100px;">
                                                        <div class="filter">
                                                            <div style="float: left; width: 38%">
                                                                <label style="width: 45%">Department Size<sup>*</sup></label> <select style="width: 30%" ng-options="option.display for option in depatment_sizes" ng-model="departmentSize" id="departmentSize" class="ng-pristine ng-valid"><option value="" class="">Select</option><option value="0">0-5</option><option value="1">5-10</option><option value="2">10-20</option><option value="3">20-40</option><option value="4">40+</option></select>
                                                            </div>
                                                            <div style="float: left; width: 58%">
                                                                <label style="width: 40%">Patients seen per day<sup>*</sup></label> <input type="text" style="width: 25%" ng-model="posting.patientsPerDay" id="patientsPerDay" class="intMast ng-pristine ng-valid">
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="filter">
                                                            <label style="width: 15%">Services For</label> <label style="width: 18%; text-align: center;"><input type="checkbox" ng-model="posting.inpatient" id="inpatient" class="ng-pristine ng-valid"> Inpatient</label> <label style="text-align: left"><input type="checkbox" ng-model="posting.outpatient" id="inpatient" class="ng-pristine ng-valid"> Outpatient</label>
                                                        </div>
                                                        <div class="filter">
                                                            <label style="width: 15%">Work Schedule<sup>*</sup></label> <select style="width: 30%" ng-options="option for option in workSchedules" ng-model="posting.workSchedule" id="workSchedule" class="ng-pristine ng-valid"><option value="" class="">Select</option><option value="0">1 on / 1 off</option><option value="1">7 on / 7 off</option><option value="2">Custom</option></select>
                                                            <input type="text" style="width: 25%" ng-model="posting.workScheduleCustom" id="workScheduleCustom" ng-show="posting.workSchedule == 'Custom'" class="ng-pristine ng-valid ng-hide">
                                                        </div>
                                                        <div class="filter">
                                                            <label style="width: 15%">Call Schedule<sup>*</sup></label> <input type="text" style="width: 25%" ng-model="posting.callSchedule" id="callSchedule" class="ng-pristine ng-valid">
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div style="text-align: center; margin-top: 20px;">
                                                    <a href="javascript:void(0)" class="post-form-back" data-backTo="2">Back</a> &nbsp;  &nbsp; <a href="javascript:void(0)" class="btn btn-lg btn-primary post-form-continue-btn" id="continue-step3" data-stepTo="4">Continue</a>
                                                </div>
                                            </div>
                                            
                                            <div class="post-job-steps" id="post-job-step4" style="display: none; width: 100%;">
                                                    <!--										<p><img src="img/form-page/fourth-step.png" /></p>-->
                                                <h3>Pay &amp; Benefits</h3>
                                                <div style="min-height: 300px;">
                                                    <fieldset style="float: none; margin: 0 auto; padding: 0; width: 100%;">
                                                        <div class="filter">
                                                            <label>Salary Range<sup>*</sup></label> <select style="width: 20%" ng-options="option.display for option in salaryRanges" ng-model="salaryRange" id="salaryRange" class="ng-pristine ng-valid"><option value="" class="">Select</option><option value="0">$35k - $50k</option><option value="1">$50K - $75K</option><option value="2">$100K - $150K</option><option value="3">$150K - $225K</option><option value="4">$225k - $300K</option><option value="5">$300k - $400K</option><option value="6">$400k - $550K</option><option value="7">$550k+</option><option value="8">Custom</option></select>
                                                            <div style="display: inline" ng-show="salaryRange.display == 'Custom'" class="ng-hide">
                                                                <label style="width: 5%">Min</label> <input type="text" ng-model="posting.minSalary" id="salaryRangeMin" class="intMask ng-pristine ng-valid" style="width: 10%">
                                                                <label style="width: 5%">Max</label> <input type="text" ng-model="posting.maxSalary" id="salaryRangeMax" class="intMask ng-pristine ng-valid" style="width: 10%">
                                                            </div>
                                                        </div>												
                                                        <div style="font-style: italic; color: #40b0ff; margin: 0px auto; font-size: 13px; width: 500px;" class="filter text-left">
                                                            <sup>*</sup>We understand that this will probably be negotiated, however one of these are needed.<br>Physicians have expressed that knowing this is a top concern.
                                                        </div>
                                                        <div class="filter">
                                                            <label>Bonus / Commission</label> <input type="text" ng-model="posting.bonus" id="bonus" class="ng-pristine ng-valid">
                                                        </div>
                                                        <div class="filter">
                                                            <label>Pay Frequency<sup>*</sup></label> <select ng-options="option for option in payFrequencies" ng-model="posting.payFrequency" class="ng-pristine ng-valid"><option value="0">Weekly</option><option value="1">Bi-Weekly</option><option value="2" selected="selected">Bi-Monthly</option><option value="3">Monthly</option><option value="4">Other</option></select>
                                                        </div>
                                                        <div class="filter">
                                                            <label>Benefits</label> <label style="text-align: left; padding-left: 10px; width: 10%;">
                                                                <input type="checkbox" ng-model="posting.o401k" class="ng-pristine ng-valid"> 401K
                                                            </label><label style="text-align: left; width: 17%;">
                                                                <input type="checkbox" ng-model="posting.cmeAllowance" class="ng-pristine ng-valid"> CME Allowance
                                                            </label><label style="text-align: left;">
                                                                <input type="checkbox" ng-model="posting.loanAssistance" class="ng-pristine ng-valid"> Loan Assistance
                                                            </label>
                                                        </div>
                                                        <div class="filter">
                                                            <div style="float: left; width: 48%">
                                                                <label>Vacation Days</label> <input type="text" ng-model="posting.vacationDays" id="vacationDays" class="ng-pristine ng-valid">
                                                            </div>
                                                            <div style="float: left; width: 48%">
                                                                <label>Employment Term (Min)</label> <input type="text" ng-model="posting.employmentTerm" id="employmentTerm" placeholder="12 months (numbers only)" class="ng-pristine ng-valid">
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="filter">

                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div style="text-align: center; margin-top: 20px;">
                                                    <a href="javascript:void(0)" class="post-form-back" data-backTo="3">Back</a> &nbsp;  &nbsp; <a href="javascript:void(0)" class="btn btn-lg btn-primary post-form-continue-btn" id="continue-step4" data-stepTo="5">Continue</a>
                                                </div>
                                            </div>

                                            <div class="post-job-steps" id="post-job-step5" style="display: none; width: 100%;">
                                                    <!--										<p><img src="img/form-page/fifth-step.png" /></p>-->
                                                <h3>Additional Information</h3>
                                                <div style="min-height: 300px;">
                                                    <fieldset style="float: none; margin: 0 auto; padding: 0; width: 100%;">
                                                        <div class="filter">
                                                            <label>Visa / Citizenship Acceptance</label> <label style="text-align: left; padding-left: 10px; width: 10%;">
                                                                <input type="checkbox" ng-model="posting.citizen" class="ng-pristine ng-valid"> Citizen
                                                            </label><label style="text-align: left; width: 13%;">
                                                                <input type="checkbox" ng-model="posting.greenCard" class="ng-pristine ng-valid"> Green Card
                                                            </label><label style="text-align: left;">
                                                                <input type="checkbox" ng-model="posting.j1Visa" class="ng-pristine ng-valid"> J1 Visa
                                                            </label>
                                                        </div>
                                                        <div class="filter">
                                                            <label style="vertical-align: top">Other Description<br><span style="font-size: 11px;">Please keep it brief, and with bullet points. Thank You!</span></label>
                                                            <textarea ng-model="posting.description" style="height: 150px; margin: 10px; padding: 5px; border: 1px solid rgb(154, 155, 159); border-radius: 5px; width: 360px; resize: none; display: inline-block" rows="5" id="description" type="text" class="ng-pristine ng-valid"></textarea>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div style="text-align: center; margin-top: 20px;">
                                                    <a href="javascript:void(0)" class="post-form-back" data-backTo="4">Back</a> &nbsp;  &nbsp; <a href="javascript:void(0)" class="btn btn-lg btn-primary post-form-continue-btn" id="continue-step5" data-stepTo="6">Continue</a>
                                                </div>
                                            </div>
                                            
                                            <div class="post-job-steps" id="post-job-step6" style="display: none; width: 100%;" >
                                                <h3>Job Posting Rules &amp; Terms of Use</h3>
                                                <div style="min-height: 300px;">
                                                    <fieldset style="float: none; margin: 0 auto; padding: 0; width: 750px;">
                                                        <p style="text-align: left; font-size: 16px;">
                                                            We hope you realize the efficiency and value we are bring to the outdated process. By accepting the terms of use and signing below you agree to similar terms as working with 3rd party recruiters. We do NOT charge you for any of the job postings. However upon a Match and prior to further unlimited communication with a Physician you will have to choose a payment option. Please click here. You will still be able to see full profiles, percentage matches and know if someone is the right fit at no charge. We pride ourselves in proving the system works, and greatly appreciate the support.
                                                        </p><br><br><br>
                                                        <div class="filter">
                                                            &nbsp;&nbsp;&nbsp;Signing authority<br>
                                                            <input type="text" style="width: 25%" placeholder="First Name" ng-model="terms.authFname" id="authFname" class="ng-pristine ng-valid">
                                                            <input type="text" style="width: 25%" placeholder="Last Name" ng-model="terms.authLname" id="authLname" class="ng-pristine ng-valid"><br>
                                                            <label style="width: 50%; padding-left: 10px; text-align: left" id="agreeTermC"><input type="checkbox" id="agreeTerm"> Agree to Terms &amp; Conditions</label>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div style="text-align: center; margin-top: 20px;">
                                                    <a href="javascript:void(0)" class="post-form-back" data-backTo="5">Back</a> &nbsp;  &nbsp; <a href="javascript:void(0)" class="btn btn-lg btn-primary post-form-continue-btn" id="continue-step6" data-stepTo="7">Continue</a>
                                                </div>
                                            </div>


                                            <div class="post-job-steps" id="post-job-step7" style="display: none; width: 100%;">
                                                <div style="margin-bottom: 10px;" class="col-sm-8">
                                                    <h1 style=" color: #ff5500; text-align: left;">Congratulations! Job Posted!</h1>
                                                    <p style="text-align: left; padding-top: 2px;" class="text-left"><em><sup>*</sup>An email will not be sent after every job posting. They are available in your Dashboard under the Status Tab along with all updates and match information.</em></p>

                                                    <div style="margin: 20px 40px; background-color: #F8F8F8; border-color: #bbb" class="well">
                                                        <h2 style="margin-top: 0px" class="text-center">One more thing..</h2>
                                                        <div class="col-xs-4">
                                                            <div style="font-size: 18px; border: 1px solid #aaa; background-color: #ddd" class="imageContainer">
                                                                <img ng-src="" class="containedImage">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-8">
                                                            <p style="margin-top: 20px" class="text-center">Physicians like to know who they are connecting. Please upload an official logo, or a picture of yourself. Lets make this personal!</p>
                                                            <div class="text-center">

                                                                <fieldset>
                                                                    <input type="file" uploader="uploader" nv-file-select="">
                                                                </fieldset>

                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>

                                                    </div>
                                                    <div class="text-center">
                                                        <a style="width: 60%; font-size: 22px" class="btn btn-lg btn-primary" href="#/employerDashboard">Go to Jobs Dashboard</a>
                                                    </div>

                                                </div>
                                                <div class="col-sm-4 text-center">
                                                    <br><br><br>
                                                    <div>
                                                        <p style="font-size: 12px">He will reach out to you momentarily to make sure you are all set.</p>
                                                        <p style="color: #777; font-size: 13px;" class="text-center ng-binding">Text (123) 123-1231 <br>or<br>numan.hassan@purelogics.net</p>
                                                    </div>

                                                </div>

                                                <div class="clearfix"></div>

                                            </div>

                                        </div>
                                    </form>

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