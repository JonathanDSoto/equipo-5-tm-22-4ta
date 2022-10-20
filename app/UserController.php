<?php
include_once "config.php";

Class UserController{

    public static function getUsers(){
        $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.$_SESSION['token'],
        'Cookie: XSRF-TOKEN=eyJpdiI6ImxTc2hpYXV6S05XRGF4S0JyUk56cVE9PSIsInZhbHVlIjoiS0RnczQzUHlybzVGa05IeGxIRTFZS1FjcU9XRFM3ZXdicTFYL2FkVmFXd3BLWGxkWDZvcjlyc2NndFhoVHE0ZGxOOEhycWszKzhqSGxkWGJBeElMOEJ2OThQdVR1S1loWmhHVFFaOWZaek1LU3A2U2c4eWhFcjEvQXJNOWNjM1giLCJtYWMiOiJlM2I5NzkxNGM3OWIxOTI2YWE1MWM0NGVhZWVjMGNkZTFkNzIxYWM5MzE1MWNmY2JhYzI0Njk4MGE1NDA4ZjhiIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImxWYnFFSldsT2U3bjVublR3cUxIckE9PSIsInZhbHVlIjoiaEsxZjcxZFY1Y2dhTEY3ZE5ESWtEaS9YRnlDaU5jSC9IZjhDVGg5VlFoeW5jWTE4UVY5V1UySVdPK0JrYTRpYm1aZlpyREdpd0hGZDZseUJNLzhkdUdJMGxVcndBUlZ3c0VjUjVKaVRHVmtCRDNFZFRFMHgxV0xuOEd0MTJJQjIiLCJtYWMiOiI0Y2ViMGU5OWZhNTQxNzE3NWM1NzdiZWVhZTcxYmIyNjBjN2FhMTIwNDQ2MzI2M2I4NmEzZDNlMmE5ZGRkNzFkIiwidGFnIjoiIn0%3D'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
    }

    public static function newUser($name, $lastname, $email, $phone_number, $created_by, $role, $password, $cover){
        
        if($cover){
            if($_FILES["cover"]["error"] > 0){
                header("Location: ../test.php");
            }
            $imagen = $_FILES["cover"]["tmp_name"];
        }


        $curl = curl_init();
        if($cover){
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('name' => $name,'lastname' => $lastname,'email' => $email,'phone_number' => $phone_number,
            'created_by' => $created_by,'role' => $role,'password' => $password,
            'profile_photo_file'=> new CURLFILE($imagen)),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$_SESSION['token'],
                'Cookie: XSRF-TOKEN=eyJpdiI6ImxTc2hpYXV6S05XRGF4S0JyUk56cVE9PSIsInZhbHVlIjoiS0RnczQzUHlybzVGa05IeGxIRTFZS1FjcU9XRFM3ZXdicTFYL2FkVmFXd3BLWGxkWDZvcjlyc2NndFhoVHE0ZGxOOEhycWszKzhqSGxkWGJBeElMOEJ2OThQdVR1S1loWmhHVFFaOWZaek1LU3A2U2c4eWhFcjEvQXJNOWNjM1giLCJtYWMiOiJlM2I5NzkxNGM3OWIxOTI2YWE1MWM0NGVhZWVjMGNkZTFkNzIxYWM5MzE1MWNmY2JhYzI0Njk4MGE1NDA4ZjhiIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImxWYnFFSldsT2U3bjVublR3cUxIckE9PSIsInZhbHVlIjoiaEsxZjcxZFY1Y2dhTEY3ZE5ESWtEaS9YRnlDaU5jSC9IZjhDVGg5VlFoeW5jWTE4UVY5V1UySVdPK0JrYTRpYm1aZlpyREdpd0hGZDZseUJNLzhkdUdJMGxVcndBUlZ3c0VjUjVKaVRHVmtCRDNFZFRFMHgxV0xuOEd0MTJJQjIiLCJtYWMiOiI0Y2ViMGU5OWZhNTQxNzE3NWM1NzdiZWVhZTcxYmIyNjBjN2FhMTIwNDQ2MzI2M2I4NmEzZDNlMmE5ZGRkNzFkIiwidGFnIjoiIn0%3D'
            ),
            ));
        }else{
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('name' => $name,'lastname' => $lastname,'email' => $email,'phone_number' => $phone_number,
                'created_by' => $created_by,'role' => $role,'password' => $password),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '.$_SESSION['token'],
                    'Cookie: XSRF-TOKEN=eyJpdiI6ImxTc2hpYXV6S05XRGF4S0JyUk56cVE9PSIsInZhbHVlIjoiS0RnczQzUHlybzVGa05IeGxIRTFZS1FjcU9XRFM3ZXdicTFYL2FkVmFXd3BLWGxkWDZvcjlyc2NndFhoVHE0ZGxOOEhycWszKzhqSGxkWGJBeElMOEJ2OThQdVR1S1loWmhHVFFaOWZaek1LU3A2U2c4eWhFcjEvQXJNOWNjM1giLCJtYWMiOiJlM2I5NzkxNGM3OWIxOTI2YWE1MWM0NGVhZWVjMGNkZTFkNzIxYWM5MzE1MWNmY2JhYzI0Njk4MGE1NDA4ZjhiIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImxWYnFFSldsT2U3bjVublR3cUxIckE9PSIsInZhbHVlIjoiaEsxZjcxZFY1Y2dhTEY3ZE5ESWtEaS9YRnlDaU5jSC9IZjhDVGg5VlFoeW5jWTE4UVY5V1UySVdPK0JrYTRpYm1aZlpyREdpd0hGZDZseUJNLzhkdUdJMGxVcndBUlZ3c0VjUjVKaVRHVmtCRDNFZFRFMHgxV0xuOEd0MTJJQjIiLCJtYWMiOiI0Y2ViMGU5OWZhNTQxNzE3NWM1NzdiZWVhZTcxYmIyNjBjN2FhMTIwNDQ2MzI2M2I4NmEzZDNlMmE5ZGRkNzFkIiwidGFnIjoiIn0%3D'
                ),
                ));
        }

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public static function getSpecificUser($id){
        
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
            'Authorization: Bearer '.$_SESSION['token'],
            'Cookie: XSRF-TOKEN=eyJpdiI6ImxTc2hpYXV6S05XRGF4S0JyUk56cVE9PSIsInZhbHVlIjoiS0RnczQzUHlybzVGa05IeGxIRTFZS1FjcU9XRFM3ZXdicTFYL2FkVmFXd3BLWGxkWDZvcjlyc2NndFhoVHE0ZGxOOEhycWszKzhqSGxkWGJBeElMOEJ2OThQdVR1S1loWmhHVFFaOWZaek1LU3A2U2c4eWhFcjEvQXJNOWNjM1giLCJtYWMiOiJlM2I5NzkxNGM3OWIxOTI2YWE1MWM0NGVhZWVjMGNkZTFkNzIxYWM5MzE1MWNmY2JhYzI0Njk4MGE1NDA4ZjhiIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImxWYnFFSldsT2U3bjVublR3cUxIckE9PSIsInZhbHVlIjoiaEsxZjcxZFY1Y2dhTEY3ZE5ESWtEaS9YRnlDaU5jSC9IZjhDVGg5VlFoeW5jWTE4UVY5V1UySVdPK0JrYTRpYm1aZlpyREdpd0hGZDZseUJNLzhkdUdJMGxVcndBUlZ3c0VjUjVKaVRHVmtCRDNFZFRFMHgxV0xuOEd0MTJJQjIiLCJtYWMiOiI0Y2ViMGU5OWZhNTQxNzE3NWM1NzdiZWVhZTcxYmIyNjBjN2FhMTIwNDQ2MzI2M2I4NmEzZDNlMmE5ZGRkNzFkIiwidGFnIjoiIn0%3D'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }

    public static function editUser($name,$lastname,$email,$phone_number,$created_by,$role,$password,$id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, 
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => "name=$name&lastname=$lastname&email=$email&phone_number=$phone_number&created_by=$created_by&role=$role&password=$password&id=$id",
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token'],
            'Content-Type: application/x-www-form-urlencoded',
            'Cookie: XSRF-TOKEN=eyJpdiI6ImxTc2hpYXV6S05XRGF4S0JyUk56cVE9PSIsInZhbHVlIjoiS0RnczQzUHlybzVGa05IeGxIRTFZS1FjcU9XRFM3ZXdicTFYL2FkVmFXd3BLWGxkWDZvcjlyc2NndFhoVHE0ZGxOOEhycWszKzhqSGxkWGJBeElMOEJ2OThQdVR1S1loWmhHVFFaOWZaek1LU3A2U2c4eWhFcjEvQXJNOWNjM1giLCJtYWMiOiJlM2I5NzkxNGM3OWIxOTI2YWE1MWM0NGVhZWVjMGNkZTFkNzIxYWM5MzE1MWNmY2JhYzI0Njk4MGE1NDA4ZjhiIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImxWYnFFSldsT2U3bjVublR3cUxIckE9PSIsInZhbHVlIjoiaEsxZjcxZFY1Y2dhTEY3ZE5ESWtEaS9YRnlDaU5jSC9IZjhDVGg5VlFoeW5jWTE4UVY5V1UySVdPK0JrYTRpYm1aZlpyREdpd0hGZDZseUJNLzhkdUdJMGxVcndBUlZ3c0VjUjVKaVRHVmtCRDNFZFRFMHgxV0xuOEd0MTJJQjIiLCJtYWMiOiI0Y2ViMGU5OWZhNTQxNzE3NWM1NzdiZWVhZTcxYmIyNjBjN2FhMTIwNDQ2MzI2M2I4NmEzZDNlMmE5ZGRkNzFkIiwidGFnIjoiIn0%3D'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public static function deleteUser($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users/'.$id,
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

    public static function updatePhoto($id, $cover){
        if($cover){
            if($_FILES["cover"]["error"] > 0){
                header("Location: ../test.php");
            }
            $imagen = $_FILES["cover"]["tmp_name"];
        }
        $curl = curl_init();

        if($cover){
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users/avatar',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('id' => $id,'profile_photo_file'=> new CURLFILE($imagen)),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$_SESSION['token'],
                'Cookie: XSRF-TOKEN=eyJpdiI6Iko2S0JzL1gvb0Z0QkgyZGFMSzgxbXc9PSIsInZhbHVlIjoiWldrYTEzc2FDekUxTlpHNFBKQVlQZ25NT3I3TzRKNmh5QkNxYUpROWc2QW0xZk54ekpWZ2xOZ3NwN2pqRWE1ekJLR2VvZFdPbi9ZeDRPTkJYY3R5dVRCdmhqb1hvV1hwM3lYVWd6QkR0dWNtOGJuVHJZWWpQYzJMNU5ibXZYU28iLCJtYWMiOiI4NDRmMDNlM2IzNTlkYjEwMGI5YWEwODI2OTAxMDlhYzIxYjJhZTZhNTk0Y2ZjZGViNTZhM2E4NDAwY2Y3Y2MyIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImZEWjlrNytRcGtIT0pkM3RrbVpBMWc9PSIsInZhbHVlIjoiSW5jUDdoWFBocVFRR2pXTStwbUx2czdCT3RyOEtVQ2VIOTJnQm9UdjZMa2dYbWtpQUJIM1dTYk9GSU5xOTNhT1FBR081LzhhVkR4Z1l5N2NOT0dBbEhzQ2hRM3BiOHNaS2xBUHkzQUM1aDRUeDhaMGpxTzgvVFdZQ3ZtZG93dngiLCJtYWMiOiJhODU4YWVlZGRjOTY5NTBkODJkNzdkZWZiZTY5ODI0OTIwM2Q2MTM4NWFmM2Y3YTc1YTM4YzM0M2FjMDlkZDhjIiwidGFnIjoiIn0%3D'
            ),
            ));
        }else{
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users/avatar',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('id' => $id),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$_SESSION['token'],
                'Cookie: XSRF-TOKEN=eyJpdiI6Iko2S0JzL1gvb0Z0QkgyZGFMSzgxbXc9PSIsInZhbHVlIjoiWldrYTEzc2FDekUxTlpHNFBKQVlQZ25NT3I3TzRKNmh5QkNxYUpROWc2QW0xZk54ekpWZ2xOZ3NwN2pqRWE1ekJLR2VvZFdPbi9ZeDRPTkJYY3R5dVRCdmhqb1hvV1hwM3lYVWd6QkR0dWNtOGJuVHJZWWpQYzJMNU5ibXZYU28iLCJtYWMiOiI4NDRmMDNlM2IzNTlkYjEwMGI5YWEwODI2OTAxMDlhYzIxYjJhZTZhNTk0Y2ZjZGViNTZhM2E4NDAwY2Y3Y2MyIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImZEWjlrNytRcGtIT0pkM3RrbVpBMWc9PSIsInZhbHVlIjoiSW5jUDdoWFBocVFRR2pXTStwbUx2czdCT3RyOEtVQ2VIOTJnQm9UdjZMa2dYbWtpQUJIM1dTYk9GSU5xOTNhT1FBR081LzhhVkR4Z1l5N2NOT0dBbEhzQ2hRM3BiOHNaS2xBUHkzQUM1aDRUeDhaMGpxTzgvVFdZQ3ZtZG93dngiLCJtYWMiOiJhODU4YWVlZGRjOTY5NTBkODJkNzdkZWZiZTY5ODI0OTIwM2Q2MTM4NWFmM2Y3YTc1YTM4YzM0M2FjMDlkZDhjIiwidGFnIjoiIn0%3D'
            ),
            ));

        }

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}



?>