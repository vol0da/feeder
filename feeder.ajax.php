<?php
$feed_id = (int) $_GET['feed_id'];
if (empty($feed_id)) {
  exit;
}

require_once "./feeder.class.php";
require_once "./feeder.config.php";

$feed = new Feeder($feeds[$feed_id]['url']);

return include "feeder.template.php";
?>
