<style>
    .notification_dates{
        list-style: none;
        padding: 0px;
    }
</style>
<div class="row-wrapper">

    <div >
        <h4>Notifications</h4>
        <div class="row" style="border-bottom: 1px solid #a4a4a4; padding: 5px;">
            <div class="col col-sm-4">
                <b>Headline</b>
            </div>
            <div class="col col-sm-3">
                <b>Position</b>
            </div>
            <div class="col col-sm-3">
                <b>Dates</b>
            </div>
            <div class="col col-sm-2">
                <b>Action</b>
            </div>
        </div>
        <div >
            <?php
            if($notifications){ 
                foreach($notifications as $row){ ?>
            
                    <div class="row" style="border-bottom: 1px solid #a4a4a4; margin-top: 5px; padding: 5px;">
                        <div class="col col-sm-4 ng-binding">
                            <?php echo $row["job_headline"]; ?>
                        </div>
                        <div class="col col-sm-3 ng-binding">
                            <?php echo $row["title"]; ?>
                        </div>
                        <div class="col col-sm-3">
                            <ul class="notification_dates">
                                <li>
                                    <input class="select_date_radio" type="radio" name="select_date" id="select_date_1" value="<?php echo $row["f2f_date_1"]; ?>" > &nbsp;<?php echo formate_date($row["f2f_date_1"],"F j, Y"); ?> 
                                </li>
                                <li>
                                    <input class="select_date_radio" type="radio" name="select_date" id="select_date_2" value="<?php echo $row["f2f_date_2"]; ?>" > &nbsp;<?php echo formate_date($row["f2f_date_2"],"F j, Y"); ?>
                                </li>
                                <li>
                                    <input class="select_date_radio" type="radio" name="select_date" id="select_date_3" value="<?php echo $row["f2f_date_3"]; ?>" > &nbsp;<?php echo formate_date($row["f2f_date_3"],"F j, Y"); ?> 
                                </li>
                                
                                <input class="selected_date" type="hidden" name="selected_date" value="0" >
                            </ul>
                        </div>
                        <div class="col col-sm-2">
                            <a id="<?php echo $row["id"]; ?>" class="btn btn-sm btn-success select_date_jobseeker">Confirm</a>
                            <div class="busy_gif" style="display: none;"><?php echo load_img("busy.gif"); ?></div>
                        </div>
                    </div>
            
                <?php }
            } ?>
        </div>
    </div>

</div> 