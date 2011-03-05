<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>David Bengoa Rocandio</title>
        <link href='http://fonts.googleapis.com/css?family=Droid+Serif|Ubuntu' rel='stylesheet' type='text/css'>
        <?php
            if(!emerge("css")){
                ?><link href="<?php echo d(); ?>css/global.css" rel="stylesheet" /><?php
            }
        ?>
    </head>
    <body>
        <?php emerge("content"); ?>
    </body>
</html>
