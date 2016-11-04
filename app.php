<?php
	// 	app.php
	//	where you make the magic stuff

	global $default_config;
	global $GLOBALS_DOMAIN;

	function index() {
		if($_GET['pApifw'] == null || $_GET['pApifw'] == 'index') {
			welcome();
		} else {
			$url = $GLOBALS_DOMAIN;
			$short = $_GET['pApifw'];
			$sql = select('urls', ['short' => $short]);
			if($sql != null) {
				$url = $sql[0]['original'];
				$hits = intval($sql[0]['hits']);
				$hits++;
				$query = 'UPDATE urls SET hits = "'.$hits.'" WHERE id = "'.intval($sql[0]['id']).'"';
				mysql_query($query);
			} else {
				$sql = select('urls', ['custom' => $short]);
				if($sql != null) {
					$url = $sql[0]['original'];
					$hits = intval($sql[0]['hits']);
					$hits++;
					$query = 'UPDATE urls SET hits = "'.$hits.'" WHERE id = "'.intval($sql[0]['id']).'"';
					mysql_query($query);
				}
			}

			header('Location: '.$url);
		}
	}


	function allUrls() {
		output(select('urls'));
	}



	function idInfo($uniqid = null) {
		if($uniqid != null) {
			$sql = select('urls', ['short' => $uniqid]);
			if($sql != null) {
				output($sql);
			} else {
				output_error('211', 'uniqueId not found');
			}
		} else {
			output_error('210', 'null uniqueId');
		}
	}


	function customInfo($uniqid = null) {
		if($uniqid != null) {
			$sql = select('urls', ['custom' => $uniqid]);
			if($sql != null) {
				output($sql);
			} else {
				output_error('216', 'customId not found');
			}
		} else {
			output_error('215', 'null customId');
		}
	}



	function newUrl() {
		global $FORBIDDEN_NAMES;
		
		$error = null;

		$url = get('url');
		$custom = get('custom');

		if(!is_valid_url($url)) {
			output_error('220', 'invalid url');
			die();
		}

		if($custom != null) {
			if($FORBIDDEN_NAMES[$custom] != null) {
				output_error('222', "that's not a valid url, please try with another one");
				die();
			}

			if(select('urls', ['custom' => $custom])) {
				output_error('221', 'custom url already in use');
				die();
			}
		}

		do {
			$short = get_uniqid(5);
			$sql = select('urls', ['short' => $short]);
		} while($sql != null);

		$ip = $_SERVER['REMOTE_ADDR'];

		db_insert('urls', ['id' => null, 'original' => $url, 'short' => $short, 'custom' => $custom, 'hits' => '0', 'ip' => $ip]);
		output(last_record('urls'));
	}




	// to do:
	//
	//	xss vuln?: http://localhost/shortly/newUrl/?url=javascript:////foobar%0Aalert(1)
?>