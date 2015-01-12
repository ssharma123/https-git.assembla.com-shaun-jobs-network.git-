<section class="header-11-sub bg-midnight-blue">
                <div class="background">&nbsp;</div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <h3>Medical Staffing. Redefined.</h3>
                            <p>Providing direct-access to top talent–MedMatch is streamlining the application process. Sign up and post your first job. It's free!</p>
                            <div class="signup-form">
                                <form>
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="Full Name" ng-model="name">
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <input type="text" class="form-control" placeholder="Email" ng-model="email">
                                        </div>
                                        <div>
                                            <input type="text" class="form-control ng-valid ng-dirty" id="facilityName" placeholder="Facility" ng-model="employerNameInput" typeahead="employer.name for employer in employers | filter:{name:$viewValue} | limitTo:8" aria-autocomplete="list" aria-expanded="false" aria-owns="typeahead-00O-1287">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-embossed btn-block btn-info">Sign Up</button>
                                    </div>
                                </form>
                            </div>
                            <div class="additional-links">By signing up you agree to <a href="#">Terms of Use</a> and <a href="#">Privacy</a></div>
                        </div>
                        <div class="col-sm-7 col-sm-offset-1 player-wrapper"></div>
                    </div>
                </div>
                <a class="control-btn fui-arrow-down" href="#"></a>


            </section>
            <section class="content-32">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <h3>Introducing a better way to hire.</h3>
                            <p class="lead">MedMatch is the first two-sided market place created to match physicians and clinics. As the employer, we provide you with direct access to doctors that match the job you are looking to fill. We believe that you should spend less time job sourcing and more time interviewing and onboading the ideal candidate.</p>
                        </div>
                    </div>
                </div>

            </section>
            <section class="content-11 bg-apple">
                <div class="container">
                    <div class="popbox">
                        <span>Sign up and post your first job today</span>
                        <a class="open btn btn-embossed btn-wide btn-success" href="http://www.medmatch.us/#/loginEmployer">IT'S FREE</a>	
                        <div class="collapse">
                            <div class="box">
                                <div class="arrow">
                                    <div class="arrow-border"></div>
                                    <form action="http://gristmill.createsend.com/t/j/s/zlldr/" method="post" id="subForm">
                                        <p><small>Please complete the form to get your personalized matches!</small></p>
                                        <div class="input">
                                            <input type="text" name="cm-name" id="name" placeholder="Name" /></div>
                                        <div class="input">
                                            <input type="text" name="cm-zlldr-zlldr" id="zlldr-zlldr" placeholder="Email" /></div>
                                        <input type="submit" value="Sign Up" /> <a href="#" class="close">Cancel</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </section>
            <section class="content-26 bg-white">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <h3>MedMatch for Employers</h3>
                            <p class="lead">We provide direct access to top talent, allow you to conduct virtual interviews, and take the guesswork out of hiring through our varification process.</p>
                        </div>
                    </div>
                    <div class="row features">
                        <div class="col-sm-3"> <img src="img/hospital.svg" alt="" width="210" height="210">
                            <h6>Match</h6>
                            MedMatch provides employers with direct access to the nation's 
                            top physicians. </div>
                        <div class="col-sm-4 col-sm-offset-1"> <img src="img/phone.svg" alt="" width="210" height="210">
                            <h6>Connect</h6>
                            Get notified when an applicant applies to a job 
                            post. Interviews are conducted virtually, 
                            streamlining candidate onboarding.</div>
                        <div class="col-sm-3 col-sm-offset-1"> <img src="img/doctor.svg" alt="" width="210" height="210">
                            <h6>Verify</h6>
                            Our verification process ensures that candidates meet your criteria–we're taking the guesswork out of hiring.</div>
                    </div>
                </div>
            </section>
            <section class="content-36 bg-apple">
                <div class="container">
                    <h2>Get Started</h2>
                    <form>
                        <div class="col-2">
                            <label for"firstname">Full Name
                                   <input placeholder="Please provide your first and last name." ng-model="firstName lastName" class="ng-pristine ng-valid" id="firstName lastName" tabindex="1" />
                            </label>
                        </div>
                        <div class="col-2">
                            <label for="email">EMAIL
                                <input placeholder="Please enter your email address." type="email" ng-model="email" class="ng-pristine ng-valid ng-valid-email" id="email" tabindex="2" />
                            </label>
                        </div>
                        <div class="col-3">
                            <label for="password">PASSWORD
                                <input placeholder="Please choose a password." ng-model"password" class="ng-pristine ng-valid" id="password" tabindex="3" />
                            </label>
                        </div>
                        <div class="col-3">
                            <label for="confirmpassword">CONFIRM PASSWORD
                                <input placeholder="Please confirm your password." ng-model="confirmpassword" type="password" class="ng-pristine ng-valid" id="confirmpassword" tabindex="4" />
                            </label>
                        </div>
                        <div class="col-3">
                            <label class="control-label" for="facilityName">Facility Name
                                <input placeholder="What is the facility's name?" class="ng-valid ng-dirty" id="facilityName" ng-model="employerNameInput" typeahead="employer.name for employer in employers | filter:{name:$viewValue} | limitTo:8" aria-autocomplete="list" aria-expanded="false" aria-owns="typeahead-00O-1287"><!-- ngIf: isOpen() -->
                            </label>
                        </div>
                    </form>
                    <div class="col-sm-8 col-sm-offset-2">
                        <a class="btn btn-embossed btn-info btn-block" ng-click="doFacility()">Complete your free job post!<span class="fui-arrow-right pull-right"></span></a>
                    </div>

                </div>
            </section>