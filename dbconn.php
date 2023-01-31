  <?php
  define('DB_SERVER', 'localhost');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '');
  define('DB_NAME', 'floodranger');
  date_default_timezone_set('Asia/Taipei');

  try {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  } catch(PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
  }

  ?>
  <?php 
    // predefine global functions

    function date_formatter_military($date_param){
      $date_tmp = date_create($date_param);
      $date_formatted_tmp = date_format($date_tmp,"g:i:s A d-M-Y");
      return $date_formatted_tmp;
    }

    function date_only_formatter_military($date_param){
      $date_tmp = date_create($date_param);
      $date_formatted_tmp = date_format($date_tmp,"d-M-Y");
      return $date_formatted_tmp;
    }
  ?>