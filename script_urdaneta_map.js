sync_urdaneta_map_updates();

setInterval(sync_urdaneta_map_updates, 1000);

async function sync_urdaneta_map_updates(){
	let fetch_ajax = await fetch("json_map_view_urd.php");
	let fetch_result = await fetch_ajax.json();

	for(const res_obj of fetch_result){
		$(".d." + res_obj.addr_mapping_name).css("fill", res_obj.color_alert_remarks);
	}
}



  

  
