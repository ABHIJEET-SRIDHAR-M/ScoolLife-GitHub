<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Case</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="navbarCssStyling.css">
  
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
	  <!-- Image pixels - 150 horizontal and 50 vertical-->
	  <a href="#" class="pull-left"><img src="../images/logo.png"></a>
      &nbsp &nbsp &nbsp
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#"><span class="glyphicon glyphicon-home">&nbsp </span>Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-th-list">&nbsp </span> Benefits <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#"><span class="glyphicon glyphicon-gift">&nbsp </span>To Students</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-calendar">&nbsp </span>To Schools</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-shopping-cart">&nbsp </span>To Parents</a></li>
          </ul>
        </li>
        <li><a href="#"><span class="glyphicon glyphicon-education">&nbsp </span>School Portal </a></li>
        <li><a href="#"><span class="glyphicon glyphicon-eye-open">&nbsp </span> Parents Portal </a></li>
		
		<li>&nbsp &nbsp <button class="btn btn-danger navbar-btn"><span class="glyphicon glyphicon-phone-alt"> </span> &nbsp We're Hiring</button></li>
      </ul>
		<!-- This is for right hand side navbar if required 
	  <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
	  
		 Right navbar end -->
    </div>
  </div>
</nav>

</body>
</html>
