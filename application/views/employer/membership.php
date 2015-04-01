<div class="container " style="padding: 50px; min-height: 400px; background-color: #f7f7f7">
    <div>
        <div class="row-wrapper">
            <div class="col-lg-12"  style="text-align: center">
                <?php echo load_img('payment_popup.png', '', '400', '500'); ?>
                <br>

                <div style="width: 100%; " class="">
                    <form id="payment_popup_form" method="post" action="<?php echo site_url("employer_checkout"); ?>">
                        <div>
                            <label> Options Payment Button</label>    
                            <select id="payment_type" name="payment_type" required>
                                <option value="">Choose...</option>
                                <option value="paypal">Paypal</option>
                            </select>
                        </div>
                        <br>
                        <input type="submit" class="btn btn-embossed btn-wide btn-inverse" value="Go">

                    </form>
                </div>
                <br><br><br>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#payment_popup_form').validate();
    });
    
</script>