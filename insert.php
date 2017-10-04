<?php
   require("include/db.php");
   $feed_id = $_GET['feed_id'];
   $display_col = $_GET['display_col'];
   #echo $feed_id;
   #echo $display_col;
   $query = " INSERT INTO `feeds`(`displayColumn`, `link`) VALUES ($display_col, '$feed_id')";
   $rows = Query($db, $query);
   header("location: feeds.php");
   

?>