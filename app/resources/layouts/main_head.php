<?php
function setHeader($args){
    $ua = isset($args->ua) ? as_object($args->ua) : (object)[
        'sv' => false,
        'id' => null,
        'username' => '',
        'tipo' => ''
    ];
?>
<!DOCTYPE html>
<html lang="es">
<head>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <title><?=$args->title?></title>
    <?=$args->styles ?? ''?>

<body class="">
<?php
}
