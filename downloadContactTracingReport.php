
<?php
use COVID\DataSource;

require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();

$filename = "Contract Tracing".date("Y-m-d").".csv";
$fp = fopen('php://output', 'w');

$arr = array("Name",
"Contact No", 
"Relation", 
"Emergency",
"age",
"place", 
"symptomatic", 
"remarks");
foreach ($arr as &$value) {
    $header[]= $value;
}

$arr2=array("Contact Tracing details", "","Date");

array_push($arr2,date("Y-m-d"));
foreach ($arr2 as &$value2) {
    $title[]= $value2;
}

$blank=array("","");


header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);

fputcsv($fp, $title);
fputcsv($fp, $blank);

//fputcsv($fp, $header);

$query = "select 'District:', district, 'Village:', village, 'ICMR ID:', icmr_id from PositivePatient where noclosecontacts=1 order by district , village, icmr_id";

$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_row($result)) {
	fputcsv($fp, $row);
	fputcsv($fp, $blank);
	fputcsv($fp, $header);
	$query1 = "select c.name, c.contact_number, c.relation, c.age, c.place, c.symptomatic, c.remarks from CloseContact c where c.icmr_id='".$row[5]."'";

	$result1= mysqli_query($conn, $query1);
	while($row1 = mysqli_fetch_row($result1)) {
		fputcsv($fp, $row1);

	}
fputcsv($fp, $blank);

}

exit;
?>
