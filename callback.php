<?php
session_start();

include_once( 'config.php' );
include_once( 'csdnapi.class.php' );

$o = new CsdnOAuthV2( WB_AKEY , WB_SKEY );

if (isset($_REQUEST['code'])) {
	$keys = array();
	$keys['code'] = $_REQUEST['code'];
	$keys['redirect_uri'] = WB_CALLBACK_URL;
	try {
		$token = $o->getAccessToken( 'code', $keys ) ;
	} catch (OAuthException $e) {
	}
}

if (!empty($token)) {
	$_SESSION['token'] = $token;
?>
授权完成,<a href="csdnlist.php">进入你的CSDN列表页面</a><br />
<?php
} else {
?>
授权失败。
<?php
}
?>
