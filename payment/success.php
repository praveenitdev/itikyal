<?php
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="08c4eaXQ9V";

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
                  }
	else {	  

        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

         }
		 $hash = hash("sha512", $retHashSeq);
		 
		INCLUDE ("config.sql");
$dkey=mysqli_real_escape_string($con, $_POST['key']);
$dhash=mysqli_real_escape_string($con, $_POST['hash']);
$dtrnid=mysqli_real_escape_string($con, $_POST['txnid']);
$damount=mysqli_real_escape_string($con, $_POST['amount']);
$daddcharges=mysqli_real_escape_string($con, $_POST['additionalCharges']);
$dfirstname=mysqli_real_escape_string($con, $_POST['firstname']);
$demail=mysqli_real_escape_string($con, $_POST['email']);
$dphone=mysqli_real_escape_string($con, $_POST['phone']);
$dproductinfo=mysqli_real_escape_string($con, $_POST['productinfo']);
$dstatus=mysqli_real_escape_string($con, $_POST['status']);



$sql="INSERT INTO successdonations (tKey,hash,trnid,amount,addcharges,firstname,email,phone,productinfo,status) VALUES ('$dkey','$dhash','$dtrnid','$damount','$daddcharges','$dfirstname','$demail','$dphone','$dproductinfo','$dstatus')";

	if(mysqli_query($con,$sql)){
	}
else { echo "opps somthing wrong:".mysqli_error($con);
} 
mysqli_close($con);
		
		
		
		
		
		
		
		
		
       if ($hash != $posted_hash) {
	        echo "<center>";
	        echo "<div id='donate'>";
          echo "<img src='images/oops.png' align='right'></img></div>";

	       echo "<h2><font color='red'>Invalid Transaction. Please try again</font></h2></center>";
		   }
	   else {
          echo "<center><div id='donate'>";
          echo "<img src='images/pdone.png' align='center'></img></div>";
  		
          echo "<h3> Thank You Mr.".$firstname." Your Transaction status is <h2><font color='green'> ". $status .".</font></h2></h3>";
          echo "<h4>Your Transaction ID for this transaction is <h3><font color='orange'>".$txnid.".</font></h3></h4>";
          echo "<h4>We have received a payment of Rs. " . $amount . ". Thank You for Donating.</h4></center>";
           
		   }         
?>	