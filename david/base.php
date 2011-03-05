<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>David Bengoa Rocandio</title>
        <link href='http://fonts.googleapis.com/css?family=Droid+Serif:bolditalic|Ubuntu:normal,italic' rel='stylesheet' type='text/css'>
<?php emerge("css"); ?>
        <link href="<?php echo d(); ?>css/global.css" rel="stylesheet" />
    </head>
    <body>
<?php emerge("content");?>
    </body>
</html>
<?php
    foreach ($strs as $k=>$v){
        echo "\"$k\"=>\"$v\",\n";
    }
?>
