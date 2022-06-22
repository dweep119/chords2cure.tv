<?php 
include_once('includes/header.php');
include_once('includes/left-navbar.php');
isSessionExpired();

$streamType = getValPostORGet('streamType', 'B');
$menuGuid = getValPostORGet('menuGuid', 'B');
$streamGuid = getValPostORGet('streamGuid', 'B');
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
$qStr = "?menuGuid=".$selectedMenuGuid."&streamGuid=".$streamGuid."&streamType=".$selectedMenuType;
?>
<!-- Start of Page Content  -->
<div id="content">
<?php
include_once('includes/top-navbar.php');
?>

	<!-- Start of right container -->
	<div class="container-fluid">
	
		<div class="container_topgap">
		
			<!-- Start of movie detail-->
			<div class="col-md-12">
<?php
					//echo "<pre>";
					//print_r($arrSelectedItemData);
					//echo "</pre>";
?>
				<div class="row">					
					<div class="col-md-12 col-lg-12">					
						<div class="container_medium">
							<div class="card_holder_border">
								<div class="ticket_container">
									<div class="donation_text">A Ticket code has been sent to you. Please return to the DonatePerView Live Events selection on the day and time of the event and use your ticket code to start watching.</div>
									<div class="activation_btn centeralize_box">
									<a href="detail-page.php<?php echo$qStr?>"><button type="button" class="btn btn-light btn-inline-block btn_submit">Return to Guide</button></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End of movie detail-->
				
		</div>
	</div>
	<!-- End of right container -->

<!-- Start of footer -->	
<?php 
include_once('includes/footer.php');
?>
<!-- End of footer -->