<?php include('library.php'); ?>
<?php include('db_conf.php'); ?>
<?php
  $tableName = 'site';
  $columnScheme = 'slogan,theme';
  $whereValue = "id = 1";
  $result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
  $row = mysqli_fetch_row($result);
?>

<!doctype html>
<html lang="pl" <?php echo "data-bs-theme=\"" . $row[1] . "\"" ?>>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
	<style>
		.frontpage-link { 
      color: #4286f4 !important; 
      text-decoration: underline;
      pointer-events: auto; 
     }
		.frontpage-card { margin-top: 0.5%; margin-bottom: 0.5%; }
		.login-form-card { width: 35%; }
    .navbar-greetings { pointer-events: none; }
    .card-spacer { margin-top: 0.5%; }
    .request-desc { word-wrap: normal; width: 25%; }
	</style>
        <title>BugTrack - <?php echo $row[0]; ?></title>
  </head>
  <body>
    <?php include('navbar.php'); ?>

	  <div class="card frontpage-card">
      <div class="card-body">
        <?php
          if ( isset($_GET["p"]) ) {
            if ($_GET["p"] == "login") {
              include('login.php');
            } else if ($_GET["p"] == "settings") {
              include('settings.php');
            } else if ($_GET["p"] == "logout") {
              include('logout.php');
            } else if ($_GET["p"] == "siteListProducts") {
              include('siteListProducts.php');
            } else if ($_GET["p"] == "submit") {
              include('submit.php');
            } else if ($_GET["p"] == "bugs") {
              include('bugs.php');
            } else if ($_GET["p"] == "comments") {
              include('comments.php');
            } else if ($_GET["p"] == "changelog") {
              include('changelog.php');
            } else if ($_GET["p"] == "viewchlog") {
              include('viewchlog.php');
            } else if ($_GET["p"] == "history") {
              include('history.php');
            } else {
              include('404.php');
            }
          } else {
            include('frontpage.php');
            if ( session_status() != 2 ) { session_start(); }
            if ( isset($_SESSION["username"]) ) {
              if ( isset($_POST) && isset($_POST["chBugState"]) ) {
                include('modules/chbugstate.php');
              } 
              include('listofbugs.php');
            }
            include('statistics.php'); 
          }
        ?>
      </div>
    </div>
	  <nav class="navbar navbar-expand-lg">
	    <div class="container-fluid">
        <a class="navbar-brand active" aria-current="page" href="http://<?php echo $_SERVER["SERVER_NAME"];?>">BugTrack - morketsmerke.org @ 2023</a>
      </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>

  </body>
</html>
