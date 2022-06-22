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
		<!-- Start of user profile box-->
		<div class="user_profile_box">
			<a href="javascript:void();" id="profile_setting"><div class="btn_box active"><i class="material-icons">person_outline</i> User Profile</div></a>
			<a href="change-password.php" id="change_password"><div class="btn_box"><i class="material-icons">lock</i>Trocar a senha</div></a>
		</div>
		<div class="user_profile_container">
			<!-- Start of profile setting box -->
			<div id="profile_setting_box" class="collapse">
				<div class="profile_setting_container">
					<form id='signup_frm' name='signup_frm' >
						<div class="row">
							<div class="col-md-12">
								<!-- Start of form group -->
								<div class="form-group">
									<label for="full_name"><span class='star'>*</span>Nome completo</label>
									<div class="input-group">
										<div class="input-group-append">
											<span class="input-group-text"><i class="material-icons nav_icon">person_add</i></span>
										</div>
										<input type="text" class="form-control" id="full_name" placeholder="Nome completo">
									</div>
									<span class='form_error' id='span_name'></span>  
								</div>
								<!-- End of form group -->
								<!-- Start of form group -->
								<div class="form-group">
									<label for="user_name"><span class='star'>*</span>Usuário</label>
									<div class="input-group">
										<div class="input-group-append">
											<span class="input-group-text"><i class="material-icons nav_icon">person</i></span>
										</div>
										<input type="text" class="form-control" id="user_name" placeholder="Usuário">
									</div>
									<span class='form_error' id='span_name'></span>  
								</div>
								<!-- End of form group -->
								<!-- Start of form group -->
								<div class="form-group">
									<label for="email"><span class='star'>*</span>E-mail</label>
									<div class="input-group">
										<div class="input-group-append">
											<span class="input-group-text"><i class="material-icons nav_icon">email</i></span>
										</div>
										<input type="text" class="form-control" id="email" placeholder="E-mail">
									</div>
									<span class='form_error' id='span_name'></span>  
								</div>
								<!-- End of form group -->
								<!-- Start of form group -->
								<div class="form-group">
									<label for="email"><span class='star'>*</span>Senha</label>
									<div class="input-group">
										<div class="input-group-append">
											<span class="input-group-text"><i class="material-icons nav_icon">lock</i></span>
										</div>
										<input type="text" class="form-control" id="email" placeholder="Senha">
									</div>
									<span class='form_error' id='span_name'></span>  
								</div>
								<!-- End of form group -->
								<!-- Start of form group -->
								<div class="form-group">
									<label for="cpassword"><span class='star'>*</span>Confirmar senha</label>
									<div class="input-group">
										<div class="input-group-append">
											<span class="input-group-text"><i class="material-icons nav_icon">lock</i></span>
										</div>
										<input type="text" class="form-control" id="cpassword" name='cpassword' placeholder="Confirmar senha">
									</div>
									<span class='form_error' id='span_cpassword'></span>  
								</div>
								<!-- End of form group -->

								<div class="btn_left">
									<button type="submit" class="btn btn-primary" data-dismiss="modal">Enviar</button>
									<button type="button" class="btn btn-danger">Close</button>
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
<!-- End of right container -->

<!-- Start of footer -->	
<?php 
include_once('includes/footer.php');
?>
<!-- End of footer -->