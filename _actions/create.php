<?php

include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;
use Helpers\Custom;

$hash = password_hash($_POST['password'],PASSWORD_BCRYPT);

$data = [
    "email" => Custom::h($_POST['email']) ?? 'Unknown',
    "password" => $hash,
];

$table = new UsersTable(new MySQL());

if($table) {
    $table->insert($data);
    HTTP::redirect("/index.php", "registered=true");
} else {
    HTTP::redirect("/register.php", "error=true");
}