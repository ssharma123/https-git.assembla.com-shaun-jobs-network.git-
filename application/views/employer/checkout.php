
<div style="padding: 50px; min-height: 400px; background-color: #f7f7f7" class="container ng-scope">
    <div>
        <h3>Enter Billing Information</h3>
        <p>Please enter details of primary billing, managment, or personal user who will be invoiced</p>
        <br>
        
        <div class="row">
            
            
            <?php 
            if($this->input->post('payment_type')) {
                
                if(!$sub_data) { ?>
                    <form class="form-horizontal ng-pristine ng-valid" id="paypal_checkout_form" method="post" action="<?php echo site_url('employer_checkout'); ?>">
                <input type="hidden" name="amount" id="amount" value="10" >
                <input type="hidden" name="step" id="step" value="2" >
                <input type="hidden" name="payment_type" id="payment_type" value="paypal" >
                <?php
                $first_name = "";
                $last_name = "";
                if( isset($employer['name']) ){
                    $name = explode(' ', $employer['name']);
                    $first_name = $name[0];
                    unset($name[0]);
                    
                    $last_name = (count($name)>0) ? implode(" ", $name) : ''; 
                }
                ?>
                <div class="form-group">
                  <label class="col-sm-4 control-label">First Name</label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control ng-pristine ng-valid" placeholder="" required id="first_name" name="first_name" value="<?php echo $first_name; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Last Name</label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control ng-pristine ng-valid" placeholder="" required id="last_name" name="last_name" value="<?php echo $last_name; ?>">
                  </div>
                </div>
                
                
                
                <div class="form-group">
                  <label class="col-sm-4 control-label">Address</label>
                  <div class="col-sm-4">
                      <input type="text" name="address" id="address" required class="form-control ng-pristine ng-valid" placeholder="" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">City</label>
                  <div class="col-sm-4">
                      <input type="text" name="city" id="city" required class="form-control ng-pristine ng-valid" placeholder="" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">State</label>
                  <div class="col-sm-4">
                      <input type="text" name="state" id="state" required class="form-control ng-pristine ng-valid" placeholder="" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Zip Code</label>
                  <div class="col-sm-4">
                      <input type="number" name="zip" id="zip" required  class="form-control ng-pristine ng-valid" placeholder="" >
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-4 control-label">Country</label>
                  <div class="col-sm-4">
                      <select id="country_code" name="country_code" required class="form-control">
<!--                            <option value="AX">ALAND ISLANDS</option>
                            <option value="AL">ALBANIA</option>
                            <option value="DZ">ALGERIA </option>
                            <option value="AS">AMERICAN SAMOA</option>
                            <option value="AD">ANDORRA</option>
                            <option value="AI">ANGUILLA</option>
                            <option value="AQ">ANTARCTICA </option><option value="AG">ANTIGUA AND BARBUDA</option><option value="AR">ARGENTINA</option><option value="AM">ARMENIA</option><option value="AW">ARUBA</option><option value="AU">AUSTRALIA</option><option value="AT">AUSTRIA</option><option value="AZ">AZERBAIJAN</option>
                            <option value="BS">BAHAMAS</option><option value="BH">BAHRAIN</option><option value="BD">BANGLADESH</option><option value="BB">BARBADOS</option><option value="BE">BELGIUM</option><option value="BZ">BELIZE</option><option value="BJ">BENIN</option><option value="BM">BERMUDA</option><option value="BT">BHUTAN</option>
                            <option value="BA">BOSNIA-HERZEGOVINA</option><option value="BW">BOTSWANA</option><option value="BV">BOUVET ISLAND </option><option value="BR">BRAZIL</option><option value="IO">BRITISH INDIAN OCEAN TERRITORY </option><option value="BN">BRUNEI DARUSSALAM</option><option value="BG">BULGARIA</option><option value="BF">BURKINA FASO</option><option value="CA">CANADA</option><option value="CV">CAPE VERDE</option><option value="KY">CAYMAN ISLANDS</option><option value="CF">CENTRAL AFRICAN REPUBLIC </option><option value="CL">CHILE</option><option value="CN">CHINA</option><option value="CX">CHRISTMAS ISLAND </option><option value="CC">COCOS (KEELING) ISLANDS</option><option value="CO">COLOMBIA</option><option value="CK">COOK ISLANDS</option><option value="CR">COSTA RICA</option><option value="CY">CYPRUS</option><option value="CZ">CZECH REPUBLIC</option><option value="DK">DENMARK</option><option value="DJ">DJIBOUTI</option><option value="DM">DOMINICA</option><option value="DO">DOMINICAN REPUBLIC</option><option value="EC">ECUADOR</option><option value="EG">EGYPT</option><option value="SV">EL SALVADOR</option><option value="EE">ESTONIA</option><option value="FK">FALKLAND ISLANDS (MALVINAS)</option><option value="FO">FAROE ISLANDS</option><option value="FJ">FIJI</option><option value="FI">FINLAND</option><option value="FR">FRANCE</option><option value="GF">FRENCH GUIANA</option><option value="PF">FRENCH POLYNESIA</option><option value="TF">FRENCH SOUTHERN TERRITORIES</option><option value="GA">GABON</option><option value="GM">GAMBIA</option><option value="GE">GEORGIA</option><option value="DE">GERMANY</option><option value="GH">GHANA</option><option value="GI">GIBRALTAR</option><option value="GR">GREECE</option><option value="GL">GREENLAND</option><option value="GD">GRENADA</option><option value="GP">GUADELOUPE</option><option value="GU">GUAM</option><option value="CG">GUERNSEY</option><option value="GY">GUYANA</option><option value="HM">HEARD ISLAND AND MCDONALD ISLANDS </option><option value="VA">HOLY SEE (VATICAN CITY STATE)</option><option value="HN">HONDURAS</option><option value="HK">HONG KONG</option><option value="HU">HUNGARY</option><option value="IS">ICELAND</option><option value="IN">INDIA</option><option value="ID">INDONESIA</option><option value="IE">IRELAND</option><option value="IM">ISLE OF MAN</option><option value="IL">ISRAEL</option><option value="IT">ITALY</option><option value="JM">JAMAICA</option><option value="JP">JAPAN</option><option value="JE">JERSEY</option><option value="JO">JORDAN</option><option value="KZ">KAZAKHSTAN</option><option value="KI">KIRIBATI</option><option value="KR">KOREA, REPUBLIC OF</option><option value="KW">KUWAIT</option><option value="KG">KYRGYZSTAN</option><option value="LV">LATVIA</option><option value="LS">LESOTHO</option><option value="LI">LIECHTENSTEIN</option><option value="LT">LITHUANIA</option><option value="LU">LUXEMBOURG</option><option value="MO">MACAO</option><option value="MK">MACEDONIA</option><option value="MG">MADAGASCAR</option><option value="MW">MALAWI</option><option value="MY">MALAYSIA</option><option value="MT">MALTA</option><option value="MH">MARSHALL ISLANDS</option><option value="MQ">MARTINIQUE</option><option value="MR">MAURITANIA</option><option value="MU">MAURITIUS</option><option value="YT">MAYOTTE</option><option value="MX">MEXICO</option><option value="FM">MICRONESIA, FEDERATED STATES OF</option><option value="MD">MOLDOVA, REPUBLIC OF</option><option value="MC">MONACO</option><option value="MN">MONGOLIA</option><option value="ME">MONTENEGRO</option><option value="MS">MONTSERRAT</option><option value="MA">MOROCCO</option><option value="MZ">MOZAMBIQUE</option><option value="NA">NAMIBIA</option><option value="NR">NAURU</option><option value="NP">NEPAL </option><option value="NL">NETHERLANDS</option><option value="AN">NETHERLANDS ANTILLES</option><option value="NC">NEW CALEDONIA</option><option value="NZ">NEW ZEALAND</option><option value="NI">NICARAGUA</option><option value="NE">NIGER</option><option value="NU">NIUE</option><option value="NF">NORFOLK ISLAND</option><option value="MP">NORTHERN MARIANA ISLANDS</option><option value="NO">NORWAY</option><option value="OM">OMAN</option><option value="PW">PALAU</option><option value="PS">PALESTINE</option><option value="PA">PANAMA</option><option value="PY">PARAGUAY</option><option value="PE">PERU</option><option value="PH">PHILIPPINES</option><option value="PN">PITCAIRN</option><option value="PL">POLAND</option><option value="PT">PORTUGAL</option><option value="PR">PUERTO RICO</option><option value="QA">QATAR</option><option value="RE">REUNION</option><option value="RO">ROMANIA</option><option value="RU">RUSSIAN FEDERATION</option><option value="RW">RWANDA</option><option value="SH">SAINT HELENA</option><option value="KN">SAINT KITTS AND NEVIS</option><option value="LC">SAINT LUCIA</option><option value="PM">SAINT PIERRE AND MIQUELON</option><option value="VC">SAINT VINCENT AND THE GRENADINES</option><option value="WS">SAMOA</option><option value="SM">SAN MARINO</option><option value="ST">SAO TOME AND PRINCIPE </option><option value="SA">SAUDI ARABIA</option><option value="SN">SENEGAL</option><option value="RS">SERBIA</option><option value="SC">SEYCHELLES</option><option value="SG">SINGAPORE</option><option value="SK">SLOVAKIA</option><option value="SI">SLOVENIA</option><option value="SB">SOLOMON ISLANDS</option><option value="ZA">SOUTH AFRICA</option><option value="GS">SOUTH GEORGIA</option><option value="ES">SPAIN</option><option value="SR">SURINAME</option><option value="SJ">SVALBARD AND JAN MAYEN</option><option value="SZ">SWAZILAND</option><option value="SE">SWEDEN</option><option value="CH">SWITZERLAND</option><option value="TW">TAIWAN, PROVINCE OF CHINA</option><option value="TZ">TANZANIA, UNITED REPUBLIC OF</option><option value="TH">THAILAND</option><option value="TL">TIMOR-LESTE</option><option value="TG">TOGO</option><option value="TK">TOKELAU</option><option value="TO">TONGA</option><option value="TT">TRINIDAD AND TOBAGO</option><option value="TN">TUNISIA</option><option value="TR">TURKEY</option><option value="TM">TURKMENISTAN</option><option value="TC">TURKS AND CAICOS ISLANDS</option><option value="TV">TUVALU</option><option value="UG">UGANDA</option><option value="UA">UKRAINE</option><option value="AE">UNITED ARAB EMIRATES</option><option value="GB">UNITED KINGDOM</option>-->
                            <option value="US" selected="selected">UNITED STATES</option>
<!--                            <option value="UM">UNITED STATES MINOR OUTLYING ISLANDS</option><option value="UY">URUGUAY</option><option value="UZ">UZBEKISTAN</option><option value="VU">VANUATU</option><option value="VE">VENEZUELA</option><option value="VN">VIET NAM</option><option value="VG">VIRGIN ISLANDS, BRITISH</option><option value="VI">VIRGIN ISLANDS, U.S.</option><option value="WF">WALLIS AND FUTUNA</option><option value="EH">WESTERN SAHARA</option><option value="ZM">ZAMBIA</option><option value="ZM">ZAMBIA</option>-->
                        </select>
                  </div>
                </div>
                
                
                
                
                
                <div class="text-center" style="padding-top: 20px;">
                    <button type="submit" class="btn btn-primary btn-lg">Continue</button>
                    <br>
                </div>
                
            </form>
            <?php } 
                else { ?>
                <div class="error_rsp"> You have already subscribe</div>
                <?php
                }
            } ?>
        </div>
    </div>
</div>
<script>
    $("#zip").keyup(function() {
        var val = $("#zip").val();
        var length = $("#zip").val().length;
        if (length > 5) {
            $("#zip").val(val.substring(0, 5));
        }
    });
    
    $('#address').keydown(function (e) {
        if (e.which == 13 ) {
            return false;
        }
    });
    
    function initialize(){
        var address = /** @type {HTMLInputElement} */(
                document.getElementById('address'));
        var options = {
            componentRestrictions: {country: "us"}
        };
        var my_address = new google.maps.places.Autocomplete(address, options);
        
        google.maps.event.addListener(my_address, 'place_changed', function() {
            var place = my_address.getPlace();
            
            // if no location is found
            if (!place.geometry) {
                return;
            }
            $("#city").val("");
            $("#state").val("");
            $("#txtZip").val("");
            
            var $city = $("#city");
            var $state = $("#state");
            var $zipcode = $("#zip");
            var country_long_name = '';
            var country_short_name = '';
            
            for(var i=0; i<place.address_components.length; i++){
                var address_component = place.address_components[i];
                var ty = address_component.types;

                for (var k = 0; k < ty.length; k++) {
                    if (ty[k] === 'locality') {
                        $city.val(address_component.long_name)
                    } 
//                    if (ty[k] === 'administrative_area_level_2') {
//                        $city.val(address_component.long_name)
//                    } 
                    else if (ty[k] === 'postal_town' || ty[k] === "administrative_area_level_1") {
                        $state.val(address_component.short_name);
                    } else if (ty[k] === 'postal_code') {
                        $zipcode.val(address_component.short_name);
                    } else if(ty[k] === 'country'){
                        country_long_name = address_component.long_name;
                        country_short_name = address_component.short_name;
                    }
                }
            }
            
 
        
         });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>