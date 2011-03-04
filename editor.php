<?php

require "config.php";

$text = "";
$file = "";

if (isset($_GET["file"]) && is_file($baseDir . $_GET["file"])) {
    $text = file_get_contents($baseDir . $_GET["file"]);
    $file = end(explode("/", $_GET["file"]));
}

?>

<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php echo "{$file} /{$_GET["file"]}"; ?></title>
  <link rel="icon" href="/ace/icon.png" type="image/png" />
  <style type="text/css" media="screen">
    body {
        overflow: hidden;
    }
    
    #editor { 
        margin: 0;
        position: absolute;
        top: 40px;
        bottom: 0;
        left: 0;
        right: 0;
    }
  </style>
<script src="http://code.jquery.com/jquery-1.5.1.min.js"></script>
<script src="src/ace.js" type="text/javascript" charset="utf-8"></script>
<script src="src/theme-textmate.js" type="text/javascript" charset="utf-8"></script>
<script src="src/mode-php.js" type="text/javascript" charset="utf-8"></script>
<script>
    // https://github.com/ajaxorg/ace/wiki/Embedding---API
    var editor;

    window.onload = function() {
        editor = ace.edit("editor");
        editor.setTheme("ace/theme/textmate");

        var PhpMode = require("ace/mode/php").Mode;
        editor.getSession().setMode(new PhpMode());
    };

    function save() {
        var file = $("#file").val();
        var data = editor.getSession().getValue();

        $.ajax({
            type: 'POST',
            url: "/ace/save_file.php",
            data: {file: file, data: data},
            success: function (rdata) {
                alert(rdata);
            },
            dataType: "json"
        });
    }
</script>
</head>
<body>

<div id="toolbar">
    <button onclick="save();">Save</button>
    <input type="hidden" id="file" value="<?php echo $_GET["file"]; ?>" />
</div>

<pre id="editor"><?php echo htmlspecialchars($text); ?></pre>
</body>
</html>
