<form id="form_jobStep4" method="post">
    <h3>Pay &amp; Benefits</h3>
    <div style="min-height: 300px;">
        <fieldset style="float: none; margin: 0 auto; padding: 0; width: 100%;">
            <div class="filter">
                <label>Salary Range<sup>*</sup></label> 
                <select style="width: 20%" id="salary_range" name="salary_range" class="ng-pristine ng-valid" required onchange="toggleSalary_range()">
                    <option value="" class="">Select</option>
                    <option value="35-50">$35k - $50k</option>
                    <option value="50-75">$50K - $75K</option>
                    <option value="100-150">$100K - $150K</option>
                    <option value="150-225">$150K - $225K</option>
                    <option value="225-300">$225k - $300K</option>
                    <option value="300-400">$300k - $400K</option>
                    <option value="400-550">$400k - $550K</option>
                    <option value="550">$550k+</option>
                    <option value="custom">Custom</option>
                </select>
                
                <div id="custom_salary_range_div" style="display: none;" class="ng-hide">
                    <label style="width: 5%">Min</label> 
                    <input type="number" id="salary_range_min" name="salary_range_min" class="intMask ng-pristine ng-valid" style="width: 10%">
                    <label style="width: 5%">Max</label> 
                    <input type="number" id="salary_range_max" name="salary_range_max" class="intMask ng-pristine ng-valid" style="width: 10%">
                </div>
            </div>												
            <div style="font-style: italic; color: #40b0ff; margin: 0px auto; font-size: 13px; width: 500px;" class="filter text-left">
                <sup>*</sup>We understand that this will probably be negotiated, however one of these are needed.<br>Physicians have expressed that knowing this is a top concern.
            </div>
            <div class="filter">
                <label>Bonus / Commission</label> 
                <input type="text" id="bonus" name="bonus" class="ng-pristine ng-valid">
            </div>
            <div class="filter">
                <label>Pay Frequency<sup>*</sup></label> 
                <select class="ng-pristine ng-valid" name="pay_frequency" id="pay_frequency">
                    <option value="weekly">Weekly</option>
                    <option value="bi-weekly">Bi-Weekly</option>
                    <option value="bi-monthly" selected="selected">Bi-Monthly</option>
                    <option value="monthly">Monthly</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="filter">
                <label>Benefits</label> 
                <label style="text-align: left; padding-left: 10px; width: 10%;">
                    <input type="checkbox" name="benifits_401k" id="benifits_401k" class="ng-pristine ng-valid"> 401K
                </label>
                <label style="text-align: left; width: 17%;">
                    <input type="checkbox" name="benifits_cme_allowance" id="benifits_cme_allowance" class="ng-pristine ng-valid"> CME Allowance
                </label>
                <label style="text-align: left;">
                    <input type="checkbox" name="benifits_loan" id="benifits_loan" class="ng-pristine ng-valid"> Loan Assistance
                </label>
            </div>
            <div class="filter">
                <div style="float: left; width: 48%">
                    <label>Vacation Days</label> 
                    <input type="text" id="vacation_days" text="vacation_days" class="ng-pristine ng-valid">
                </div>
                <div style="float: left; width: 48%">
                    <label>Employment Term (Min)</label> 
                    <input style="width: 60%;" type="number" id="employment_term" name="employment_term" placeholder="12 months (numbers only)" class="ng-pristine ng-valid">
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