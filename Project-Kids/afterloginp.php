<?php
    session_start();
    if( $_SESSION['s_id'] != ""){
              header("Location:afterlogins.php") ;
    }
    if( $_SESSION['p_id'] == '0'){
              header("Location:index.php") ;
    }
    //$_SESSION['val']=2;
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
  // $_POST = array();
  //$_GET = array();
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="jquery-ui/jquery-ui.css">
    <script type="text/javascript" src="jquery-ui/jquery-ui.js"></script>
    <script language="javascript" src="jquery.js"></script>
        <script type="text/javascript" src='state.js'></script>
    <title>parent-Profile</title>
    <style>
     .nav-link:hover {
                text-decoration-line: underline;
                font-family: cursive;
            }
    #position{
        margin : 0 auto;
        width:350px;
        padding-left:15px;
        padding-right:15px;
        padding-bottom:25px;

        text-align: center;
        font-size:130%
    }
     .display-4 {
                margin-top: 50px;
                font-style: cursive;
                color:black;
                font-family:cursive;
            }
     body{

     }
     #A{
    width:220px;
    height:220px;
    border-radius: 50%;
    background-color:red;
}
html {
                background: url(photos/default-1.jpg) no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }

            body {
                background: none;
            }

#position1{

     margin:0 auto;
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

    max-height:400px;
    margin:0 auto;
    background-color: white;
    padding-top:5px;
    overflow-y:scroll;
    border:black 2px solid;
    border-radius:2%;


}
#back3{
    width: calc(100% - 100px);
    max-height:400px;
    max-width:500px;
    margin:0 auto;
    background-color: white;
    padding-top:5px;
    overflow-y:scroll;
    border:black 2px solid;
    border-radius:2%;


}
#close{
     margin-bottom:3px;
     margin-left:3px;

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
        #back2{
            margin:0 auto;
            width:200px;
            text-align:center;
            border:black 2px solid;
            border-radius:5%;
        }


    </style>
</head>
    <body >
        <nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
            <a class="navbar-brand" href="#"><b><h1>Kids</h1></b></a>
            <div class="ml-auto">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
                </div>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav nav-link navbar-nav ml-auto">
                    <li><a style="color:red " href="editprofilep.php" >Edit Profile</a></li>
                </ul>
                <ul class="nav navbar-nav ">

                    <li class="nav nav-link navbar-nav ">


                     <a style="color:red "  href="index.php?logoutp=2" aria-haspopup="true" aria-expanded="false">


          Logout
          </a>
          </li>


                </ul>
                  </div>



        </nav>


        <br>
        <br>
        <br>
        <div id="position">
                <div class="jumbotron1">
            <h1 class="display-4">WELCOME</h1>

        <br>
        <br>
            <?php
                $photo=$row['profile_image'];
                if(empty($photo)){

               $path = 'default.png';
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    $query = "UPDATE `parents` SET `profile_image` = '".mysqli_real_escape_string($link,  $base64)."'  WHERE id= '" . mysqli_real_escape_string($link, $_SESSION['p_id']) . "' LIMIT 1";
                    mysqli_query($link, $query);
                }
                $query = "(SELECT * FROM `parents` WHERE id= '" . mysqli_real_escape_string($link, $_SESSION['p_id']) . "') " ;
                  $result = mysqli_query($link, $query) ;
                  $row = mysqli_fetch_array($result) ;
                 echo '<img id="A" src="'.$row['profile_image'].'">';

            ?>
          <br>
          <br>
        <p style="color:red; font-size: 120%"><?php echo $row['name']; ?></p>
         <br>
        <br>



                </div>
        </div>




        <div id="bookmark">
              <?php
              $link = mysqli_connect("localhost", "root", "", "user");
                   $query =  "(SELECT * FROM `bookmark` WHERE p_id = '" . mysqli_real_escape_string($link, $_SESSION['p_id']) . "' )";
       $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) == 0) {
        echo '<div id ="back2"><br><label style="font-size:150%;color:green;" value="BOOKMARKS">BOOKMARKS</label>';
        echo '<label style="font-size:120%;color:black;" value="BOOKMARKS">No Bookmarks</label><br>';
        echo '</div>';
        echo '</br>';
        echo '</br>';

    }else{


    if (mysqli_num_rows($result) > 0)
    {
                   echo '<div id="back3"> <label style="font-size:150%;color:green;" value="BOOKMARKS">BOOKMARKS</label>';
			while($rowp=mysqli_fetch_array($result)){
                  $id=$rowp['s_id'] ;

                  $query =  "(SELECT * FROM `schools` WHERE id = '" . mysqli_real_escape_string($link, $id) . "' and active= 1 )";
       $result2 = mysqli_query($link, $query);
       $row = mysqli_fetch_array($result2) ;


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

              ?>

        </div>





                  <div id= position1>
 <div class="jumbotron1">

            <p style="color:black">Search through name or by Location.</p>
            <form style="width :400px;align:center ; margin: 0 auto"method="post">
                <input class="form-control mr-sm-2" id="schoolname" name="schoolname" type="search" placeholder="Search" aria-label="Search">
                <button style="margin-top: 12px" id="search0" name="search0" class="btn btn-primary btn-lg" type="submit">Search</button>
            </form>
            <br>

            <div class='resp_code frms' style="margin :0 auto">
                <p align='center'><b>Choose Ur Locality</b></p>
                <form method="post">
                 <div id="state">
                 <label>Select State :</label>
                    <select id="listBox" onchange='selct_district(this.value)'></select>
                     </div>
                     <div id="city" >
    <label>Select&nbsp;&nbsp;&nbsp;City : </label>
                    <select name="city" id='secondlist'></select>
                     </div>
                <div id="dumdiv" align="center" style=" font-size: 10px;color: #dadada;">
                    <button id="dum" name="search1" class="btn btn-primary btn-lg" type="submit">Search</button>
                </div>
                </form>
            </div>
        </div>
        </div>

        <?php

    echo'<br>';
    echo'<br>';

    $link = mysqli_connect("localhost", "root", "", "user");
    if (mysqli_connect_error()) {
        die("database connection failed");
    }
    if (array_key_exists("search0", $_POST)){
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



    if (array_key_exists("search1", $_POST)){
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
<script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="parsley.min.js"></script>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields

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
