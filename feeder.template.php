<h3><?php echo $feeds[$feed_id]['name']; ?></h3>

<table border="0" cellspacing="5" cellpadding="5">
  <tr>
<?php
  foreach ($feed->fields() as $field) {
    echo "<th>$field</th>";
  }
?>
  </tr>
<?php
  $class = 'odd';
  foreach ($feed as $element) {
    
    $class = ($class == '') ? 'odd' : '';
    
    echo "<tr class=\"$class\">\n";
    foreach ($feed->fields() as $field) {
      echo "<td>" . $element->$field . "</td>";
    }
    echo "</tr>\n";
  }
?>
</table>