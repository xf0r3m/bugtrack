<div class="card card-spacer">
  <div class="card-body">
    <h5 class="card-title">Lista komponentów:</h5>
    <div class="card card-spacer">
      <div class="card-body">
        <h6 class="card-title">Wybierz produkt:</h6>
          <?php
                $tableName = 'product';
                $columnScheme = 'id,name';
                $whereValue = "1=1";
                $result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
          ?>
          <?php if( mysqli_num_rows($result) > 0): ?>
            <form action="?p=settings" method="post">
              <div class="mb-3">
                <select class="form-select" aria-label="Choose product" name="viewCPid">
                  <?php
                    while ( $row = mysqli_fetch_row($result) ) {
                      if ( isset($_POST["viewCPid"]) ) {
                        if ( $_POST["viewCPid"] == $row[0] ) {
                          echo "<option selected value=\"" . $_POST["viewCPid"] . "\">" . $row[1] . "</option>";
                          continue;
                        }
                      }
                      echo "<option value=\"" . $row[0] . "\">" . $row[1] . "</option>";
                    }
                  ?>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Pokaż komponenty</button>
            </form>
          <?php else: ?>
            <div class="alert alert-primary" role="alert">Nie znaleziono żadnych produktów</div>
          <?php endif ?>
      </div>
    </div>
    <?php if ( isset($_POST) && isset($_POST["viewCPid"]) ): ?>
    <?php
      $tableName = "component";
      $columnScheme = "id,name,author,description";
      $whereValue = "productId =" . intval($_POST["viewCPid"]);
      $result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
    ?>
      <?php if ( mysqli_num_rows($result) > 0 ): ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#Lp</th>
              <th scope="col">Nazwa komponentu</th>
              <th scope="col">Autor</th>
              <th scope="col">Opis komponentu</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
              if ( mysqli_num_rows($result) > 0 ) {
                $lp=1;
                while ( $row = mysqli_fetch_row($result) ) {
                  echo "<tr><td>" . $lp . "</td><th scope=\"row\">" . $row[1] . "</th><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>";
                  include("forms/editcomponent.php");
                  echo "</td><td>";
                  include("forms/delcomponent.php");
                  echo "</td></tr>";
                  $lp = ++$lp;
                }
              }
            ?>
          </tbody>
        </table>
      <?php else: ?>
        <div class="alert alert-primary" role="alert">Nie znaleziono komponentów dla wybranego produktu</div>
      <?php endif ?>
    <?php else: ?>
      <div class="alert alert-primary" role="alert">Nie wybrano produktu</div>
    <?php endif ?>
  </div>
</div>
