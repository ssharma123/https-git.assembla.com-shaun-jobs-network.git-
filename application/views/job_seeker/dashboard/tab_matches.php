<div class="row-wrapper">
    <div class="p-container-inner-box job_match_div_tab" style="cursor: pointer; ">
        <div class="red">
            <div class="p-first-box">
                <div class="p-first-box-main">
                    <div class="p-first-box-main-inner">
                        <div class="p-main-text-div ng-binding">100+</div>
                    </div>
                </div>
            </div>
            <div class="p-second-box">
                <div class="p-title-bar ng-binding">asdf </div>
                <div class="p-title-bar-detail ng-binding">San Francisco<br>$50K - $75K</div>
            </div>
            <div style="float: left; width: 25px;">&nbsp;</div>
            <div class="p-third-box">
                <div class="demo">
                    <div style="display: inline; width: 80px; height: 80px;">
                        <input data-readOnly="true" data-fgColor="#C7585F" class="knob" data-width="100" data-displayInput="true" value="80" >
                    </div>
                </div>
            </div>
            <div class="p-fourth-box">
                <a href="#">
                    <span class="glyphicon glyphicon-chevron-right" style="font-size: 35px; font-weight: normal; color: #4a4a4a;"></span>
                </a>
            </div>
            <div style="clear: both;"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    
    <div class="p-container-slider" id="job_match_detail_block" style="display: none;" >
        <div>
            <a id="back_job_details" href="javascript:void(0);"><span class="glyphicon glyphicon-chevron-left" style="font-size: 35px; font-weight: normal; color: #4a4a4a;"></span></a>
        </div>
        <div>
            <div>
                <div class="p-first-box" style="padding-left: 50px">Facility</div>
                <div class="p-second-box">&nbsp;</div>
                <div style="float: left; width: 25px;">&nbsp;</div>
                <div class="p-third-box" style="height: auto; padding-left: 40px">You Match</div>
                <div class="p-fourth-box" style="padding: 0">&nbsp;</div>
                <div style="clear: both;"></div>
            </div>
            
            <div class="p-container-inner-box" style="border: none; padding-bottom: 30px;">
                <div class="red">
                    <div class="p-first-box">
                        <div style="width: 120px; height: 120px; border: 1px solid #aaa; background-color: #ddd"><img ng-src=""></div>
                    </div>
                    <div class="p-second-box">
                        <div class="p-title-bar ng-binding">fds asd</div>
                        <div class="p-title-bar-detail ng-binding">San Francisco<br>$30K - $50K</div>
                    </div>
                    <div style="float: left; width: 25px;">&nbsp;</div>
                    <div class="p-third-box">
                        <div class="demo" >
                            <input data-readOnly="true" data-fgColor="#C7585F" class="knob" data-width="100" data-displayInput="true" value="80" >
                        </div>
                    </div>
                    <div class="p-fourth-box">&nbsp;</div>
                    <div style="clear: both;"></div>
                </div>
            </div>
            <div style="font-size: 17px;">
                Additional Information:
            </div>
            <div style="border: 2px solid #a4a4a4; padding: 10px;" class="ng-binding">
                <strong>Description:</strong> No Description.<br>
                <strong>Position:</strong> <br>
                <strong>Bonus:</strong> <br>
                <strong>Pay Frequency:</strong> <br>
                <div><strong>Inpatient:</strong> Yes<br></div>
                <div><strong>Loan Assistance:</strong> Yes<br></div>
                <div><strong>Requires BLS:</strong> Yes<br></div>
                <strong>Vacation Days:</strong> <br>
                <div><strong>cmeAllowance:</strong> Yes<br></div>
            </div>
            <div style="text-align: center; margin-top: 10px;">
                <?php echo load_img("Stock_1.png","","","","margin: 5px;"); ?>
                <?php echo load_img("Stock_2.png","","","","margin: 5px;"); ?>
                <?php echo load_img("Stock_3.png","","","","margin: 5px;"); ?>
                <?php echo load_img("Stock_4.jpg","","","","margin: 5px;"); ?>
            </div>
            <div style="text-align: center; margin-top: 10px;">
                <a class="btn btn-danger btn-lg" href="<?php echo site_url("job_seeker/signup"); ?>">Not Interested</a>
                <a class="btn btn-primary btn-lg" href="<?php echo site_url("job_seeker/signup"); ?>" >Apply</a>
                <a class="btn btn-warning btn-lg" href="<?php echo site_url("job_seeker/signup"); ?>" >Save</a>
                <br><br>
                <a class="btn btn-inverse btn-lg" href="<?php echo site_url("job_seeker/signup"); ?>">Want More? Sign Up Here</a>
            </div>
        </div>
     </div>
    
</div>
<?php echo load_js("jquery.knob.min.js"); ?>
<script>
    $(".knob").knob({
        'draw' : function () { 
                $(this.i).val(this.cv + '%')
        }
    })
    $(".knob").show();
    
    $("#tabContent").on("click","#back_job_details",function(){
        $(".job_match_div_tab").show();
        $("#job_match_detail_block").hide();
    });
    $("#tabContent").on("click",".job_match_div_tab",function(){
        // get id 
        // get job details data 
        $(".job_match_div_tab").hide();
        $("#job_match_detail_block").show();
        // show detail data
        
    });
</script>