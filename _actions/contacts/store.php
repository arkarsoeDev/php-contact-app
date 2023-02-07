<?php
include("../../vendor/autoload.php");

use Helpers\Auth;
use Helpers\Custom;
use Helpers\HTTP;
use Libs\Database\ContactsTable;
use Libs\Database\MySQL;

$auth = Auth::check();

$token = $_POST['csrf'];

if(!Auth::checkToken($token)) {
   HTTP::redirect("/admin.php");
}

$data = [
   "name" => Custom::h($_POST['name']) ?? 'Unknown',
   "email" => Custom::h($_POST['email']) ?? 'Unknown',
   "phone" => Custom::h($_POST['phone']) ?? 'Unknown',
   "address" => Custom::h($_POST['address']) ?? 'Unknown',
   "created_at" => "NOW()",
   "updated_at" => "NOW()",
   "photo" => null,
   "user_id" => Custom::h($_POST['user_id']),
];

$table = new ContactsTable(new MySQL());

if($table) {
   $res = $table->insert($data);
   var_dump($res);
    HTTP::redirect("/admin.php");
} else {
   var_dump($res);
    HTTP::redirect("/views/contacts/create.view.php");
}