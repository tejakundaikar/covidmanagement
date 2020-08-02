<!--SELECT person_id, icmr_id, name, contact_number, age, place, symptomatic FROM CloseContact
select * from PositivePatient p, CloseContact c where p.icmr_id=c.icmr_id group by p.icmr_id

select c.name, c.contact_number, c.relation, c.age, c.place, c.symptomatic, c.remarks, p.icmr_id, p.patient_name, p.village, p.district from PositivePatient p, CloseContact c where p.icmr_id=c.icmr_id order by p.district, p.village, p.icmr_id
-->
<?php
use COVID\DataSource;

require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();

$filename = "COVID_CENTER_BED_STATUS".date("Y-m-d").".csv";
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

$arr2=array("","Contact Tracing details", "","Date");

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
	/*fputcsv($fp, $row);
	fputcsv($fp, $header);
	$query1 = "select c.name, c.contact_number, c.relation, c.age, c.place, c.symptomatic, c.remarks from CloseContact c where c.icmr_id=".$row['icmr_id'];

	$result1= mysqli_query($conn, $query1);
	while($row1 = mysqli_fetch_row($result1)) {
		fputcsv($fp, $row1);

	}*/

}

exit;
?>
