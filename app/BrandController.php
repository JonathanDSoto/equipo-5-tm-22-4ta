<?php
include_once "config.php";

if (isset($_POST['action'])) {

	if ( isset($_POST['global_token']) && 
	$_POST['global_token'] == $_SESSION['global_token']) {
			
		switch ($_POST['action']) {
			case 'create':
				$name = strip_tags($_POST['name']);
				$description = strip_tags($_POST['description']);
				$slug = strip_tags($_POST['slug']);

				BrandController::createBrand($name, $description, $slug);
				 
			break; 

			case 'update':
				//update brand
				break;

			case 'delete':
				//delete brand
				break; 
		}

	}
}
Class BrandController
{
	public static function getBrands()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://crud.jonathansoto.mx/api/brands',
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

	public static function createBrand($name, $description, $slug){

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://crud.jonathansoto.mx/api/brands',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array('name' => $name,'description' => $description,'slug' => $slug),
		  CURLOPT_HTTPHEADER => array(
			'Authorization: Bearer '.$_SESSION['token']
		  ),
		));
		
		$response = curl_exec($curl);
		
		curl_close($curl);

		$response = json_decode($response);

		if ( isset($response->code) && $response->code == 4) {
			header("Location: ".BASE_PATH."catalogos/marcas");
		}else{
			header("Location: ".BASE_PATH."catalogos/error");
		}
	}

}

?>