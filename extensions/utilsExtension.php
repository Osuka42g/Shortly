<?php
	//	/extensions/utilsExtension.php
	//	define some stuff we need day by day...


	//	define if a string is a valid email format

	function is_email_format($var = false) {
		if($var) {
			if(filter_var($var, FILTER_VALIDATE_EMAIL) === false) {
			   return false;
			}
			else {
				return true;
			}
		}
		return false;
	}


	// returns if valid url

	function is_valid_url($url) {
		if(filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
        	return false;
		} else {
			return true;
		}

		return false;
	}

	function get_uniqid($lenght) {
		$lenght *= -1;
		return substr(md5(uniqid(rand(), true)), $lenght);
	}

	//	converts a mysql result into an array

	function mysql_to_array($result = false) {
		if(!$result)
			return false;

		while($row = mysql_fetch_assoc($result)) { 
		   $result_array[] = $row; 
		}

		return $result_array;
	}


	function get($param = null) {
		return $_GET[$param];
	}

	function consume_json($url) {
		$service_url = $url;
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

		$curl_response = curl_exec($curl);

		curl_close($curl);
		$json = json_decode($curl_response, true);
   		return $json;
	}
?>