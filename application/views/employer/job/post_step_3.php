<form id="form_jobStep3" method="post">
    <h3>Work Culture</h3>
    <div style="min-height: 300px;">
        <fieldset style="float: none; margin: 0 auto; padding: 0; width: 100%; padding-left: 100px;">
            <div class="filter">
                <div style="float: left; width: 38%">
                    <label style="width: 45%">Department Size<sup>*</sup></label> 
                    <select style="width: 30%" id="department_size" name="department_size" class="ng-pristine ng-valid" required>
                        <option value="" class="">Select</option>
                        <option value="0-5">0-5</option>
                        <option value="5-10">5-10</option>
                        <option value="10-20">10-20</option>
                        <option value="20-40">20-40</option>
                        <option value="40+">40+</option>
                    </select>
                </div>
                <div style="float: left; width: 58%">
                    <label style="width: 40%">Patients seen per day<sup>*</sup></label> 
                    <input type="number" style="width: 25%" id="patients_per_day" name="patients_per_day" class="intMast ng-pristine ng-valid" required>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="filter">
                <label style="width: 15%">Services For</label> <label style="width: 18%; text-align: center;">
                    <input type="checkbox" id="in_patient" name="in_patient" class="ng-pristine ng-valid"> Inpatient
                </label> 
                <label style="text-align: left">
                    <input type="checkbox" id="out_patient" name="out_patient" class="ng-pristine ng-valid"> Outpatient
                </label>
            </div>
            <div class="filter">
                <label style="width: 15%">Work Schedule<sup>*</sup></label> 
                <select style="width: 30%" id="work_schedule" name="work_schedule" class="ng-pristine ng-valid" onchange="toggleWork_schedule();" required>
                    <option value="" class="">Select</option>
                    <option value="1 on / 1 off">1 on / 1 off</option>
                    <option value="7 on / 7 off">7 on / 7 off</option>
                    <option value="custom">Custom</option>
                </select>
                    <input type="text" style="width: 25%; display:none; " id="custom_work_schedule" name="custom_work_schedule" class="ng-pristine ng-valid ng-hide">
            </div>
            <div class="filter">
                <label style="width: 15%">Call Schedule<sup>*</sup></label> 
                <input type="text" style="width: 25%" id="call_schedule" name="call_schedule" class="ng-pristine ng-valid" required>
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
//    $( ".datepicker" ).datepicker();
</script>