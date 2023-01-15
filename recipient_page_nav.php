<nav class="navbar  navbar-expand-lg navbar-light bg-white py-0 px-5">
      <a class="navbar-brand" href="#"><img src="images/floodranger_logo_colored.png" height="25"></a>

  <a class="navbar-brand" href="#"><?php echo $_SESSION['user_name']; ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      
    </ul>
    <span class="navbar-text">
        <a class="nav-item nav-link <?php echo ($display_page == "logout") ? "active": ""; ?> " href="logout.php">Logout</a>
    </span>
  </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light p-5 " hidden>
    <a class="navbar-brand" href="#"><img src="images/floodranger_logo_colored.png" height="25"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link <?php echo ($display_page == "homepage") ? "active": ""; ?> " href="recipient_homepage.php">Overview</a>
        <a class="nav-item nav-link <?php echo ($display_page == "data_privacy") ? "active": ""; ?> " href="recipient_data_privacy_notice.php">Data privacy notice</a>
      </div>
    </div>
     
  </nav>