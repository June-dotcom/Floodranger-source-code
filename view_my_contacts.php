

<?php 
require_once('dbconn.php');
global $pdo;


$sql = $pdo->query("SELECT contacts.id as contacts_id, contacts.*, address_table.id as address_id ,address_table.*, evacuation.id as evacuation_id ,evacuation.* FROM contacts JOIN address_table ON address_table.id = contacts.address_id JOIN evacuation ON evacuation.id = address_table.evacuation_id");
$posts = $sql->fetchAll();
foreach($posts as $post){
	echo '
	<tr>
	<td>' . $post->contact_name . '</td>
	<td>' . $post->phone_number . '</td>
	<td>' . $post->email . '</td>
	<td>
	' . $post->barangay . ',
	' . $post->municipality . ' ,
	' .  $post->province  . '
	</td>
	<td>
	<button type="button" class="btn btn-danger btn-round btn-sm"
	data-toggle="modal" data-target="#deleteModal' . $post->contacts_id . '">Delete</button>

	<button type="button" class="btn btn-info btn-round btn-sm"
	data-toggle="modal" data-target="#editModal' . $post->contacts_id .'">Edit</button>
	</td>

	<!-- Modal -->
	<div class="modal fade" id="deleteModal' . $post->contacts_id . '" tabindex="-1" aria-labelledby="deleteModal'. $post->contacts_id . 'Label" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
	<div class="modal-body">
	<h4 class="text-center lead">Do you want to delete this contact named' . $post->contact_name .' ?</h4>
	</div>
	<div class="modal-footer">
	Ajax form to be deleted
	<a class="btn btn-danger btn-round btn-sm" href="delete_contact_num.php?id='. $post->contacts_id . '">Yes</a>

	<button type="button" class="btn btn-sm btn-secondary"
	data-dismiss="modal">No</button>
	</div>
	</div>
	</div>
	</div>
	<!-- end of modal -->
	<!-- modal start -->
	<div class="modal fade" id="editModal' . $post->contacts_id . '" tabindex="-1" aria-labelledby="editModal'. $post->contacts_id .'" aria-hidden="true">
	<div class="modal-dialog modal-lg">
	<div class="modal-content">
	<form action="submit_edit_contacts.php" id="form_edit_contact' . $post->contacts_id .'" method="POST">
	<div class="modal-header">

	<h5 class="modal-title " id="editModal'. $post->contacts_id .'">Edit contact number</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">&times;</span>
	</div>
	<div class="modal-body">
	<label>Name</label>
	<input class="form-control" name="contact_name" value="' . $post->contact_name .'"></input>
	<label>Email</label>
	<input class="form-control" name="email" value="' . $post->email . '"></input>                    
	<label>Phone number</label>
	<input class="form-control" name="phone_number" value="'. $post->phone_number .'"></input>
	<label>Address</label>
	</select>
	<br/>
	<input type="hidden" name="contact_id" value="'. $post->contacts_id .'">
	<div id="result"></div>
	<select name="address_id" form="form_edit_contact'. $post->contacts_id .'" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
	';

	$address_query = $pdo->query("SELECT address_table.id AS `address_id`, address_table.*, evacuation.* FROM address_table INNER JOIN evacuation ON address_table.evacuation_id = evacuation.id");
	$addresses = $address_query->fetchAll();
	$user_address_id = $post->address_id;

	foreach($addresses as $address){
		if ($user_address_id == $address->address_id) {
			echo '
			<option value="' . $address->address_id .'" data-subtext="' . $address->evacuation_center_name . '" selected>'. $address->barangay . $address->municipality  . $address->province . '</option>
			';
		}else{
			echo '<option value="' . $address->address_id . '" data-subtext="'. $address->evacuation_center_name .'">'. $address->barangay . ' ' . $address->municipality . ' ' . $address->province . '</option>
			';
		}
	}
	echo '
	</select>


	<br/>
	<div id="result"></div>

	</form>

	</div>
	<div class="modal-footer">
	<button type="button" class="btn btn-secondary"
	data-dismiss="modal">Close</button>
	<input type="submit" class="btn btn-primary" form="form_edit_contact' . $post->contacts_id . '" value="Save changes" name="">
	</div>
	</div>
	</div>
	<!-- modal end -->

	</tr>
	';

}

?>

