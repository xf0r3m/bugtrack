<?php
  $tableName = "product";
  $columnScheme = "name";
  $whereValue = "id = " . $_GET['pid'];
  $resultName = dbQuery($connection, $tableName, $columnScheme, $whereValue);
  $productName = getFieldValue($resultName);
?>   
  <form action="?p=changelog&pid=<?php echo $_GET['pid'] ?>" method="post">
      <div class="mb-3">
        <input type="hidden" name="changelogProductName" value="<?php echo $productName; ?>" />
        <input type="hidden" name="changelogProductId" value="<?php echo $_GET['pid']; ?>" />
        <label for="changelogVersionInput" class="form-label">Wersja produktu:</label>
        <input type="text" class="form-control" id="changelogVersionInput" name="changelogVersion" placeholder="1.2.3">
      </div>
      <?php
        $tableName = 'clform';
        $columnScheme = 'code';
        $whereValue = 'productId = ' . $_GET['pid'];
        $resultCLForm = dbQuery($connection, $tableName, $columnScheme, $whereValue);
        if ( mysqli_num_rows($resultCLForm) > 0 ) {
          $CLForm = getFieldValue($resultCLForm);
          echo $CLForm;
        } else {
          echo "<div class=\"alert alert-primary\">Nie zdefiniowano kodu formularza dla produktu</div>";
        }
        echo "<div class=\"mb-3\">";
        $tableName = 'bug';
        $columnScheme = 'id,componentId,subject';
        $whereValue = 'productId = ' . $_GET['pid'] . " AND state = 3";
        $resultBugs = dbQuery($connection, $tableName, $columnScheme, $whereValue);
        if ( mysqli_num_rows($resultBugs) > 0 ) {
          echo "<ul class=\"list-group\">";
          while ( $rowB = mysqli_fetch_row($resultBugs) ) {
            echo "<li class=\"list-group-item\">";
            echo "<span class=\"form-check\"><input class=\"form-check-input\" type=\"checkbox\" name=\"changelogBugId" . $rowB[0] . "\" value=\"" . $rowB[0] . "\" id=\"changelogBugId" . $rowB[0] . "\"><label class=\"form-check-label\" for=\"changelogBugId" . $rowB[0] . "\">";
            echo "<a href=\"?p=comments&bid=" . $rowB[0] . "\">#" . $rowB[0] . "</a>&nbsp;-&nbsp;";
            $tableName = 'component';
            $columnScheme = 'name';
            $whereValue = 'id = ' .  $rowB[1];
            $resultComp = dbQuery($connection, $tableName, $columnScheme, $whereValue);
            if ( mysqli_num_rows($resultComp) > 0 ) {
              $compName = getFieldValue($resultComp);
            } else {
              echo "<div class=\"alert alert-danger\">Nie znaleziono komponentu o podanym identyfikatorze.</div>";
            }
            echo "<strong>" . $compName . "</strong>&nbsp;-&nbsp;" . $rowB[2];
            echo "</label></span>";
            echo "<span class=\"form-check\"><input class=\"form-check-input\" type=\"checkbox\" name=\"changelogBugIdLC" . $rowB[0] . "\" value=1 id=\"changelogBugIdLC" . $rowB[0] . "\"><label class=\"form-check-label\" for=\"changelogBugIdLC" . $rowB[0] . "\">Dołącz ostatni komentarz ze zgłoszenia</label></span>";
            echo "</li>";
          }
        echo "</ul></div>";
        }
      ?>
      <div class="mb-3">
        <label for="changelogCommentTextArea" class="form-label">Komentarz</label>
        <textarea class="form-control" id="changelogCommentTextArea" name="changelogComment" rows="2" placeholder="To jest komentarz listy zmian."></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Wygeneruj listę zmian</button>
    </form>
