<form id="form_jobStep4" method="post">
    <h3>Pay &amp; Benefits</h3>
    <div style="min-height: 300px;">
        <fieldset style="float: none; margin: 0 auto; padding: 0; width: 100%;">
            <div class="filter">
                <label>Salary Range<sup>*</sup></label> 
                
                <select style="width: 20%" id="salary_range" name="salary_range" class="ng-pristine ng-valid" required onchange="toggleSalary_range()">
                    <option value="" class="">Select</option>
                    <?php
                    $selected = (isset($job['salary_range']) && $job['salary_range'] == "35000-50000" ) ? ' selected="selected" ' : "" ;
                    ?>
                    <option value="35000-50000" <?php echo $selected; ?> >$35k - $50k</option>
                    <?php
                    $selected = (isset($job['salary_range']) && $job['salary_range'] == "50000-75000" ) ? ' selected="selected" ' : "" ;
                    ?>
                    <option value="50000-75000" <?php echo $selected; ?> >$50K - $75K</option>
                    <?php
                    $selected = (isset($job['salary_range']) && $job['salary_range'] == "100000-150000" ) ? ' selected="selected" ' : "" ;
                    ?>
                    <option value="100000-150000" <?php echo $selected; ?> >$100K - $150K</option>
                    <?php
                    $selected = (isset($job['salary_range']) && $job['salary_range'] == "150000-225000" ) ? ' selected="selected" ' : "" ;
                    ?>
                    <option value="150000-225000" <?php echo $selected; ?> >$150K - $225K</option>
                    <?php
                    $selected = (isset($job['salary_range']) && $job['salary_range'] == "225000-300000" ) ? ' selected="selected" ' : "" ;
                    ?>
                    <option value="225000-300000" <?php echo $selected; ?> >$225k - $300K</option>
                    <?php
                    $selected = (isset($job['salary_range']) && $job['salary_range'] == "300000-400000" ) ? ' selected="selected" ' : "" ;
                    ?>
                    <option value="300000-400000" <?php echo $selected; ?> >$300k - $400K</option>
                    <?php
                    $selected = (isset($job['salary_range']) && $job['salary_range'] == "400000-550000" ) ? ' selected="selected" ' : "" ;
                    ?>
                    <option value="400000-550000" <?php echo $selected; ?> >$400k - $550K</option>
                    <?php
                    $selected = (isset($job['salary_range']) && $job['salary_range'] == "550000" ) ? ' selected="selected" ' : "" ;
                    ?>
                    <option value="550000" <?php echo $selected; ?> >$550k+</option>
                    <?php
                    $selected = (isset($job['salary_range']) && $job['salary_range'] == "custom" ) ? ' selected="selected" ' : "" ;
                    $mode_type = $this->session->userdata("job_mode_type");
                    if($mode_type == "add"){
                        $selected = ' selected="selected" ';
                    }
                    ?>
                    <option value="custom" <?php echo $selected; ?> >Custom</option>
                </select>
                
                <?php
                $style = (isset($job['salary_range']) && $job['salary_range'] == "custom" ) ? 'display: inline ;' : 'display: none;' ;
                $mode_type = $this->session->userdata("job_mode_type");
                if($mode_type == "add"){
                    $style = 'display: inline ;';
                }
                ?>
                <div id="custom_salary_range_div" style="<?php echo $style; ?>" class="ng-hide">
                    <label style="width: 5%">Min</label> 
                    <input min="99999" max="999999" type="number" id="salary_range_min" name="salary_range_min" class="intMask ng-pristine ng-valid" style="width: 10%" value="<?php echo (isset($job['salary_range_min'])) ? $job['salary_range_min'] : "" ; ?>" >
                    <label min="99999" max="999999" style="width: 5%">Max</label> 
                    <input type="number" id="salary_range_max" name="salary_range_max" class="intMask ng-pristine ng-valid" style="width: 10%" value="<?php echo (isset($job['salary_range_max'])) ? $job['salary_range_max'] : "" ; ?>" >
                </div>
            </div>												
            <div style="font-style: italic; color: #40b0ff; margin: 0px auto; font-size: 13px; width: 500px;" class="filter text-left">
                <sup>*</sup>We understand that this will probably be negotiated, however one of these are needed.<br>Physicians have expressed that knowing this is a top concern.
            </div>
            <div class="filter">
                <label>Bonus / Commission</label> 
                <input maxlength="80" type="text" id="bonus" name="bonus" class="ng-pristine ng-valid" value="<?php echo (isset($job['bonus'])) ? $job['bonus'] : "" ; ?>" >
            </div>
            <div class="filter">
                <label>Pay Frequency<sup>*</sup></label> 
                <select class="ng-pristine ng-valid" name="pay_frequency" id="pay_frequency">
                    <?php
                    $selected = (isset($job['pay_frequency']) && $job['pay_frequency'] == "weekly" ) ? ' selected="selected" ' : "" ;
                    ?>
                    <option value="weekly" <?php echo $selected; ?> >Weekly</option>
                    <?php
                    $selected = (isset($job['pay_frequency']) && $job['pay_frequency'] == "bi-weekly" ) ? ' selected="selected" ' : "" ;
                    ?>
                    <option value="bi-weekly" <?php echo $selected; ?> >Bi-Weekly</option>
                    <?php
                    $selected = (isset($job['pay_frequency']) && $job['pay_frequency'] == "bi-monthly" ) ? ' selected="selected" ' : "" ;
                    ?>
                    <option value="bi-monthly" selected="selected" <?php echo $selected; ?> >Bi-Monthly</option>
                    <?php
                    $selected = (isset($job['pay_frequency']) && $job['pay_frequency'] == "monthly" ) ? ' selected="selected" ' : "" ;
                    ?>
                    <option value="monthly" <?php echo $selected; ?> >Monthly</option>
                    <?php
                    $selected = (isset($job['pay_frequency']) && $job['pay_frequency'] == "other" ) ? ' selected="selected" ' : "" ;
                    ?>
                    <option value="other" <?php echo $selected; ?> >Other</option>
                </select>
            </div>
            <div class="filter">
                <label>Benefits</label> 
                <label style="text-align: left; padding-left: 10px; width: 10%;">
                    <?php
                    $selected = (isset($job['benifits_401k']) && $job['benifits_401k'] == "yes" ) ? ' checked="checked" ' : "" ;
                    ?>
                    <input type="checkbox" name="benifits_401k" id="benifits_401k" class="ng-pristine ng-valid" <?php echo $selected; ?> > 401K
                </label>
                <label style="text-align: left; width: 17%;">
                    <?php
                    $selected = (isset($job['benifits_cme_allowance']) && $job['benifits_cme_allowance'] == "yes" ) ? ' checked="checked" ' : "" ;
                    ?>
                    <input type="checkbox" name="benifits_cme_allowance" id="benifits_cme_allowance" class="ng-pristine ng-valid" <?php echo $selected; ?> > CME Allowance
                </label>
                <label style="text-align: left;">
                    <?php
                    $selected = (isset($job['benifits_loan']) && $job['benifits_loan'] == "yes" ) ? ' checked="checked" ' : "" ;
                    ?>
                    <input type="checkbox" name="benifits_loan" id="benifits_loan" class="ng-pristine ng-valid" <?php echo $selected; ?> > Loan Assistance
                </label>
            </div>
            <div class="filter">
                <div style="float: left; width: 48%">
                    <label>Vacation Days</label> 
                    <input type="text" id="vacation_days"  name="vacation_days" class="ng-pristine ng-valid" value="<?php echo (isset($job['vacation_days'])) ? $job['vacation_days'] : "" ; ?>" >
                </div>
                <div style="float: left; width: 48%">
                    <label>Employment Term (Min)</label> 
                    
                    <input style="width: 60%;" type="number" id="employment_term" name="employment_term" placeholder="12 months (numbers only)" class="ng-pristine ng-valid" value="<?php echo (isset($job['employment_term'])) ? $job['employment_term'] : "" ; ?>" >
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
</form>
<script>
    function toggleSalary_range(){
        var value = $("#salary_range").val();
        if(value === "custom"){
            $("#custom_salary_range_div").css('display', 'inline');
            $("#salary_range_min").attr("required",'true');
            $("#salary_range_max").attr("required",'true');
        }
        else{
            $("#custom_salary_range_div").css('display', 'none');
            $("#salary_range_min").removeAttr("required");
            $("#salary_range_max").removeAttr("required");
        }
    }
//    $( ".datepicker" ).datepicker();
</script>