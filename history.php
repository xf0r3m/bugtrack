<?php
  if ( session_status() != 2 ) {
    session_start();
  }
  if ( isset($_SESSION["username"]) ) {
?>
<div class="card card-spacer">
  <div class="card-header">
    <h4>Zgłoszenia zachowane:</h4>
  </div>
  <div class="card-body">
<?php
  $cond = "state = 5 ORDER BY id DESC";
  presentListBugs($connection, $cond);
?>
  </div>
</div>
<?php
  } else {
    include('403.php');
  }
?>
