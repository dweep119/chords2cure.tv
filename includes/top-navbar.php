<!-- Start of navbar -->
<nav class="navbar navbar-expand-lg navbar-light navbar_color">
	<div class="container-fluid">
		<button type="button" id="sidebarCollapse" class="btn btn-view">
			<i class="material-icons mats_icons menus_icon">menu</i>
			<i class="material-icons mats_icons closes_icon">close</i>
		</button>
		<div class="page_logo">
			<a href="./"><img src="images/logo.png" alt="logo"></a>
		</div>
		<button class="btn btn-view d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<i class="material-icons mats_icons person_icon">person</i>
		</button>
<?php
		$SEARCH_KEYWORD = getValPostORGet('searchKeyword', 'B');
?>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="nav navbar-nav ml-auto navbar_box">
				<!--li class="navbarleft">
					<a href="http://concert.chords2cure.tv" target="_blank"><button class="btn btn-outline-light concert_btn" type="submit">C2C CONCERT 2020</button></a>
				
				</li-->
				<li class="nav-item active">
					<form name='search_frm' method="post" id="search_frm" action="search.php?<?php echo $_SERVER["QUERY_STRING"]?>">
					<div class="input-group">
					  <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="search_box" name="searchKeyword"required1 value="<?php echo $SEARCH_KEYWORD?>">
					  <div class="input-group-append">
						<span class="input-group-text" id="search_box" onclick="javascript:$('#searchFrmBtn').click();"><i class="material-icons nav_search_icon">search</i></span>
					  </div>
					  <span style='display:none;'><button type="submit" id="searchFrmBtn"></button></span>
					</div>
					</form>
				</li>
<?php
				if (empty($_SESSION['USER_DETAILS']['USER_CODE']) && basename($_SERVER['SCRIPT_NAME']) != 'validate-otp.php')
				{					
					$afterSignInRedirect2 = $_SERVER['PHP_SELF'].'?'.$_SERVER["QUERY_STRING"];
?>
				<li class="nav-item" onClick="setSignInRedirction('<?php echo $afterSignInRedirect2?>');">
					<a class="nav-link" href="#" data-toggle="modal" data-target="#signin_popup"><button class="btn btn-outline-light my-2 my-sm-0" type="submit">Sign In</button></a>	
				</li>
				<li class="nav-item">
					 <a class="nav-link" href="#" data-toggle="modal" data-target="#signup_popup"><button class="btn btn-outline-light my-2 my-sm-0" type="submit">Register</button></a>
				</li>
<?php
				}
				else if (!empty($_SESSION['USER_DETAILS']['USER_CODE']))
				{
?>
				<li class="nav-item nav_mobile">
					<div class="dropdown user_dropbox">
					  <a class="dropdown-toggle" type="button" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						 <span class="user_text"><?php echo $_SESSION['USER_DETAILS']['USER_NAME']?></span><i class="material-icons navbar_icon">person</i>
						  <i class="material-icons keyboard_down">keyboard_arrow_down</i>
						  <i class="material-icons keyboard_up">keyboard_arrow_up</i> 
					  </a>
					  <div class="dropdown-menu user_dropdown" aria-labelledby="dropdownMenuOffset">
						<a class="dropdown-item" href="update-profile.php">Profile Settings</a>
						<a class="dropdown-item" href="logout.php">Logout </a>
					  </div>
					</div>
				</li>
				
<?php
				}
?>
			</ul>
		</div>
	</div>
</nav>
<!-- End of navbar -->
