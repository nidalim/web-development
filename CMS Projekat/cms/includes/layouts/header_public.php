<?php
if (!isset($layout_context)) {
    $layout_context = "public";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>CMS <?php if ($layout_context == "admin") {
            echo "Administrator";
        } ?></title>
    <link href="css/public.css" media="all" rel="stylesheet" type="text/css"/>
    <style>
        @media screen and (max-width: 1200px) {

            #stranice{
                width: 60%;
            }
        }
        @media screen and (max-width: 900px) {

            #stranice{
                width: 48%;
            }
        }
        @media screen and (max-width: 600px) {
            #navigation {
                width: 90%;
            }
            #stranice{
                width: 90%;
            }

            body {
                margin: 0;
            }
        }
    </style>

</head>
<body>
<div id="header">
    <h1><img src="./images/logo.png"><?php if ($layout_context == "admin") {
            echo "Administrator";
        } ?></h1>
</div>