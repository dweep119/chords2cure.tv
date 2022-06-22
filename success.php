<?php 
include_once('includes/header.php');
include_once('includes/left-navbar.php');

isSessionExpired();

$streamType = getValPostORGet('streamType', 'B');
$menuGuid = getValPostORGet('menuGuid', 'B');
$streamGuid = getValPostORGet('streamGuid', 'B');
$paymentStatus = getValPostORGet('st', 'B');
$paymentId = getValPostORGet('tx', 'B');

if ($menuGuid != '' && $streamGuid != '') isSessionExpired();

$userCode = $_SESSION['USER_DETAILS']['USER_CODE'];
// If Live Event Request There then get stream ID
if ($streamType == 'E')
{
	//$streamGuid = $ARR_FEED_DATA['arrMenuSelectedItemData'][0]['stream_guid'];
	//$streamGuid = $ARR_FEED_DATA['arrMenuSelectedItemData'][0]['streams'][0]['stream_guid'];
}

$detailPageFeedURL = DETAIL_PAGE_BASE_URL.'/'.$streamGuid.'/'.$menuGuid.'/'.$userCode;

$arrRes = sendRequestUsingCURL(0, $detailPageFeedURL);

$ARR_DETAIL_PG_FEED_DATA = parseDetailPgFeedArrData(0, $arrRes);

$arrSelectedItemData = $ARR_DETAIL_PG_FEED_DATA['arrSelectedItemData'];

// Here get Menu Info
$selectedMenuName = trim($ARR_DETAIL_PG_FEED_DATA['selectedMenuName']);
$selectedMenuGuid = trim($ARR_DETAIL_PG_FEED_DATA['selectedMenuGuid']);
$selectedMenuType = trim($ARR_DETAIL_PG_FEED_DATA['selectedMenuType']);
    
if (strtolower($paymentStatus) == 'completed' && $paymentId != '')
{
	$arrFormData['appId'] = APP_CODE;
	$arrFormData['userCode'] = $_SESSION['USER_DETAILS']['USER_CODE'];
	$arrFormData['streamGuid'] = $streamGuid;
	$arrFormData['amount'] = $itemAmt;	
	$videoPlayerURL = "video-player.php?menuGuid=".$selectedMenuGuid."&streamGuid=".$streamGuid."&streamType=".$selectedMenuType;
	
	if ($streamType == 'E')
	{		
		$arrFormData4PP = $arrFormData;
		$arrFormData['postAction'] = 'buyTicket';
		$arrFormData['buyInformation'] = $paymentId;
		$arrRes = sendRequestUsingCURL(0, TICKET_PAGE_BASE_URL, $arrFormData);
		$liveEventStatus = isLiveEventOnGoing($arrSelectedItemData['stream_event_st_date_time_on_utc'], $arrSelectedItemData['stream_event_end_date_time_on_utc']);
		
		if ($liveEventStatus == 'Y')
		{				
			$arrFormData4PP['postAction'] = 'sendPaymentInfo';
			$arrFormData4PP['paymentInformation'] = $arrRes['data']['ticket_code'];
			
			$arrRes = sendRequestUsingCURL(0, PAYMENT_BASE_URL, $arrFormData4PP);
		}
		else
		{
			$videoPlayerURL = "ticket-confirmation.php?menuGuid=".$selectedMenuGuid."&streamGuid=".$streamGuid."&streamType=".$selectedMenuType;
		}
	}
	else 
	{			
		$arrFormData['postAction'] = 'sendPaymentInfo';
		$arrFormData['paymentInformation'] = $paymentId;			
		$arrRes = sendRequestUsingCURL(0, PAYMENT_BASE_URL, $arrFormData);
	}

	
	$status = $arrRes['status'];

	if ($status == 1)
	{
		$msg = $arrRes['msg'];	
		
		headerRedirect($videoPlayerURL);
	}
	else if ($status == 0) $msg = $arrRes['msg'];
	else $msg = GENERAL_MSG;
	echo $successMessage = $msg;
}

include_once('includes/footer.php');
?>
<!-- End of footer -->