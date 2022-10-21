<?php 
include_once "config.php";


// lista de presentaciones (crud de presentaciones)
//PresentationController::createPresentation('descripcion', 'codedesc', 2000, 'active', false , 30, 10, 100, 1, 302);
if( isset($_POST['action']) ) {
    if ( isset($_POST['global_token']) && 
		$_POST['global_token'] == $_SESSION['global_token']) {

            if( isset($_POST['product_id'])){
                $productoId = test_input($_POST['product_id']);
                if(!empty($productoId) && filter_var($productoId, FILTER_VALIDATE_INT) && $productoId > 0){
                    $slug = getSpecificProduct($productoId)->slug;
                    
                    if(!$slug){
                        unset($_POST['action']);
                        header("Location: ".BASE_PATH."productos/error");
                    }
                }else{
                    unset($_POST['action']);
                    header("Location: ".BASE_PATH."productos/error");
                }
            }

        switch ($_POST['action']) {
            case 'create':
          
                if( isset($_POST['description']) &&
                    isset($_POST['code']) &&
                    isset($_POST['weight_in_grams']) &&
                    isset($_POST['status']) &&
                    isset($_POST['stock']) &&
                    isset($_POST['stock_min']) &&
                    isset($_POST['stock_max']) &&
                    isset($_POST['product_id']) &&
                    isset($_POST['amount'])){

                        $cover = false;

                        if( isset($_FILES['cover'])){
                            $cover = true;
                        }
                        
                        $description = strip_tags($_POST['description']);
                        $code = strip_tags($_POST['code']);
                        $weight_in_grams = strip_tags($_POST['weight_in_grams']);
                        $status = strip_tags($_POST['status']);
                        $stock = strip_tags($_POST['stock']);
                        $stock_min = strip_tags($_POST['stock_min']);
                        $stock_max = strip_tags($_POST['stock_max']);
                        $product_id = strip_tags($_POST['product_id']);
                        $amount = strip_tags($_POST['amount']);

                        $res = validatePres($description, $code, $weight_in_grams, $status,
                            $stock, $stock_min, $stock_max, $product_id, $amount);
                        
                        if(!$res){ 
                            header("Location: ".BASE_PATH."productos/info/$slug/error");
                        }else{
                            
                            PresentationController::createPresentation($res[0], $res[1], $res[2], $res[3], $cover,
                            $res[4], $res[5], $res[6], $res[7], $res[8], $slug);
                        }

                    }else{
                        header("Location: ".BASE_PATH."productos/info/$slug/error");
					}
                break;
            case 'update':
                if( isset($_POST['description']) &&
                    isset($_POST['code']) &&
                    isset($_POST['weight_in_grams']) &&
                    isset($_POST['status']) &&
                    isset($_POST['stock']) &&
                    isset($_POST['stock_min']) &&
                    isset($_POST['stock_max']) &&
                    isset($_POST['product_id']) &&
                    isset($_POST['id']) &&
                    isset($_POST['amount'])){
                        
                        $description = strip_tags($_POST['description']);
                        $code = strip_tags($_POST['code']);
                        $weight_in_grams = strip_tags($_POST['weight_in_grams']);
                        $status = strip_tags($_POST['status']);
                        $stock = strip_tags($_POST['stock']);
                        $stock_min = strip_tags($_POST['stock_min']);
                        $stock_max = strip_tags($_POST['stock_max']);
                        $product_id = strip_tags($_POST['product_id']);
                        $id = strip_tags($_POST['id']);
                        $amount = strip_tags($_POST['amount']);

                        $res = validatePres($description, $code, $weight_in_grams, $status,
                            $stock, $stock_min, $stock_max, $product_id, $amount, $id);
                        
                        if(!$res){ 
                            header("Location: ".BASE_PATH."productos/info/$slug/error");
                        }else{ 
                            PresentationController::updatePresentation($res[0], $res[1], $res[2], $res[3], 
                            $res[4], $res[5], $res[6], $res[7], $res[8], $res[9], $slug);
                        }

                    }else{
                        header("Location: ".BASE_PATH."productos/info/$slug/error");
					}
                break;
            case 'delete':
                if( isset($_POST['id']) ){
					
					$id = test_input($_POST['id']);

					if(validateId($id)){
                        PresentationController::deletePresentation($id);
                    }else{
                        header("Location: ".BASE_PATH."productos/info/$slug/error");
                    }
				}else{
					header("Location: ".BASE_PATH."productos/info/$slug/error");
				}

                break;
            default:
                break;
        }

    }else{
        header("Location: ".BASE_PATH."productos/info/$slug/error");
    }
}else{
    header("Location: ".BASE_PATH."productos/info/$slug/error");
}

Class PresentationController{

    public static function getPresentations($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations/product/'.$id,
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

    public static function getSpecificPresentation($id){
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
    public static function createPresentation($description, $code, $weight_in_grams, $status, $cover, $stock, $stock_min, $stock_max, $product_id, $amount, $slug){ 
        
        if($cover){
            if($_FILES["cover"]["error"] > 0){
                header("Location: ".BASE_PATH."productos/info/$slug/error");
            }
            $imagen = $_FILES["cover"]["tmp_name"];
        }

        $curl = curl_init();
        if($cover){
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('description' => $description,'code' => $code,'weight_in_grams' => $weight_in_grams,'status' => $status,
            'cover'=> new CURLFILE($imagen),'stock' => $stock,'stock_min' => $stock_min,
            'stock_max' => $stock_max,'product_id' => $product_id, 'amount' => $amount),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$_SESSION['token']
            ),
            ));
        }else{
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('description' => $description,'code' => $code,'weight_in_grams' => $weight_in_grams,'status' => $status,
            'stock' => $stock,'stock_min' => $stock_min,
            'stock_max' => $stock_max,'product_id' => $product_id,'amount' => $amount),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$_SESSION['token']
            ),
            ));
        }

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);

        if( isset($response->code) && $response->code == 4){
            header("Location: ".BASE_PATH."productos/info/$slug/success");
        }else{
            header("Location: ".BASE_PATH."productos/info/$slug/error");
        }

    }

    public static function updatePresentation($description, $code, $weight_in_grams, $status, $stock, $stock_min, $stock_max, $product_id, $amount, $id, $slug){
    
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => "description=$description&code=$code&weight_in_grams=$weight_in_grams&status=$status&stock=$stock&stock_min=$stock_min&stock_max=$stock_max&product_id=$product_id&amount=$amount&id=$id",
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token'],
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));
    
        $response = curl_exec($curl);

        $response = json_decode($response);

        if( isset($response->code) && $response->code == 4){
            header("Location: ".BASE_PATH."productos/info/$slug/success");
        }else{
            header("Location: ".BASE_PATH."productos/info/$slug/error");
        }
        

    }

    public static function deletePresentation($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations/'.$id,
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

		if ( isset($response->code) && $response->code == 2) {
			
			return true;
		}else{

			return false;
		}

    }
}


//funcion de validacion de campos
function validatePres($description, $code, $weight_in_grams, $status, $stock, $stock_min, $stock_max, $product_id, $amount, $id=-1){
	//Variables 

	$descripcion = $codigo = $peso = $estatus = $stockk = $stockmin = $stockmax = $productid = $precio = "";
	$error = false;

	//Validacion de campos  
	
	//description
	if (empty($description)) {
		$_SESSION['errors']['descriptionError'] = "El campo descripción es requerido";
		$error = true;
	} 

	//code
	if (empty($code)) {
		$_SESSION['errors']['codeError'] = "El campo código es requerido";
		$error = true;
	} 

	//weight_in_grams 
	if (empty($weight_in_grams)) {
		$_SESSION['errors']['weightError'] = "El campo peso es requerido";
		$error = true;
	} 
    //filter_var($id, FILTER_VALIDATE_FLOAT) && $id > 0
    if(!filter_var($weight_in_grams, FILTER_VALIDATE_INT) && $weight_in_grams > 0){
        $_SESSION['errors']['weightError'] = "El campo peso no es valido";
        $error = true;
    }

	//stock 
	if (empty($stock)) {
		$_SESSION['errors']['stockError'] = "El campo stock es requerido";
		$error = true;
	} 
    if(!filter_var($stock, FILTER_VALIDATE_INT) && $stock > 0){
        $_SESSION['errors']['stockError'] = "El campo stock no es valido";
        $error = true;
    }
    //stock_min
    if (empty($stock_min)) {
		$_SESSION['errors']['stockMinError'] = "El campo stock minimo es requerido";
		$error = true;
	} 

    if(!filter_var($stock_min, FILTER_VALIDATE_INT) && $stock_min > 0){
        $_SESSION['errors']['stockMinError'] = "El campo stock minimo no es valido";
        $error = true;
    }
    //stock_max
    if (empty($stock_max)) {
		$_SESSION['errors']['stockMaxError'] = "El campo stock maximo es requerido";
		$error = true;
	} 
    if(!filter_var($stock_max, FILTER_VALIDATE_INT) && $stock_max > 0){
        $_SESSION['errors']['stockMaxError'] = "El campo stock maximo no es valido";
        $error = true;
    }
    //product_id
    if (empty($product_id)) {
		$_SESSION['errors']['productError'] = "El campo producto es requerido";
		$error = true;
	} 
    if(!filter_var($product_id, FILTER_VALIDATE_INT) && $product_id > 0){
        $_SESSION['errors']['productError'] = "El producto no es valido";
        $error = true;
    }
    //amount
    if (empty($amount)) {
		$_SESSION['errors']['amountError'] = "El campo precio es requerido";
		$error = true;
	} 
    if(!filter_var($amount, FILTER_VALIDATE_INT) && $amount > 0){
        $_SESSION['errors']['amountError'] = "El precio no es valido";
        $error = true;
    }

    //id
    if (empty($id)) {
		$error = true;
	} 
	//Si no hay error asignamos los campos para retornarlos
	
	if(!$error){
        // $descripcion = $codigo = $peso = $estatus = $img =
        //  $stockk = $stockmin = $stockmax = $productid

		$descripcion = test_input($description);
		$codigo = test_input($code);
		$peso = test_input($weight_in_grams);
        $estatus = test_input($status);
        $stockk = test_input($stock);
        $stockmin = test_input($stock_min);
        $stockmax = test_input($stock_max);
        $productid = test_input($product_id);
        $precio = test_input($amount);

		//Si existe el id quiere decir que es un update y retornamos los datos + el id
		if (validateId($id)) {
			return array($descripcion, $codigo, $peso, $estatus, $stockk, $stockmin, $stockmax, $productid, $precio, $id);
		}
		//si no, retornamos los datos recibidos
		return array($descripcion, $codigo, $peso, $estatus, $stockk, $stockmin, $stockmax, $productid, $precio);
	}
	else{
		//si existe un error retornamos false
		return false;
	}
}

?>