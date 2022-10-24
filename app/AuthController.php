<?php
include_once "config.php";

if (isset($_POST['action'])) {
	
	if ( isset($_POST['global_token']) && 
	$_POST['global_token'] == $_SESSION['global_token']) {

			switch ($_POST['action']) {
				case 'access':
					if( isset($_POST['email']) &&
						isset($_POST['password'])) { 

							//cachamos el resultado de la funcion validate
							//retorna un array de 2 posiciones con $correo y $contrase;a en caso de estar bien
							//o false en caso de haber error

							$email = strip_tags($_POST['email']);
							$password = strip_tags($_POST['password']);

							$res = validateAuth($email, $password);
						
							if(!$res){
								header("Location: ".BASE_PATH."iniciar-sesion/error");
							}else{
								// Si la validacion sale bien llama a funcion login
								AuthController::login($res[0], $res[1]);
							}
					}else{
						header("Location: ".BASE_PATH."iniciar-sesion/error");
					}

					break; 

				case 'logout':
					if( isset($_SESSION['id']) ){
						AuthController::logout();
					}else{
						header("Location: ".$_SERVER['HTTP_REFERER']);
					}
					break;

				default:
					header("Location: ".BASE_PATH."iniciar-sesion/error");
					break;
		}

	}else{
		header("Location: ".BASE_PATH."iniciar-sesion/error");
	}
}else{
	header("Location: ".BASE_PATH."iniciar-sesion/error");
}


Class AuthController{

	public static function login($email,$password)
	{

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://crud.jonathansoto.mx/api/login',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array(
		  	'email' => $email,
		  	'password' => $password
		  ),
		));

		$response = curl_exec($curl); 
		curl_close($curl);
		$response = json_decode($response);

		if ( isset($response->code) && $response->code > 0) {

			$_SESSION['id']= $response->data->id;
			$_SESSION['email']= $response->data->email;
			$_SESSION['name']= $response->data->name;
			$_SESSION['lastname']= $response->data->lastname;
			$_SESSION['avatar']= $response->data->avatar;
			$_SESSION['token']= $response->data->token;

			header("Location:".BASE_PATH."products");
			// header("Location: productos");
		}else{
			#var_dump($response);
			header("Location: ".BASE_PATH."iniciar-sesion/error");
		}

	}

	public static function getUser($id){
		
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users/'.$id,
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
	
		if ( isset($response->code) && $response->code < 5) {
			 return $response->data;
		}else{
			 header("Location: ".$_SERVER['HTTP_REFERER']);
		}
	}

	public static function logout(){

		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://crud.jonathansoto.mx/api/logout',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => array('email' => $_SESSION['email']),
		CURLOPT_HTTPHEADER => array(
			'Authorization: Bearer '.$_SESSION['token'],
			'Cookie: XSRF-TOKEN=eyJpdiI6Im80d2x0b3BPalorNTBkZ2RHUGgrVVE9PSIsInZhbHVlIjoiZ3hKT0N4RjVOSTJQdzh5dk5hK0pIUy9TZWJlSEtZWExRbmJ3NXZVa3l5ZjVWdGZiVVhBNS84aUxsWktBLzQvVEVRYXBvcFpxL21yajMvVGwrUEJXQVJnejdOZlYzYkJHbWloc2JuN28yUnVxNmg3L2FQdStjYXM3STZlNExpSE8iLCJtYWMiOiJkMmE1ODNkMjkzMGZmYTFmZjIyZjZhNDRkMjcyMTJhMGQzNmZiYTI3MjM3MzU1NGM0M2IzNWVlZjE5ZWU3MDYwIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6InovN2ZMYS9oeDRLZVllMGo1U0N6L3c9PSIsInZhbHVlIjoiQmR6WXc4SEpYWjVBNXdyaWxzS0xoQlVXcXMvNkJXREtFL1BWM01KS09DbFlFZ3dTUzZ6ekpuMFBhT25RVW1hUHRIZk1iNWpsYnlsUGZMb2ZqR3I2c0xUU2kraC9XR0p1VDEyRmoxMmdRRURDRDBWbWM4ZDJRaDBxY21tOGFNUzUiLCJtYWMiOiIyZjNlMjJhM2JhYzIyOTM4MjY4MjYzYzM0YTlmYmNmYTcwMWM2YmVjZTVlYjY0N2I0MmUwZDk3NzFjZTNhNDk0IiwidGFnIjoiIn0%3D'
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		
		$response = json_decode($response);
		
		if ( isset($response->code) && $response->code == 2) {
			session_destroy();
			header("Location: ".BASE_PATH."iniciar-sesion");
	   	}

	}
}



//funcion de validacion de campos

function validateAuth($email, $password){
	//Variables 

	$correo = $contra = "";
	$error = false;

	//Validacion de campos 
	//email
	if (empty($email)) {
		$_SESSION['errors']['emailError'] = "El campo correo electrónico es requerido";
		$error = true;
	} 
	else {
		$correo = test_input($email);

		if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
			$_SESSION['errors']['emailError'] = "Formato de correo electrónico incorrecto";
			$error = true;
		}
	}
	//password
	if (empty($password)) {
		$_SESSION['errors']['passError'] = "El campo contraseña es requerido";
		$error = true;
	} else {
		$contra = test_input($password);
	}

	if(!$error){
		return array($correo, $contra);
	}
	else{
		return false;
	}
}







?>