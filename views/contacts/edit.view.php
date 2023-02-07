<?php
include("../../vendor/autoload.php");

use Helpers\Auth;
use Helpers\HTTP;
use Libs\Database\ContactsTable;
use Libs\Database\MySQL;

$user = Auth::check();
$id = $_GET['id'];

$table = new ContactsTable(new MySQL());
$contact = $table->get($id);

if (!$contact) {
   HTTP::redirect('/admin.php');
}

$token = Auth::setToken();

$title = 'Edit Contact Id ' . $id;

require "../partials/head.php";
?>
<style>
   .wrap {
      width: 100%;
      max-width: 400px;
      margin: auto;
   }
</style>

<body>
   <div class="wrap my-5">
      <div class="d-flex justify-content-end">
         <a href="/admin.php" class="btn btn-light shadow-md border mb-3">Back to admin</a>
      </div>
      <h2 class="mb-3"><?= $title ?></h2>
      <form action="/_actions/contacts/update.php" method="post">
         <input type="hidden" name="contact_id" value="<?php echo $contact->id ?>">
         <input type="hidden" name="user_id" value="<?php echo $user->id ?>">
         <input type="hidden" name="csrf" value="<?php echo $token ?>">
         <div class="mb-3">
            <label for="Name" class="form-label">Name</label>
            <input type="Name" name="name" class="form-control" id="Name" value="<?php echo $contact->name ?>" aria-describedby="emailHelp">
         </div>
         <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email" value="<?php echo $contact->email ?>" aria-describedby="emailHelp">
         </div>
         <div class="mb-3">
            <label for="phone" class="form-label">phone</label>
            <input type="text" name="phone" class="form-control" id="phone" value="<?php echo $contact->phone ?>">
         </div>
         <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" class="form-control" id="address" value="<?php echo $contact->address ?>">
         </div>
         <button type="submit" class="btn btn-primary ml-auto">Create</button>
      </form>
   </div>
</body>

<?php
require "../partials/footer.php";
?>