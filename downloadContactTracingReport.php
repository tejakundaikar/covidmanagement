<?php
use COVID\DataSource;

require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();

$filename = "contracttracingdetails.csv";
$fp = fopen('php://output', 'w');

$arr = array("ID", "ICMR ID", "NAME", "CONTACT NUMBER", "AGE", "PLACE", "SYMTOMS");
foreach ($arr as &$value) {
    $header[]= $value;
}

header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
fputcsv($fp, $header);

$query = "SELECT person_id, icmr_id, name, contact_number, age, place, symptomatic FROM CloseContact";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_row($result)) {
	fputcsv($fp, $row);
}
exit;
?>
