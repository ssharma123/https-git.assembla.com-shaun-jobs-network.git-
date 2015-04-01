<script>
var states = <?php echo $locations; ?>;
</script>

<?php echo load_css("job_seeker/home.css"); ?>

<div id="homeContainer">
		<div class="bg_section-1"></div>
		<div class="bg_section-2"></div>
		<div class="bg_section-3"></div>
		<div class="bg_section-4"></div>
		<div class="bg_section-5"></div>
		<div class="bg_section-6"></div>
		<div class="bg_section-7"></div>
    <div class="wrap">
        <div class="main">
            <div style="position: relative;" class="content">
<!--                <div class="subMenu smint">
                    <ol>
                        <li ng-show="showPrev" class="ng-hide"><a class="extLink back" href="#home" ng-click="pageScroll(0)">&nbsp;</a></li>
                        <li><a ng-click="pageScroll(1)" href="#s1" id="s1">&nbsp;</a></li>
                        <li><a ng-click="pageScroll(2)" href="#s2" id="s2">&nbsp;</a></li>
                        <li><a ng-click="pageScroll(3)" href="#s3" id="s3">&nbsp;</a></li>
                        <li><a ng-click="pageScroll(4)" href="#s4" id="s4">&nbsp;</a></li>
                        <li><a ng-click="pageScroll(5)" href="#s5" id="s5">&nbsp;</a></li>
                        <li><a ng-click="pageScroll(6)" href="#s6" id="s6">&nbsp;</a></li>
                        <li><a ng-click="pageScroll(7)" href="#s7" id="s7">&nbsp;</a></li>
                        <li ng-show="showNext" class="ng-hide"><a class="extLink next" href="#home" ng-click="pageScroll(8)">&nbsp;</a></li>
                    </ol>						
                </div>-->

                <div class="section group s1">
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="section-1">
                            <iframe width="310" height="210" frameborder="0" allowfullscreen="" src="//www.youtube.com/embed/eknIvXx1hQU" style="margin: 0 90px;"></iframe>
                            <h1>Medical Staffing. Reinvented.</h1>
                            <h2>We’re transforming how physicians and healthcare facilities come together-providing access to real-time job matches... all at the tip of your fingers!</h2>
                            <br>
                            <a href="javascript:void(0);" class="btn btn-embossed btn-wide btn-inverse lets_start_popup">
                                Sign Up
                            </a>
                        </div>

                    </div>
                    <div class="explore-more-sect-1"><span class="explore"><a href="">Explore More<br><span id="chevron"></span></a><span class="arrow"></span></span></div>
                </div>

                <div class="section group s2">
                    <div class="section-2">
                        <hr style="color: #fff; margin-bottom: 25px; width: 260px;">
                        <h1>How We Match</h1>
                        <h2>We customize your ideal matches based on a combination of personal and professional criteria; including salary, specialty, location and important information.</h2>
                        <br>
                        <!--<img style="max-width:628px" src="img/info_graphics.png">-->
                        <?php echo load_img("info_graphics.png", "", "", "", "max-width:628px;"); ?>
                        <h2>Our sophisticated algorithm then ranks your responses and matches you with those of healthcare facilities and requirements.  While you're helping patents, MedMatch acts as your personal recruiter, connecting you with facilities that are only the perfect match!</h2>
                        <br>
                        <a href="javascript:void(0);" style="z-index: 999; width: 294px; height: 60px; line-height: 40px; font-weight: bold; font-size:20px; " class="btn btn-embossed btn-wide btn-inverse lets_start_popup">
                            Sign Up
                        </a>
                    </div>		
                </div>		

                <div class="section group s3">
                    <div class="section-3">
                        <hr style="color: #2C3E50; margin-bottom: 15px; width: 260px;">
                        <h1>How It Works</h1>	
                        <br>
                        <div class="col_1_of_3 span_1_of_3">
                            <div style="border-right:2px solid #2C3E50;">
                                <?php echo load_img("clipboard.png", "","","97"); ?>
                                <h3>1. Fill our your one time profile</h3>
                            </div>
                        </div>
                        <div class="col_1_of_3 span_1_of_3">
                            <div style="border-right:2px solid #2C3E50;">
                                <?php echo load_img("spyglass.png", "","","97"); ?>
                                <h3>2. Review top matches and apply in real time</h3>
                            </div>
                        </div>				
                        <div class="col_1_of_3 span_1_of_3">
                            <?php echo load_img("handshake.png", "","","97"); ?>
                            <h3>3. Get matched and connect with internal recruiters, directly</h3>
                        </div>
                    </div>
                </div>

                <div class="section group s4">
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="section-4">
                            <hr style="color: #fff; margin-bottom: 25px; width: 300px;">
                            <h1>Match at a Glance</h1>
                            <h2>Easily view and identify your<br>
                                top matches based on your <br>
                                custom-built criteria.</h2>
                            <br>
                        </div>
                    </div>
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="section-4">
                            <a href="javascript:void(0)" class="lets_start_popup">
                                <?php echo load_img("vector_section3.png"); ?>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="section group s5">
                    <div class="section-5">
                        <br>
                        <div class="span_1_of_4">
                            <?php echo load_img("doctor.png","","","110"); ?>
                        </div>
                        <div class="span_3_of_4">
                            <p>I found my perfect match without any hassles, and while I was on vacation! MedMatch was so easy, I had a job offer within a week!</p>
                            <span>-Dr. Katherine Maslyn, Northwestern Memorial </span>
                        </div>
                    </div>
                </div>

                <div class="section group s6">
                    <br><br>
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="section-6">
                            <hr style="color: #000; margin-bottom: 25px; width: 275px;">
                            <h1>Match on the go</h1>
                            <h2>MedMatch is available for iOS<br> and Android so you can always<br> be in touch with your dream job. </h2>
                            <br>
                            <div class="store-btn">
                                <span>
                                    <a class="btn btn-embossed btn-wide btn-inverse lets_start_popup" href="javascript:void(0);">Get Started</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="store-action">
                            <div class="apple-store-btn">
                                <a class="apple-action-link"></a>
                                <a class="play-action-link"></a>
                            </div>
                        </div>
                        <div class="iphone">
                            <a href="#">
                                <?php echo load_img("iphone.png","","","188"); ?>
                            </a>
                            
                        </div>
                    </div>
                </div>

                <div class="section group s7">
                    <div class="section-7">
                        <div id="mcts1" style="background-image: none; margin-top: 30px;">
                            <div style="display: block; position: relative; overflow: hidden;">
                                <div style="display: block; width: 999999px; position: relative;">
                                    <div class="item" style="display: block; float: left;">
                                        <div class="class1 mid-heading">
                                            <?php echo load_img("sponser1.png"); ?>
                                        </div>
                                    </div>
                                    <div class="item" style="display: block; float: left;">
                                        <div class="class1 mid-heading">
                                            <?php echo load_img("sponser2.png"); ?>
                                        </div>
                                    </div>
                                    <div class="item" style="display: block; float: left;">
                                        <div class="class1 mid-heading">
                                            <?php echo load_img("sponser3.png"); ?>
                                        </div>
                                    </div>
                                    <div class="item" style="display: block; float: left;">
                                        <div class="class1 mid-heading">
                                            <?php echo load_img("sponser4.png"); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div> 
    </div>
</div>
                

<script>
    $(window).load(function () {
        $(".lets_start_popup").click();
    });
</script>

<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
    window.$zopim || (function (d, s) {
        var z = $zopim = function (c) {
            z._.push(c)
        }, $ = z.s =
                d.createElement(s), e = d.getElementsByTagName(s)[0];
        z.set = function (o) {
            z.set.
                    _.push(o)
        };
        z._ = [];
        z.set._ = [];
        $.async = !0;
        $.setAttribute('charset', 'utf-8');
        $.src = '//v2.zopim.com/?2Wnx87wmqorfDTnsj9noPLkkVJ7hBE8d';
        z.t = +new Date;
        $.
                type = 'text/javascript';
        e.parentNode.insertBefore($, e)
    })(document, 'script');
</script>
<!--End of Zopim Live Chat Script--> 