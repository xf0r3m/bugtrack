<form class="row g-2" action="?p=settings" method="post">
  <div class="col-auto">
    <label for="setpasswd" class="visually-hidden">Hasło</label>
    <input type="password" class="form-control" id="setpasswd" name="setUPasswd" placeholder="Hasło">
    <input type="hidden" name="setUid" value="<?php echo $row[0]; ?>">
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">Ustaw hasło</button>
  </div>
</form>
