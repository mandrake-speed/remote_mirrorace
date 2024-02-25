<?php
//Utilisation de l'api mirrorace pour faire de l'upload multiple automatiquement en queue, les fichiers les uns aprés les autres sur autant de mirroir que l'ont souhaite.
//CONDITIONS: les url avec les noms des vidéos doivent être identique, seul le numéro d'épisode sera incrémenté automatiquement. de 1 à autant que vous voulez. de 1 à 100 içi.
//Pour uploader un grand nombre d'épisodes d'un seul coup,(genre une centaine), sans l'arrêt du système php, il faut augmenter dans le php.ini le max_execution_time à 600 par example ce 
//qui fait 10 minutes. à vous de voir , sinon il faudra modififier $i = 1 à 10 puis 20 par example pour up les épisodes 10 par 10 mais manuellement.
//Une fois l'op terminé tout vos liens seront dans votre compte mirorrace et une liste de json de retour s'afficherons pour vérif.
//
$api_key = 'abcdefghijklm123456789';  // yourapikey / api key de mirrorace à récup dans votre compte
$api_token = 'abcdefghijklm123456789'; // yourapitoken / même chose avec l'api token


for ($i = 1; $i <= 100 ; $i ++) {
    $urls = "https://un_site.fr/videos/nom_de_la_serie/nom_episode_" . $i . "_VOSTFR.mp4";
	//echo $urls . "<br>"; (pour vérif, ne pas toucher si vous ne savez pas ce que vous faites)
	
$url = $urls; //url file

//Get server remote url, cTacker and upload key / ont récup les infos nescéssaire pour le remote upload
$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://mirrorace.com/api/v1/file/upload");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'api_key' => $api_key,
        'api_token' => $api_token
    ]);
    curl_setopt($ch, CURLOPT_HEADER, 0); 
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    $res = curl_exec($ch);
    $response = json_decode($res, true);
    curl_close($ch);
    $ch = null;
	

//step 2 upload file / ont utilise les infos récupérer juste avant pour uploader nos fichiers. attendre la fin pour l'afichage des json de retour.
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $response['result']['server_remote']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'api_key' => $api_key,
        'api_token' => $api_token,
        'cTracker' => $response['result']['cTracker'],
        'upload_key' => $response['result']['upload_key'],
        'url' => $url,
        'mirrors[1]' => 15,  //you can edit this number with other mirrorace server number / vous pouvez éditer , ajouter autant de mirroir que vous voulez.
        'mirrors[2]' => 26,
        'mirrors[3]' => 81,
        'mirrors[4]' => 56,
        //'mirrors[5]' => 20
           
    ]);
    curl_setopt($ch, CURLOPT_HEADER, 0); 
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    $resp = curl_exec($ch);
    $response2 = json_decode($resp, true);
	
    echo '<pre>';
	print_r($response2);//Affichage du json de retour (pour infos, ce qui permet de voir si certains épisodes ont foiré, différence dans les url par example)
	echo '</pre>';
}   

?>
