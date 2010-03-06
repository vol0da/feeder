<?php
require "./feeder.php";

$feed = new Feeder('http://xmlfiles.com/examples/simple.xml');

?>
<!-- iba niektore fieldy -->
<table border="0" cellspacing="5" cellpadding="5">
  <tr>
    <th>name</th>
    <th>entry_fee</th>
    <th>start_time</th>
  </tr>
<?php
  foreach ($feed as $element) {
    echo "<tr>\n";
    echo "<td>" . $element->name . "</td>";
    echo "<td>" . $element->entry_fee . "</td>";
    echo "<td>" . $element->start_time . "</td>";
    echo "</tr>\n";
  }
?>
</table>

<!-- vsetky fieldy -->
<table border="0" cellspacing="5" cellpadding="5">
  <tr>
<?php
  foreach ($feed->fields() as $field) {
    echo "<th>$field</th>";
  }
?>
  </tr>
<?php
  foreach ($feed as $element) {
    echo "<tr>\n";
    foreach ($feed->fields() as $field) {
      echo "<td>" . $element->$field . "</td>";
    }
    echo "</tr>\n";
  }
?>
</table>