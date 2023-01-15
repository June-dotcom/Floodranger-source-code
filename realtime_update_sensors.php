
<?php 
// script to iterate all ultrasonic sensor 
// device list
$device_list = $pdo->query('SELECT * FROM devices WHERE authorized_user_id = $auth_user_id')->fetchAll();
foreach($device_list as $device_ent){
    $sensor_list = $pdo->query('SELECT * FROM sensor_profiles WHERE device_api_key = $device_ent->device_api_key')->fetchAll();
} 
?>

<?php

?>
<script>
// updated text every 1 second of request 
window.onload=function(){  
    <?php foreach ($sensor_list as $sensor_ent): ?>
      alert($sensor_ent->sensor_name);
    <?php endforeach ?>
    showCurrentWaterLevel('<?php echo $device_api_key; ?>');
    showDeviceState('<?php echo $device_api_key; ?>');
    showCurrentNetworkName('<?php echo $device_api_key; ?>');
    showDeviceStateAlert('<?php echo $device_api_key; ?>')
    }
    function showCurrentWaterLevel(str) {
      if (str.length == 0) {
        document.getElementById("water_level").innerHTML = "";
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("water_level").innerHTML = this.responseText;
          }
        }
        xmlhttp.open("GET", "get_current_water_level.php?device_api_key="+str, true);
        xmlhttp.send();
      }
      setTimeout(function() {
      showCurrentWaterLevel(str);
    }, 1000);
    }
    
    function showCurrentNetworkName(str) {
      if (str.length == 0) {
        document.getElementById("network_name").innerHTML = "";
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("network_name").innerHTML = this.responseText;
          }
        }
        xmlhttp.open("GET", "get_current_network_name.php?device_api_key="+str, true);
        xmlhttp.send();
      }
      setTimeout(function() {
      showCurrentWaterLevel(str);
    }, 1000);
    }
    
    function showCurrentNetwork(str) {
      if (str.length == 0) {
        document.getElementById("network_name").innerHTML = "";
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("network_name").innerHTML = this.responseText;
          }
        }
        xmlhttp.open("GET", "get_current_network_name.php?device_api_key="+str, true);
        xmlhttp.send();
      }
      setTimeout(function() {
      showCurrentWaterLevel(str);
    }, 1000);
    }
    
    function showDeviceState(str) {
      if (str.length == 0) {
        document.getElementById("device_state").innerHTML = "";
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("device_state").innerHTML = this.responseText;
          }
        }
        xmlhttp.open("GET", "get_current_state.php?device_api_key="+str, true);
        xmlhttp.send();
      }
      if (document.getElementById("device_state").value == "Offline") {
    
      }
      
      setTimeout(function() {
      showDeviceState(str);
    }, 1000);
    }
    
    function showDeviceStateAlert(str) {
      if (str.length == 0) {
        document.getElementById("alert_level_state_alt").innerHTML = "";
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("alert_level_state_alt").innerHTML = this.responseText;
          }
        }
        xmlhttp.open("GET", "get_current_alert_level_state.php?device_api_key="+str, true);
        xmlhttp.send();
      }
      if (document.getElementById("alert_level_state_alt").value == "Offline") {
    
      }
      
      setTimeout(function() {
      showDeviceState(str);
    }, 1000);
    }
    
    
    function realtimeUpd(str){
          setTimeout(function(){showCurrentWaterLevel(str)}, 3000);
    }
    function alert_it() {
        alert("<?php echo $_SESSION['device_api_key'];?>");
    }

    </script>
