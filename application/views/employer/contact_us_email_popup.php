<div style="width: 500px; padding: 50px; background-color: #FFF" class="">
    <div>
        <h3>Chicago, IL</h3>
        <p>222 W. Merchandise Mart Plaza, 12th Floor Chicago, IL 60654</p>
        <br>
        <div id="rsp_contact_us_email" class="" style="display: none;"></div>
        <div class="row">
            <form class="form-horizontal ng-pristine ng-valid" id="contact_us_email_form" method="post" action="">
                
                <div class="form-group">
                  <div class="col-sm-12">
                      <label class=" "><strong>Name: </strong></label>
                      <input type="text" required id="contact_us_name" name="contact_us_name" class="col-sm-12" placeholder="Enter name" >
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                      <label class=" "><strong>Email: </strong></label>
                      <input type="email" required id="contact_us_email" name="contact_us_email" class="col-sm-12" placeholder="Enter email" >
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                      <label class=" "><strong>Phone Number: </strong></label>
                      <input type="text" required id="contact_us_phone_num" name="contact_us_phone_num" class="col-sm-12 is_phone_number" placeholder="Enter phone number" >
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="col-sm-12">
                      <label class=" "><strong>Message:</strong></label>
                      <textarea required name="contact_us_message" id="contact_us_message" class="col-sm-12" placeholder="Enter message here"></textarea>
                  </div>
                </div>
                
                <div class="text-center" style="padding-top: 20px;">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-envelope" style=""></span>
                        Send
                    </button>
                    <br>
                </div>
                
            </form>
        </div>
    </div>
</div>
<script>
    $("#contact_us_email_form").validate({
        rules: {
            'call_phone': {
                minlength: 10,
                required: true
            }
        },
//        errorPlacement: function(error, element) {
//            element.attr("placeholder",error.text());
//        },
        submitHandler: function(form) {
            
            $.ajax({
                type: "POST",
                url: BASE_URL+"employer/contact_us_email_popup_process/",
                data: {
                    name: $.trim( $("#contact_us_name").val() ),
                    email: $.trim( $("#contact_us_email").val() ),
                    phone_number: $.trim( $("#contact_us_phone_num").val() ),
                    message: $.trim( $("#contact_us_message").val() )
                },
                dataType: "json"

            }).success(function(rsp){
                if(rsp.status === "ok"){
                    $("#rsp_contact_us_email").html(rsp.msg).addClass('success_rsp');
                    $("#rsp_contact_us_email").show();
                }
                else{
                    $("#rsp_contact_us_email").html(rsp.msg).addClass('error_rsp');
                    $("#rsp_contact_us_email").show();
                }
            });
            
            return false;
            
        }
    });
</script>