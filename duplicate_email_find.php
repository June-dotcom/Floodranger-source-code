<?php 
include "dbconn.php";
class emailVerStatus {
  // Properties
	public $isExistContacts;
	public $isExistUsers;

  // Methods
	function set_exist_contacts($name) {
		$this->isExistContacts = $name;
	}

	function set_exist_users($name) {
		$this->isExistUsers = $name;
	}

	function get_exist_contacts() {
		return $this->isExistContacts;
	}

	function get_exist_users(){
		return $this->isExistUsers;
	}
}

$email_val = $_GET['email'] ?? 'null';


$email_find_dup_query = $pdo->query("SELECT COUNT(email) AS result FROM user_credentials WHERE email = '$email_val'");
$email_res = $email_find_dup_query->fetch();

$contacts_find_dup_query = $pdo->query("SELECT COUNT(email) as result FROM contacts WHERE email = '$email_val'");
$contacts_res = $contacts_find_dup_query->fetch();

$email_verify_status_obj = new emailVerStatus();
$email_verify_status_obj->isExistUsers = $email_res;
$email_verify_status_obj->isExistContacts = $contacts_res;
echo json_encode($email_verify_status_obj);
?>