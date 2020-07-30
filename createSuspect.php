<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	require 'config.php';
	createSuspect();
}

function createSuspect()
{
	global $conn;
	$data=$_POST['data'];
	$array1=json_decode($data);
	print_r($array1);
	foreach ($array1 as $obj) {
		   $FName=$obj->FName;
		   $LName=$obj->LName;
		   $MobileNumber="9855235644";//$obj->MobileNumber;
		   $travelLocation="Mumbai";
		   $TravelDateTime="h";
		   $TravelMode="flight";
		   $queryToSuspectdetails="INSERT INTO suspectdetails(FName,LName,MobileNumber) VALUES ('".$FName."','".$LName."','".$MobileNumber."');";
		   //mysqli_query($conn, $queryToSuspectdetails) or die(mysqli_error($conn));
		   $resultsetOfSuspectdetails=mysqli_query($conn,"SELECT suspectId FROM suspectdetails where FName='".$FName."' AND LName='".$LName."' AND MobileNumber='".$MobileNumber."'");	  
		   $numOfRowSuspectDetails = mysqli_num_rows($resultsetOfSuspectdetails); 
		   //echo $numOfRowSuspectDetails;
			 if($numOfRowSuspectDetails==1)
			 {
				$SuspectId=mysqli_fetch_assoc($resultsetOfSuspectdetails);
				$suspectIdEntered=$SuspectId['suspectId'];
				//$suspectIdEntered=8;
			 }
		    $queryTotravelhistorydetails="INSERT INTO travelhistorydetails(SuspectId,travelLocation,TravelDateTime,TravelMode) VALUES (".$suspectIdEntered.",'".$travelLocation."','".$TravelDateTime."','".$TravelMode."');";
			mysqli_query($conn, $queryTotravelhistorydetails) or die(mysqli_error($conn));
	  }

	 mysqli_close($conn);  
}
?>