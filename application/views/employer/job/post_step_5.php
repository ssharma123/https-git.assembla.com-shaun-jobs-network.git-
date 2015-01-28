<form id="form_jobStep5" method="post">
    <h3>Additional Information</h3>
    <div style="min-height: 300px;">
        <fieldset style="float: none; margin: 0 auto; padding: 0; width: 100%;">
            <div class="filter">
                <label>Visa / Citizenship Acceptance</label> <label style="text-align: left; padding-left: 10px; width: 10%;">
                    <input type="checkbox" class="ng-pristine ng-valid" id="citizen" name="citizen" > Citizen
                </label>
                <label style="text-align: left; width: 13%;">
                    <input type="checkbox" class="ng-pristine ng-valid" id="green_card" name="green_card"> Green Card
                </label>
                <label style="text-align: left;">
                    <input type="checkbox" class="ng-pristine ng-valid" id="visa" name="visa"> J1 Visa
                </label>
            </div>
            <div class="filter">
                <label style="vertical-align: top">Other Description<br><span style="font-size: 11px;">Please keep it brief, and with bullet points. Thank You!</span></label>
                <textarea style="height: 150px; margin: 10px; padding: 5px; border: 1px solid rgb(154, 155, 159); border-radius: 5px; width: 360px; resize: none; display: inline-block" rows="5" id="description" name="description" type="text" class="ng-pristine ng-valid"></textarea>
            </div>
        </fieldset>
    </div>
    <div style="text-align: center; margin-top: 20px;">
        <a href="javascript:void(0)" class="post-form-back" data-backTo="4">Back</a> &nbsp;  &nbsp; <a href="javascript:void(0)" class="btn btn-lg btn-primary post-form-continue-btn" id="continue-step5" data-stepTo="6">Continue</a>
    </div>
</form>