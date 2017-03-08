<?php
    if(!isset($current_page))
        $current_page = '';
?>
<!--Entire navbar is placed here -->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" style="padding:7px 5px 0px 8px;" href="#" style="text-align:center;"><img style="display:inline-block;" src="images/icons/terror.png" width="50x" height="50px"> Car-Pool</a>
    </div>

    <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-2" aria-expanded="false" style="height: 1.11667px;">
      <ul class="nav navbar-nav navbar-right">
        <li <?=$current_page=='home'?"class='active'":"";?> ><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Explore Site<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Gallery</a></li>
            <li><a href="#">Reviews</a></li>
            <li><a href="#"></a></li>
            <li class="divider"></li>
            <li><a href="#">Our Team</a></li>
            <li class="divider"></li>
            <li><a href="#">Help</a></li>
          </ul>
        </li>
        <li <?=$current_page=='faq'?"class='active'":"";?> ><a href="#faq">FAQ</a></li>
        <li <?=$current_page=='contact'?"class='active'":"";?> ><a href="#">Contact</a></li>
        <li <?=$current_page=='about'?"class='active'":"";?> ><a href="#">About Us</a></li>
        <li <?=$current_page=='signup'?"class='active'":"";?> ><a href="signup.php">Sign-Up</a></li>
        <li <?=$current_page=='login'?"class='active'":"";?> ><a href="login.php">Log-In</a></li>
        
      </ul>
      <!--Searchbar is hidden for now -->
      <!-- <form class="navbar-form navbar-right" role="search">
        <div class="form-group">
          <input class="form-control" placeholder="Search" type="text">
        </div>
        <button type="submit" class="btn btn-outline-primary">Submit</button>
      </form> -->

    </div>
  </div>
</nav>