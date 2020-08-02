<?php 

use COVID\DataSource;

require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();

if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            
            $srno = "";
            if (isset($column[0])) {
                $srno = mysqli_real_escape_string($conn, $column[0]);
            }
            $icmr_id = "";
            if (isset($column[1])) {
                $icmr_id = mysqli_real_escape_string($conn, $column[1]);
            }
            $SRF_id = "";
            if (isset($column[2])) {
                $SRF_id = mysqli_real_escape_string($conn, $column[2]);
			 $SRF_id=trim($SRF_id);
            }
            $Laboratory_Name = "";
            if (isset($column[3])) {
                $Laboratory_Name = mysqli_real_escape_string($conn, $column[3]);
            }
            $laboratory_code = "";
            if (isset($column[4])) {
                $laboratory_code = mysqli_real_escape_string($conn, $column[4]);
            }
            $patient_id = "";
            if (isset($column[5])) {
                $patient_id = mysqli_real_escape_string($conn, $column[5]);
            }
            $patient_name = "";
            if (isset($column[6])) {
                $patient_name = mysqli_real_escape_string($conn, $column[6]);
            }
            $age = "";
            if (isset($column[7])) {
                $age = mysqli_real_escape_string($conn, $column[7]);
            }
            $gender = "";
            if (isset($column[8])) {
                $gender = mysqli_real_escape_string($conn, $column[8]);
            }
            $stateofresidence = "";
            if (isset($column[9])) {
                $stateofresidence = mysqli_real_escape_string($conn, $column[9]);
            }
		  
            $district = "";
            if (isset($column[10])) {
                $district = mysqli_real_escape_string($conn, $column[10]);
            }
            $home_address = "";
            if (isset($column[11])) {
                $home_address = mysqli_real_escape_string($conn, $column[11]);
            }
            $village = "";
            if (isset($column[12])) {
                $village = mysqli_real_escape_string($conn, $column[12]);
            }
            $email_id = "";
            if (isset($column[13])) {
                $email_id = mysqli_real_escape_string($conn, $column[13]);
            }
            $contact_number = "";
            if (isset($column[14])) {
                $contact_number = mysqli_real_escape_string($conn, $column[14]);
            }
            $date_identifed_positive = "";
            if (isset($column[15])) {
                $date_identifed_positive = mysqli_real_escape_string($conn, $column[15]);
            }
            $queryToSuspectdetails="INSERT INTO PositivePatient(icmr_id, SRF_id,Laboratory_Name,laboratory_code,patient_id,patient_name,age,gender,stateofresidence,district,home_address,village,email_id,contact_number,date_identifed_positive,record_date_time) VALUES ('".$icmr_id.
            "','".$SRF_id.
            "','".$Laboratory_Name.
            "','".$laboratory_code.
            "','".$patient_id.
            "','".$patient_name.
            "',".$age.
            ",'".$gender.
            "','".$stateofresidence.
            "','".$district.
            "','".$home_address.
            "','".$village.
            "','".$email_id.
            "','".$contact_number.
            "','".$date_identifed_positive.
		  "','".date("y-m-d h.m.s").
            "');";

		   mysqli_query($conn, $queryToSuspectdetails) or die(mysqli_error($conn));
            
            //$insertId = $db->insert($sqlInsert, $paramType, $paramArray);
           
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
<script src="js/formuploadjs.js"></script>
<link rel="stylesheet" type="text/css" href="css/table.css">

</head>

<body>
    <h2>Import Positive Patient Data</h2>

    <div id="response"
        class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
        <?php if(!empty($message)) { echo $message; } ?>
        </div>
    <div class="outer-scontainer">
        <div>

            <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport"
                enctype="multipart/form-data">
                <div class="input-row">
                    <label >Choose CSV
                        File</label> <input type="file" name="file"
                        id="file" accept=".csv">
                    <button type="submit" id="submit" name="import"
                        class="btn-submit">Import</button>
                    <br />

                </div>

            </form>

        </div>

   <!--            <?php
            $sqlSelect = "SELECT * FROM PositivePatient";
            $result = $db->select($sqlSelect);
            if (! empty($result)) {
                ?>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for ICMR ID.." title="Type in a name">
            <table id='userTable'>
            <thead>
                <tr>
                    <th>ICMR ID</th>
                    <th>SRF id</th>
                    <th>Laboratory Name</th>
                    <th>Laboratory Code</th>
                    <th>Patient  ID</th>
                    <th>Patient Name</th>
                    <th> Age</th>
                    <th>Gender Code</th>
                    <th>State</th>
                    <th>District</th>
                    <th>Address </th>
                    <th>email_id</th>
                    <th>Contact Number</th>
                    <th>Date</th>
                  
                </tr>
            </thead>
<?php
                
                foreach ($result as $row) {
                    ?>
                    
                <tbody>
                <tr>
                    <td><?php  echo $row['icmr_id']; ?></td>
                    <td><?php  echo $row['SRF_id']; ?></td>
                    <td><?php  echo $row['Laboratory_Name']; ?></td>
                    <td><?php  echo $row['laboratory_code']; ?></td>
                    <td><?php  echo $row['patient_id']; ?></td>
                    <td><?php  echo $row['patient_name']; ?></td>
                    <td><?php  echo $row['age']; ?></td>
                    <td><?php  echo $row['gender']; ?></td>
                    <td><?php  echo $row['stateofresidence']; ?></td>
                    <td><?php  echo $row['district']; ?></td>
                    <td><?php  echo $row['home_address']; ?></td>
                    <td><?php  echo $row['email_id']; ?></td>
                    <td><?php  echo $row['contact_number']; ?></td>
                    <td><?php  echo $row['date_identifed_positive']; ?></td>
                   
                </tr>
                    <?php
                }
                ?>
                </tbody>
        </table>
        <?php } ?>
    -->
</div>
</body>

</html>
