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
                    Job Interview <br><br>
                    Job Internal ID : {JOB_INTERNAL_ID}<br>
                    Job Heading : {JOB_HEADING}<br>
                    <br><br>
                    Please click the link below to start interview: <br>
                    
                    <a style="padding:10px; " href="<?php echo $link; ?>"><?php echo $link; ?></a>
                    
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


