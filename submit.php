<?php
  if ( isset($_POST) && isset($_POST["submitProductId"]) ) {
    $tableName = 'bug';
    $columnScheme = "productId,componentId,typeof,subject,description,state";
    $setValues = intval($_POST["submitProductId"]) . "," . intval($_POST["submitCompId"]) . ",'" . mysqli_real_escape_string($connection, htmlspecialchars($_POST["submitTypeOf"])) . "','" . mysqli_real_escape_string($connection, htmlspecialchars($_POST["submitSubject"])) . "','" . mysqli_real_escape_string($connection, htmlspecialchars($_POST["submitDesc"])) . "',0";
    $result = dbAdd($connection, $tableName, $columnScheme, $setValues);
    if ( $result == true ) {
      echo "<div class=\"alert alert-success\" role=\"alert\">Zgłoszenie zostało przyjęte. Niebawem pojawi się na stronie zgłoszonych problemów</div>";
    } else {
      echo "<div class=\"alert alert-danger\" role=\"alert\">Zgłosznie nie zostało przyjęte.</div>";
    }
    $tableName = 'bug';
    $columnScheme = "id";
    $whereValue = "1=1 ORDER BY id DESC";
    $result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
    if ( mysqli_num_rows($result) > 0 ) {
      $row = mysqli_fetch_row($result);
      $bugId = $row[0];
    }
    
    $tableName = 'product';
    $columnScheme = 'name,description';
    $whereValue = "id = " . intval($_POST["submitProductId"]);
    $productResult = dbQuery($connection, $tableName, $columnScheme, $whereValue);
    if ( mysqli_num_rows($productResult) > 0 ) {
      $productRow = mysqli_fetch_row($productResult);
    }
    
    $tableName = 'component';
    $columnScheme = 'name,description';
    $whereValue = "id = " . intval($_POST["submitCompId"]);
    $componentResult = dbQuery($connection, $tableName, $columnScheme, $whereValue);
    if ( mysqli_num_rows($componentResult) > 0 ) {
      $componentRow = mysqli_fetch_row($componentResult);
    }

    $tableName = "comment";
    $columnScheme = 'bugId,user,date,content';
    if ( session_status() != 2 ) { session_start(); }
    if ( isset($_SESSION["username"]) ) { $userName = $_SESSION["username"]; }
    else { $userName = $_SERVER["REMOTE_ADDR"]; }
    $setValue = intval($bugId) . ",'" . $userName . "','" . date("Y-m-d H:i:s") . "','Utworzono zgłoszenie.<br /><br /><strong>Produkt:</strong> " . $productRow[0] . " (" . $productRow[1] . ")<br /><strong>Komponent:</strong> " . $componentRow[0] . " (" . $componentRow[1] . ")<br /><strong>Rodzaj zgłoszenia:</strong> " . htmlspecialchars($_POST["submitTypeOf"]) . "<br /><strong>Temat: </strong>" . htmlspecialchars($_POST["submitSubject"]) . "<br /><strong>Opis zgłoszenia:</strong><br />" . htmlspecialchars($_POST["submitDesc"]) . "'";
    $result = dbAdd($connection, $tableName, $columnScheme, $setValue);
    if ( $result == true ) { 
      echo "<div class=\"alert alert-success\" role=\"alert\">Zgłoszenie zostało również zapisane jako pierwszy komentarz</div>";
    } else {
      echo "<div class=\"alert alert-danger\" role=\"alert\">Zgłoszenie nie zostało zapisane.</div>";
    }
  }
?>
<div class="card card-spacer">
  <div class="card-header">
    <h4>Zgłoś błąd:</h4>
  </div>
  <div class="card-body">
    <form action="?p=submit" method="post">
      <div class="mb-3">
        <label for="productReadonlySelect" class="form-label">Produkt:</label>
        <select class="form-select" id="productReadonlySelect" name="submitProductId" readonly>
          <?php
            $productId = intval($_GET["pid"]);
            $tableName = "product";
            $columnScheme = "name,description";
            $whereValue = "id = " . $productId;
            $result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
            if ( mysqli_num_rows($result) > 0 ) {
              $row = mysqli_fetch_row($result);
              echo "<option value=\"" . $productId . "\" selected>" .  $row[0] . " (" . $row[1] . ")</option>";
            }
          ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="productComponentsSelect" class="form-label">Komponent:</label>
        <select class="form-select" id="productComponentSelect" name="submitCompId">
          <option></option>
          <?php
            $tableName = "component";
            $columnScheme = "id,name,description";
            $whereValue = "productId = " . $productId;
            $result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
            if ( mysqli_num_rows($result) > 0 ) {
              while ( $row = mysqli_fetch_row($result) ) {
                echo "<option value=\"" . $row[0] . "\">" . $row[1] . " (" . $row[2] . ")</option>";
              }
            }
          ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="typeOfSubmitSelect" class="form-label">Rodzaj zgłoszenia:</label>
        <select class="form-select" id="typeOfSubmitSelect" name="submitTypeOf">
          <option value="problem">problem</option>
          <option value="ulepszenie">ulepszenie</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="submitSubjectInput" class="form-label">Temat zgłoszenia:</label>
        <input type="text" class="form-control" id="submitSubjectInput" name="submitSubject">
      </div>
      <div class="mb-3">
        <label for="submitDescription" class="form-label">Opis zgłoszenia:</label>
        <textarea class="form-control" id="submitDescription" name="submitDesc" rows="2"></textarea>
      </div> 
      <button type="submit" class="btn btn-primary">Zgłoś</button>
    </form>
  </div>
</div>
