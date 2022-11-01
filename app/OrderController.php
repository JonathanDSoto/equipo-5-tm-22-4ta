<?php 
include_once "config.php";

if( isset($_POST['action'])){
    if ( isset($_POST['global_token']) && 
		$_POST['global_token'] == $_SESSION['global_token']) {
            //incializacion de arreglo
            $respaldo = array();
            //si llega por post se guarda en el array anterior

            if( isset($_POST['presentations'])){
                $presentations = strip_tags($_POST['presentations']);
                $total = 0;
                foreach($presentations as $key => $presentation){
                    $respaldo["presentations[$key][id]"] = strip_tags($presentations[$key]["id"]);
                    $respaldo["presentations[$key][quantity]"] = strip_tags($presentations[$key]["quantity"]);
                    $total += getSpecificPresentation($presentations[$key]["id"])->current_price->amount;
                }
                $token = "orden".date("h:i:sa").$respaldo["presentations[0][id]"];
                if($_POST['order_status_id'] == 2){
                    $is_paid = 1;
                }else{
                    $is_paid = 0;
                }
            }
            switch ($_POST['action']){
                case 'create':
                    //createOrder($folio, $total, $is_paid, $client_id,
                    // $address_id, $order_status_id, $payment_type_id, 
                    //$coupon_id, $presentations)
                    if( isset($_POST['client_id']) &&
                        isset($_POST['address_id']) &&
                        isset($_POST['order_status_id']) &&
                        isset($_POST['payment_type_id'])){
                            $client_id = strip_tags($_POST['client_id']);
                            $address_id = strip_tags($_POST['address_id']);
                            $order_status_id = strip_tags($_POST['order_status_id']);
                            $payment_type_id = strip_tags($_POST['payment_type_id']);
                            
                            if(isset($_POST['coupon_id'])){
                                $coupon_id = strip_tags($_POST['coupon_id']);
                            }else{
                                $coupon_id = false;
                            }

                            $res = validateOrder($client_id, $address_id, $order_status_id,
                                $payment_type_id);
                            if(!$res){
                                header("Location: ".BASE_PATH."ordenes/error");
                            }else{
                                OrderController::createOrder($folio, $total, $is_paid,$res[0], $res[1], $res[2], $res[3], $coupon_id, $respaldo);
                            }
                    }else{
                        header("Location: ".BASE_PATH."ordenes/error");
                    }
                    break;
                case 'update':
                    if(isset($_POST['id']) &&
                        isset($_POST['order_status_id'])){
                            $id = test_input($_POST['id']);
                            $order = test_input($_POST['order_status_id']);

                            if(validateId($id)){
                                OrderController::updateOrder($id, $order);
                            }else{
                                header("Location: ".BASE_PATH."ordenes/error");
                            }
                        }else{
                            header("Location: ".BASE_PATH."ordenes/error");
                        }
                    break;
                case 'delete':
                    if(isset($_POST['id'])){
                            $id = test_input($_POST['id']);

                            if(validateId($id)){
                                OrderController::deleteOrder($id);
                            }else{
                                header("Location: ".BASE_PATH."ordenes/error");
                            }
                        }
                    break;
                default:
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
        
        if($coupon_id){
            $presentations = array('folio' => $folio,'total' => $total,'is_paid' => $is_paid,'client_id' => $client_id,'address_id' => $address_id,'order_status_id' => $order_status_id,'payment_type_id' => $payment_type_id,
            'coupon_id' => $coupon_id) + $presentations;
        }else{
            $presentations = array('folio' => $folio,'total' => $total,'is_paid' => $is_paid,'client_id' => $client_id,'address_id' => $address_id,'order_status_id' => $order_status_id,
            'payment_type_id' => $payment_type_id) + $presentations;
        }

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
        $response = json_decode($response);

		if ( isset($response->code) && $response->code > 0) {
			header("Location: ".BASE_PATH."ordenes/success");
		}else{ 
			header("Location: ".BASE_PATH."ordenes/error");
		}
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
        $response = json_decode($response);

		if ( isset($response->code) && $response->code == 2) {
			return true;
		}else{
			return false;
		}

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
        $response = json_decode($response);

		if ( isset($response->code) && $response->code > 0) {
			header("Location: ".BASE_PATH."ordenes/success");
		}else{ 
			header("Location: ".BASE_PATH."ordenes/error");
		}
    }
}

//funcion de validacion de campos
function validateOrder($client_id,$address_id,$order_status_id,$payment_type_id, $id=-1){
	//Variables 

	$cliente = $address = $order = $payment = $cupon = "";
	$error = false;

	//Validacion de campos 
	
	//client
	if (empty($client_id)) {
		$_SESSION['errors']['clientError'] = "El campo cliente es requerido";
		$error = true;
	} 

	//address_id
	if (empty($address_id)) {
		$_SESSION['errors']['addressError'] = "El campo dirección es requerido";
		$error = true;
	} 

	//order_status_id
	if (empty($order_status_id)) {
		$_SESSION['errors']['orderError'] = "El campo estado de la orden es requerido";
		$error = true;
	} 

	//payment_type_id
	if (empty($payment_type_id)) {
		$_SESSION['errors']['paymentError'] = "El campo tipo de pago es requerido";
		$error = true;
	} 

	//id
	if (empty($id)) {
		$error = true;
	} 

	//Si no hay error asignamos los campos para retornarlos
	
	if(!$error){

		$cliente = test_input($client_id);
        $address = test_input($address_id);
        $order = test_input($order_status_id);
        $payment = test_input($payment_type_id);

		//Si existe el id quiere decir que es un update y retornamos los datos + el id
		if (validateId($id)) {
			return array($cliente, $address, $order, $payment, $id);
		}
		//si no, retornamos los datos recibidos
		return array($cliente, $address, $order, $payment);
	}
	else{
		//si existe un error retornamos false
		return false;
	}
}
?>