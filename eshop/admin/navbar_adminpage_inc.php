<!navbar bootstrap>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Send Fresh Flowers</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
	  <ul class="nav navbar-nav">
        <li id = "vieworders"><a href="admin_user.php">View Orders <span class="sr-only">(current)</span></a></li>
        <li id = "addproducts"><a href="admin_dashboard_editproduct.php">Products Dashboard</a></li>
<?php
if (getfield('admin','location','id',$_SESSION['admin_id']) == 273){
?>
		<li id = "manageadmin"><a href="admin_manageadmin.php">Manage Admins</a></li>
<?php
}
?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user" style = "color:blue"></span>
			<?php echo getfield('admin','firstname','id',$_SESSION['admin_id']); ?>
		  <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Edit Profile</a></li>
            <li><a href="#">Account Settings</a></li>
            
          </ul>
        </li>
		<li><a href="logout.php">Signout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
