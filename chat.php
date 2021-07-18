<?php session_start();
    include("includes/connection.php");
   if(!isset($_SESSION['id'])){
    header("location:login.php?ref_denied");
    }else{
   @$firstName = $_SESSION['firstName'];
   @$surName = $_SESSION['surName'];
   @$phone_number = $_SESSION['phone_number'];
   @$email = $_SESSION['email'];
   @$address = $_SESSION['address'];
?>

 <?php

  //users' post, inserting into database

  if (isset($_POST['post'])) {
    $post = $_POST['post'];
    $user_id = $_SESSION['id'];

    //inserting into database
    $insert = $dbconnect->query("INSERT INTO chat (post,user_id )VALUES('$post', '$user_id')") or die($dbconnect->error); 

    if ($insert = $dbconnect->affected_rows =="1"){
      echo '<script>alert("post sent Succesful")</script>';
    }else{
      echo '<script>alert("Fail to send post")</script>';
    }
  }
?> 

<?php
  // fetch user post from database to display
  $fetch_post = $dbconnect->query("SELECT * FROM chat ORDER BY id DESC") or die($dbconnect->error); 
  $post ="";
  foreach ($fetch_post as $p) { 
   $post .= htmlspecialchars( $p['post'])."

    <form action='chat.php?comment=true&post_id=".$p['id']."' method='POST'>
    <textarea class='form-control input-md' rows='2' cols='20' name='comment_body'></textarea><br>
    <button type='submit' class='btn btn-default' name='comment'>Comment</button>
    </form>
   <br><hr class='hr'>";
  }
?>



<?php
  //collecting user information
  include("includes/connection.php");
  if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $sur_name = $_POST['sur_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $password = sha1($_POST['password']);

    //inserting into database
    $insert = $dbconnect->query("INSERT INTO users (firstName, surName, email, address, phoneNumber, password) VALUES('$first_name', '$sur_name', '$email', '$address', '$phone_number', '$password')") or die($dbconnect->error); 

    if ($insert = $dbconnect->affected_rows =="1"){
      echo '<script>alert("Registration Succesful")</script>';
    }else{
      echo '<script>alert("Registration Fail")</script>';
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
    <title>Registration Page</title>

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

    #dropdown1 {
      margin: 8px;
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
     #scroll{
    margin: 4px, 4px;
    padding: 4px;
    background-color: #ccc;
    color: #fff;
    width: 400px;
    height: 450px;
    overflow-x: hidden;
    overflow-y: auto;
    text-align: justify;
    border-radius: 10px;
  }
  .hr{
    width: 800%;
    height: 2px;
    background-color: maroon;
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
          <li class="active"><a href="#home">Registration Page</a></li>
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
    

    <!--Registration form-->
  <div class="container">
    <h1>ENGAGING WITH FRIENDS</h1>
    <div class="row col-md-9">
      <form action="chat.php" method="post">
        <div class="form-group col-md-6">
        <label for="comment">Your Post:</label>
        <textarea class="form-control input-md" id="comment" name="post"></textarea><br>
        <div class="btn-btn-inline">
          <button class="btn btn-primary" name="send"> Send</button>
        </div>
      </div>
      </form>

      <div class="form-group col-md-6" id="scroll">
        <p>Your Chat Comes Here</p>
          <?php echo "$post" ; ?>
        </div>
      
    </div>
  </div>
    
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