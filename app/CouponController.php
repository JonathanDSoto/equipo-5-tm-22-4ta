<?php 

Class CouponController{
    public static function getAllCoupons(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/coupons',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer 2481|orP7wSddndNYF3QR0KF9tQIiH0zrDRKyuaRfv4mk',
            'Cookie: XSRF-TOKEN=eyJpdiI6IlRVNXBzbWFXUDJWMVp2dlZSYng4eEE9PSIsInZhbHVlIjoiMm5Qa0VZekRKaUp5QUxMUGdJWWxXQ3pUaTFGMjdYL0k2eUNBZG81bUxLcmd4ZEVkRnZpNFFrN3BMbE9SRU5LY3BJVXNJOUNaWWQ5d01NcWFlMzVoenpzd3NGS3BaWWVmMjBZVVFRUWxUc05VcStLYk1zYlZteHIxdk1odEFUMmwiLCJtYWMiOiI2YTYxOTYzYmM5MzI4MGExODlmMmEzOTRhZDM4OGI5YTQxMTFlODc2MjdlYTFkYzYyMWE1MDE5OGMyYmE4NzMzIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlZLZ0xiWWtpWGdxc29TTXdiLytiVGc9PSIsInZhbHVlIjoiamkvek0rYUtMRmE0YzhHcVUrblVhY0dJdFNITEtvcG8yVFo2UVdKWURqbE0rMVAzZE1Md3REMmp3bGc2bUpUSTRNRG5aaWV3aHpTRm5zUzRaczVpTTc2bnBCS0tHb2dqUXNvWjhLejZBOTVmSEplQjRGOG1WYWZFQUszUnJLZE0iLCJtYWMiOiIwMmZkNTBkZjZmYjQ5YzA2ZDAwY2FiMGU0M2M0YzFjMWUxYmQxY2YzZWIxMDhhY2FmM2E0NmI4ODc3M2JhNWVlIiwidGFnIjoiIn0%3D'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}



?>