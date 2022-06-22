function navigate2(pageLink)
{	
	window.location.href = pageLink;
}

function setPopupContent(frmId, title, msg)
{	
	// Here set content to popup
	$("#confirmation_modal_title").html(title);	
	$("#confirmation_modal_msg").html(msg);
	//$("#popBtnTxtDlteReset").html($('#popupBtnTxt'+cntVal).val());	
	$("#confirmation_modal_frmId").val(frmId);	
}

function frmSubmit(frmId)
{
	document.getElementById(frmId).submit(); 
}

function popupSubmtBtnAction()
{
	var frmId = $("#confirmation_modal_frmId").val();
	frmSubmit(frmId);	
}

function linkAction(strCode, stPage)
{	
	console.log(strCode);
	$('#blogCatCodeId').val(strCode);
	$('#stPageID').val(stPage);
	frmSubmit('blogFormID');	
}

function checkDuplicateRecord(fldVal, checkType, enckey, errorContentId)
{   
	if (fldVal.length == 0)
	{
        document.getElementById(errorContentId).innerHTML = "";
        return;
    }
	else
	{
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function()
		{
            if (this.readyState == 4 && this.status == 200)
			{              
				document.getElementById(errorContentId).innerHTML = this.responseText;
            }
        };
		
        xmlhttp.open("POST", "ajex-data.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("fldVal=" + fldVal+"&postAction=checkDuplicateRecord&checkType="+checkType+"&enckey="+enckey);
    }
}

function resetFormErrorMsg()
{	
	$(".form_error").text('');
	$(".display_error_on_top_4OTP").text('');

}

function resetFormValErrorMsg(frmId)
{	
	document.getElementById(frmId).reset();
	$(".form_error").text('');	
}

function copyVal(fldVal, copy2Id)
{
	//alert(fldVal)
	$("#"+copy2Id).val(fldVal);
}

function copyValmore2Input(fldVal, fld1, fld2)
{
	//alert(fldVal)
	$("#"+fld1).val(fldVal);
	$("#"+fld2).val(fldVal);
}

function errorMsgSet(strVal)
{	
	if (strVal != '')
    {
        var strObj = JSON.parse(strVal);
        $.each(strObj, function(keys, values)
        {	
            $('#span_' + keys).html(values);
        });
    }
}

function isJson(str)
{
    try 
    {
        JSON.parse(str);
    }
    catch (e) 
     {
        return false;
    }
    return true;
}

function updateYourProfile(frmId, valParamArray)
{
	 var res = validation(1, valParamArray);	
	if (res)
	{
		frmAction = $('#'+frmId).attr('action');
		frmMethod = $('#'+frmId).attr('method');
		frmData = $('#'+frmId).serialize();
		$(".loader_background").show();	

		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function()
		{
            if (this.readyState == 4 && this.status == 200)
			{              
				$(".loader_background").hide();	
                resText = this.responseText.replace(/^\s+|\s+$/g,"");
				if (resText != '')
				{
					arrKeyVal = resText.split('|~~|');					
					$('#span_'+arrKeyVal[0]).text(arrKeyVal[1]);
				}
				else
				{
					$(".form_error").text('');	
					navigate2(window.location.pathname);           
				}
            }
        };
		
        xmlhttp.open(frmMethod, frmAction, true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(frmData);	
	}
}

function submitPopupFormSignup(trace, frmId, valParamArray)
{	
	resetFormErrorMsg();
	var res = validation(trace, valParamArray);	
	
	if (res)
	{
		$(".loader_background").show();
		frmAction = $('#'+frmId).attr('action');
		frmMethod = $('#'+frmId).attr('method');
		redirectTo = $('#'+frmId).find('#redirectTo').val();
		//alert(redirectTo);
		frmData = $('#'+frmId).serialize();
		
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function()
		{
            if (this.readyState == 4 && this.status == 200)
			{              
				resText = this.responseText;
				console.log(resText);
				$(".loader_background").hide();
				
				if (isJson(resText)){
					console.log(resText);
					errorMsgSet(resText);
				}
				else
				{
					navigate2(redirectTo);	
				}
            }
        };		
        xmlhttp.open(frmMethod, frmAction, true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(frmData);	
	}
}

function submitPopupFormSignin(trace, frmId, valParamArray)
{	
	resetFormErrorMsg();
	var res = validation(trace, valParamArray);	
	
	if (res)
	{
		$(".loader_background").show();
		frmAction = $('#'+frmId).attr('action');
		frmMethod = $('#'+frmId).attr('method');
		redirectTo = $('#'+frmId).find('#redirectToSignIn').val();
		frmData = $('#'+frmId).serialize();
		
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function()
		{
            if (this.readyState == 4 && this.status == 200)
			{              
				resText = this.responseText;
				console.log(resText);
				$(".loader_background").hide();
				
				if (isJson(resText)){					
					errorMsgSet(resText);
				}
				else
				{
					//alert(redirectTo)
					navigate2(redirectTo);	
				}
            }
        };		
        xmlhttp.open(frmMethod, frmAction, true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(frmData);	
	}
}

function submitPopupFormTcode(trace, frmId, valParamArray)
{	
	resetFormErrorMsg();
	var res = validation(trace, valParamArray);	
	
	if (res)
	{
		$(".loader_background").show();
		frmAction = $('#'+frmId).attr('action');
		frmMethod = $('#'+frmId).attr('method');
		redirectTo = $('#'+frmId).find('#redirectTo').val();
		frmData = $('#'+frmId).serialize();
		
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function()
		{
            if (this.readyState == 4 && this.status == 200)
			{              
				resText = this.responseText;
				console.log(resText);
				$(".loader_background").hide();
				
				if (isJson(resText)){					
					errorMsgSet(resText);
				}
				else
				{
					//alert(redirectTo)
					navigate2(redirectTo);	
				}
            }
        };		
        xmlhttp.open(frmMethod, frmAction, true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(frmData);	
	}
}

function submitPopupFormForgotPassword(trace, frmId, valParamArray)
{	
	resetFormErrorMsg();
	var res = validation(trace, valParamArray);	
	
	if (res)
	{
		$(".loader_background").show();
		frmAction = $('#'+frmId).attr('action');
		frmMethod = $('#'+frmId).attr('method');
		redirectTo = $('#'+frmId).find('#redirectTo').val();
		frmData = $('#'+frmId).serialize();
		
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function()
		{
            if (this.readyState == 4 && this.status == 200)
			{              
				resText = this.responseText;
				console.log(resText);
				$(".loader_background").hide();
				
				if (isJson(resText)){	
					resetFormValErrorMsg(frmId);
					errorMsgSet(resText);
				}
				else
				{
					navigate2(redirectTo);	
				}
            }
        };		
        xmlhttp.open(frmMethod, frmAction, true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(frmData);	
	}
}

function submitPopupFormAccActivationCode(trace, frmId, valParamArray)
{	
	resetFormErrorMsg();
	//display_error_on_top_4OTP
	var res = validation(trace, valParamArray);	
	
	if (res)
	{
		$(".loader_background").show();
		frmAction = $('#'+frmId).attr('action');		
		frmMethod = $('#'+frmId).attr('method');
		redirectTo = $('#'+frmId).find('#redirectTo').val();
		frmData = $('#'+frmId).serialize();
		
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function()
		{
            if (this.readyState == 4 && this.status == 200)
			{              
				resText = this.responseText;
				console.log(resText);
				$(".loader_background").hide();
				
				if (isJson(resText)){
					console.log(resText);
					errorMsgSet(resText);
				}
				else
				{
					navigate2(redirectTo);	
				}
            }
        };		
        xmlhttp.open(frmMethod, frmAction, true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(frmData);	
	}
}

function autoFillsTxtBox(txtBxId, clsName)
{
    var data = $("."+clsName).val();   
    //alert(txtBxId);
    var dataArray = data.split('|~~|');
	//alert(dataArray);
    var arrData = new Array();
    
    for(i = 0; i < dataArray.length; i++)
    {
        arrData[i] = dataArray[i];
    }
    
    $("#"+txtBxId).autocomplete({source: arrData, autoFocus: true});
   // alert(arrData);
}

function setSignInRedirction(rURL)
{
	document.getElementById('redirectToSignIn').value= rURL;
}

function resetPaymentOptions(eleObj)
{
	radioBxVal = eleObj.value;
	//alert(radioBxVal);
	if (radioBxVal == 'other')
	{
		//$("#otherAmt").
		$('#otherAmt').attr('readonly', false);
	}
	else 
	{
		$('#otherAmt').val('');
		$('#otherAmt').attr('readonly', true);
	}
}

function submitFromDonatePerViewBackup(frmName, frmAction)
{
	$('#otherAmtId').html('');
	
	var radioValue = $("input[name='paymentOptn']:checked").val();	
	radioValue = radioValue.replace("$", "");
	
	if (radioValue == 'other')
	{
		radioValue = $('#otherAmt').val();
	}
	
	radioValue = radioValue.replace(/^\s+|\s+$/g,"");
	if (radioValue != '')
	{
		 $(".loader_background").show();
		 $('#amtForPaypal').val(radioValue);
		$('#'+frmName).attr('action', frmAction);
		
		frmSubmit(frmName);
	}
	else
	{
		document.getElementById("otherAmtId").style.color = "#ff0000";
		$('#otherAmtId').html('Entrar, por favor Digite o valor');
	}
	
	
}

function submitFromDonatePerView(frmName, frmAction)
{
	$('#otherAmtId').html('');
	$('#span_cpfNo').html('');
	
	var radioValue = $("input[name='paymentOptn']:checked").val();	
	radioValue = radioValue.replace("$", "");
	$('#span_cpfNo').html('');
	var cpfNo = $('#cpfNo').val();
	cpfNo = cpfNo.replace(".", "");
	cpfNo = cpfNo.replace(".", "");
	cpfNo = cpfNo.replace("-", "");
	
	if (cpfNo == '')
	{
		$('#span_cpfNo').html('Por favor, insira CPF');
		//return false;
	}
	else if (cpfNo.length < 11)
	{
		$('#span_cpfNo').html('Digite CPF valido');
	}
	//var lenStr = ;
	if (radioValue == 'other')
	{
		radioValue = $('#otherAmt').val();
	}

	if (radioValue < 2)
	{
		$('#otherAmtId').html('Por favor, outro valor maior que igual a 2');
	}
	
	radioValue = radioValue.replace(/^\s+|\s+$/g,"");
	if (radioValue != '' && radioValue > 1 && cpfNo != '' && cpfNo.length == 11)
	{		 
		 $('#amtForPaypal').val(radioValue * 100);
		if (frmAction == 'pagerme')
		{
			$("#payment").click();
		}
		else
		{
			$(".loader_background").show();
			$('#'+frmName).attr('action', frmAction);
			frmSubmit(frmName);
		}
		
		
	}
	else if (radioValue == '')
	{
		document.getElementById("otherAmtId").style.color = "#ff0000";
		$('#otherAmtId').html('Entrar, por favor Digite o valor');
	}
	
	
}

$('#youtube_plyer_x_btn_id').click(function(e) {
    e.preventDefault();
    let src = $('.video_player_box').children('iframe').attr('src');
	$('.video_player_box').children('iframe').attr('src', '');
	$('.video_player_box').children('iframe').attr('src', src);
});