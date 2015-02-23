<style>
    .ng-hide{
        display: none;
    }
</style>
<div class="row-wrapper">
    <div class="col col-sm-7">
        <!--Contact Section-->
        <div id="contactC">
            <div class="" ng-show="contactSection == 'list'">
                <div style="float: left; width: 85%; padding-left: 10px;">
                    <h1 class="ng-binding" style="text-align: left; font-size: 40px; padding-left: 20px; padding-top: 2px; margin-top: 5px; margin-bottom: 2px;">Numan Hassan</h1>
                    <div class="ng-binding" style="padding-left: 20px; font-size: 16px;">
                        <span class="ng-binding" style="color: #2A802A;">7399 Cross County Rd</span> Lahore, AK
                    </div>
                </div>
                <div style="float: left; width: 15%; text-align: right; padding-right: 15px; padding-top: 15px;"><a ng-click="editContactInfo()"><i class="fa fa-pencil">&nbsp;</i>Edit</a></div>
                <div class="clearfix"></div>	
            </div>
            <div class="ng-hide" ng-show="contactSection == 'edit'">
                <div style="float: left; width: 85%; padding-left: 10px;">
                    <fieldset style="float: none; margin: 0 auto; padding: 15px 0 0 25px;">
                        <div class="filter">
                            <input class="ng-pristine ng-valid" id="firstName" ng-model="advName.firstName" placeholder="First Name" type="text">
                            <input class="ng-pristine ng-valid" id="lastName" ng-model="advName.lastName" placeholder="Last Name" type="text">
                        </div>
                        <div class="filter">
                            <input class="ng-pristine ng-valid" id="address" ng-model="advContact.streetAddress" placeholder="Address" maxlength="50" type="text">
                            <input class="ng-pristine ng-valid" ng-model="advContact.aptNumber" style="width: 25%;" placeholder="Apt / Suite #" type="text">
                        </div>
                        <div class="filter">
                            <input class="ng-pristine ng-valid" id="city" placeholder="City" maxlength="50" ng-model="advContact.city" type="text">
                            <select class="ng-pristine ng-valid" id="state" type="text" style="width: 15%;" ng-model="advContact.state" ng-options="option for option in states"><option class="" value="" selected="">State</option><option value="0">AL</option><option value="1">AK</option><option value="2">AS</option><option value="3">AZ</option><option value="4">AR</option><option value="5">CA</option><option value="6">CO</option><option value="7">CT</option><option value="8">DE</option><option value="9">DC</option><option value="10">FM</option><option value="11">FL</option><option value="12">GA</option><option value="13">GU</option><option value="14">HI</option><option value="15">ID</option><option value="16">IL</option><option value="17">IN</option><option value="18">IA</option><option value="19">KS</option><option value="20">KY</option><option value="21">LA</option><option value="22">ME</option><option value="23">MH</option><option value="24">MD</option><option value="25">MA</option><option value="26">MI</option><option value="27">MN</option><option value="28">MS</option><option value="29">MO</option><option value="30">MT</option><option value="31">NE</option><option value="32">NV</option><option value="33">NH</option><option value="34">NJ</option><option value="35">NM</option><option value="36">NY</option><option value="37">NC</option><option value="38">ND</option><option value="39">MP</option><option value="40">OH</option><option value="41">OK</option><option value="42">OR</option><option value="43">PW</option><option value="44">PA</option><option value="45">PR</option><option value="46">RI</option><option value="47">SC</option><option value="48">SD</option><option value="49">TN</option><option value="50">TX</option><option value="51">UT</option><option value="52">VT</option><option value="53">VI</option><option value="54">VA</option><option value="55">WA</option><option value="56">WV</option><option value="57">WI</option><option value="58">WY</option></select>
                            <input class="ng-pristine ng-valid" id="zip" ng-model="advContact.zipCode" placeholder="Zip" maxlength="50" style="width: 15%; padding: 5px; margin: 0px 12px;" type="text">
                        </div>
                        <div class="filter">
                            <input id="phone" placeholder="Phone Number" class="phoneNumberMask ng-pristine ng-valid" ng-model="advContact.phoneNumber" type="text">
                            <input id="altphone" placeholder="Alt. Phone Number" class="phoneNumberMask ng-pristine ng-valid" ng-model="advContact.altPhoneNumber" type="text">
                        </div>
                        <div class="filter" style="margin-top: 5px;">
                            <a ng-click="updateContactInfo()" class="btn btn-sm btn-green">Update</a>
                        </div>

                    </fieldset>
                </div>
                <div style="float: left; width: 15%; text-align: right; padding-right: 15px; padding-top: 15px;"><a ng-click="cancelContactInfo()">Cancel</a></div>
                <div class="clearfix"></div>	
            </div>
        </div>
        <!--Profession Section-->
        <div id="professionC">
            <div class="" ng-show="professionSection == 'list'">
                <div style="float: left; width: 85%; padding-left: 10px; font-size: 15px;">
                    <h3 class="ng-binding" style="text-align: left; padding-left: 20px;">Profession (#123123)</h3>
                    <div style="padding-left: 25px;">
                        <ul>
                            <li class="ng-binding">
                                Profession: Physician
                            </li>
                            <li class="ng-binding">
                                Specialty: Anesthesiology
                            </li>
                            <li class="ng-binding">
                                Sub Specialty: Critical Care Medicine
                            </li>
                            <li class="ng-binding">
                                Experience Level: Medical School
                            </li>
                        </ul>
                    </div>
                </div>
                <div style="float: left; width: 15%; text-align: right; padding-right: 15px; padding-top: 15px;"><a ng-click="editProfessionInfo()"><i class="fa fa-pencil">&nbsp;</i>Edit</a></div>
                <div class="clearfix"></div>
            </div>
            <div class="ng-hide" ng-show="professionSection == 'edit'">
                <div style="float: left; width: 85%; padding-left: 10px;">
                    <h3 style="text-align: left; padding-left: 20px;">Profession</h3>
                    <fieldset style="float: none; margin: 0 auto; padding: 15px 0 0 25px;">
                        <div class="filter">
                            <select class="ng-pristine ng-valid" disabled="" ng-model="advProfession.profession" ng-options="option for option in professions"><option selected="selected" value="0">Physician</option></select>
                            <select class="ng-pristine ng-valid" id="experinceLevel" ng-model="advProfession.experienceLevel" ng-options="option for option in experienceLevels"><option class="" value="">Experience Level</option><option value="0">Medical School</option><option value="1">Residency</option><option value="2">Fellowship</option><option value="3">Practicing</option></select>
                        </div>
                        <div class="filter">
                            <select class="ng-pristine ng-valid" id="specialty" ng-model="advProfession.specialty" ng-options="option.get('name') as option.get('name') for option in specialties" ng-change="advProfession.subSpecialty = null"><option class="" value="">Specialty</option><option value="0">Allergy and Immunology</option><option value="1">Anesthesiology</option><option value="2">Colon and Rectal Surgery</option><option value="3">Dermatology</option><option value="4">Emergency Medicine</option><option value="5">Family Medicine</option><option value="6">Internal Medicine</option><option value="7">Medical Genetics</option><option value="8">Neurological Surgery</option><option value="9">Neurology</option><option value="10">Nuclear Medicine</option><option value="11">Obstetrics and Gynecology</option><option value="12">Opthalmology</option><option value="13">Orthopaedic Surgery</option><option value="14">Otolaryngology</option><option value="15">Pathology</option><option value="16">Pediatrics</option><option value="17">Physical Medicine and Rehabilitation</option><option value="18">Plastic Surgery</option><option value="19">Preventive Medicine</option><option value="20">Psychiatry</option><option value="21">Radiology</option><option value="22">Surgery - General</option><option value="23">Thoracic and Cardiac Surgery</option><option value="24">Urology</option></select>
                            <select class="ng-pristine ng-valid" id="subSpecialty" ng-model="advProfession.subSpecialty" ng-options="option for option in getSubspecialties(advProfession.specialty)"><option class="" value="">Sub Specialty</option><option value="0">General</option><option selected="selected" value="1">Critical Care Medicine</option><option value="2">Hospice and Palliative Medicine</option><option value="3">Pain Medicine</option><option value="4">Pediatric Anesthesiology</option><option value="5">Sleep Medicine</option></select>
                        </div>
                        <div class="filter">												
                            <select class="ng-pristine ng-valid" id="boardStatus" ng-model="advProfession.boardStatus" ng-options="option for option in boardStatusTypes"><option class="" value="">Board Status</option><option value="0">Eligible</option><option value="1">Active</option></select>
                            <select class="ng-pristine ng-valid" id="degree" ng-model="advProfession.degree" ng-options="option for option in degrees"><option class="" value="">Degree</option><option value="0">D.O.</option><option value="1">M.D.</option></select>
                        </div>
                        <div class="filter">												
                            <select class="ng-pristine ng-valid" id="residentStatus" ng-model="advProfession.residentStatus" ng-options="option for option in citizenships"><option class="" value="">Resident Status</option><option value="0">US Citizen</option><option value="1">Permanent Resident</option><option value="2">H1 Visa</option><option value="3">J1 Visa</option></select>
                            <input class="ng-pristine ng-valid" id="npiNumber" ng-model="advProfession.npiNumber" placeholder="NPI #" type="text">
                        </div>
                        <div class="filter" style="margin-top: 5px;">
                            <a ng-click="updateProfessionInfo()" class="btn btn-sm btn-green">Update</a>
                        </div>

                    </fieldset>
                </div>
                <div style="float: left; width: 15%; text-align: right; padding-right: 15px; padding-top: 15px;"><a ng-click="cancelProfessionInfo()">Cancel</a></div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!--Education Section-->
        <div id="educationC">
            <div class="" ng-show="educationSection == 'list'">
                <div style="float: left; width: 85%; padding-left: 10px; font-size: 15px;">
                    <h3 style="text-align: left; padding-left: 20px;">Education</h3>
                    <div style="padding-left: 25px;">
                        <!-- ngRepeat: residency in fellowships --><div class="ng-scope" ng-repeat="residency in fellowships">
                            <!-- Summary of each school with option to remove. -->
                            <div class="well well-sm well-yellow">
                                <div class="col-sm-5 text-left">
                                    <p style="margin-bottom: 0px"><strong class="ng-binding">asdasd</strong></p>
                                    <p class="ng-binding">123123, AK, 121</p>
                                </div>
                                <div class="col-sm-5 text-left">
                                    <p class="ng-binding" style="margin-bottom: 0px">Critical Care Medicine</p>
                                    <p class="ng-binding">12/31/2313 - 12/31/2312</p>
                                </div>
                                <div class="col-sm-2">
                                    &nbsp;
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div><!-- end ngRepeat: residency in fellowships -->
                        <!-- ngRepeat: residency in residencies --><div class="ng-scope" ng-repeat="residency in residencies">

                            <!-- Summary of each school with option to remove. -->
                            <div class="well well-sm well-blue">
                                <div class="col-sm-5 text-left">
                                    <p style="margin-bottom: 0px"><strong class="ng-binding">asdasd</strong></p>
                                    <p class="ng-binding">zxczc, AK, pk</p>
                                </div>
                                <div class="col-sm-5 text-left">
                                    <p class="ng-binding" style="margin-bottom: 0px">Hospice and Palliative Medicine</p>
                                    <p class="ng-binding">12/31/2312 - 12/31/2313</p>
                                </div>
                                <div class="col-sm-2">
                                    &nbsp;
                                </div>
                                <div class="clearfix"></div>
                            </div>

                        </div><!-- end ngRepeat: residency in residencies -->
                        <!-- ngRepeat: school in schools --><div class="ng-scope" ng-repeat="school in schools">
                            <!-- Summary of each school with option to remove. -->
                            <div class="well well-sm well-purple">
                                <div class="col-sm-5 text-left">
                                    <p style="margin-bottom: 0px"><strong class="ng-binding">asdads (Med School)</strong></p>
                                    <p class="ng-binding">3, AS, 123</p>
                                </div>
                                <div class="col-sm-5 text-left">
                                    <p class="ng-binding" style="margin-bottom: 0px">1231231</p>
                                    <p class="ng-binding">Year Graduated: 3121</p>
                                </div>
                                <div class="col-sm-2">
                                    &nbsp;
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div><!-- end ngRepeat: school in schools -->
                    </div>
                </div>
                <div style="float: left; width: 15%; text-align: right; padding-right: 15px; padding-top: 15px;"><a ng-click="editEducationInfo()"><i class="fa fa-pencil">&nbsp;</i>Edit</a></div>
                <div class="clearfix"></div>
            </div>
            <div class="ng-hide" ng-show="educationSection == 'edit'" style="position: relative;">											
                <div id="educationW" style="position: absolute; top: 10; width: 100%; height: 100%; background: #ccc; opacity: 0.3; z-index: 9999; display: none;">&nbsp;</div>
                <div style="float: left; width: 85%; padding-left: 10px; font-size: 15px;">
                    <h3 style="text-align: left; padding-left: 20px;">Education</h3>
                    <div class="alert alert-danger" id="educationE" style="display: none;">You have to add at least one School and Residency.</div>
                    <fieldset style="float: none; margin: 0 auto; padding: 0 0 0 25px;">
                        <div class="filter">
                            <!-- ngRepeat: residency in fellowships --><div class="ng-scope" ng-repeat="residency in fellowships">
                                <!-- Summary of each school with option to remove. -->
                                <div class="well well-sm well-yellow">
                                    <div class="col-sm-5 text-left">
                                        <p style="margin-bottom: 0px"><strong class="ng-binding">asdasd</strong></p>
                                        <p class="ng-binding">123123, AK, 121</p>
                                    </div>
                                    <div class="col-sm-5 text-left">
                                        <p class="ng-binding" style="margin-bottom: 0px">Critical Care Medicine</p>
                                        <p class="ng-binding">12/31/2313 - 12/31/2312</p>
                                    </div>
                                    <div class="col-sm-2">
                                        <a class="btn btn-danger btn-xs" ng-click="fellowships.splice($index, 1)">Remove</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div><!-- end ngRepeat: residency in fellowships -->
                            <!-- ngRepeat: residency in residencies --><div class="ng-scope" ng-repeat="residency in residencies">

                                <!-- Summary of each school with option to remove. -->
                                <div class="well well-sm well-blue">
                                    <div class="col-sm-5 text-left">
                                        <p style="margin-bottom: 0px"><strong class="ng-binding">asdasd</strong></p>
                                        <p class="ng-binding">zxczc, AK, pk</p>
                                    </div>
                                    <div class="col-sm-5 text-left">
                                        <p class="ng-binding" style="margin-bottom: 0px">Hospice and Palliative Medicine</p>
                                        <p class="ng-binding">12/31/2312 - 12/31/2313</p>
                                    </div>
                                    <div class="col-sm-2">
                                        <a class="btn btn-danger btn-xs" ng-click="residencies.splice($index, 1)">Remove</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                            </div><!-- end ngRepeat: residency in residencies -->
                            <!-- ngRepeat: school in schools --><div class="ng-scope" ng-repeat="school in schools">
                                <!-- Summary of each school with option to remove. -->
                                <div class="well well-sm well-purple">
                                    <div class="col-sm-5 text-left">
                                        <p style="margin-bottom: 0px"><strong class="ng-binding">asdads (Med School)</strong></p>
                                        <p class="ng-binding">3, AS, 123</p>
                                    </div>
                                    <div class="col-sm-5 text-left">
                                        <p class="ng-binding" style="margin-bottom: 0px">1231231</p>
                                        <p class="ng-binding">Year Graduated: 3121</p>
                                    </div>
                                    <div class="col-sm-2">
                                        <a class="btn btn-danger btn-xs" ng-click="schools.splice($index, 1)">Remove</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div><!-- end ngRepeat: school in schools -->
                        </div>
                        <div style="text-align: center;" class="filter" ng-show="stage4SubState == 'normal'">
                            <a class="btn btn-light-blue btn-sm" ng-click="stage4SubState = 'addEducation'"><i class="fa fa-check-circle">&nbsp;</i> Add Degree</a>
                            <a class="btn btn-light-red btn-sm" ng-click="stage4SubState = 'addResidency'"><i class="fa fa-check-circle">&nbsp;</i> Add Residency</a>
                            <a class="btn btn-light-yellow btn-sm" ng-click="stage4SubState = 'addFellowship'"><i class="fa fa-check-circle">&nbsp;</i> Add Fellowship</a>
                        </div>
                        <div class="ng-hide" ng-show="stage4SubState == 'addEducation'">
                            <div class="filter">
                                <input class="ng-pristine ng-valid" id="schoolName" ng-model="newSchool.name" placeholder="School" type="text">
                                <input class="ng-pristine ng-valid" id="schoolDegree" ng-model="newSchool.degree" placeholder="Degree" type="text">
                            </div>
                            <div class="filter">
                                <input class="ng-pristine ng-valid" id="schoolCity" ng-model="newSchool.city" placeholder="City" type="text">
                                <select class="ng-pristine ng-valid" id="schoolState" ng-model="newSchool.state" style="width: 15%;" ng-options="option for option in states"><option class="" value="">State</option><option value="0">AL</option><option value="1">AK</option><option value="2">AS</option><option value="3">AZ</option><option value="4">AR</option><option value="5">CA</option><option value="6">CO</option><option value="7">CT</option><option value="8">DE</option><option value="9">DC</option><option value="10">FM</option><option value="11">FL</option><option value="12">GA</option><option value="13">GU</option><option value="14">HI</option><option value="15">ID</option><option value="16">IL</option><option value="17">IN</option><option value="18">IA</option><option value="19">KS</option><option value="20">KY</option><option value="21">LA</option><option value="22">ME</option><option value="23">MH</option><option value="24">MD</option><option value="25">MA</option><option value="26">MI</option><option value="27">MN</option><option value="28">MS</option><option value="29">MO</option><option value="30">MT</option><option value="31">NE</option><option value="32">NV</option><option value="33">NH</option><option value="34">NJ</option><option value="35">NM</option><option value="36">NY</option><option value="37">NC</option><option value="38">ND</option><option value="39">MP</option><option value="40">OH</option><option value="41">OK</option><option value="42">OR</option><option value="43">PW</option><option value="44">PA</option><option value="45">PR</option><option value="46">RI</option><option value="47">SC</option><option value="48">SD</option><option value="49">TN</option><option value="50">TX</option><option value="51">UT</option><option value="52">VT</option><option value="53">VI</option><option value="54">VA</option><option value="55">WA</option><option value="56">WV</option><option value="57">WI</option><option value="58">WY</option></select>
                                <input class="ng-pristine ng-valid" id="schoolCountry" ng-model="newSchool.country" placeholder="Country" style="width: 25%" type="text">
                            </div>
                            <div class="filter">
                                <input id="schoolYear" class="yearMask ng-pristine ng-valid" ng-model="newSchool.gradYear" placeholder="Year" type="text">
                                <span style="margin: 5px; padding: 7px;">Med School &nbsp;<input class="ng-pristine ng-valid" ng-model="newSchool.isMedSchool" type="checkbox"></span>
                            </div>
                            <div class="text-left" style="padding: 10px;">
                                <a class="btn btn-primary btn-sm" ng-click="addEducation()">Add</a>
                                <a class="btn btn-primary btn-sm" ng-click="stage4SubState = 'normal';
                                                                                                                            resetError();">Cancel</a>
                            </div>
                        </div>
                        <div class="ng-hide" ng-show="stage4SubState == 'addResidency'">
                            <div class="filter">
                                <input class="ng-pristine ng-valid" id="rInstitution" ng-model="newResidency.name" placeholder="Institution" type="text">
                            </div>
                            <div class="filter">
                                <input id="rFrom" ng-model="newResidency.fromDate" class="dateMask ng-pristine ng-valid" placeholder="From" type="text">
                                <input id="rTo" ng-model="newResidency.toDate" class="dateMask ng-pristine ng-valid" placeholder="To" type="text">
                            </div>
                            <div class="filter">
                                <input class="ng-pristine ng-valid" id="rCity" ng-model="newResidency.city" placeholder="City" type="text">
                                <select class="ng-pristine ng-valid" id="rState" ng-model="newResidency.state" style="width: 15%;" ng-options="option for option in states"><option class="" value="">State</option><option value="0">AL</option><option value="1">AK</option><option value="2">AS</option><option value="3">AZ</option><option value="4">AR</option><option value="5">CA</option><option value="6">CO</option><option value="7">CT</option><option value="8">DE</option><option value="9">DC</option><option value="10">FM</option><option value="11">FL</option><option value="12">GA</option><option value="13">GU</option><option value="14">HI</option><option value="15">ID</option><option value="16">IL</option><option value="17">IN</option><option value="18">IA</option><option value="19">KS</option><option value="20">KY</option><option value="21">LA</option><option value="22">ME</option><option value="23">MH</option><option value="24">MD</option><option value="25">MA</option><option value="26">MI</option><option value="27">MN</option><option value="28">MS</option><option value="29">MO</option><option value="30">MT</option><option value="31">NE</option><option value="32">NV</option><option value="33">NH</option><option value="34">NJ</option><option value="35">NM</option><option value="36">NY</option><option value="37">NC</option><option value="38">ND</option><option value="39">MP</option><option value="40">OH</option><option value="41">OK</option><option value="42">OR</option><option value="43">PW</option><option value="44">PA</option><option value="45">PR</option><option value="46">RI</option><option value="47">SC</option><option value="48">SD</option><option value="49">TN</option><option value="50">TX</option><option value="51">UT</option><option value="52">VT</option><option value="53">VI</option><option value="54">VA</option><option value="55">WA</option><option value="56">WV</option><option value="57">WI</option><option value="58">WY</option></select>
                                <input class="ng-pristine ng-valid" id="rCountry" ng-model="newResidency.country" placeholder="Country" style="width: 25%" type="text">
                            </div>
                            <div class="filter">
                                <select class="ng-pristine ng-valid" id="rField" ng-model="newResidency.field" ng-options="option as option.get('name') for option in specialties"><option class="" value="">Field</option><option value="0">Allergy and Immunology</option><option value="1">Anesthesiology</option><option value="2">Colon and Rectal Surgery</option><option value="3">Dermatology</option><option value="4">Emergency Medicine</option><option value="5">Family Medicine</option><option value="6">Internal Medicine</option><option value="7">Medical Genetics</option><option value="8">Neurological Surgery</option><option value="9">Neurology</option><option value="10">Nuclear Medicine</option><option value="11">Obstetrics and Gynecology</option><option value="12">Opthalmology</option><option value="13">Orthopaedic Surgery</option><option value="14">Otolaryngology</option><option value="15">Pathology</option><option value="16">Pediatrics</option><option value="17">Physical Medicine and Rehabilitation</option><option value="18">Plastic Surgery</option><option value="19">Preventive Medicine</option><option value="20">Psychiatry</option><option value="21">Radiology</option><option value="22">Surgery - General</option><option value="23">Thoracic and Cardiac Surgery</option><option value="24">Urology</option></select>
                                <select class="ng-pristine ng-valid" id="rConcentration" ng-model="newResidency.concentration" ng-options="option for option in newResidency.field.get('subspecialties')"><option class="" value="">Concentration</option></select>
                            </div>
                            <div class="text-left" style="padding: 10px;">
                                <a class="btn btn-primary btn-sm" ng-click="addResidency()">Add</a>
                                <a class="btn btn-primary btn-sm" ng-click="stage4SubState = 'normal';
                                                                                                                            resetError();">Cancel</a>
                            </div>
                        </div>
                        <div class="ng-hide" ng-show="stage4SubState == 'addFellowship'">

                            <div class="filter">
                                <input class="ng-pristine ng-valid" id="fInstitution" ng-model="newFellowship.name" placeholder="Institution" type="text">
                            </div>
                            <div class="filter">
                                <input id="fFrom" ng-model="newFellowship.fromDate" class="dateMask ng-pristine ng-valid" placeholder="From" type="text">
                                <input id="fTo" ng-model="newFellowship.toDate" class="dateMask ng-pristine ng-valid" placeholder="To" type="text">
                            </div>
                            <div class="filter">
                                <input class="ng-pristine ng-valid" id="fCity" ng-model="newFellowship.city" placeholder="City" type="text">
                                <select class="ng-pristine ng-valid" id="fState" ng-model="newFellowship.state" style="width: 15%;" ng-options="option for option in states"><option class="" value="">State</option><option value="0">AL</option><option value="1">AK</option><option value="2">AS</option><option value="3">AZ</option><option value="4">AR</option><option value="5">CA</option><option value="6">CO</option><option value="7">CT</option><option value="8">DE</option><option value="9">DC</option><option value="10">FM</option><option value="11">FL</option><option value="12">GA</option><option value="13">GU</option><option value="14">HI</option><option value="15">ID</option><option value="16">IL</option><option value="17">IN</option><option value="18">IA</option><option value="19">KS</option><option value="20">KY</option><option value="21">LA</option><option value="22">ME</option><option value="23">MH</option><option value="24">MD</option><option value="25">MA</option><option value="26">MI</option><option value="27">MN</option><option value="28">MS</option><option value="29">MO</option><option value="30">MT</option><option value="31">NE</option><option value="32">NV</option><option value="33">NH</option><option value="34">NJ</option><option value="35">NM</option><option value="36">NY</option><option value="37">NC</option><option value="38">ND</option><option value="39">MP</option><option value="40">OH</option><option value="41">OK</option><option value="42">OR</option><option value="43">PW</option><option value="44">PA</option><option value="45">PR</option><option value="46">RI</option><option value="47">SC</option><option value="48">SD</option><option value="49">TN</option><option value="50">TX</option><option value="51">UT</option><option value="52">VT</option><option value="53">VI</option><option value="54">VA</option><option value="55">WA</option><option value="56">WV</option><option value="57">WI</option><option value="58">WY</option></select>
                                <input class="ng-pristine ng-valid" id="fCountry" ng-model="newFellowship.country" placeholder="Country" style="width: 25%" type="text">
                            </div>
                            <div class="filter">
                                <select class="ng-pristine ng-valid" id="fField" ng-model="newFellowship.field" ng-options="option as option.get('name') for option in specialties"><option class="" value="">Field</option><option value="0">Allergy and Immunology</option><option value="1">Anesthesiology</option><option value="2">Colon and Rectal Surgery</option><option value="3">Dermatology</option><option value="4">Emergency Medicine</option><option value="5">Family Medicine</option><option value="6">Internal Medicine</option><option value="7">Medical Genetics</option><option value="8">Neurological Surgery</option><option value="9">Neurology</option><option value="10">Nuclear Medicine</option><option value="11">Obstetrics and Gynecology</option><option value="12">Opthalmology</option><option value="13">Orthopaedic Surgery</option><option value="14">Otolaryngology</option><option value="15">Pathology</option><option value="16">Pediatrics</option><option value="17">Physical Medicine and Rehabilitation</option><option value="18">Plastic Surgery</option><option value="19">Preventive Medicine</option><option value="20">Psychiatry</option><option value="21">Radiology</option><option value="22">Surgery - General</option><option value="23">Thoracic and Cardiac Surgery</option><option value="24">Urology</option></select>
                                <select class="ng-pristine ng-valid" id="fConcentration" ng-model="newFellowship.concentration" ng-options="option for option in newFellowship.field.get('subspecialties')"><option class="" value="">Concentration</option></select>
                            </div>
                            <div class="text-left" style="padding: 10px;">
                                <a class="btn btn-primary btn-sm" ng-click="addFellowship()">Add</a>
                                <a class="btn btn-primary btn-sm" ng-click="stage4SubState = 'normal';
                                                                                                                            resetError();">Cancel</a>
                            </div>

                        </div>
                    </fieldset>
                </div>
                <div style="float: left; width: 15%; text-align: right; padding-right: 15px; padding-top: 15px;"><a ng-click="cancelEducationInfo()">Cancel</a></div>
                <div class="clearfix"></div>
            </div>

        </div>
        <!--License & Certification Section-->
        <div id="licenseC">
            <div class="" ng-show="licenseSection == 'list'">
                <div style="float: left; width: 85%; padding-left: 10px; font-size: 15px;">
                    <h3 style="text-align: left; padding-left: 20px;">Licenses &amp; Certifications</h3>
                    <div style="padding-left: 25px;">
                        <!-- ngRepeat: license in licenses --><div class="ng-scope" ng-repeat="license in licenses">
                            <div class="well well-sm well-purple">
                                <div class="col-sm-5 text-left">
                                    <p style="margin-bottom: 0px"><strong class="ng-binding">asd</strong></p>
                                    <p class="ng-binding">asd</p>
                                </div>
                                <div class="col-sm-5 text-left">
                                    <p class="ng-binding" style="margin-bottom: 0px">Federal</p>
                                    <p class="ng-binding">Issued: 12/31/2313</p>
                                </div>
                                <div class="col-sm-2">
                                    &nbsp;
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div><!-- end ngRepeat: license in licenses -->
                        <!-- ngRepeat: certificate in certifications --><div class="ng-scope" ng-repeat="certificate in certifications">
                            <div class="well well-sm well-blue">
                                <div class="col-sm-5 text-left">
                                    <p><strong class="ng-binding">asdasd</strong></p>
                                </div>
                                <div class="col-sm-5 text-left ng-binding">
                                    Issued: 12/31/2132
                                </div>
                                <div class="col-sm-2">
                                    &nbsp;
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div><!-- end ngRepeat: certificate in certifications -->
                    </div>
                </div>
                <div style="float: left; width: 15%; text-align: right; padding-right: 15px; padding-top: 15px;"><a ng-click="editLicenseInfo()"><i class="fa fa-pencil">&nbsp;</i>Edit</a></div>
                <div class="clearfix"></div>

            </div>
            <div class="ng-hide" ng-show="licenseSection == 'edit'" style="position: relative;">
                <div id="licenseW" style="position: absolute; top: 10; width: 100%; height: 100%; background: #ccc; opacity: 0.3; z-index: 9999; display: none;">&nbsp;</div>
                <div style="float: left; width: 85%; padding-left: 10px; font-size: 15px;">
                    <h3 style="text-align: left; padding-left: 20px;">Licenses &amp; Certifications</h3>
                    <div class="alert alert-danger" id="licenseE" style="display: none;">You have to add at least one License and Certificate.</div>
                    <fieldset style="float: none; margin: 0 auto; padding: 0 0 0 25px;">
                        <div class="filter">
                            <!-- ngRepeat: license in licenses --><div class="ng-scope" ng-repeat="license in licenses">
                                <div class="well well-sm well-purple">
                                    <div class="col-sm-5 text-left">
                                        <p style="margin-bottom: 0px"><strong class="ng-binding">asd</strong></p>
                                        <p class="ng-binding">asd</p>
                                    </div>
                                    <div class="col-sm-5 text-left">
                                        <p class="ng-binding" style="margin-bottom: 0px">Federal</p>
                                        <p class="ng-binding">Issued: 12/31/2313</p>
                                    </div>
                                    <div class="col-sm-2">
                                        <a class="btn btn-danger btn-xs" ng-click="licenses.splice($index, 1)">Remove</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div><!-- end ngRepeat: license in licenses -->
                            <!-- ngRepeat: certificate in certifications --><div class="ng-scope" ng-repeat="certificate in certifications">
                                <div class="well well-sm well-blue">
                                    <div class="col-sm-5 text-left">
                                        <p><strong class="ng-binding">asdasd</strong></p>
                                    </div>
                                    <div class="col-sm-5 text-left ng-binding">
                                        Issued: 12/31/2132
                                    </div>
                                    <div class="col-sm-2">
                                        <a class="btn btn-danger btn-xs" ng-click="certifications.splice($index, 1)">Remove</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div><!-- end ngRepeat: certificate in certifications -->
                            <div class="text-center" ng-show="stage3SubState != 'addLicense' & amp; & amp;
                                                                                                                        stage3SubState != 'addCert'">
                                <a id="licenceImg" class="btn btn-light-red" ng-click="stage3SubState = 'addLicense'"><i class="fa fa-check-circle">&nbsp;</i> Add License</a>
                                <a id="certImg" class="btn btn-light-blue" ng-click="stage3SubState = 'addCert'"><i class="fa fa-check-circle">&nbsp;</i> Add Certification</a>
                            </div>

                        </div>
                        <div class="ng-hide" ng-show="stage3SubState == 'addLicense'">
                            <div class="filter">												
                                <input class="ng-pristine ng-valid" id="licenseType" placeholder="License Type" ng-model="newLicenseType" ng-options="option for option in specialty.get('subspecialties')" type="text">
                                <input class="ng-pristine ng-valid" id="licenseNumber" placeholder="License Number" ng-model="newLicenseNumber" ng-options="option for option in boardStatusTypes" type="text">
                            </div>	
                            <div class="filter">
                                <input id="licenseIssued" ng-model="newLicenseIssued" class="dateMask ng-pristine ng-valid" placeholder="Issued On" type="text">
                                <select class="ng-pristine ng-valid" id="licenseState" ng-model="newLicenseState" style="width: 15%;" ng-options="option for option in states"><option class="" value="">State</option><option value="0">AL</option><option value="1">AK</option><option value="2">AS</option><option value="3">AZ</option><option value="4">AR</option><option value="5">CA</option><option value="6">CO</option><option value="7">CT</option><option value="8">DE</option><option value="9">DC</option><option value="10">FM</option><option value="11">FL</option><option value="12">GA</option><option value="13">GU</option><option value="14">HI</option><option value="15">ID</option><option value="16">IL</option><option value="17">IN</option><option value="18">IA</option><option value="19">KS</option><option value="20">KY</option><option value="21">LA</option><option value="22">ME</option><option value="23">MH</option><option value="24">MD</option><option value="25">MA</option><option value="26">MI</option><option value="27">MN</option><option value="28">MS</option><option value="29">MO</option><option value="30">MT</option><option value="31">NE</option><option value="32">NV</option><option value="33">NH</option><option value="34">NJ</option><option value="35">NM</option><option value="36">NY</option><option value="37">NC</option><option value="38">ND</option><option value="39">MP</option><option value="40">OH</option><option value="41">OK</option><option value="42">OR</option><option value="43">PW</option><option value="44">PA</option><option value="45">PR</option><option value="46">RI</option><option value="47">SC</option><option value="48">SD</option><option value="49">TN</option><option value="50">TX</option><option value="51">UT</option><option value="52">VT</option><option value="53">VI</option><option value="54">VA</option><option value="55">WA</option><option value="56">WV</option><option value="57">WI</option><option value="58">WY</option></select>
                            </div>
                            <div class="filter" style="padding-left: 15px;">
                                Federal&nbsp;&nbsp;&nbsp;&nbsp;Yes&nbsp;&nbsp;<input class="federal" name="federal" value="1" type="radio">&nbsp;&nbsp;No&nbsp;&nbsp;<input value="0" name="federal" class="federal" type="radio">
                            </div>
                            <div class="filter" style="margin-top: 15px; padding-left: 15px;">
                                <a class="btn btn-primary btn-sm" ng-click="addLicense()">Add</a>
                                <a class="btn btn-primary btn-sm" ng-click="stage3SubState = 'normal';
                                                                                                                            resetError();">Cancel</a>
                                <br><br>
                            </div>

                        </div>
                        <div class="ng-hide" ng-show="stage3SubState == 'addCert'">
                            <div class="filter">
                                <input class="ng-pristine ng-valid" id="certName" ng-model="newCertName" placeholder="Certificate Name" type="text">
                                <input id="certIssued" ng-model="newCertDate" class="dateMask ng-pristine ng-valid" placeholder="Issued On" type="text">
                            </div>
                            <div class="filter" style="margin-top: 15px; padding-left: 15px;">
                                <a class="btn btn-primary btn-sm" ng-click="addCert()">Add</a>
                                <a class="btn btn-primary btn-sm" ng-click="stage3SubState = 'normal';
                                                                                                                            resetError();">Cancel</a>
                                <br><br>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div style="float: left; width: 15%; text-align: right; padding-right: 15px; padding-top: 15px;"><a ng-click="cancelLicenseInfo()">Cancel</a></div>
                <div class="clearfix"></div>

            </div>

        </div>
        <!--Practice Section-->
        <div id="practiceC">
            <div class="" ng-show="practiceSection == 'list'">
                <div style="float: left; width: 85%; padding-left: 10px; font-size: 15px;">
                    <h3 style="text-align: left; padding-left: 20px;">Practices</h3>
                    <div style="padding-left: 25px;">
                        <!-- ngRepeat: practice in practices --><div class="ng-scope" ng-repeat="practice in practices">

                            <div class="well well-sm well-blue">
                                <div class="col-sm-5 text-left">
                                    <p style="margin-bottom: 0px"><strong class="ng-binding">zasdasd</strong></p>
                                    <p class="ng-binding">adsd asdasd</p>
                                </div>
                                <div class="col-sm-5 text-left">
                                    <p class="ng-binding" style="margin-bottom: 0px">12/31/2313 - 12/31/2312</p>
                                    <p class="ng-binding">zxc, AL, US</p>
                                </div>
                                <div class="col-sm-2">
                                    &nbsp;
                                </div>
                                <div class="clearfix"></div>
                            </div>

                        </div><!-- end ngRepeat: practice in practices -->
                    </div>
                </div>
                <div style="float: left; width: 15%; text-align: right; padding-right: 15px; padding-top: 15px;"><a ng-click="editPracticeInfo()"><i class="fa fa-pencil">&nbsp;</i>Edit</a></div>
                <div class="clearfix"></div>	
            </div>
            <div class="ng-hide" ng-show="practiceSection == 'edit'">
                <div style="float: left; width: 85%; padding-left: 10px; font-size: 15px;">
                    <h3 style="text-align: left; padding-left: 20px;">Practices</h3>
                    <fieldset style="float: none; margin: 0 auto; padding: 15px 0 0 25px;">
                        <div class="filter">
                            <!-- ngRepeat: practice in practices --><div class="ng-scope" ng-repeat="practice in practices">

                                <div class="well well-sm well-blue">
                                    <div class="col-sm-5 text-left">
                                        <p style="margin-bottom: 0px"><strong class="ng-binding">zasdasd</strong></p>
                                        <p class="ng-binding">adsd asdasd</p>
                                    </div>
                                    <div class="col-sm-5 text-left">
                                        <p class="ng-binding" style="margin-bottom: 0px">12/31/2313 - 12/31/2312</p>
                                        <p class="ng-binding">zxc, AL, US</p>
                                    </div>
                                    <div class="col-sm-2">
                                        <a class="btn btn-danger btn-xs" ng-click="deletePracticeInfo($index)">Remove</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                            </div><!-- end ngRepeat: practice in practices -->
                        </div>
                        <div class="filter">
                            <input class="ng-pristine ng-valid" id="jobTitle" ng-model="newPractice.job" placeholder="Job Title" type="text">
                            <input class="ng-pristine ng-valid" id="workCity" placeholder="City" maxlength="50" ng-model="newPractice.city" style="width: 25%" type="text">
                            <select class="ng-pristine ng-valid" id="workState" type="text" style="width: 15%;" ng-model="newPractice.state" ng-options="option for option in states"><option class="" value="" selected="">State</option><option value="0">AL</option><option value="1">AK</option><option value="2">AS</option><option value="3">AZ</option><option value="4">AR</option><option value="5">CA</option><option value="6">CO</option><option value="7">CT</option><option value="8">DE</option><option value="9">DC</option><option value="10">FM</option><option value="11">FL</option><option value="12">GA</option><option value="13">GU</option><option value="14">HI</option><option value="15">ID</option><option value="16">IL</option><option value="17">IN</option><option value="18">IA</option><option value="19">KS</option><option value="20">KY</option><option value="21">LA</option><option value="22">ME</option><option value="23">MH</option><option value="24">MD</option><option value="25">MA</option><option value="26">MI</option><option value="27">MN</option><option value="28">MS</option><option value="29">MO</option><option value="30">MT</option><option value="31">NE</option><option value="32">NV</option><option value="33">NH</option><option value="34">NJ</option><option value="35">NM</option><option value="36">NY</option><option value="37">NC</option><option value="38">ND</option><option value="39">MP</option><option value="40">OH</option><option value="41">OK</option><option value="42">OR</option><option value="43">PW</option><option value="44">PA</option><option value="45">PR</option><option value="46">RI</option><option value="47">SC</option><option value="48">SD</option><option value="49">TN</option><option value="50">TX</option><option value="51">UT</option><option value="52">VT</option><option value="53">VI</option><option value="54">VA</option><option value="55">WA</option><option value="56">WV</option><option value="57">WI</option><option value="58">WY</option></select>
                        </div>
                        <div class="filter">
                            <input class="ng-pristine ng-valid" id="hospitalName" ng-model="newPractice.name" placeholder="Hospital Name" type="text">
                            <input id="workStartDate" ng-model="newPractice.fromDate" class="dateMask ng-pristine ng-valid" placeholder="Start Date" type="text">
                        </div>
                        <div class="filter">
                            <input class="ng-pristine ng-valid" id="facilityType" ng-model="newPractice.type" placeholder="Facility Type" type="text">
                            <input id="workEndDate" ng-model="newPractice.toDate" class="dateMask ng-pristine ng-valid" placeholder="End Date" type="text">
                        </div>
                        <div class="filter" style="margin-top: 5px;">
                            <a ng-click="addProfessionInfo()" class="btn btn-sm btn-green">Add</a>
                        </div>



                    </fieldset>
                </div>
                <div style="float: left; width: 15%; text-align: right; padding-right: 15px; padding-top: 15px;"><a ng-click="cancelPracticeInfo()">Cancel</a></div>
                <div class="clearfix"></div>
            </div>

        </div>
        <br>
    </div>
    <div class="col col-sm-5">
        <div style="width: 90%; margin: 0 auto;">
            <br>
            <?php echo load_img("profile_ad_1.png") ?>
            <br><br>
            <?php echo load_img("profile_ad_2.png") ?>
            <br><br>
            <?php echo load_img("profile_ad_3.png") ?>
        </div>
    </div>
    <div class="clearfix"></div>
</div>