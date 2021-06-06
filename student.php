<?php session_start();
    include("includes/connection.php");
   if(!isset($_SESSION['user_id'])){
    header("location:login.php?ref_denied");
    }else{
   @$firstName = $_SESSION['firstName'];
   @$surName = $_SESSION['surName'];
   @$phone_number = $_SESSION['phone_number'];
   @$email = $_SESSION['email'];
   @$address = $_SESSION['address'];
?>
<?php
  if(isset($_GET['ref_denied'])){
    //promting user to login
    $login = "<span class='error'>You need to log in first</span>";
  }
?>

<?php 
//loging out
  if(isset($_GET['logout'])){
    session_destroy();
    header("location:login.php");
    exit();
  }
?>
<?php
  if (isset($_POST["upload"])) {
    $viewId = $_SESSION['user_id'];
    $profile_image = $_FILES['photo']['name'];
    $extentsion = strtolower(substr($profile_image, strpos($profile_image, '.') + 1));
    $file_size = $_FILES['photo']['size'];
    $file_type = $_FILES['photo']['type'];
    $file_tem_loc = $_FILES['photo']['tmp_name'];
    $file_store = "images/" . $profile_image;
    

    if (($extentsion == 'jpg' || $extentsion == 'jpeg' || $extentsion == 'png') && $file_type =='image/jpeg') {

      if (move_uploaded_file($file_tem_loc, $file_store)) {
    $updateRecord = $dbconnect->query("UPDATE users SET photo ='$profile_image' WHERE user_id = '$viewId'") or die ("fail to update record:" . $dbconnect->error);
    if ($updateRecord = $dbconnect->affected_rows =="1") {
         echo '<script>alert("Photograph Upload")</script>';
        }else{
          echo '<script>alert("Fail To Upload Photograph")</script>';
          }
    }
  }else{
    echo '<script>alert("Invalide File Format")</script>';
  }



  }

  
?>
               
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Profile Page</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      body {
        padding-top: 50px;
      }
      .starter-template {
        padding: 40px 15px;
        text-align: center;
      }
      #nav_wrapper {
        background: #fff;
        color: #aaa; 
        -webkit-box-shadow: #ddd 0px 4px 4px;
      }

    .photo{
      max-height: 30%;
      width: 70%;
    }
    .margintop {
      margin-top:50px;
    }
    
    .center{
      text-align:center;
    }
    .title {
      margin-top:100px;
      font-size:40px;
    }

    #footer {
      background: #ddd;
      height:45%; 
      width:100%;
      color: #aaa;
      padding-top: 50px;
      margin-top:450px;
      position: absolute;
      text-align:center;
    }
    </style>

  </head>
  <body>
    <div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" id="navManu">Galaxy Academy</a>
      </div> 
      
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav" id="navManu">
          <li class="active"><a href="#home"><?php echo "$firstName";?>'s Profile</a></li>
          <li><a href="login.php?logout" class="list-group-item" >
            <span class="glyphicon glyphicon-log-out"></span> Logout
          </a></li>
        </ul> 
      </div>
    </div>
  </div>
    <div class="jumbotron">
      <div class="container text-center">
        <h1>Galaxy Academy </h1>
            <p class="lead">Best Place To Learn</p>
      </div>
    </div><!--End Jumotron -->
    
  <section id="main">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <div class="container">
            <h1>Student Profile</h1>
            <div class="row col-md-9">

                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>First Name:</label>
                    <input type="text" name="first_name" class="form-control" value="<?php echo "$firstName";?>" disabled><br>
                    <span class="error-msg"></span>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Surname:</label>
                    <input type="text" name="sur_name" class="form-control" value="<?php echo "$surName";?>" disabled><br>
                    <span class="error-msg"></span>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control" value="<?php echo "$email";?>" disabled><br>
                    <span class="error-msg"></span>
                  </div>
                </div>
                
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Phone Number:</label>
                    <input type="text" name="phone_number" class="form-control" value="<?php echo "$phone_number";?>" disabled><br>
                    <span class="error-msg"></span>
                  </div>

                  <div class="form-group col-md-6">
                    <label>Address:</label>
                    <input type="text" name="address" class="form-control" value="<?php echo "$address";?>" disabled><br>
                    <span class="error-msg"></span>
                  </div>
                </div>
              
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="photo">
            <?php
                  $viewId = $_SESSION['user_id'];
                  $select = $dbconnect->query("SELECT * FROM users WHERE user_id = $viewId") or die ("Fail to fetch record<br/>" . $dbconnect->error);
                  if($select->num_rows>=1){
                  while($row = $select->fetch_assoc()){
                      echo '<img height="99" alt="profile Image" class="logo" width="99" src="images/'.$row['photo'].'">';
                    }
                  }
            ?>
              <form action="student.php" method="post" enctype="multipart/form-data">
                <input type="file" name="photo" class="form-control"><br>
              <button type="submit" class="btn btn-primary" name="upload">Upload</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
    
  <section>
      <div class="container" id="footer">
        <div class="row">
          <h1 class="title" >Galaxy Academy</h1>
          <p class="lead">Best place to learn</p>
          <p class="lead">Copyright &copy; 2021.</p>
        </div>
      </div>
  </section>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
<?php }?>