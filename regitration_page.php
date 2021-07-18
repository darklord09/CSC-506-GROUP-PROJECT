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
    <h1>Registration Form</h1>
    <div class="row col-md-9">
      <form action="regitration_page.php" method="post">
        <label>First Name:</label>
        <input type="text" name="first_name" class="form-control"><br>

        <label>Surname:</label>
        <input type="text" name="sur_name" class="form-control"><br>

        <label>Email:</label>
        <input type="email" name="email" class="form-control"><br>

        <label>Phone Number:</label>
        <input type="text" name="phone_number" class="form-control"><br>

        <label>Address:</label>
        <input type="text" name="address" class="form-control"><br>

        <label>Password:</label>
        <input type="password" name="password" class="form-control"><br><br>

        <div class="form-row">
          <div class="form-group col-md-6">
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            <button type="reset" class="btn btn-warning" name="reset">Reset</button>
          </div>
        </div>

        <p><a href="login.php">Login here</a></p>
        
      </form>
      
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