<?php
include 'dbconn.php';
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

ob_start();
$sensor_id = $_GET['sensor_id'];

?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		body{
			font-family: sans-serif;
		}

		table {
			font-family: sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		td, th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 10px;
		}

		tr:nth-child(even) {
			background-color: #EFF5F5;
		}
	</style>
	<body>

		<?php 
		$dev_info_sql = $pdo->query("SELECT * FROM sensor_profiles JOIN devices ON sensor_profiles.device_api_key = devices.device_api_key WHERE sensor_profiles.sensor_id = '$sensor_id'");
		$dev_info_res = $dev_info_sql->fetch();
		?>
<div>
			<h1>Flood monitoring report for <?php echo $sensor_id; ?></h1>
		</div>
 <table>
            <tbody>
              <tr>
                <td>Sensor type</td>
                <td><?php echo $dev_info_res->sensor_type; ?></td>
            </tr>
            <tr>
              <td>Sensor ID</td>
              <td><?php echo $dev_info_res->sensor_id; ?></td>
          </tr>
          <tr>
            <td>Sensor description</td>
            <td><?php echo $dev_info_res->sensor_desc; ?></td>
        </tr>
        <tr>
            <td>Device location</td>
            <td><?php echo $dev_info_res->module_location; ?></td>

        </tr>
    </tbody>
</table>
<hr>
		<?php 
		$sql = $pdo->query("SELECT * FROM (SELECT sensor_value, timestamps, sensor_val_remarks.remark_id, sensor_val_remarks.remark_color FROM `sensor_logs` JOIN sensor_val_remarks ON sensor_val_remarks.remark_id = sensor_logs.remarks_id WHERE sensor_id = '$sensor_id') as tbl_sensor ORDER BY timestamps DESC");
		$posts = $sql->fetchAll();


		?>
		
		<table>
			<tr>
				<th>Flood alert</th>
				<th>Water level</th>
				<th>Date and time</th>
			</tr>
			<?php 
			foreach($posts as $post){
				?>
				<tr>
					<td style="background-color: <?php echo $post->remark_color;?> !important;color: white;">
						<?php echo $post->remark_id; ?>
					</td>
					<td>
						<?php echo $post->sensor_value; ?>
					</td>
					<td>
						<?php echo $post->timestamps; ?>
					</td>
				</tr>
				<?php 
			}
			?>

		</table>
	</body>
	</html>


	<?php
	$html = ob_get_contents();
	ob_end_clean();

	$mpdf->WriteHTML($html);
		ob_end_clean();

	$mpdf->Output();

?>