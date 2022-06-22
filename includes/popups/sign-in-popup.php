<?php
$frmName = 'signin_frm';
$btnText = "Sign In";		
$postAction = "checkUserLogin";
$prepareToken = $_SESSION['prepareToken'];

$valParamArray = array();
$valParamArray['signInEmail'] = array(
	"type" => "text", 
	"msg" => "Username/Email Address", 
	"min" => array("length" => 1, "msg" => "1 char"),
	"max" => array("length" => 255, "msg" => "255 chars")																
);


$valParamArray['signInPassword'] = array(
	"type" => "password", 
	"msg" => "Password", 
	"min" => array("length" => 1, "msg" => "1 char."), 
);

$_SESSION['formValidation4Sign'] = $valParamArray;

//
?>
<!-- Start Sign up Popup Modal -->
<div class="modal fade" id="signin_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" autocomplete="off">
<div class="modal-dialog modal-dialog-centered" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Sign In</h5>
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
					<label for="signInEmail"><span class='star'>*</span>Username/Email Address</label>
					<div class="input-group">
						<div class="input-group-append">
							<span class="input-group-text"><i class="material-icons nav_icon">mail_outline</i></span>
						</div>
						<input type="text" class="form-control" id="signInEmail" name='signInEmail' placeholder="Username/Email Address" maxlength="255" autocomplete="off">
					</div>
					<span class='form_error' id='span_signInEmail'></span>  
				</div>
				<!-- End of form group -->
				<!-- Start of form group -->
				<div class="form-group">
					<label for="signInPassword"><span class='star'>*</span>Password</label>
					<div class="input-group">
						<div class="input-group-append">
							<span class="input-group-text"><i class="material-icons nav_icon">lock</i></span>
						</div>
						<input type="password" class="form-control" id="signInPassword" name="signInPassword" placeholder="Password" maxlength="20" autocomplete="off">
					</div>
					<span class='form_error' id='span_signInPassword'></span>  
				</div>
				<span class='form_error error_left' id='span_display_error_on_top_signin'></span>
				<!-- End of form group -->
				<div class="button_center">
					<button type="button" class="btn btn-light btn-block" onClick ='submitPopupFormSignin(1, "<?php echo $frmName;?>", <?php echo json_encode($valParamArray); ?>);'><?php echo $btnText?></button>
					<input type="hidden" name="postAction" id="postActionPages" value="<?php echo $postAction;?>">
					<input type="hidden" name="redirectTo" id="redirectToSignIn" value="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo $_SERVER["QUERY_STRING"]?>">			
					<input type="hidden" name="formToken" value="<?php echo $prepareToken;?>">
					<div class="forget_popup"><a href="includes/popups/forgot-password.php" target="_blank" data-toggle="modal" data-target="#forgot_password" data-dismiss="modal" aria-label="Close">Forgot Password?</a> Click here to recover
					<div class="gap_top">Don't have your C2C account yet?<a href="includes/popups/sign-up-popup.php" target="_blank" data-toggle="modal" data-target="#signup_popup" data-dismiss="modal" aria-label="Close"> Sign up</a> and create for free.!</div></div>
				</div>
			</form>
			<!-- End of form -->
			</div>
		</div>
	</div>
</div>
</div>
<!-- End Sign up Popup Modal -->