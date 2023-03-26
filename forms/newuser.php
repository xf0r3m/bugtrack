<div class="card card-spacer">
  <div class="card-header">
    <h4>Nowy użytkownik:</h4>
  </div>
  <div class="card-body">
    <form action="?p=settings" method="post">
      <div class="row mb-3">
        <label for="nuUsername" class="col-sm-2 col-form-label">Nazwa użytkownika:</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="nuUsername" name="nuName">
        </div>
      </div>
      <div class="row mb-3">
        <label for="nuPassword" class="col-sm-2 col-form-label">Hasło:</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="nuPassword" name="nuPass">
        </div>
      </div>
      <div class="row mb-3">
        <label for="nuRole" class="col-sm-2 col-form-label">Rola:</label>
        <div class="col-sm-10">
          <select class="form-select" aria-label="Default select example" id="nuRole">
            <option value="admin">Administrator</option>
          </select>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Dodaj użytkownika</button>
    </form>
  </div>
</div>
