
<!DOCTYPE html>
<html lang="en" ng-app="myApp" class="ng-scope">
    <head>
        <style type="text/css">
            /* @charset "UTF-8";
            [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak, .ng-hide
            {
                display: none !important;
            }
            ng\:form
            {
                display: block;
            }
            */
        </style>
        <meta charset="utf-8">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <title><?php echo $this->title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <link rel="shortcut icon" href="<?php echo base_url('assets/favicon.ico')?>">
        

        <?php echo load_css("bootstrap.css"); ?>
        <?php echo load_css("flat-ui-pro.css"); ?>
        <?php echo load_css("icon-font.css"); ?>
        <?php echo load_css("animations.css"); ?>
        <?php echo load_css("style.css"); ?>
        <!--Google Fonts-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700,300,600,400' rel='stylesheet' type='text/css'>
        <!--End Google Fonts-->

        <!--Typekit-->
        <script src="//use.typekit.net/gtx7xrg.js"></script>
        <script>try {
            Typekit.load();
        } catch (e) {
        }</script>
        <!--End Typekit-->


        <?php echo load_js("jquery-1.10.2.min.js"); ?>  
    </head>

    <body>
        <div class="page-wrapper">

            <!-- header-11 -->
<!--            HEADER START-->
            <header class="header-11">

                <div class="container">

                    <div class="row">

                        <div class="navbar col-sm-12" role="navigation">

                            <div class="navbar-header">

                                <button type="button" class="navbar-toggle"></button>

                                <a class="brand" href="<?php echo site_url(); ?>">
                                    <?php echo load_img("logo.png", "MedMatch", "32", "234"); ?>
                                </a>

                            </div>

                            <div class="collapse navbar-collapse pull-right">

                                <ul class="nav pull-left">
                                </ul>
                                <div class="form-group">
                                    <form class="navbar-form pull-left">
                                        <?php
                                        $session = $this->session->all_userdata();
                                        if( isset($session['employer']) ){ ?>
                                        <span style="margin:5px;"><a class="btn btn-embossed btn-wide btn-danger" href="<?php echo site_url('employer/signout'); ?>">Sign out</a></span>
                                        <?php } 
                                        else { ?>
                                        <span style="margin:5px;"><a class="btn btn-embossed btn-wide btn-success" href="<?php echo site_url('employer/signin'); ?>">Sign in</a></span>
                                        <?php } ?>
                                    </form>
                                </div>	


                            </div>

                        </div>

                    </div>

                </div>

                <div class="header-background"></div>

            </header>
<!--            HEADER END-->
{yield}
<!--            FOOTER START-->
            <footer class="footer-9 v-center">
                <div>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="box box-first">
                                    <h6>MedMatch Jobs</h6>
                                    <p>Copyright 2014 MedMatch. <br>All Rights Reserved.</p>
                                </div>
                                <br class="hidden-xs">
                                <div class="box">
                                    <h6>Chicago, IL</h6>
                                    <p>222 W. Merchandise Mart Plaza, 12th Floor Chicago, IL 60654</p>
                                </div>
                            </div>
                            <div class="col-sm-4 col-sm-offset-1 box">
                                <h6>Questions</h6>
                                <p>We want to hear from you. Email us directly at <a href="mailto:jobs@medmatchjobs.com">info@medmatchjobs.com</a> you may also call or text us as 1-312-635-4633. Please review our <a href="#">FAQ</a> and <a href="#">How it Works</a> pages for additional information about MedMatch Jobs.</p>
                            </div>
                            <div class="col-sm-3 col-sm-offset-1 box">
                                <h6>Matching Guidelines</h6>
                                <p>MedMatch Jobs is committed to transparency and efficiency. By using MedMatch Jobs, you are signifying your acceptance of the <a href="#">terms</a> and <a href="#">conditions</a> of this site.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            
            <div class="footer-4 bg-midnight-blue">
                <div class="container">
                    <a class="brand">
                        <?php echo load_img("logowhite.svg", "", "125", "125"); ?>
                    </a>
                </div>
            </div>

<!--            FOOTER END -->

            <!-- Placed at the end of the document so the pages load faster --> 
            
            <?php echo load_js("jquery.bxslider.min.js"); ?>
            <?php echo load_js("jquery.scrollTo-1.4.3.1-min.js"); ?>
            <?php echo load_js("jquery.sharrre.min.js"); ?>
            <?php echo load_js("bootstrap.min.js"); ?>
            <?php echo load_js("masonry.pkgd.min.js"); ?>
            <?php echo load_js("modernizr.custom.js"); ?>
            <?php echo load_js("page-transitions.js"); ?>
            <?php echo load_js("easing.min.js"); ?>
            <?php echo load_js("jquery.svg.js"); ?>
            <?php echo load_js("jquery.svganim.js"); ?>
            <?php //echo load_js("froogaloop.min.js"); ?>
            <?php echo load_js("startup-kit.js"); ?>
            
        </div>
    </body>
</html>

