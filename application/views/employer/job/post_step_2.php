<form id="form_jobStep2" method="post">
    <h3>Licensing &amp; Credentials</h3>
    <div style="min-height: 300px;">
        <fieldset style="float: none; margin: 0 auto; padding: 0; width: 100%; padding-left: 100px;">
            <div class="filter">
                <label>Active License Required?</label> 
                <?php
                $selected = (isset($job['active_license_requires_certification']) && $job['active_license_requires_certification'] == "yes" ) ? ' checked="checked" ' : "" ;
                ?>
                <input type="checkbox" id="active_license_requires_certification" name="active_license_requires_certification" class="ng-pristine ng-valid" <?php echo $selected; ?>  >
                
            </div>
            <div class="filter">
                <label>Requires BLS Certification?</label>
                <?php
                $selected = (isset($job['requires_bls_certification']) && $job['requires_bls_certification'] == "yes" ) ? ' checked="checked" ' : "" ;
                ?>
                <input type="checkbox" id="requires_bls_certification" name="requires_bls_certification" class="ng-pristine ng-valid" <?php echo $selected; ?> >
            </div>
            <div class="filter">
                <label>Accept J1?</label> 
                <?php
                $selected = (isset($job['accept_ji_certification']) && $job['accept_ji_certification'] == "yes" ) ? ' checked="checked" ' : "" ;
                ?>
                <input type="checkbox" id="accept_ji_certification" name="accept_ji_certification" class="ng-pristine ng-valid" <?php echo $selected; ?> >
            </div>
        </fieldset>
    </div>
    <div style="text-align: center; margin-top: 20px;">
        <a href="javascript:void(0)" class="post-form-back" data-backTo="1" data-value="<?php echo isset($job['id']) ? $job['id'] : 0; ?>">Back</a> &nbsp;  &nbsp; <a href="javascript:void(0)" class="btn btn-lg btn-primary post-form-continue-btn" id="continue-step2" data-stepTo="3">Continue</a>
    </div>
</form>