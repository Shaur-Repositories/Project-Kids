<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="jquery-ui/jquery-ui.css">
    <script type="text/javascript" src="jquery-ui/jquery-ui.js"></script>
    <title>verification</title>
    <style>
    html{background:url(photos/back.jpg) no-repeat center center fixed;background-size:cover}
    #wrap{
        margin:0 auto;
        color:white;
        text-align: center;

    }
    body{background:none}

     </style>
</head>
<body>
    <br>
    <br>
    <br>
    <div id="wrap">
        <!-- start PHP code -->
        <?php

           $link = mysqli_connect("localhost", "root", "", "user");
    if (mysqli_connect_error()) {
        die("database connection failed");
    }

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    // Verify data
    $email = $_GET['email']; // Set email variable
    $hash = $_GET['hash']; // Set hash variable



    $query = "SELECT id, hash, active FROM `parents` WHERE email = '" . mysqli_real_escape_string($link, $email) . "' AND hash= '" . mysqli_real_escape_string($link, $hash) . "' AND active = '0' LIMIT 1";
    $result = mysqli_query($link, $query);

    if(mysqli_num_rows($result) > 0){
        // We have a match, activate the account

        $query = "UPDATE `parents` SET active ='1' WHERE email = '" . mysqli_real_escape_string($link, $email) . "' LIMIT 1";
    mysqli_query($link, $query);
        echo '<div class="statusmsg"><h3>Your account has been activated, you can now login.</h3></div>';
    }else{
        // No match -> invalid url or account has already been activated.
        echo '<div class="statusmsg"><h3>The url is either invalid or you already have activated your account.</h3></div>';
    }

}else{
    // Invalid approach
    echo '<div class="statusmsg"><h3>Invalid approach, please use the link that has been send to your email.</h3></div>';
}

          $_POST = array();
    $_GET = array();

        ?>
        <!-- stop PHP Code -->
        <br>
        <br>
        <br>
       <button id="button" type="button" class="btn btn-dark"><a href="index.php">HOME</a></button>

    </div>
    <!-- end wrap div -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="parsley.min.js"></script>
</body>
</html>