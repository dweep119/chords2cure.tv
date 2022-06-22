<?php 
include_once('includes/header.php');
include_once('includes/left-navbar.php');

// check is seesion active or not
isSessionExpired();
$userFeedURL = USER_MODULE_BASE_URL.'/'.$_SESSION['USER_DETAILS']['USER_CODE'];

$arrRes = sendRequestUsingCURL(0, $userFeedURL);
$arrResData = $arrRes['data'];

$frmName = 'update_profile_frm';
$btnText = "Enviar";	
$postAction = "changePassword";
$valParamArray = array();
?>
<!-- Start of Page Content  -->
<div id="content">
<?php
include_once('includes/top-navbar.php');
?>

<!-- Start of right container -->
<div class="container-fluid">
	<div class="container_topgap">
		<div class="container_medium">
			<!-- Start of user profile box-->
			<div class="user_profile_box">
				<a href="javascript:void();" id="profile_setting"><div class="btn_box btn1 active">Profile</div></a>
				<a href="change-password.php" id="change_password"><div class="btn_box btn2">Change Password</div></a>
			</div>
			<div class="user_profile_container">
				<!-- Start of profile setting box -->
				<div id="profile_setting_box" class="collapse">
					<div class="profile_setting_container">
						<form name='<?php echo $frmName;?>' method="post" id="<?php echo $frmName;?>" action="" onSubmit='return validation(1, <?php echo json_encode($valParamArray); ?>);'>
							<div class="row">
								<div class="col-md-12">
									<!-- Start of form group -->
									<div class="form-group">
										<label for="full_name"><span class='star'>*</span>Full Name</label>
										<div class="input-group">
											<input type="text" class="form-control" id="full_name" placeholder="Full Name" value="<?php echo $arrResData['name']?>" readonly>
										</div>
										<span class='form_error' id='span_name'></span>  
									</div>
									<!-- End of form group -->
									<!-- Start of form group -->
									<div class="form-group">
										<label for="user_name"><span class='star'>*</span>Username</label>
										<div class="input-group">
											<input type="text" class="form-control" id="user_name" placeholder="Username" value="<?php echo $arrResData['username']?>" readonly>
										</div>
										<span class='form_error' id='span_name'></span>  
									</div>
									<!-- End of form group -->
									<!-- Start of form group -->
									<div class="form-group">
										<label for="email"><span class='star'>*</span>Email Address</label>
										<div class="input-group">
											<input type="text" class="form-control" id="email" placeholder="Email Address" value="<?php echo $arrResData['email']?>" readonly>
										</div>
										<span class='form_error' id='span_name'></span>  
									</div>
									<div class="form-group">
										<label for="email">Seu Instagram</label>
										<div class="input-group">
											<input type="text" class="form-control" id="email" placeholder="Seu Instagram" value="<?php echo $arrResData['instagram']?>" readonly>
										</div>
										<span class='form_error' id='span_instagram'></span>  
									</div>
									<!-- End of form group -->
									<div style='display:none;'>
									<!-- Start of form group -->
									<div class="form-group">
										<label for="email"><span class='star'>*</span>Senha</label>
										<div class="input-group">
											<input type="text" class="form-control" id="email" placeholder="Senha" readonly>
										</div>
										<span class='form_error' id='span_name'></span>  
									</div>
									<!-- End of form group -->
									<!-- Start of form group -->
									<div class="form-group">
										<label for="cpassword"><span class='star'>*</span>Confirmar senha</label>
										<div class="input-group">
											<input type="text" class="form-control" id="cpassword" name='cpassword' placeholder="Confirmar senha">
										</div>
										<span class='form_error' id='span_cpassword'></span>  
									</div>
									<!-- End of form group -->
									</div>

									<div class="btn_left" style='display:none;'>
										<button type="submit" class="btn btn-light" data-dismiss="modal" onclick="javascript:$('.loader_background').show();">Enviar</button>
										<button type="button" class="btn btn-outline-light">Close</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- End of profile setting box -->
			</div>
			<!-- End of user profile box -->
		</div>
	</div>
</div>

<!-- End of right container -->

<!-- Start of footer -->	
<?php 
include_once('includes/footer.php');
?>
<!-- End of footer -->