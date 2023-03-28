<form class="row g-2" action="?p=settings" method="post">
  <div class="col-auto">
    <input type="hidden" name="delCid" value="<?php echo $row[0]; ?>">
    <button type="submit" class="btn btn-danger mb-3">Usuń komponent</button>
  </div>
</form>
