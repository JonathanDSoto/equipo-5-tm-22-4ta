<?php 
include_once "config.php";
//pendiente, necesito internet xd
foreach($_POST['presentations'] as $presentation){
    var_dump($presentation);
}
if( isset($_POST['action'])){
    if ( isset($_POST['global_token']) && 
		$_POST['global_token'] == $_SESSION['global_token']) {
            //incializacion de arreglo
            $respaldo = array();
            //si llega por post se guarda en el array anterior

            if( isset($_POST['presentations'])){
                $presentations = strip_tags($_POST['presentations']);
                foreach($presentations as $key => $presentation){
                    $respaldo["presentations[$key][id]"] = strip_tags($presentations[$key]["id"]);
                    $respaldo["presentations[$key][quantity]"] = strip_tags($presentations[$key]["quantity"]);
                }
                $token = "orden".date("h:i:sa").$respaldo["presentations[0][id]"];
            }
            switch ($_POST['action']){
                case 'create':
                    //createOrder($folio, $total, $is_paid, $client_id,
                    // $address_id, $order_status_id, $payment_type_id, 
                    //$coupon_id, $presentations)
                    
                    break;
            }
    }
}


//createOrder($folio, $total, $is_paid, $client_id, $address_id, $order_status_id, $payment_type_id, $coupon_id, $presentations);
//OrderController::getSpecificOrder(4);
//Folio es unico, revisar id de relaciones - unix timestamp - time()

Class OrderController{
    public static function getAllOrders(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/orders',
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

			return array();
		}

    }

    public static function getOrderBetweenDates($date1, $date2){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/orders/'.$date1.'/'.$date2,
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

			return array();
		}
    }

    public static function getSpecificOrder($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://crud.jonathansoto.mx/api/orders/details/'.$id,
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

			return array();
		}
        
    }
    
    public static function createOrder($folio, $total, $is_paid, $client_id, $address_id, $order_status_id, $payment_type_id, $coupon_id, $presentations){
        
        $presentations = array('folio' => $folio,'total' => $total,'is_paid' => $is_paid,'client_id' => $client_id,'address_id' =>      $address_id,'order_status_id' => $order_status_id,'payment_type_id' => $payment_type_id,
        'coupon_id' => $coupon_id) + $presentations;

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/orders',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $presentations,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token']
        ),
        ));
        
        $response = curl_exec($curl);
        var_dump($curl);
        curl_close($curl);
        echo $response;
    }
    
    public static function deleteOrder($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/orders/'.$id,
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
        //code 2
    }
    public static function updateOrder($id, $order_status_id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/orders',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => "id=$id&order_status_id=$order_status_id",
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token'],
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}

//funcion de validacion de campos
function validateProd($folio, $total, $is_paid, $client_id, $address_id, $order_status_id, $payment_type_id, $coupon_id, $presentations, $id=-1){
	//Variables 

	$nombre = $sluggy = $descripcion = $caracteristicas = $marca = "";
	$error = false;

	//Validacion de campos 
	
	//name
	if (empty($name)) {
		$_SESSION['errors']['nameError'] = "El campo nombre es requerido";
		$error = true;
	} 

	//description
	if (empty($description)) {
		$_SESSION['errors']['descriptionError'] = "El campo descripción es requerido";
		$error = true;
	} 

	//slug
	if (empty($slug)) {
		$_SESSION['errors']['slugError'] = "El campo slug es requerido";
		$error = true;
	} 

	//features
	if (empty($features)) {
		$_SESSION['errors']['featureError'] = "El campo caracteristicas es requerido";
		$error = true;
	} 

	//features
	if (empty($brand_id)) {
		$_SESSION['errors']['brandError'] = "El campo marca es requerido";
		$error = true;
	} 

	//id
	if (empty($id)) {
		$error = true;
	} 

	//Si no hay error asignamos los campos para retornarlos
	
	if(!$error){

		$nombre = test_input($name);
		$descripcion = test_input($description);
		$sluggy = test_input($slug);
		$caracteristicas = test_input($features);
		$marca = test_input($brand_id);

		//Si existe el id quiere decir que es un update y retornamos los datos + el id
		if (validateId($id)) {
			return array($nombre, $descripcion, $sluggy, $caracteristicas, $marca, $id);
		}
		//si no, retornamos los datos recibidos
		return array($nombre, $descripcion, $sluggy, $caracteristicas, $marca);
	}
	else{
		//si existe un error retornamos false
		return false;
	}
}
?>