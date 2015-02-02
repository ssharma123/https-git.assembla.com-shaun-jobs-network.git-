<form id="form_jobStep3" method="post">
    <h3>Work Culture</h3>
    <div style="min-height: 300px;">
        <fieldset style="float: none; margin: 0 auto; padding: 0; width: 100%; padding-left: 100px;">
            <div class="filter">
                <div style="float: left; width: 38%">
                    <label style="width: 45%">Department Size<sup>*</sup></label> 
                    <select style="width: 30%" id="department_size" name="department_size" class="ng-pristine ng-valid" required>
                        <option value="" class="">Select</option>
                        <?php
                        $selected = (isset($job['department_size']) && $job['department_size'] == "0-5" ) ? ' selected="selected" ' : "" ;
                        ?>
                        <option value="0-5" <?php echo $selected; ?> >0-5</option>
                        <?php
                        $selected = (isset($job['department_size']) && $job['department_size'] == "5-10" ) ? ' selected="selected" ' : "" ;
                        ?>
                        <option value="5-10" <?php echo $selected; ?> >5-10</option>
                        <?php
                        $selected = (isset($job['department_size']) && $job['department_size'] == "10-20" ) ? ' selected="selected" ' : "" ;
                        ?>
                        <option value="10-20" <?php echo $selected; ?> >10-20</option>
                        <?php
                        $selected = (isset($job['department_size']) && $job['department_size'] == "20-40" ) ? ' selected="selected" ' : "" ;
                        ?>
                        <option value="20-40" <?php echo $selected; ?> >20-40</option>
                        <?php
                        $selected = (isset($job['department_size']) && $job['department_size'] == "40+" ) ? ' selected="selected" ' : "" ;
                        ?>
                        <option value="40+" <?php echo $selected; ?> >40+</option>
                    </select>
                </div>
                <div style="float: left; width: 58%">
                    <label style="width: 40%">Patients seen per day<sup>*</sup></label> 
                    <input type="number" style="width: 25%" id="patients_per_day" name="patients_per_day" class="intMast ng-pristine ng-valid" required value="<?php echo (isset($job['patients_per_day'])) ? $job['patients_per_day'] : "" ; ?>" >
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="filter">
                <label style="width: 15%">Services For</label> <label style="width: 18%; text-align: center;">
                    <?php
                    $selected = (isset($job['in_patient']) && $job['in_patient'] == "yes" ) ? ' checked="checked" ' : "" ;
                    ?>
                    <input type="checkbox" id="in_patient" name="in_patient" class="ng-pristine ng-valid" <?php echo $selected; ?> > Inpatient
                </label> 
                <label style="text-align: left">
                    <?php
                    $selected = (isset($job['out_patient']) && $job['out_patient'] == "yes" ) ? ' checked="checked" ' : "" ;
                    ?>
                    <input type="checkbox" id="out_patient" name="out_patient" class="ng-pristine ng-valid" <?php echo $selected; ?> > Outpatient
                </label>
            </div>
            <div class="filter">
                <label style="width: 15%">Work Schedule<sup>*</sup></label> 
                <select style="width: 30%" id="work_schedule" name="work_schedule" class="ng-pristine ng-valid" onchange="toggleWork_schedule();" required>
                    <option value="" class="">Select</option>
                    <?php
                    $selected = (isset($job['work_schedule']) && $job['work_schedule'] == "1 on / 1 off" ) ? ' selected="selected" ' : "" ;
                    ?>
                    <option value="1 on / 1 off" <?php echo $selected; ?>>1 on / 1 off</option>
                    <?php
                    $selected = (isset($job['work_schedule']) && $job['work_schedule'] == "7 on / 7 off" ) ? ' selected="selected" ' : "" ;
                    ?>
                    <option value="7 on / 7 off" <?php echo $selected; ?>>7 on / 7 off</option>
                    <?php
                    $selected = (isset($job['work_schedule']) && $job['work_schedule'] == "custom" ) ? ' selected="selected" ' : "" ;
                    ?>
                    <option value="custom" <?php echo $selected; ?>>Custom</option>
                </select>
                <?php
                $style = (isset($job['work_schedule']) && $job['work_schedule'] == "custom" ) ? 'display: block ;' : 'display: none;' ;
                ?>
                <input type="text" style="width: 25%; <?php echo $style; ?> " id="custom_work_schedule" name="custom_work_schedule" class="ng-pristine ng-valid ng-hide" value="<?php echo (isset($job['custom_work_schedule'])) ? $job['custom_work_schedule'] : "" ; ?>" >
            </div>
            <div class="filter">
                <label style="width: 15%">Call Schedule<sup>*</sup></label> 
                <input type="text" style="width: 25%" id="call_schedule" name="call_schedule" class="ng-pristine ng-valid" required value="<?php echo (isset($job['call_schedule'])) ? $job['call_schedule'] : "" ; ?>" >
            </div>
        </fieldset>
    </div>
    <div style="text-align: center; margin-top: 20px;">
        <a href="javascript:void(0)" class="post-form-back" data-backTo="2">Back</a> &nbsp;  &nbsp; <a href="javascript:void(0)" class="btn btn-lg btn-primary post-form-continue-btn" id="continue-step3" data-stepTo="4">Continue</a>
    </div>
</form>
<script>
    function toggleWork_schedule(){
        var value = $("#work_schedule").val();
        if(value === "custom"){
            $("#custom_work_schedule").show();
            $("#custom_work_schedule").attr("required",'true');
        }
        else{
            $("#custom_work_schedule").hide();
            $("#custom_work_schedule").removeAttr("required");
        }
    }
</script>