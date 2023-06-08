<?php
$pathElements = explode("/", $_GET["path"]);
$productName = $pathElements[1];
$version = $pathElements[2];
?>
<div class="card card-spacer">
  <div class="card-header">
    <h4>Lista zmian dla wersji <?php echo $version ?> produktu <?php echo $productName; ?>:</h4>
  </div>
  <div class="card-body">
    <?php
      include($_GET["path"] . ".html");
    ?>
  </div>
</div>
