<?php

    session_start();
    if( $_SESSION['s_id'] != ""){
              header("Location:afterlogins.php") ;
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

    
    $pid=$_SESSION['p_id'];
    $sid=$_SESSION['ids'];



  $query = "(SELECT * FROM `parents` WHERE id= '" . mysqli_real_escape_string($link, $_SESSION['p_id']) . "') " ;
      $result = mysqli_query($link, $query) ;
      $rowp= mysqli_fetch_array($result) ;


$name = $_REQUEST['name'];
$comments = $_REQUEST['comments'];
$rate = $_REQUEST['rating'];


require("db/db.php");

mysqli_query($con, "INSERT INTO comments(name, comments, p_id,s_id,rating) VALUES('$name','$comments','$pid','$sid','$rate')");
/*
$result = mysqli_query($con, "SELECT * FROM comments ORDER BY id ASC");
while($row=mysqli_fetch_array($result)){
echo "<div class='comments_content'>";
//echo "<h4><a href='delete.php?id=" . $row['id'] . "'> X</a></h4>";
echo "<h1>" . $row['name'] . "</h1>";
echo "<h2>" . $row['date_publish'] . "</h2></br></br>";
echo "<h3>" . $row['comments'] . "</h3>";
echo "</div>";
}  */

?>