<?php
include("../vendor/autoload.php");

use Faker\Factory as Faker;

use Libs\Database\MySQL;
use Libs\Database\ContactsTable;

$faker = Faker::create();
$table = new ContactsTable(new MySQL());

if ($table) {
    echo "Database connection opened.\n";
    for ($i = 0; $i < 10; $i++) {
        $data = [
            'name' => $faker->name,
            'email' => $faker->email,
            'phone' => $faker->phoneNumber,
            'address' => $faker->address,
            'photo' => null,
            'created_at' => $faker->date,
            'updated_at' => null,
            'user_id' => 1,
        ];
        
        $table->insert($data);
    }
    echo "Done populating contacts table.\n";
}
