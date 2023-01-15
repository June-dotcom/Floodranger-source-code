setInterval(function(){
   fetchData();
 }, 1000);

   async function fetchData() {
      // return array of datapoints simultanously to fetch multiple tables

      const card_response = await fetch("json_bckend_device_stamp.php");
      const card_datapoints = await card_response.json();
      console.log(card_response);
      console.log(card_datapoints);
      for(const card_ent of card_datapoints){
        document.getElementById("device_state" + card_ent.device_api_key).innerHTML = card_ent.remarks;



      }      
    } 

  

  
