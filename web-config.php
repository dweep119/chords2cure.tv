<?php
define('USER_PANEL_TITLE', 'Swig TV');
define('ADMIN_PANEL_TITLE', 'Swig TV | ');
define('DASHBOARD_WELCOME_TXT', 'Welcome Back, Swig Admin Panel');
define('NO_REPLY_EMAIL', 'no-reply@swig.tv');
define('FROM_NAME', 'Swig TV');
define('SIGNATURE', 'Swig TV Team');
define('TOKEN_SALT', 'E0xyJXmAPmeScqWrVLXX2L1ukycGqrtlMpx8gDKhe5wP3QUXNZmuyC9kNCaV');

//define('REQUEST_API_DOMAIN_NAME', 'http://10.1.1.5/vijay/swig');
//define('REQUEST_API_DOMAIN_NAME', 'http://ec2-3-80-207-244.compute-1.amazonaws.com');
define('REQUEST_API_DOMAIN_NAME', 'https://swigappmanager.com');
//define('REQUEST_API_DOMAIN_NAME', 'https://www.swigmanager.com');
//define('REQUEST_API_DOMAIN_NAME', 'http://fusioniprojects.com/swig');

//define('APP_CODE', 'baec645aa66a2913a5dd6cf4b507caa6'); // Purspek
define('APP_CODE', '3e909131cbb1a1f308183c838bc005d7'); // c2c
//define('APP_CODE', '37f8d43af0846cf5744ad76d1cf79ec0'); // OVA
//define('APP_CODE', 'd4839b97d3c450682c3bd94a2275383c'); // PURSPEK BRASIL

//define('MAIN_FEED_URL', REQUEST_API_DOMAIN_NAME.'/feed/v1/'.APP_CODE);
define('MAIN_FEED_URL', REQUEST_API_DOMAIN_NAME.'/feed/v1_1/'.APP_CODE);
define('DETAIL_PAGE_BASE_URL', REQUEST_API_DOMAIN_NAME.'/feed/v1/stream_detail');
define('USER_MODULE_BASE_URL', REQUEST_API_DOMAIN_NAME.'/users');
define('SEARCH_PAGE_BASE_URL', REQUEST_API_DOMAIN_NAME.'/feed/v1/search');
define('TICKET_PAGE_BASE_URL', REQUEST_API_DOMAIN_NAME.'/manageticketcode');
define('PAYMENT_BASE_URL', REQUEST_API_DOMAIN_NAME.'/getpaymentinfo');


// HERE DEFINE CONTS DATE
define('DATE_FORMAT_SPLITTER', '-');
define('SHORT_DATE_FORMAT', 'd-m-Y');
define('LONG_DATE_FORMAT', 'd-m-Y H:i:s');
define('SHORT_MYSQL_DATE_FORMAT', 'Y-m-d');
define('MYSQL_DATE_CONVERSION_STYLE', 'EU');
define('LONG_MYSQL_DATE_FORMAT', 'Y-m-d H:i:s');
define('SET_PROJECT_TIMEZONE', 'Asia/Kolkata');
date_default_timezone_set(SET_PROJECT_TIMEZONE);

// HERE DEFINE COMMON MSG

define('GENERAL_MSG', 'Due to some technical error.');
define('PASSWORD_MSG', 'Password must be have atleast ........');
define('CPASSWORD_MSG', 'Confirm Password must be have atleast ........');
define('PASSWORD_REGEX', "^(?=.{8})(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z\d])(?=.*\d)[-+%#a~!@$^&*?.,-zA-Z\d]+$");


$cpYearInfo = '2020';
if (date('Y') != $cpYearInfo) $cpYearInfo = $cpYearInfo.'-'.date('Y');

define('COPY_RIGHT_INFO', "&copy;CHORDS2CURE TV $cpYearInfo. ALL RIGHTS RESERVED.");

$ARR_GLOBAL_MSG = array('Your password has been updated in our system.' => 'Sua senha foi atualizada em nosso sistema.',
'Usuário não cadastrado.' => 'Desculpe, o endereco de e-mail ou o nome de usuario nao estao presentes em nosso registro.',
'Sorry, user password does not reset.' => 'Desculpe, a senha do usuário nao e redefinida.',
'New password has been sent to your registered email address.' => 'Uma nova senha foi enviada para o seu endereço de e-mail registrado.',
'Sorry, user password does not reset.' => 'Desculpe, a senha do usuario nao e redefinida.',
'Sorry, receiving keys are not valid.' => 'Desculpe, as chaves de recebimento nao sao validas.',
'Your signup process has been completed successfully.' => 'Seu processo de inscriçao foi concluido com sucesso.',
'Desculpe, o código de ativação está errado. Clique em reenviar para receber um novo código por e-mail.' => 'Desculpe, o código de ativaçao da sua conta nao corresponde ao nosso banco de dados. Gere um novo código de ativaçao da conta clicando no link reenviar.',
'Um novo código de ativação foi enviado para seu e-mail cadastrado.' => 'O novo codigo de ativacao da conta foi enviado ao seu endereco de e-mail registrado.',
'Sorry, your record does not match in our database.' => 'Desculpe, seu registro nao corresponde ao nosso banco de dados.',
'Your account has been suspended, please contact to help desk.' => 'Sua conta foi suspensa, entre em contato com o suporte tecnico.',
'You have not completed your sign up process, please complete it or signup with same or different email id' => 'Voce nao concluiu seu processo de inscriçao. Conclua-o ou inscreva-se com o mesmo ou diferente ID de e-mail',
'New user account has been created successfully.' => 'Nova conta de usuario foi criada com sucesso.',
'Sorry, user account does not create.' => 'Desculpe, a conta do usuario nao cria.',
'Stream Code does not match with our db.' => 'O codigo do ticket recebeu seu ID de e-mail registrado.',
'Sorry, user key does not match.' => 'Desculpe, a chave do usuario nao corresponde.',
'Sorry, user key does not receive.' => 'Desculpe, a chave do usuario nao recebe.',
'Sorry, App Id does not exist.' => 'Desculpe, o ID do aplicativo nao existe.',
'Digite um e-mail válido.' => 'Por favor insira o endereço de e-mail valido.',
'Desculpe, este e-mail já está cadastrado. Por favor, tente outro.' => 'Desculpe, o endereco de e-mail ja existe, tente outro.',
'Desculpe, este usuário já está cadastrado. Por favor, tente outro.' => 'Desculpe, o nome de usuario ja existe, tente outro. ',
'Sorry, given email address is not present in our record.' => 'Desculpe, o endereço de email fornecido nao esta presente em nosso registro.',
'Desculpe, Senha incorreta. Tente novamente ou redefina sua senha.' => 'Desculpe, confirme que a senha nao corresponde. ',
'Senha inválida' => 'Desculpe, a senha atual nao corresponde ao nosso registro.',
'Senha ou e-mail inválido.' => 'Desculpe, endereco de e-mail ou senha invalidos. ',
'Desculpe, o código de ativação está errado. Clique em reenviar para receber um novo código por e-mail.' => 'Desculpe, o codigo de ativacao da sua conta nao corresponde ao nosso banco de dados. Gere um novo codigo de ativacao da conta clicando em reenviar link',
'Sorry, invalid email address or password.' => 'Senha ou e-mail invalido.',
'Ticket Code does not match in our system.' => 'Código do ticket n&atilde;o é válido. Por favor verifique.',
'You have already used this ticket code. Please verify' => 'Você já usou este código de ticket. Por favor verifique',
'Invalid ticket Code for this stream, please check with another stream.' => 'Código do ticket n&atilde;o corresponde a este evento. Por favor verifique.',
'Sorry, given email address or username is not present in our record.' => 'Desculpe, o endereco de e-mail ou o nome de usuario nao estao presentes em nosso registro.',
'Sorry, given current password does not match with our record.' => 'Desculpe, a senha atual não corresponde ao nosso registro - verifique.',
'Sorry, email address already exists, please try another.' => 'Desculpe, o endereco de e-mail ja existe, tente outro.',
'Sorry, username already exists, please try another.' => 'Desculpe, o nome de usuario ja existe, tente outro.',
 'New account activation code has been sent to your registered email address.'=> 'O novo código de ativação foi enviado para o endereço de e-mail registrado.',
 'Sorry, your account activation code does not match in our database. Please generate new account activation code by clicking resend link.' => 'Desculpe, o código de ativação da sua conta não corresponde ao nosso banco de dados. Gere um novo código de ativação da conta clicando em Reenviar'

);

$ARR_CHARS = array('á', 'Á', 'ã', 'Ã', 'â', 'Â', 'à', 'À', 'é', 'É', 'ê', 'Ê', 'í', 'Í', 'ó', 'Ó', 'õ', 'Õ', 'ô', 'Ô', 'ú', 'Ú', 'ç', 'Ç');
$ARR_CHARS_HTML_EN = array('&aacute;', '&Aacute;', '&atilde;', '&Atilde;', '&acirc;', '&Acirc;', '&agrave;', '&Agrave;', '&eacute;', '&Eacute;', '&ecirc;', '&Ecirc;', '&iacute;', '&Iacute;', '&oacute;', '&Oacute;', '&otilde;', '&Otilde;', '&ocirc;', '&Ocirc;', '&uacute;', '&Uacute;', '&ccedil;', '&Ccedil;');

$ARR_GLOBAL_MSG = str_replace($ARR_CHARS, $ARR_CHARS_HTML_EN, $ARR_GLOBAL_MSG);
//print_r()
include_once('app-path.php');

##############################DO NOT TOUCH BELOW THIS LINE##############################
ob_start();
@session_start();
?>
