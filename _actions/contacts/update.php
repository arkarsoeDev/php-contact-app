<?php
include("../../vendor/autoload.php");

use Helpers\Auth;
use Helpers\Custom;
use Helpers\HTTP;
use Libs\Database\ContactsTable;
use Libs\Database\MySQL;

$auth = Auth::check();

$token = $_POST['csrf'];

$table = new ContactsTable(new MySQL());

$contact = $table->get(Custom::h($_POST['user_id']));
if($auth->id != $_POST['user_id']) {
   var_dump($auth);
   die();
   HTTP::redirect("/403.php");
}

if($contact->user_id != $_POST['user_id']) {
   HTTP::redirect("/403.php");
}

if (!Auth::checkToken($token)) {
   HTTP::redirect("/admin.php");
}

if ($table) {
   $data = [
      "name" => Custom::h($_POST['name']),
      "email" => Custom::h($_POST['email']),
      "phone" => Custom::h($_POST['phone']),
      "address" => Custom::h($_POST['address']),
      "created_at" => $contact->created_at,
      "updated_at" => "NOW()",
      "photo" => null,
      "user_id" => Custom::h($_POST['user_id']),
   ];

   $res = $table->update($data,$contact->id);
   HTTP::redirect("/admin.php");
} else {
   HTTP::redirect("/views/contacts/create.view.php");
}
