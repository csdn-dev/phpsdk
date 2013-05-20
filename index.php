<?php
session_start();

include_once( 'config.php' );
include_once( 'csdnapi.class.php' );

$o = new CsdnOAuthV2( WB_AKEY , WB_SKEY );

$code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSDN PHP SDK V2版 Demo</title>
</head>

<body>
	<!-- 授权按钮 -->
    <p><a href="<?=$code_url?>">用CSDN帐号登录</a></p>

</body>
</html>
