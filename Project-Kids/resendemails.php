<?php
$headers = '';
if (array_key_exists("submit", $_POST)) {
    $link = mysqli_connect("localhost", "root", "", "user");
    if (mysqli_connect_error()) {
        die("database connection failed");
    }
    $email = $_POST['email'];
    $query = "SELECT id, active FROM `schools` WHERE email = '" . mysqli_real_escape_string($link, $email) . "'  AND active = '0' LIMIT 1";
    $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) > 0) {
        $hash = md5(rand(0, 1000));
        $query = "UPDATE `schools` SET hash ='" . $hash . "' WHERE email = '" . mysqli_real_escape_string($link, $email) . "' LIMIT 1";
mysqli_query($link, $query);
        $to = $email; // Send email to our user
        $subject = 'Signup | Verification'; // Give the email a subject
        $message = '

Thanks for signing up!
Your account has been created, Please activate your account for Logging In.



Please click this link to activate your account:
http://localhost/miniproject/verifys.php?email=' . $email . '&hash=' . $hash . '

'; // Our message above including the link
        $headers = "From:kidsteamatservice@gmail.com \r\n"; // Set from headers
        mail($to, $subject, $message, $headers);



        echo '<script type="text/javascript">';
        echo 'alert ("E-Mail has been sent to ur account to activate your account. In case you did not recive it try resend email.")';
        echo '</script>';
    }
    else {
        echo '<script type="text/javascript">';
        echo 'alert ("Eighter you have not registered Or your account is already active.")';
        echo '</script>';
    }
   $_POST = array();
    $_GET = array();
}
?>
<html>

<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="jquery-ui/jquery-ui.css">
        <script type="text/javascript" src="jquery-ui/jquery-ui.js"></script>
        <title>ResendEmail</title>
        <style>.position{margin-right:70px;text-align:center;margin:0 auto;width:300px;font-size:120%}
        body{background:none}
        html{background:url(photos/back.jpg) no-repeat center center fixed;background-size:cover}
        </style>
</head>
        <body >
                <div class="position">
                    <div id="divshow">

                        <form method="post" id="form">

                                <div style="margin-top: 70px" class="form-group">
                                        <label for="exampleInputEmail1"><b>Email Address</b></label>
                                        <input type="text" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter Email" required>

                                        <small id="emailHelp" class="form-text text-light">We'll not share your email.</small>
                                        </div>

                                <button style="margin-top:10px ;margin-bottom:22px" id="btnSubmit" type="submit" name="submit" class="btn btn-primary">Resend Mail</button>

<br>
<br>
</form>
</div>
<button id="button" type="button" class="btn btn-dark"><a href="index.php">HOME</a></button>




                </div>



<script src="js/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="parsley.min.js"></script>

<script type="text/javascript">
$(function()
    {
        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }
        $("#btnSubmit").click(function()
            {

                if ($("#email").val() == "") {
                    alert("E-Mail is required.");
                    return false;

                }

                if (isEmail($("#email").val()) == false) {

                    alert("E-mail address not valid.");
                    return false;
                }



                return true;


            });

    });
</script>

</body>

</html>