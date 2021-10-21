<?php
    $defaultTitle = "Mon site";
    $defaultContent = "No content";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title><?=(isset($title))? $title : $defaultTitle?></title>
</head>
<body>
    <?=(isset($content))?$content : $defaultContent?>
</body>
</html>