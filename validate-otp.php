<?php 
include_once('includes/header.php');
include_once('includes/left-navbar.php');
$msg = '';
// check is seesion active or not
if (empty($_SESSION['USER_DETAILS']['USER_EMAIL']) || !empty($_SESSION['USER_DETAILS']['USER_CODE'])) redirect2Home();

$frmName = 'activation_code_frm';
$btnText = 'Activate';	
//$btnText = str_replace($ARR_CHARS, $ARR_CHARS_HTML_EN, 'O código de validação contém seis dígitos');	
$postAction = "validateAccountActivationCode";
$prepareToken = $_SESSION['prepareToken'];

$valParamArray = array();
$valParamArray['accountActivationCode'] = array(
	"type" => "text", 
	"msg" => 'Activation code', 
	"min" => array("length" => 6, "msg" => '6 digits'),
	"max" => array("length" => 6, "msg" => "6 chars")																
);

$_SESSION['formValidation4OTP'] = $valParamArray;

// Here Resend Activation Code
if (!empty($_GET['getAction']) && !empty($_SESSION['USER_DETAILS']['USER_EMAIL']) && $_GET['getAction'] == 'resendPassword')
{
	$arrFormData['postAction'] = 'resendAccountActivationCode';
	$arrFormData['appId'] = APP_CODE;
	$arrFormData['emailOrusername'] = $_SESSION['USER_DETAILS']['USER_EMAIL'];

	$arrRes = sendRequestUsingCURL(0, USER_MODULE_BASE_URL, $arrFormData);
	$status = $arrRes['status'];

	if ($status == 1) $msg = $arrRes['msg'];	
	else if ($status == 0) $msg = $arrRes['msg'];
	else $msg = GENERAL_MSG;
}
else if (!empty($_GET['getAction']) && empty($_SESSION['USER_DETAILS']['USER_EMAIL'])) $msg = 'Your session has been expired.';
?>
<!-- Start of Page Content  -->
<div id="content">
<?php
include_once('includes/top-navbar.php');
?>

<!-- Start of right container -->
<div class="container-fluid">
	<div class="container_topgap">
		<!-- Start of validate box -->
		<div class="validate_otpbox">
			<div class="activation_code">
			<div class='otpMsg display_error_on_top_4OTP' id="span_display_error_on_top_4OTP"><?php showSessionMessage()?><?php echo $msg?></div>
				<div class="card_holder_border">
				<?php
				//print_r($_SESSION['USER_DETAILS']);
				?>
					<h3>Enter activation code</h3>
					<p>The activation code was sent to your registered email. Please enter the code received to activate your account.</p>
					<form name='<?php echo $frmName;?>' method="post" id="<?php echo $frmName;?>" action="controller.php" enctype="multipart/form-data" onsubmit="return false;" class="activate_form">
					<div class="form-group">
						<div class="input-group input-groupbox">
							<!--<div class="input-group-append">
								<span class="input-group-text"><i class="material-icons nav_icon">settings_ethernet</i></span>
							</div>-->
							<input type="text" class="form-control" id="accountActivationCode" name="accountActivationCode" placeholder="Activation code" maxlength="6"  >
						</div>
						<span class='form_error error_inleft' id='span_accountActivationCode'></span> 
					</div>					
					<div class="row activation_btn">
						<div class="col-md-12">
							<button type="button" class="btn btn btn-light btn-inline-block btn_submit btnAction" onClick ='submitPopupFormAccActivationCode(1, "<?php echo $frmName;?>", <?php echo json_encode($valParamArray); ?>);'><?php echo $btnText?></button>
							<input type="hidden" name="postAction" value="validateAccountActivationCode">
							<input type="hidden" name="redirectTo" id="redirectTo" value="<?php echo HTTP_PATH?>/?<?php echo $_SERVER["QUERY_STRING"]?>">					
							<input type="hidden" name="formToken" value="<?php echo $prepareToken;?>">
						</div>
					</div>
					</form>
				</div>
				<div class="activation_link" onclick="javascript:$('.loader_background').show();"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $_SERVER["QUERY_STRING"]?>&getAction=resendPassword">Resend?</a></div>
			</div>
		</div>
		<!-- End of validate box -->
	</div>
</div>
<!-- End of right container -->

<!-- Start of footer -->	
<?php 
include_once('includes/footer.php');
?>
<!-- End of footer -->