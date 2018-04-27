<?php
session_start() ;
if (array_key_exists("logoutp", $_GET)) {
// if($_GET['logoutp']==2){
  unset($_SESSION['p_id']) ;
  unset($_SESSION['s_id']) ;
 // session_destroy() ;
  setcookie("p_id", "", time() - 60 * 60) ;
  $_COOKIE["p_id"] = "" ;
// }
}
else {
  if ((array_key_exists("p_id", $_SESSION) AND $_SESSION['p_id']) OR (array_key_exists("p_id", $_COOKIE) AND $_COOKIE['p_id'])) {
    header("Location:afterloginp.php") ;
  }
}
if (array_key_exists("logouts", $_GET)) {
  unset($_SESSION['s_id']) ;
  unset($_SESSION['p_id']) ;
 // session_destroy() ;
  setcookie("s_id", "", time() - 60 * 60) ;
  $_COOKIE["s_id"] = "" ;
}
else {
  if ((array_key_exists("s_id", $_SESSION) AND $_SESSION['s_id']) OR (array_key_exists("s_id", $_COOKIE) AND $_COOKIE['s_id'])) {
    header("Location:afterlogins.php") ;
  }
}
// else if($_SESSION['val']==2) {
// }
if (array_key_exists("submit", $_POST)) {
  $link = mysqli_connect("localhost", "root", "", "user") ;
  if (mysqli_connect_error()) {
    die("database connection failed") ;
  }
  if (!$_POST['email'] || !$_POST['password']) {
    echo '<script language="javascript">' ;
    echo 'alert("Both fiels are required to login.")' ;
    echo '</script>' ;
// $error .= "<br>Please Enter an E-Mail.<br>";
  }
/* if(!$_POST['password']){
$error .= "<br>Please Enter a password.<br>";
}
if($error != ""){
$error="<p>there were error(s) in ur form</p>".$error;
}*/
  else {

 $a=0;
 $b=1;

    $query = "(SELECT * FROM `parents` WHERE email= '" . mysqli_real_escape_string($link, $_POST['email']) . "' AND active = '1') " ;
    $result = mysqli_query($link, $query) ;
    $row = mysqli_fetch_array($result) ;
    if (isset($row)) {
      $hashpass = md5(md5($row['id']) . $_POST['password']) ;
      if ($hashpass == $row['password']) {
        $_SESSION['s_id'] = "" ;
        $_SESSION['p_id'] = $row['id'];
        if ($_POST['stayloggedin'] == '1') {
          setcookie("p_id", $row['id'], time() + 60 * 60 * 24 * 365) ;
        }
// $error.= "login successfull";
/* echo '<script language="javascript">' ;
echo 'alert("Password did not match.... if u forget ur password click the Forget Password")' ;
echo '</script>' ;   */
        header("Location:afterloginp.php") ;
      }
      else {
         if($a==0 && $b==1){
         $a=1;
        echo '<script language="javascript">' ;
        echo 'alert("Password did not match.... if u forget ur password click the Forget Password ")' ;
        echo '</script>' ;
       }
      }
   }


    $query = "(SELECT * FROM `schools` WHERE email= '" . mysqli_real_escape_string($link, $_POST['email']) . "' AND active = '1') " ;
    $result = mysqli_query($link, $query) ;
    $row = mysqli_fetch_array($result) ;
    if (isset($row)) {
      $hashpass = md5(md5($row['id']) . $_POST['password']) ;
      if ($hashpass == $row['password']) {
        $_SESSION['p_id'] = "" ;
        $_SESSION['s_id'] = $row['id'];
        if ($_POST['stayloggedin'] == '1') {
          setcookie("s_id", $row['id'], time() + 60 * 60 * 24 * 365) ;
        }
// $error.= "login successfull";
/* echo '<script language="javascript">' ;
echo 'alert("Password did not match.... if u forget ur password click the Forget Password")' ;
echo '</script>' ;   */
        header("Location:afterlogins.php") ;
      }
      else {
         $b=0;
        echo '<script language="javascript">' ;
        echo 'alert("Password did not match.... if u forget ur password click the Forget Password ")' ;
        echo '</script>' ;

      }


 }

    else {
        if($a==0 && $b==1){

      echo '<script language="javascript">' ;
      echo 'alert("E-Mail not registerd or ur account is not activated ")' ;
      echo '</script>' ;
      }
    }

  }
  //$_POST = array();
  //$_GET = array();
}
?>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home..</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="jquery-ui/jquery-ui.css">
        <script type="text/javascript" src="jquery-ui/jquery-ui.js"></script>
        <script language="javascript" src="jquery.js"></script>
        <script type="text/javascript" src='state.js'></script>
        <style type="text/css">
            .display-4 {
                margin-top: 50px;
                font-style: oblique;
                color: gold;
                font-family: sans-serif;
            }

            #navbarDropdown {
                text-decoration-line: underline;
                font-family: cursive;
            }

            html {
                background: url(photos/background-1.jpg) no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }

            body {
                background: none;
            }

            .jumbotron1 {
                text-align: center;
                font-style: italic;
                font-size: bold;
                color: wheat;

                padding: 40px;

            }

            .nav-link:hover {
                text-decoration-line: underline;
                font-family: cursive;
            }

            .frms {
                margin: 0 auto;
                padding: 10px;
                -moz-border-radius: .3em;
                -webkit-border-radius: .3em;
                -o-border-radius: .3em;
                font-family: Tahoma, Geneva, sans-serif;
                color: #333;
                font-size: .9em;
                line-height: 1.2em;
            }

            .frms select {
                width: 99%;
                background: #fff;
                border: #ddd 1px solid;
                border-radius: .35em;
                -moz-border-radius: .35em;
                -webkit-border-radius: .35em;
                -o-border-radius: .35em;
                padding: 0 .5%;
                margin-top: 5px;
                margin-bottom: 15px;
                height: 35px;
            }

            .frms select:hover {
                box-shadow: #dae1e5 0px 0px 5px;
                -moz-box-shadow: #dae1e5 0px 0px 5px;
                -webkit-box-shadow: #dae1e5 0px 0px 5px;
                -o-box-shadow: #dae1e5 0px 0px 5px;
            }

            .frms select:focus {
                -webkit-box-shadow: inset 7px 4px 7px -7px rgba(0, 0, 0, 0.42);
                -moz-box-shadow: inset 7px 4px 7px -7px rgba(0, 0, 0, 0.42);
                box-shadow: inset 7px 4px 7px -7px rgba(0, 0, 0, 0.42);

                border: #9d9983 1px solid;
            }

            .resp_code {
                margin: 5px 10px 10px 300px;
                padding: 10px 20px 10px 20px;
                color: #333;
                background: #f8f8f8;
                overflow: auto;
                width: 50%;
            }

            h5 {
                margin: 0;
                padding: 0;
            }

            @media screen and (max-width: 480px) {
                .resp_code {
                    width: auto !important;
                    margin: 0px !important;
                }
            }

            #error {
                margin-left: 30px;
                color: white;
                font-size: 125%;

            }

            .modal-header,
            .modal-body,
            .modal-footer {
                padding: 25px;
            }

            .modal-footer {
                text-align: center;
            }

            #signup-modal-content,
            #forgot-password-modal-content {
                display: none;
            }

            /** validation */

            input.parsley-error {
                border-color: #843534;
                box-shadow: none;
            }

            input.parsley-error:focus {
                border-color: #843534;
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #ce8483
            }

            .parsley-errors-list.filled {
                opacity: 1;
                color: #a94442;
                display: none;
            }

            #lognav {
                margin-top: 20px;
                color: red;
            }

            .lead {
                color: black;
                font-size: 125%;

            }
            #search{
    margin:0 auto;
    max-width:300px;
    width: calc(100% - 50px);
    border: black 2px solid;
    padding:3px;


}
#txt{
    text-align:right;
}
.jumbotron1 {
                text-align: center;
                font-style: italic;
                font-size: bold;
                color: black;

                 margin:0 auto;

            }
#back{
    width: calc(100% - 100px);

    max-width:500px;
    margin:0 auto;
    max-height:600px;
    background-color: white;
    padding-top:5px;
    overflow-y:scroll;
    border:black 2px solid;
    border-radius:2%;


}
#close{
     margin-bottom:3px;
     margin-left:3px;
     margin-right:80%;

}

        </style>


    </head>

    <body>

        <nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
            <a class="navbar-brand" href="#"><b><h1>Kids</h1></b></a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav mr-auto ">
                    <li class="nav-item active">
                        <a class="nav-link " href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contactus.html">Contact Us</a>
                    </li>

                </ul>
                <ul class="nav nav-link navbar-nav ml-auto">
                    <li><a style="color:red " href="javascript:void(0)" data-toggle="modal" data-target="#login-signup-modal">Login</a></li>
                </ul>
                <ul class="nav navbar-nav ">

                    <li class="nav-item dropdown">
                        <a style="color:red " class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          SignUp
        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="parentRegistration.php">For Parents</a>
                            <a class="dropdown-item" href="schoolRegistration.php">For School</a>
                        </div>
                    </li>

                </ul>

            </div>

        </nav>


        <div class="jumbotron1">
            <h1 class="display-4">With Love And Care</h1>
            <p class="lead"><b> Here you can find the best suitable play school for your little one.</b></p>
            <?php

    echo'<br>';




    $link = mysqli_connect("localhost", "root", "", "user");
    if (mysqli_connect_error()) {
        die("database connection failed");
    }
    if (array_key_exists("search0", $_POST)){
        $_SESSION['p_id']=0;
    $_SESSION['s_id']="";
         $query =  "(SELECT * FROM `schools` WHERE name = '" . mysqli_real_escape_string($link, $_POST['schoolname']) . "' and active= 1 )";
       $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) == 0) {
        echo '<script type="text/javascript">';
        echo 'alert ("No school is found.")';
        echo '</script>';
    }else{

                    $query =  "(SELECT * FROM `schools` WHERE name = '" . mysqli_real_escape_string($link, $_POST['schoolname']) . "' and active= 1 )";
       $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) > 0)
    {
                   echo '<div id="back"> <input style="self-align:right" id="close" class="btn btn-danger" type="button" value="close">';
			while($row=mysqli_fetch_array($result)){
                  $id=$row['id'] ;


                  echo '<div id="search"><a href="comment.php?id=' . $id . '"> <img src='.$row['profile_image'] .' height="100px;" width="100px;"><t>';
                if($row['verify']==0){
                      echo'<label id="verify" style="color:red; padding-left:6px;">Not Verified</label>';
                  }else{
                      echo'<label id="verify" style="color:green;padding-left:6px;">Verified</label>';
                  }

             $avg=0;
                $count=0;
             require("db/db.php");
                $result1 = mysqli_query($con, "SELECT * FROM comments   WHERE s_id = ".$id."   ");
                if (mysqli_num_rows($result1)> 0){
                while($row1=mysqli_fetch_array($result1)){
                         $avg=$avg+$row1['rating'];
                         $count=$count+1;
                 }
                 $average=($avg/($count*5))*100;
                 echo "<div style='margin:0 auto;text-align:center' ><label >Rating : ". $average."%</label><br>(Reviewed by ".$count." people.)</div>";
                    }else{
                         echo "<div style='margin:0 auto;text-align:center' ><label ></label><br>(Reviewed by ".$count." people.)</div>";
                    }

                echo'</t><t><div id=txt>'.$row['name']. '<br>'.$row['address']. '<br>'.$row['city'].','.$row['state']. '</div></t></a></div><br>';



			}
            echo'</div>';
            echo'<br>';
            echo'<br>';
    }

    }
    }



    if (array_key_exists("search1", $_POST)){
        $_SESSION['p_id']='0';
    $_SESSION['s_id']="";
         $query =  "(SELECT id FROM `schools` WHERE city = '" . mysqli_real_escape_string($link, $_POST['city']) . "' and active=1)";
       $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) == 0) {
        echo '<script type="text/javascript">';
        echo 'alert ("No school is found.")';
        echo '</script>';
    }else{
                    $query =  "(SELECT * FROM `schools` WHERE city = '" . mysqli_real_escape_string($link, $_POST['city']) . "' and active= 1 )";
       $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) > 0) {


                   echo '<div id="back"> <input id="close" class="btn btn-danger" type="button" value="close">';
			while($row=mysqli_fetch_array($result)){
                  $id=$row['id'] ;


                  echo '<div id="search"><a href="comment.php?id=' . $id . '"> <img src='.$row['profile_image'] .' height="100px;" width="100px;"><t>';
                if($row['verify']==0){
                      echo'<label id="verify" style="color:red; padding-left:6px;">Not Verified</label>';
                  }else{
                      echo'<label id="verify" style="color:green;padding-left:6px;">Verified</label>';
                  }

                 $avg=0;
                $count=0;
             require("db/db.php");
                $result1 = mysqli_query($con, "SELECT * FROM comments   WHERE s_id = ".$id."   ");
                if (mysqli_num_rows($result1)> 0){
                while($row1=mysqli_fetch_array($result1)){
                         $avg=$avg+$row1['rating'];
                         $count=$count+1;
                 }
                 $average=($avg/($count*5))*100;
                 echo "<div style='margin:0 auto;text-align:center' ><label >Rating : ". $average."%</label><br>(Reviewed by ".$count." people.)</div>";
                    }else{
                         echo "<div style='margin:0 auto;text-align:center' ><label ></label><br>(Reviewed by ".$count." people.)</div>";
                    }

                echo'</t><t><div id=txt>'.$row['name']. '<br>'.$row['address']. '<br>'.$row['city'].','.$row['state']. '</div></t></a></div><br>';



			}
            echo'</div>';

                   echo'<br>';
            echo'<br>';
    }
    }

    }



?>
            <hr class="my-4">
            <p style="color:black">Search through name or by Location.</p>
            <form style="width :50%;align:center ; margin: 0 auto"method="post">
                <input class="form-control mr-sm-2" id="schoolname" name="schoolname" type="search" placeholder="Search" aria-label="Search">
                <button style="margin-top: 12px" id="search0" name="search0" class="btn btn-primary btn-lg" type="submit">Search</button>
            </form>
            <br>

            <div class='resp_code frms' style="margin :0 auto">
                <p align='center'><b>Choose Ur Locality</b></p>
                <form method="post">
                 <div id="state">

                    <select id="listBox" onchange='selct_district(this.value)'></select>
                     </div>
                     <div id="city" >

                    <select name="city" id='secondlist'></select>
                     </div>
                <div id="dumdiv" align="center" style=" font-size: 10px;color: #dadada;">
                    <button id="dum" name="search1" class="btn btn-primary btn-lg" type="submit">Search</button>
                </div>
                </form>
            </div>

            </div>


     <!--   <div id="error">
            <?php echo $error ; ?>
        </div>-->




        <!-- Bootstrap Modal -->


        <!--Login, Signup, Forgot Password Modal -->
        <div id="login-signup-modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">

                <!-- login modal content -->
                <div class="modal-content" id="login-modal-content">

                    <div class="modal-header">

                        <h4 class="modal-title"><span class="glyphicon glyphicon-lock"></span> Login Now!</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" id="Login-Form" role="form">

                            <div class="form-group">
                                <div class="input-group">

                                    <input name="email" id="email" type="email" class="form-control input-lg" placeholder="Enter Email">
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                                    <input name="password" id="login-password" type="password" class="form-control input-lg" placeholder="Enter Password" data-parsley-trigger="keyup">
                                </div>
                            </div>

                            <div class="checkbox">
                                <label><input type="checkbox" name="stayloggedin" value="" checked>Remember me</label>
                            </div>
                            <button type="submit" name="submit" class="btn btn-success btn-block btn-lg">LOGIN</button>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <p>
                            <a id="FPModal" href="forgetPass.php">Forgot Password?</a>


                        </p>
                    </div>

                </div>
                <!-- login modal content -->
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Login, Signup, Forgot Password Modal -->


        <!-- Bootstrap Modal -->


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="parsley.min.js"></script>
        <script>
            $(document).ready(function() {

                $('#Login-Form').parsley();
                $('#Signin-Form').parsley();
                $('#Forgot-Password-Form').parsley();

                $('#signupModal').click(function() {
                    $('#login-modal-content').fadeOut('fast', function() {
                        $('#signup-modal-content').fadeIn('fast');
                    });
                });

                $('#loginModal').click(function() {
                    $('#signup-modal-content').fadeOut('fast', function() {
                        $('#login-modal-content').fadeIn('fast');
                    });
                });

                $('#FPModal').click(function() {
                    $('#login-modal-content').fadeOut('fast', function() {
                        $('#forgot-password-modal-content').fadeIn('fast');
                    });
                });

                $('#loginModal1').click(function() {
                    $('#forgot-password-modal-content').fadeOut('fast', function() {
                        $('#login-modal-content').fadeIn('fast');
                    });
                });

            });
            $("#search0").click(function() {
           if($("#schoolname").val() == ""){
                              alert("School name is required.");
                              return false;
                    }
                    return true;
    })

$("#dum").click(function() {
     if($("#listBox").val()=="SELECT STATE"){
                        alert("Please Select a state.");
                        return false;
                    }
                    if($("#secondlist").val()==""){
                        alert("Please Select your city.");
                        return false;
                    }
                    return true;
   })

   $("#close").click(function(){
    $("#back").hide();
    })


        </script>
    </body>

    </html>
