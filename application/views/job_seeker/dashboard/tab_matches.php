<div class="row-wrapper">
    <div class="p-container-inner-box job_match_div" style="cursor: pointer; ">
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
                    <?php echo load_img("arrow-next.png", "next", "17", "28"); ?>

                </a>
            </div>
            <div style="clear: both;"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="p-container-inner-box job_match_div" style="cursor: pointer; ">
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
                    <?php echo load_img("arrow-next.png", "next", "17", "28"); ?>

                </a>
            </div>
            <div style="clear: both;"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    
</div>
<?php echo load_js("jquery.knob.min.js"); ?>
<script>
    $(".knob").knob({
        'draw' : function () { 
                $(this.i).val(this.cv + '%')
        }
    })
    $(".knob").show();
</script>