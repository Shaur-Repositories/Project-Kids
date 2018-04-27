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
     $link = mysqli_connect("localhost", "root", "", "user") ;
        if (mysqli_connect_error()) {
        die("database connection failed") ;
        }
    if(isset($_GET['id']) && !empty($_GET['id'])){
     $ids= $_GET['id'];
     echo $ids;
     $_SESSION['ids']=$ids;
     $query = "SELECT * FROM `schools` WHERE id = '" . mysqli_real_escape_string($link, $ids) . "' ";
    $result = mysqli_query($link, $query);

    if(mysqli_num_rows($result) == 0){
         echo '<script type="text/javascript">';
        echo 'alert ("Invalid Url.")';

        echo '</script>';
      header("Location:index.php") ;
    }
   }
    else{
       header("Location:index.php") ;
    }
    $link = mysqli_connect("localhost", "root", "", "user") ;
        if (mysqli_connect_error()) {
        die("database connection failed") ;
        }
        else{
            $query = "(SELECT * FROM `schools` WHERE id= '" . mysqli_real_escape_string($link, $ids) . "') " ;
            $result = mysqli_query($link, $query) ;
            $row = mysqli_fetch_array($result) ;
            echo "Welcome...... ".$row['name']."";


        }
        //$_POST = array();
       // $_GET = array();



       require("db/db.php");

                                    if (array_key_exists("delete", $_POST))
                                            {
                                                  $query = "DELETE from `comments`  WHERE p_id= '" . mysqli_real_escape_string($link, $_SESSION['p_id']) . "' AND  s_id= '" . mysqli_real_escape_string($con, $ids) . "'";
                    mysqli_query($con, $query);

        }



                                if (array_key_exists("post", $_POST))
                                            {

                                            $pid=$_SESSION['p_id'];
                                                      $sid=$ids;
                                                    $name = $_POST['name'];
                                                    $comments = $_POST['comments'];
                                                    $rate = $_POST['rating'];
                                            require("db/db.php");
                                    $result = mysqli_query($con, "SELECT * FROM comments   WHERE s_id = ".$sid." AND p_id=".$pid."  ORDER BY id ASC");

      if ((mysqli_num_rows($result) == 0)){
          $result7 = mysqli_query($con, "SELECT * FROM `parents`   WHERE id= '" . mysqli_real_escape_string($con, $_SESSION['p_id']) . "' ");
         $row4=mysqli_fetch_array($result7) ;

                                        $image=$row4['profile_image']  ;


                                                    mysqli_query($con, "INSERT INTO comments(name, comments, p_id,s_id,rating,profile_image) VALUES('$name','$comments','$pid','$sid','$rate','$image')");
                                            }

                                         }



                                    if (array_key_exists("update", $_POST))
                                            {
                                                  $query = "UPDATE `comments` SET `comments` = '".mysqli_real_escape_string($link,  $_POST['comments'])."' ,`rating` = '".mysqli_real_escape_string($con,  $_POST['rating'])."'  WHERE p_id= '" . mysqli_real_escape_string($con, $_SESSION['p_id']) . "' AND s_id= '" . mysqli_real_escape_string($con, $ids) . "'";
                    mysqli_query($con, $query);
                                            }




    
?>
<html>
<head>

<link href="css1/style.css" rel="stylesheet" type="text/css">
<link href="css1/reset.css" rel="stylesheet" type="text/css">
<title>Comment Box</title>

<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
   <script type="text/javascript" src="jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="jquery-ui/jquery-ui.css">
    <script type="text/javascript" src="jquery-ui/jquery-ui.js"></script>
    <script language="javascript" src="jquery.js"></script>
     <script type='text/javascript' src='unitegallery/js/jquery-11.0.min.js'></script>
<script>

	function commentSubmit(){
		if(form1.name.value == '' && form1.comments.value == ''){ //exit if one of the field is blank
			alert('Enter your message !');
			return;
		}
		var name = form1.name.value;
		var comments = form1.comments.value;
		var rating = form1.rating.value;
		var xmlhttp = new XMLHttpRequest(); //http request instance
       
		
		xmlhttp.onreadystatechange = function(){ //display the content of insert.php once successfully loaded
			if(xmlhttp.readyState==4&&xmlhttp.status==200){
				document.getElementById('comment_logs').innerHTML = xmlhttp.responseText; //the chatlogs from the db will be displayed inside the div section
			}
		}
		xmlhttp.open('GET', 'insert.php?name='+name+'&rating='+rating+'&comments='+comments, true); //open and send http request
		xmlhttp.send();
	}
	
		$(document).ready(function(e) {
			$.ajaxSetup({cache:false});
			setInterval(function() {$('#comment_logs').load('logs.php');}, 1000);
		});
		
</script>







     <script type='text/javascript' src='unitegallery/js/jquery-11.0.min.js'></script>


	<script type='text/javascript' src='unitegallery/js/ug-common-libraries.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-functions.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-thumbsgeneral.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-thumbsstrip.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-touchthumbs.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-panelsbase.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-strippanel.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-gridpanel.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-thumbsgrid.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-tiles.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-tiledesign.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-avia.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-slider.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-sliderassets.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-touchslider.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-zoomslider.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-video.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-gallery.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-lightbox.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-carousel.js'></script>
	<script type='text/javascript' src='unitegallery/js/ug-api.js'></script>

	<link rel='stylesheet' href='unitegallery/css/unite-gallery.css' type='text/css' />

	<script type='text/javascript' src='unitegallery/themes/default/ug-theme-default.js'></script>
	<link rel='stylesheet' 		  href='unitegallery/themes/default/ug-theme-default.css' type='text/css' />















    <style>
     .nav-link:hover {
                text-decoration-line: underline;
                font-family: cursive;
            }
         #A{
    width:200px;
    height:200px;
    /*border-radius: 50%; */
    background-color:red;
}

    #test{

            display: inline-block;
    float: left;

    }
    #container1{

          margin:0 auto;
          margin-left:35%;
          max-width:500px;
          width:calc(100% - 100px);

    }
    #info{

        text-align:right;

         margin-right:15px;
        padding-top:40px;
        padding-right:4px;
         display: inline-block;
        margin-left:50px;
       margin-bottom:50px;


    }
    #gallery{


        margin:0 auto;

    }
    #aboutus{

        max-width:400px;
        margin: 0 auto;
        align-self:center;
        width: calc(100% - 100px);


    }
    html {
                background: url(photos/white.jpg) no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }

            body {
                background: none;
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
                    <li><a style="color:red " href="afterloginp.php" ><button type="button" name="delete" id="delete" class="btn btn-danger">  Back</button></a></li>
                </ul>

                  </div>

        </nav>


        <br>
        <br>
        <br>
        <br>
        <br>

          <div id="container1">
             <div id="test">
             <?php
                $photo=$row['profile_image'];
                if(empty($photo)){

               $path = 'default1.png';
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    $query = "UPDATE `schools` SET `profile_image` = '".mysqli_real_escape_string($link,  $base64)."'  WHERE id= '" . mysqli_real_escape_string($link, $ids) . "' LIMIT 1";
                    mysqli_query($link, $query);
                }
                $query = "(SELECT * FROM `schools` WHERE id= '" . mysqli_real_escape_string($link, $ids) . "') " ;
                  $result = mysqli_query($link, $query) ;
                  $row = mysqli_fetch_array($result) ;
                 echo '<img id="A" src="'.$row['profile_image'].'">';

            ?>
             </div>



         <div id= "info">
        <label style="color:red; font-size: 110%"><?php echo $row['name']; ?></label> <br>
        <label style="color:red; font-size: 100%"><?php echo $row['address']; ?></label>  <br>
        <label style="color:red; font-size: 100%"><?php echo $row['city']; ?>,<?php echo $row['state']; ?></label><br>
        <label style="color:red; font-size: 100%"><?php echo $row['contact']; ?></label><br>
        <label style="color:red; font-size: 100%"><?php echo $row['email']; ?></label>
        </div>
          </div>



             <?php
                $avg=0;
                $count=0;
             require("db/db.php");
                $result = mysqli_query($con, "SELECT * FROM comments   WHERE s_id = ".$ids."   ");
                if (mysqli_num_rows($result)> 0){
                while($row1=mysqli_fetch_array($result)){
                         $avg=$avg+$row1['rating'];
                         $count=$count+1;
                 }
                 $average=($avg/($count*5))*100;
                 echo "<div style='margin:0 auto;text-align:center' ><label >Rating : ". $average."%</label><br>(Reviewed by ".$count." people.)</div>";
                    }else{
                         echo "<div style='margin:0 auto;text-align:center' ><label ></label><br>(Reviewed by ".$count." people.)</div>";
                    }
             ?>

          <div id="aboutus">
        <br>
        <h3 style="">About Us</h3>
        <?php
        if($row['discription']==""){
        echo'<p style="color:red; font-size: 120%">something about you.</p>';
        echo'<p style="color:red; font-size: 80%">(Change this using edit profile.)</p>';
        }
        else{
          echo"<p style='color:red; font-size: 120%;word-wrap: break-word '>" .$row['discription']."</p>";
        }
        echo"<h3><br>Facalities</h3>";
        if($row['facality']==""){
        echo'<p style="color:red; font-size: 120%">something about you.</p>';
        echo'<p style="color:red; font-size: 80%">(Change this using edit profile.)</p>';
        }

        else{

          echo"<p style='color:red; font-size: 120% ;word-wrap: break-word'>" .$row['facality']."</p>";
        }
        ?>
        </div>


            <br>
        <br>





              <div id="gallery">

   	          <?php

			 $query = "(SELECT * FROM `photo` WHERE s_id= '" . mysqli_real_escape_string($link, $ids) . "') " ;
            $result = mysqli_query($link, $query) ;
			while($row=mysqli_fetch_array($result)){
			?>
            <img src="<?php echo $row['location']; ?>" >
				<?php
			}
		?>

    </div>


       <br>
       <br>
       <br>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
    <script src="parsley.min.js"></script>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
    jQuery(document).ready(function(){

			jQuery("#gallery").unitegallery();

		});
</script>

<?php








if(array_key_exists("p_id",$_SESSION) && ($_SESSION['p_id']) !=0){

$pid=$_SESSION['p_id'];
    $sid=$_SESSION['ids'];
       require("db/db.php");

       if(array_key_exists("addbook",$_POST)){
           $query = "(SELECT * FROM `bookmark` WHERE p_id= '" . mysqli_real_escape_string($con, $_SESSION['p_id']) . "' AND s_id = ".$sid.") " ;
      $result = mysqli_query($con, $query) ;
      if ((mysqli_num_rows($result) == 0)){
                 $query = "INSERT INTO `bookmark` (`p_id`,`s_id`) VALUES('" . mysqli_real_escape_string($con, $pid) . "',
'" . mysqli_real_escape_string($con, $sid) . "')";
mysqli_query($con, $query) ;
           $_POST = array();
       $_GET = array();
            }
         }
        if(array_key_exists("delbook",$_POST)){
                 $query = "DELETE FROM `bookmark` WHERE p_id= '" . mysqli_real_escape_string($con, $_SESSION['p_id']) . "' AND s_id = ".$sid."";
mysqli_query($con, $query) ;
        $_POST = array();
       $_GET = array();
            }


    $query = "(SELECT * FROM `bookmark` WHERE p_id= '" . mysqli_real_escape_string($con, $_SESSION['p_id']) . "' AND s_id = ".$sid.") " ;
      $result = mysqli_query($con, $query) ;
      if ((mysqli_num_rows($result) == 0)){
          echo'<form class="bookmark" method ="post">';
         echo' <button style=""  id="btnSubmit1" type="submit" name="addbook" class="btn btn-success">Bookmark This</button> ';
       echo'</form>';
      }
      if ((mysqli_num_rows($result) > 0)){
          echo'<form class="bookmark" method ="post">';
         echo' <button style=""  id="btnSubmit1" type="submit" name="delbook" class="btn btn-danger">Remove Bookmark</button> ';
       echo'</form>';
      }





    $pid=$_SESSION['p_id'];
    $sid=$_SESSION['ids'];
       require("db/db.php");



   $query = "(SELECT * FROM `parents` WHERE id= '" . mysqli_real_escape_string($con, $_SESSION['p_id']) . "') " ;
      $result = mysqli_query($con, $query) ;
      $rowp= mysqli_fetch_array($result) ;

      $result = mysqli_query($con, "SELECT * FROM comments   WHERE s_id = ".$sid." AND p_id=".$pid."  ORDER BY id ASC");
      if ((mysqli_num_rows($result) > 0)){



while($row=mysqli_fetch_array($result)){



  echo'<div id="container" style="min-width:300px">
   <div class="comment_input">

        <form  method="post" >
            <p class="h11"><img id="A1" src="'.$rowp['profile_image'].'">
        ' . $row['name'] .' </p><br><br>
         <label>Your Rating : </label>
        <select name="rating" id="" >
            <option value=' .$row["rating"].' > '.$row["rating"].'</option>
    		<option value="1">1</option>
    		<option value="2">2</option>
    		<option value="3">3</option>
    		<option value="4">4</option>
    		<option value="5">5</option>
    		</select>
            <textarea class="form-control" id="comments1" name="comments" placeholder="Leave Comments Here..." style="width:calc(50%-50px); height:100px;">'.$row["comments"].'</textarea></br></br>
            <button style="width:120px;"  id="btnSubmit4" type="submit" name="update" class="btn btn-primary">Update</button>
            <button style="width:120px;"  id="btnSubmit2" type="submit" name="delete" class="btn btn-danger">Delete</button>
        </form>

        </div>
        <div id="comment_logs">
    	Loading comments...
    </div>
    </div> ';

}
}else{

        echo' <div id="container" style="min-width:300px">

    <div class="comment_input">

        <form name="form1" method="post" >
            <textarea style="resize: none;text-align: justify; white-space: initial;word-wrap: break-word" readonly="readonly"    id="namep" rows="1" type="text" name="name" readonly >';

             $query = "(SELECT * FROM `parents` WHERE id= '" . mysqli_real_escape_string($link, $_SESSION['p_id']) . "') " ;
      $result = mysqli_query($link, $query) ;
      $row = mysqli_fetch_array($result) ;


        	echo $row["name"];

            echo'
            </textarea><br><br>
         <label>Your Rating : </label>
        <select name="rating" id="">
    		<option value="1">1</option>
    		<option value="2">2</option>
    		<option value="3">3</option>
    		<option value="4">4</option>
    		<option value="5">5</option>
    		</select>
            <textarea class="form-control" id="comments" name="comments" placeholder="Leave Comments Here..." style="width:calc(50%-50px); height:100px;"></textarea></br></br>
            <button id="btnSubmit3" style="width:120px;" type="submit" name="post"   class="btn btn-success">Post</button></br>

        </form>
    </div>
    <div id="comment_logs">
    	Loading comments...
    </div>
</div> ';

}

}
       if( ($_SESSION['p_id'])==0) {
           $pid=$_SESSION['p_id'];
    $sid=$_SESSION['ids'];
       require("db/db.php");


     echo' <div id="container" style="min-width:300px">
  <div id="comment_logs">

    </div>
    </div> ';
    ;

}

   $_POST = array();
       $_GET = array();


 ?>
 <style>
 #A1{
    width:70px;
    height:70px;
    border-radius: 50%;
    background-color:red;
}
.bookmark{
    margin:0 auto;
    width:150px;
}

</style>

<script>

$("#btnSubmit4").click(function() {
           if($("#comments1").val() == ""){
                              alert("Enter your review.");
                              return false;
                    }
                    return true;
    })




$("#btnSubmit3").click(function() {
           if($("#comments").val() == ""){
                              alert("Enter your review.");
                              return false;
                    }
                    return true;
    })


</script>



</body>
</html>