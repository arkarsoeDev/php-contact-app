<?php

include("../../vendor/autoload.php");

use Libs\Database\MySQL;
use Helpers\HTTP;
use Helpers\Auth;
use Libs\Database\ContactsTable;

$auth = Auth::check();

$table = new ContactsTable(new MySQL());

$id = $_GET['id'];
$token = $_GET['csrf'];

if(Auth::checkToken($token)) {
    $table->delete($id);
}

HTTP::redirect("/admin.php");