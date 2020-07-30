<html>
<?php
//Data fro request
$id=$_GET['id'];

//Config file
include('config.php');

//$resultset=mysqli_query($conn,'SELECT * FROM suspectdetails where suspectId='.$id);
$resultset=mysqli_query($conn,'SELECT FName, LName, MobileNumber FROM suspectdetails');
while($row=mysqli_fetch_assoc($resultset))
{
	$json_array[]=$row;
}

$result=json_encode($json_array);
//print_r($result);
print_r("__________________________________");
	$array1=json_decode($result);
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
?>
</html>