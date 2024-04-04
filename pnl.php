<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,iniyial-scale=1.0">
<title>P&N Table</title>
<link rel="stylesheet" type="text/css" href="/PortfolioMate_server/style_pnl.css">
</head>
<body bgcolor="#173245">
<div class="main">
<div class="content">
<div class="view">
<h1 align="center"><strong>Welcome to P&L Table</strong><hr></h1></br>
<?php 
$username = "root"; 
$password = ""; 
$database = "portfoliomate"; 
$mysqli = new mysqli("localhost", $username, $password, $database); 
$selectAllPurchaseQuery = "SELECT * FROM PNL";

echo '
<h2 style="color:white"><strong> View Table </strong></h2>
<table border="2" cellspacing="2" cellpadding="2"> 
      <tr style="text-align:center"> 
          <td style="color:white" width="100px"> <font face="Arial">INS ID</font> </td> 
          <td style="color:white" width="100px"> <font face="Arial">INS TYPE</font> </td> 
          <td style="color:white" width="100px"> <font face="Arial">SECTOR</font> </td> 
          <td style="color:white" width="100px"> <font face="Arial">BUY PRICE</font> </td> 
          <td style="color:white" width="100px"> <font face="Arial">BUY INTEREST RATE</font> </td>
		  <td style="color:white" width="100px"> <font face="Arial">HOLDING QNTY</font> </td>
		  <td style="color:white" width="100px"> <font face="Arial">BUY TRNSACTION CHRG</font> </td>
		  <td style="color:white" width="100px"> <font face="Arial">BUY DATE</font> </td>
		  <td style="color:white" width="100px"> <font face="Arial">SELL PRICE</font> </td> 
          <td style="color:white" width="100px"> <font face="Arial">SELL INTEREST RATE</font> </td>
		  <td style="color:white" width="100px"> <font face="Arial">SELL QNTY</font> </td>
		  <td style="color:white" width="100px"> <font face="Arial">SELL TRNSACTION CHRG</font> </td>
		  <td style="color:white" width="100px"> <font face="Arial">SELL DATE</font> </td>
		  <td style="color:white" width="100px"> <font face="Arial">RESULT</font> </td>
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
        $field9name = $row["SELL_PRICE"];
        $field10name = $row["SROI"]; 
		$field11name = $row["SQNTY"];
		$field12name = $row["SELL_TRN_CHRG_PRCNTG"];
		$field13name = $row["SELL_DATE"];
		$field14name = $row["RES"];
        echo '<table border="2" cellspacing="2" cellpadding="2">
		 <tr style="text-align:center">  
                  <td style="color:white" width="100px">'.$field1name.'</td> 
                  <td style="color:white" width="100px">'.$field2name.'</td> 
                  <td style="color:white" width="100px">'.$field3name.'</td> 
                  <td style="color:white" width="100px">'.$field4name.'</td> 
                  <td style="color:white" width="100px">'.$field5name.'</td>
				  <td style="color:white" width="100px">'.$field6name.'</td>
				  <td style="color:white" width="100px">'.$field7name.'</td>
				  <td style="color:white" width="100px">'.$field8name.'</td>
				  <td style="color:white" width="100px">'.$field9name.'</td> 
                  <td style="color:white" width="100px">'.$field10name.'</td> 
                  <td style="color:white" width="100px">'.$field11name.'</td> 
                  <td style="color:white" width="100px">'.$field12name.'</td> 
                  <td style="color:white" width="100px">'.$field13name.'</td>
				  <td style="color:white" width="100px">'.$field14name.'</td>
              </tr>
			  </table>';
			 
    }
    $result->free();
}
$totalProfit="SELECT SUM(res)as soc FROM PNL";
$result=$mysqli->query($totalProfit);
$allPnlCount="SELECT * FROM PNL";
if((mysqli_num_rows($mysqli->query($allPnlCount))>0)){
if(($result->num_rows) > 0){
	while($row=$result->fetch_assoc()){
		echo"<h3>Total Profit=".$row["soc"]."</h3><br>";
	}
}
}
else{
	echo"<h3>0 results in Profit and loss table ,add a new record</h3>";
}
?>
</div>
<button class="open-button" onclick="openForm()">Want to delete record?Click?</button>
<div class="form-popup" id="myForm">
<form method="POST" action=""class="form-container">
<input type="text" name="dinsid" placeholder="Instrument Id">
<br><input type="submit" name="delete_form" value="Submit" >
</form>
</div>
<script>
function openForm() {
  document.getElementById("myForm").style.display="block";
}
</script>
<?php
if(isset($_REQUEST["delete_form"])){
$dinsid=$_REQUEST["dinsid"];
$findInPnl="SELECT * FROM PNL WHERE INS_ID='$dinsid'";
$deleteFromPnl="DELETE FROM PNL WHERE INS_ID = '$dinsid'";
$deleteFromPurchase="DELETE FROM PURCHASE WHERE INS_ID = '$dinsid'";
$deleteFromSell="DELETE FROM SELL WHERE INS_ID = '$dinsid'";
$deleteFromResultAll="DELETE FROM RESULTALL WHERE INS_ID = '$dinsid'";
if((mysqli_num_rows($mysqli->query($findInPnl))>0)){
	if($mysqli->query($deleteFromPnl)){
		if($mysqli->query($deleteFromPurchase)){
			if($mysqli->query($deleteFromSell)){
				if($mysqli->query($deleteFromResultAll)){
			 header("Location: pnl.php");
				}
			}	
            echo '<script>alert("RECORD DELETED")</script>';
		}
	}
}else {echo '<h4 style="color:red">There are no records with this INS_ID in Profit and loss table.</h4>';}
}
?>
<br><button style="width:80px; height:30px; font-size:20px; background-color:white;" ><a style="text-decoration: none; color:black;" href="welcome_page.php">Back</a></button>
</div>
<footer style="font-size: 22px; font-style: italic; text-align: center; background-color: #BF7E60"><strong> Copyright &copy; 2024 - Anurag & Subhechchha</strong>
</footer>
</div>
</body>
</html>