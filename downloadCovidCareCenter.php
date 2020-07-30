<?php
use COVID\DataSource;

require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();

$filename = "toy_csv.csv";
$fp = fopen('php://output', 'w');

$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='app' AND TABLE_NAME='CovidCareCenter'";
$result = mysqli_query($conn,$query);
while ($row = mysqli_fetch_row($result)) {
	$header[] = $row[0];
}	

header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
fputcsv($fp, $header);

$query = "SELECT * FROM CovidCareCenter";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_row($result)) {
	fputcsv($fp, $row);
}
exit;
?>
