
<?php
    $id = rand(0,9999);
    $md5_hash = md5($id + ".12er"); 
    $security_code = substr($md5_hash, 25, 5); 
    $enc=md5($security_code);

echo "id $id  $enc\n";
?>