<?php
   require("include/db.php");
   $id = urldecode($_GET['id']);
   $query = "DELETE FROM feeds where id = $id";
   $rows = Query($db, $query);
   header("location: feeds.php");
   

?>