<?php
include_once('includes/header.php');
include_once('includes/left-navbar.php');
?>
<!-- Start of Page Content  -->
<div id="content">
<?php
include_once('includes/top-navbar.php');

$streamType = $SELECTED_MENU_TYPE;

$menuGuid = getValPostORGet('menuGuid', 'B');
$streamGuid = getValPostORGet('streamGuid', 'B');
$isByPassSrn = getValPostORGet('isByPassSrn', 'B');

$userCode = md5('test');
// If Live Event Request There then get stream ID
$isAutoPlayStr = '';
if ($isByPassSrn == 'Y' && $streamType == 'L')
{
	//$streamGuid = $ARR_FEED_DATA['arrMenuSelectedItemData'][0]['stream_guid'];
	$streamGuid = $ARR_FEED_DATA['arrMenuSelectedItemData'][0]['streams'][0]['stream_guid'];
	$isAutoPlayStr = "mute: true,";
}

if (!empty($_SESSION['USER_DETAILS']['USER_CODE'])) $userCode = $_SESSION['USER_DETAILS']['USER_CODE']; 

$detailPageFeedURL = DETAIL_PAGE_BASE_URL.'/'.$streamGuid.'/'.$menuGuid.'/'.$userCode;

$arrRes = sendRequestUsingCURL(0, $detailPageFeedURL);

$ARR_DETAIL_PG_FEED_DATA = parseDetailPgFeedArrData(0, $arrRes);
$arrLatestItemsData = $ARR_DETAIL_PG_FEED_DATA['arrLatestItemsData'];
$arrSelectedItemData = $ARR_DETAIL_PG_FEED_DATA['arrSelectedItemData'];
$streamTrailerUrl = trim($arrSelectedItemData['stream_trailerUrl']);
$streamURL = trim($arrSelectedItemData['stream_url']);

// Here get Menu Info
$selectedMenuName = trim($ARR_DETAIL_PG_FEED_DATA['selectedMenuName']);
$selectedMenuGuid = trim($ARR_DETAIL_PG_FEED_DATA['selectedMenuGuid']);
$selectedMenuType = trim($ARR_DETAIL_PG_FEED_DATA['selectedMenuType']);

$isDonatePerView = $arrSelectedItemData['is_donate_per_view'];
$streamExpiredOnInUnixTime = $arrSelectedItemData['stream_expired_on_in_unix_time'];
$cUnixTime = getCurrentUnixtime();

if ($streamType == 'E' || ($streamType == 'D' && $isDonatePerView == 'Y')) isSessionExpired();

$detailPageURL = "detail-page.php?menuGuid=".$selectedMenuGuid."&streamGuid=".$streamGuid."&streamType=".$selectedMenuType;
?>

<script type="text/javascript">
// Assigned php varible to js 
var selectedMenuType = "<?php echo $selectedMenuType ?>"; 
var streamExpiredOnInUnixTime = "<?php echo $streamExpiredOnInUnixTime ?>"; 
var detailPageURL = "<?php echo $detailPageURL ?>"; 

</script>

<?php
if ($selectedMenuType == 'D' && $isDonatePerView == 'Y' && ($streamExpiredOnInUnixTime == '' || $streamExpiredOnInUnixTime <= $cUnixTime))
{	
	//$homePageURL = "detail-page.php?menuGuid=".$selectedMenuGuid."&streamGuid=".$streamGuid."&streamType=".$selectedMenuType;
	headerRedirect($detailPageURL);
}

// Here for Live Event
$isLiveEventBuyed = $arrSelectedItemData['is_live_event_buyed'];
$stUnixTime = unixtime64($arrSelectedItemData['stream_event_st_date_time_on_utc']);
$enUnixTime = unixtime64($arrSelectedItemData['stream_event_end_date_time_on_utc']);
$liveEventStatus = getEventStaus($stUnixTime, $enUnixTime, $isLiveEventBuyed);

if (!empty($_SESSION['USER_DETAILS']['USER_CODE']) && $liveEventStatus == 'E' && $selectedMenuType == 'E')
{
	
	headerRedirect($detailPageURL);
}
?>
    <script type="text/javascript"
      src="https://cdn.jsdelivr.net/npm/clappr@latest/dist/clappr.min.js">
  </script>
<!-- Start of right container -->
<div class="container-fluid">
	<div class="container_topgap">
		<!-- Start of movie detail-->
		<a href="#" class="back_fullbox" style="display:none;">
			<button class="btn btn-outline-light btn_light_hover">
			<i class="material-icons back_icon">keyboard_arrow_left</i>Back</button>
		</a>
		<div class="clearfix"></div>
		<div class="container colgap_top">
			<div class="col-md-12">
				<div id="player"></div>
			</div>
		</div>
		<!-- End of movie detail-->
	</div>
</div>
<!-- End of right container -->
<script>
$( document ).ready(function() {
	var vidURL = "<?php echo $streamURL?>"; 
	var posterURL = "<?php echo $arrSelectedItemData['stream_thumbnail'];?>"; 

	var playerElement = document.getElementById("player");

	var player = new Clappr.Player({
		source: vidURL,
		poster: posterURL,	
		flushLiveURLCache: true,
		autoPlay: true,
		<?php echo $isAutoPlayStr?>	
		maxBufferLength:5,
		playback: {
			playInline: true,
			recycleVideo: true,
		},
		events: {
			onPlay: videoPlaying,
			onPause: videoPaused,		
			onEnded: function() {
				console.log("Ended...");
			},
			onSeek: function() {
				console.log("Seeking...");
			},
			onTimeUpdate: function(obj) {
				//obj.current 
				//obj.total
				console.log(obj);
			},
		}
	});

	player.attachTo(playerElement);
	//pause() 
	player.play(); 
});

	function videoPlaying(obj) {
		//console.log(obj);
		console.log("Playing...");
	}

	function videoPaused() {
		console.log("Paused...");
	}



	// Code to add restriction on video
	if (selectedMenuType == 'D') {
		var params = {
			"streamExpiredOnInUnixTime": streamExpiredOnInUnixTime
		}

		var interval = setInterval(runFunction, 5000, params);
	}

	function runFunction(params) {
		var currentTime = + new Date();
		currentTime = currentTime / 1000;

		if (currentTime >= params.streamExpiredOnInUnixTime) {
			// Stop the interval
			clearInterval(interval);
			
			player.pause();
			$('#video_expire_popup').modal('show');	
		} 
	}	

	$(document).on("click", "button.hide-expire-video" , function() {
		window.location.href = detailPageURL;
	});

</script>
<!-- Start of footer -->	
<?php 
include_once('includes/footer.php');
?>
<!-- End of footer -->