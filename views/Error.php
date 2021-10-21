<?php $hasError = !empty($data)?>
<h1>ERROR <?=$hasError?'!':'?'?></h1>
<?=$hasError?$data:"There isn't any error."?>