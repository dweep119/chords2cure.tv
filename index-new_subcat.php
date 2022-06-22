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
				$qStrFeature = "?menuGuid=".$selectedMenuGuid."&streamGuid=".$arrItemsInfo4Featured['stream_guid']."&streamType=".$selectedMenuType;
	
?>			
				<div class="carousel-item <?php if ($i == 0) echo "active";?>">
					<a href="detail-page.php<?php echo $qStrFeature?>">
					<div class="container_img">
						<img src="<?php echo $arrItemsInfo4Featured[$i]['stream_poster']?>">
					</div>
					</a>
					<div class="carousel-caption text-center">
						<h4><a href="#"><?php echo $selectedMenuName;?></a></h4>
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
			
			<!-- Start of sub category box -->
			<div class="container-fluid subcategory_container my-3" >
			
				<!-- Start of carousel slider -->
				<div class="row subcategory_box">
					<h3 class="category_header">Popular Movies</h3>
					<div id="recipeCarousel" class="carousel slide w-100" data-interval="false">
						<div class="carousel-inner w-100" role="listbox">
							
							<!-- Start of carousel item -->
							<div class="carousel-item row no-gutters active">
								
								<div class="col-sm-3 col-md-3 col-lg-3 float-left">
									<div class="card mb-4 shadow-sm">
									<a href="detail-page.php?menuGuid=6edf823cd7d23e44341776ec3bbeba61&amp;streamGuid=57b301339325b08c6bfa9dcf0ffed55f">
									<div class="card-img-top">
										<div class="card_img_box">
											<img class="card-img" src="https://swigmanager.com/uploads/stream_images/1578069503_3a43584_Purspek_314x177.png">
											<span class="play_icon">
												<img src="images/video_icon.png" alt="play icon">
											</span>
										</div>
									</div>
									<div class="card-body card_panel_text">
										<p class="card-text">Purspek</p>
									</div>
									</a>
									</div>
								</div>
								
								<div class="col-sm-3 col-md-3 col-lg-3 float-left">
									<div class="card mb-4 shadow-sm">
									<a href="detail-page.php?menuGuid=6edf823cd7d23e44341776ec3bbeba61&amp;streamGuid=57b301339325b08c6bfa9dcf0ffed55f">
									<div class="card-img-top">
										<div class="card_img_box">
											<img class="card-img" src="https://swigmanager.com/uploads/stream_images/1578069503_3a43584_Purspek_314x177.png">
											<span class="play_icon">
												<img src="images/video_icon.png" alt="play icon">
											</span>
										</div>
									</div>
									<div class="card-body card_panel_text">
										<p class="card-text">Purspek</p>
									</div>
									</a>
									</div>
								</div>
								
								<div class="col-sm-3 col-md-3 col-lg-3 float-left">
									<div class="card mb-4 shadow-sm">
									<a href="detail-page.php?menuGuid=6edf823cd7d23e44341776ec3bbeba61&amp;streamGuid=57b301339325b08c6bfa9dcf0ffed55f">
									<div class="card-img-top">
										<div class="card_img_box">
											<img class="card-img" src="https://swigmanager.com/uploads/stream_images/1578069503_3a43584_Purspek_314x177.png">
											<span class="play_icon">
												<img src="images/video_icon.png" alt="play icon">
											</span>
										</div>
									</div>
									<div class="card-body card_panel_text">
										<p class="card-text">Purspek</p>
									</div>
									</a>
									</div>
								</div>
								
								<div class="col-sm-3 col-md-3 col-lg-3 float-left">
									<div class="card mb-4 shadow-sm">
									<a href="detail-page.php?menuGuid=6edf823cd7d23e44341776ec3bbeba61&amp;streamGuid=57b301339325b08c6bfa9dcf0ffed55f">
									<div class="card-img-top">
										<div class="card_img_box">
											<img class="card-img" src="https://swigmanager.com/uploads/stream_images/1578069503_3a43584_Purspek_314x177.png">
											<span class="play_icon">
												<img src="images/video_icon.png" alt="play icon">
											</span>
										</div>
									</div>
									<div class="card-body card_panel_text">
										<p class="card-text">Purspek</p>
									</div>
									</a>
									</div>
								</div>

							</div>
							<!-- End of carousel item -->
							
							<!-- Start of carousel item -->
							<div class="carousel-item row no-gutters">
								<div class="col-sm-3 col-md-3 col-lg-3 float-left">
									<div class="card mb-4 shadow-sm">
										<a href="detail-page.php?	menuGuid=6edf823cd7d23e44341776ec3bbeba61&amp;streamGuid=661464bed39c48c6cbeeb0c7c0c897d9">
											<div class="card-img-top">
												<div class="card_img_box">
													<img class="card-img" src="https://swigmanager.com/uploads/stream_images/1578065248_1eaf7aa_Salt_and_Purpose_314x177.png">
													<span class="play_icon">
														<img src="images/video_icon.png" alt="play icon">
													</span>
												</div>
											</div>
											<div class="card-body card_panel_text">
												<p class="card-text">Salt &amp; Purpose</p>
											</div>
										</a>
									</div>
								</div>
								
								<div class="col-sm-3 col-md-3 col-lg-3 float-left">
									<div class="card mb-4 shadow-sm">
										<a href="detail-page.php?	menuGuid=6edf823cd7d23e44341776ec3bbeba61&amp;streamGuid=661464bed39c48c6cbeeb0c7c0c897d9">
											<div class="card-img-top">
												<div class="card_img_box">
													<img class="card-img" src="https://swigmanager.com/uploads/stream_images/1578065248_1eaf7aa_Salt_and_Purpose_314x177.png">
													<span class="play_icon">
														<img src="images/video_icon.png" alt="play icon">
													</span>
												</div>
											</div>
											<div class="card-body card_panel_text">
												<p class="card-text">Salt &amp; Purpose</p>
											</div>
										</a>
									</div>
								</div>
								
								<div class="col-sm-3 col-md-3 col-lg-3 float-left">
									<div class="card mb-4 shadow-sm">
										<a href="detail-page.php?	menuGuid=6edf823cd7d23e44341776ec3bbeba61&amp;streamGuid=661464bed39c48c6cbeeb0c7c0c897d9">
											<div class="card-img-top">
												<div class="card_img_box">
													<img class="card-img" src="https://swigmanager.com/uploads/stream_images/1578065248_1eaf7aa_Salt_and_Purpose_314x177.png">
													<span class="play_icon">
														<img src="images/video_icon.png" alt="play icon">
													</span>
												</div>
											</div>
											<div class="card-body card_panel_text">
												<p class="card-text">Salt &amp; Purpose</p>
											</div>
										</a>
									</div>
								</div>
								
								<div class="col-sm-3 col-md-3 col-lg-3 float-left">
									<div class="card mb-4 shadow-sm">
										<a href="detail-page.php?	menuGuid=6edf823cd7d23e44341776ec3bbeba61&amp;streamGuid=661464bed39c48c6cbeeb0c7c0c897d9">
											<div class="card-img-top">
												<div class="card_img_box">
													<img class="card-img" src="https://swigmanager.com/uploads/stream_images/1578065248_1eaf7aa_Salt_and_Purpose_314x177.png">
													<span class="play_icon">
														<img src="images/video_icon.png" alt="play icon">
													</span>
												</div>
											</div>
											<div class="card-body card_panel_text">
												<p class="card-text">Salt &amp; Purpose</p>
											</div>
										</a>
									</div>
								</div>
							
						</div>
							<!-- End of carousel item -->
							
							<!-- Start of carousel item -->
							<div class="carousel-item row no-gutters">
								
								<div class="col-sm-3 col-md-3 col-lg-3 float-left">
									<div class="card mb-4 shadow-sm">
									<a href="detail-page.php?menuGuid=6edf823cd7d23e44341776ec3bbeba61&amp;streamGuid=57b301339325b08c6bfa9dcf0ffed55f">
									<div class="card-img-top">
										<div class="card_img_box">
											<img class="card-img" src="https://swigmanager.com/uploads/stream_images/1578069503_3a43584_Purspek_314x177.png">
											<span class="play_icon">
												<img src="images/video_icon.png" alt="play icon">
											</span>
										</div>
									</div>
									<div class="card-body card_panel_text">
										<p class="card-text">Purspek</p>
									</div>
									</a>
									</div>
								</div>
								
								<div class="col-sm-3 col-md-3 col-lg-3 float-left">
									<div class="card mb-4 shadow-sm">
									<a href="detail-page.php?menuGuid=6edf823cd7d23e44341776ec3bbeba61&amp;streamGuid=57b301339325b08c6bfa9dcf0ffed55f">
									<div class="card-img-top">
										<div class="card_img_box">
											<img class="card-img" src="https://swigmanager.com/uploads/stream_images/1578069503_3a43584_Purspek_314x177.png">
											<span class="play_icon">
												<img src="images/video_icon.png" alt="play icon">
											</span>
										</div>
									</div>
									<div class="card-body card_panel_text">
										<p class="card-text">Purspek</p>
									</div>
									</a>
									</div>
								</div>
								
								<div class="col-sm-3 col-md-3 col-lg-3 float-left">
									<div class="card mb-4 shadow-sm">
									<a href="detail-page.php?menuGuid=6edf823cd7d23e44341776ec3bbeba61&amp;streamGuid=57b301339325b08c6bfa9dcf0ffed55f">
									<div class="card-img-top">
										<div class="card_img_box">
											<img class="card-img" src="https://swigmanager.com/uploads/stream_images/1578069503_3a43584_Purspek_314x177.png">
											<span class="play_icon">
												<img src="images/video_icon.png" alt="play icon">
											</span>
										</div>
									</div>
									<div class="card-body card_panel_text">
										<p class="card-text">Purspek</p>
									</div>
									</a>
									</div>
								</div>
								
								<div class="col-sm-3 col-md-3 col-lg-3 float-left">
									<div class="card mb-4 shadow-sm">
									<a href="detail-page.php?menuGuid=6edf823cd7d23e44341776ec3bbeba61&amp;streamGuid=57b301339325b08c6bfa9dcf0ffed55f">
									<div class="card-img-top">
										<div class="card_img_box">
											<img class="card-img" src="https://swigmanager.com/uploads/stream_images/1578069503_3a43584_Purspek_314x177.png">
											<span class="play_icon">
												<img src="images/video_icon.png" alt="play icon">
											</span>
										</div>
									</div>
									<div class="card-body card_panel_text">
										<p class="card-text">Purspek</p>
									</div>
									</a>
									</div>
								</div>

							</div>
							<!-- End of carousel item -->
							
							
						</div>
						<a class="carousel-control-prev left" href="#recipeCarousel" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"><i class="material-icons category_nav">chevron_left</i></span>
							<span class="sr-only">&nbsp;</span>
						</a>
						<a class="carousel-control-next right" href="#recipeCarousel" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"><i class="material-icons category_nav">chevron_right</i></span>
							<span class="sr-only">&nbsp;</span>
						</a>
					</div>
				</div>
				<!-- End of carousel slider -->
				
				<!-- Start of carousel slider -->
				<div class="row subcategory_box">
					<h3 class="category_header">Live News</h3>
					<div id="recipeCarousel1" class="carousel slide w-100" data-interval="false">
						<div class="carousel-inner w-100" role="listbox">
							
							<!-- Start of carousel item -->
							<div class="carousel-item row no-gutters active">
								
								<div class="col-sm-3 col-md-3 col-lg-3 float-left">
									<div class="card mb-4 shadow-sm">
									<a href="detail-page.php?menuGuid=6edf823cd7d23e44341776ec3bbeba61&amp;streamGuid=57b301339325b08c6bfa9dcf0ffed55f">
									<div class="card-img-top">
										<div class="card_img_box">
											<img class="card-img" src="https://swigmanager.com/uploads/stream_images/1578069503_3a43584_Purspek_314x177.png">
											<span class="play_icon">
												<img src="images/video_icon.png" alt="play icon">
											</span>
										</div>
									</div>
									<div class="card-body card_panel_text">
										<p class="card-text">Purspek</p>
									</div>
									</a>
									</div>
								</div>
								
								<div class="col-sm-3 col-md-3 col-lg-3 float-left">
									<div class="card mb-4 shadow-sm">
									<a href="detail-page.php?menuGuid=6edf823cd7d23e44341776ec3bbeba61&amp;streamGuid=57b301339325b08c6bfa9dcf0ffed55f">
									<div class="card-img-top">
										<div class="card_img_box">
											<img class="card-img" src="https://swigmanager.com/uploads/stream_images/1578069503_3a43584_Purspek_314x177.png">
											<span class="play_icon">
												<img src="images/video_icon.png" alt="play icon">
											</span>
										</div>
									</div>
									<div class="card-body card_panel_text">
										<p class="card-text">Purspek</p>
									</div>
									</a>
									</div>
								</div>
								
								<div class="col-sm-3 col-md-3 col-lg-3 float-left">
									<div class="card mb-4 shadow-sm">
									<a href="detail-page.php?menuGuid=6edf823cd7d23e44341776ec3bbeba61&amp;streamGuid=57b301339325b08c6bfa9dcf0ffed55f">
									<div class="card-img-top">
										<div class="card_img_box">
											<img class="card-img" src="https://swigmanager.com/uploads/stream_images/1578069503_3a43584_Purspek_314x177.png">
											<span class="play_icon">
												<img src="images/video_icon.png" alt="play icon">
											</span>
										</div>
									</div>
									<div class="card-body card_panel_text">
										<p class="card-text">Purspek</p>
									</div>
									</a>
									</div>
								</div>
								
								<div class="col-sm-3 col-md-3 col-lg-3 float-left">
									<div class="card mb-4 shadow-sm">
									<a href="detail-page.php?menuGuid=6edf823cd7d23e44341776ec3bbeba61&amp;streamGuid=57b301339325b08c6bfa9dcf0ffed55f">
									<div class="card-img-top">
										<div class="card_img_box">
											<img class="card-img" src="https://swigmanager.com/uploads/stream_images/1578069503_3a43584_Purspek_314x177.png">
											<span class="play_icon">
												<img src="images/video_icon.png" alt="play icon">
											</span>
										</div>
									</div>
									<div class="card-body card_panel_text">
										<p class="card-text">Purspek</p>
									</div>
									</a>
									</div>
								</div>

							</div>
							<!-- End of carousel item -->
							
							<!-- Start of carousel item -->
							<div class="carousel-item row no-gutters">
								<div class="col-sm-6 col-md-6 col-lg-3 float-left">
									<div class="card mb-4 shadow-sm">
										<a href="detail-page.php?	menuGuid=6edf823cd7d23e44341776ec3bbeba61&amp;streamGuid=661464bed39c48c6cbeeb0c7c0c897d9">
											<div class="card-img-top">
												<div class="card_img_box">
													<img class="card-img" src="https://swigmanager.com/uploads/stream_images/1578065248_1eaf7aa_Salt_and_Purpose_314x177.png">
													<span class="play_icon">
														<img src="images/video_icon.png" alt="play icon">
													</span>
												</div>
											</div>
											<div class="card-body card_panel_text">
												<p class="card-text">Salt &amp; Purpose</p>
											</div>
										</a>
									</div>
								</div>
								
								<div class="col-sm-6 col-md-6 col-lg-3 float-left">
									<div class="card mb-4 shadow-sm">
										<a href="detail-page.php?	menuGuid=6edf823cd7d23e44341776ec3bbeba61&amp;streamGuid=661464bed39c48c6cbeeb0c7c0c897d9">
											<div class="card-img-top">
												<div class="card_img_box">
													<img class="card-img" src="https://swigmanager.com/uploads/stream_images/1578065248_1eaf7aa_Salt_and_Purpose_314x177.png">
													<span class="play_icon">
														<img src="images/video_icon.png" alt="play icon">
													</span>
												</div>
											</div>
											<div class="card-body card_panel_text">
												<p class="card-text">Salt &amp; Purpose</p>
											</div>
										</a>
									</div>
								</div>
								
								<div class="col-sm-6 col-md-6 col-lg-3 float-left">
									<div class="card mb-4 shadow-sm">
										<a href="detail-page.php?	menuGuid=6edf823cd7d23e44341776ec3bbeba61&amp;streamGuid=661464bed39c48c6cbeeb0c7c0c897d9">
											<div class="card-img-top">
												<div class="card_img_box">
													<img class="card-img" src="https://swigmanager.com/uploads/stream_images/1578065248_1eaf7aa_Salt_and_Purpose_314x177.png">
													<span class="play_icon">
														<img src="images/video_icon.png" alt="play icon">
													</span>
												</div>
											</div>
											<div class="card-body card_panel_text">
												<p class="card-text">Salt &amp; Purpose</p>
											</div>
										</a>
									</div>
								</div>
								
								<div class="col-sm-6 col-md-6 col-lg-3 float-left">
									<div class="card mb-4 shadow-sm">
										<a href="detail-page.php?	menuGuid=6edf823cd7d23e44341776ec3bbeba61&amp;streamGuid=661464bed39c48c6cbeeb0c7c0c897d9">
											<div class="card-img-top">
												<div class="card_img_box">
													<img class="card-img" src="https://swigmanager.com/uploads/stream_images/1578065248_1eaf7aa_Salt_and_Purpose_314x177.png">
													<span class="play_icon">
														<img src="images/video_icon.png" alt="play icon">
													</span>
												</div>
											</div>
											<div class="card-body card_panel_text">
												<p class="card-text">Salt &amp; Purpose</p>
											</div>
										</a>
									</div>
								</div>
							
						</div>
							<!-- End of carousel item -->
							
							<!-- Start of carousel item -->
							<div class="carousel-item row no-gutters">
								
								<div class="col-sm-6 col-md-6 col-lg-3 float-left">
									<div class="card mb-4 shadow-sm">
									<a href="detail-page.php?menuGuid=6edf823cd7d23e44341776ec3bbeba61&amp;streamGuid=57b301339325b08c6bfa9dcf0ffed55f">
									<div class="card-img-top">
										<div class="card_img_box">
											<img class="card-img" src="https://swigmanager.com/uploads/stream_images/1578069503_3a43584_Purspek_314x177.png">
											<span class="play_icon">
												<img src="images/video_icon.png" alt="play icon">
											</span>
										</div>
									</div>
									<div class="card-body card_panel_text">
										<p class="card-text">Purspek</p>
									</div>
									</a>
									</div>
								</div>
								
								<div class="col-sm-6 col-md-6 col-lg-3 float-left">
									<div class="card mb-4 shadow-sm">
									<a href="detail-page.php?menuGuid=6edf823cd7d23e44341776ec3bbeba61&amp;streamGuid=57b301339325b08c6bfa9dcf0ffed55f">
									<div class="card-img-top">
										<div class="card_img_box">
											<img class="card-img" src="https://swigmanager.com/uploads/stream_images/1578069503_3a43584_Purspek_314x177.png">
											<span class="play_icon">
												<img src="images/video_icon.png" alt="play icon">
											</span>
										</div>
									</div>
									<div class="card-body card_panel_text">
										<p class="card-text">Purspek</p>
									</div>
									</a>
									</div>
								</div>
								
								<div class="col-sm-6 col-md-6 col-lg-3 float-left">
									<div class="card mb-4 shadow-sm">
									<a href="detail-page.php?menuGuid=6edf823cd7d23e44341776ec3bbeba61&amp;streamGuid=57b301339325b08c6bfa9dcf0ffed55f">
									<div class="card-img-top">
										<div class="card_img_box">
											<img class="card-img" src="https://swigmanager.com/uploads/stream_images/1578069503_3a43584_Purspek_314x177.png">
											<span class="play_icon">
												<img src="images/video_icon.png" alt="play icon">
											</span>
										</div>
									</div>
									<div class="card-body card_panel_text">
										<p class="card-text">Purspek</p>
									</div>
									</a>
									</div>
								</div>
								
								<div class="col-sm-6 col-md-6 col-lg-3 float-left">
									<div class="card mb-4 shadow-sm">
									<a href="detail-page.php?menuGuid=6edf823cd7d23e44341776ec3bbeba61&amp;streamGuid=57b301339325b08c6bfa9dcf0ffed55f">
									<div class="card-img-top">
										<div class="card_img_box">
											<img class="card-img" src="https://swigmanager.com/uploads/stream_images/1578069503_3a43584_Purspek_314x177.png">
											<span class="play_icon">
												<img src="images/video_icon.png" alt="play icon">
											</span>
										</div>
									</div>
									<div class="card-body card_panel_text">
										<p class="card-text">Purspek</p>
									</div>
									</a>
									</div>
								</div>

							</div>
							<!-- End of carousel item -->
							
							
						</div>
						<a class="carousel-control-prev left" href="#recipeCarousel1" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"><i class="material-icons category_nav">chevron_left</i></span>
							<span class="sr-only">&nbsp;</span>
						</a>
						<a class="carousel-control-next right" href="#recipeCarousel1" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"><i class="material-icons category_nav">chevron_right</i></span>
							<span class="sr-only">&nbsp;</span>
						</a>
					</div>
				</div>
				<!-- End of carousel slider -->
			
			</div>
			<!-- End of sub category box -->
		</div>
		<!-- End of container top gap -->
	</div>
	<!-- End of right container -->

	<!-- Start of footer -->	
	<div class="footer_box">
		<footer class="container-fluid">
				<p class="text-center footer_text">Swig Media &copy; All rights reserved.</p>
		</footer>
	</div>
	<!-- End of footer -->
	
	<!-- Start loader -->
	<div class="loader_background">
		<div class="loader_box">
			<div class="loader"></div>
		</div>
	</div>
	<!-- End loader -->

	</div>
	<!-- End of Page Content  -->
</div>
	
<!-- End of wrapper -->


<!-- End Sign up Popup Modal -->
<!-- Start of jquery -->
<script src="js/jquery-3.2.1.min.js"></script>
<!-- Popper.JS -->
<!-- Bootstrap JS -->
<script src="js/bootstrap.min.js"></script>

<script src="js/jquery.min.js"></script>
<script src="js/common/form-validation.js"></script>
<script src="js/common/common.js"></script>


	

<script type="text/javascript">
$(document).ready(function () {
	$('#sidebarCollapse').on('click', function () {
		$('#sidebar').toggleClass('active');
		$('#content').toggleClass('active');
		$('.navbar-light').toggleClass('active');
	});
});
/** Script for poup modal outside **/
$(".modal").modal({
	show: false,
	backdrop: 'static'
});
/** Start of profile setting **/
$('#profile_setting').click(function(){
	$('.collapse').hide();
	$('#profile_setting_box').show();
	$('.user_profile_box').find('.btn_box').removeClass('active');
	$(this).find('.btn_box').addClass('active');
});
$('#change_password').click(function(){
	$('.collapse').hide();
	$('#change_password_box').show();
	$('.user_profile_box').find('.btn_box').removeClass('active');
	$(this).find('.btn_box').addClass('active');
});	
/** Hide modal popup if open 
$('.forget_popup a').click(function() {
  $('#signin_popup').modal('hide');
});
$('.forget_text a').click(function() {
  $('#signup_popup').modal('hide');
});	**/
</script>

<script>

$("#recipeCarousel1").carousel({
  interval: false,
  wrap: false
});


$(document).ready(function(){
  // When strating hide prev arrow
 $('#recipeCarousel1').find('.carousel-control-prev').hide();
});



$('#recipeCarousel1').on('slide.bs.carousel', function (e) {

  var slidingItemsAsIndex = $('.carousel-item').length - 1;

  // If last item hide next arrow
  if($(e.relatedTarget).index() == slidingItemsAsIndex ){
      $('.carousel-control-next').hide();
  }
  else{
      $('.carousel-control-next').show();
  }

  // If first item hide prev arrow
  if($(e.relatedTarget).index() == 0){
      $('.carousel-control-prev').hide();
  }
  else{
      $('.carousel-control-prev').show();
  }

})
</script>
</body>

</html><!-- End of footer -->