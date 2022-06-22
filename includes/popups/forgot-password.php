<?php
$frmName = 'forgotPassword_frm';
$btnText = "Submit";		
$postAction = "forgotPassword";
$prepareToken = $_SESSION['prepareToken'];

$valParamArray = array();
$valParamArray['emailOrusername'] = array(
	"type" => "text", 
	"msg" => "Username/Email Address", 
	"min" => array("length" => 1, "msg" => "1 char"),
	"max" => array("length" => 255, "msg" => "255 chars")																
);
$_SESSION['formValidation4ForgotPassword'] = $valParamArray;
?>
<!-- Start Sign up Popup Modal -->
<div class="modal fade" id="forgot_password" tabindex="-1" role="dialog" aria-labelledby="forgot_password" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Forgot Password</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true"><i class="material-icons cancel_icon">close</i></span>
			</button>
		</div>
		<div class="modal-body">
			<div class="col-md-12">
			<!-- Start of form -->
			<form name='<?php echo $frmName;?>' method="post" id="<?php echo $frmName;?>" action="controller.php" onsubmit="return false;">
				<!-- Start of form group -->
				<div class="form-group">
					<label for="emailOrusername"><span class='star'>*</span>Username/Email Address</label>
					<div class="input-group">
						<div class="input-group-append">
							<span class="input-group-text"><i class="material-icons nav_icon">mail_outline</i></span>
						</div>
						<input type="text" class="form-control" id="emailOrusername" name='emailOrusername' placeholder="Username/Email Address" maxlength="255">
					</div>
					<span class='form_error' id='span_emailOrusername'></span>  
				</div>
				<!-- End of form group -->
				<span class='form_error error_left' id='span_display_error_on_top_fPassword'></span>
				<div class="button_center">
					<button type="button" class="btn btn-light btn-block"onClick ='submitPopupFormForgotPassword(1, "<?php echo $frmName;?>", <?php echo json_encode($valParamArray); ?>);'><?php echo $btnText?></button>
					<input type="hidden" name="postAction" id="postActionPages" value="<?php echo $postAction;?>">
					<input type="hidden" name="redirectTo" id="redirectTo" value="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $_SERVER["QUERY_STRING"]?>">					
					<input type="hidden" name="formToken" value="<?php echo $prepareToken;?>">
				</div>
			</form>
			<!-- End of form -->
			</div>
		</div>
	</div>
</div>
</div>
<!-- End Sign up Popup Modal -->