<?php

$name = $_POST['name'];
$desc = $_POST['desc'];
$webad = $_POST['webpro'];
$avtor = $_POST['avto'];
$file = $_POST['file'];
$token = "6428847568:AAFLkmGONGKIAbVmEybyd__WII-ssXxJ4j4";
$chat_id = "-4111242810";
$arr = array('Пришла заявка от' => $avtor,
	'Имя приложения: ' => $name,
	'Описание приложения: ' => $desc,
	'Веб-адрес приложения: ' => $webad);
	

foreach($arr as $key => $value) {
  $txt .= "<b>".$key."</b> ".$value."%0A";
};

$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");

?>

<?php

/* ОТПРАВКА ФАЙЛА В ТЕЛЕГРАММ */
function sendFileTelegram($fileTempName) {
  /*токен который выдаётся при регистрации бота */
  $token = "6428847568:AAFLkmGONGKIAbVmEybyd__WII-ssXxJ4j4";
  /*идентификатор группы*/
  $chat_id = "-4111242810";

  $urlSite = "https://api.telegram.org/bot{$token}/sendDocument";

  $document = new CURLFile(realpath($fileTempName));

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $urlSite);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, ["chat_id" => $chat_id, "document" => $document]);
  curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type:multipart/form-data"]);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  $out = curl_exec($ch);
  curl_close($ch);
}

sendFileTelegram($_FILES["fileImg"]["tmp_name"]);

if (sendFileTelegram) {
  header('Location: loaded.html');
} else {
  header('Location: error.html');
}

?>
