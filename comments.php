<?php
  if ( isset($_POST) &&  isset($_POST["commentsBugId"]) ) {
    $tableName = 'comment';
    $columnScheme = "bugId,user,date,content";
    $setValue = intval($_POST["commentsBugId"]) . ",'" . $_SESSION["username"] . "','" . date("Y-m-d H:i:s") . "','" . mysqli_real_escape_string($connection, htmlspecialchars($_POST["commentsContent"])) . "'";
    $result = dbAdd($connection, $tableName, $columnScheme, $setValue);
  }
  $tableName = 'comment';
  $columnScheme = 'user,date,content';
  $whereValue = "bugId = " . intval($_GET["bid"]);
  $result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
  if ( mysqli_num_rows($result) > 0 ) {
    while ( $row = mysqli_fetch_row($result) ) {
      echo "<div class=\"card card-spacer\">";
      echo "<div class=\"card-header\">";
      echo "<strong>" . $row[0] . "</strong>, <em class=\"text-muted\">" . $row[1] . "</em> pisze...";
      echo "</div><div class=\"card-body\">" . $row[2] . "</div></div>";
    }
  }
  echo "<div class=\"card card-spacer\">
<form action=\"?p=comments&bid=" . intval($_GET["bid"]) . "\" method=\"post\">
  <div class=\"mb-3\">
    <label for=\"commentContentTextarea\" class=\"form-label\">Komentarz:</label>
    <input type=\"hidden\" name=\"commentsBugId\" value=\"" . intval($_GET["bid"]) . "\">
    <textarea class=\"form-control\" id=\"commnetContentTextarea\" rows=\"3\" name=\"commentsContent\"></textarea>
  </div>
  <button type=\"submit\" class=\"btn btn-primary\">Dodaj komentarz</button>
</form>
</div>";
?>

