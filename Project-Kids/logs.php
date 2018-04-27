<?php
 session_start();
    if( $_SESSION['s_id'] != ""){
             // header("Location:afterlogins.php") ;
    }

    //$_SESSION['val']=2;
   if(array_key_exists("p_id",$_COOKIE)){

      // $_SESSION['p_id']=$_COOKIE['p_id'];
    }

    if(array_key_exists("p_id",$_SESSION)){
       // echo "<p>Logged In! <a href='index.php?logoutp=2'>logout</a></p>";

    }else{

    }
    //$_SESSION['val']=2;
   if(array_key_exists("p_id",$_COOKIE)){

     //  $_SESSION['p_id']=$_COOKIE['p_id'];
    }
      require("db/db.php");
    if(array_key_exists("p_id",$_SESSION)&& ($_SESSION['p_id']) !='0'){
       // echo "<p>Logged In! <a href='index.php?logoutp=2'>logout</a></p>";




    $pid=$_SESSION['p_id'];
    $sid=$_SESSION['ids'];
       require("db/db.php");
   $query = "(SELECT * FROM `parents` WHERE id= '" . mysqli_real_escape_string($con, $_SESSION['p_id']) . "') " ;
      $result = mysqli_query($con, $query) ;
      $rowp= mysqli_fetch_array($result) ;




$result = mysqli_query($con, "SELECT * FROM comments   WHERE s_id = ".$sid." AND p_id != ".$pid."  ORDER BY id ASC");
while($row=mysqli_fetch_array($result)){
    $query = "(SELECT * FROM `parents` WHERE id= '" . mysqli_real_escape_string($con, $row['p_id']) . "') " ;
      $result1 = mysqli_query($con, $query) ;
      $rowp= mysqli_fetch_array($result1) ;
echo "<div class='comments_content'>";
//echo "<h4><a href='delete.php?id=" . $row['id'] . "'> X</a></h4>";
$namep="    ".$row['name'].""  ;

 echo '<p class="h11"><img id="A1" src="'.$row['profile_image'].'">';
echo "" . $row['name'] . "</p>";

echo "<p class='h22'>" . $row['date_publish'] . "</p><td>";
echo "<p class='h33'> Rated : " . $row['rating'] . " out of 5</p></br></br></td>";
echo "<p class='h44'>" . $row['comments'] . "</p>";
echo "</div>";
}
}


if( ($_SESSION['p_id'])=='0') {

     $pid=$_SESSION['p_id'];
    $sid=$_SESSION['ids'];
    require("db/db.php");
           $result = mysqli_query($con, "SELECT * FROM comments   WHERE s_id = ".$sid."   ");

while($row=mysqli_fetch_array($result)){
    $query = "(SELECT * FROM `parents` WHERE id= '" . mysqli_real_escape_string($con, $row['p_id']) . "') " ;
      $result1 = mysqli_query($con, $query) ;
      $rowp= mysqli_fetch_array($result1) ;
echo "<div class='comments_content'>";
//echo "<h4><a href='delete.php?id=" . $row['id'] . "'> X</a></h4>";


 echo '<p class="h11"><img id="A1" src="'.$row['profile_image'].'">';
echo "" . $row['name'] . "</p>";

echo "<p class='h22'>" . $row['date_publish'] . "</p><td>";
echo "<p class='h33'> Rated : " . $row['rating'] . " out of 5</p></br></br></td>";
echo "<p class='h44'>" . $row['comments'] . "</p>";
echo "</div>";
echo"<br>";
}


    }








?>
<style>
 #A1{
    width:70px;
    height:70px;
    border-radius: 50%;
    background-color:red;
}
.comments_content{
    margin:5px;
	padding:5px;
	border:1px solid #CCC;
}
.comments_content{
	margin:10px;
	padding:5px;
	border:1px solid #CCC;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
}

</style>

