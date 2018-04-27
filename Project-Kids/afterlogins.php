<?php
     session_start();
    if( $_SESSION['p_id'] != ""){
              header("Location:afterloginp.php") ;
    }
   // $_SESSION['val']=1;
    if(array_key_exists("s_id",$_COOKIE)){

        $_SESSION['s_id']=$_COOKIE['s_id'];
    }

    if(array_key_exists("s_id",$_SESSION)){

        echo "<p>Logged In! <a href='index.php?logouts=1'>log out</a></p>";


    }else{
        header("Location:index.php") ;
    }
    $link = mysqli_connect("localhost", "root", "", "user") ;
        if (mysqli_connect_error()) {
        die("database connection failed") ;
        }
        else{
            $query = "(SELECT * FROM `schools` WHERE id= '" . mysqli_real_escape_string($link, $_SESSION['s_id']) . "') " ;
            $result = mysqli_query($link, $query) ;
            $row = mysqli_fetch_array($result) ;
            echo "Welcome...... ".$row['name']."";


        }
        //$_POST = array();
        //$_GET = array();
?>


<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="jquery-ui/jquery-ui.css">




    <title>school-login</title>






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
    #test{

            display: inline-block;
    float: left;

    }

     #container{

          margin:0 auto;
          margin-left:35%;
          max-width:500px;
          width:calc(100% - 100px);



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
        padding-right:0px;
         display: inline-block;
        margin-left:30px;
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
                    <li><a style="color:red " href="editprofiles.php" >Edit Profile</a></li>
                </ul>
                <ul class="nav navbar-nav ">

                    <li class="nav nav-link navbar-nav ">
                        <a style="color:red "  href="index.php?logoutp=2" aria-haspopup="true" aria-expanded="false">
          Logout
        </a>  </li>


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
                    $query = "UPDATE `schools` SET `profile_image` = '".mysqli_real_escape_string($link,  $base64)."'  WHERE id= '" . mysqli_real_escape_string($link, $_SESSION['s_id']) . "' LIMIT 1";
                    mysqli_query($link, $query);
                }
                $query = "(SELECT * FROM `schools` WHERE id= '" . mysqli_real_escape_string($link, $_SESSION['s_id']) . "') " ;
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
                $ids=$_SESSION['s_id'];
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

			 $query = "(SELECT * FROM `photo` WHERE s_id= '" . mysqli_real_escape_string($link, $_SESSION['s_id']) . "') " ;
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
       <?php

           $_SESSION['p_id']=0;
    $sid=$_SESSION['s_id'];
    $_SESSION['ids']=$_SESSION['s_id'];;
       require("db/db.php");

      echo "<br>";
      echo "<br>";
      echo "<p style='text-align:center'>Comments </p>";
     echo' <div id="container3" style="min-width:300px">
  <div id="comment_logs">

    </div>
    </div> ';


       ?>
       <br>
       <br>



     <style>

#container3 {
     max-width:500px;
     margin:0 auto;
     width:calc(100%-100px);
     padding:20px;

}



     </style>






    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="parsley.min.js"></script>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields

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

 jQuery(document).ready(function(){

			jQuery("#gallery").unitegallery();

		});
</script>

</body>

</html>