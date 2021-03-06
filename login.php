<?php 
include('includes/header.php');
?>

<!-- Start of login page  -->
<div class="login_box">
	<form class="form-signin">
	  <div class="text-center mb-4">
		<img class="mb-4" src="/docs/4.4/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
		<h1 class="h3 mb-3 font-weight-normal">Floating labels</h1>
		<p>Build form controls with floating labels via the <code>:placeholder-shown</code> pseudo-element. <a href="https://caniuse.com/#feat=css-placeholder-shown">Works in latest Chrome, Safari, and Firefox.</a></p>
	  </div>

	  <div class="form-label-group">
		<input type="email" id="inputEmail" class="form-control" placeholder="E-mail" required autofocus>
		<label for="inputEmail">E-mail</label>
	  </div>

	  <div class="form-label-group">
		<input type="password" id="inputPassword" class="form-control" placeholder="Senha" required>
		<label for="inputPassword">Senha</label>
	  </div>

	  <div class="checkbox mb-3">
		<label>
		  <input type="checkbox" value="remember-me"> Remember me
		</label>
	  </div>
	  <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
	  <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2019</p>
	</form>
</div>
<!-- End of login page  -->
</div>
<!-- End of wrapper page  -->