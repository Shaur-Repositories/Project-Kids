<?php
    session_start();
    echo'<br>';
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
                echo'</t><t><div id=txt>'.$row['name']. '<br>'.$row['address']. '<br>'.$row['city'].','.$row['state']. '</div></t></a></div><br>';



			}
            echo'</div>';
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


                  echo '<div id="search"><a href="showprofile.php?id=' . $id . '"> <img src='.$row['profile_image'] .' height="100px;" width="100px;"><t>';
                if($row['verify']==0){
                      echo'<label id="verify" style="color:red; padding-left:6px;">Not Verified</label>';
                  }else{
                      echo'<label id="verify" style="color:green;padding-left:6px;">Verified</label>';
                  }
                echo'</t><t><div id=txt>'.$row['name']. '<br>'.$row['address']. '<br>'.$row['city'].','.$row['state']. '</div></t></a></div><br>';



			}
            echo'</div>';
    }

    }
    }


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
    <title>search</title>

        <script language="javascript" src="jquery.js"></script>
        <script type="text/javascript" src='state.js'></script>
<style>
#position1{
     width:500px;
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
#back{
    width: calc(100% - 100px);

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

</style>
</head>
    <body >

        <div id= position1>
 <div class="jumbotron1">
            <h1 class="display-4">With Love And Care</h1>
            <p class="lead"><b> Here you can find the best suitable play school for your little one.</b></p>
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
                <div id="selection">
                    <select id="listBox" onchange='selct_district(this.value)'></select>
                    <select name="city" id='secondlist'></select>
                </div>
                <div id="dumdiv" align="center" style=" font-size: 10px;color: #dadada;">
                    <button id="dum" name="search1" class="btn btn-primary btn-md" type="submit">Search</button>
                </div>
                </form>
            </div>
        </div>
        </div>



        <br>
        <br>
        <br>
        <br>




        <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="parsley.min.js"></script>

<script>
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
                    if($("#secondlist").val()=="SELECT CITY"){
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