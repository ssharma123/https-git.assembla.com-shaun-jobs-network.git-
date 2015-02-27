<?php
$percent_class = get_match_class($percent);
$percent_color = get_match_color($percent);
?>
<div>
    <a id="back_job_details" href="javascript:void(0);"><span class="glyphicon glyphicon-chevron-left" style="font-size: 35px; font-weight: normal; color: #4a4a4a;"></span></a>
</div>
<div>
    <div class="p-first-box" style="padding-left: 50px"><h4>Facility</h4></div>
    <div class="p-second-box">&nbsp;</div>
    <div style="float: left; width: 25px;">&nbsp;</div>
    <div class="p-third-box" style="height: auto; padding-left: 30px"><h4>You Match</h4></div>
    <div class="p-fourth-box" style="padding: 0">&nbsp;</div>
    <div style="clear: both;"></div>
</div>

<div class="p-container-inner-box" style="border: none; padding-bottom: 30px;">
    <div class="<?php echo $percent_class; ?>" >
        <div class="p-first-box">
            <div style="width: 120px; height: 120px; border: 1px solid #aaa; background-color: #ddd"><img ng-src=""></div>
        </div>
        <div class="p-second-box">
            <div class="p-title-bar ng-binding"><?php echo $row['job_headline']; ?></div>
            <div class="p-title-bar-detail ng-binding"><?php echo $row['city'].",".$row['state']?><br>
                $<?php echo show_salary($row['salary_range_min']); ?> 
                <?php
                if($row['salary_range_max'] == 0){
                    echo "+";
                } 
                else { ?>
                - $<?php echo show_salary($row['salary_range_max']); ?>    
                <?php 
                } ?>
                
            </div>
        </div>
        <div style="float: left; width: 25px;">&nbsp;</div>
        <div class="p-third-box">
            <div class="demo" >
                <input data-readOnly="true" data-fgColor="<?php echo $percent_color; ?>" class="knob_detail" data-width="100" data-displayInput="true" value="<?php echo $percent; ?>" >
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
    <div>
    <strong>Description:</strong> <?php echo ($row["description"] != "") ? $row["description"] : "No Description"; ?> <br>
    </div>
    <div>
    <strong>Position:</strong> 
    
        <?php 
        echo ucfirst(str_replace("_"," ",$row["position_type"])); 
        ?> 
        <br>
    </div>
    <div>
    <strong>Bonus:</strong> 
    
        <?php 
        echo ucfirst(str_replace("_"," ",$row["bonus"])); 
        ?> 
        <br>
    </div>
    <div>
    <strong>Pay Frequency:</strong>
        <?php 
        echo ucfirst(str_replace("-"," ",$row["pay_frequency"])); 
        ?> 
        <br>
    </div>
    <div>
        <strong>Inpatient:</strong> 
        <?php echo ucfirst($row["in_patient"]); ?> 
        <br>
    </div>
    <div>
        <strong>Loan Assistance:</strong> 
        <?php echo ucfirst($row["benifits_loan"]); ?>
        <br>
    </div>
    <div>
        <strong>Requires BLS:</strong> 
        <?php echo ucfirst($row["requires_bls_certification"]); ?>
        <br>
    </div>
    
    <div>
        <strong>cme Allowance:</strong> 
        <?php echo ucfirst($row["benifits_cme_allowance"]); ?>
        <br>
    </div>
    <div>
        <strong>Vacation Days:</strong> 
        <?php echo $row["vacation_days"]; ?>
        <br>
    </div>
</div>
<div style="text-align: center; margin-top: 10px;">
    <?php echo load_img("Stock_1.png", "", "", "", "margin: 5px;"); ?>
    <?php echo load_img("Stock_2.png", "", "", "", "margin: 5px;"); ?>
    <?php echo load_img("Stock_3.png", "", "", "", "margin: 5px;"); ?>
    <?php echo load_img("Stock_4.jpg", "", "", "", "margin: 5px;"); ?>
</div>
<div style="text-align: center; margin-top: 10px;">
    
    <?php if($dashboard == "no"){ ?>
    <a class="btn btn-danger btn-lg" href="<?php echo site_url("job_seeker/signup"); ?>">Not Interested</a>
    <a class="btn btn-primary btn-lg" href="<?php echo site_url("job_seeker/signup"); ?>" >Apply</a>
    <a class="btn btn-warning btn-lg" href="<?php echo site_url("job_seeker/signup"); ?>" >Save</a>
    <br><br>
    <a class="btn btn-inverse btn-lg" href="<?php echo site_url("job_seeker/signup"); ?>">Want More? Sign Up Here</a>
    <?php } 
    else { ?>
    <a id="not_interested_job_btn" data-id="<?php echo $row['id']; ?>" class="btn btn-danger btn-lg" href="javascript:void(0);">Not Interested</a>
    <a id="apply_job_btn" data-id="<?php echo $row['id']; ?>" class="btn btn-primary btn-lg" href="javascript:void(0);" >Apply</a>
    <?php
    if( $saved == false ){ ?>
    <a id="save_job_btn" data-id="<?php echo $row['id']; ?>" class="btn btn-warning btn-lg" href="javascript:void(0);" >Save</a>
    <?php } ?>
    <br>
    <div id="busy_job_detail" style="display: none;"><?php echo load_img("busy.gif"); ?></div>
    <br>    
    <?php } ?>
</div>


<script>
    $(".knob_detail").knob({
        'draw': function () {
            $(this.i).val(this.cv + '%')
        }
    })
    $(".knob_detail").show();
    
    $(document).on("click","#back_job_details",function(e){
        e.stopImmediatePropagation();
        
        $("#job_match_list_id").show();
        $("#job_match_detail_block").hide();
    });
</script>