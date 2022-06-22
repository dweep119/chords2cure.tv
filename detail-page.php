<?php 
include_once('includes/header.php');
include_once('includes/left-navbar.php');
?>
<!-- Start of Page Content  -->
<div id="content">
<?php
include_once('includes/top-navbar.php');

$streamType = getValPostORGet('streamType', 'B');
$menuGuid = getValPostORGet('menuGuid', 'B');
$streamGuid = getValPostORGet('streamGuid', 'B');

$userCode = md5('test');
// If Live Event Request There then get stream ID
if ($streamType == 'E')
{
	//$streamGuid = $ARR_FEED_DATA['arrMenuSelectedItemData'][0]['streams'][0]['stream_guid'];
	//$streamGuid = $ARR_FEED_DATA['arrMenuSelectedItemData'][0]['stream_guid'];
}

if (!empty($_SESSION['USER_DETAILS']['USER_CODE'])) $userCode = $_SESSION['USER_DETAILS']['USER_CODE']; 

$detailPageFeedURL = DETAIL_PAGE_BASE_URL.'/'.$streamGuid.'/'.$menuGuid.'/'.$userCode;

$arrRes = sendRequestUsingCURL(0, $detailPageFeedURL);

$ARR_DETAIL_PG_FEED_DATA = parseDetailPgFeedArrData(0, $arrRes);
$arrLatestItemsData = $ARR_DETAIL_PG_FEED_DATA['arrLatestItemsData'];
$arrSelectedItemData = $ARR_DETAIL_PG_FEED_DATA['arrSelectedItemData'];
$streamTrailerUrl = trim($arrSelectedItemData['stream_trailerUrl']);
if (!strpos($streamTrailerUrl,"youtube.com")) $streamTrailerUrl ='';

$selectedstreamGuid = $streamGuid;

// Here get Menu Info
$selectedMenuName = trim($ARR_DETAIL_PG_FEED_DATA['selectedMenuName']);
$selectedMenuGuid = trim($ARR_DETAIL_PG_FEED_DATA['selectedMenuGuid']);
$selectedMenuType = trim($ARR_DETAIL_PG_FEED_DATA['selectedMenuType']);

$isDonatePerView = $arrSelectedItemData['is_donate_per_view'];
$streamExpiredOnInUnixTime = $arrSelectedItemData['stream_expired_on_in_unix_time'];
$cUnixTime = getCurrentUnixtime();

// Here for Live Event
$isLiveEventBuyed = $arrSelectedItemData['is_live_event_buyed'];
$stUnixTime = unixtime64($arrSelectedItemData['stream_event_st_date_time_on_utc']);
$enUnixTime = unixtime64($arrSelectedItemData['stream_event_end_date_time_on_utc']);
$liveEventStatus = getEventStaus($stUnixTime, $enUnixTime, $isLiveEventBuyed);

$eventTiming = $arrSelectedItemData['stream_event_st_date_time_on_utc'];

?>

	<!-- Start of right container -->
	<div class="container-fluid">
		<div class="container_topgap">
			<!-- Start of movie detail-->
			<div class="col-md-12">
				<div class="container_spaces">
					<div class="row">
					<div class="col-sm-6 col-md-4 col-lg-4">
							<img src="<?php echo $arrSelectedItemData['stream_thumbnail'];?>" class="donate_per_view_img" onerror="if (this.src != 'images/detail_default_img.jpg') this.src = 'images/detail_default_img.jpg';">
<?php
						if ($eventTiming != '' && $selectedMenuType == 'E')
						{
							$eventTiming = convertDateTimeSpecificTimeZone($eventTiming, 'UTC', 'Y-m-d H:i:s', 'America/Sao_Paulo');
							$eStDate = getTimestamp($eventTiming, 'd/m/Y');
							$eStTime = getTimestamp($eventTiming, 'H:i');
						
?>
							<span class="date_time_box">Encontro: <?php echo $eStDate?> | Hora do evento: <?php echo $eStTime?></span>
<?php
						}
?>
					</div>
					<div class="col-sm-6 col-md-8 col-lg-8">
						<div class="movie_detail">
<?php
							//echo "<pre>";
							//print_r($arrSelectedItemData);
							//echo "</pre>";
?>
							<h2><?php echo $arrSelectedItemData['stream_title']?></h2>

							<?php if (!empty($arrSelectedItemData['awards'])) { ?> 
								<div class="movie_award">Awards:&nbsp;<?php echo $arrSelectedItemData['awards']; ?></div> 
							<?php } ?>

							<div class="movie_language">
								<?php if (!empty($arrSelectedItemData['rating'])) { ?>
									<span class="movie_rate"><?php echo $arrSelectedItemData['rating']; ?></span>
								<?php } ?>

								<?php if (!empty($arrSelectedItemData['language'])) { ?>
									&nbsp;|&nbsp;<span class="movie_category"><?php echo $arrSelectedItemData['language']; ?></span>
								<?php } ?>
								
								<?php if (!empty($arrSelectedItemData['stream_duration'])) { ?>
									&nbsp;|&nbsp;<span class="movie_time"><?php echo printDuration($arrSelectedItemData['stream_duration']);?></span>
								<?php } ?>
							</div>

							<div class="star_box">
<?php
							$review = $arrSelectedItemData['review'];

							if ($review > 0) 
							{ 
								for($rating = 1; $rating <= 5; $rating++)
								{
									$ratingCls = 'star_border';
									if ($review != '' && $review >= $rating) $ratingCls = 'star';
?>
								
									<i class="material-icons star_icon"><?php echo $ratingCls?></i>
								
<?php
								}
							}
?>
							</div>

							<div class="movie_btn">
							<?php
							if ($streamTrailerUrl != '')
							{
							?>
								<button type="button" class="btn btn-outline-light"><a href="<?php echo $streamTrailerUrl;?>" target="_blank" data-toggle="modal" data-target="#video_player_popup">Watch Trailer</a></button>
<?php
							}

							//------------------------------------For Purspektv & onDemand--------------------------------------------------
							
							$videoPlayerURL = "video-player.php?menuGuid=".$selectedMenuGuid."&streamGuid=".$streamGuid."&streamType=".$selectedMenuType;
							if ($selectedMenuType == 'V' || $selectedMenuType == 'L')
							{								
?>
								<a href="<?php echo $videoPlayerURL;?>"><button type="button" class="btn btn-light">Watch Now</button></a>
								
<?php

							}
?>

<?php
							//------------------------------------For Donate per view--------------------------------------------------
							
							$watchBtnTxt = 'Ticket Code';
							$donateBtnTxt = 'DonatePerView';
							$signInTxt = "Entrar";
?>
<?php
							if ($selectedMenuType != 'E' && $selectedMenuType == 'D' && $isDonatePerView != 'Y' || ($streamExpiredOnInUnixTime != '' && $streamExpiredOnInUnixTime >= $cUnixTime && $selectedMenuType != 'E'))
							{
?>							

								<a href="<?php echo $videoPlayerURL;?>"><button type="button" class="btn btn btn-outline-light ">Watch Now</button></a>
<?php
							
							}
							else if ($isDonatePerView == 'Y' && $selectedMenuType == 'D')
							{ 
								$afterSignInRedirect2 = "donate-per-view.php?".$_SERVER["QUERY_STRING"];
								if (!empty($_SESSION['USER_DETAILS']['USER_CODE']) && $_SESSION['USER_DETAILS']['USER_CODE'] != '')
								{
?>
									<a href="<?php echo $afterSignInRedirect2?>"><button type="button" class="btn btn-light"><?php echo $donateBtnTxt?><span class="trade_inlinetxt">Doe para assistir</span></button></a>
									<a href="includes/popups/ticket_purchased.php" target="_blank" data-toggle="modal" data-target="#ticket_purchased"><button type="button" class="btn btn-outline-light"><?php echo $watchBtnTxt?><span class="trade_inlinetxt">Digite o código recebido por e-mail</span></button></a>
<?php
								}
								else if (empty($_SESSION['USER_DETAILS']['USER_CODE']))
								{									
?>
									<button type="button" onClick="setSignInRedirction('<?php echo $afterSignInRedirect2?>');" class="btn btn btn-light" data-toggle="modal" data-target="#signin_popup" ><?php echo $donateBtnTxt?><span class="trade_inlinetxt">Doe para assistir</span></button>
									<button type="button" class="btn btn-outline-light" style='display:none;'><a href="#" target="_blank" data-toggle="modal" data-target="#signin_popup"><?php echo $watchBtnTxt?><span class="trade_inlinetxt">Digite o código recebido por e-mail</span></button>
<?php
								
								}
							}
?>
<?php
							//------------------------------------For Donate per view Live Event--------------------------------------------------
							
							$watchBtnTxt = 'Ticket Code';
							$donateBtnTxt = 'DonatePerView';
?>
<?php
							//if ($selectedMenuType == 'E' && $isLiveEventBuyed != 'Y' || ($streamExpiredOnInUnixTime != '' && $streamExpiredOnInUnixTime >= $cUnixTime))
							if (!empty($_SESSION['USER_DETAILS']['USER_CODE']) && $liveEventStatus == 'E' && $selectedMenuType == 'E')
							{
								echo "<span style='color:red;'><b>O evento já foi finalizado.</span>";
							}
							else if ($selectedMenuType == 'E' && $isLiveEventBuyed == 'Y')
							{
?>							

								<a href="<?php echo $videoPlayerURL;?>"><button type="button" class="btn btn-outline-light">Watch Now</button></a>
<?php
							
							}
							else if ($selectedMenuType == 'E')
							{ 
								$afterSignInRedirect2 = "donate-per-view.php?".$_SERVER["QUERY_STRING"];
								if (!empty($_SESSION['USER_DETAILS']['USER_CODE']) && $_SESSION['USER_DETAILS']['USER_CODE'] != '')
								{
									$popupScriptName = 'ticket_purchased.php';
									$moduleId = '#ticket_purchased';
									if ($liveEventStatus == 'F')
									{
										$moduleId = "#ticket_alert_popup";
										$popupScriptName = 'alert-popup.php';
										
									}
?>
									<a href="<?php echo $afterSignInRedirect2?>"><button type="button" class="btn btn-light"><?php echo $donateBtnTxt?><span class="trade_inlinetxt">Doe para assistir</span></button></a>
									<a href="includes/popups/<?php echo $popupScriptName?>" target="_blank" data-toggle="modal" data-target="<?php echo $moduleId?>"><button type="button" class="btn btn-outline-light"><?php echo $watchBtnTxt?><span class="trade_inlinetxt">Digite o código recebido por e-mail</span></button></a>
<?php
								}
								else if (empty($_SESSION['USER_DETAILS']['USER_CODE']) && $selectedMenuType == 'E')
								{									
?>
									<button type="button" onClick="setSignInRedirction('<?php echo $afterSignInRedirect2?>');" class="btn btn-outline-light" data-toggle="modal" data-target="#signin_popup" ><?php echo $donateBtnTxt?><span class="trade_inlinetxt">Doe para assistir</span></button>
									<a href="#" target="_blank" data-toggle="modal" data-target="#signin_popup"><button type="button" class="btn btn-outline-light" style='display:none;'><?php echo $watchBtnTxt?><span class="trade_inlinetxt">Digite o código recebido por e-mail</span></button></a>
<?php
								
								}
							}
?>

<?php

							//if ($selectedMenuType != 'E')
							{
							
?>
								<a href="<?php echo HTTP_PATH.'?menuGuid='.$menuGuid?>"><button type="button" class="btn btn-outline-dark">Return to Guide</button></a>
<?php
							}
?>

							</div>
							</div>
					</div>
					<div class="col-md-12">
						<div class="movie_detail margin_top">
							
							<?php if (!empty($arrSelectedItemData['stream_description'])) { ?>
								<p><?php echo nl2br($arrSelectedItemData['stream_description']); ?></p>
							<?php } ?>

								<dl>
								<?php if (!empty($arrSelectedItemData['staring'])) { ?>
									<dt><span class="movie_iconlist">Artist:</span></dt>
									<dd><span class="movie_list_text"><?php echo $arrSelectedItemData['staring']; ?></span></dd>
								<?php } ?>
								</dl>
								<dl>
								<?php if (!empty($arrSelectedItemData['directed_by'])) { ?>
									<dt><span class="movie_iconlist">Directed By:</span></dt>
									<dd><span class="movie_list_text"><?php echo $arrSelectedItemData['directed_by']; ?></span></dd>
								<?php } ?>
								</dl>
								<dl>
								<?php if (!empty($arrSelectedItemData['produced_by'])) { ?>
									<dt><span class="movie_iconlist">Producer:</span></dt>
									<dd><span class="movie_list_text"><?php echo $arrSelectedItemData['produced_by']; ?></span></dd>
								<?php } ?>
								</dl>
								<dl>
								<?php if (!empty($arrSelectedItemData['written_by'])) { ?>
									<dt><span class="movie_iconlist">Written By:</span></dt>
									<dd><span class="movie_list_text"><?php echo $arrSelectedItemData['written_by']; ?></span></dd>
								<?php } ?>
								</dl>
								<dl>
								<?php if (!empty($arrSelectedItemData['genre'])) { ?>
									<dt><span class="movie_iconlist">Genre:</span></dt>
									<dd><span class="movie_list_text"><?php echo $arrSelectedItemData['genre']; ?></span></dd>
								<?php } ?>
								</dl>
					</div>		
				</div>
				<div class="col-md-12">
					<div class="movie_list_text_detail"><p></p></div>
				</div>
				</div>
		
			<!-- End of movie detail-->
<?php
			if ($selectedMenuType == 'V' || $selectedMenuType == 'D')
			{
?>
			<div class="line_draw"></div>
			<!-- Start of movie detail-->
				<div class="latest_video">
					<h3>Latest Videos</h3>
					<div class="row">
<?php
					foreach ($arrLatestItemsData as $arrLatestItemInfo)
					{
						$streamGuid = $arrLatestItemInfo['stream_guid'];
						///$streamGuid = $arrLatestItemInfo['stream_title']
?>
						<!-- Start of col 6-->
						<div class="col-sm-6 col-md-6 col-lg-3">
							<div class="card mb-4 shadow-sm">
								<a href="detail-page.php?menuGuid=<?php echo $menuGuid;?>&streamGuid=<?php echo $arrLatestItemInfo['stream_guid'];?>">
								<div class="card-img-top">
									<div class="card_img_box">
										<img class="card-img" src="<?php echo $arrLatestItemInfo['stream_poster'];?>">
										<span class="play_icon">
											<img src="images/video_icon.png" alt="play icon">
										</span>
									</div>
								</div>
								<div class="card-body card_panel_text">
									<p class="card-text"><?php echo $arrLatestItemInfo['stream_title'];?></p>
								</div>
								<div class="video_time">
									<p class="time_text"><?php echo printDuration($arrLatestItemInfo['stream_duration']);?></p>
								</div>
								</a>	
							</div>
						</div>
						<!-- End of col 6-->
<?php
					}
?>
					</div>
				</div>
<?php
			}
?>
			<!-- End of movie detail-->
				</div>
			</div>
		</div>
	</div>
	<!-- End of right container -->

<!-- Start of footer -->	
<?php 

include_once('includes/popups/alert-popup.php');
include_once('includes/popups/ticket-purchased.php');
include_once('includes/footer.php');
?>