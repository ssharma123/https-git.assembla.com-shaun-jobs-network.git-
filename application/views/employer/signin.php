<style>

</style>
<?php echo load_js("employee_dashboard.js"); ?>
<div class="container ng-scope" ng-controller="DashboardCtrl" style="padding: 50px; min-height: 400px; background-color: #f7f7f7">
    <div>
        <div class="row">
            <div class="col col-sm-4 col-sm-offset-4">
                <form class="well well-lg text-center ng-valid ng-dirty" action="<?php echo site_url('employee_dashboard'); ?>">
                    <input type="text" ng-model="email" placeholder="Your Email" class="form-control ng-valid ng-dirty">
                    <br>
                    <input type="password" ng-model="pass" placeholder="Your Password" class="form-control ng-valid ng-dirty">
                    <br>

                    <button class="btn btn-primary btn-block">Sign In</button>

                </form>
            </div>
        </div>
    </div>

</div>