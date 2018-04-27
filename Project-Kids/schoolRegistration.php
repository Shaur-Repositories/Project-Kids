<?php
$headers = '';
if (array_key_exists("submit", $_POST)) {
    $link = mysqli_connect("localhost", "root", "", "user");
    if (mysqli_connect_error()) {
        die("database connection failed");
    }
    $Password = $_POST['password'];
    $Email = $_POST['email'];
    $name = $_POST['username'];
    $query = "(SELECT id FROM `schools` WHERE email = '" . mysqli_real_escape_string($link, $_POST['email']) . "' LIMIT 1)UNION ALL (SELECT id FROM `parents` WHERE email = '" . mysqli_real_escape_string($link, $_POST['email']) . "' LIMIT 1)";
    $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) > 0) {
        echo '<script type="text/javascript">';
        echo 'alert ("E-Mail address Already registered.If ur account is not activated click on resend verification mail link below.")';
        echo '</script>';
    }
    else {
        $hash = md5(rand(0, 1000));
        $query = "INSERT INTO `schools` (`email`,`password`,`hash`,`name`,`address`,`contact`,`state`,`city`) VALUES('" . mysqli_real_escape_string($link, $_POST['email']) . "',
'" . mysqli_real_escape_string($link, $_POST['password']) . "','" . mysqli_real_escape_string($link, $hash) . "','" . mysqli_real_escape_string($link, $_POST['username']) . "','" . mysqli_real_escape_string($link, $_POST['address']) . "','" . mysqli_real_escape_string($link, $_POST['contact']) . "','" . mysqli_real_escape_string($link, $_POST['listBox']) . "','" . mysqli_real_escape_string($link, $_POST['secondlist']) . "')";
        if (!mysqli_query($link, $query)) {
            //$error = "<p>could not sign you up - please try again.</p>";
        }
        else {
            $query = "UPDATE `schools` SET password ='" . md5(md5(mysqli_insert_id($link)) . $_POST['password']) . "' WHERE id =" . mysqli_insert_id($link) . " LIMIT 1";
            mysqli_query($link, $query);
            }

        $to = $Email; // Send email to our user
        $subject = 'Signup | Verification'; // Give the email a subject
        $message = '

Thanks for signing up!
Your account has been created, Please activate your account for Logging In.



Please click this link to activate your account:
http://localhost/miniproject/verifys.php?email=' . $Email . '&hash=' . $hash . '

'; // Our message above including the link
        $headers = "From:kidsteamatservice@gmail.com \r\n"; // Set from headers
        mail ($to,$subject,$message,$headers);

        header("Location:regisesss.php");

        /*echo '<script type="text/javascript">';
        echo 'alert ("Your account has been registerd.E-Mail has been sent to ur account with link to activate your account. In case you did not recive it try resend email.")';
        echo '</script>'; */

    }

    $_POST = array();
    $_GET = array();
}
?>


<html>
<head>
     <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="jquery-ui/jquery-ui.css">
        <script type="text/javascript" src="jquery-ui/jquery-ui.js"></script>
        <script language="javascript" src="jquery.js"></script>
        <script type="text/javascript" src='state.js'></script>
        <title>school-registration</title>
        <style>
        .position{padding:0px;text-align:center;margin:0 auto;font-size:120%;width:300px;}
        html{background:url(photos/back.jpg) no-repeat center center fixed;background-size:cover}
        body{background:none;

            font-weight:bold;
            text-align: center;
        }
        #button{margin:0 auto}
        .mailsend{
            color:aqua;
            font-size: 70%;
        }
        select{
            width:150px;
        }


        #city{


            margin:0 auto;

        }
        #state{


            margin:0 auto;

        }
        form{
           padding-left:25%;
           padding-right:25%;

           font-size:120%;
            min-width:400px;
            margin :0 auto;
        }

        </style>
</head>
<body>

            <form method="post" id="form">
                <div style="margin-top: 70px" class="form-group">
                    <label for="exampleInputEmail1"><b>User Name</b></label>
                    <input type="text" class="form-control" name="username" id="username"  placeholder="User Name" required>

                    <small id="emailHelp" class="form-text text-light">Enter Your Name.</small>
                </div>
                    <div class="form-group">

                    <label for="exampleInputEmail1"><b>Email Address</b></label>
                    <input type="text" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter Email" required>

                    <small id="emailHelp" class="form-text text-light">We'll not share your email.</small>
                </div>
                <div class="form-group">
                    <label for="inputPassword6"><b>Password</b></label>
                    <input type="password" id="pass1" placeholder="password" name="password" class="form-control " aria-describedby="passwordHelpInline" required>
                    <small id="passwordHelpInline" class="text-light">
      <p>Enter your secret password.</p>
    </small>
                    <label for="inputPassword6"><b>Confirm Password</b></label>
                    <input type="password" name="password1" class="form-control " aria-describedby="passwordHelpInline" placeholder="confirm password" id="pass2" required >
                    <small id="passwordHelpInline" class="text-light">
      Type the same password as above.
    </small>
    <br>
        </div>



    <div style="text-align:center "class="form-group ">
       <label style="font-size:110%;" >Address</label>
       <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St" required>
    </div>


    <div id="state">
    <label>Select State</label>
    <select  id="listBox" name="listBox" onchange='selct_district(this.value)' required></select>
    </div>
    <div id="city" >
    <label>Select&nbsp;&nbsp;&nbsp;City  </label>
        <select id="secondlist" name="secondlist" required>
    <option  value="SELECT CITY">SELECT CITY</option>
    </select>
    </div>



        <div  class="form-group ">
            <br>
        <label style="font-size:110%;" for="inputContact">Contact Number</label>
        <input  type="digits" class="form-control" name="contact" id="contact" placeholder="Enter contact number" required>
        <br>

    </div>









                <button style="margin-top:10px ;margin-bottom:22px" id="btnSubmit" type="submit" name="submit" class="btn btn-primary">Submit</button>
<br>
<br>

            <button id="button" type="button" class="btn btn-dark"><a href="index.php">HOME</a></button>
            <br>
           
            <a class="mailsend" href=resendemails.php>Registerd but email not recived. Click Here</a>


               <div id="dumdiv" align="center" style=" font-size: 10px;color: #dadada;">
        <a id="dum" style="padding-right:0px; text-decoration:none;color: green;text-align:center;" href=""></a>
    </div>
</form>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="parsley.min.js"></script>





        <script type="text/javascript">
            $(function() {
                function isEmail(email) {
                    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    return regex.test(email);
                }
                $("#btnSubmit").click(function() {




                    if($("#username").val() == ""){
                              alert("All fields are required.");
                              return false;
                    }

                    if ($("#email").val() == "" || $("#pass1").val() == "") {
                        alert("All fields are required.");
                        return false;

                    }
                    if ($("#pass2").val() == "") {
                       alert("All fields are required.");
                        return false;
                    }
                    if ($("#address").val() == "") {
                       alert("All fields are required.");
                        return false;
                    }
                    if ($("#contact").val() == "") {
                       alert("All fields are required.");
                        return false;
                    }
                    if($("#listBox").val()=="SELECT STATE"){
                        alert("Please Select your state.");
                        return false;
                    }
                    if($("#secondlist").val()=="SELECT CITY"){
                        alert("Please Select your city.");
                        return false;
                    }




                    if (isEmail($("#email").val()) == false) {
                        $("#email").focus();

                        alert("E-mail address not valid.");
                        return false;
                    }
                    if (($("#pass1").val() != $("#pass2").val())) {
                        $("#pass1").focus();
                        $("#pass2").focus();

                        alert("Passwords doesn't match.");

                        return false;
                    }
                    var phone=$("#contact").val();
                    if(phone !=="" && !$.isNumeric(phone)){
                        $("#contact").focus();
                        alert("Phone no. not valid");

                        return false;
                    }

                    return true;

                });

            });

        </script>

</body>

</html>