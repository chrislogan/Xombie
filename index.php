<html>
<head>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
</head>
<body>
<?php

require "config.php";

$path = (isset($_GET["path"])) ? $_GET["path"] : "";

?>

<ul>
<?php

$files = array_slice(scandir($baseDir . $path), 2);
foreach ($files AS $file) {
    if (strpos($file, ".") !== 0) {
        if (is_dir($baseDir . $path . $file)) {
            $url = "/ace/index.php?path={$path}{$file}/";
        } else {
            $url = "/ace/editor.php?file={$path}{$file}";
        }

        echo '<li><a href="'.$url.'">'.$file.'</li>';
    }
}

?>
</ul>
</body>
</html>
