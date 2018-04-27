<?php

   session_start();
    if( $_SESSION['s_id'] != ""){
              header("Location:afterlogins.php") ;
    }
    //$_SESSION['val']=2;
    if( $_SESSION['p_id'] == '0'){
              header("Location:index.php") ;
    }
   if(array_key_exists("p_id",$_COOKIE)){

       $_SESSION['p_id']=$_COOKIE['p_id'];
    }

    if(array_key_exists("p_id",$_SESSION)){
        echo "<p>Logged In! <a href='index.php?logoutp=2'>logout</a></p>";

    }else{
        header("Location:index.php");
    }

    $link = mysqli_connect("localhost", "root", "", "user") ;
        if (mysqli_connect_error()) {
        die("database connection failed") ;
        }
        else{
            $query = "(SELECT * FROM `parents` WHERE id= '" . mysqli_real_escape_string($link, $_SESSION['p_id']) . "') " ;
            $result = mysqli_query($link, $query) ;
            $row = mysqli_fetch_array($result) ;
        // echo "Welcome...... ".$row['name']."";

        }





 //  $_POST = array();
  //$_GET = array();

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
            <title>parent-registration</title>
            <style>
                #A {
                width: 250px;
                height: 250px;
                border-radius: 50%;
                background-color: red;
                margin-left:30px;
            }
             html {
                background: url(photos/back0.jpg) no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }

            body {
                background: none;
            }

            section {

    padding:  0;

}
input:hover{
    border-color:skyblue;
}
    button{
        margin:0 auto;
    }


            </style>
        </head>

        <body>

            <nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
            <a class="navbar-brand" href="#"><b><h1>Kids</h1></b></a>
             <div class="ml-auto">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
              </div>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                       <ul class="nav nav-link navbar-nav ml-auto">

                    <li><a style="color:red " href="afterloginp.php" >

                        <button type="button" name="back" id="back" class="btn btn-danger"> &nbsp; Back&nbsp;&nbsp; </button>   </a></li>

                </ul>
                <ul class="nav  navbar-nav ">

                    <li><a style="color:red " href="deleteprofilep.php?deleteprofilep=2" >

                        <button type="button" name="delete" id="delete" class="btn btn-danger">  Delete&nbsp; </button>   </a></li>

                </ul>
                <ul class="nav navbar-nav ">

                    <li class="nav nav-link navbar-nav ">
                        <a style="color:red "  href="index.php?logoutp=2" aria-haspopup="true" aria-expanded="false">
                            <button type="button" class="btn btn-danger"> Logout </button>

        </a>  </li>


                </ul>
                  </div>




        </nav>


              <br>
              <br>
              <br>




           <section id="tabs">
                <div class="container" style="width:335px;">

                    <div class="row" style="width:335px;">
                        <div class="col-xs-12 " style="margin:0 auto;">
                            <nav style="width:335px;margin:0 auto;">
                                <div class="nav nav-tabs " id="nav-tab" role="tablist">
                                    <a  class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Profile-Image</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Username</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Password</a>
                                </div>
                            </nav>
                            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="wrapperDiv">
                                        <br>

                                        <form action="" method="post" id="form" enctype="multipart/form-data">
                                           <p> <b>Upload Image : </b> </p>

                                            <input style="border-color:black;" class="form-control" type="file" name="uploadFile" value="" />
                                            <br>
                                            <input style="background:skyblue;border-color:black;font-size:bold;" class="form-control" type="submit" name="submitBtn" value="&nbsp;&nbsp;&nbsp;&nbsp;Upload&nbsp;&nbsp;&nbsp;" />
                                        </form>



                                        <?php
        $last_insert_id = null;
        if(isset($_POST['submitBtn']) && !empty($_POST['submitBtn'])) {

            if(isset($_FILES['uploadFile']['name']) && !empty($_FILES['uploadFile']['name'])) {
                //Allowed file type
                $allowed_extensions = array("jpg","jpeg","png","gif");

                //File extension
                $ext = strtolower(pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION));

                //Check extension
                if(in_array($ext, $allowed_extensions)) {
                    //Convert image to base64
                    $encoded_image = base64_encode(file_get_contents($_FILES['uploadFile']['tmp_name']));
                    $encoded_image = 'data:image/' . $ext . ';base64,' . $encoded_image;
                    $query = "UPDATE `parents` SET `profile_image` = '".mysqli_real_escape_string($link,  $encoded_image)."'  WHERE id= '" . mysqli_real_escape_string($link, $_SESSION['p_id']) . "' LIMIT 1";
                    mysqli_query($link, $query);
                    require("db/db.php");
                     mysqli_query($con, "UPDATE `comments` SET `profile_image`= '".mysqli_real_escape_string($link,  $encoded_image)."'  WHERE p_id= '" . mysqli_real_escape_string($link, $_SESSION['p_id']) . "' LIMIT 1");
                                     }


                    if(mysqli_affected_rows($link) > 0) {
                        echo "Status : Picture Updated";
                        echo "<br>";

                    } else {
                        echo "Status : Failed to upload!";
                    }
                } else {
                    echo "File not allowed";
                }
            }


        ?>
        <br>
         <?php
                                $query = "(SELECT * FROM `parents` WHERE id= '" . mysqli_real_escape_string($link, $_SESSION['p_id']) . "') " ;
                        $result = mysqli_query($link, $query) ;
                        $row = mysqli_fetch_array($result) ;
                                echo '<img id="A" src="'.$row['profile_image'].'" >';

                                ?>


                                    </div>
                                </div>









                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                 <br>
                                   <?php
                                        if (array_key_exists("submit1", $_POST))
                                            {
                                                  $query = "UPDATE `parents` SET `name` = '".mysqli_real_escape_string($link,  $_POST['username'])."'  WHERE id= '" . mysqli_real_escape_string($link, $_SESSION['p_id']) . "' LIMIT 1";
                                        $name= $_POST['username'];
                    mysqli_query($link, $query);

                                   require("db/db.php");
                     mysqli_query($con, "UPDATE `comments` SET `name`= '".mysqli_real_escape_string($link,  $_POST['username'])."'  WHERE p_id= '" . mysqli_real_escape_string($link, $_SESSION['p_id']) . "' LIMIT 1");
                                     }
                                   ?>
                                <form method="post">

                                    <label for="exampleInputEmail1"><b>User Name</b></label>
                                    <?php
                                     $query = "(SELECT * FROM `parents` WHERE id= '" . mysqli_real_escape_string($link, $_SESSION['p_id']) . "') " ;
                        $result = mysqli_query($link, $query) ;
                        $row = mysqli_fetch_array($result) ;
                                             $name=$row['name'];
                echo ' <input type="text" class="form-control" name="username" id="username" placeholder="User Name" value="'.$name.'"    required> ';

                ?>


                                        <br>
                                        <br>

                                          <div style="text-align:center;">
                                         <button style="width:120px;"  id="btnSubmit1" type="submit" name="submit1" class="btn btn-primary">Submit</button>
                                         </div>
                                   </form>


                                </div>








                                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

                                    <form method="post" id="form">
                                        <div>
                                            <br>

                                            <div class="form-group">
                                                <label for="inputPassword6"><b>Current Password</b></label>
                                                <input type="password" id="pass0" placeholder="Current password" name="password0" class="form-control " aria-describedby="passwordHelpInline" required>
                                                <br>
                                                <label for="inputPassword6"><b>New Password</b></label>
                                                <input type="password" id="pass1" placeholder="New password" name="password" class="form-control " aria-describedby="passwordHelpInline" required>
                                                <br>

                                                <label for="inputPassword6"><b>Confirm Password</b></label>
                                                <input type="password" name="password1" class="form-control " aria-describedby="passwordHelpInline" placeholder="confirm password" id="pass2" required>
                                                <br>


                                            </div>



                                              <div style="text-align:center;">
                                            <button style="width:120px;"  id="btnSubmit" type="submit" name="submit" class="btn btn-primary">Submit</button>
                                              </div>
                                        </div>
                                    </form>
                                         <?php
                                        if (array_key_exists("submit", $_POST)){
                                                $hashpass =md5(md5($row['id']) . $_POST['password0']) ;
                                                if ($hashpass == $row['password']) {
                                                        $query = "UPDATE `parents` SET `password` = '" . md5(md5($_SESSION['p_id']) . $_POST['password']) . "'  WHERE id= '" . mysqli_real_escape_string($link, $_SESSION['p_id']) . "' LIMIT 1";

                    mysqli_query($link, $query);
                                                       echo '<script language="javascript">' ;
                                                        echo 'alert("Password Changed.")' ;
                                                        echo '</script>' ;

                                                 }
                                                 else{
                                                        echo '<script language="javascript">' ;
                                                        echo 'alert("Entered Password is wrong.")' ;
                                                        echo '</script>' ;
                                                 }
                                     }
                                           //$_POST = array();
                                            //$_GET = array();
                                        ?>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <!-- ./Tabs -->

            <script src="js/jquery.min.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="js/bootstrap.min.js"></script>
            <script src="parsley.min.js"></script>

             <script type="text/javascript">
    $(function()
      {
        $("#btnSubmit1").click(function()
          {

            if ($("#username").val() == "" ) {
              alert("Username is required.");
              return false;

            }

            return true;

          }
        );




      $("#delete").click(function()
          {

            let isBoss = confirm("Are you sure?");
              if(isBoss == true){
                  return true;
              }
              return false;

          }
        );



        $("#btnSubmit").click(function()
          {

            if ($("#pass0").val() == "" ) {
              alert("All fields are required.");
              return false;

            }

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
