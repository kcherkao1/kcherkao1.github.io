<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

$apiKey = "068920C9F1AD89AC9AC9DCA11F938AB48E33F08A0E216FB1563605349368AADE0AEAA8700C30E89B1E22FBA64FA12A02";

$name = $_POST["name"];
$email = $_POST["email"];
$project = $_POST["project"];
$message = $_POST["message"];

$body = "From: $name <$email>\n\nProject: $project\n\nMessage:\n$message";

$data = http_build_query(array(
    "apikey" => $apiKey,
    "from" => $email,
    "fromName" => $name,
    "to" => "kamalcherkaoui.2001@gmail.com",
    "subject" => "Contact Form: $project",
    "bodyText" => $body
));

$context = stream_context_create(array(
    "http" => array(
        "method" => "POST",
        "header" => "Content-Type: application/x-www-form-urlencoded\r\n",
        "content" => $data
    )
));

$response = file_get_contents("https://api.elasticemail.com/v2/email/send", false, $context);
echo $response;
?>
