<?php
 $showDivFlag=true; 
$link = mysqli_connect("localhost", "root", "", "user") ;
if (mysqli_connect_error()) {
  die("database connection failed") ;
}
if (isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])) {
// Verify data
  $email = $_GET['email']; // Set email variable
  $hash = $_GET['hash']; // Set hash variable
  if (array_key_exists("submit", $_POST)) {
    $Password = $_POST['password'];
    $query = "SELECT * FROM `schools` WHERE email = '" . mysqli_real_escape_string($link, $email) . "' AND hash= '" . mysqli_real_escape_string($link, $hash) . "' LIMIT 1" ;
    $result = mysqli_query($link, $query) ;
    $row = mysqli_fetch_array($result) ;
    if (mysqli_num_rows($result) > 0) {
// We have a match, activate the account
      $query = "UPDATE `schools` SET `password` ='" . md5(md5($row['id']) . $Password) . "' WHERE email = '" . mysqli_real_escape_string($link, $email) . "' " ;
      mysqli_query($link, $query) ;
       $showDivFlag=false;
      echo '<div class="statusmsg"><h3>Your password has been reset, you can now login with new .</h3></div>' ;
    }
    else {
// Invalid approach
  echo '<div class="statusmsg"><h3>Invalid approach, please use the link that has been send to your email.</h3></div>' ;
  $showDivFlag=false;
}
  }
}
else {
// Invalid approach
  echo '<div class="statusmsg"><h3>Invalid approach, please use the link that has been send to your email.</h3></div>' ;
  $showDivFlag=false;
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
    <title>Reset Password</title>
    <style>html{background:url(photos/back.jpg) no-repeat center center fixed;background-size:cover}
    .position{margin-right:70px;text-align:center;margin:0 auto;width:300px;font-size:120%}
    .position1{margin-right:70px;text-align:center;margin:0 auto;width:300px;font-size:120%}
    body{background:none}
    </style>
</head>
<body>
    <br>
    <br>
    <br>
    <div class="position" <?php if ($showDivFlag===false){?>style="display:none"<?php } ?>>
            <form method="post" id="form">
                <div style="margin-top: 70px" class="form-group">

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


                </div>




                <button style="margin-top:10px ;margin-bottom:22px" id="btnSubmit" type="submit" name="submit" class="btn btn-primary">Submit</button>
</div>
            </form>


        <br>
        <br>
        <br>

       </div>
         <div class=position1>
        <button id="button" type="button" class="btn btn-dark"><a href="index.php">HOME</a></button>
         </div>
    <!-- end wrap div -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="parsley.min.js"></script>
    <script type="text/javascript">
    $(function()
      {
        $("#btnSubmit").click(function()
          {

            if ($("#pass2").val() == "" || $("#pass1").val() == "") {
              alert("All fields are required.");
              return false;

            }

            if (($("#pass1").val() != $("#pass2").val())) {

              alert("Passwords doesn't match.");

              return false;
            }
            return true;

          }
        );

      }
    );




    </script>
</body>
</html>