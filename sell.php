<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,iniyial-scale=1.0">
<title>Sell Table</title>
<link rel="stylesheet" type="text/css" href="/PortfolioMate_server/style_sell.css">
</head>
<body bgcolor="#173245">
<div class="main">
<div class="content">
<h1 align="center"><strong>Welcome to Sell Table</strong><hr></h1></br>

<button class="open-button" onclick="openForm()">Add new Sell details? Click!</button>
<div class="form-popup" id="myForm">
<form method="POST" action="" class="form-container">
<input type="text" name="insid" placeholder="Instrument Id">
<input type="number" name="sp"  placeholder="Sell Price">
<br><input type="number" name="sroi" placeholder="Rate of Interest">
<input type="number" name="qnt" placeholder="Quantity">
<br><input type="number" name="tcp" placeholder="Transaction Charge Prcntg">
<input type="date" name="sd" placeholder="Sell Dt">
<br><input type="submit" name="sell_form" value="Submit">
</form>
</div>
<script>
function openForm() {
  document.getElementById("myForm").style.display="block";
}
</script>
<h2 style="color:white"><strong> View Table </strong></h2>

<?php
$username = "root";
$password = "";
$database = "portfoliomate";
$mysqli = new mysqli("localhost", $username, $password, $database);
$selectAllSellQuery = "SELECT * FROM SELL";


echo '<table border="2" cellspacing="2" cellpadding="2">
      <tr style="text-align:center">
          <td style="color:white" width="100px"> <font face="Arial">INS ID</font> </td>
          <td style="color:white" width="100px"> <font face="Arial">PRICE</font> </td>
          <td style="color:white" width="100px"> <font face="Arial">INTEREST RATE</font> </td>
 <td style="color:white" width="100px"> <font face="Arial">QNTY</font> </td>
 <td style="color:white" width="110px"> <font face="Arial">TRNSACTION CHRG</font> </td>
 <td style="color:white" width="100px"> <font face="Arial">DATE</font></td>
      </tr>
 </table>';

if ($result = $mysqli->query($selectAllSellQuery)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["INS_ID"];
        $field2name = $row["SELL_PRICE"];
        $field3name = $row["SROI"];
		$field4name = $row["SQNTY"];
		$field5name = $row["SELL_TRN_CHRG_PRCNTG"];
		$field6name = $row["SELL_DATE"];

        echo '<table border="2" cellspacing="2" cellpadding="2">
		<tr style="text-align:center">
                  <td style="color:white" width="100px">'.$field1name.'</td>
                  <td style="color:white" width="100px">'.$field2name.'</td>
                  <td style="color:white" width="100px">'.$field3name.'</td>
                  <td style="color:white" width="100px">'.$field4name.'</td>
                  <td style="color:white" width="110px">'.$field5name.'</td>
				  <td style="color:white" width="100px">'.$field6name.'</td>
		</tr>
 </table>';
    }
    $result->free();
}
?>

<?php
if(isset($_REQUEST["sell_form"])){
$insid=$_REQUEST["insid"];
$sp=$_REQUEST["sp"];
$sroi=$_REQUEST["sroi"];
$qnt=$_REQUEST["qnt"];
$tcp=$_REQUEST["tcp"];
$sd=$_REQUEST["sd"];

$checkID="SELECT INS_ID FROM PURCHASE WHERE INS_ID='$insid'";
$checkDay="SELECT INS_ID FROM PURCHASE WHERE PUR_DATE <= $sd";
$checkQnt="SELECT INS_ID FROM PURCHASE WHERE PQNTY >= $qnt";
$updateQtyInPurchase="UPDATE PURCHASE SET PQNTY=(PQNTY-$qnt) WHERE INS_ID='$insid'";
$enterNewSellQuery="INSERT INTO SELL(INS_ID, SELL_PRICE, SROI, SQNTY, SELL_TRN_CHRG_PRCNTG, SELL_DATE) VALUES('$insid' ,'$sp' ,'$sroi' ,'$qnt' ,'$tcp' ,'$sd')";
$insertInResultall="INSERT INTO RESULTALL SELECT PURCHASE.INS_ID, ((SELL.SELL_PRICE-PUR_PRICE)*$qnt) FROM PURCHASE , SELL WHERE (PURCHASE.INS_ID='$insid' AND SELL.INS_ID='$insid')";
$insertInPnl="INSERT INTO PNL SELECT DISTINCT PURCHASE.INS_ID, PURCHASE.INS_TYPE, PURCHASE.SECTOR, PURCHASE.PUR_PRICE, PURCHASE.PROI, PURCHASE.PQNTY, PURCHASE.BUY_TRN_CHRG_PRCNTG, PURCHASE.PUR_DATE,SELL.SELL_PRICE, SELL.SROI, SELL.SQNTY, SELL.SELL_TRN_CHRG_PRCNTG, SELL.SELL_DATE,RESULTALL.RES FROM PURCHASE,SELL,RESULTALL WHERE (RESULTALL.INS_ID='$insid' AND SELL.INS_ID='$insid' AND PURCHASE.INS_ID='$insid') LIMIT 1";

if((mysqli_num_rows($mysqli->query($checkID))>0) and 
(mysqli_num_rows($mysqli->query($checkQnt))>0)){
	if($mysqli->query($enterNewSellQuery)){
		$mysqli->query($insertInResultall);
		$mysqli->query($insertInPnl);
		$mysqli->query($updateQtyInPurchase);
		header("Location: sell.php");
	}
	else{
		echo '<script>alert("CHECK CONNECTION")</script>';
	}
}
else {
echo '<script>alert("CHECK ID AND QNT FROM PURCHASE")</script>';
}
}

?>
<button style="width:80px; height:30px; font-size:20px; background-color:white;" ><a style="text-decoration: none; color:black;" href="welcome_page.php">Back</a></button>
</div>
<footer style="font-size: 22px; font-style: italic; text-align: center; background-color: #BF7E60"><strong> Copyright &copy; 2024 - Anurag & Subhechchha</strong>
</footer>
</div>
</body>
</html>