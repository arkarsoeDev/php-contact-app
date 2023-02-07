<?php
include("vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\ContactsTable;
use Helpers\Auth;

$table = new ContactsTable(new MySQL());
$all = $table->getAll();
$auth = Auth::check();

$token = Auth::setToken();
?>

<?php
$title = 'Home';
require "views/partials/head.php";
?>

<body>
    <div class="container">
        <div style="float: right">
            <a href="views/contacts/create.view.php" class="text-info">New</a> |
            <a href="_actions/logout.php" class="text-danger">Logout</a>
        </div>
        <h2 class="mt-5 mb-5">
            Manage Contacts
            <span class="badge bg-danger text-white">
                <?= count($all) ?>
            </span>
        </h2>
        <table class="table table-striped table-bordered mb-5">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($all as $contact) : ?>
                <tr>
                    <td><?= $contact->id ?></td>
                    <td><?= $contact->name ?></td>
                    <td><?= $contact->email ?></td>
                    <td><?= $contact->phone ?></td>
                    <td><?= $contact->address ?></td>
                    <td>
                        <div class="btn-group dropdown">
                            <a href="views/contacts/edit.view.php?id=<?= $contact->id ?>" class="btn btn-sm btn-outline-success">Edit</a>
                            <a href="_actions/contacts/delete.php?id=<?= $contact->id ?>&csrf=<?= $token ?>" class="btn btn-sm btn-outline-danger" onClick="return confirm('Are you sure?')">Delete</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</body>

<?php
require "views/partials/footer.php";
?>