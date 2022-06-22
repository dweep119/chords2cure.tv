<?php
$frmName = 'signup_frm';
$btnText = "Sign Up";	
$frmTitle = "Create an Account";
$postAction = "register";
$prepareToken = $_SESSION['prepareToken'];

$valParamArray = array();
$valParamArray['name_signup'] = array(
	"type" => "text", 
	"msg" => "Full Name", 
	"min" => array("length" => 1, "msg" => "1 char"),
	"max" => array("length" => 255, "msg" => "255 chars")																
);

$valParamArray['username'] = array(
	"type" => "text", 
	"msg" => "Username", 
	"min" => array("length" => 1, "msg" => "1 char"),
	"max" => array("length" => 30, "msg" => "30 chars")																
);

$valParamArray['email'] = array(
	"type" => "email", 
	"msg" => "Email Address", 
	"min" => array("length" => 1, "msg" => "1 char"),
	"max" => array("length" => 255, "msg" => "255 chars")																
);


$valParamArray['password'] = array(
	"type" => "password", 
	"msg" => "Password", 
	"min" => array("length" => 8, "msg" => "8 characters password"), 
	"max" => array("length" => 20, "msg" => "20 chars."), 
	//"regex" => array("pattern" => PASSWORD_REGEX, "msg" => PASSWORD_MSG)
);

$valParamArray['cpassword'] = array(
	"type" => "cpassword", 
	"msg" => "Password", 
	"min" => array("length" => 8, "msg" => "8 characters password"), 
	"max" => array("length" => 20, "msg" => "20 chars."), 
	//"regex" => array("pattern" => PASSWORD_REGEX, "msg" => CPASSWORD_MSG)
);
														
															
//$valParamArray['password'] = array("type" => "password", "msg" => "Senha");

//$valParamArray['cpassword'] = array("type" => "cpassword", "msg" => "Confirmar senha");

$_SESSION['formValidation'] = $valParamArray;

//
?>
<!-- Start Sign up Popup Modal -->
<div class="modal fade bd-example-modal-md" id="signup_popup" tabindex="-1" role="dialog" aria-labelledby="signup_popup_ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-md" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="signup_popup_ModalLabel"><?php echo $frmTitle?></h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true"><i class="material-icons cancel_icon">close</i></span>
			</button>
		</div>
		<div class="modal-body modal_scroll">
			<div class="col-md-12">			
			<form name='signup_frm' method="post" id="<?php echo $frmName;?>" action="controller.php" enctype="multipart/form-data" onsubmit="return false;" autocomplete="off">
				<div class="row">
				<div class="col-md-6">
					<!-- Start of form group -->
					<div class="form-group">
						<label for="name_signup"><span class='star'>*</span>Full Name</label>
						<div class="input-group">
							<div class="input-group-append">
								<span class="input-group-text"><i class="material-icons nav_icon">person</i></span>
							</div>
							<input type="text" class="form-control" id="name_signup" name="name_signup" placeholder="Full Name" maxlength="255">
						</div>
						<span class='form_error' id='span_name_signup'></span>  
					</div>
					<!-- End of form group -->
				</div>
				<div class="col-md-6">
				  <!-- Start of form group -->
					<div class="form-group">
						<label for="username"><span class='star'>*</span>Username</label>
						<div class="input-group">
							<div class="input-group-append">
								<span class="input-group-text"><i class="material-icons nav_icon">person</i></span>
							</div>
							<input type="text" class="form-control" id="username" name="username" placeholder="Username" maxlength="30">
						</div>
						<span class='form_error' id='span_username'></span>  
					</div>
					<!-- End of form group -->
				</div>
				</div>
			  	<!-- Start of form group -->
				<div class="row">
					<div class="col-md-6">
						<!-- Start of form group -->
						<div class="form-group">
							<label for="email"><span class='star'>*</span>Email Address</label>
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text"><i class="material-icons nav_icon">email</i></span>
								</div>
								<input type="text" class="form-control" id="email" name="email" placeholder="Email Address" maxlength="255">
							</div>
							<span class='form_error' id='span_email'></span>  
						</div>
						<!-- End of form group -->
					</div>
					<div class="col-md-6">
						<!-- Start of form group -->
						<div class="form-group">
							<label for="instagram">Your Instagram (optional)</label>
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text"><i class="material-icons nav_icon instagram_box"><img src="images/instagram.png" alt="instagram"></i></span>
								</div>
								<input type="text" class="form-control" id="instagram" name="instagram" placeholder="Your Instagram" maxlength="255">
							</div>
							<span class='form_error' id='span_instagram'></span>  
						</div>
						<!-- End of form group -->
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<!-- Start of form group -->
						<div class="form-group">
							<label for="email"><span class='star'>*</span>Password</label>
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text"><i class="material-icons nav_icon">lock</i></span>
								</div>
								<input type="password" class="form-control" id="password" name="password" placeholder="Password" maxlength="20">
							</div>
							<span class='form_error' id='span_password'></span>  
						</div>
						<!-- End of form group -->
					</div>
					<div class="col-md-6">
						<!-- Start of form group -->
						<div class="form-group">
							<label for="cpassword"><span class='star'>*</span>Confirm Password</label>
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text"><i class="material-icons nav_icon">lock</i></span>
								</div>
								<input type="password" class="form-control" id="cpassword" name='cpassword' placeholder="Confirm Password" maxlength="20">
							</div>							
							<span class='form_error' id='span_cpassword'></span> 
						</div>
						<!-- End of form group -->
					</div>
					<span class='form_error error_center' id='span_display_error_on_top'></span>
				</div>
			    <div class="button_centeralize">
					<button type="button" name="submitBtn" id="submitBtn" class="btn btn-light btn-block" onClick ='submitPopupFormSignup(1, "<?php echo $frmName;?>", <?php echo json_encode($valParamArray); ?>);'><?php echo $btnText?></button>
					<input type="hidden" name="postAction" id="postActionPages" value="<?php echo $postAction;?>">
					<input type="hidden" name="redirectTo" id="redirectTo" value="validate-otp.php?<?php echo $_SERVER["QUERY_STRING"]?>">					
					<input type="hidden" name="formToken" value="<?php echo $prepareToken;?>">
					<div class="forget_text">Already registered?<a href="includes/popups/sign-in-popup.php" target="_blank" data-toggle="modal" data-target="#signin_popup" data-dismiss="modal" aria-label="Close"> Click here to Sign In.</a></div>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
</div>
<!-- End Sign up Popup Modal -->