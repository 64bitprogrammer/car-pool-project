<?php
    if(!isset($current_page))
        $current_page = '';
?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><span title="Hi" class="glyphicon glyphicon-star"></span></a>
    </div>

    <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-2" aria-expanded="false" style="height: 1.11667px;">
      <ul class="nav navbar-nav navbar-right">
        <li <?=$current_page=='dashboard'?"class='active'":"";?> ><a href="../index.php">Home <span class="sr-only">(current)</span></a></li>
        <!-- <li class="dropdown">
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
        </li> -->
      </ul>
    </div>
  </div>
</nav>
