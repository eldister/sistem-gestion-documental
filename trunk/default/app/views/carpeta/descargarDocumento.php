<?php
header ("Content-Disposition: attachment; filename=".$archivo."\n\n");
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($archivo));
readfile($archivo);
?>