<div style="padding: 50px; min-height: 400px; background-color: #f7f7f7" ng-controller="DashboardCtrl" class="container ng-scope">
    <div class="col col-sm-8 col-sm-offset-2 ng-hide" ng-show="state === 'facility'">
    <h2 class="text-center" style="border-bottom: 2px solid black; padding-bottom: 20px">Please Verify Facility Information</h2>

    <div class="alert alert-danger ng-binding ng-hide" ng-show="err">
            
    </div>

    <form class="form-horizontal ng-pristine ng-valid" role="form">
        <div class="form-group">
          <label class="col-sm-4 control-label" for="name">Name</label>
          <div class="col-sm-8">
            <input type="text" ng-disabled="parseFacility" ng-model="facilityInfo.name" class="form-control ng-pristine ng-valid" id="name" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="address">Street Address</label>
          <div class="col-sm-8">
            <input type="text" ng-model="facilityInfo.streetAddress" class="form-control ng-pristine ng-valid" id="streetAddress" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="zipCode">Zip Code</label>
          <div class="col-sm-8">
            <input type="text" ng-model="facilityInfo.zipCode" class="form-control ng-pristine ng-valid" id="zipCode" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="city">City</label>
          <div class="col-sm-8">
            <input type="text" ng-model="facilityInfo.city" class="form-control ng-pristine ng-valid" id="city" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="numEmployees">Number of Employees</label>
          <div class="col-sm-8">
            <input type="number" ng-model="facilityInfo.numEmployees" class="form-control ng-pristine ng-valid ng-valid-number" id="numEmployees" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="numBeds">Number of Beds</label>
          <div class="col-sm-8">
            <input type="number" ng-model="facilityInfo.numBeds" class="form-control ng-pristine ng-valid ng-valid-number" id="numBeds" placeholder="">
          </div>
        </div>
        <hr>
        <h4>Billing Personnel</h4>
      <div class="form-group">
          <label class="col-sm-4 control-label" for="billingName">Name</label>
          <div class="col-sm-8">
            <input type="text" ng-model="facilityInfo.billingName" class="form-control ng-pristine ng-valid" id="billingName" placeholder="">
          </div>
        </div>
      <div class="form-group">
          <label class="col-sm-4 control-label" for="billingPhone">Phone</label>
          <div class="col-sm-8">
            <input type="text" ng-model="facilityInfo.billingPhone" class="form-control ng-pristine ng-valid" id="billingPhone" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="billingEmail">Email</label>
          <div class="col-sm-8">
            <input type="email" ng-model="facilityInfo.billingEmail" class="form-control ng-pristine ng-valid ng-valid-email" id="billingEmail" placeholder="">
          </div>
        </div>

        <div class="text-center" style="padding-top: 20px; border-top: 2px solid black">
            <a class="btn btn-primary btn-lg" href="<?php echo site_url('employee_dashboard'); ?>" >Finish </a>
        </div>
      </form>
  </div>
</div>
