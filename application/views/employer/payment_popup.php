<div style="">
    <?php echo load_img('payment_popup.png','','400','500'); ?>
    <br>
    
    <div style="width: 100%; padding-left: 17%;" class="">
        <form id="payment_popup_form" method="post" action="<?php echo site_url("employer/chekout"); ?>">
            <label> Options Payment Button</label>    
        <select>
            <option value="">Choose...</option>
            <option value="paypal">Paypal</option>
        </select>&nbsp;
        <input type="submit" class="btn btn-embossed btn-wide btn-inverse" value="Go">

        </form>
    </div>
    <br><br><br>
</div>