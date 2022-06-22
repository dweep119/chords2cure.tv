<?php 
use \PhpPot\Service\StripePayment;
include_once('includes/header.php');
include_once('includes/left-navbar.php');

isSessionExpired();

$streamType = getValPostORGet('streamType', 'B');
$menuGuid = getValPostORGet('menuGuid', 'B');
$streamGuid = getValPostORGet('streamGuid', 'B');
if ($menuGuid != '' && $streamGuid != '') isSessionExpired();

$userCode = $_SESSION['USER_DETAILS']['USER_CODE'];
// If Live Event Request There then get stream ID
if ($streamType == 'E')
{
	//$streamGuid = $ARR_FEED_DATA['arrMenuSelectedItemData'][0]['stream_guid'];
	//$streamGuid = $ARR_FEED_DATA['arrMenuSelectedItemData'][0]['streams'][0]['stream_guid'];
}

$detailPageFeedURL = DETAIL_PAGE_BASE_URL.'/'.$streamGuid.'/'.$menuGuid.'/'.$userCode;

$arrRes = sendRequestUsingCURL(0, $detailPageFeedURL);

$ARR_DETAIL_PG_FEED_DATA = parseDetailPgFeedArrData(0, $arrRes);

$arrSelectedItemData = $ARR_DETAIL_PG_FEED_DATA['arrSelectedItemData'];

// Here get Menu Info
$selectedMenuName = trim($ARR_DETAIL_PG_FEED_DATA['selectedMenuName']);
$selectedMenuGuid = trim($ARR_DETAIL_PG_FEED_DATA['selectedMenuGuid']);
$selectedMenuType = trim($ARR_DETAIL_PG_FEED_DATA['selectedMenuType']);

$itemAmt = 0;
$paymentOptn = getValPostORGet('paymentOptn', 'B');
$otherAmt = trim(getValPostORGet('otherAmt', 'B'));

if ($paymentOptn == 'other' && $otherAmt == '')
{
	$_SESSION['messageSessionD'] = 'Please enter Other Amount';
	$dURL = "donate-per-view.php?menuGuid=".$selectedMenuGuid."&streamGuid=".$streamGuid."&error=12&streamType=".$selectedMenuType;
	headerRedirect($dURL);
}

if ($paymentOptn == 'other')
{
	$itemAmt = $otherAmt;
}
else
{
	$itemAmt = str_replace('$', '', $paymentOptn);
}
//$itemAmt = 0.5;
if ($itemAmt == '') $itemAmt = $_POST['amount'];
 $successMessage = '';
// Code to handle payment request
if (!empty($_POST["token"])) {
    require_once 'StripePayment.php';

    $stripePayment = new StripePayment();    
    $stripeResponse = $stripePayment->chargeAmountFromCard($_POST);    
    
    $amount = $stripeResponse["amount"];    
    //$param_type = 'ssdssss';

    $param_value_array = array(
        $_POST['email'],
        $_POST['item_number'],
        $amount,
        $stripeResponse["currency"],
        $stripeResponse["balance_transaction"],
        $stripeResponse["status"],
        json_encode($stripeResponse)
    );
	
	//echo "<pre>";
	//print_r($param_value_array);
    
    if ($stripeResponse['amount_refunded'] == 0 && empty($stripeResponse['failure_code']) && $stripeResponse['paid'] == 1 && $stripeResponse['captured'] == 1 && $stripeResponse['status'] == 'succeeded')
	{
        $successMessage = "Stripe payment is completed successfully. The TXN ID is " . $stripeResponse["balance_transaction"];
		
		$arrFormData['appId'] = APP_CODE;
		$arrFormData['userCode'] = $_SESSION['USER_DETAILS']['USER_CODE'];
		$arrFormData['streamGuid'] = $streamGuid;
		$arrFormData['amount'] = $itemAmt;	
		$videoPlayerURL = "video-player.php?menuGuid=".$selectedMenuGuid."&streamGuid=".$streamGuid."&streamType=".$selectedMenuType;
		
		if ($streamType == 'E')
		{		
			$arrFormData4PP = $arrFormData;
			$arrFormData['postAction'] = 'buyTicket';
			$arrFormData['buyInformation'] = $stripeResponse["balance_transaction"];
			$arrRes = sendRequestUsingCURL(0, TICKET_PAGE_BASE_URL, $arrFormData);
			$liveEventStatus = isLiveEventOnGoing($arrSelectedItemData['stream_event_st_date_time_on_utc'], $arrSelectedItemData['stream_event_end_date_time_on_utc']);
			
			if ($liveEventStatus == 'Y')
			{				
				$arrFormData4PP['postAction'] = 'sendPaymentInfo';
				$arrFormData4PP['paymentInformation'] = $arrRes['data']['ticket_code'];
				
				$arrRes = sendRequestUsingCURL(0, PAYMENT_BASE_URL, $arrFormData4PP);
			}
			else
			{
				$videoPlayerURL = "ticket-confirmation.php?menuGuid=".$selectedMenuGuid."&streamGuid=".$streamGuid."&streamType=".$selectedMenuType;
			}
		}
		else 
		{			
			$arrFormData['postAction'] = 'sendPaymentInfo';
			$arrFormData['paymentInformation'] = $stripeResponse["balance_transaction"];			
			$arrRes = sendRequestUsingCURL(0, PAYMENT_BASE_URL, $arrFormData);
		}

		
		$status = $arrRes['status'];

		if ($status == 1)
		{
			$msg = $arrRes['msg'];	
			
			headerRedirect($videoPlayerURL);
		}
		else if ($status == 0) $msg = $arrRes['msg'];
		else $msg = GENERAL_MSG;
		$successMessage = $msg;

    }
}

$valParamArray = array();
$valParamArray['cardHolderName'] = array(
	"type" => "text", 
	"msg" => "Nome impresso no cartão ", 
	"min" => array("length" => 1, "msg" => "1 char"),
	"max" => array("length" => 255, "msg" => "255 chars")																
);
$valParamArray['emailAddressCard'] = array(
	"type" => "email", 
	"msg" => "E-mail", 
	"min" => array("length" => 1, "msg" => "1 char"),
	"max" => array("length" => 255, "msg" => "255 chars")																
);

$valParamArray['cardNo'] = array(
	"type" => "text", 
	"msg" => "Número do cartão ", 
	"min" => array("length" => 16, "msg" => "16 chars."), 
	"max" => array("length" => 20, "msg" => "16 chars."), 
);

$valParamArray['cvc'] = array(
	"type" => "text", 
	"msg" => "Código de Segurança (CVV)", 
	"min" => array("length" => 3, "msg" => "1 char."), 
	"max" => array("length" => 3, "msg" => "3 chars."), 
);

$valParamArray['month'] = array("type" => "dropDown", "msg" => "Month");
$valParamArray['year'] = array("type" => "dropDown", "msg" => "Year");
// Test Card No: 4242424242424242
?>
<!-- Start of Page Content  -->
<div id="content">
<?php
include_once('includes/top-navbar.php');
?>

	<!-- Start of right container -->
	<div class="container-fluid">
		<div class="container_topgap">	

			<!-- Start of movie detail-->
			<div class="container_credit">
				<h3 class="donate_title"><?php echo $selectedMenuName?><sup style='display:none;'>TM</sup></h3>
				<div class="price_detail">R$<?php echo $itemAmt?></div>

				<?php if(!empty($successMessage)) { ?>
				 <div id="success-message"><?php echo $successMessage; ?></div>
				 <?php  } ?>

				<div id="error-message"></div>

				<div class="card_holder_border">
				<form id='frmStripePayment' name='frmStripePayment' action="" method="post">
					 <div class="form-group">
						<label for="cardHolderName"><span class='star'>*</span>Nome impresso no cartão</label>
						<div class="input-group">
							<div class="input-group-append">
								<span class="input-group-text"><i class="material-icons nav_icon mat_icons"><img src="images/person.png"></i></span>
							</div>
							<input type="text" class="form-control" id="cardHolderName" name="cardHolderName" placeholder="Nome impresso no cartão" value="<?php echo $_SESSION['USER_DETAILS']['USER_NAME']?>">
						</div>
						<span class='form_error' id='span_cardHolderName'></span>  
					 </div>
					 <div class="form-group">
						<label for="emailAddressCard"><span class='star'>*</span>Seu e-mail</label>
						<div class="input-group">
							<div class="input-group-append">
								<span class="input-group-text"><i class="material-icons nav_icon mat_icons"><img src="images/email.png"></i></span>
							</div>
							<input type="text" class="form-control" id="emailAddressCard" name="emailAddressCard" placeholder="Seu e-mail" value="">
						</div>
						<span class='form_error' id='span_emailAddressCard'></span>  
					 </div>
					<div class="form-group">
						<label for="emailAddressCard"><span class='star'>*</span>País</label>
						<div class="input-group">
							<div class="input-group-append">
								<span class="input-group-text"><i class="material-icons nav_icon mat_icons"><img src="images/globe.png"></i></span>
							</div>
							<input type="text" class="form-control" id="emailAddressCard" name="emailAddressCard" placeholder="País" value="">
						</div>
						<span class='form_error' id='span_emailAddressCard'></span>  
					 </div>
					<div class="form-group">
						<label for="cardNo"><span class='star'>*</span>CPF</label>
						<div class="input-group">
							<div class="input-group-append">
								<span class="input-group-text" id="search_box"><i class="material-icons nav_icon mat_icons"><img src="images/crf.png"></i></span>
							</div>
							<input type="text" class="form-control" id="cardNo" name="cardNo" placeholder="CPF" value="" maxlength="20">
						</div>
						<span class='form_error' id='span_cardNo'></span>  
					</div>
					<div class="form-group">
						<label for="cardNo"><span class='star'>*</span>Número do cartão </label>
						<div class="input-group">
							<div class="input-group-append">
								<span class="input-group-text" id="search_box"><i class="material-icons nav_icon mat_icons"><img src="images/card.png"></i></span>
							</div>
							<input type="text" class="form-control" id="cardNo" name="cardNo" placeholder="Número do cartão" value="" maxlength="20">
						</div>
						<span class='form_error' id='span_cardNo'></span>  
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="cvv"><span class='star'>*</span>Data de Validade</label>
								<div class="input-group">
									<div class="input-group-append">
									<span class="input-group-text" id="search_box"><i class="material-icons nav_icon mat_icons"><img src="images/calendar.png"></i></span>
									</div>
									<input type="number" class="form-control" id="cvc" name="cvc" placeholder="Data de Validade" value="">
								</div>
								<span class='form_error' id='span_cvc'></span>  
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="cvv"><span class='star'>*</span>Código de Segurança (CVV)</label>
								<div class="input-group">
									<div class="input-group-append">
									<span class="input-group-text" id="search_box"><i class="material-icons nav_icon mat_icons"><img src="images/card.png"></i></span>
									</div>
									<input type="number" class="form-control" id="cvc" name="cvc" placeholder="CVV" value="" maxlength="3">
								</div>
								<span class='form_error' id='span_cvc'></span>  
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="payement_button">
							<button type="submit" class="btn btn-light btnAction"  name="pay_now" id="submit-btn" onClick="stripePay(event);">Efetuar Pagamento</button>
							 <input type='hidden' name='amount' value="<?php echo $itemAmt?>">
							 <input type='hidden' name='currency_code' value='USD'>
							 <input type='hidden' name='item_name' value="<?php echo $arrSelectedItemData['stream_title']?>">
							 <input type='hidden' name='item_number' value=<?php echo $streamGuid?>>
							 <input type="hidden" name="streamType" value="<?php echo $streamType?>">			
							<input type="hidden" name="menuGuid" value="<?php echo $menuGuid?>">			
							<input type="hidden" name="streamGuid" value="<?php echo $streamGuid?>">
							<button type="submit" class="btn btn-outline-light">Cancelar</button>
						</div>
					</div>
				</form>
				</div>
			</div>
			<!-- End of movie detail-->
		</div>
	</div>
	<!-- End of right container -->

<!-- Start of footer -->	
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>
function cardValidation() {
    var valid = true;
    var name = $('#cardHolderName').val();
    var email = $('#emailAddressCard').val();
    var cardNumber = $('#cardNo').val();
    var month = $('#month').val();
    var year = $('#year').val();
    var cvc = $('#cvc').val();

	console.log(name + " == " + email + " == " + cardNumber + " == " + month + " == " + year + " == " + cvc);

    $("#error-message").html("").hide();

    if (name.trim() == "") {
        valid = false;
    }
    if (email.trim() == "") {
    	   valid = false;
    }
    if (cardNumber.trim() == "") {
    	   valid = false;
    }

    if (month.trim() == "") {
    	    valid = false;
    }
    if (year.trim() == "") {
        valid = false;
    }
    if (cvc.trim() == "") {
        valid = false;
    }

    if(valid == false) {
        $("#error-message").html("All Fields are required").show();
    }

    return valid;
}
//set your publishable key
Stripe.setPublishableKey("<?php echo STRIPE_PUBLISHABLE_KEY; ?>");

//callback to handle the response from stripe
function stripeResponseHandler(status, response) {
    if (response.error) {
        //enable the submit button
        //$("#submit-btn").show();
		$(".loader_background").hide();
        //$( "#loader" ).css("display", "none");
        //display the errors on the form
        $("#error-message").html(response.error.message).show();
    } else {
        //get token id
        var token = response['id'];
        //insert the token into the form
        $("#frmStripePayment").append("<input type='hidden' name='token' value='" + token + "' />");
        //submit form to the server
        $("#frmStripePayment").submit();
    }
}
function stripePay(e) {
    e.preventDefault();
   // var valid = cardValidation();
   
	var valid = validation(1, <?php echo json_encode($valParamArray); ?>);	

    if(valid == true) {
        //$("#submit-btn").hide();
		$(".loader_background").show();
        //$( "#loader" ).css("display", "inline-block");
        Stripe.createToken({
            number: $('#cardNo').val(),
            cvc: $('#cvc').val(),
            exp_month: $('#month').val(),
            exp_year: $('#year').val()
        }, stripeResponseHandler);		

        //submit from callback
        return false;
    }
}
</script>

<?php 
include_once('includes/footer.php');
?>
<!-- End of footer -->