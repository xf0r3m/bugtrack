<div class="card card-spacer">
  <div class="card-body">
    <h5 class="card-title">Nowy komponent:</h5>
      <?php
        $tableName = "product";
        $columnScheme = "id,name";
        $whereValue = "1=1";
        $result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
        if ( mysqli_num_rows($result) > 0 ) {
          $thereAreProducts = true;
        } else {
          $thereAreProducts = false;
        }
      ?>
      <?php if ( $thereAreProducts == true ): ?>
        <form action="?p=settings" method="post">
          <div class="mb-3">
            <label for="productSelect" class="form-label">Produkt</label>
            <select class="form-select" aria-label="Product select" id="productSelect" name="productId">
              <option selected>Wybierz produkt</option>
              <?php
                if ( mysqli_num_rows($result) > 0 ) {
                  while ( $row = mysqli_fetch_row($result) ) {
                   echo "<option value=" . $row[0] . ">" . $row[1] . "</option>"; 
                  }
                }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="componentNameInput" class="form-label">Nazwa komponentu</label>
            <input type="text" class="form-control" id="componentNameInput" name="componentName" placeholder="np. XFCE">
          </div>
          <div class="mb-3">
            <label for="componentAuthorInput" class="form-label">Autor komponentu</label>
            <input type="text" class="form-control" id="componentAuthorInput" name="componentAuthor" placeholder="np. Red Hat Inc.">
          </div>
          <div class="mb-3">
            <label for="componentDescInput" class="form-label">Opis komponentu</label>
            <textarea class="form-control" id="componentDescInput" name="componentDesc" rows="2" placeholder="np. Skrypt zarządzania cryptfs"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Dodaj komponent</button>
        </form> 
      <?php else: ?>
        <div class="alert alert-primary" role="alert">Nie znaleziono żadnych produktów.</div>
      <?php endif ?>
  </div>
</div>
