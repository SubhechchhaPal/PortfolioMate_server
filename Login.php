<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<style>
*{
	margin-bottom: 0;
	margin-right: 0;
	margin-top: 0;
	padding-bottom: 0;
	padding-right: 0;
	padding-top: 0;
}
html,body {
	height: inherit;
	background-repeat:!important;
	background-size: contain;
	width: inherit;
	float: none;
}
footer{
	line-height:50px;
	position:relative;
}
.main{
	display: grid;
	grid-rows: auto 1fr auto;
	min-height: 100vh;
	left: 2px;
}
.content{
	padding-bottom: 220px;
	padding-left: 2px;
	padding-top:150px
	}
body {
	background-repeat: no-repeat;
}
</style>
</head>

<body background="image/LOGIN_COVER.jpg" style="background-size: cover; background-repeat: no-repeat;" >
<div class="main">
<div class="content">
  <table width="400" border="0" cellspacing="6", align="right" >
    <tr></tr>
    <tr>
      <th colspan="2" style="font-size:20px; color:white" scope="col">Have an Account?</th>
    </tr>
    <tr>
      <td colspan="2" style="font-size:30px; color:white; text-align:center"><strong>Login</strong></td>
    </tr>
    <tr>
      <td colspan="2"><form method="post" action="">
        <input type="text" placeholder="Username" name="username1" style=" height: 45px;
    width: 87%;
    border-top:thin;
    outline: none;
    border-radius: 30px;
    color: #fff;
    padding: 0 0 0 42px;
    background: rgba(255,255,255,0.1);"/>
        <input type="password" placeholder="Password" name="pass1" style=" height: 45px;
    width: 87%;
    border-top:thin;
    font-size:20px
    outline: none;
    border-radius: 30px;
    color: #fff;
    padding: 0 0 0 42px;
    background: rgba(255,255,255,0.1);
"/>
        <input type="submit" value="login" name="f1" style="
    border: none;
    border-radius: 30px;
    font-size: 20px;
    height: 45px;
    outline: none;
    width: 100%;
    background: rgba(255,255,255,0.7);
    cursor: pointer;
    transition: .3s"/>
      </form></td>
    </tr>


    <tr>
      <td style="font-size:22px; color:white"><input type="checkbox" style="border-radius:30px">
        <label for="check">Remember me</label></td>
      <td style="font-size:22px; color:white">Forgot password ?</td>
    </tr>
    <tr>
      <td style="font-size:22px; color:white">Don't have account?</td>
      <td><a href="#"> <img src="image/contactlanding.png" width="100" height="12"  alt=""/></a></td>
    </tr>
    <tr>
      <td colspan="2" style="font-size:30px; color:white; text-align:center"><strong><a style="text-decoration:none; color:#fff;" href="/PortfolioMate_server/Landing_page.php">Home</a></strong></td>
    </tr>
  </table>
</div>
<footer style="font-size: 22px; font-style: italic; text-align: center; background-color: #BF7E60"><strong> Copyright &copy; 2024 - Anurag & Subhechchha</strong></footer>
</div>
</body>
</html>
<?php
if(isset($_REQUEST["f1"])){
	$name=$_REQUEST['username1'];
	$pw=$_REQUEST['pass1'];
	if($name =='csi'){
		if($pw =='1234'){
		header("location:welcome_page.php");
		#header("location:flash.php");
		}
	else{
		#header("location:welcome_page.php");
		header("location:flash.php");
		}
	}
	else{
		#header("location:welcome_page.php");
		header("location:flash.php");
		}
}	

?>