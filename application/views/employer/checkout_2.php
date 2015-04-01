
<div style="padding: 50px; min-height: 400px; background-color: #f7f7f7" class="container ng-scope">
    <div>
        <h3>Check your order and pay</h3><br>
        <div class="row">
            
            
            <?php 
            $post = $this->input->post();
            if($this->input->post('payment_type')) {
                
                if(!$sub_data) { ?>
                    <form class="form-horizontal ng-pristine ng-valid" id="paypal_checkout_form" method="post" action="<?php echo site_url('employer_checkout/checkout_process'); ?>">
                <input type="hidden" name="amount" id="amount" value="10" >
                <input type="hidden" id="first_name" name="first_name" value="<?php echo ( isset($post['first_name']) ) ? $post['first_name'] : ""; ?>" >
                <input type="hidden" id="last_name" name="last_name" value="<?php echo ( isset($post['last_name']) ) ? $post['last_name'] : ""; ?>" >
                
                <input type="hidden" name="address" id="address" value="<?php echo ( isset($post['address']) ) ? $post['address'] : ""; ?>" >
                <input type="hidden" name="city" id="city" value="<?php echo ( isset($post['city']) ) ? $post['city'] : ""; ?>" >
                <input type="hidden" name="state" id="state" value="<?php echo ( isset($post['state']) ) ? $post['state'] : ""; ?>" >
                <input type="hidden" name="zip" id="zip" value="<?php echo ( isset($post['zip']) ) ? $post['zip'] : ""; ?>" >
                <input type="hidden" name="country_code" id="country_code" value="<?php echo ( isset($post['country_code']) ) ? $post['country_code'] : ""; ?>" >
                
                <h4 style="text-align:center">Credit card details</h4>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Credit Card Type</label>
                  <div class="col-sm-4">
                      <input checked="checked" required type="radio" name="ccType" id="ccType1" value="visa" class="">
                      <label for="ccType1">VISA </label>
                      <input required type="radio" name="ccType" id="ccType2" value="mastercard" class="">
                      <label for="ccType2">MASTER </label>
                      <input required type="radio" name="ccType" id="ccType3" value="discover" class="">
                      <label for="ccType3">Discover </label>
                      <input required type="radio" name="ccType" id="ccType4" value="amex " class="">
                      <label for="ccType4">AMEX </label>
                      
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Credit Card Number</label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control ng-pristine ng-valid" placeholder="" required id="cc" name="cc">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Credit Card Name</label>
                  <div class="col-sm-4">
                      <input type="text" class="form-control ng-pristine ng-valid" placeholder="" required id="cc_name" name="cc_name">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">CVV</label>
                  <div class="col-sm-2">
                      <input type="text" class="form-control ng-pristine ng-valid" placeholder="" required id="cvv" name="cvv">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Expire Date</label>
                  <div class="col-sm-4">
                      <div class="col-sm-5">
                      Month: 
                      <select id="expMonth" name="expMonth" class="form-control" required  >
                            <?php 
                            for($mon = 1; $mon <=12; $mon++) {
                                echo '<option value="'.$mon.'">'.$mon.'</option>';
                            }
                            ?>
                        </select>
                      </div>
                      <div class="col-sm-6">
                      Year: 
                      <select id="expYear" name="expYear" class="form-control" required>
                            <?php 
                                for($year = date('Y'); $year <=date('Y')+10; $year++) {
                                    echo '<option value="'.$year.'">'.$year.'</option>';
                                }
                            ?>
                        </select>
                      </div>
                  </div>
                </div>
                <div class="text-center">
                    <input style="display: inline-block; width: 50px; height: 10px;" type="checkbox" class="form-control" required id="agreed" name="agreed">
                    <span> Yes, I have read and I accept the <a href="<?php echo site_url("employer/terms_of_use"); ?>">Terms of use</a> and the <a href="<?php echo site_url("employer/terms_condition"); ?>">Privacy Policy</a> </span><br>
                </div>
                <div class="text-center" style="padding-top: 20px;">
                    <span>Payment will be taken when you press the 'Pay Now' button</span>
                </div>
                <div class="text-center" style="padding-top: 20px;">
                    <button type="submit" class="btn btn-primary btn-lg">Pay now</button>
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