<?php
	//script to generate a activity.json file
	//TODO: use boards.json to minimize code

	// use boards.json to get available boards
	//$boards = json_decode(file_get_contents("../boards.json"));

	$times = array();
	$latest = array();

/*	foreach($boards as $board) {
		array_push($merged[$board], json_decode(file_get_contents("../" . $board . "/catalog.json")));
		//$merged = json_decode(file_get_contents("../" . $board . "/catalog.json"));
		//file_put_contents("res/" . $key . ".json", json_encode($value));
	}
*/
	// get json data
	$a = json_decode(file_get_contents("../a/catalog.json"));
	$b = json_decode(file_get_contents("../b/catalog.json"));
	$g = json_decode(file_get_contents("../g/catalog.json"));
	$wow = json_decode(file_get_contents("../wow/catalog.json"));
	
	// extract timestamps
	foreach ($a as $key1) {
		foreach($key1->threads as $rows) {
			foreach($rows as $key => $val) {
				if($key == "bumped") {
					array_push($times, $val);
				}
			}
		}
	}

	foreach ($b as $key1) {
		foreach($key1->threads as $rows) {
			foreach($rows as $key => $val) {
				if($key == "bumped") {
					array_push($times, $val);
				}
			}
		}
	}

	foreach ($g as $key1) {
		foreach($key1->threads as $rows) {
			foreach($rows as $key => $val) {
				if($key == "bumped") {
					array_push($times, $val);
				}
			}
		}
	}

	foreach ($wow as $key1) {
		foreach($key1->threads as $rows) {
			foreach($rows as $key => $val) {
				if($key == "bumped") {
					array_push($times, $val);
				}
			}
		}
	}
	
	//sort per timestamp
	function sortByLastPost($a, $b) {
		return $a > $b ? -1 : 1;
	}
	usort($times, "sortByLastPost");
	
	// recheck all posts agains 5 newest timestamps and extract relevant data
	foreach ($a as $key1) {
		foreach($key1->threads as $rows) {
			foreach($rows as $key => $val) {
				foreach($times as $num => $timestamp) {
					if ($key == "bumped" && $val == $timestamp) {
						array_push($latest, array("boardflag" => "a", "board" => "Anime", "id" => $rows->id, "message" => $rows->message, "subject" => $rows->subject, "file" => $rows->file, "bumped" => $rows->bumped));
					}
				}
			}
		}
	}

	foreach ($b as $key1) {
		foreach($key1->threads as $rows) {
			foreach($rows as $key => $val) {
				foreach($times as $num => $timestamp) {
					if ($key == "bumped" && $val == $timestamp) {
						array_push($latest, array("boardflag" => "b", "board" => "Random", "id" => $rows->id, "message" => $rows->message, "subject" => $rows->subject, "file" => $rows->file, "bumped" => $rows->bumped));
					}
				}
			}
		}
	}

	foreach ($g as $key1) {
		foreach($key1->threads as $rows) {
			foreach($rows as $key => $val) {
				foreach($times as $num => $timestamp) {
					if ($key == "bumped" && $val == $timestamp) {
						array_push($latest, array("boardflag" => "g", "board" => "Technology", "id" => $rows->id, "message" => $rows->message, "subject" => $rows->subject, "file" => $rows->file, "bumped" => $rows->bumped));
					}
				}
			}
		}
	}

	foreach ($wow as $key1) {
		foreach($key1->threads as $rows) {
			foreach($rows as $key => $val) {
				foreach($times as $num => $timestamp) {
					if ($key == "bumped" && $val == $timestamp) {
						array_push($latest, array("boardflag" => "wow", "board" => "World of Warcraft", "id" => $rows->id, "message" => $rows->message, "subject" => $rows->subject, "file" => $rows->file, "bumped" => $rows->bumped));
					}
				}
			}
		}
	}

	//also sort latest too
	function sortByLastPost2($a, $b) {
		return $a["bumped"] > $b["bumped"] ? -1 : 1;
	}
	usort($latest, "sortByLastPost2");

	// finall write to activity.json
	file_put_contents('../activity.json', json_encode($latest));
?>