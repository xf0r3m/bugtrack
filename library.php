<?php

function mysqliResult($connection, $result) {
  if ( (mysqli_num_rows($result) > 0) || ($result == true) ) {
    if ( ! isset($_SERVER["SHELL"]) ) {
      echo "<script>console.log('Zapytanie powiodło się.')</script>";
    }
    return true;
  } else {
    echo "<script>console.log('Zapytanie nie powiodło się: " . mysqli_error($connection) . "');</script>";
    return false;
  }
}

function dbQuery($connection, $tableName, $columnScheme, $whereValue, $debug=0) {
  $query = "SELECT " . $columnScheme . " FROM " . $tableName . " WHERE " . $whereValue;
  if ( $debug == 1 ) { var_dump($query); }
  $result = mysqli_query($connection, $query);
 
  if ( mysqliResult($connection, $result) ) {
    return $result;
  } else {
    echo "<script>console.log('Pobranie danych z bazy jest niemożliwe');</script>";
  }

}

function getFieldValue($result) {
  $row = mysqli_fetch_row($result);
  return $row[0];
}

function dbUpdate($connection, $tableName, $setValue, $whereValue) {
  $query = "UPDATE " . $tableName . " SET " . $setValue . " WHERE " . $whereValue;
  $result = mysqli_query($connection, $query);
 
  if ( mysqliResult($connection, $result) ) {
    return $result;
  } else {
    echo "<script>console.log('Zmiana danych w bazie jest niemożliwa');</script>";
  }

}

function dbAdd($connection, $tableName, $columnScheme, $setValues) {
  $query = "INSERT INTO " . $tableName . " (" . $columnScheme . ") VALUES (" . $setValues . ");";
  $result = mysqli_query($connection, $query);

  if ( mysqliResult($connection, $result) ) {
    return $result;
  } else {
    echo "<script>console.log('Dodanie danych do bazy jest niemożliwa');</script>";
  }
}

function dbDel($connection, $tableName, $whereValue) {
  $query = "DELETE FROM " . $tableName . " WHERE " . $whereValue;
  $result = mysqli_query($connection, $query);

  if ( mysqliResult($connection, $result) ) {
    return $result;
  } else {
    echo "<script>console.log('Usunięcie danych z bazy jest niemożliwa');</script>";
  }
}

function siteListProducts($connection, $page) {  
  echo "<div class=\"card card-spacer\">
  <div class=\"card-header\">
    <h4>Lista produktów:</h4>
  </div>
  <div class=\"card-body\">";
  $tableName = "product";
  $columnScheme = "*";
  $whereValue = "1=1";
  $result = dbQuery($connection, $tableName, $columnScheme, $whereValue);
  if ( mysqli_num_rows($result) > 0 ) {
    echo "<ul class=\"list-group\">";
    while ( $row = mysqli_fetch_row($result) ) {
      echo "<li class=\"list-group-item\"><a href=\"?p=" . $page . "&pid=" . $row[0] ."\">";
      echo $row[1] . "</a> (<em>". $row[2] ."</em>, <span class=\"text-muted\">" . $row[3] . "</span>)</li>";
    }
    echo "</ul>";
  } else {
    echo "<div class=\"alert alert-primary\" role=\"alert\">Nie znaleziono żadnych produktów</div>";
  }
  echo "</div></div>";
}

function newFormatTo80Cols($long_string, $linePrefix, $eolSign) {
  $content = array();
  if ( strlen($long_string) > 80 ) { 
    $toExplode = wordwrap($long_string, 80, "|", false);
    $exploded = explode("|", $toExplode);
    $i=0;
    foreach ( $exploded as $line ) {
      $content[$i] = $linePrefix . $line . $eolSign;
      $i += 1;
    }
  } else {
    $content[0] = $linePrefix . $long_string . $eolSign;
  }
  return $content;
}

?>
          
