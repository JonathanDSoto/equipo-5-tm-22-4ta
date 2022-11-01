<?php 
include_once "config.php";

if (isset($_POST['action'])) {
	
	if ( isset($_POST['global_token']) && 
	$_POST['global_token'] == $_SESSION['global_token']) {

        switch ($_POST['action']) {
            case 'create':
                
                if(isset($_POST['name']) &&
                    isset($_POST['email']) &&
                    isset($_POST['password']) &&
                    isset($_POST['phone_number']) ){
                        $name = strip_tags($_POST['name']);
                        $email = strip_tags($_POST['email']);
                        $password = strip_tags($_POST['password']);
                        $phone_number = strip_tags($_POST['phone_number']);

                        $res = validateClient($name,$email,$password,$phone_number);
                        if(!$res){
                            header("Location: ".BASE_PATH."clientes/error");
                        }else{
                            ClientController::createClient($res[0],$res[1],$res[2],$res[3]);
                        }
                    }else{
                        header("Location: ".BASE_PATH."clientes/error");
                    }
                break;
            case 'update':
                if(isset($_POST['name']) &&
                isset($_POST['email']) &&
                isset($_POST['password']) &&
                isset($_POST['phone_number']) &&
                isset($_POST['id'])) {
                    $name = strip_tags($_POST['name']);
                    $email = strip_tags($_POST['email']);
                    $password = strip_tags($_POST['password']);
                    $phone_number = strip_tags($_POST['phone_number']);
                    $id = strip_tags($_POST['id']);

                    $res = validateClient($name,$email,$password,$phone_number, $id);
                    if(!$res){
                        header("Location: ".BASE_PATH."clientes/error");
                    }else{
                        ClientController::updateClient($res[0],$res[1],$res[2],$res[3],$res[4]);
                    }
                }else{
                    header("Location: ".BASE_PATH."clientes/error");
                }
                break;
            case 'delete':
                if( isset($_POST['id']) ){
                    
                    $id = test_input($_POST['id']);

                    if(validateId($id)){
                        ClientController::deleteClient($id);
                    }else{
                        header("Location: ".BASE_PATH."clientes/error");
                    }
                }else{
                    header("Location: ".BASE_PATH."clientes/error");
                }
                break;
        }
    }
}
Class ClientController{
    public static function getClients(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/clients',
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

		if ( isset($response->code) && $response->code > 0) {
			
			return $response->data;
		}else{

			return array();
		}

    }

    
    public static function createClient($name,$email,$password,$phone_number){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/clients',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('name' => $name,'email' => $email,'password' => $password,'phone_number' => $phone_number,
        'is_suscribed' => '1','level_id' => '1'),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token'],
            'Cookie: XSRF-TOKEN=eyJpdiI6Iko2S0JzL1gvb0Z0QkgyZGFMSzgxbXc9PSIsInZhbHVlIjoiWldrYTEzc2FDekUxTlpHNFBKQVlQZ25NT3I3TzRKNmh5QkNxYUpROWc2QW0xZk54ekpWZ2xOZ3NwN2pqRWE1ekJLR2VvZFdPbi9ZeDRPTkJYY3R5dVRCdmhqb1hvV1hwM3lYVWd6QkR0dWNtOGJuVHJZWWpQYzJMNU5ibXZYU28iLCJtYWMiOiI4NDRmMDNlM2IzNTlkYjEwMGI5YWEwODI2OTAxMDlhYzIxYjJhZTZhNTk0Y2ZjZGViNTZhM2E4NDAwY2Y3Y2MyIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImZEWjlrNytRcGtIT0pkM3RrbVpBMWc9PSIsInZhbHVlIjoiSW5jUDdoWFBocVFRR2pXTStwbUx2czdCT3RyOEtVQ2VIOTJnQm9UdjZMa2dYbWtpQUJIM1dTYk9GSU5xOTNhT1FBR081LzhhVkR4Z1l5N2NOT0dBbEhzQ2hRM3BiOHNaS2xBUHkzQUM1aDRUeDhaMGpxTzgvVFdZQ3ZtZG93dngiLCJtYWMiOiJhODU4YWVlZGRjOTY5NTBkODJkNzdkZWZiZTY5ODI0OTIwM2Q2MTM4NWFmM2Y3YTc1YTM4YzM0M2FjMDlkZDhjIiwidGFnIjoiIn0%3D'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);

		if ( isset($response->code) && $response->code > 0) {

			header("Location: ".BASE_PATH."clientes/success");
		}else{ 
			header("Location: ".BASE_PATH."clientes/error");
		}

    }

    public static function updateClient($name,$email,$password,$phone_number, $id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/clients',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => "name=$name&email=$email&password=$password&phone_number=$phone_number&is_suscribed=1&level_id=1&id=$id",
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token'],
            'Content-Type: application/x-www-form-urlencoded',
            'Cookie: XSRF-TOKEN=eyJpdiI6Iko2S0JzL1gvb0Z0QkgyZGFMSzgxbXc9PSIsInZhbHVlIjoiWldrYTEzc2FDekUxTlpHNFBKQVlQZ25NT3I3TzRKNmh5QkNxYUpROWc2QW0xZk54ekpWZ2xOZ3NwN2pqRWE1ekJLR2VvZFdPbi9ZeDRPTkJYY3R5dVRCdmhqb1hvV1hwM3lYVWd6QkR0dWNtOGJuVHJZWWpQYzJMNU5ibXZYU28iLCJtYWMiOiI4NDRmMDNlM2IzNTlkYjEwMGI5YWEwODI2OTAxMDlhYzIxYjJhZTZhNTk0Y2ZjZGViNTZhM2E4NDAwY2Y3Y2MyIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImZEWjlrNytRcGtIT0pkM3RrbVpBMWc9PSIsInZhbHVlIjoiSW5jUDdoWFBocVFRR2pXTStwbUx2czdCT3RyOEtVQ2VIOTJnQm9UdjZMa2dYbWtpQUJIM1dTYk9GSU5xOTNhT1FBR081LzhhVkR4Z1l5N2NOT0dBbEhzQ2hRM3BiOHNaS2xBUHkzQUM1aDRUeDhaMGpxTzgvVFdZQ3ZtZG93dngiLCJtYWMiOiJhODU4YWVlZGRjOTY5NTBkODJkNzdkZWZiZTY5ODI0OTIwM2Q2MTM4NWFmM2Y3YTc1YTM4YzM0M2FjMDlkZDhjIiwidGFnIjoiIn0%3D'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);

		if ( isset($response->code) && $response->code > 0) {

			header("Location: ".BASE_PATH."clientes/success");
		}else{ 
			header("Location: ".BASE_PATH."clientes/error");
		}

    }
    public static function deleteClient(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/clients/'.$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token'],
            'Cookie: XSRF-TOKEN=eyJpdiI6Iko2S0JzL1gvb0Z0QkgyZGFMSzgxbXc9PSIsInZhbHVlIjoiWldrYTEzc2FDekUxTlpHNFBKQVlQZ25NT3I3TzRKNmh5QkNxYUpROWc2QW0xZk54ekpWZ2xOZ3NwN2pqRWE1ekJLR2VvZFdPbi9ZeDRPTkJYY3R5dVRCdmhqb1hvV1hwM3lYVWd6QkR0dWNtOGJuVHJZWWpQYzJMNU5ibXZYU28iLCJtYWMiOiI4NDRmMDNlM2IzNTlkYjEwMGI5YWEwODI2OTAxMDlhYzIxYjJhZTZhNTk0Y2ZjZGViNTZhM2E4NDAwY2Y3Y2MyIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImZEWjlrNytRcGtIT0pkM3RrbVpBMWc9PSIsInZhbHVlIjoiSW5jUDdoWFBocVFRR2pXTStwbUx2czdCT3RyOEtVQ2VIOTJnQm9UdjZMa2dYbWtpQUJIM1dTYk9GSU5xOTNhT1FBR081LzhhVkR4Z1l5N2NOT0dBbEhzQ2hRM3BiOHNaS2xBUHkzQUM1aDRUeDhaMGpxTzgvVFdZQ3ZtZG93dngiLCJtYWMiOiJhODU4YWVlZGRjOTY5NTBkODJkNzdkZWZiZTY5ODI0OTIwM2Q2MTM4NWFmM2Y3YTc1YTM4YzM0M2FjMDlkZDhjIiwidGFnIjoiIn0%3D'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }
}

//funcion de validacion de campos
function validateClient($name,$email,$password,$phone_number, $id=-1){
	//Variables 

	$nombre = $correo = $telefono = $contra = "";
	$error = false;

	//Validacion de campos 
	
	//name
	if (empty($name)) {
		$_SESSION['errors']['nameError'] = "El campo nombre es requerido";
		$error = true;
	} 

	//email
	if (empty($email) || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
		$_SESSION['errors']['emailError'] = "El campo correo electrónico no es valido";
		$error = true;
	} 

	//phone_number
	if (empty($phone_number)) {
		$_SESSION['errors']['phoneError'] = "El campo telefono no es valido";
		$error = true;
	} 
    //password
    if (empty($password)) {
		$_SESSION['errors']['passwordError'] = "El campo contraseña es requerido";
		$error = true;
	} 
	//id
	if (empty($id)) {
		$error = true;
	} 

	//Si no hay error asignamos los campos para retornarlos
	
	if(!$error){

		$nombre = test_input($name);
        $correo = test_input($email);
        $telefono = test_input($phone_number);
        $contra = test_input($password);

		//Si existe el id quiere decir que es un update y retornamos los datos + el id
		if (validateId($id)) {
			return array($nombre, $correo, $telefono,
            $contra, $id);
		}
		//si no, retornamos los datos recibidos
		return array($nombre, $correo, $telefono,
        $contra);
	}
	else{
		//si existe un error retornamos false
		return false;
	}
}

?>