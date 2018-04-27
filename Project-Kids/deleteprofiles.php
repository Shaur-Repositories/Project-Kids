<?php

   session_start();
    if( $_SESSION['p_id'] != ""){
              header("Location:afterlogins.php") ;
    }
    //$_SESSION['val']=2;
   if(array_key_exists("s_id",$_COOKIE)){

       $_SESSION['s_id']=$_COOKIE['p_id'];
    }

    if(array_key_exists("s_id",$_SESSION)){
        echo "<p>Logged In! <a href='index.php?logoutp=2'>logout</a></p>";

    }else{
        header("Location:index.php");
    }

    $link = mysqli_connect("localhost", "root", "", "user") ;
        if (mysqli_connect_error()) {
        die("database connection failed") ;
        }
        else{
            $query = "(SELECT * FROM `schools` WHERE id= '" . mysqli_real_escape_string($link, $_SESSION['s_id']) . "') " ;
            $result = mysqli_query($link, $query) ;
            $row = mysqli_fetch_array($result) ;
        // echo "Welcome...... ".$row['name']."";

        }
        if (array_key_exists("deleteprofiles", $_GET)) {
                    $query = "DELETE from `schools`  WHERE id= '" . mysqli_real_escape_string($link, $_SESSION['s_id']) . "' LIMIT 1";
                    mysqli_query($link, $query);


                    $query = "(SELECT * FROM `photo` WHERE s_id= '" . mysqli_real_escape_string($link, $_SESSION['s_id']) . "') " ;
            $result = mysqli_query($link, $query) ;
			while($row=mysqli_fetch_array($result)){

                  $query = "DELETE from `photo`  WHERE s_id= '" . mysqli_real_escape_string($link, $_SESSION['s_id']) . "' LIMIT 1";
                    mysqli_query($link, $query);
}


                        $query = "(SELECT * FROM `comments` WHERE s_id= '" . mysqli_real_escape_string($link, $_SESSION['s_id']) . "') " ;
            $result = mysqli_query($link, $query) ;
			while($row=mysqli_fetch_array($result)){
                       $query = "DELETE from `comments`  WHERE s_id= '" . mysqli_real_escape_string($link, $_SESSION['s_id']) . "'";
                    mysqli_query($link, $query);

               }

                $query = "(SELECT * FROM `bookmark` WHERE s_id= '" . mysqli_real_escape_string($link, $_SESSION['s_id']) . "') " ;
            $result = mysqli_query($link, $query) ;
			while($row=mysqli_fetch_array($result)){
                       $query = "DELETE from `bookmark`  WHERE s_id= '" . mysqli_real_escape_string($link, $_SESSION['s_id']) . "'";
                    mysqli_query($link, $query);

               }


                    header("Location:index.php?logoutp=2") ;
            }else{
                    header("Location:afterlogins.php") ;
            }














 //  $_POST = array();
  //$_GET = array();

?>