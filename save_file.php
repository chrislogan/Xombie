<?php

require "config.php";

$result = false;

if (isset($_POST["file"]) && is_file($baseDir . $_POST["file"])
    && isset($_POST["data"])) {

    $result = file_put_contents($baseDir . $_POST["file"], $_POST["data"]);
}

$result = ($result != false) ? "Saved" : "Error";

echo json_encode($result);

?>
