	<div class="footer_box">
		<footer class="container-fluid">
			<div class="footer_text">
				<ul class="playstore_list">
					<li><a href="https://play.google.com/store/apps/details?id=com.chords2cure.android&hl=en_IN" target="_blank"><img src="images/android_playstore.png"></a></li>
					<li><a href="https://apps.apple.com/us/app/chords2cure/id1493194602" target="_blank"><img src="images/ios_playstore.png"></a></li>
				</ul>
				<div class="clearfix"></div>
				<p class="text-center footer_link"><a href="https://www.chords2cure.org/terms-conditions" target="_blank">Terms and Conditions</a> | <a href="https://www.chords2cure.org/privacy-policy" target="_blank">Privacy Policy</a> </p>
				<p class="text-center copy_footer"><?php echo COPY_RIGHT_INFO?></p>	
			</div>
		</footer>
	</div>
	<!-- Start loader -->

	<!-- Start loader -->
	<div class="loader_background">
		<div class="loader_box">
			<div class="loader"></div>
		</div>
	</div>
	<!-- End loader -->

	</div>
	<!-- End of Page Content  -->
</div>
	
<!-- End of wrapper -->
<?php
if (empty($_SESSION['USER_DETAILS']['USER_CODE']))
{
	include_once('includes/popups/sign-in-popup.php');
	include_once('includes/popups/sign-up-popup.php');
	include_once('includes/popups/forgot-password.php');
}
include_once('includes/popups/video-player-popup.php');
include_once('includes/popups/video-expire-popup.php');

unset($_SESSION['formMessage']);
?>

<!-- Include JS files -->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/common/form-validation.js"></script>
<script src="js/common/common.js"></script>

<script src="js/slick.js"></script>
<?php
if ($_SERVER['SERVER_NAME'] != 'localhost' && $_SERVER['SERVER_NAME'] != '10.1.1.5')
{
?>
	<script type="text/javascript" src="js/common/keyboard-key-disable.js"></script>
<?php
}
?>

<script type="text/javascript">
$(document).ready(function () {
	$('#sidebarCollapse').on('click', function () {
		$('#sidebar').toggleClass('active');
		$('#content').toggleClass('active');
		$('.navbar-light').toggleClass('active');
	});
});
/** Script for poup modal outside **/
$(".modal").modal({
	show: false,
	backdrop: 'static'
});
/** Start of profile setting **/
$('#profile_setting').click(function(){
	$('.collapse').hide();
	$('#profile_setting_box').show();
	$('.user_profile_box').find('.btn_box').removeClass('active');
	$(this).find('.btn_box').addClass('active');
});
$('#change_password').click(function(){
	$('.collapse').hide();
	$('#change_password_box').show();
	$('.user_profile_box').find('.btn_box').removeClass('active');
	$(this).find('.btn_box').addClass('active');
});	
/** Hide modal popup if open 
$('.forget_popup a').click(function() {
  $('#signin_popup').modal('hide');
});
$('.forget_text a').click(function() {
  $('#signup_popup').modal('hide');
});	**/
	/** Sub category slide r**/
   
$('.responsive').slick({
  dots: true,
  infinite: false,
  speed: 500,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 730,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 455,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});

$('#sidebarCollapse').on('click', function(){
    $('#navbarSupportedContent').collapse('hide');
});
	
/** Carousel slider start ***/
 $("#myCarousel").carousel({interval: 3000});
/** Carousel slider end ***/
</script>
</body>
</html>