  // test parameter 
  <script type="text/javascript">


    const data = [];
    data[0] = {
      datasets: [{
        backgroundColor: [
        'rgba(255, 26, 104, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(0, 0, 0, 0.2)'
        ],
        borderColor: [
        'rgba(255, 26, 104, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(0, 0, 0, 1)'
        ],
        borderWidth: 1
      }]
    };

    data[1] = {
      datasets: [{
        backgroundColor: [
        'rgba(255, 26, 104, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(0, 0, 0, 0.2)'
        ],
        borderColor: [
        'rgba(255, 26, 104, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(0, 0, 0, 1)'
        ],
        borderWidth: 1
      }]
    };

    // config 
    const config = [];
    config[0] = {
      type: 'line',
      data: data[0]
      
    };

       config[1] = {
      type: 'line',
      data: data[1]
      
    };


    const myChart = [];
    <?php

    require_once "dbconn.php";
    $query = $pdo->query("SELECT * FROM `sensor_profiles`");
    $result = $query->fetchAll();

    $myChartIndex = 0;
    foreach($result as $result_obj){

      ?>
      myChart[<?php echo $myChartIndex; ?>] = new Chart(
        document.getElementById("<?php echo $result_obj->sensor_id . 'idValChart'; ?>"),
        config
        );
      <?php 
      $myChartIndex++;
    }
    ?>

    function updateChart() {
     async function fetchData() {
      // return array of datapoints simultanously to fetch multiple tables

      const response = [];
      const datapoints = [];

      <?php 
          $myChartIndex = 0;
      foreach($result as $result_obj){
      ?>
      response[<?php echo $myChartIndex; ?>] =  await fetch("json_chart_data_flood_level.php?mode=latest&sensor_id=<?php echo $result_obj->sensor_id; ?>");
      datapoints[<?php echo $myChartIndex; ?>] = await response[<?php echo $myChartIndex; ?>].json();
      <?php
            $myChartIndex++;
      }
      ?>

      // forcards 
      const card_response = await fetch("json_bckend_disp_crd.php");
      const card_datapoints = await card_response.json();

      for(const card_ent of card_datapoints){
        document.getElementById(card_ent.sensor_id+"idVal").innerHTML = card_ent.sensor_val;
        document.getElementById(card_ent.sensor_id+"idLup").innerHTML = card_ent.updated_at;

      }
      
      return datapoints;
    }; 


    // for charts 
    <?php 
              $myChartIndex = 0;
      foreach($result as $result_obj){
    ?>

    myChart[<?php echo $myChartIndex; ?>].config[<?php echo $myChartIndex; ?>].data.datasets[<?php echo $myChartIndex; ?>].label = "Flood levels";

    fetchData().then(datapoints => {
      const sensval = datapoints[<?php echo $myChartIndex; ?>].map((sensval, index) => {
        return sensval.sensor_value;
      });

      const label_timestamps = datapoints[<?php echo $myChartIndex; ?>].map((label_timestamps, index)=>{
        return label_timestamps.timestamps;
      });

      myChart[<?php echo $myChartIndex; ?>].config[<?php echo $myChartIndex; ?>].data.labels = label_timestamps;
      myChart[<?php echo $myChartIndex; ?>].config[<?php echo $myChartIndex; ?>].data.datasets[<?php echo $myChartIndex; ?>].data = sensval;
      myChart[<?php echo $myChartIndex; ?>].update();
    });

    <?php 
         $myChartIndex++;

    }
  ?>


  }

  
  setInterval(function(){
   updateChart();
 }, 1000);

</script>
