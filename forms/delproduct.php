<form class="row g-2" action="?p=settings" method="post">
  <div class="col-auto">
    <input type="hidden" name="delPid" value="<?php echo $row[0]; ?>">
    <button type="submit" class="btn btn-danger mb-3">Usuń produkt</button>
  </div>
</form>
