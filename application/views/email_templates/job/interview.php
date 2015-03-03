<!DOCTYPE html>
<html>
    <head>
        <title>Email</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body style=" margin:0px; padding:0px;font-family: Helvetica, Arial, Tahoma, Verdana; background-color: #FFFFFF; padding-top: 10px; ">
        <table border="0" cellpadding="0" cellspacing="0" width="600" align="center">
            <tr>
                <td style="padding:20px 0 0 0; text-align:center">
                    <?php include 'header.php'; ?>
                </td>
            </tr>
            <tr>
                <td>
                    You have been offered an interview <br><br>
                    Job Internal ID : {JOB_INTERNAL_ID}<br>
                    Job Heading : {JOB_HEADING}
                    <br>
                    <br>
                    <a href="<?php echo site_url("job_seeker_dashboard/offer_interview/accept/".$job_applied_id); ?>" >ACCEPT INTERVIEW</a> or <a href="<?php echo site_url("job_seeker_dashboard/offer_interview/reject/".$job_applied_id); ?>" >REJECT INTERVIEW</a>
                </td>
            </tr>
            <tr>
                <td style="padding:20px 0 0 0; text-align:center">
                    <?php include 'footer.php'; ?>
                </td>
            </tr>
        </table>

    </body>
</html>


