<div style="padding: 50px; min-height: 400px; background-color: #f7f7f7; width: 500px;" ng-controller="DashboardCtrl" class="container ng-scope">
    <div class="col col-sm-12 " >
    <h2 class="text-center" style="border-bottom: 2px solid black; padding-bottom: 20px">New Employer Account</h2>

    <br>
    <form class="form-horizontal ng-pristine ng-valid" role="form">
        <div class="form-group">
          <label class="col-sm-4 control-label" for="firstName">First Name</label>
          <div class="col-sm-8">
            <input type="text" ng-model="firstName" class="form-control ng-pristine ng-valid" id="firstName" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="lastName">Last Name</label>
          <div class="col-sm-8">
            <input type="text" ng-model="lastName" class="form-control ng-pristine ng-valid" id="lastName" placeholder="">
          </div>
        </div>
      <div class="form-group">
          <label class="col-sm-4 control-label" for="phone">Phone</label>
          <div class="col-sm-8">
            <input type="text" ng-model="phone" class="form-control ng-pristine ng-valid" id="phone" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="email">Email</label>
          <div class="col-sm-8">
            <input type="email" ng-model="email" class="form-control ng-pristine ng-valid ng-valid-email" id="email" placeholder="">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-4 control-label" for="password">Choose a Password</label>
          <div class="col-sm-8">
            <input type="password" ng-model="password" class="form-control ng-pristine ng-valid" id="password" placeholder="Password">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="confirmpassword">Confirm Password</label>
          <div class="col-sm-8">
            <input type="password" ng-model="confirmpassword" class="form-control ng-pristine ng-valid" id="confirmpassword" placeholder="One More Time Please!">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-4 control-label" for="facilityName">Facility Name</label>
          <div class="col-sm-8">
            <input type="text" aria-owns="typeahead-017-6036" aria-expanded="false" aria-autocomplete="list" class="form-control ng-pristine ng-valid" id="facilityName" ng-model="employerNameInput" typeahead="employer.name for employer in employers | filter:{name:$viewValue} | limitTo:8"><!-- ngIf: isOpen() -->
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-4 control-label" for="jobTypes">Job Types</label>
          <div class="col-sm-4 col-sm-offset-2">
            <div>
              <input type="checkbox" class="ng-pristine ng-valid" ng-model="permanentJobs"> Permanent
            </div>
            <div>
            <input type="checkbox" class="ng-pristine ng-valid" ng-model="locumJobs"> Locum Tenens
          </div>
          <div>
            <input type="checkbox" class="ng-pristine ng-valid" ng-model="tempJobs"> Temp
          </div>
          </div>
        </div>

        <div class="text-center" style="padding-top: 20px; border-top: 2px solid black">
            <a class="btn btn-primary btn-lg" href="<?php echo site_url('employer/signup/2'); ?>">Post a new Job</a>
          <br>
          <p>Already a member? <a href="<?php echo site_url('employer/signin'); ?>">Log In</a> option</p>
        </div>
      </form>
  </div>
</div>