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
					<a href="detail-page.php<?php echo $qStrFeature?>">
					<div class="container_img">
						<img src="<?php echo $arrItemsInfo4Featured[$i]['stream_poster']?>">
					</div>
					</a>
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
			<div class="container-fluid subcategory_container my-3" >
			
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
				<div class="row subcategory_box">
					<h3 class="category_header"><?php echo $subcatTitle?></h3>
					<div id="recipeCarousel_<?php echo $subCatGuid ?>" class="carousel slide w-100" data-interval="false">
					<div class="carousel-inner w-100" role="listbox">
												
							<!-- Start of carousel item -->
<?php								
						
						$numOfItems = count($arrStreamsInfo);
						//$numOfItems = 3;
						for($i = 0; $i < $numOfItems; $i++)
						{
							$clsActive = '';
							if ($i == 0) $clsActive = 'active';
							// "<pre>";
							//print_r($arrStreamsInfo[$i]['stream_poster']);
							//die;
?>
							
							<div class="carousel-item row no-gutters <?php echo $clsActive?>">
<?php
							$innerLimit = 4;
							if ($numOfItems < $innerLimit) $innerLimit = $numOfItems;
							for ($j = 1; $j <= $innerLimit; $j++)
							{
								if (isset($arrStreamsInfo[$i]['stream_poster']))
								{
?>
							
								<div class="col-sm-3 col-md-3 col-lg-3 float-left">
									<div class="card mb-4 shadow-sm">
									<a href="<?php echo $scriptName4Redirction?>?menuGuid=<?php echo $selectedMenuGuid;?>&streamGuid=<?php echo $arrStreamsInfo[$i]['stream_guid'];?>&streamType=<?php echo $selectedMenuType;?>">
									<div class="card-img-top">
										<div class="card_img_box">
											<img class="card-img" src="<?php echo $arrStreamsInfo[$i]['stream_poster']?>">
											<span class="play_icon">
												<img src="images/video_icon.png" alt="play icon">
											</span>
										</div>
									</div>
									<div class="card-body card_panel_text">
										<p class="card-text"><?php echo $arrStreamsInfo[$i]['stream_title']?></p>
									</div>
									</a>
									</div>
								</div>
<?php
									$i++;
								}
							}
								
?>

							</div>
							
<?php
						}
?>
							<!-- End of carousel item -->							
						</div>
<?php
						if ($numOfItems > 4)
						{
?>
							<a class="carousel-control-prev left" href="#recipeCarousel_<?php echo $subCatGuid ?>" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"><i class="material-icons category_nav">chevron_left</i></span>
								<span class="sr-only">&nbsp;</span>
							</a>
							<a class="carousel-control-next right" href="#recipeCarousel_<?php echo $subCatGuid ?>" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"><i class="material-icons category_nav">chevron_right</i></span>
								<span class="sr-only">&nbsp;</span>
							</a>
<?php
						}
?>
					</div>
				</div>
<?php
			}
?>





				<!-- End of carousel slider -->			
			</div>
			<!-- End of sub category box -->

		</div>
		<!-- End of container top gap -->
	</div>
	<!-- End of right container -->
<?php
include_once('includes/footer.php');
?>