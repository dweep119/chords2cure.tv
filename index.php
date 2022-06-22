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
	$arrItemsInfo4Featured = $ARR_FEED_DATA['arrMenuFeaturedData'];

	if ($selectedMenuType == 'L')
	{	
		//$homePageURL = "detail-page.php?menuGuid=".$selectedMenuGuid."&streamGuid=".$streamGuid."&streamType=".$selectedMenuType;
		headerRedirect("video-player.php?streamType=L&menuGuid=$selectedMenuGuid&isByPassSrn=Y");
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
				$qStrFeature = "?menuGuid=".$selectedMenuGuid."&streamGuid=".$arrItemsInfo4Featured[$i]['stream_guid']."&streamType=".$selectedMenuType;
	
?>			
				<div class="carousel-item <?php if ($i == 0) echo "active";?>">
					
					<div class="container_img">
						<a href="detail-page.php<?php echo $qStrFeature?>">
						<img src="<?php echo $arrItemsInfo4Featured[$i]['stream_poster']?>">
						</a>
					</div>
					
					<div class="carousel-caption text-center">
						<h4><?php echo $selectedMenuName;?></h4>
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
//
?>

		</div>
			
			<!-- Start of sub category box -->
			<div class="container-fluid subcategory_container" >
			
				<!-- Start of carousel slider -->
<?php
			if ($selectedMenuType == 'L')
			{
				$scriptName4Redirction = 'video-player.php';
			}
			else
			{
				$scriptName4Redirction = 'detail-page.php';
			}

			foreach ($arrItemsInfo as $arrItemNCatInfo)
			{
				$subCatGuid = $arrItemNCatInfo['subcat_guid'];
				$subcatTitle = $arrItemNCatInfo['subcat_title'];
				$arrStreamsInfo = $arrItemNCatInfo['streams'];
?>
	
					
					<!-- Start of container-->
					<div class="container">
						<h3 class="category_header"><?php echo $subcatTitle?></h3>
						<div class="slider responsive">
				  			<!-- Start of item 1-->							
<?php				
						$numOfItems = count($arrStreamsInfo);						
						for($i = 0; $i < $numOfItems; $i++)
						{
?>
							<div class="item">
								<a href="<?php echo $scriptName4Redirction?>?menuGuid=<?php echo $selectedMenuGuid;?>&streamGuid=<?php echo $arrStreamsInfo[$i]['stream_guid'];?>&streamType=<?php echo $selectedMenuType;?>">
									<div class="cardimg_container">
									<div class="cardimg_box">
										<img class="card-img" src="<?php echo $arrStreamsInfo[$i]['stream_poster']?>">
									</div>
									<div class="card_playicon">
											<img src="images/video_icon.png" alt="play icon">
									</div>
									<div class="cardimg_text">
										<p class="cardimg_widetext"><?php echo $arrStreamsInfo[$i]['stream_title']?></p>
									</div>
								</div>
								</a>
							</div>
<?php
						}
?>
							<!-- End of item 1-->						
							
			   			</div>
    				</div>
<?php
			}
?>
         			<!-- End of container-->
					
			</div>
			<!-- End of sub category box -->
		</div>
		<!-- End of container top gap -->
ssssssss	</div>
	<!-- End of right container -->
<?php
include_once('includes/footer.php');
?>