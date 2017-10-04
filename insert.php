<?php
   require("include/db.php");
   $feed_id = urldecode($_GET['feed_id']);
   $display_col = urldecode($_GET['display_col']);
   echo $feed_id;
   echo $display_col;
   #$query = " feeds where id = $id";
   #$rows = Query($db, $query);
   #header("location: index.php");
   

?>