<?php 
include_once('includes/header.php');
include_once('includes/left-navbar.php');

// check is seesion active or not
isSessionExpired();

$frmName = 'change_pass_frm';
$btnText = "Submit";	
$postAction = "changePassword";

$msg = '';
if (!empty($_POST['postAction']) && $_POST['postAction'] == 'changePassword')
{
	$_POST = trimFormValue(0, $_POST);	
	if (!validateForm($_SESSION['formValidation4ChangePass']))
	{
		$frmKeyExcludeArr = array('submitBtn', 'formToken', 'postAction', 'searchFrmID', 'name_signup', 'cpassword', 'redirectTo', 'oldPassword', 'password');
		$dataArr = prepareKeyValue4Msql(0, $_POST, $frmKeyExcludeArr);
		
		// Here set form data 
		//$arrFormData = $dataArr;
		
		$arrFormData['newPassword'] = $_POST['password'];
		$arrFormData['oldPassword'] = $_POST['oldPassword'];
		$arrFormData['confirmPassword'] = $_POST['cpassword'];
		$arrFormData['postAction'] = $postAction;

		$arrFormData['appId'] = APP_CODE;
		$arrFormData['userCode'] = $_SESSION['USER_DETAILS']['USER_CODE'];

		$arrRes = sendRequestUsingCURL(0, USER_MODULE_BASE_URL, $arrFormData);
		$status = $arrRes['status'];
		
		if ($status == 1) $msg = $arrRes['msg'];
		else if ($status == 0) $msg = $arrRes['msg'];
		else $msg = GENERAL_MSG;		
	}
}

$valParamArray['oldPassword'] = array(
	"type" => "password", 
	"msg" => "Current Password", 
	"min" => array("length" => 1, "msg" => "1 char."), 
	"max" => array("length" => 20, "msg" => "20 chars."), 
	//"regex" => array("pattern" => PASSWORD_REGEX, "msg" => PASSWORD_MSG)
);

$valParamArray['password'] = array(
	"type" => "password", 
	"msg" => "New Password", 
	"min" => array("length" => 8, "msg" => "8 characters password"), 
	"max" => array("length" => 20, "msg" => "20 chars."), 
	//"regex" => array("pattern" => PASSWORD_REGEX, "msg" => PASSWORD_MSG)
);

$valParamArray['cpassword'] = array(
	"type" => "cpassword", 
	"msg" => "Confirm Password", 
	"min" => array("length" => 8, "msg" => "8 characters password"), 
	"max" => array("length" => 20, "msg" => "20 chars."), 
	//"regex" => array("pattern" => PASSWORD_REGEX, "msg" => CPASSWORD_MSG)
);
														
															
//$valParamArray['password'] = array("type" => "password", "msg" => "Senha nova");

//$valParamArray['cpassword'] = array("type" => "cpassword", "msg" => "Confirm Password");

$_SESSION['formValidation4ChangePass'] = $valParamArray;
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
			<div class='cPassMsg'><?php showSessionMessage()?><?php echo $msg?></div>
			<!-- Start of user profile box-->
			<div class="user_profile_box">
				<a  href="update-profile.php" ><div class="btn_box btn1">Profile</div></a>
				<a href="javascript:void();" id="change_password"><div class="btn_box btn2 active">Change Password</div></a>
			</div>
			<div class="user_profile_container">
				<!-- Start of change password box -->
				<div id="change_password_box">
					<div class="change_password_container">
						<form name='<?php echo $frmName;?>' method="post" id="<?php echo $frmName;?>" action="" onSubmit='return validation(1, <?php echo json_encode($valParamArray); ?>);'>
							<div class="row">
								<div class="col-md-12">
									<!-- Start of form group -->
									<div class="form-group">
										<label for="oldPassword"><span class='star'>*</span>Current Password</label>
										<div class="input-group">
											<input class="form-control" type="password" name='oldPassword' id='oldPassword' placeholder="Current Password" maxlength="20" value="">
										</div>
										<span id='span_oldPassword' class='form_error'><?php showErrorMessage('oldPassword'); ?></span> 
									</div>
									<!-- End of form group -->
									<!-- Start of form group -->
									<div class="form-group">
										<label for="password"><span class='star'>*</span>New Password</label>
										<div class="input-group">
											<input class="form-control" type="password" name='password' id='password' placeholder="New Password" maxlength="20" value="">			
										</div>
										<span id='span_password' class='form_error'><?php showErrorMessage('password'); ?></span> 
									</div>
									<!-- End of form group -->
									<!-- Start of form group -->
									<div class="form-group">
										<label for="cpassword"><span class='star'>*</span>Confirm Password</label>
										<div class="input-group">
											<input class="form-control" type="password" name='cpassword' id='cpassword' placeholder="Confirm Password" maxlength="20" value="">
										</div>
										<span id='span_cpassword' class='form_error'><?php showErrorMessage('cpassword'); ?></span>  
									</div>
									<!-- End of form group -->
									<div class="btn_left">
										<input type="hidden" name='postAction' value="<?php echo $postAction?>">
										<button type="submit" class="btn btn-light" data-dismiss="modal" name='submitBtn' ><?php echo $btnText;?></button>
										<button type="reset" class="btn btn-outline-dark">Reset</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- End of change password box -->
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