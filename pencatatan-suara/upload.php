
<?php
/**
 * Uploads record
 * TODO: fix privilages; php mkdir and chmod does not work properly
 */

$ext = ".ogg";
$target_dir = "data/";
$target_dir = $target_dir . $_POST["name"] ."_". $_POST["hp"] . "/";

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
    exec("chmod 777 " . $target_dir);
}

$target_file = $target_dir . $_POST["ds"] . "_" . $_POST["num"];

if (file_exists($target_file  . $ext)) {
    $i = 1;
    while (file_exists($target_file . "_" . $i  . $ext))
        $i++;
    $target_file = $target_file . "_" . $i;
}

$target_file = $target_file . $ext;

if (move_uploaded_file($_FILES["audio"]["tmp_name"], $target_file)) {
    exec("chmod 777 " . $target_file);
    echo "ok";
}
else
    echo "error";

?>
