<?php
	//script to generate a boards.json file
	$boards_array = array(
		array(
			"board" => "a",
			"title" => "anime"
		),
		array(
			"board" => "b",
			"title" => "random"
		), 
		array(
			"board" => "g",
			"title" => "technology"
		),
		array(
			"board" => "wow",
			"title" => "world of warcraft"
		), 
	);

	//boards.json
	file_put_contents('../boards.json', json_encode($boards_array));
?>