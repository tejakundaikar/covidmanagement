<?php
use COVID\DataSource;

require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();

$filename = "COVID_CENTER_BED_STATUS.csv";
$fp = fopen('php://output', 'w');

$arr = array("SR.NO", 
"NAME",
"MALE BED ", 
"FEMALE BED ", 
"EMERGENCY BED " , 
"TOTAL BED IN HOSPITAL",
"MALE BED OCCUPIED", 
"FEMALE BED OCCUPIED", 
"EMERGENCY BED OCCUPIED", 
"MALE BED AVAILABLE", 
"FEMALE BEDAVAILABLE", 
"EMERGENCY BED AVAILABLE",
"TOTAL BED AVAILABLE",
"MALE BED LIKELY FREE", 
"FEMALE BED LIKELY FREE", 
"EMERGENCY BED LIKELY FREE", 
"DATE");
foreach ($arr as &$value) {
    $header[]= $value;
}

$arr2=array("Report","COVID HOSPITAL BED STATUS");
foreach ($arr2 as &$value2) {
    $title[]= $value2;
}

header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);

fputcsv($fp, $title);
fputcsv($fp, $header);

$query = "select h.ch_id, h.ch_name, c.male_beds, c.female_beds, c.emergency_beds, c.male_beds+c.female_beds+c.emergency_beds as totalbeds , 
o.male_occupied, o.female_occupied, o.emergency_occupied, 
c.male_beds-o.male_occupied as malebedavail, c.female_beds-o.female_occupied as femalebedsavail , c.emergency_beds-o.emergency_occupied as emergencybedavail, c.emergency_beds-o.emergency_occupied+ c.female_beds-o.female_occupied +  c.male_beds-o.male_occupied as totalbedavail,
o.male_likelyfree, o.female_likelyfree, o.emergency_likelyfree, 
 o.date_updated from CovidHospital h, HSBedCapacity c, HSBedOccupancy o where h.ch_id=c.ch_id and c.ch_id=o.ch_id";

$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_row($result)) {
	fputcsv($fp, $row);
}
exit;
?>
