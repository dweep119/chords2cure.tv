<?php
include_once('web-config.php'); 
//include_once('../includes/classes/DBQuery.php');
//$objDBQuery = new DBQuery();

include_once('includes/functions/common.php'); 
include_once('includes/functions/form-validation.php');

if (isset($_POST['postAction']))  $accessCase = $_POST['postAction'];
else if (isset($_GET['getAction'])) $accessCase = $_GET['getAction'];

// IF FORM TOKEN IS NOT VALID THEN RETURN ON DEFAULT CASE
if (!empty($_POST['formToken']) && $_POST['formToken'] != $_SESSION['prepareToken']) $accessCase = '';

switch ($accessCase) 
{
	case 'validateTicketCode':
		$msg = '';
		$_POST = trimFormValue(0, $_POST);	
		if (!validateForm($_SESSION['formValidation4Tcode']))
		{
			$frmKeyExcludeArr = array('submitBtn', 'formToken', 'signInEmail', 'signInPassword', 'redirectTo', 'selectedMenuType', 'postAction');
			$dataArr = prepareKeyValue4Msql(0, $_POST, $frmKeyExcludeArr);
			
			// Here set form data 
			$arrFormData = $dataArr;	
			$postAction = $_POST['postAction'];
			$selectedMenuType = $_POST['selectedMenuType'];
			if ($selectedMenuType == 'E') $postAction = 'watchWithTicketCodeForLiveEvent';
			else $postAction = 'watchWithTicketCodeForDonatePerView';
			
			$arrFormData['appId'] = APP_CODE;
			$arrFormData['postAction'] = $postAction;
			$arrFormData['userCode'] = $_SESSION['USER_DETAILS']['USER_CODE'];
			

			$arrRes = sendRequestUsingCURL(0, TICKET_PAGE_BASE_URL, $arrFormData);
			$status = $arrRes['status'];
			
			if ($status == 1)
			{				
				$_SESSION['msgTrue'] = 1;
				$msg = $arrRes['msg'];
			}
			else if ($status == 0)
			{
				$eMsg = array('ticketCode' => $arrRes['msg']);
				echo json_encode($eMsg);				
			
			}
			else
			{
				$eMsg = array('ticketCode' => GENERAL_MSG);
				echo json_encode($eMsg);
			}
			
		}
		else
		{			
			echo json_encode($_SESSION['formMessage']);
			unset($_SESSION['formMessage']);
			
		}
		$_SESSION['messageSession'] = $msg;
		die;
		break;
	
	case 'validateAccountActivationCode':
		$msg = '';
		$_POST = trimFormValue(0, $_POST);	
		if (!validateForm($_SESSION['formValidation4OTP']))
		{
			$frmKeyExcludeArr = array('submitBtn', 'formToken', 'postAction', 'searchFrmID', 'name_signup', 'cpassword', 'redirectTo');
			$dataArr = prepareKeyValue4Msql(0, $_POST, $frmKeyExcludeArr);
			
			// Here set form data 
			$arrFormData = $dataArr;
			$arrFormData['postAction'] = 'validateAccountActivationCode';
			$arrFormData['appId'] = APP_CODE;
			$arrFormData['emailOrusername'] = $_SESSION['USER_DETAILS']['USER_EMAIL'];

			$arrRes = sendRequestUsingCURL(0, USER_MODULE_BASE_URL, $arrFormData);
			$status = $arrRes['status'];
			
			if ($status == 1)
			{				
				$_SESSION['msgTrue'] = 1;

				setUserDetailInSession(0, $arrRes);
				$msg = $arrRes['msg'];
				$msg = '';
			}
			else if ($status == 0)
			{
				$eMsg = array('display_error_on_top_4OTP' => $arrRes['msg']);
				echo json_encode($eMsg);				
			
			}
			else
			{
				$eMsg = array('display_error_on_top_4OTP' => GENERAL_MSG);
				echo json_encode($eMsg);
			}
			
		}
		else
		{			
			echo json_encode($_SESSION['formMessage']);
			unset($_SESSION['formMessage']);
			
		}
		$_SESSION['messageSession'] = $msg;
		die;
		break;

	case 'register':
		$msg = '';
		$_POST = trimFormValue(0, $_POST);	
		if (!validateForm($_SESSION['formValidation']))
		{
			$frmKeyExcludeArr = array('submitBtn', 'formToken', 'postAction', 'searchFrmID', 'name_signup', 'cpassword', 'redirectTo');
			$dataArr = prepareKeyValue4Msql(0, $_POST, $frmKeyExcludeArr);
			
			// Here set form data 
			$arrFormData = $dataArr;
			$arrFormData['postAction'] = 'register';
			$arrFormData['appId'] = APP_CODE;
			$arrFormData['confirmPassword'] = $_POST['cpassword'];
			$arrFormData['name'] = $_POST['name_signup'];

			$arrRes = sendRequestUsingCURL(0, USER_MODULE_BASE_URL, $arrFormData);
			$status = $arrRes['status'];
			
			if ($status == 1)
			{				
				$_SESSION['msgTrue'] = 1;

				/*
					$_SESSION['USER_DETAILS']['USER_CODE'] = $arrRes['data']['userCode'];
					$_SESSION['USER_DETAILS']['USER_NAME'] = $arrRes['data']['name'];
					$_SESSION['USER_DETAILS']['USER_USERNAME'] = $arrRes['data']['username'];
					
					$_SESSION['USER_DETAILS']['USER_ACCOUNT_STATUS'] = $arrRes['data']['accountStatus'];
					$_SESSION['USER_DETAILS']['USER_EMAIL'] = $arrRes['data']['email'];
				*/
				$isSeesionSet = 'N';
				setUserDetailInSession(0, $arrRes, $isSeesionSet);
				$msg = $arrRes['msg'];
				$msg = '';
			}
			else if ($status == 0)
			{
				$eMsg = array('display_error_on_top' => $arrRes['msg']);
				echo json_encode($eMsg);				
			
			}
			else
			{
				$eMsg = array('display_error_on_top' => GENERAL_MSG);
				echo json_encode($eMsg);
			}
			
		}
		else
		{			
			echo json_encode($_SESSION['formMessage']);
			unset($_SESSION['formMessage']);
			
		}
		$_SESSION['messageSession'] = $msg;
		die;
		break;

	case 'checkUserLogin':
		$msg = '';
		$_POST = trimFormValue(0, $_POST);	
		if (!validateForm($_SESSION['formValidation4Sign']))
		{
			$frmKeyExcludeArr = array('submitBtn', 'formToken', 'signInEmail', 'signInPassword', 'redirectTo');
			$dataArr = prepareKeyValue4Msql(0, $_POST, $frmKeyExcludeArr);
			
			// Here set form data 
			$arrFormData = $dataArr;			
			$arrFormData['appId'] = APP_CODE;
			$arrFormData['email'] = $_POST['signInEmail'];
			$arrFormData['password'] = $_POST['signInPassword'];

			$arrRes = sendRequestUsingCURL(0, USER_MODULE_BASE_URL, $arrFormData);
			$status = $arrRes['status'];
			
			if ($status == 1)
			{				
				$_SESSION['msgTrue'] = 1;

				/*
					$_SESSION['USER_DETAILS']['USER_CODE'] = $arrRes['data']['userCode'];
					$_SESSION['USER_DETAILS']['USER_NAME'] = $arrRes['data']['name'];
					$_SESSION['USER_DETAILS']['USER_USERNAME'] = $arrRes['data']['username'];
					
					$_SESSION['USER_DETAILS']['USER_ACCOUNT_STATUS'] = $arrRes['data']['accountStatus'];
					$_SESSION['USER_DETAILS']['USER_EMAIL'] = $arrRes['data']['email'];
				*/
				setUserDetailInSession(0, $arrRes);
				$msg = $arrRes['msg'];
				$msg = '';
			}
			else if ($status == 0)
			{
				$eMsg = array('display_error_on_top_signin' => $arrRes['msg']);
				echo json_encode($eMsg);				
			
			}
			else
			{
				$eMsg = array('display_error_on_top_signin' => GENERAL_MSG);
				echo json_encode($eMsg);
			}
			
		}
		else
		{			
			echo json_encode($_SESSION['formMessage']);
			unset($_SESSION['formMessage']);
			
		}
		$_SESSION['messageSession'] = $msg;
		die;
		break;

	case 'forgotPassword':
		$msg = '';
		$_POST = trimFormValue(0, $_POST);	
		if (!validateForm($_SESSION['formValidation4ForgotPassword']))
		{
			$frmKeyExcludeArr = array('submitBtn', 'formToken', 'signInEmail', 'signInPassword', 'redirectTo');
			$dataArr = prepareKeyValue4Msql(0, $_POST, $frmKeyExcludeArr);
			
			// Here set form data 
			$arrFormData = $dataArr;			
			$arrFormData['appId'] = APP_CODE;
			//$arrFormData['email'] = $_POST['signInEmail'];
			//$arrFormData['password'] = $_POST['signInPassword'];

			$arrRes = sendRequestUsingCURL(0, USER_MODULE_BASE_URL, $arrFormData);
			$status = $arrRes['status'];
			
			if ($status == 1)
			{				

				$eMsg = array('display_error_on_top_fPassword' => $arrRes['msg']);
				echo json_encode($eMsg, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
			}
			else if ($status == 0)
			{
				$eMsg = array('display_error_on_top_fPassword' => $arrRes['msg']);
				echo json_encode($eMsg, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);				
			
			}
			else
			{
				$eMsg = array('display_error_on_top_fPassword' => GENERAL_MSG);
				echo json_encode($eMsg);
			}
			
		}
		else
		{			
			echo json_encode($_SESSION['formMessage']);
			unset($_SESSION['formMessage']);
			
		}
		$_SESSION['messageSession'] = $eMsg;
		die;
		break;
	
	case 'deleteRecordAction':	
		$_POST = trimFormValue(0, $_POST);
		$enckey = $_POST['enckey'];
		$headerRedirectUrl = '../view-all-sub-categories.php?'.$_SESSION['SESSION_QRY_STRING_FOR_SUB_CATE'];
		
		if (!$enckey) $msg = "Please enter all required fields.";		
		else if (!$objDBQuery->getRecordCount(0, $tblName, array($enckeyDBFldName => $enckey))) $msg = "Record does not match with our record.";  
		else if ($enckey)
		{
			$objDBQuery->dropRecord(0, $tblName, array($enckeyDBFldName => $enckey));

			$_SESSION['msgTrue'] = 1;
			$msg = "Record has been permanently deleted successfully.";			
		}	
		$_SESSION['messageSession'] = $msg;
		break;

	// Don't remove this case
	default: 
		$_SESSION['messageSession'] = 'Invalid request type';
		$headerRedirectUrl = '../';

		break;
}

unset($objDBQuery);

if (isset($_SESSION['formValidation'])) unset($_SESSION['formValidation']);

if (isset($headerRedirectUrl)) headerRedirect($headerRedirectUrl);
