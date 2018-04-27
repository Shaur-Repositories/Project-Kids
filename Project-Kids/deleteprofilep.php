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
        if (array_key_exists("deleteprofilep", $_GET)) {
                    $query = "DELETE from `parents`  WHERE id= '" . mysqli_real_escape_string($link, $_SESSION['p_id']) . "' LIMIT 1";
                    mysqli_query($link, $query);

                    $query = "(SELECT * FROM `comments` WHERE p_id= '" . mysqli_real_escape_string($link, $_SESSION['p_id']) . "') " ;
            $result = mysqli_query($link, $query) ;
			while($row=mysqli_fetch_array($result)){
                       $query = "UPDATE `comments` SET `p_id` =9999   WHERE id= '" . mysqli_real_escape_string($link, $row['id']) . "'";
                    mysqli_query($link, $query);

               }



                $query = "(SELECT * FROM `bookmark` WHERE p_id= '" . mysqli_real_escape_string($link, $_SESSION['p_id']) . "') " ;
            $result = mysqli_query($link, $query) ;
			while($row=mysqli_fetch_array($result)){
                       $query = "DELETE from `bookmark`  WHERE p_id= '" . mysqli_real_escape_string($link, $_SESSION['p_id']) . "'";
                    mysqli_query($link, $query);

               }

                    header("Location:index.php?logoutp=2") ;
            }else{
                    header("Location:afterloginp.php") ; 
            }














 //  $_POST = array();
  //$_GET = array();

?>