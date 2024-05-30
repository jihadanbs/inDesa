<?php

/**
 * Returns list of datasets
 */

$directory = './data';
$scanned_directory = array_diff(scandir($directory), array('..', '.'));

//exec("find data/* -exec chmod 777 {} +");

foreach ($scanned_directory as $value) {
    echo '<option>' . $none . '</option>';
    echo '<option>' . $value . '</option>';
}

?>