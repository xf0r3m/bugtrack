<div class="card card-spacer">
  <div class="card-header">
    <h4>Zgłoszenia otwarte:</h4>
  </div>
  <div class="card-body">
<?php
  $cond = "state > 0 AND state < 3 ORDER BY id DESC";
  presentListBugs($connection, $cond);
?>
  </div>
</div>

<div class="card card-spacer">
  <div class="card-header">
    <h4>Zgłoszenia zamknięte:</h4>
  </div>
  <div class="card-body">
<?php
  $cond = "state >= 3 ORDER BY id DESC";
  presentListBugs($connection, $cond);
?>
  </div>
</div>
