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

            $cc_name = "";
            if (isset($column[0])) {
                $cc_name = mysqli_real_escape_string($conn, $column[0]);
            }
            $cc_address = "";
            if (isset($column[1])) {
                $cc_address = mysqli_real_escape_string($conn, $column[1]);
            }
            $contact_no = "";
            if (isset($column[2])) {
                $contact_no = mysqli_real_escape_string($conn, $column[2]);
            }
            $doctor_incharge = "";
            if (isset($column[3])) {
                $doctor_incharge = mysqli_real_escape_string($conn, $column[3]);
            }


            $sqlInsert = "INSERT into CovidCareCenter (cc_name,cc_address,contact_no,doctor_incharge)
                   values (?,?,?,?)";
            $paramType = "ssss";
            $paramArray = array(
                $cc_name,
                $cc_address,
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
//code for manual insert in database
else if (isset($_POST["insert"])) {
    $cc_name = $_POST["Covid_CARE_Name"];
    $cc_address = $_POST['Addres'];
    $contact_no = $_POST['Contact_Number'];
    $doctor_incharge = $_POST['Doctor_incharge'];

    $sqlInsert_maual = "INSERT into 
                            CovidCareCenter 
                             (
                                cc_name,
                                cc_address,
                                contact_no,
                                doctor_incharge
                             )
                            values 
                             (
                               '" . $cc_name . "', '" 
                                 . $cc_address . "', '" 
                                 . $contact_no . "', '" 
                                 . $doctor_incharge .
                               "' )";
    $insertId = mysqli_query($conn,$sqlInsert_maual);
    if ($insertId) {
        $type = "success";
        $message = " Insertion sucessful";
    } else {
        $type = "error";
        $message = "Problem in Insertion";
    }
}

if (isset($_GET['del'])){

	$id = $_GET['del'];
	mysqli_query($conn, "DELETE FROM CovidCareCenter WHERE cc_id=$id");
	$_SESSION['message'] = "CovidCareCenter deleted!"; 
	header('location: covid_care_center_data_upload.php');

}
?>
<!DOCTYPE html>
<html>

    <head>
        <script src="js/formuploadjs.js"></script>

        <link rel="stylesheet" type="text/css" href="css/table.css">

    </head>

    <body>
        <h2>Upload COVID Care Center details</h2>

        <div id="response"
             class="<?php
             if (!empty($type)) {
                 echo $type . " display-block";
             }
             ?>">
                 <?php
                 if (!empty($message)) {
                     echo $message;
                 }
                 ?>
        </div>
        <div class="outer-scontainer">
            <div class="row">
                <h3>Upload from file (Bulk upload)</h3>

                <form class="form-horizontal" action="" method="post"
                      name="frmCSVImport" id="frmCSVImport"
                      enctype="multipart/form-data">
                    <div class="input-row">
                        <label class="col-md-4 control-label">Choose CSV
                            File</label> <input type="file" name="file"
                                            id="file" accept=".csv">
                        <button type="submit" id="insert" name="insert"
                                ">Import</button>
                        <br />

                    </div>

                </form>

            </div>
            <div>
                <h3>Maual Upload </h3>
                <table id='userInsertTable'>
                    <tr>
                        <td>COVID Care Center Name: </td>
                        <td>Address </td>
                        <td>Contact Number: </td>
                        <td>Doctor Incharge: </td>
                        <td> </td>

                    </tr>
                    <tr>
                        <!-- form inser/upload code
                        // refrence1: http://www.shotdev.com/php/php-mysql/php-mysql-add-insert-edit-delete-on-same-form/
                        // refrence 2: https://gist.github.com/sashaca2/3785796
                        -->
                    <form class=" " action="" method="post"
                          name="" id="insert_or_update"
                          enctype="multipart/form-data">
                        <td><input type="text" name="Covid_CARE_Name" value="<?php echo'COVID Care Name'; ?>"></td>
                        <td><input type="text" name="Addres" value="<?php echo'Adress'; ?>"></td>
                        <td> <input type="text" name="Contact_Number" value="<?php echo'Phone Number'; ?>"></td>
                        <td> <input type="text" name="Doctor_incharge" value="<?php echo'Doctor Incharge'; ?>"></td>
                        <td> <button type="submit" id="submit" name="insert"
                                     class="btn-submit">Insert</button></td>
                    </form>
                    </tr>
                </table>   
            </div>

            <div>
                <h3>Search/Edit/Delete Record </h3>

                <?php
                $sqlSelect = "SELECT * FROM CovidCareCenter";
                $result = $db->select($sqlSelect);
                if (!empty($result)) {
                    ?>
                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Covid Care Center.." title="Type in a name">
                    <a href="downloadCovidCareCenter.php">Download All records in CSV file</a>
                    <table id='userTable'>
                        <thead>
                            <tr>

                                <th>COVID Care Center Name</th>
                                <th>Address </th>
                                <th>Contact Number</th>
                                <th>Doctor Incharge</th>
                                <th>Edit</th>
                                <th>Delete</th>


                            </tr>
                        </thead>
                        <?php
                        foreach ($result as $row) {
                            ?>

                            <tbody>
                                <tr>

                                    <td><?php echo $row['cc_name']; ?></td>
                                    <td><?php echo $row['cc_address']; ?></td>
                                    <td><?php echo $row['contact_no']; ?></td>
                                    <td><?php echo $row['doctor_incharge']; ?></td>

                                    <td><a href="uploadCovidCareCenter.php?edit=<?php echo $row['cc_id']; ?>" ><img src="images/edit.png"></a><!--<input type="image" src="images/edit.png" name="edit_id"/>--></td>
                                    <td><a href="uploadCovidCareCenter.php?del=<?php echo $row['cc_id']; ?>" ><img src="images/delete.png"></a><!--<input type="image" src="images/delete.png" name="delete_id"/>--></td>

                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                <?php } ?>

            </div>
        </div>

    </body>

</html>
