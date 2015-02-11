<style>
    .left_col{
        float: left;
        width: 48%;
        margin-right: 10px;
        padding-top: 5px;
    }
    .right_col{
        float: left; 
        width: 48%;
        padding-top: 5px;
    }
</style>
<div class="col-sm-10 col-sm-offset-1 text-center" >

    <p>
        <?php echo load_img("first-step.png"); ?>
    </p>
    <h3>Let's create your Profile</h3>
    <div style="min-height: 300px;">
        <fieldset style="float: none; margin: 0 auto; padding: 0; width: 480px;">
            
            <div class="left_col">
                <input type="text" maxlength="50" placeholder="First Name" id="first_name" name="first_name" class="ng-pristine ng-valid form-control" required>
            </div>
            
            <div class="right_col">
                <input type="text" maxlength="50" placeholder="Last Name" id="last_name" name="last_name" class="ng-pristine ng-valid form-control" required>
            </div>
            
            <div class="left_col">
                <input type="text" maxlength="50" placeholder="Middle Name" id="middle_name" class="ng-pristine ng-valid form-control" >
            </div>
            <div class="right_col">
                <select ng-options="option for option in prefixes" class="ng-pristine ng-valid form-control">
                    <option selected="" value="" class="">Prefix</option>
                    <option value="0">Dr.</option>
                    <option value="1">Mr.</option>
                    <option value="2">Mrs.</option>
                    <option value="3">Ms.</option>
                </select>
            </div>
            
            <div class="left_col">
                <input type="text" placeholder="Suffix" class="ng-pristine ng-valid form-control">
            </div>
            <div class="right_col">
                <input type="text" placeholder="Prof. Suffix" id="suffix" class="ng-pristine ng-valid form-control">
            </div>
            
            <div class="left_col">
                <input type="text" maxlength="50" placeholder="Address" id="address" name="address" class="ng-pristine ng-valid form-control">
            </div>
            <div class="right_col">
                <input type="text" placeholder="Apt / Suite #" style="width: 25%;" id="apt" name="apt" class="ng-pristine ng-valid form-control">
            </div>
                
            <div class="left_col">
                <input type="text" maxlength="50" placeholder="City" id="city" name="city" class="ng-pristine ng-valid form-control">
            </div>
            <div class="right_col">
                <select style="width: 50%; float: left;" type="text" id="state" class="ng-pristine ng-valid form-control">
                    <option selected="" value="" class="">State</option>
                    <option value="0">AL</option>
                    <option value="1">AK</option>
                    <option value="2">AS</option>
                    <option value="3">AZ</option><option value="4">AR</option><option value="5">CA</option><option value="6">CO</option><option value="7">CT</option><option value="8">DE</option><option value="9">DC</option><option value="10">FM</option><option value="11">FL</option><option value="12">GA</option><option value="13">GU</option><option value="14">HI</option><option value="15">ID</option><option value="16">IL</option><option value="17">IN</option><option value="18">IA</option><option value="19">KS</option><option value="20">KY</option><option value="21">LA</option><option value="22">ME</option><option value="23">MH</option><option value="24">MD</option><option value="25">MA</option><option value="26">MI</option><option value="27">MN</option><option value="28">MS</option><option value="29">MO</option><option value="30">MT</option><option value="31">NE</option><option value="32">NV</option><option value="33">NH</option><option value="34">NJ</option><option value="35">NM</option><option value="36">NY</option><option value="37">NC</option><option value="38">ND</option><option value="39">MP</option><option value="40">OH</option><option value="41">OK</option><option value="42">OR</option><option value="43">PW</option><option value="44">PA</option><option value="45">PR</option><option value="46">RI</option><option value="47">SC</option><option value="48">SD</option><option value="49">TN</option><option value="50">TX</option><option value="51">UT</option><option value="52">VT</option><option value="53">VI</option><option value="54">VA</option><option value="55">WA</option><option value="56">WV</option><option value="57">WI</option>
                    <option value="58">WY</option>
                </select>
                <input type="text" style="width: 35%; padding: 5px; margin: 0px 12px; float: left;" maxlength="50" placeholder="Zip" id="zip" class="ng-pristine ng-valid form-control">
            </div>
            <div class="left_col">
                <input type="text" class="phoneNumberMask ng-pristine ng-valid form-control" placeholder="Phone Number" id="phone" name="phone">
            </div>
            <div class="right_col">
                <input type="text" class="phoneNumberMask ng-pristine ng-valid form-control" placeholder="Alt. Phone Number" id="altphone" name="altphone">
            </div>
        </fieldset>
    </div>
    <div style="text-align: center; margin-top: 20px;">
        <a>&nbsp;&nbsp;</a> &nbsp; <input type="button" value="Continue" class="btn btn-primary">
    </div>
</div>