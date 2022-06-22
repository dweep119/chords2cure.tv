<?php
function generatePassword($value)
{
	return MD5(TOKEN_SALT . $value);
}

function replaceDataInList($string, $list)
{
	$find = array_keys($list);
	$replace = array_values($list);
	return str_ireplace($find, $replace, $string);
}

function randomMD5()
{
	return MD5(TOKEN_SALT . time() . mt_rand());
}

function trimFormValue($trace, $array)
{
	$rtnArr = array_map('trim', $array);
	if ($trace)
	{
		echo "<pre><-------------Input array value-------------><br>";
		print_r($array);
		echo "<-------------Output array value-------------><br>";
		print_r($rtnArr);		
		echo "</pre>";
		die;
	}
	return $rtnArr;
}

function prepareKeyValue4Msql($trace, $array, $keyExcludeArr)
{
	$rtnArr = array();
	
	foreach ($array AS $key => $value)
	{
		if (!in_array($key, $keyExcludeArr)) $rtnArr[$key] = $value;
	}
	
	if ($trace)
	{
		echo "<pre><-------------Input array value-------------><br>";
		print_r($array);
		echo "<-------------Output array value-------------><br>";
		print_r($rtnArr);		
		echo "</pre>";
		die;
	}
	return $rtnArr;

}

function checkTimeFormat($timeFormat)
{
	$timeFormat = trim($timeFormat);

	if (strstr($timeFormat, ':'))
	{
		list($hr,$min) = @explode(":", $timeFormat);

		if (@is_numeric($hr) && @is_numeric($min)) 
		{
			if (strlen($hr) == 2 && strlen($min) == 2) 
			{
				return 1;
			}
		}
	}

	return 0;
}

function makeRandNo6Digit()
{
	return rand(100000, 999999);
}

function unixtime64($str)
{
   date_default_timezone_set("UTC");
   $dateTime = new DateTime($str);
   return $dateTime->format("U");
}

function getCurrentUnixtime()
{
	date_default_timezone_set("UTC");
	return date('U');
}

function getExpiredDate($interval)
{
	date_default_timezone_set("UTC");
	$readableCurrDt = date(LONG_MYSQL_DATE_FORMAT);
	$readableExtendedDt = date(LONG_MYSQL_DATE_FORMAT, strtotime("$readableCurrDt $interval"));
	
	return array('readableExtendedDt' => $readableExtendedDt, 'unixtimeExtended' => unixtime64($readableExtendedDt), 'readableCurrDt' => $readableCurrDt, 'unixtimeCurrnt' => unixtime64($readableCurrDt));
}

function convertDateTimeSpecificTimeZone($dt, $tz1 = 'America/New_York', $df = 'Y-m-d H:i:s', $tz2 = 'UTC')
{
	$rtnStr = '';
	$dt = trim($dt);
	if ($dt != '')
	{
		$date = date_create($dt, timezone_open($tz1));
		date_timezone_set($date, timezone_open($tz2));
		$rtnStr = $date->format($df);
	}

	return $rtnStr;
}

function mysqlDate($value)
{
	if ($value) {
		if(MYSQL_DATE_CONVERSION_STYLE == 'EU') list($dd, $mm, $yy) = explode(DATE_FORMAT_SPLITTER, $value);
		else if(MYSQL_DATE_CONVERSION_STYLE == 'US') list($mm, $dd, $yy) = explode(DATE_FORMAT_SPLITTER, $value);
		return "$yy-$mm-$dd"; // Obtain the final date
	}
}

function getRealIpAddr()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP']))
	{				
		// Check ip from share internet
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} 
	else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	{   
		// Check if ip is pass from proxy
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} 
	else
	{
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}


function headerRedirect($url)
{
	ob_start();
	header('location:'.$url);
	exit;
}

function viewState($viewStateArray, $mode)
{
	if ($mode) 
	{
		foreach ($viewStateArray as $key => $value) 
		{
			$_SESSION['session_' . $key] = $value;
		}
	} 
	else 
	{
		foreach ($viewStateArray as $key => $value) 
		{
			unset($_SESSION['session_' . $key]);
		}
	}
}

function getTimestamp($value, $dateFormat)
{
	if ($value)
	{
		return @date($dateFormat,strtotime($value));
	}
}

function allowedFIleExten($indexName, $arrAllowedExtension = array('png', 'jpg', 'jpeg' , 'gif'))
{
	$rten = 0;
	if (!empty($_FILES[$indexName]['name']))
	{
		$fileName = trim($_FILES[$indexName]['name']);	
		$arrPathInfo = pathinfo($fileName);
		$fileExten = strtolower($arrPathInfo['extension']);
		if (!in_array($fileExten, $arrAllowedExtension)) $rten = 1;
	}
	return $rten;
}

function fileUpload($trace, $indexName, $dirLocation, $strConcatSym = '_')
{
	$newFileName = '';
	$filePath = HARD_PATH . "/uploads/".$dirLocation;	

	if (!empty($_FILES[$indexName]['name']))
	{
		$newFileName = time(). $strConcatSym .substr(randomMD5(), 1, 7). $strConcatSym .str_replace(array(' ',  '-', '__'), array('_', '_', '_'),  $_FILES[$indexName]['name']);
		if (move_uploaded_file($_FILES[$indexName]['tmp_name'], $filePath .'/'. $newFileName)) chmod($filePath . '/'.$newFileName, 0777);		
	}

	if ($trace)
	{
		print_r($_FILES);
		echo "New File Name: $newFileName<br>File Path: $filePath/".$newFileName;
		die;
	}
	return $newFileName;
}

function unlinkFile($trace, $fileName, $dirLocation)
{	
	if ($trace)
	{
		echo "File Name: $fileName<br>File Path: $filePath/".$fileName;
		die;
	}

	if ($fileName)
	{
		$filePath = HARD_PATH . "/uploads/".$dirLocation;
		@chmod($filePath . '/'.$fileName, 0777);		
		@unlink($filePath . '/'.$fileName);		
	}
}

function showSessionMessage()
{
	if (isset($_SESSION['messageSession'])) 
	{
		$ARR_GLOBAL_MSG = $GLOBALS['ARR_GLOBAL_MSG'];
		$_SESSION['messageSession'];
		unset($_SESSION['messageSession']);
		unset($_SESSION['msgTrue']);
	}
}
//sendEmail('', '', '', '', '', '');
function sendEmail($to, $subject, $body, $fromName, $from, $format = '')
{
	$headers = '';
	$url = HTTP_PATH . '/images/mail-header.jpg';

	if($format=='HTML')
	{
		$headers .= "Content-type: text/html; charset=iso-8859-1\n";
	}

	$headers .= "From: $fromName <$from>" . "\n";
	$headers .= "Cc: " . "\n";
	$headers .= "Bcc: " . "\n";
	//<img src='{$url}'>
	$body = "<center>
				<table width='100%' cellpadding='0' cellspacing='0' bgcolor='#EEE' style='color: #000000; text-align:left; border: 1px solid #ddd;'>
				<tr>
					<td style='padding:15px 15px 15px 15px; font-size: 12px; color: #000000; line-height:1.3; text-align:justify; font-family: Arial,Helvetica,sans-serif;'>" . $body . "<td>
				</tr>
				</table>
			</center>";

	if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '10.1.1.5')
	{
		$str = "<font face='arial' size='2'><b>To Email:</b> $to<br><br><b>Subject:</b> $subject<br><br><b>From:</b> $fromName<br><br><b>From Email:</b> $from<br><br>$body</font>";
		$mailDir = HARD_PATH . '/mail';

		$fp = fopen($mailDir . '/mail_' . date('U') . '_' . rand(10000, 99999) . '.html', 'w');
		fwrite($fp, $str);
		fclose($fp); 
	} 
	else
	{
		if (php_uname("n") == 'ip-172-31-48-252')
		{
			//include_once('../smtp.php');
			//print_r(error_get_last());
			sendEmailUsingSES($to, $subject, $body, $fromName, $from);	
			//echo "error_get_last";			
			//die;
			
		}
		else 
		{
			$success = mail($to, $subject, $body, $headers, '-f ' . NO_REPLY_EMAIL);
		}
		return $success;
	}
}

function sendEmailUsingSES1($recipient, $subject, $bodyHtml, $senderName, $sender = 'sssameer2012@gmail.com')
{
	// is still in the sandbox, this address must be verified.
	//$recipient = 'vijay@fusionitechnolgies.com';
	//$recipient = 'vijay.desh@hotmail.com';

	$usernameSmtp = 'AKIAZ5LKOGSKFDJXUAXX';
	$passwordSmtp = 'BOQvXvWca+gO9OIHbj/CXhSqn3jrIKak3/p0OM5xX6gX';
	$host = 'email-smtp.us-east-1.amazonaws.com';
	$port = 587;

	$sender = 'sssameer2012@gmail.com';	
	//$subject = 'Amazon SES test (SMTP interface accessed using PHP)';

	// The plain-text body of the email
	$bodyText =  "";

	$mail = new PHPMailer(true);

	try {
		// Specify the SMTP settings.
		$mail->isSMTP();
		$mail->setFrom($sender, $senderName);
		$mail->Username   = $usernameSmtp;
		$mail->Password   = $passwordSmtp;
		$mail->Host       = $host;
		$mail->Port       = $port;
		$mail->SMTPAuth   = true;
		$mail->SMTPSecure = 'tls';
	  //  $mail->addCustomHeader('X-SES-CONFIGURATION-SET', $configurationSet);

		// Specify the message recipients.
		$mail->addAddress($recipient);
		//$mail->addAddress('vkvia6@gmail.com');
		// You can also add CC, BCC, and additional To recipients here.

		// Specify the content of the message.
		$mail->isHTML(true);
		$mail->Subject    = $subject;
		$mail->Body       = $bodyHtml;
		//$mail->AltBody    = $bodyText;
		$mail->Send();
		return true;
	} catch (phpmailerException $e) {
		echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
	} catch (Exception $e) {
		echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
	}
}

function prepareEmailFormat($traceArr, $emailFormatInfoArr, $objDBQuery, $appCode, $fname = '', $emailORUsername = '', $password = '', $accountActivationCode = '', $eventOrStreamTitle = '', $ticketCode = '', $timing = '')
{
	$emailBody = $emailFormatInfoArr[0]['body'];
	$emailSubject = $emailFormatInfoArr[0]['subject'];
	$appInfoArr = $objDBQuery->getRecord($traceArr[0], array('appNoreplyEmail', 'appFromEmailTxt', 'appEmailSignature'), 'tbl_apps', "appCode = '$appCode'");
	
	$appNoreplyEmail  = $appInfoArr[0]['appNoreplyEmail'];
	$appFromEmailTxt = $appInfoArr[0]['appFromEmailTxt'];
	$appEmailSignature = $appInfoArr[0]['appEmailSignature'];

	$arrData = array();
	$arrData['[FNAME]'] = $fname;
	$arrData['[EMAIL_ID]'] = $emailORUsername;
	$arrData['[PASSWORD]'] = $password;
	$arrData['[EMAIL_SIGNATURE]'] = $appEmailSignature;
	$arrData['[EVENT_TIMING]'] = $timing;
	$arrData['[TICKET_CODE]'] = $ticketCode;
	$arrData['[EVENT_TITLE]'] = $eventOrStreamTitle;
	
	$arrData['[ACCOUNT_ACTIVATION_CODE]'] = $accountActivationCode;

	$strRtnBody = str_replace(array_keys($arrData), array_values($arrData), $emailBody);
	$arrRtn = array('strBody' => $strRtnBody, 'emailSubject'=> $emailSubject, 'appNoreplyEmail' => $appNoreplyEmail, 'appFromEmailTxt' => $appFromEmailTxt);
	
	if ($traceArr[1])
	{
		echo "<pre>";
		
		print_r($emailFormatInfoArr);
		print_r($appInfoArr);
		print_r($arrRtn);
		die;
	}
	return $arrRtn;

}

function makeEmailStructure($accessCase, $to, $fname, $username = '', $password = '', $newEmail = '')
{
	switch ($accessCase) 
	{
		case 'accountPasswordReset':
				$body = "Hello ".$fname.",<br><br>Your password has been reset in our record.<br><br>
				Please note your new login information for future use:<br><br>Username: ".$username."<br>Password: ".$password."<br><br>
				<a href='".HTTP_PATH."/swig' target='_blank'>Click here to login</a><br><br>Thanks,<br>".SIGNATURE;

				sendEmail($to, 'Your Account Password Reset', $body, FROM_NAME, NO_REPLY_EMAIL, 'HTML');
				break;	

		case 'forgotPassword':
				$body = "Hello ".$fname.",<br><br>Your password has been reset in our record.<br><br>
				Please note your new login information for future use:<br><br>Username: ".$username."<br>Password: ".$password."<br><br>
				<a href='".HTTP_PATH."/swig' target='_blank'>Click here to login</a><br><br>Thanks,<br>".SIGNATURE;
				
				sendEmail($to, 'Your Account Password Reset', $body, FROM_NAME, NO_REPLY_EMAIL, 'HTML');
				break;
				
		case 'changePassword':
				$body = "Hello ".$fname.",<br><br>Your profile password has been changed in our record.<br><br>
				Please note your new login information for future use:<br><br>Username: ".$username."<br>Password: ".$password."<br><br>
				<a href='".HTTP_PATH."/swig' target='_blank'>Click here to login</a><br><br>Thanks,<br>".SIGNATURE;
				
				sendEmail($to, 'Your Profile Password Changed', $body, FROM_NAME, NO_REPLY_EMAIL, 'HTML');
				break;		

		case 'updateYourEmail':
				$body = "Hello ".$fname.",<br><br>Your email address has been changed in our record.<br><br>
				Your new email address is ".$_SESSION['userDetails']['email']."<br><br>
				<a href='".HTTP_PATH."/swig' target='_blank'>Click here to login</a><br><br>Thanks,<br>".SIGNATURE;
				
				sendEmail($to, 'Your Email Address Changed', $body, FROM_NAME, NO_REPLY_EMAIL, 'HTML');
				break;		

		case 'updateAdminEmail':
				$body = "Hello ".$fname.",<br><br>Your email address has been changed in our record.<br><br>
				Your new email address is ".$newEmail."<br><br>
				<a href='".HTTP_PATH."/swig' target='_blank'>Click here to login</a><br><br>Thanks,<br>".SIGNATURE;
				
				sendEmail($to, 'Your Email Address Changed', $body, FROM_NAME, NO_REPLY_EMAIL, 'HTML');
				break;		

		case 'addAdminAccount':
				$body = "Hello ".$fname.",<br><br>Your account has been created successfully.<br><br>
				Please note your login information for future use:<br><br>Username: ".$username."<br>Password: ".$password."<br><br>
				<a href='".HTTP_PATH."/swig' target='_blank'>Click here to login</a><br><br>Thanks,<br>".SIGNATURE;
				
				sendEmail($to, 'Your Account Information', $body, FROM_NAME, NO_REPLY_EMAIL, 'HTML');
				break;
	}

}

# Search value in multidimentional array
function inArrayMulti($findValue, $arrayName, $strict = false)
{
	foreach ($arrayName as $item) 
	{
		if (($strict ? $item === $findValue : $item == $findValue) || (is_array($item) && inArrayMulti($findValue, $item, $strict)))
		{
			return true;
		}
	}
	return false;
}

function getValPostORGet($indexName, $method = 'P')
{
	$rtenVal = '';
	if (!empty($_POST[$indexName]) && ($method == "P" || $method == "B")) $rtenVal = trim($_POST[$indexName]);
	else if (!empty($_GET[$indexName]) && ($method == "G" || $method == "B")) $rtenVal = trim($_GET[$indexName]);
	return $rtenVal;
}

function responses($trace, $arrData)
{
	if ($trace)
	{
		echo "<pre><-------------Input array value-------------><br>";
		print_r($arrData);
		die;
	}

	header('Content-Type: application/json');
	echo json_encode($arrData);
}

function getContents()
{
	parse_str(file_get_contents("php://input"), $vars);
	return $vars;
}

function statusClsActive($frmVal, $statusVal)
{
	$rtnStr = "";
	if (strtolower($frmVal) == strtolower($statusVal)) $rtnStr = "class='media_active'";
	return $rtnStr;
}

function checkBxSeleted($ckBxVal, $selectedVal)
{
	$rtnStr = "";
	if (strtolower($ckBxVal) == strtolower($selectedVal)) $rtnStr = "checked";
	echo $rtnStr;
}

function makeDropDownFromDB($dropDownName, $optionListArray, $optionValueDbFld, $optionTextDbFld, $selectedOptionValue, $mode = '', $style = '', $event = '')
{
	$str  = "<select name = '$dropDownName' id = '$dropDownName' $style $event $mode>";
	$str .= "<option value=''>Please Select</option>";

	if (is_array($optionListArray))
	{
		$numOfRows = count($optionListArray);
		for ($i = 0; $i < $numOfRows; $i++) {

			if ($optionListArray[$i][$optionValueDbFld] == $selectedOptionValue)
			{
				$str .= "<option value='" . $optionListArray[$i][$optionValueDbFld] . "' selected>" . htmlspecialchars($optionListArray[$i][$optionTextDbFld]) . "</option>";
			} 
			else
			{
				$str .= "<option value='" . $optionListArray[$i][$optionValueDbFld] . "'>" . htmlspecialchars($optionListArray[$i][$optionTextDbFld]) . "</option>";
			}
		}
	}

	$str .= "</select>";
	echo $str;
}

function makeDropDown($dropDownName, $optionValueArray, $optionTextArray, $selectedOptionValue, $mode = '', $style = '', $event = '', $hideShowPlzSelect = 'N')
{
	$str  = "<select name = '$dropDownName' id = '$dropDownName' $style $event $mode>";
	if ($hideShowPlzSelect != 'Y') $str .= "<option value=''>Please Select</option>";

	if(is_array($optionValueArray)) {
		$numOfRows = count($optionValueArray);

		for ($i = 0; $i < $numOfRows; $i++)
		{
			if ($optionValueArray[$i] == $selectedOptionValue) 
			{
				$str .= "<option value='" . $optionValueArray[$i] . "' selected>" . htmlspecialchars($optionTextArray[$i]) . "</option>";
			} 
			else 
			{
				$str .= "<option value='" . $optionValueArray[$i] . "'>" . htmlspecialchars($optionTextArray[$i]) . "</option>";
			}
		}
	}

	$str .= "</select>";
	echo $str;
}

function stripslashesHtmlChars($str)
{
	return  stripslashes(htmlspecialchars(trim($str)));
}

function checkPageAccessPermission($codeStr)
{
	if ($codeStr == '')
	{
		$_SESSION['messageSession'] = UNAUTHORIZED_MSG;	
		headerRedirect('dashboard.php');
	}
}

function cors()
{

    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }
}

//$arrPost = array('streamGuid' => '9e30cb13b42a16792c1d135c4544c1b9','userCode' => '017f685c22cf94a3bad48471ea29ffb3','appId' => 'baec645aa66a2913a5dd6cf4b507caa6','streamDuration' => '2','postAction' => 'saveStreamDuration');


function sendRequestUsingCURL($trace, $url, $arrPost = array())
{
	$curl = curl_init();
		
	curl_setopt_array($curl, array(
	  CURLOPT_URL => $url,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLINFO_HEADER_OUT => true,
	  CURLOPT_SSL_VERIFYPEER => false,	 
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1
	));

	if (!empty($arrPost))
	{
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl, CURLOPT_POSTFIELDS, $arrPost);
	}

	$res = curl_exec($curl);
	$arrRes = json_decode($res , true);
	if ($trace)
	{
		echo curl_error($curl);
		echo "<pre>";
		$info = curl_getinfo($curl);
		print_r($info);
		
		echo "<br><-----------Response------------------><br>";
		print_r($arrRes);
		die;
	}
	return $arrRes;
	curl_close($curl);
}


function parseMainFeedArrDataArchive_without_subcat($trace, $arrData, $selectedMenuGuid = '')
{
	$selectedMenuType = 'L';
	$selectedMenuName = '';
	//$selectedMenuGuid = '';

	$arrMenuData = array();	
	$arrMenuSelectedItemData = array();	

	if ($arrData['app']['status'] == 1)
	{
	
		foreach ($arrData['app']['menus'] as $arrMenuDataInfo)
		{
			$menuGuid = $arrMenuDataInfo['menu_guid'];
			$menuType = $arrMenuDataInfo['menu_type'];
			$menuName = $arrMenuDataInfo['menu_name'];
			$isStartupMenu = $arrMenuDataInfo['is_startup_menu'];
			
			$arrMenuData[] = array(
				'menu_guid' => $menuGuid, 
				'menu_name' => $menuName, 
				'menu_type' => $menuType, 
				'is_startup_menu' => $isStartupMenu
			);
			if (($selectedMenuGuid == '' && $isStartupMenu == 'Y') || $menuGuid == $selectedMenuGuid)
			{
				$arrMenuSelectedItemData = $arrMenuDataInfo['streams'];				
				$selectedMenuGuid = $menuGuid;
				$selectedMenuType = $menuType;
				$selectedMenuName = $menuName;
			
			}
		}
	}

	if ($trace)
	{
		echo "<pre>";
		echo "-----------------Selected Menu Data----------------------------<br>";
		print_r($arrMenuSelectedItemData);
		echo "<br><br>----------------Menu Data----------------------------<br>";
		print_r($arrMenuData);

		echo "<br><br>----------------Response Data----------------------------<br>";
		print_r($arrData);
		die;

	}

	return array('arrMenuData' => $arrMenuData, 'arrMenuSelectedItemData' => $arrMenuSelectedItemData, 'selectedMenuGuid' => $selectedMenuGuid, 'selectedMenuType' => $selectedMenuType, 'selectedMenuName' => $selectedMenuName);
}

function parseMainFeedArrData($trace, $arrData, $selectedMenuGuid = '')
{
	$selectedMenuType = 'L';
	$selectedMenuName = '';
	//$selectedMenuGuid = '';

	$arrMenuData = array();	
	$arrMenuSelectedItemData = array();	
	$arrMenuFeaturedData = array();	

	if ($arrData['app']['status'] == 1)
	{
	
		foreach ($arrData['app']['menus'] as $arrMenuDataInfo)
		{
			$menuGuid = $arrMenuDataInfo['menu_guid'];
			$menuType = $arrMenuDataInfo['menu_type'];
			$menuName = $arrMenuDataInfo['menu_name'];
			$isStartupMenu = $arrMenuDataInfo['is_startup_menu'];
			
			$arrMenuData[] = array(
				'menu_guid' => $menuGuid, 
				'menu_name' => $menuName, 
				'menu_type' => $menuType, 
				'is_startup_menu' => $isStartupMenu
			);
			if (($selectedMenuGuid == '' && $isStartupMenu == 'Y') || $menuGuid == $selectedMenuGuid)
			{
				$arrMenuSelectedItemData = $arrMenuDataInfo['subcategories'];				
				$arrMenuFeaturedData = $arrMenuDataInfo['featured_streams'];				
				$selectedMenuGuid = $menuGuid;
				$selectedMenuType = $menuType;
				$selectedMenuName = $menuName;
			
			}
		}
	}

	if ($trace)
	{
		echo "<pre>";
		echo "-----------------Selected Menu Data----------------------------<br>";
		print_r($arrMenuSelectedItemData);
		echo "<br><br>----------------Menu Data----------------------------<br>";
		print_r($arrMenuData);

		echo "<br><br>----------------Response Data----------------------------<br>";
		print_r($arrData);
		die;

	}

	return array('arrMenuData' => $arrMenuData, 'arrMenuSelectedItemData' => $arrMenuSelectedItemData, 'selectedMenuGuid' => $selectedMenuGuid, 'selectedMenuType' => $selectedMenuType, 'selectedMenuName' => $selectedMenuName, 'arrMenuFeaturedData' => $arrMenuFeaturedData);
}

function parseDetailPgFeedArrData($trace, $arrData)
{
	$selectedMenuType = 'L';	
	$selectedMenuName = '';
	$selectedMenuGuid = '';
	
	$arrMenuData = array();	
	$arrSelectedItemData = array();	
	$arrLatestItemsData = array();	

	if ($arrData['app']['status'] == 1)
	{	
		$selectedMenuGuid = $arrData['app']['all_streams']['menu_guid'];
		$selectedMenuType = $arrData['app']['all_streams']['menu_type'];
		$selectedMenuName = $arrData['app']['all_streams']['menu_name'];	
		
		
		$arrLatestItemsData = $arrData['app']['all_streams']['latest_streams'];
		$arrSelectedItemData = $arrData['app']['all_streams']['current_page_stream'];
	}

	if ($trace)
	{
		echo "<pre>";
		echo "-----------------Selected Stream Data----------------------------<br>";
		print_r($arrSelectedItemData);
		echo "<br><br>----------------Latest Stream Data----------------------------<br>";
		print_r($arrLatestItemsData);

		echo "<br><br>----------------Response Data----------------------------<br>";
		print_r($arrData);
		die;

	}

	return array('arrSelectedItemData' => $arrSelectedItemData, 'arrLatestItemsData' => $arrLatestItemsData, 'selectedMenuGuid' => $selectedMenuGuid, 'selectedMenuType' => $selectedMenuType, 'selectedMenuName' => $selectedMenuName);
}

function printDuration($strDuration)
{
	$strDuration = trim($strDuration);
	if ($strDuration == '') $strDuration = "0 Min";
	else if ($strDuration < 2) $strDuration = "$strDuration Min";
	else $strDuration = "$strDuration Mins";

	return $strDuration;
}

function displayNA($str)
{
	$str = trim($str);
	if (trim($str) == '') $str = "NA";
	return $str;
}

function redirect2Home()
{
	headerRedirect(HTTP_PATH);
}

function setUserDetailInSession($trace, $userInfoArr, $isSeesionSet = 'Y')
{
	if ($isSeesionSet == 'Y')
	{
		$_SESSION['USER_DETAILS']['USER_CODE'] = $userInfoArr['data']['userCode'];
		$_SESSION['USER_DETAILS']['USER_NAME'] = $userInfoArr['data']['name'];
		$_SESSION['USER_DETAILS']['USER_USERNAME'] = $userInfoArr['data']['username'];

		$_SESSION['USER_DETAILS']['USER_ACCOUNT_STATUS'] = $userInfoArr['data']['accountStatus'];
	}
	$_SESSION['USER_DETAILS']['USER_EMAIL'] = $userInfoArr['data']['email'];

	if ($trace)
	{
		print_r($userInfoArr);
		echo "In Seesion Data";
		print_r($_SESSION['USER_DETAILS']);
		die;
	}
}

function isSessionExpired()
{
	if (empty($_SESSION['USER_DETAILS']['USER_CODE'])) redirect2Home();
}

function getEventStaus($stUnixTime, $enUnixTime, $strStatus)
{
	$currUnixTime = getCurrentUnixtime();
	// E: Event has Expired, P: Event is progressing,
	// F: Event is upcomming, C: Event does not schedule now
	// 
	if ($stUnixTime == '' || $enUnixTime == '') $rtn = 'C';
	else if (($strStatus == 'Y' || $strStatus == '') && $stUnixTime <= $currUnixTime && $enUnixTime >= $currUnixTime) $rtn = 'P';
	else if (($strStatus == 'Y' || $strStatus == '') && $stUnixTime > $currUnixTime && $enUnixTime > $currUnixTime) $rtn = 'F';
	else if (($strStatus == 'Y' || $strStatus == '') && $stUnixTime < $currUnixTime && $enUnixTime < $currUnixTime) $rtn = 'E';
	

	return $rtn; 
}

function isLiveEventOnGoing($stDateTime, $enDateTime)
{
	$rtn = 'N';
	$stUnixTime = unixtime64($stDateTime);
	$enUnixTime = unixtime64($enDateTime);	
	$currUnixTime = getCurrentUnixtime();
	if ($stUnixTime <= $currUnixTime && $enUnixTime >= $currUnixTime) $rtn = 'Y';

	return $rtn;
}