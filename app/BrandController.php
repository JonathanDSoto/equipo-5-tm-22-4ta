<?php
include_once "config.php";

if (isset($_POST['action'])) {

	if ( isset($_POST['global_token']) && 
	$_POST['global_token'] == $_SESSION['global_token']) {
			
		switch ($_POST['action']) {
			case 'create':

				$res = validate($_POST['name'], $_POST['description'], $_POST['slug']);

				if(!$res){ 
					header("Location: ".BASE_PATH."catalogos/marcas/error");
				}else{
					BrandController::createBrand($res[0], $res[1], $res[2]);
				}
				 
				break; 

			case 'update':

				$res = validate($_POST['name'], $_POST['description'], $_POST['slug'], $_POST['id']);

				if(!$res){ 
					header("Location: ".BASE_PATH."catalogos/marcas/error");
				}else{
					BrandController::updateBrand($res[0], $res[1], $res[2], $res[3]);
				}

				break;

			case 'delete':
				$id = test_input($_POST['id']);
				if(validateId($id)){
					BrandController::deleteBrand($id);
				}else{
					header("Location: ".BASE_PATH."catalogos/marcas/error");
				}
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
			header("Location: ".BASE_PATH."catalogos/marcas/success");
		}else{
			$_SESSION['errors']['processError'] = $response->message;
			header("Location: ".BASE_PATH."catalogos/marcas/error");
		}
	}

	public static function updateBrand($name, $description, $slug, $id){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://crud.jonathansoto.mx/api/brands',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'PUT',
		CURLOPT_POSTFIELDS => "name=$name&description=$description&slug=$slug&id=$id",
		CURLOPT_HTTPHEADER => array(
			'Authorization: Bearer '.$_SESSION['token'],
			'Content-Type: application/x-www-form-urlencoded'
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$response = json_decode($response);

		if( isset($response->code) && $response->code == 4){
			header("Location: ".BASE_PATH."catalogos/marcas/success");
		}else{
			$_SESSION['errors']['processError'] = $response->message;
			header("Location: ".BASE_PATH."catalogos/marcas/error");
		}
	}

	public static function deleteBrand($id){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://crud.jonathansoto.mx/api/brands/'.$id,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'DELETE',
		CURLOPT_HTTPHEADER => array(
			'Authorization: Bearer '.$_SESSION['token']
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$response = json_decode($response);

		if( isset($response->code) && $response->code == 2){
			header("Location: ".BASE_PATH."catalogos/marcas/success");
		}else{
			header("Location: ".BASE_PATH."catalogos/marcas/error");
		}

	}
}


//funcion de validacion de campos
function validateId($id){
	if (filter_var($id, FILTER_VALIDATE_INT) && $id != 0) {
		return true;
	}
	return false;
}
function validate($name, $description, $slug, $id=0){
	//Variables 

	$nombre = $descripcion = $sluggy = "";
	$error = false;

	//Validacion de campos 
	
	//name
	if (empty($name)) {
		$_SESSION['errors']['nameError'] = "El campo nombre es requerido";
		$error = true;
	} 
	else {
		$nombre = test_input($name);
	}

	//description
	if (empty($description)) {
		$_SESSION['errors']['descriptionError'] = "El campo descripción es requerido";
		$error = true;
	} else {
		$descripcion = test_input($description);
	}

	//slug
	if (empty($slug)) {
		$_SESSION['errors']['slugError'] = "El campo slug es requerido";
		$error = true;
	} else {
		$sluggy = test_input($slug);
	}

	//retornamos los campos o falso
	if (validateId($id)) {
		return array($nombre, $descripcion, $sluggy, $id);
	}
	else if(!$error){
		return array($nombre, $descripcion, $sluggy);
	}
	else{
		return false;
	}
}

?>