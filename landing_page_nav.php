  <nav class="navbar navbar-expand-lg navbar-dark p-5 ">
      <a class="navbar-brand" href="#"><img src="images/floodranger_logo.svg" height="25"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link <?php echo ($display_page == "home") ? "active": ""; ?> " href="index.php" >Home </a>
          <a class="nav-item nav-link <?php echo ($display_page == "login") ? "active": ""; ?> " href="login.php">Login</a>
          <a class="nav-item nav-link <?php echo ($display_page == "water_level") ? "active": ""; ?> " href="water_level_info.php">Water level info</a>
          <a class="nav-item nav-link <?php echo ($display_page == "weather_info") ? "active": ""; ?> " href="weather_info.php">Weather info</a>
          <a class="nav-item nav-link <?php echo ($display_page == "about_us") ? "active": ""; ?> " href="about_us.php">About us</a>
      </div>
  </div>
</nav>