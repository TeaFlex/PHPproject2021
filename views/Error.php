<?php $hasError = !empty($data)?>
<h1 class="error">ERREUR <?=$hasError?'!':'?'?></h1>

<?php 
    if($hasError) {
        ?>
            <div>Veuillez renseigner ces informations auprès de l'opérateur.</div>
            <div>Message: <?= $data->getMessage()?></div>
            <div>Stack trace: <?= $data->getTraceAsString()?></div>
        <?php
    }
    else
        echo "Circulez, il n'y a pas d'erreur ici !";
?>