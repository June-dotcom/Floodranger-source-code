<?php ob_start(); ?>
<?php 
include 'vendor/autoload.php';
include 'dbconn.php';
$pdf = new CezPDF('a4');
date_default_timezone_set('Asia/Taipei');

$pdf->selectFont('Helvetica');
$pdf->ezText('<b>Floodranger recent contacts backup </b>', 30);
$curr_date =  date('m/d/Y h:i:s a', time());
$pdf->ezText('As of ' . $curr_date , 20);



$cols = ['contact_name' => 'Name', 'phone_number' => 'Phone number', 'email' => 'Email',  'barangay' => 'Barangay', 'municipality' => 'Town/City', 'province' => 'Province'];
// $coloptions = ['num' => ['justification' => 'right'], 'name' => ['justification' => 'left'], 'type' => ['justification' => 'center']];
$conf = [
    'xPos' => 'left',
    'xOrientation' => 'right'
];
$data = array();

$query_data = $pdo->query("SELECT DISTINCT contacts.id as contacts_id, contacts.*, address_table_tmp.address_id as address_id ,address_table_tmp.* FROM contacts JOIN (SELECT DISTINCT address_table.address_id, address_table.barangay, address_table.municipality, address_table.province,address_table.evacuation_id FROM address_table) as address_table_tmp ON contacts.address_id = address_table_tmp.address_id WHERE contacts.is_permitted = '1'");
$obj_data = $query_data->fetchAll();
foreach($obj_data as $ent_data){
    array_push($data,  ['contact_name' => $ent_data->contact_name, 'phone_number' => $ent_data->phone_number, 'email'=> $ent_data->email, 'barangay' => $ent_data->barangay, 'municipality' => $ent_data->municipality, 'province' => $ent_data->province]);
}

$pdf->ezTable($data, $cols, '',$conf);




if (isset($_GET['d']) && $_GET['d']) {
    ob_end_clean();
    echo $pdf->ezOutput(true);
} else {
    ob_end_clean();
    $pdf->ezStream(array('download' => 1));
    // $pdf->ezStream();

}