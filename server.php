<?php
require_once  __DIR__.'/vendor/autoload.php' ;
$client = new Google\Client();
$client->setApplicationName('testAccount');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__.'/credentials.json');
$service = new Google_Service_Sheets($client);
$spreadsheetId = "1kLY7yMAPeKkxA89IJDoS-fIRYbqTfOTfQS-7BaT8Sb8";

$log = date('Y-m-d H:i:s') . ' Данные: Имя: '.$_POST["name"].', e-mail: '.$_POST["email"].', Телефон: '.$_POST["phone"]. '; ';
$i=0;
$result = array('success' => 1);
if (!preg_match("~^[А=ЯЁа-яё]+$~ui",$_POST["name"]) || !$_POST["name"]) {
    $result["errors"][$i]="name";
    $i++;
    $result["success"]=0;
}
if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) || !$_POST["email"]) {
    $result["errors"][$i]="email";
    $i++;
    $result["success"]=0;
}
$phone = "0";
if ($_POST["phone"]){
$phone = preg_replace("/[^0-9]/", '', $_POST["phone"]);
}
if (!(($phone[0]==7) && (strlen($phone)==11))){
    $result["errors"][$i]="phone";
    $result["success"]=0;
}
if(array_key_exists("errors", $result)) {
    $log .= 'Невалидные данные: ';
    foreach ($result["errors"] as $element) {
        $log .= $element. ',';
    }
}
else{
    $log .= 'Данные валидны';
    $range = "test";
    $values = [
      [$_POST["name"], $_POST["phone"], $_POST["email"], date('Y-m-d H:i:s')],  
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'RAW'
    ];
    $insert = [
        'insertDataOption' => 'INSERT_ROWS'
    ];
    $resp = $service -> spreadsheets_values -> append(
        $spreadsheetId,
        $range,
        $body,
        $params,
        $insert
    );
}
file_put_contents(__DIR__ . '/log.txt', $log . PHP_EOL, FILE_APPEND);
echo json_encode($result);


?>