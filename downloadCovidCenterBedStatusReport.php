<?php
use COVID\DataSource;

require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();

$filename = "COVID_CENTER_BED_STATUS".date("Y-m-d").".csv";
$fp = fopen('php://output', 'w');

$arr = array("Sr.No", 
"Name",
"Male", 
"Female", 
"Emergency",
"Total",
"Male", 
"Female", 
"Emergency",
"Total",
"Male", 
"Female", 
"Emergency", 
"Updated date");
foreach ($arr as &$value) {
    $header[]= $value;
}

$arr2=array("","COVID CENTER BED STATUS", "","Date");

array_push($arr2,date("Y-m-d"));
foreach ($arr2 as &$value2) {
    $title[]= $value2;
}

$blank=array("","");

$commanheader=array("", "","[......",".........","Capacity",".............]","[......",".........","Available...","............]","[......"," Likely free","....]");
$symbol=array("", "","A","B","C","[A+B+C]","D","E","F","[D+E+F]","G","H","I");
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);

fputcsv($fp, $title);
fputcsv($fp, $blank);
fputcsv($fp, $commanheader);
fputcsv($fp, $header);
fputcsv($fp, $symbol);
$query = "select h.cc_id, h.cc_name,  
c.male_beds, c.female_beds, c.emergency_beds, c.male_beds+c.female_beds+c.emergency_beds as totalbed,
c.male_beds-o.male_occupied as malebedavail, c.female_beds-o.female_occupied as femalebedsavail , c.emergency_beds-o.emergency_occupied as emergencybedavail, c.emergency_beds-o.emergency_occupied+ c.female_beds-o.female_occupied +  c.male_beds-o.male_occupied as totalbedavail,
o.male_likelyfree, o.female_likelyfree, o.emergency_likelyfree, 
 o.date_updated from CovidCareCenter h, CCBedCapacity c, CCBedOccupancy o where h.cc_id=c.cc_id and c.cc_id=o.cc_id";

$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_row($result)) {
	fputcsv($fp, $row);
}
$query1 = "select sum(c.male_beds), sum(c.female_beds), sum(c.emergency_beds), sum(c.male_beds+c.female_beds+c.emergency_beds), sum(c.male_beds-o.male_occupied) as malebedavail, sum(c.female_beds-o.female_occupied) as femalebedsavail , sum(c.emergency_beds-o.emergency_occupied) as emergencybedavail, sum(c.emergency_beds-o.emergency_occupied+ c.female_beds-o.female_occupied +  c.male_beds-o.male_occupied) as totalbedavail from CovidCareCenter h, CCBedCapacity c, CCBedOccupancy o where h.cc_id=c.cc_id and c.cc_id=o.cc_id";

fputcsv($fp, $blank);
$result = mysqli_query($conn, $query1);
while($row1 = mysqli_fetch_row($result)) {
	array_unshift($row1,"","Total: ");
	fputcsv($fp, $row1);
}
exit;
?>
