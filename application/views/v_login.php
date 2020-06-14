
<!doctype html>
<html lang="en">
  <head>
    <title>Road to Ujikom</title>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/signIn.css" type="text/css">
  </head>

  <body style="background-color:grey;" class="text-center">
  <div style="width:40%;background-color:white" class="container rounded p-3">
    <form class="form-signin" method="post" action="<?= base_url();?>index.php/login/execute">
      <h1 class="h3 mb-5 text-dark font-weight-normal">LOGIN</h1>
      <label for="inputEmail" class="sr-only">Username</label>
      <input type="text" name="username" id="inputEmail" class="form-control mb-1 rounded" placeholder="Ex. Admin" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="password" class="form-control rounded" placeholder="Ex. ******" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2019</p>
    </form>
  </body>
</html>
