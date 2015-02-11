<style>
    .typeahead{
        z-index: 999999 !important;
    }
</style>
<div style="padding: 50px; min-height: 400px; background-color: #f7f7f7; width: 500px;" class="container ng-scope">
    <form class="form-horizontal ng-pristine ng-valid" id="signup_popup_form" method="post" action="<?php echo site_url('job_seeker/match/'); ?>">
        <div class="col col-sm-12 " id="lets_get_started_step1">
            <div class="text-center">
                <a class="btn btn-info btn-lg" >Let's get started!</a>
            </div> 

            <h4 class="text-center" style="font-size: 13px;font-weight: normal; font-style: italic;">Fill out a few important questsions to see real time matches of current jobs openings</h4>

            <br>

                <h2 class="text-center" style="border-top: 2px solid black; font-size: 13px; font-weight: bold; font-style: italic; padding-top: 20px; text-align:left; margin-bottom:20px; ">
                    PROFESSION
                </h2>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Facility</label>
                    <div class="col-sm-8">
                        <select id="specialty" name="specialty" class="ng-pristine ng-valid parent_speciality form-control" >
                            <option value="" disabled selected>Select</option>
                            <?php foreach ($specialties as $val) { ?>
                                <option value="<?php echo $val['id']; ?>" ><?php echo strip_slashes($val['name']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="phone">Sub facility</label>
                    <div class="col-sm-8">
                        <select id="sub_specialty" name="sub_specialty" class="ng-pristine ng-valid sub_speciality form-control" >
                            <option value=""></option>
                        </select>
                    </div>
                </div>


                <h2 class="text-center" style="border-top: 2px solid black; font-size: 13px; font-weight: bold; font-style: italic; padding-top: 20px; text-align:left; margin-bottom:20px;">
                    LOOKING FOR A JOB
                </h2>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Location</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control ng-pristine ng-valid sates_auto" placeholder="" id="state" name="state" >
                        <input type="hidden" id="sates_auto_val">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="phone">Within</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control ng-pristine ng-valid " placeholder="" >
                    </div>
                    <div class="col-sm-4" style="line-height: 30px;">Miles</div>
                </div>


                <div class="text-center" style="padding-top: 20px; border-top: 2px solid black">
                    <button id="lets_get_started_next" class="btn btn-primary btn-lg">Next</button>
                    <br>
                    <p>Already a member? <a href="<?php echo site_url('job_seeker/signin'); ?>">Log In</a> option</p>
                </div>
        </div>
        
        <div id="lets_get_started_step2" class="col col-sm-12" style="display: none;">
            <div class="text-center">
                <a class="btn btn-info btn-lg" >Almost there..</a>
            </div> 

            <h4 class="text-center" style="font-size: 13px;font-weight: normal; font-style: italic;">One more step to see your top matches!</h4>

            <br>

                <h2 class="text-center" style="border-top: 2px solid black; font-size: 13px; font-weight: bold; font-style: italic; padding-top: 20px; text-align:left; margin-bottom:20px; ">
                    CRITERIA
                </h2>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Desired Salary</label>
                    <div class="col-sm-8">
                        <select  id="salary_range" name="salary_range" class="ng-pristine ng-valid form-control"  >
                            <option value="35-50" selected >$35k - $50k</option>
                            <option value="50-75"  >$50K - $75K</option>
                            <option value="100-150"  >$100K - $150K</option>
                            <option value="150-225"  >$150K - $225K</option>
                            <option value="225-300"  >$225k - $300K</option>
                            <option value="300-400"  >$300k - $400K</option>
                            <option value="400-550"  >$400k - $550K</option>
                            <option value="550"  >$550k+</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="phone">Currently Employed</label>
                    <div class="col-sm-8">
                        <input type="radio" id="current_employed_yes" name="current_employed" checked> <label for="current_employed_yes">Yes</label>
                        <input type="radio" id="current_employed_no" name="current_employed" > <label for="current_employed_no">No</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Ideal Culture</label>
                    <div class="col-sm-8">
                        <select  id="salary_range" name="salary_range" class="ng-pristine ng-valid form-control" >
                            <option value="Medium sized Hospital" selected >Medium sized Hospital</option>
                            <option value="Large Teaching Institution"  >Large / Teaching Institution</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Availability</label>
                    <div class="col-sm-8">
                        <select  id="salary_range" name="salary_range" class="ng-pristine ng-valid form-control" >
                            <option value="ASAP" selected>ASAP</option>
                            <option value="1-3 Months">1-3 Months</option>
                            <option value="3-6 Months">3-6 Months</option>
                            <option value="6-12 Months">6-12 Months</option>
                            <option value="Just Looking">Just Looking</option>
                        </select>
                    </div>
                </div>
                 

                <div class="text-center" style="padding-top: 20px; border-top: 2px solid black">
                    <button type="submit" class="btn btn-lg btn-primary btn-lg">Show Matches</button>
                    <br>
                    <p>Already a member? <a href="<?php echo site_url('job_seeker/signin'); ?>">Log In</a> option</p>
                </div>
        </div>
        
    </form>
</div>
<script>
    $(".sates_auto").typeahead({
        source: states,
        display: 'name',
        val: 'id',
        itemSelected: function (data, value, text) {
            $("#sates_auto_val").val(value);
        }
    });

    $(".sates_auto").keyup(function (event) {
        var key = event.keyCode || event.which;
        if (key !== 13) {
            $("#sates_auto_val").val('');
        }
    });
    
    $("#lets_get_started_next").click(function(e){
        e.preventDefault();
        $("#lets_get_started_step1").hide();
        $("#lets_get_started_step2").show();
        
        return false;
    });
</script>