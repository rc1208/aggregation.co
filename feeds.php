<?php
require("include/db.php");
require("include/header.php");
require("include/nav.php");

// Get all the user's feeds
$query = "SELECT * FROM feeds";
$rows = Query($db, $query);
echo "<html> <head><link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>
</head></html>";
echo "<form action= 'insert.php' method = 'get'>
       <div class='form-group'>
			<input type='text' class='form-control' placeholder ='Enter your new feed URL here https://...' name='feed_id'>
	   </div>
	   
	   <div class='form-group'>
		  <label>Select display column:</label>
		  <select class='form-control' name='display_col'>
			<option>1</option>
			<option>2</option>
			<option>3</option>
		  </select>
       </div>
	   <button type='submit' class='btn btn-outline-primary'>Add feed</button>
	   </form>";
function FeedIcon($link)
{
        // Feed favicon.ico
        $url = preg_replace('/^https?:\/\//', '', $link);
        if ($url != "") {
                $imgurl = "https://www.google.com/s2/favicons?domain=";
                $imgurl .= $url;

                echo "<div class=\"feedsListIcon\">";
                "\" type=\"image/x-icon\"></div>\n";
                echo '<img src="';
                echo $imgurl;
				
                echo '" width="16" height="16" />';
				
                echo "</div>\n";
				
        }


}

// Create an array of links and titles
foreach ($rows as $row) {
	echo "<article>";
	$rss = simplexml_load_file($row['link']);
	if ($rss) {
		FeedIcon($row['link']);

		if (strlen($rss->channel->title) == 0) {
			echo "<span class=\"feedsListTitle\">" .
			    "<a href=\"http://aggregation.co/?feed=" .
			    $row['id'] .
			    "\">" .
			    $row['link'] .
			    "</a></span>\n";
				
/*
			echo "<span class=\"feedsListTitle\">" .
			    $row['link'] . "</span>\n";
*/
		} else {
			echo "<div class=\"feedsListTitle\">" .
			    "<a href=\"http://aggregation.co/?feed=" .
			    $row['id'] .
			    "\">" .
			    $rss->channel->title .
			    "</a></div>\n";
			$feed_id = $row['id'];	
			
			echo "<div><a href = 'delete.php?id= $feed_id'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a></div>";	
/*
			echo "<span class=\"feedsListTitle\">" .
			    $rss->channel->title . "</span>\n";
*/
		}
		echo "<div class=\"feedsListLink\">" .  $row['link'] .
		    "</div>\n";

	} else {
		echo "<div>" . $row['link'] . " not found</div>\n";
	}
	echo "</article>\n";
}

require("include/footer.php");
