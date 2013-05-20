<?php
session_start();

include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );

$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
$rows = $c->blog_getcommentlist();//博主收到的评论
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSDN接口演示程序</title>
</head>

<body>
	<!-- 发表文章表单 -->
	<? echo $_SESSION['token']['username'];?>,您好！ 
	<h2 align="left">发表博客文章</h2>
	<form action="" >
		文章标题:<input type="text" name="title" style="width:300px" /><br/>
		文章内容:<textarea name="content" cols="50" rows="10"/></textarea>
		<input type="submit" value="提交"/>
	</form>
	
	<!-- 发表文章提交 -->
	<?php
	if( isset($_REQUEST['title']) || isset($_REQUEST['content'])) {
	
		$data = array('title'=>trim($_REQUEST['title']),'content'=>trim($_REQUEST['content']));
		$ret = $c->blog_savearticle($data);	//发表文章
		if ( isset($ret['error_code']) && $ret['error_code'] > 0 ) {
			echo "<p>发送失败，错误：{$ret['error_code']}:{$ret['error']}</p>";
		} else {
			echo "<p>发送成功</p>url:{$ret['url']}";
		}
	}
	?>

	<!-- 展示blog/getcommentlisto接口返回的数据 -->
	
	
	<br/>博主收到的评论->><br/>
	<?php if(isset($rows['error_code']) && $rows['error_code'] > 0){ ?>
	
		<?php echo "<p>blog/getcommentlisto请求错误：{$rows['error_code']}:{$rows['error']}</p>"?>
	<?php }else{ ?>
	
		<?php foreach ($rows['list'] as $row){?>
		<div style="padding:10px;margin:5px;border:1px solid #ccc">
		文章title:<?php echo $row['article_title']?><br/>
		评论人：<?php echo $row['username']?><br>
		评论时间：<?php echo $row['create_at']?><br>
		评论内容：<?php echo $row['content']?>
		</div>
		<?php }?>
	<?php }?>
	
</body>
</html>
