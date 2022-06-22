<?php
$frmName = 'ticket_code_frm';
$btnText = "Assistir agora";		
$postAction = "validateTicketCode";
$prepareToken = $_SESSION['prepareToken'];

$valParamArray = array();
$valParamArray['ticketCode'] = array(
	"type" => "text", 
	"msg" => "Código do Ingresso", 
	"min" => array("length" => 10, "msg" => "O Código do ticket possui 10 caracteres. Por favor verifique."),
	"max" => array("length" => 10, "msg" => "10 chars")																
);

$_SESSION['formValidation4Tcode'] = $valParamArray;
?>
<!-- Start Sign up Popup Modal -->
<div class="modal fade" id="ticket_purchased" tabindex="-1" role="dialog" aria-labelledby="ticket_purchased" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="credit_card_popup_ModalLabel">Código do Ingresso</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true"><i class="material-icons cancel_icon">close</i></span>
			</button>
		</div>
		<div class="modal-body">
			<div class="col-md-12">
			<div class="ticket_text">Digite abaixo o código do ingresso recebido por e-mail</div>
			<form name='<?php echo $frmName;?>' method="post" id="<?php echo $frmName;?>" action="controller.php" onsubmit="return false;">
				 <div class="form-group ticket_codebox">
					<div class="input-group">
						<input type="text" class="form-control" id="ticketCode" name="ticketCode" placeholder="Digite aqui o código do ingresso recebido por e-mail" maxlength="10">
					</div>
					<span class='form_error' id='span_ticketCode'></span>  
				</div>
			    <div class="button_center">
					<input type="hidden" name="postAction" value="<?php echo $postAction;?>">
					<input type="hidden" name="redirectTo" id="redirectTo" value="video-player.php?<?php echo $_SERVER["QUERY_STRING"]?>">			
					<input type="hidden" name="selectedMenuType" value="<?php echo $selectedMenuType?>">			
					<input type="hidden" name="streamGuid" value="<?php echo $selectedstreamGuid?>">			
					<input type="hidden" name="formToken" value="<?php echo $prepareToken;?>">
					<button type="button" class="btn btn-light btn-block" onClick ='submitPopupFormTcode(1, "<?php echo $frmName;?>", <?php echo json_encode($valParamArray); ?>);'><?php echo $btnText?></button>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
</div>
<!-- End Sign up Popup Modal -->