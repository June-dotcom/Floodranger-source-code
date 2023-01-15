setSensorCardsMaxMin();

setInterval(setSensorCardsMaxMin, 1000);

async function setSensorCardsMaxMin(){
	const queryString = window.location.search;
	const urlParams = new URLSearchParams(queryString);
	var sensor_id = urlParams.get('sensor_id');
	console.log("sensor id");


	let sensor_cards_fet = await fetch("bckend_sensor_view.php?sensor_id=" + sensor_id + "&query_type=max_min_curr");
	let sensor_cards_res = await sensor_cards_fet.json();
	
	console.log(sensor_cards_res);

	document.getElementById("current_water_level_val").innerHTML = sensor_cards_res.current_value + " cm";

	if(sensor_cards_res.max_value == null){

	}else{
	document.getElementById("highest_water_level_val").innerHTML = sensor_cards_res.max_value + " cm";
	document.getElementById("lowest_water_level_val").innerHTML = sensor_cards_res.min_value + " cm";

	document.getElementById("highest_water_level_timestamp").innerHTML = sensor_cards_res.max_value_timestamp;
	document.getElementById("lowest_water_level_timestamp").innerHTML = sensor_cards_res.min_value_timestamp;
	}

	document.getElementById("current_water_level_timestamp").innerHTML = sensor_cards_res.current_value_timestamp;
	
	let sensor_alert_fet = await fetch("bckend_sensor_view.php?sensor_id=" + sensor_id + "&query_type=alert_abc");
	let sensor_alert_res = await sensor_alert_fet.json();

	$("#alert_a_val").html(sensor_alert_res.alert_a + "cm");
	$("#alert_b_val").html(sensor_alert_res.alert_b + "cm");
	$("#alert_c_val").html(sensor_alert_res.alert_c + "cm");

}



