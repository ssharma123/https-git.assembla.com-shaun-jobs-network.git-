<div id="setting_tab_item">
    <div class="sec_row">
        <div class="sec1"><strong>Notifications</strong></div>
        <div class="sec2"><i class="fa fa-envelope"></i> <strong>Email</strong></div>
        <div class="sec3"><i class="fa fa-mobile-phone"></i> <strong>Phone</strong></div>
        <div class="clearfix"></div>
    </div>
    <div class="sec_row">
        <div class="sec1">When there is a match</div>
        <div class="sec2"><input type="checkbox" class="ng-pristine ng-valid"></div>
        <div class="sec3"><input type="checkbox" class="ng-pristine ng-valid"></div>
        <div class="clearfix"></div>
    </div>
    <div class="sec_row">
        <div class="sec1">When I have an interview offer</div>
        <div class="sec2"><input type="checkbox" class="ng-pristine ng-valid"></div>
        <div class="sec3"><input type="checkbox" class="ng-pristine ng-valid"></div>
        <div class="clearfix"></div>
    </div>
    <div class="sec_row">
        <div class="sec1">When I am offered a face to face interview</div>
        <div class="sec2"><input type="checkbox" class="ng-pristine ng-valid"></div>
        <div class="sec3"><input type="checkbox" class="ng-pristine ng-valid"></div>
        <div class="clearfix"></div>
    </div>
    <div class="sec_row">
        <div class="sec1">When a job offer is made</div>
        <div class="sec2"><input type="checkbox" class="ng-pristine ng-valid"></div>
        <div class="sec3"><input type="checkbox" class="ng-pristine ng-valid"></div>
        <div class="clearfix"></div>
    </div>
    <div class="sec_row">
        <div class="sec1">All other status updates</div>
        <div class="sec2"><input type="checkbox" class="ng-pristine ng-valid"></div>
        <div class="sec3"><input type="checkbox" class="ng-pristine ng-valid"></div>
        <div class="clearfix"></div>
    </div>
    <div>
        <br><br>
        <div class="ng-binding">
            <strong>Email:</strong> numan@test.com <a href="javascript:void(0);">Change Email</a>
            <input type="email" name="change_email" id="change_email" >
            <br><br>
        </div>

        <div class="">
            <strong>Password:</strong> <a href="#">Change Password</a>
        </div>
        <div>
            <strong>Password:</strong> <input type="password" placeholder="Password" ng-model="password" id="password" class="ng-pristine ng-valid"> <input type="password" placeholder="Confirm Password" ng-model="password_c" id="password_c" class="ng-pristine ng-valid"> <a ng-click="updatePassword()" class="btn btn-sm btn-success">Change</a> <a ng-click="pState = 'password'">Cancel</a>
        </div>
    </div>
    <div>
        <br>
        <div class="text-right">
            <a ng-click="" class="btn btn-blue">Update</a>
        </div>
        <div class="clearfix"></div>
    </div>

</div>