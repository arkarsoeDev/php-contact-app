<?php
$title = 'Login';
require "views/partials/head.php";
?>
<style>
   .wrap {
      width: 100%;
      max-width: 400px;
      margin: 40px auto;
   }
</style>

<body class="text-center">
   <div class="wrap">
      <h1 class="display-6">PHP Contact App</h3>
         <h2 class="mb-3">Login</h2>

         <?php if (isset($_GET['registered'])) : ?>
            <div class="alert alert-success">
               Account created. Please login.
            </div>
         <?php endif ?>

         <?php if (isset($_GET['incorrect'])) : ?>

            <div class="alert alert-warning">
               Incorrect Email or Password
            </div>

         <?php endif ?>

         <form action="_actions/login.php" method="post">
            <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
            <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
            <button type="submit" class="w-100 btn btn-lg btn-primary">
               Login
            </button>
         </form>
         <br>
         <a href="register.php">Register</a>
   </div>
</body>
<?php
require "views/partials/footer.php";
?>