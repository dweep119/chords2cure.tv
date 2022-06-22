<?php 
include_once('includes/header.php');
include_once('includes/left-navbar.php');
isSessionExpired();

$streamType = getValPostORGet('streamType', 'B');
$menuGuid = getValPostORGet('menuGuid', 'B');
$streamGuid = getValPostORGet('streamGuid', 'B');
$error = getValPostORGet('error', 'B');
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

$isDonatePerView = $arrSelectedItemData['is_donate_per_view'];
$isLiveEventBuyed = $arrSelectedItemData['is_live_event_buyed'];
$streamExpiredOnInUnixTime = $arrSelectedItemData['stream_expired_on_in_unix_time'];
$cUnixTime = getCurrentUnixtime();

$qStr = "?menuGuid=".$selectedMenuGuid."&streamGuid=".$streamGuid."&streamType=".$selectedMenuType; 
$videoPlayerURL = "video-player.php".$qStr;
if ($selectedMenuType == 'D' && $isDonatePerView != 'Y' || ($streamExpiredOnInUnixTime != '' && $streamExpiredOnInUnixTime >= $cUnixTime))
{	
	headerRedirect($videoPlayerURL);
}

$paymentOptns = $arrSelectedItemData['donate_per_view_optns'];
$defaultOptns = $arrSelectedItemData['donate_per_view_selected_optn'];
if ($defaultOptns == '') $defaultOptns = 1;

$isDivHide = "style='display:none;'";
$isFormHideShow = '';
$liveEventStatus = isLiveEventOnGoing($arrSelectedItemData['stream_event_st_date_time_on_utc'], $arrSelectedItemData['stream_event_end_date_time_on_utc']);
if ($liveEventStatus == 'Y' && $error == '' && $streamType == 'E')
{
	$isDivHide = '';
	$isFormHide = "style='display:none;'";
}

$pagerSuccesPageURL = HTTP_PATH."/success.php".$qStr;
$pagerCancelPageURL = HTTP_PATH."/cancel.php".$qStr;
?>
<!-- Start of Page Content  -->
<div id="content">
<?php
include_once('includes/top-navbar.php');
?>
	<!-- For pagar------------->
	<script src="https://assets.pagar.me/checkout/1.1.0/checkout.js"></script>
	<script>
			window.onload=function(){

		var button = document.getElementById('payment')

button.addEventListener('click', function() {
  function handleSuccess (data) {  
	
	//console.log(data.token);
	$(".loader_background").show();
	var strToken = data.token;
	var st = 'completed';
	
	var pageLink = '<?php echo $pagerSuccesPageURL?>'+'&tx='+strToken+'&st='+st;
	console.log(pageLink);
	navigate2(pageLink);
  }

  function handleError (data) {
    console.log(data);
	var pageLink = '<?php echo $pagerCancelPageURL?>';
	console.log(pageLink);
	//navigate2(pageLink);
  }

  var checkout = new PagarMeCheckout.Checkout({
    encryption_key: 'ek_test_diCv3gTl0CmziMBJYHndcY4xWr4oqY',
    success: handleSuccess,
    error: handleError
  });

  checkout.open({
    amount: $('#amtForPaypal').val(),
    createToken: 'true',
    paymentMethods: 'credit_card',
    customerData: false,
    customer: {
      external_id: '#123456789',
      name: '<?php echo $_SESSION["USER_DETAILS"]["USER_NAME"]?>',
      type: 'individual',
      country: 'br',
      email: '<?php echo $_SESSION["USER_DETAILS"]["USER_EMAIL"]?>',
      documents: [
        {
          type: 'cpf',
          number: '71404665560',
        },
      ],
      phone_numbers: ['+5511999998888', '+5511888889999'],
      birthday: '1985-01-01',
    },
    billing: {
      name: 'Ciclano de Tal',
      address: {
        country: 'br',
        state: 'SP',
        city: 'São Paulo',
        neighborhood: 'Fulanos bairro',
        street: 'Rua dos fulanos',
        street_number: '123',
        zipcode: '05170060'
      }
    },
    items: [
      {
        id: '<?php echo $streamGuid?>',
        title: '<?php echo $arrSelectedItemData["stream_title"]?>',
        unit_price: $('#amtForPaypal').val(),
        quantity: 1,
        tangible: false
      }
    ]
  })
});

}
		</script>
	<!-- Start of right container -->
	<div class="container-fluid">
	
		<div class="container_topgap">
		
			<!-- Start of movie detail-->
			<div class="col-md-12">
			<div class="container_spaces">
<?php
					//echo "<pre>";
					//print_r($arrSelectedItemData);
					//echo "</pre>";
?>
				<div class="row">
					<div class="col-sm-6 col-md-4 col-lg-4">
						<img src="<?php echo $arrSelectedItemData['stream_thumbnail'];?>" class="donate_per_view_img">
						
					</div>
					
					<div class="col-sm-6 col-md-8 col-lg-8" <?php echo $isDivHide?> id='divProgress'>
						<div class="movie_detail">
							<h2><?php echo $arrSelectedItemData['stream_title']?></h2>
							<div class="event_progress_text"><?php echo str_replace($ARR_CHARS, $ARR_CHARS_HTML_EN, 'O evento já está em andamento. Você deseja continuar?')?></div>
							<div class="btn_progress">
								<button type="button" onClick="javascript:$('#divProgress').hide();$('#from_div').show();" class="btn btn-light" ><?php echo str_replace($ARR_CHARS, $ARR_CHARS_HTML_EN, ' Sim')?></button>
								<button type="button" class="btn btn-outline-light"><a href="detail-page.php<?php echo $qStr?>"><?php echo str_replace($ARR_CHARS, $ARR_CHARS_HTML_EN, ' Não')?></a></button>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-8 col-lg-8">
					<div <?php echo $isFormHide?> id='from_div'>
					
					<form name='donate_per_view_frm' method="post" id="donate_per_view_frm" action="pay-credit-card.php">
						<div class="donate_per_view">
							<h2><?php echo $arrSelectedItemData['stream_title']?></h2>
							<div class="donation_text"><?php echo str_replace($ARR_CHARS, $ARR_CHARS_HTML_EN, 'Escolha o valor da sua doação. Obrigado!');?></div>
							<div class="donation_box">
								<ul class="donation_list">
<?php
								$cnt = 1;
								$paymentOptns[1] = '2';
								foreach ($paymentOptns AS $optnsVal)
								{
									$str2Check = '';
									if ($defaultOptns == $cnt) $str2Check = "checked='checked'";
									$cnt++;
									$optnsVal = str_replace('$', '', $optnsVal);	
									$optnsVal = $optnsVal;
?>
									<li>
										<label class="radio_container">R$ <?php echo $optnsVal?>
										  <input type="radio" name="paymentOptn" <?php echo $str2Check?> value='<?php echo $optnsVal?>' onclick="javascript:resetPaymentOptions(this);">
										  <span class="checkmark"></span>
										</label>
									</li>
<?php
								}
?>
									<li class="list_block">
										<div class="col_box">
											<div class="radio_amount">
												<label class="radio_container">Digite o valor

												  <input type="radio" name="paymentOptn" value='other' onclick="javascript:resetPaymentOptions(this);">
												  <span class="checkmark"></span>
												</label>
											</div>
											<div class="input-group amount_box">
												<input type="text" class="form-control" id="otherAmt" name='otherAmt' placeholder="Digite o valor" readonly maxlength="10" value='' >
			
											</div>								
											<span class=' form_error' id='otherAmtId'></span>	
										</div>
										
									</li>
									
								</ul>
								
							</div>
							<div class="donate_inlineview"><p><?php echo str_replace($ARR_CHARS, $ARR_CHARS_HTML_EN, 'Para prosseguir, insira os dados referentes ao seu cartão.')?></p>
								<p><?php echo str_replace($ARR_CHARS, $ARR_CHARS_HTML_EN, 'São aceitos apenas cartões brasileiros de portadores de número de CPF.')?></p>
							</div>
							<div class="country_select">
								<select class='form-control' name="countryCode" id="countryCode" onChange="javascript:changeCountryCode(this.value);">						  
								  <option value="br">Brasil</option>
								  <option value="o">Outros</option>
								</select>
								
								<span class='form_error' id ="span_countryCode"></span>
							</div>
							<div class="coupon_code_area">
								<div class="coupon_textcode">CPF</div>
								<div class="coupon_formcontrol">
									<input type="text" class="form-control" placeholder="CPF" name="cpfNo" id="cpfNo" value='' onkeyUp="javascript:makeCPFFormat(this.value);" maxlength="14">
								<span class='form_error' id ="span_cpfNo"></span>
								</div>
								
							</div>
							<div class="pay_btn">
							<div class='cPassMsg'><?php echo @$_SESSION['messageSessionD']?></div>
								<button style='display:none1;' type="button" onClick="javascript:submitFromDonatePerView('donate_per_view_frm','pagerme');" class="btn btn-light " id="paymentBtnSub"><?php echo str_replace($ARR_CHARS, $ARR_CHARS_HTML_EN, 'Doe usando o Cartão')?></button>
								<button style='display:none;' type="button" onClick="javascript:submitFromDonatePerView('donate_per_view_frm','<?php echo PAYPAL_URL?>');" class="btn btn-light btn_yellow"><img src="images/paypal_image.png" class="paypal_icon">Check</button>
								<button style='display:none;' type="button" class="btn btn-light">Pager</button>
								<button id="payment" type='button' style='display:none;'>Pager.me</button>
								
							</div>
						<input type="hidden" name="postAction" value="stripScreen">
						<input type="hidden" name="streamType" value="<?php echo $selectedMenuType?>">			
						<input type="hidden" name="menuGuid" value="<?php echo $menuGuid?>">			
						<input type="hidden" name="streamGuid" value="<?php echo $streamGuid?>">
						
						<!-- Paypal business test account email id so that you can collect the payments. -->
						<input type="hidden" name="business" value="<?php echo PAYPAL_EMAIL?>">			
						<!-- Buy Now button. -->
						<input type="hidden" name="cmd" value="_xclick">			
						<!-- Details about the item that buyers will purchase. -->
						<input type="hidden" name="item_name" value="<?php echo $arrSelectedItemData['stream_title']?>">
						<input type="hidden" name="item_number" value="<?php echo $streamGuid?>">
						<input type="hidden" name="amount" id="amtForPaypal"value="1">
							<input type="hidden" name="currency_code" value="USD">			
						<!-- URLs -->
						<input type='hidden' name='cancel_return' value="<?php echo HTTP_PATH?>/cancel.php<?php echo $qStr?>">
						<input type='hidden' name='return' value='<?php echo HTTP_PATH?>/success.php<?php echo $qStr?>'>
						</form>
						
						</div>
						</div>
						

					</div>
				</div>
			</div>
			</div>
			<!-- End of movie detail-->
				
		</div>
	</div>
	<!-- End of right container -->


<?php 
$strEMsg = str_replace($ARR_CHARS, $ARR_CHARS_HTML_EN, 'Por favor utilize um cartão brasileiro para fazer a doação.');
?>

<script>
function makeCPFFormat(inputBXValue)
{
	var strd = '';
	inputBXValue = inputBXValue.replace(".", "");
	inputBXValue = inputBXValue.replace(".", "");
	inputBXValue = inputBXValue.replace("-", "");
	
	if (inputBXValue != '')
	{		
		var contents = inputBXValue;
		
		var lenStr = contents.length;
		for (j = 0; j < contents.length; j++)
		{	  
			strd = strd+contents[j];
			console.log(contents[j]);	
			if ((j == 2 && lenStr > 3)|| (j == 5 && lenStr > 6))
			{
				strd = strd+'.';
			}
			else if (j == 8 && lenStr > 9)
			{
				strd = strd+'-';
			}
		}
	}
	
	$('#cpfNo').val(strd);
}
function changeCountryCode(optnValue)
{
	if (optnValue == 'o')
	{
		$('#paymentBtnSub').hide();
		$('#span_countryCode').html('<?php echo $strEMsg?>');
	}
	else 
	{
		$('#paymentBtnSub').show();
		$('#span_countryCode').html('');

	}
}
</script>
<!-- Start of footer -->	
<?php 
$_SESSION['messageSessionD'] = '';	
include_once('includes/footer.php');
?>
<!-- End of footer -->