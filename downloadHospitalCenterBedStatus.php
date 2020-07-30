<?php
use COVID\DataSource;

require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();

$filename = "HOSPITAL_STAY_BED_STATUS.csv";
$fp = fopen('php://output', 'w');

$arr = array("DATE", "MALE BED OCCUPIED", "FEMALE BED OCCUPIED", "EMERGENCY BED OCCUPIED", "MALE BED LIKELY FREE", "FEMALE BED LIKELY FREE", "EMERGENCY BED LIKELY FREE");
foreach ($arr as &$value) {
    $header[]= $value;
}

header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
fputcsv($fp, $header);

$query = "SELECT date_updated, male_occupied, female_occupied, emergency_occupied, male_likelyfree, female_likelyfree, emergency_likelyfree FROM HSBedOccupancy";

$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_row($result)) {
	fputcsv($fp, $row);
}
exit;
?>
