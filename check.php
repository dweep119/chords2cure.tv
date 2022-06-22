<?php
include_once('web-config.php');
include_once('includes/functions/common.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Swig - Purspek</title>
	<link rel="icon" type="image/png" sizes="48x48" href="images/favicon.ico">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/style_updated.css">
</head>
<body>
<!-- Start of wrapper -->
<div class="wrapper">
<iframe src='https://www.cymtv.com/blabax/' style="width:100%; height:100%;"></iframe>
<?php
$feedURL = MAIN_FEED_URL;
//$arrPost = array();
$arrRes = sendRequestUsingCURL(0, $feedURL);

$ARR_FEED_DATA = parseMainFeedArrData(0, $arrRes, '');
echo "<pre>";
//print_r($arrFeedData);
//die;