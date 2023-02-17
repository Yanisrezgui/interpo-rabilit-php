<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>get address IP</h2>
<?php
    $ipaddress = getenv("REMOTE_ADDR") ;
    Echo "Your IP Address is " . $ipaddress;
?>
</body>
</html>

