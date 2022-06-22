<?php 
include_once('includes/header.php');
include_once('includes/left-navbar.php');
?>
<!-- Start of Page Content  -->
<div id="content">
<?php
include_once('includes/top-navbar.php');
?>

	<!-- Start of right container -->
	<div class="container-fluid">
		<div class="container_topgap">
			<div class="carousel_container">
<?php
	$selectedMenuGuid = $ARR_FEED_DATA['selectedMenuGuid'];
	$selectedMenuType = $ARR_FEED_DATA['selectedMenuType'];
	$selectedMenuName = $ARR_FEED_DATA['selectedMenuName'];
	$arrItemsInfo = $ARR_FEED_DATA['arrMenuSelectedItemData'];
	
	// Here, Get Featured Stream
	$arrItemsInfo4Featured = array();
	foreach ($arrItemsInfo as $arrInfo)
	{
		$isStreamFeatured = $arrInfo['is_stream_featured'];
		if ($isStreamFeatured == 'Y')
		{
			$arrItemsInfo4Featured[] = $arrInfo;
		}
	}

	if (!empty($arrItemsInfo4Featured))
	{
?>
		
		<!-- Start of carousel -->
		<div id="myCarousel" class="carousel slide" data-ride="carousel">

			<ol class="carousel-indicators">
<?php			
			for($i = 0; $i < count($arrItemsInfo4Featured); $i++)
			{
?>

				<li data-target="#myCarousel" data-slide-to="<?php echo $i;?>" <?php if ($i == 0) echo "class='active'";?>></li>
<?php
			}
?>

			</ol>
			<!-- Start of inner carousel -->
			<div class="carousel-inner">
<?php
			for($i = 0; $i < count($arrItemsInfo4Featured); $i++)
			{
?>			
				<div class="carousel-item <?php if ($i == 0) echo "active";?>">
					<a href="detail-page.php">
					<div class="container_img">
						<img src="<?php echo $arrItemsInfo4Featured[$i]['stream_poster']?>">
					</div>
					</a>
					<div class="carousel-caption text-center">
						<h4><a href="detail-page.php"><?php echo $selectedMenuName;?></a></h4>
					</div>
					
				</div>
<?php
			}
?>
			</div>
			<!-- End of inner carousel -->

			<!-- Start of previous icon -->
			<a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"><i class="material-icons sidebar_icon">chevron_left</i></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"><i class="material-icons sidebar_icon">chevron_right</i></span>
				<span class="sr-only">Next</span>
			</a>
			<!-- End of previous icon -->
		</div>
		<!-- End of carousel -->
<?php
	}
?>

		</div>
		<!-- Start of productbox -->
		<div class="row product_box">
			<!-- Start of card box 1 -->
<?php		
		
		if ($selectedMenuType == 'L')
		{
			$scriptName4Redirction = 'video-player.php';
		}
		else
		{
			$scriptName4Redirction = 'detail-page.php';
		}
		foreach ($arrItemsInfo as $arrItemInfo)
		{
			//print_R($arrItemInfo);
			//die;
?>
			<div class="col-sm-6 col-md-6 col-lg-3">
			  <div class="card mb-4 shadow-sm">
				<a href="<?php echo $scriptName4Redirction?>?menuGuid=<?php echo $selectedMenuGuid;?>&streamGuid=<?php echo $arrItemInfo['stream_guid'];?>">
				<div class="card-img-top">
					<div class="card_img_box">
						<img class="card-img" src="<?php echo $arrItemInfo['stream_poster']?>">
						<span class="play_icon">
							<img src="images/video_icon.png" alt="play icon">
						</span>
					</div>
				</div>
				<div class="card-body card_panel_text">
					<p class="card-text"><?php echo $arrItemInfo['stream_title']?></p>
				</div>
				</a>
			  </div>
			</div>
<?php
		}
?>
			<!-- End of card box 1 -->
	  </div>
	  <!-- End of productbox -->
	</div>
</div>
<!-- End of right container -->

<!-- Start of footer -->	
<?php 
include_once('includes/footer.php');
?>
<!-- End of footer -->