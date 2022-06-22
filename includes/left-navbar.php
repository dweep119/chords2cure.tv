<!-- Start of nav sidebar -->
<nav id="sidebar" class="sidebar_color">
	<!-- Start of sidebar header -->
	<div class="sidebar-header">
		<h4>Purspek</h4>
	</div>
	<!-- End of sidebar header -->

	<!-- Start of left sidebar -->
	<ul class="list-unstyled components">
<?php
	$arrMenuData = $ARR_FEED_DATA['arrMenuData'];
	$selectedMenuGuid = $ARR_FEED_DATA['selectedMenuGuid'];
	foreach ($arrMenuData as $arrMenuInfo)
	{

		//print_r($arrMenuData);
		$menuType = $arrMenuInfo['menu_type'];
		$menuGuid = $arrMenuInfo['menu_guid'];
		$menuName = $arrMenuInfo['menu_name'];
		$menuHerfLink = HTTP_PATH."/?menuGuid=".$menuGuid;
		
		if ($menuType == 'L')
		{			
?>
			<li <?php if ($selectedMenuGuid == $menuGuid) echo "class='active'"; ?>>
				<a href="video-player.php?streamType=L&menuGuid=<?php echo $menuGuid;?>&isByPassSrn=Y">
					<i class="material-icons mat_icons">tv</i> <span class="navbar_text"><?php echo $menuName;?></span>
				</a>
			</li>
<?php
		}
		else if ($menuType == 'V')
		{
?>
			<li <?php if ($selectedMenuGuid == $menuGuid) echo "class='active'"; ?>>
				<a href="<?php echo $menuHerfLink;?>">
				<i class="material-icons mat_icons">ondemand_video</i> <span class="navbar_text"><?php echo $menuName;?></span>
			</a>
		</li>
<?php
		}
		else if ($menuType == 'D')
		{
?>
			<li <?php if ($selectedMenuGuid == $menuGuid) echo "class='active'"; ?>>
				<a href="<?php echo $menuHerfLink;?>">
				<i class="material-icons mat_icons">shop</i> <span class="navbar_text"><?php echo $menuName;?></span><span class="nav_inline_text">DonatePerView</span>
			</a>
			</li>
<?php
		}
		else if ($menuType == 'E1')
		{
			//$menuHerfLink = "detail-page.php?menuGuid=".$menuGuid."&streamType=E";
?>
			<li <?php if ($selectedMenuGuid == $menuGuid) echo "class='active'"; ?>>
				<a href="<?php echo $menuHerfLink;?>">
				<i class="material-icons mat_icons">live_tv</i> <span class="navbar_text"><?php echo $menuName;?></span><span class="nav_inline_text">DonatePerView</span>
			</a>
		</li>
<?php
		}
	}
?>
		<li>
				<a href="https://www.chords2cure.org/share-your-voice" target="_blank">
				<i class="material-icons mat_icons">settings_voice</i> <span class="navbar_text">Share Your Voice</span>
			</a>
		</li>
		<li>
			<a href="https://www.chords2cure.org/c2c-merch" target="_blank">
				<i class="material-icons mat_icons">people</i> <span class="navbar_text">Merch & More</span>
			</a>
		</li>
		<li>
				<a href="https://secure.squarespace.com/checkout/donate?donatePageId=5e3c6cce3ee4c163990913c5&ss_cid=278af834-29ee-48f0-8b36-44b990ea93c9&ss_cvisit=1587913288328&ss_cvr=bfa8caa5-070f-4e72-b6b2-8441a73a5c05%7C1579729976894%7C1587839512000%7C1587913287512%7C56" target="_blank">
				<i class="material-icons mat_icons">archive</i> <span class="navbar_text">Donate</span>
			</a>
		</li>
		<li>
				<a href="https://www.chords2cure.org/contact" target="_blank">
				<i class="material-icons mat_icons">email</i> <span class="navbar_text">Contact</span>
			</a>
		</li>
		<li>
				<a href="https://www.chords2cure.org" target="_blank">
				<i class="material-icons mat_icons">language</i> <span class="navbar_text">Chords2Cure</span>
			</a>
		</li>
	</ul>
	<!-- End of left sidebar -->
</nav>
<!-- End of nav sidebar -->