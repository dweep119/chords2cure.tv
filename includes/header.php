<?php
include_once('web-config.php');
include_once('includes/functions/common.php');
include_once('includes/functions/form-validation.php');
$_SESSION['prepareToken'] = randomMD5();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CHORDS2CURE TV</title>
	<link rel="icon" type="image/png" sizes="48x48" href="images/favicons.ico">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css?t=<?php echo date('U')?>">
	<link rel="stylesheet" href="css/style_updated.css?t=<?php echo date('U')?>">
	<link rel="stylesheet" href="css/slick.css">
</head>
<body>
<!-- Start of wrapper -->
<div class="wrapper">
<?php
$feedURL = MAIN_FEED_URL;
//$arrPost = array();
$arrRes = sendRequestUsingCURL(0, $feedURL);

$menuGuid = getValPostORGet('menuGuid', 'B');

$ARR_FEED_DATA = parseMainFeedArrData(0, $arrRes, $menuGuid);
$SELECTED_MENU_TYPE = $ARR_FEED_DATA['selectedMenuType'];
$selectedMenuGuid = $ARR_FEED_DATA['selectedMenuGuid'];
//arrMenuSelectedItemData

//if ($selectedMenuType == 'L' && basename($_SERVER['SCRIPT_NAME']) != 'video-player.php')
//{
	//headerRedirect("video-player.php?");
//}
?>