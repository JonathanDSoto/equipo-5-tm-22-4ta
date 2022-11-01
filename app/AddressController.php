<?php 
include_once "config.php";
//terminado segun
if( isset($_POST['action']) ) {
    if ( isset($_POST['global_token']) && 
		$_POST['global_token'] == $_SESSION['global_token']) {

            if( isset($_POST['client_id'])){
                $cliente = test_input($_POST['client_id']);

                if(empty($cliente) || !filter_var($cliente, FILTER_VALIDATE_INT) || $cliente < 1){

                    unset($_POST['action']);
                    header("Location: ".BASE_PATH."clientes/error");
          
                }else{
                    $cliente = getSpecificClient($cliente);
                    if(!$cliente){
                        unset($_POST['action']);
                        header("Location: ".BASE_PATH."clientes/error");
                    }
                }
            }

            switch($_POST['action']){
                case 'create':
                    if( isset($_POST['first_name']) &&
                        isset($_POST['last_name']) &&
                        isset($_POST['street_and_use_number']) &&
                        isset($_POST['postal_code']) &&
                        isset($_POST['city']) && 
                        isset($_POST['province']) && 
                        isset($_POST['phone_number']) &&
                        isset($_POST['client_id'])
                        ) {
                            $first_name = strip_tags($_POST['first_name']);
                            $last_name = strip_tags($_POST['last_name']);
                            $street_and_use_number = strip_tags($_POST['street_and_use_number']);
                            $postal_code = strip_tags($_POST['postal_code']);
                            $city = strip_tags($_POST['city']);
                            $province = strip_tags($_POST['province']);
                            $phone_number = strip_tags($_POST['phone_number']);
                            $client_id = strip_tags($_POST['client_id']);

                            $res = validateAddress($first_name,$last_name,$street_and_use_number,$postal_code,$city,$province,$phone_number,$client_id);

                            if(!$res){
                                header("Location: ".BASE_PATH."clientes/info/$client_id/error");
                            }else{
                                AddressController::createAddress($res[0],$res[1],$res[2],$res[3],$res[4],$res[5],$res[6],$res[7]);
                            }
                        }
                    break;
                case 'update':
                    if( isset($_POST['first_name']) &&
                    isset($_POST['last_name']) &&
                    isset($_POST['street_and_use_number']) &&
                    isset($_POST['postal_code']) &&
                    isset($_POST['city']) && 
                    isset($_POST['province']) && 
                    isset($_POST['phone_number']) &&
                    isset($_POST['client_id']) &&
                    isset($_POST['id'])
                    ) {
                        $first_name = strip_tags($_POST['first_name']);
                        $last_name = strip_tags($_POST['last_name']);
                        $street_and_use_number = strip_tags($_POST['street_and_use_number']);
                        $postal_code = strip_tags($_POST['postal_code']);
                        $city = strip_tags($_POST['city']);
                        $province = strip_tags($_POST['province']);
                        $phone_number = strip_tags($_POST['phone_number']);
                        $client_id = strip_tags($_POST['client_id']);
                        $id = strip_tags($_POST['id']);

                        $res = validateAddress($first_name,$last_name,$street_and_use_number,$postal_code,$city,$province,$phone_number,$client_id, $id);

                        if(!$res){
                            header("Location: ".BASE_PATH."clientes/info/$client_id/error");
                        }else{
                            AddressController::updateAddress($res[0],$res[1],$res[2],$res[3],$res[4],$res[5],$res[6],$res[7], $res[8]);
                        }
                    }
                    break;
                case 'delete':
                        if( isset($_POST['id']) ){
                            
                            $id = test_input($_POST['id']);
        
                            if(validateId($id)){
                                deleteAddress::remove($id);
                            }else{
                                header("Location: ".BASE_PATH."clientes/info/$client_id/error");
                            }
                        }else{
                             header("Location: ".BASE_PATH."clientes/info/$client_id/error");
                        }
        
                    break; 
        
                default:
                    header("Location: ".BASE_PATH."clientes/info/$client_id/error");
                    break;
            }
        }
    }

Class AddressController{
    public static function getAddressByClient($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/addresses/'.$id,
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
            return array();
        }
    }
    public static function createAddress($first_name,$last_name,$street_and_use_number,$postal_code,$city,$province,$phone_number,$client_id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/addresses',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('first_name' => $first_name,'last_name' => $last_name,'street_and_use_number' => $street_and_use_number,'postal_code' => $postal_code,
        'city' => $city,'province' => $province,'phone_number' => $phone_number,'is_billing_address' => '1','client_id' => $client_id),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token'],
            'Cookie: XSRF-TOKEN=eyJpdiI6Iko2S0JzL1gvb0Z0QkgyZGFMSzgxbXc9PSIsInZhbHVlIjoiWldrYTEzc2FDekUxTlpHNFBKQVlQZ25NT3I3TzRKNmh5QkNxYUpROWc2QW0xZk54ekpWZ2xOZ3NwN2pqRWE1ekJLR2VvZFdPbi9ZeDRPTkJYY3R5dVRCdmhqb1hvV1hwM3lYVWd6QkR0dWNtOGJuVHJZWWpQYzJMNU5ibXZYU28iLCJtYWMiOiI4NDRmMDNlM2IzNTlkYjEwMGI5YWEwODI2OTAxMDlhYzIxYjJhZTZhNTk0Y2ZjZGViNTZhM2E4NDAwY2Y3Y2MyIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImZEWjlrNytRcGtIT0pkM3RrbVpBMWc9PSIsInZhbHVlIjoiSW5jUDdoWFBocVFRR2pXTStwbUx2czdCT3RyOEtVQ2VIOTJnQm9UdjZMa2dYbWtpQUJIM1dTYk9GSU5xOTNhT1FBR081LzhhVkR4Z1l5N2NOT0dBbEhzQ2hRM3BiOHNaS2xBUHkzQUM1aDRUeDhaMGpxTzgvVFdZQ3ZtZG93dngiLCJtYWMiOiJhODU4YWVlZGRjOTY5NTBkODJkNzdkZWZiZTY5ODI0OTIwM2Q2MTM4NWFmM2Y3YTc1YTM4YzM0M2FjMDlkZDhjIiwidGFnIjoiIn0%3D'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);

		if ( isset($response->code) && $response->code == 4) {
            header("Location: ".BASE_PATH."clientes/info/$client_id/success");
		}else{
            header("Location: ".BASE_PATH."clientes/info/$client_id/error");
		}
    }

    public static function updateAddress($first_name, $last_name, $street_and_use_number, $postal_code, $city, $province, $phone_number, $client_id, $id){
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/addresses',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS =>  "first_name=$first_name&last_name=$last_name&street_and_use_number=$street_and_use_number&postal_code=$postal_code&city=$city&phone_number=$phone_number&is_billing_address=1&client_id=$client_id&id=$id",
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token'],
            'Content-Type: application/x-www-form-urlencoded',
            'Cookie: XSRF-TOKEN=eyJpdiI6Iko2S0JzL1gvb0Z0QkgyZGFMSzgxbXc9PSIsInZhbHVlIjoiWldrYTEzc2FDekUxTlpHNFBKQVlQZ25NT3I3TzRKNmh5QkNxYUpROWc2QW0xZk54ekpWZ2xOZ3NwN2pqRWE1ekJLR2VvZFdPbi9ZeDRPTkJYY3R5dVRCdmhqb1hvV1hwM3lYVWd6QkR0dWNtOGJuVHJZWWpQYzJMNU5ibXZYU28iLCJtYWMiOiI4NDRmMDNlM2IzNTlkYjEwMGI5YWEwODI2OTAxMDlhYzIxYjJhZTZhNTk0Y2ZjZGViNTZhM2E4NDAwY2Y3Y2MyIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImZEWjlrNytRcGtIT0pkM3RrbVpBMWc9PSIsInZhbHVlIjoiSW5jUDdoWFBocVFRR2pXTStwbUx2czdCT3RyOEtVQ2VIOTJnQm9UdjZMa2dYbWtpQUJIM1dTYk9GSU5xOTNhT1FBR081LzhhVkR4Z1l5N2NOT0dBbEhzQ2hRM3BiOHNaS2xBUHkzQUM1aDRUeDhaMGpxTzgvVFdZQ3ZtZG93dngiLCJtYWMiOiJhODU4YWVlZGRjOTY5NTBkODJkNzdkZWZiZTY5ODI0OTIwM2Q2MTM4NWFmM2Y3YTc1YTM4YzM0M2FjMDlkZDhjIiwidGFnIjoiIn0%3D'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);

		if ( isset($response->code) && $response->code == 4) {
            header("Location: ".BASE_PATH."clientes/info/$client_id/success");
		}else{
            header("Location: ".BASE_PATH."clientes/info/$client_id/error");
		}
    }
    public static function deleteAddress($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/addresses/'.$id,
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
        $response = json_decode($response);

		if ( isset($response->code) && $response->code == 2) {
			
			return true;
		}else{

			return false;
		}
    }
}

//funcion de validacion de campos
//createAddress($first_name,$last_name,$street_and_use_number,$postal_code,$city,$province,$phone_number,$client_id)
function validateAddress($first_name,$last_name,$street_and_use_number,$postal_code,$city,$province,$phone_number,$client_id, $id = -1){

    $primerName = $ultimoName = $street = $cp = $ciudad = $provincia 
    = $phone = $clienteId = "";
    $error = false;
    //validacion de campos

    //first name
    if (empty($first_name)) {
		$_SESSION['errors']['firstNError'] = "El campo primer nombre es requerido";
		$error = true;
	} 

    //last_name 
    if (empty($last_name)) {
		$_SESSION['errors']['lastNError'] = "El campo segundo nombre es requerido";
		$error = true;
	} 

    //street_and_use_number
    if (empty($street_and_use_number)) {
		$_SESSION['errors']['streetError'] = "El campo calle y numero es requerido";
		$error = true;
	} 

    //postal_code
    if (empty($postal_code)) {
		$_SESSION['errors']['cpError'] = "El campo codigo postal es requerido";
		$error = true;
	} 
    if (!filter_var($postal_code, FILTER_VALIDATE_INT)) {
		$_SESSION['errors']['cpError'] = "El campo codigo postal no es valido";
		$error = true;
	} 

    //city
    if (empty($city)) {
		$_SESSION['errors']['cityError'] = "El campo ciudad es requerido";
		$error = true;
	} 

    //province
    if (empty($province)) {
		$_SESSION['errors']['provinceError'] = "El campo provincia es requerido";
		$error = true;
	} 

    //phone_number
    if (empty($phone_number)) {
        $_SESSION['errors']['phoneError'] = "El campo numero telefonico es requerido";
        $error = true;
    } 
    if (!filter_var($phone_number, FILTER_VALIDATE_INT)) {
		$_SESSION['errors']['phoneError'] = "El campo numero telefonico no es valido";
		$error = true;
	} 

    //client_id
    if (empty($client_id)) {
        $_SESSION['errors']['clientError'] = "El campo cliente es requerido";
        $error = true;
    } 
    if (!filter_var($client_id, FILTER_VALIDATE_INT)) {
		$_SESSION['errors']['clientError'] = "El campo cliente no es valido";
		$error = true;
	} 

    //id
    if (empty($id)) {
        $error = true;
    } 

    //Si no hay error asignamos los campos para retornarlos

    if(!$error){
        $primerName = test_input($first_name);
        $ultimoName = test_input($last_name);
        $street = test_input($street_and_use_number);
        $cp = test_input($postal_code);
        $ciudad = test_input($city);
        $provincia = test_input($province);
        $phone = test_input($phone_number);
        $clienteId = test_input($client_id);

        if(validateId($id)){
            return array($primerName,$ultimoName,$street,$cp,$ciudad,$provincia,$phone,$clienteId, $id);
        }

        return array($primerName,$ultimoName,$street,$cp,$ciudad,$provincia,$phone,$clienteId);
    }else{
        return false;
    }
}

?>