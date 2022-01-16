<?php
$errors = $errors ?? [];
?>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Login into your Account</h5>

    <?php if (count($errors)) : ?>
      <div class="alert alert-danger mt-3" role="alert">
        <?php foreach ($errors as $error) : ?>
          <?php echo $error; ?> <br />
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="<?= RouteHelper::getRoute('login')  ?>">
      <input type="hidden" name="token" value="<?= RequestHelper::getCsrfToken() ?>">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input class="form-control" name="username" id="username" maxlength="50" minlength="3" type="text" require />
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input class="form-control" name="password" id="password" type="password" minlength="6" require />
      </div>
      <button class="btn btn-primary" type="submit">Login</button>
    </form>

    <a href="<?= RouteHelper::getRoute('register') ?>">Register</a>
  </div>
</div>