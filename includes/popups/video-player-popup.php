<!-- Start Sign up Popup Modal -->
<div class="modal fade bd-example-modal-lg" id="video_player_popup" tabindex="-1" role="dialog" aria-labelledby="signup_popup_ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="signup_popup_ModalLabel">Video Title</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="youtube_plyer_x_btn_id">
			<span aria-hidden="true"><i class="material-icons cancel_icon">close</i></span>
			</button>
		</div>
		<div class="modal-body modal-body-space">
			<div class="video_player_box">
				<iframe src="<?php echo $streamTrailerUrl;?>" class="my_iframe_video_id"></iframe>   
			</div>
		</div>
	</div>
</div>
</div>
<!-- End Sign up Popup Modal -->