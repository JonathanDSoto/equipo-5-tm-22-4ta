<?php 
	session_start();

	if (!isset($_SESSION['global_token'])) {
		$_SESSION['global_token'] = md5( uniqid( mt_rand(),true ) );
	}
	
	if (!defined('BASE_PATH')) {
		define('BASE_PATH','http://localhost/equipo-5-tm-22-4ta/');
	}
	
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	function validateId($id){

		if (filter_var($id, FILTER_VALIDATE_INT) && $id > 0) {
			return true;
		}
		return false;
	}
	
	function getSpecificPresentation($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations/'.$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token']
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);

		if ( isset($response->code) && $response->code == 4) {
			
			return $response->data;
		}else{

			return array();
		}

    }
	function getSpecificProduct($id){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/'.$id,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'Authorization: Bearer '.$_SESSION['token']
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$response = json_decode($response);
		
		if ( isset($response->code) && $response->code > 0) {
			
			return $response->data;
		}else{

			return false;
		}
	}

	function getSpecificClient($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/clients/'.$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token'],
            'Cookie: XSRF-TOKEN=eyJpdiI6Iko2S0JzL1gvb0Z0QkgyZGFMSzgxbXc9PSIsInZhbHVlIjoiWldrYTEzc2FDekUxTlpHNFBKQVlQZ25NT3I3TzRKNmh5QkNxYUpROWc2QW0xZk54ekpWZ2xOZ3NwN2pqRWE1ekJLR2VvZFdPbi9ZeDRPTkJYY3R5dVRCdmhqb1hvV1hwM3lYVWd6QkR0dWNtOGJuVHJZWWpQYzJMNU5ibXZYU28iLCJtYWMiOiI4NDRmMDNlM2IzNTlkYjEwMGI5YWEwODI2OTAxMDlhYzIxYjJhZTZhNTk0Y2ZjZGViNTZhM2E4NDAwY2Y3Y2MyIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImZEWjlrNytRcGtIT0pkM3RrbVpBMWc9PSIsInZhbHVlIjoiSW5jUDdoWFBocVFRR2pXTStwbUx2czdCT3RyOEtVQ2VIOTJnQm9UdjZMa2dYbWtpQUJIM1dTYk9GSU5xOTNhT1FBR081LzhhVkR4Z1l5N2NOT0dBbEhzQ2hRM3BiOHNaS2xBUHkzQUM1aDRUeDhaMGpxTzgvVFdZQ3ZtZG93dngiLCJtYWMiOiJhODU4YWVlZGRjOTY5NTBkODJkNzdkZWZiZTY5ODI0OTIwM2Q2MTM4NWFmM2Y3YTc1YTM4YzM0M2FjMDlkZDhjIiwidGFnIjoiIn0%3D'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);

        if( isset($response->code) && $response->code == 4){
            return $response->data;
        }else{
            return false;
        }
    }
	function getSpecificCoupon($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/coupons/'.$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token'],
            'Cookie: XSRF-TOKEN=eyJpdiI6Ikd6NjhZMGtucnNwcFRUNzVNSTltQ3c9PSIsInZhbHVlIjoiMXJJOVBkWTNFdjRzOHhvRGhTUmlDWDJsUG5tdFg4Tk1RT2xjYmZEUVJPWlJlaHJFYjIybUFNTTZHUERLeDNzWUcwQmtSanJ0UG01Zk8xd1ZkbDhHRmtUbjJOZWNYb292Y29wR3ZoSjduWnZCZmQzZ0ttZXBCVm5NL0MzR3pVQjIiLCJtYWMiOiJmZTI5ZTdjOGRjNTc3YTcwZGM4Y2UzOWIzNzcwMzI2N2UwODIyMGJmZDJkZmM3ZDIwYThiOTQ4MDEzNGViZWI1IiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlpkVmJKTWJtcFpBM2tXaGZwTHZFbWc9PSIsInZhbHVlIjoiZWI1UllCTUIyeEtJekEzZnVBSTJiUzU0dXl0bDFsb1ZOZC9EOGtwTkJidjhkcm96cDBXMmIweXA2NXBzbUNyVllaY1IzSXV0VStVZlJ2V1NpeEsveW5BWWxpeDJzSVV2QnZhMFBOUWg2NXpSTGFNOGkvYmhZeTN4aDJDMlVRNkYiLCJtYWMiOiI0YThiNDg2Y2FkNmFkNTU3ZWJiNzNjOTM5OWUwMGQ2YTI4NzI5NTMyYjlhZmIxZTE2OTAzYjJjOWIwODgzYzA3IiwidGFnIjoiIn0%3D'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);

		if ( isset($response->code) && $response->code == 4) {
			
			return $response->data;
		}else{

			return array();
		}

    }
?>