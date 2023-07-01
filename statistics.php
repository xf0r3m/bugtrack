<div class="card card-spacer">
  <div class="card-header">
    <h4>Statystyka:</h4>
  </div>
  <div class="card-body">
    <h5 class="card-title">W tej instacji BugTrack znajduje się:</h5>
    <ul>
      <li>
        <?php
          $tableName = "product";
          $columnScheme = "COUNT(id)";
          $whereValue = "1=1";
          $productResult = dbQuery($connection, $tableName, $columnScheme, $whereValue);
          echo "Produktów: <strong>" . getFieldValue($productResult) . "</strong>";
        ?>
      </li>
      <li>
        <?php
          $tableName = "component";
          $columnScheme = "COUNT(id)";
          $whereValue = "1=1";
          $componentResult = dbQuery($connection, $tableName, $columnScheme, $whereValue);
          echo "Komponentów: <strong>" . getFieldValue($componentResult) . "</strong>";
        ?>
      </li>
      <li>
        <?php
          $tableName = "bug";
          $columnScheme = "COUNT(id)";
          $whereValue = "1=1";
          $allBugsResult = dbQuery($connection, $tableName, $columnScheme, $whereValue);
          echo "Zgłoszeń: <strong>" . getFieldValue($allBugsResult) . "</strong>";
        ?>
      </li>
      <li>
        <?php
          $tableName = "bug";
          $columnScheme = "COUNT(id)";
          $whereValue = "state > 0 AND state < 3";
          $openBugsResult = dbQuery($connection, $tableName, $columnScheme, $whereValue);
          echo "Zgłoszeń otwartych: <strong>" . getFieldValue($openBugsResult) . "</strong>";
        ?>
      </li>
      <li>
        <?php
          $tableName = "bug";
          $columnScheme = "COUNT(id)";
          $whereValue = "state >= 3";
          $closedBugsResult = dbQuery($connection, $tableName, $columnScheme, $whereValue);
          echo "Zgłoszeń zamkniętych: <strong>" . getFieldValue($closedBugsResult) . "</strong>";
        ?>
      </li>
  </div>
</div>
