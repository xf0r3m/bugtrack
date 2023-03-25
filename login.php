<?php if (isset($_POST["login"]) && isset($_POST["pass"])): ?>
<?php
  $username = mysqli_real_escape_string($connection, $_POST["login"]);
  $password = $_POST["pass"];
  $tableName = 'user';
  $columnScheme = 'passwd_hash';
  $whereValue = "username = '" . $username . "';";
	$result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
  $row = mysqli_fetch_row($result);
  $passwd_hash = $row[0];
  #var_dump($passwd_hash);
  if ( password_verify($password, $passwd_hash) ) {
    session_start();
    $_SESSION['username'] = $username;
    header("Location: index.php");
  } else {
    unset($_POST["login"]);
    unset($_POST["pass"]);
    header("Location: ?p=login&bad=1");
  }
?>
<?php else: ?>
  <?php if ( isset($_GET["bad"]) ): ?>
    <div class="alert alert-danger" role="alert">
      Błędna nazwa użytkownika lub hasło.
    </div>
  <?php endif ?>
  <h3>Zaloguj się:</h3>
  <div class="card-body login-form-card">
    <form class="row" action="?p=login" method="post">
	    <div class="mb-3 row">
		    <label for="inputLogin" class="col-sm-2 col-form-label">Login</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="inputLogin" name="login">
		    </div>
	    </div>
	    <div class="mb-3 row">
	      <label for="inputPassword" class="col-sm-2 col-form-label">Hasło</label>
	      <div class="col-sm-10">
		      <input type="password" class="form-control" id="inputPassword" name="pass">
	      </div>
	    </div>
	    <div class="col-auto">
	      <button type="submit" class="btn btn-primary mb-3">Zaloguj się</button>
	    </div>
	  </form>
  </div>
<?php endif ?>
