<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Practikhan</title>
  <meta name="description" content="Practikhan is a platform for managing khan exercises">
  <meta name="author" content="Practikhan">
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <base href="<?=$this->config->item('base_url')?>" />

  <link href='//fonts.googleapis.com/css?family=Stardos+Stencil:700' rel='stylesheet' type='text/css'>  
  <link rel="stylesheet/less" type="text/css" href="css/bootstrap.less">
  <link rel="stylesheet/less" type="text/css" href="css/practikhan.less">
  <script src="js/less-1.3.0.min.js" type="text/javascript"></script>
</head>
<body>
  
  <div class="container main">

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="#">
            Practikhan
          </a>
          <ul class="nav">
            <li class="active">
              <a href="browse">Browse</a>
            </li>
            <li><a href="search">Search</a></li>
          </ul>

          <!-- User is logged in -->
          <?php if ($logged_in) { ?>
          <ul class="nav pull-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?=$person_data['firstname']?> <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li><a href="account/edit">Edit Account</a></li>
                <li><a href="help">Help</a></li>
                <li class="divider"></li>
                <li><a href="logout">Logout</a></li>
              </ul>
            </li>
          </ul>
          <!-- User is not logged in -->
          <?php } else { ?>
          <ul class="nav pull-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                Log In
              </a>
              <ul class="dropdown-menu">
                <form id="loginForm" class="loginForm" action="<?=base_url()?>login" method="post" onsubmit="return false;">
                  <input type="text" id="loginEmail" class="input-large" placeholder="Email">
                  <input type="password" id="loginPassword" class="input-large" placeholder="Password">
                  <div>
                    <label class="checkbox rememberme pull-left">
                      <input type="checkbox"> Remember me
                    </label>
                    <button type="submit" class="btn pull-right">Log in</button>
                  </div>
                </form>
              </ul>
            </li>
          </ul>
          <a class="pull-right btn btn-primary" data-toggle="modal" href="#registerModal">Register</a>
          <?php } ?>

        </div>
      </div>
    </div>
