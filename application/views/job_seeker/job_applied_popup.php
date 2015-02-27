<style>
    .top {
  background: none repeat scroll 0 0 #40aee9;
  color: #fff;
  height: 100px;
  width: 100%;
  padding: 15px;
}
.middle,.bottom{
    background: #F7F7F7;
}
.bottom{
    padding: 10px 0 10px 0; 
}
</style>
<div style="width: 620px; ">
    <div class="top">
        <h1 style="float: left; margin-top: 0px; margin-bottom: 5px; font-weight: bold">Applied!</h1>
        <p style="float: left; padding-left: 10px; font-size: 14px; font-weight: bold;">
            Sit tight:<br>
            We'll notify you immediately when you're matched.
        </p>
    </div>
    <div class="middle text-center">
        <p style="color: rgb(11, 54, 255); padding: 2px 15px; font-weight: bold; font-size: 18px; text-align: left; float: left; clear: left;">
            Thanks, Doc!<br>
            Please keep an eye on your email, text, or status page. As soon as facility takes action, you will be notified in real time!
        </p>
        <div class="text-center">
            <img <?php echo load_img("users-network.png"); ?> ><br>
            <span class="greyText" style="display: inline-block; font-size: 12px; width: 35%">
                Help your colleagues stay on top of their game and let them know about MedMatch. You could make up to #1,000 per referral!
            </span>
        </div>
    </div>
    <div class="bottom text-center">
        <button id="close_popup" class="btn btn-lg btn-primary" value="Close" >Close</button>
    </div>
</div>
<script>
    $("#close_popup").click(function(){
       FBox.fancybox.close(); 
    });
</script>