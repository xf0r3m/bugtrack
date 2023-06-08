<?php
  if ( ! empty($_SERVER['HTTPS']) ) { $serverProtocol = "https://"; }
  else { $serverProtocol = "http://"; }
  $uri = str_replace('/', '', $_SERVER['REQUEST_URI']);
  header("Location: " . $serverProtocol . $_SERVER['SERVER_NAME'] . "?p=" . $uri);
?>
