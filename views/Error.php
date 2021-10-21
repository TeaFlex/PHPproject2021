<?php $hasError = !empty($data)?>
<h1>ERREUR <?=$hasError?'!':'?'?></h1>
<?=$hasError?$data:"Circulez, il n'y a pas d'erreur ici !"?>