<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,iniyial-scale=1.0">
<title>Purchase Table</title>
<link rel="stylesheet" type="text/css" href="/PortfolioMate_server/style_pur.css">
</head>
<body bgcolor="#173245">
<div class="main">
<div class="content">
<h1 align="center"><strong>Welcome to Purchase Table</strong><hr></h1></br>
<button class="open-button" onclick="openForm()">Add new Purchase details? Click!</button>
<div class="form-popup" id="myForm">
<form method="POST" action=""class="form-container">
<input type="text" name="insid" placeholder="Instrument Id">
<input type="text" name="type" placeholder="Instrument type">
<br><input type="text" name="sector" placeholder="Sector">
<input type="number" name="pp" placeholder="Purchase Price">
<br><input type="number" name="proi" placeholder="Rate of Interest">
<input type="number" name="qnt" placeholder="Quantity">
<br><input type="number" name="tcp" placeholder="Transaction Charge Prcntg">
<input type="date" name="pd" placeholder="Purchase Dt">
<br><input type="submit" name="purchase_form" value="Submit" >
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
$selectAllPurchaseQuery = "SELECT * FROM PURCHASE";
echo '<table border="2" cellspacing="2" cellpadding="2">
      <tr style="text-align:center">
          <td style="color:white" width="100px"> <font face="Arial">INS ID</font> </td>
          <td style="color:white" width="70px"> <font face="Arial">INS TYPE</font> </td>
          <td style="color:white" width="70px"> <font face="Arial">SECTOR</font> </td>
          <td style="color:white" width="70px"> <font face="Arial">PRICE</font> </td>
          <td style="color:white" width="90px"> <font face="Arial">INTEREST RATE</font> </td>
 <td style="color:white" width="70px"> <font face="Arial">QNTY</font> </td>
 <td style="color:white" width="100px"> <font face="Arial">TRNSACTION CHRG</font> </td>
 <td style="color:white" width="100px"> <font face="Arial">DATE</font> </td>
      </tr>
 </table>';

if ($result = $mysqli->query($selectAllPurchaseQuery)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["INS_ID"];
        $field2name = $row["INS_TYPE"];
        $field3name = $row["SECTOR"];
        $field4name = $row["PUR_PRICE"];
        $field5name = $row["PROI"];
		$field6name = $row["PQNTY"];
		$field7name = $row["BUY_TRN_CHRG_PRCNTG"];
		$field8name = $row["PUR_DATE"];

        echo '<table border="2" cellspacing="2" cellpadding="2">
        <tr style="text-align:center">
                  <td style="color:white" width="100px">'.$field1name.'</td>
                  <td style="color:white" width="70px">'.$field2name.'</td>
                  <td style="color:white" width="70px">'.$field3name.'</td>
                  <td style="color:white" width="70px">'.$field4name.'</td>
                  <td style="color:white" width="90px">'.$field5name.'</td>
				  <td style="color:white" width="70px">'.$field6name.'</td>
				  <td style="color:white" width="100px">'.$field7name.'</td>
				  <td style="color:white" width="105px">'.$field8name.'</td>
        </tr>
 </table>';
    }
    $result->free();
}
?>

<?php
if(isset($_REQUEST["purchase_form"])){
$insid=$_REQUEST["insid"];
$type=$_REQUEST["type"];
$sector=$_REQUEST["sector"];
$pp=$_REQUEST["pp"];
$proi=$_REQUEST["proi"];
$qnt=$_REQUEST["qnt"];
$tcp=$_REQUEST["tcp"];
$pd=$_REQUEST["pd"];

$enterNewPurchaseQuery="INSERT INTO PURCHASE(INS_ID, INS_TYPE, SECTOR, PUR_PRICE, PROI, PQNTY, BUY_TRN_CHRG_PRCNTG, PUR_DATE)VALUES('$insid' ,'$type' ,'$sector' ,'$pp' ,'$proi' ,'$qnt' ,'$tcp' ,'$pd')";
$findInPurchase="SELECT * FROM PURCHASE WHERE INS_ID='$insid'";
$updateInPurchase="UPDATE PURCHASE SET INS_TYPE='$type', SECTOR='$sector', PROI='$proi', BUY_TRN_CHRG_PRCNTG='$tcp', PUR_DATE='$pd' WHERE INS_ID='$insid'";
$updateQnty="UPDATE PURCHASE SET PQNTY=(PQNTY + $qnt) WHERE INS_ID='$insid'";
$updatePrice="UPDATE PURCHASE SET PUR_PRICE=((PUR_PRICE*PQNTY + $pp*$qnt)/(PQNTY + $qnt)) WHERE INS_ID='$insid'";

if(mysqli_num_rows($mysqli->query($findInPurchase))){
	if($mysqli->query($updateInPurchase)){
		if($mysqli->query($updatePrice)){ #price updated to weighted avg.
			if($mysqli->query($updateQnty)){
				header("Location:purchase.php");
			}
		}
	}
}
else{
$mysqli->query($enterNewPurchaseQuery);
header("Location:purchase.php");
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