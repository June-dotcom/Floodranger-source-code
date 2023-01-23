<?php ob_start(); ?>
<?php
include 'dbconn.php';
$phone_number = $_POST['phone_number'];
$txt_msg = $_POST['txt_msg'];

$query_sms_auth_key = $pdo->query("SELECT * FROM preferences WHERE pref_id = 'SMSTOKENTRACCAR' LIMIT 1");
$obj_sms_auth_key = $query_sms_auth_key->fetch();
$token_sms = $obj_sms_auth_key->pref_val;

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://www.traccar.org/sms/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode(['to' => $phone_number, 'message' => $txt_msg]),
    
    CURLOPT_HTTPHEADER => array(
        'Authorization: ' . $token_sms,
        'Content-Type: application/json'
    ),
));

$response = curl_exec($curl);

curl_close($curl);
echo json_encode($response);

ob_clean();
header("Location: admin_settings_traccar_main.php");
?>
