  // test parameter 


  const data = {
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
    const config = {
      type: 'line',
      data: data
      
    };

   
    const myChart = [];
    
    myChart[0] = new Chart(
      document.getElementById('dispChart'),
      config
      );


    var mode = 'latest';
    function updateChart() {
     async function fetchData() {
      // return array of datapoints simultanously to fetch multiple tables

      const response = [];
      response[0] =  await fetch("json_chart_data_flood_level.php?mode=" + mode);
      const datapoints = [];
      datapoints[0] = await response[0].json();
          
  
      const card_response = await fetch("json_bckend_disp_crd.php");
      const card_datapoints = await card_response.json();

      for(const card_ent of card_datapoints){
        document.getElementById(card_ent.sensor_id+"idVal").innerHTML = card_ent.sensor_val;
                document.getElementById(card_ent.sensor_id+"idLup").innerHTML = card_ent.updated_at;

      }
      
      return datapoints;
    }; 
      


       myChart[0].config.data.datasets[0].label = "Flood levels";

    fetchData().then(datapoints => {
      const sensval = datapoints[0].map((sensval, index) => {
        return sensval.sensor_value;
      });

      const label_timestamps = datapoints[0].map((label_timestamps, index)=>{
        return label_timestamps.timestamps;
      });

      myChart[0].config.data.labels = label_timestamps;
      myChart[0].config.data.datasets[0].data = sensval;
      myChart[0].update();
    });


   

  }

  
  setInterval(function(){
   updateChart();
 }, 1000);