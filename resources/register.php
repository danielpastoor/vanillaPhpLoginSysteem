<?php
$errors = $errors ?? [];
?>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Register an Account</h5>

    <?php if (count($errors)) : ?>
      <div class="alert alert-danger mt-3" role="alert">
        <?php foreach ($errors as $error) : ?>
          <?php echo $error; ?> <br />
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form id="form" method="POST" action="<?= RouteHelper::getRoute('register') ?>">
      <input type="hidden" name="token" value="<?= RequestHelper::getCsrfToken() ?>">
      <div class="mb-3 form-control">
        <label for="username" class="form-label">Username</label>
        <input class="form-control" name="username" id="username" maxlength="50" minlength="3" type="text" />
        <small>Error message</small>
      </div>
      <div class="mb-3 form-control">
        <label for="email" class="form-label">Email</label>
        <input class="form-control" name="email" id="email" maxlength="120" minlength="4" type="text" />
        <small>Error message</small>
      </div>
      <div class="mb-3 form-control">
        <label for="password" class="form-label">Password</label>
        <input class="form-control" name="password" id="password" type="password" minlength="6" />
        <small>Error message</small>
      </div>
      <div class="mb-3 form-control">
        <label for="password2" class="form-label">Her vul wachtwoord</label>
        <input class="form-control" name="password2" id="password2" type="password" minlength="6" />
        <small>Error message</small><br>
        Must be more than 8 characters long<br>
        Must contain at least one upper case character<br>
        Must contain at least one lower case character<br>
        Must contain at least one digit
      </div>
      <button class="btn btn-primary" type="submit">Register</button>
    </form>
  </div>
</div>