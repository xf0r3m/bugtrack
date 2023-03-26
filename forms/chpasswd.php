<div class="card">
  <div class="card-header">
    <h4>Hasło:</h4>
  </div>
  <div class="card-body">
    <form action="?p=settings" method="post">
      <div class="row mb-3">
        <label for="oldPassword" class="col-sm-2 col-form-label">Stare hasło:</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="oldPassword" name="oldPasswd">
        </div>
      </div>
      <div class="row mb-3">
        <label for="newPassword" class="col-sm-2 col-form-label">Nowe hasło:</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="newPassword" name="newPasswd">
        </div>
      </div>
      <div class="row mb-3">
        <label for="conNewPassword" class="col-sm-2 col-form-label">Potwierdź nowe hasło:</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="conNewPassword" name="conNewPasswd">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Zmień hasło</button>
    </form>
  </div>
</div>
