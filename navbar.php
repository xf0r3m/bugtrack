  <nav class="navbar navbar-expand-lg">
	  <div class="container-fluid">
      <a class="navbar-brand active" aria-current="page" href="http://<?php echo $_SERVER["SERVER_NAME"];?>">BugTrack</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link frontpage-link" href="?p=siteListProducts&site=submit">Zgłoś błąd</a>
          </li>
		      <li class="nav-item">
            <a class="nav-link frontpage-link" href="?p=bugs">Zgłoszone błędy</a>
          </li>
            <?php
              session_start();
              if ( isset($_SESSION["username"]) ) {
                echo "<li class=\"nav-item\"><a class=\"nav-link frontpage-link\" href=\"?p=history\">Zachowane zgłoszenia</a></li>";
                echo "<li class=\"nav-item\"><a class=\"nav-link frontpage-link\" href=\"?p=siteListProducts&site=changelog\">Lista zmian</a></li>";
                echo "<li class=\"nav-item\"><a class=\"nav-link frontpage-link\" href=\"?p=settings\">Ustawienia</a></li>";
                echo "<li class=\"nav-item\"><span class=\"nav-link navbar-greetings\">Witaj, " . $_SESSION["username"] . "! (<a class=\"frontpage-link\" href=\"?p=logout\">Wyloguj się</a>)</span></li>";
              } else {
                echo "<li class=\"nav-item\"><a class=\"nav-link frontpage-link\" href=\"?p=login\">Zaloguj się</a></li>";
              }
            ?>
        </ul>
      </div>
    </div>
  </nav>
