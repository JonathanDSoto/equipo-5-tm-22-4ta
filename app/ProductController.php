<?php  
include_once "config.php";
//Productos: { altas, bajas, modificaciones, consultas y vista de detalle: { información del producto, lista de presentaciones (crud de presentaciones), tabla de ordenes } }

if (isset($_POST['action'])) {

	if ( isset($_POST['global_token']) && 
		$_POST['global_token'] == $_SESSION['global_token']) {
			//inicializacion de tags y categories
			$tags = array();
			$categories = array();
			//si llegan por post se guarda en los arrays anteriores
			if( isset($_POST['categories'])){

				foreach($_POST['categories'] as $key => $categoria){
					$categories["categories[$key]"] = strip_tags($categoria);
				}

			}
			if( isset($_POST['tags'])){
				
				foreach($_POST['tags'] as $key => $etiqueta){
					$tags["tags[$key]"] = strip_tags($etiqueta);
				}

			}
	
		switch ($_POST['action']) {
			case 'create':
				if( isset($_POST['name']) &&
					isset($_POST['slug']) &&
					isset($_POST['description']) &&
					isset($_POST['features']) &&
					isset($_POST['brand_id'])) {

						$cover = false;

                        if( isset($_FILES['cover'])){
                            $cover = true;
                        }

						$name = strip_tags($_POST['name']);
						$slug = strip_tags($_POST['slug']);
						$description = strip_tags($_POST['description']);
						$features = strip_tags($_POST['features']);
						$brand_id = strip_tags($_POST['brand_id']);

						$res = validateProd($name, $slug, $description, $features, $brand_id);

						if(!$res){ 
							header("Location: ".BASE_PATH."productos/error");
						}else{
							ProductsController::createProduct($name, $slug, $description, $features, $brand_id, $cover, $categories, $tags);
						}
					}else{
						header("Location: ".BASE_PATH."productos/error");
					}
			break; 

			case 'update':
				if( isset($_POST['name']) &&
					isset($_POST['slug']) &&
					isset($_POST['description']) &&
					isset($_POST['features']) &&
					isset($_POST['brand_id']) &&
					isset($_POST['id'])) {

						$name = strip_tags($_POST['name']);
						$slug = strip_tags($_POST['slug']);
						$description = strip_tags($_POST['description']);
						$features = strip_tags($_POST['features']);
						$brand_id = strip_tags($_POST['brand_id']);
						$id = strip_tags($_POST['id']);

						$res = validateProd($name, $slug, $description, $features, $brand_id, $id);

						if(!$res){ 
							header("Location: ".BASE_PATH."productos/error");
						}else{
							ProductsController::updateProduct($name, $slug, $description, $features, $brand_id, $id);
						}
				}else{
					header("Location: ".BASE_PATH."productos/error");
				}
				 
			break;

			case 'delete':
				if( isset($_POST['id']) ){
					
					$id = test_input($_POST['id']);

					if(validateId($id)){
                        ProductsController::remove($id);
                    }else{
                        header("Location: ".BASE_PATH."productos/error");
                    }
				}else{
					header("Location: ".BASE_PATH."productos/error");
				}

			break; 

			default:
				header("Location: ".BASE_PATH."productos/error");
				break;
		}

	}
}

Class ProductController
{
	public static function getProducts()
	{

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
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
	public static function getSpecificProduct($id){
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

			return array();
		}
	}
	public static function getProduct($slug)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/slug/'.$slug,
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

	public static function createProduct($name,$slug,$description,$features,$brand_id, $cover, $categories, $tags)
	{
		if($cover){
            if($_FILES["cover"]["error"] > 0){
                header("Location: ".BASE_PATH."productos/error");
            }
            $imagen = $_FILES["cover"]["tmp_name"];
        }

		$curl = curl_init();
		if($cover){
			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS => array(
				  'name' => $name,
				  'slug' => $slug,
				  'description' => $description,
				  'features' => $features,
				  'brand_id' => $brand_id,
				  'cover'=> new CURLFILE($imagen)
			  ) + $categories + $tags,
			  CURLOPT_HTTPHEADER => array(
				'Authorization: Bearer '.$_SESSION['token']
			  ),
			)); 
		}else{
			curl_setopt_array($curl, array(
				CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => array(
					'name' => $name,
					'slug' => $slug,
					'description' => $description,
					'features' => $features,
					'brand_id' => $brand_id
					) + $categories + $tags,
				CURLOPT_HTTPHEADER => array(
				  'Authorization: Bearer '.$_SESSION['token']
				),
			  )); 
		}

		$response = curl_exec($curl); 
		curl_close($curl);
		$response = json_decode($response);

		if ( isset($response->code) && $response->code > 0) {

			header("Location: ".BASE_PATH."productos/success");
		}else{ 
			header("Location: ".BASE_PATH."productos/error");
		}

	}

	public static function updateProduct($name,$slug,$description,$features,$brand_id,$id)
	{
 

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'PUT',
		  CURLOPT_POSTFIELDS => 'name='.$name.'&slug='.$slug.'&description='.$description.'&features='.$features.'&brand_id='.$brand_id.'&id='.$id,
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Bearer '.$_SESSION['token'],
		    'Content-Type: application/x-www-form-urlencoded'
		  ),
		));


		$response = curl_exec($curl); 
		curl_close($curl);
		$response = json_decode($response);

		if ( isset($response->code) && $response->code > 0) {
			header("Location: ".BASE_PATH."productos/success");
		}else{ 
			header("Location: ".BASE_PATH."productos/error");
		}

	}

	public static function remove($id)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/'.$id,
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

		if ( isset($response->code) && $response->code > 0) {
			
			return true;
		}else{

			return false;
		}
	}

}

//funcion de validacion de campos
function validateProd($name, $slug, $description, $features, $brand_id, $id=-1){
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