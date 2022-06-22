<?php 
include_once('includes/header.php');
include_once('includes/left-navbar.php');
?>
<!-- Start of Page Content  -->
<div id="content">
<?php
include_once('includes/top-navbar.php');

$arrFormData['postAction'] = 'search';
$arrFormData['appId'] = APP_CODE;
$arrFormData['keyword'] = $SEARCH_KEYWORD;
$arrFormData['streamType'] = 'D';
//$arrFormData['maxShowStream'] = 1000;

$arrRes = sendRequestUsingCURL(0, SEARCH_PAGE_BASE_URL, $arrFormData);
$totalRcd = @$arrRes['search_result']['total_rcd'];
?>

	<!-- Start of right container -->
	<div class="container-fluid">
		<div class="container_topgap">			
			<!-- Start of movie detail-->
			<div class="col-md-12">
				<div class="container_spaces">
				<div class="latest_video">
					<h3>Search Result</h3>
					<div class="row product_box">
<?php
					if ($totalRcd > 0)
					{
						$arrItemsData = $arrRes['search_result']['streams'];
						foreach ($arrItemsData as $arrItemData)
						{
							$streamGuid = $arrItemData['stream_guid'];
							$menuGuid = $arrItemData['menu_guid'];
							$sURL = "detail-page.php?menuGuid=$menuGuid&streamGuid=".$arrItemData['stream_guid']."&streamType=".$arrItemData['stream_type'];
							if ($arrItemData['stream_type'] == 'L') $sURL = HTTP_PATH."?menuGuid=$menuGuid&streamGuid=".$arrItemData['stream_guid'];
?>
							<!-- Start of col 6-->
							<div class="col-sm-6 col-md-6 col-lg-3">
								<div class="card mb-4 shadow-sm">
									<a href="<?php echo $sURL;?>">
									<div class="card-img-top">
										<div class="card_img_box">
											<img class="card-img" src="<?php echo $arrItemData['stream_poster'];?>">
											<span class="play_icon">
												<img src="images/video_icon.png" alt="play icon">
											</span>
										</div>
									</div>
									<div class="card-body card_panel_text">
										<p class="card-text"><?php echo $arrItemData['stream_title'];?></p>
									</div>
									<div class="video_time">
										<p class="time_text"><?php echo printDuration($arrItemData['stream_duration']);?></p>
									</div>
									</a>	
								</div>
							</div>
							<!-- End of col 6-->
<?php
					
						}
					}
					else 
					{
?>
						<div class="no_recd_found">No Record Found</div>
<?php
					}
?>
					</div>
				</div>
				</div>
			</div>
			
		</div>
	</div>
	<!-- End of right container -->

<!-- Start of footer -->	
<?php 
include_once('includes/footer.php');
?>
<!-- End of footer -->