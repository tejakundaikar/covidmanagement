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
            
            $ch_name = "";
            if (isset($column[0])) {
                $ch_name = mysqli_real_escape_string($conn, $column[0]);
            }
            $ch_address = "";
            if (isset($column[1])) {
                $ch_address = mysqli_real_escape_string($conn, $column[1]);
            }
            $contact_no = "";
            if (isset($column[2])) {
                $contact_no = mysqli_real_escape_string($conn, $column[2]);
            }
            $doctor_incharge = "";
            if (isset($column[3])) {
                $doctor_incharge = mysqli_real_escape_string($conn, $column[3]);
            }
           
            
            $sqlInsert = "INSERT into CovidHospital (ch_name,ch_address,contact_no,doctor_incharge)
                   values (?,?,?,?)";
            $paramType = "ssss";
            $paramArray = array(
                $ch_name,
                $ch_address,
                $contact_no,
                $doctor_incharge
            );
            $insertId = $db->insert($sqlInsert, $paramType, $paramArray);
            
            if ($insertId) {
                $type = "success";
                $message = " Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
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
    <h2>Upload Covid Hospital details</h2>

    <div id="response"
        class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
        <?php if(!empty($message)) { echo $message; } ?>
        </div>
    <div class="outer-scontainer">
        <div class="row">

            <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport"
                enctype="multipart/form-data">
                <div class="input-row">
                    <label class="col-md-4 control-label">Choose CSV
                        File</label> <input type="file" name="file"
                        id="file" accept=".csv">
                    <button type="submit" id="submit" name="import"
                        class="btn-submit">Import</button>
                    <br />

                </div>

            </form>

        </div>
         
    </div>

</body>

</html>
