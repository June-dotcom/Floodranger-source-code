setInterval(function(){
 fetchData();
}, 1000);

async function fetchData() {
      // return array of datapoints simultanously to fetch multiple tables


  const card_response = await fetch("json_bckend_disp_crd_usr.php");
  const card_datapoints = await card_response.json();

  console.log(card_datapoints);
  for(const card_ent of card_datapoints){
    document.getElementById(card_ent.sensor_id+"idVal").innerHTML = card_ent.sensor_val;
    document.getElementById(card_ent.sensor_id+"idLup").innerHTML = card_ent.updated_at;
    document.getElementById(card_ent.sensor_id+"idValRemarks").innerHTML = card_ent.sensor_val_remarks;


  }      
} 




