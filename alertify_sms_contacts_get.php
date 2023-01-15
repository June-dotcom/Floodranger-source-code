<?php 
require_once 'dbconn.php';

$alert_id = $_GET['alert_id'];
$query = $pdo->query("SELECT contacts.phone_number FROM contacts JOIN address_table ON address_table.id = contacts.address_id WHERE device_covered_by = (SELECT device_api_key FROM flood_alert_levels WHERE alert_id = '$alert_id')");
// $query = $pdo->query("SELECT contacts.is_permitted FROM contacts LEFT JOIN address_table ON address_table.id = contacts.address_id");
$results = $query->fetchAll();
echo json_encode($results);

