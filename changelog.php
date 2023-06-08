<?php
if ( session_status() != 2 ) {
  session_start();
}
if ( isset($_SESSION['username']) ) {

  if ( ( ! empty($_POST)) && isset($_POST["changelogVersion"])) {
    $productName = $_POST["changelogProductName"];
    $version = $_POST["changelogVersion"];

    if ( ! is_dir("changelogs/" . $productName) ) { 
      mkdir("changelogs/" . $productName);
      copy("changelogs/index.php", "changelogs/" . $productName . "/index.php");
    }
    @ $fTxt = fopen("changelogs/" . $productName . "/" . $version . ".txt", "wb");
    @ $fMd = fopen("changelogs/" . $productName . "/" . $version . ".md", "wb");
    @ $fHTML = fopen("changelogs/" . $productName . "/" . $version . ".html", "wb");

    $filePath = "changelogs/" . $productName . "/" . $version;

    $tableName = 'changelog';
    $columnScheme = '*';
    $whereValue = "productId = " . $_POST["changelogProductId"] . " AND version = '" . $version . "'";
    $resultSearchChangelog = dbQuery($connection, $tableName, $columnScheme, $whereValue);
    if ( mysqli_num_rows($resultSearchChangelog) == 0 ) {
      $tableName = 'changelog';
      $columnScheme = "productId,version,filepath";
      $setValues = intval($_POST["changelogProductId"]) . ",'" . $version . "','" . $filePath . "'";
      $resultAddChangelog = dbAdd($connection, $tableName, $columnScheme, $setValues);
      if ( $resultAddChangelog == true ) {
        echo "<div class=\"alert alert-success\" role=\"alert\">Lista zmian dla wersji " . $version . " produktu " . $productName . " została pomyślnie wygenerowana</div>";
      } else {
        echo "<div class=\"alert alert-danger\" role=\"alert\">Lista zmian nie została wygenerowana</div>";
      }
    } else {
      echo "<div class=\"alert alert-success\" role=\"alert\">Lista zmian dla wersji " . $version . " produktu " . $productName . " została pomyślnie wygenerowana</div>";
    }

    #echo $productName . " - wersja: " . $version . "<br />";

    $msgTxt = $productName . " - wersja: " . $version . "\n";
    $msgMd = "##### " . $productName . " - wersja: *" . $version . "*\n";
    $msgHtml = "<h5>" . $productName . "</h5> <h6>&nbsp;&nbsp- wersja: <strong>" . $version . "</strong></h6><br />\n";

    fwrite($fTxt, $msgTxt);
    fwrite($fMd, $msgMd);
    fwrite($fHTML, $msgHtml);
    
    $tableName = 'dictionary';
    $columnScheme = 'dictionary';
    $whereValue = 'productId = ' . $_POST['changelogProductId'];
    $resultDict = dbQuery($connection, $tableName, $columnScheme, $whereValue);
    if ( mysqli_num_rows($resultDict) > 0 ) {
      $dict=getFieldValue($resultDict);
      $dictWords = explode(',', $dict);
    }
    
    fwrite($fHTML, "<ol>\n");

    $lp = 1;
    foreach ( $_POST as $key => $value ) {

      if ( empty($value) ) { continue; } 
      if ( (preg_match('/changelogBugIdLC\d+/', $key) == 0) && (preg_match('/changelogBugId\d+/', $key) == 0) ) {
        
        if ( preg_match('/changelog/', $key) == 0 ) {
          fwrite($fHTML, "<li>\n");
          #echo "Sprawdź w słowniku: $key <br />";
          $name = $key;
          for ($i=0; $i < count($dictWords); $i++) {
            if ( preg_match("/". $name . "=>/", $dictWords[$i]) == 1 ) {
              $dictExpr = explode('=>', $dictWords[$i]);
              if ( strlen($value) > 1 ) {
                #echo $lp . ". " . $dictExpr[1] . "<br />&nbsp;&nbsp;" . $value . "<br /><br />";

                $msgTxt = $lp . ". " . $dictExpr[1] . "\n\t" . $value . "\n\n";
                $msgMd = $lp . ". " . $dictExpr[1] . "\n\t" . $value . "\n\n";
                $msgHtml = $dictExpr[1] . "<br />&nbsp;&nbsp;" . $value . "<br /><br />\n";

                fwrite($fTxt, $msgTxt);
                fwrite($fMd, $msgMd);
                fwrite($fHTML, $msgHtml);

              } else {
                #echo $lp . ". " . $dictExpr[1] . "<br /><br />";
                
                $msgTxt = $lp . ". " . $dictExpr[1] . "\n\n";
                $msgMd = $lp . ". " . $dictExpr[1] . "\n\n";
                $msgHtml = $dictExpr[1] . "<br /><br />\n";

                fwrite($fTxt, $msgTxt);
                fwrite($fMd, $msgMd);
                fwrite($fHTML, $msgHtml);

              }
            }
          }
          $lp++;
          fwrite($fHTML, "</li>\n");
        }
      }
      if ( preg_match('/changelogBugId\d+/', $key) == 1 ) {
        fwrite($fHTML, "<li style=\"text-align: justify\">\n");
        #echo "Pobranie danych z bazy: $key <br />";
        $tableName = 'bug';
        $columnScheme = "id,componentId,subject,description";
        $whereValue = "id = " . $value;
        $resultBug = dbQuery($connection, $tableName, $columnScheme, $whereValue);
        if ( mysqli_num_rows($resultBug) > 0 ) {
          $rowBug = mysqli_fetch_row($resultBug);
          $tableName = "component";
          $columnScheme = "name";
          $whereValue = "id = " . $rowBug[1];
          $resultComp = dbQuery($connection, $tableName, $columnScheme, $whereValue);
          if ( mysqli_num_rows($resultComp) > 0 ) {
            $compName = getFieldValue($resultComp);
          }
          #echo $lp . ". #" . $rowBug[0] . "&nbsp;-&nbsp;" . $compName . "&nbsp;-&nbsp;" . $rowBug[2] . "<br />";
          
          if ( ! empty($_SERVER['HTTPS']) ) { $serverProtocol = "https://"; }
          else { $serverProtocol = "http://"; }

          $msgTxt = $lp . ". #" . $rowBug[0] . " - " . $compName . " - " . $rowBug[2] . "\n";
          $msgMd = $lp . ". [#" . $rowBug[0] . "](" . $serverProtocol . $_SERVER['SERVER_NAME'] . "/index.php?p=comments&bid=" . $rowBug[0] . ") - " . $compName . " - " . $rowBug[2] . "\n";
          $msgHtml = "<a href=\"" . $serverProtocol . $_SERVER['SERVER_NAME'] . "/index.php?p=comments&bid=" . $rowBug[0] . "\">#" . $rowBug[0] . "</a>&nbsp;-&nbsp;" . $compName . "&nbsp;-&nbsp;" . $rowBug[2] . "<br />\n";

          fwrite($fTxt, $msgTxt);
          fwrite($fMd, $msgMd);
          fwrite($fHTML, $msgHtml);

          $content = array();
          #$content = formatTo80Cols($rowBug[3], "&nbsp;&nbsp;", "<br />");
          $content = newFormatTo80Cols($rowBug[3], "&nbsp;&nbsp;", "<br />");

          foreach ( $content as $line ) {
            #echo $line;
            $msgHtml = $line . "\n";
            fwrite($fHTML, $msgHtml); 
          }
          $content = newFormatTo80Cols($rowBug[3], "\t", "\n");
          #$content = formatTo80Cols($rowBug[3], "\t", "\n");
          foreach ( $content as $line ) {
            fwrite($fTxt, $line);
            fwrite($fMd, $line);
          }
        }
        $assembledKey="changelogBugIdLC" . $value;
        if ( isset($_POST[$assembledKey]) && ( $_POST[$assembledKey] === "1" ) ) {

          #echo "<br />";

          fwrite($fTxt, "\n");
          fwrite($fMd, "\n");
          fwrite($fHTML, "<br />");

          $tableName = "comment";
          $columnScheme = "id,content";
          $whereValue = "bugId = " . $value . " ORDER BY id DESC";
          $resultComment = dbQuery($connection, $tableName, $columnScheme, $whereValue);
          if ( mysqli_num_rows($resultComment) > 0 ) {
            #mysqli_data_seek($resultComment, 1);
            $commentRow = mysqli_fetch_row($resultComment);
            while ( preg_match('/^Status\ zgłoszenia/', $commentRow[1]) == 1 ) {
              $commentRow = mysqli_fetch_row($resultComment);
            }
            #echo $commentRow[1] . "<br />";
            #$comment = formatTo80Cols($commentRow[1], "&nbsp;&nbsp;", "<br />");
            $comment = newFormatTo80Cols($commentRow[1], "&nbsp;&nbsp;", "<br />");
            foreach ( $comment as $commentLine ) {
              if ( preg_match('/https/', $commentLine) == 1 ) {
                $htmlSpecialChr = array("&nbsp;&nbsp;", "<br />");
                $msgHtml = "&nbsp;&nbsp;<a href=\"" . trim(str_replace($htmlSpecialChr,"", $commentLine)) . "\">" .  trim(str_replace($htmlSpecialChr,"", $commentLine)) . "</a><br />\n";
                #echo $msgHtml;
              } else {
                #echo $commentLine;
                $msgHtml = $commentLine . "\n";
              }
              fwrite($fHTML, $msgHtml);
            }
            #$comment = formatTo80Cols($commentRow[1], "\t", "\n");
            $comment = newFormatTo80Cols($commentRow[1], "\t", "\n");
            foreach ( $comment as $commentLine ) {
              if ( preg_match('/https/', $commentLine) == 1 ) {
                $msgMd = "\t[" . trim($commentLine) . "](" . trim($commentLine) . ")\n";
                fwrite($fMd, $msgMd);
                $msgTxt = "\t" . trim($commentLine) . "\n";
                fwrite($fTxt, $msgTxt);
              } else {
                fwrite($fMd, $commentLine);
                fwrite($fTxt, $commentLine);

              }
            }
          }
        #echo "Pobrać ostatni komentarz dla zgłoszenia: #" . $value . "<br />";
        }
        $lp++;
        fwrite($fHTML, "</li>\n");
        #echo "<br />";

        fwrite($fTxt, "\n");
        fwrite($fMd, "\n");
        fwrite($fHTML, "<br />");
      }
      
        
    }
    
    fwrite($fHTML, "</ol>\n");
  
    #echo "Uwagi:<br />";
    if ( ! empty($_POST["changelogComment"]) ) { 
      $msgTxt = "Uwagi:\n";    
      $msgHtml = "Uwagi: <br />";

      fwrite($fTxt, $msgTxt);
      fwrite($fMd, $msgTxt);
      fwrite($fHTML, $msgHtml);

      $notices = array();
      #$notices = formatTo80Cols($_POST["changelogComment"], "&nbsp;&nbsp;", "<br />");
      $notices = newFormatTo80Cols($_POST["changelogComment"], "&nbsp;&nbsp;", "<br />");
      foreach ( $notices as $line ) {
        #echo $line;
        fwrite($fHTML, $line);
      }
      #$notices = formatTo80Cols($_POST["changelogComment"], "\t", "\n");
      $notices = newFormatTo80Cols($_POST["changelogComment"], "\t", "\n");
      foreach ( $notices as $line ) {
        fwrite($fTxt, $line);
        fwrite($fMd, $line);
      }
    }
    #echo $_POST["changelogComment"];
    fclose($fTxt);
    fclose($fMd);
    fclose($fHTML);
  }
  $tableName = "product";
  $columnScheme = "name";
  $whereValue = "id = " . $_GET["pid"];
  $resultName = dbQuery($connection, $tableName, $columnScheme, $whereValue);
  if ( mysqli_num_rows($resultName) ) {
    $productName = getFieldValue($resultName);
  } else {
    echo "<div class=\"alert alert-danger\" role=\"alert\">Nie znaleziono produktu o takim identyfikatorze</div>";
    exit;
  }
  
  echo "<div class=\"card card-spacer\">
  <div class=\"card-header\">
    <h4>Wygenerowane listy zmian dla: " . $productName . "</h4>
  </div>
  <div class=\"card-body\">";

  $tableName = "changelog";
  $columnScheme = "filepath";
  $whereValue = "productId = " . $_GET["pid"];
  $resultChangelogs = dbQuery($connection, $tableName, $columnScheme, $whereValue);
  if ( mysqli_num_rows($resultChangelogs) > 0 ) {
    echo "<table class=\"table\"><thead></thead><tbody>";
    while ( $rowCh = mysqli_fetch_row($resultChangelogs) ) {
      echo "<tr>";
      echo "<td scope=\"row\"><a href=\"?p=viewchlog&path=" . $rowCh[0] . "\">" . basename($rowCh[0]) . "</a></td>";
      echo "<td><a href=\"" . $rowCh[0] . ".txt\"><button type=\"button\" class=\"btn btn-primary\">.txt</button></a></td>";
      echo "<td><a href=\"" . $rowCh[0] . ".md\"><button type=\"button\" class=\"btn btn-primary\">.md</button></a></td>";
      echo "<td><a href=\"" . $rowCh[0] . ".html\"><button type=\"button\" class=\"btn btn-primary\">.html</button></a></td>";
      echo "</tr>";
    }
    echo "</tbody></table>";
  } else {
    echo "<div class=\"alert alert-primary\">Nie znaleziono żadnych list zmian pasujących do produktu</div>";
  }
  echo "</div>
</div>
<div class=\"card card-spacer\">
  <div class=\"card-header\">
    <h4>Nowa lista zmian dla: " . $productName . "</h4>
  </div>
  <div class=\"card-body\">";
  include('forms/changelogform.php');
} else {
  include("403.php");
}
?>

