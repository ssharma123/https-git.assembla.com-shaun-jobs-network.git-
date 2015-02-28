<style>
  .info_top{
    font-size:14px;
  }
  .info_top span{
    font-size:12px;
    font-style:italic;
  }
  .line_separator{
    border-top:1px solid ;
    margin-top: 15px ;
    margin-bottom: 15px ;
  }
</style> 
<div class="col-sm-10 col-sm-offset-1 text-center" >
    <form id="form_profileStep7" method="post">
         
        <h3>Additional Matching Information (optional)</h3>
        
        <div style="min-height: 300px;">
            <fieldset style="float: none; margin: 0 auto; padding: 0; width: 480px;">

                <p class="info_top">What are the top 3 criteria in pursuing an opportunity?</p>
                
                <div class="left_col">
                    <input type="text" placeholder="Criteria 1" id="criteria_1" name="criteria_1" class="form-control" value="<?php echo isset($jobseeker['criteria_1']) ? $jobseeker['criteria_1'] : "" ;  ?>" >
                </div>
                <div class="right_col">
                    <input type="text" placeholder="Criteria 2" id="criteria_2" name="criteria_2" class="form-control" value="<?php echo isset($jobseeker['criteria_2']) ? $jobseeker['criteria_2'] : "" ;  ?>" >
                </div>
                <div class="left_col">
                    <input type="text" placeholder="Criteria 3" id="criteria_3" name="criteria_3" class="form-control" value="<?php echo isset($jobseeker['criteria_3']) ? $jobseeker['criteria_3'] : "" ;  ?>" >
                </div>
                <div class="right_col">
                    <input type="text" placeholder="Criteria 4" id="criteria_4" name="criteria_4" class="form-control" value="<?php echo isset($jobseeker['criteria_4']) ? $jobseeker['criteria_4'] : "" ;  ?>" >
                </div>
                <div style="clear: both;"></div>
                <div class="line_separator"></div>
                <div style="clear: both;"></div>
                <p class="info_top">What is your ultimate motivation in searching for a job?</p>
                <div>
                    <input type="text" id="ultimate_motivation" name="ultimate_motivation" class="form-control" value="<?php echo isset($jobseeker['ultimate_motivation']) ? $jobseeker['ultimate_motivation'] : "" ;  ?>" >
                </div>
                
                <div class="line_separator"></div>
                <p class="info_top">Are you selectively or actively looking for a job? Why?</p>
                <div>
                    <input type="text" id="selective_active_why" name="selective_active_why" class="form-control" value="<?php echo isset($jobseeker['selective_active_why']) ? $jobseeker['selective_active_why'] : "" ;  ?>" >
                </div>
                
                <div class="line_separator"></div>
                <p class="info_top">If you could create an ideal job for yourself (salary, location, responsibilities, etc), what that look like?
                    <br><span>*Will not be seen by any recruiters</span>
                </p>
                <div>
                    <input type="text" id="ideal_job" name="ideal_job" class="form-control" value="<?php echo isset($jobseeker['ideal_job']) ? $jobseeker['ideal_job'] : "" ;  ?>" >
                </div>
                 
            </fieldset>
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <a href="javascript:void(0)" class="profile-back" data-backTo="6" >Back</a>&nbsp;
            <a id="skip_7_btn" href="javascript:void(0)" >Skip</a> &nbsp;&nbsp;
            <a href="javascript:void(0)" class="btn btn-lg btn-primary profile_steps_continue" data-step="continue-step7" data-stepTo="8" data-formValidate="form_profileStep7">Continue</a>
        </div>
    </form>
</div>