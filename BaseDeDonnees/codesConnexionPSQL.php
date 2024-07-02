<?php

$conn = pg_connect("host=localhost port=5432 dbname=crepesco_test user=postgres password=postgres");
if (!$conn) {
  echo "Une erreur s'est produite.\n";
  exit;
}

$result = pg_query($conn, "SELECT NOM, UNITE FROM INGREDIENT");
if (!$result) {
  echo "Une erreur s'est produite.\n";
  exit;
}

while ($row = pg_fetch_row($result)) {
  echo "NOM: $row[0]  UNITE: $row[1]";
  echo "<br />\n";
}
