<?php
if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '10.1.1.5')
{
	if ($_SERVER['SERVER_NAME'] == '10.1.1.5') define('HTTP_PATH', 'http://10.1.1.5/vijay/c2c');
	else define('HTTP_PATH', 'http://localhost/c2c');
	
	define('HARD_PATH', $_SERVER['DOCUMENT_ROOT'] . '/vijay/c2c');
	//ini_set('display_errors', 0);
	define("STRIPE_SECRET_KEY", "sk_test_UVr3XuAWo7VQwEjx4eoKuVWV00AByqnp3C");
	define("STRIPE_PUBLISHABLE_KEY", "pk_test_PqrDj6YAeDUGOpbBOfwVLahN00cmajOQfi");
	
	//define("PAYPAL_EMAIL", "fusioni@business.example.com");
	define("PAYPAL_EMAIL", "info@codexworld.com");
	define("PAYPAL_URL", 'https://www.sandbox.paypal.com/cgi-bin/webscr');
} 
else
{
	//define('HTTP_PATH', 'http://ec2-3-80-207-244.compute-1.amazonaws.com');
	//define('HARD_PATH', $_SERVER['DOCUMENT_ROOT'] . '');
	define('HTTP_PATH', 'http://www.chords2cure.tv');
	
	define('HARD_PATH', $_SERVER['DOCUMENT_ROOT'] . 'c2c');
	ini_set('display_errors', 0);

	define("STRIPE_SECRET_KEY", "sk_test_UVr3XuAWo7VQwEjx4eoKuVWV00AByqnp3C");
	define("STRIPE_PUBLISHABLE_KEY", "pk_test_PqrDj6YAeDUGOpbBOfwVLahN00cmajOQfi");
	
	define("PAYPAL_EMAIL", "info@codexworld.com");
	define("PAYPAL_URL", 'https://www.sandbox.paypal.com/cgi-bin/webscr');

}
?>