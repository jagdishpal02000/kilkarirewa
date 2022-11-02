<?php
session_start();
if(!isset($_SESSION['type']) || $_SESSION['type'] !='admin') header('location:../index.php');

require('../resources/functions/helpers.php');

$all_patients_data = exportAllData();
$file_name = "kilkarirewa_".date('d-m-Y')

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Data</title>
</head>

<body>

    <table id="dataTable" class="table table-hover border" style="overflow: auto;">
        <thead>
            <tr>
            <th scope="col">Sr.No.</th>
            <th scope="col">NAME</th>
            <th scope="col">HUSBAND NAME</th>
            <th scope="col">AADHAR</th>
            <th scope="col">VILLAGE</th>
            <th scope="col">MOBILE</th>
            <th scope="col">BLOCK</th>
            <th scope="col">SHC</th>
            <th scope="col">CITY</th>
            <th scope="col">ANM</th>

            <th scope="col">ANM Mobile</th>
            <th scope="col">ANM Email</th>

            <th scope="col">AASHA</th>
            <th scope="col">LMP</th>
            
            <th scope="col">AC1</th>
            <th scope="col">AC2</th>
            <th scope="col">AC3</th>
            <th scope="col">AC4</th>
            <th scope="col">DELIVERY</th>
            <th scope="col">ADDRESS</th>
            <th scope="col">APH</th>
            <th scope="col">ECLAMPSIA</th>
            <th scope="col">PIH</th>
            <th scope="col">ANAEMIA</th>
            <th scope="col">OBSTRUCTED LABOR</th>
            <th scope="col">PPH</th>
            <th scope="col">LSCS</th>
            <th scope="col">CONGENITA ANAMALY</th>
            <th scope="col">ABORTION</th>
            <th scope="col">OTHERS 1</th>
            <th scope="col">TUBERCULOSIS</th>
            <th scope="col">HYPERTENSION</th>
            <th scope="col">HEART DISEASE</th>
            <th scope="col">DIABETES</th>
            <th scope="col">ASTHMA</th>
            <th scope="col">OTHER 2</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($all_patients_data as $patient) {

                $lmp = date('d-m-Y', strtotime($patient['lmp']));
                echo "
               <tr>
               <th scope='row'>$i</th>
                <td>".$patient['name']."</td>
                <td>".$patient['husband_name']."</td>
                <td>".$patient['aadhar']."</td>
                <td>".$patient['village']."</td>
                <td>".$patient['mobile']."</td>
                <td>".$patient['block']."</td>
                <td>".$patient['SHC']."</td>
                <td>".$patient['city']."</td>
                <td>".$patient['anm_name']."</td>
                <td>".$patient['anm_mobile']."</td>
                <td>".$patient['anm_email']."</td>
                <td>".$patient['aasha']."</td>
                <td>".$lmp."</td>
                <td>1</td>
                <td>".$patient['ac1']."</td>
                <td>".$patient['ac2']."</td>
                <td>".$patient['ac3']."</td>
                <td>".$patient['delivery']."</td>
                <td>".$patient['address']."</td>
                <td>".$patient['APH']."</td>
                <td>".$patient['eclampsia']."</td>
                <td>".$patient['PIH']."</td>
                <td>".$patient['anaemia']."</td>
                <td>".$patient['obstructed_labor']."</td>
                <td>".$patient['PPH']."</td>
                <td>".$patient['LSCS']."</td>
                <td>".$patient['congenital_anamaly']."</td>
                <td>".$patient['abortion']."</td>
                <td>".$patient['others_1']."</td>
                <td>".$patient['tuberculosis']."</td>
                <td>".$patient['hypertension']."</td>
                <td>".$patient['heart_disease']."</td>
                <td>".$patient['diabetes']."</td>
                <td>".$patient['asthma']."</td>
                <td>".$patient['other_2']."</td>
                
               </tr>";
                $i++;
            } ?>
        </tbody>
    </table>
    <button id="export_button">Export</button>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

    <script>
        $(document).ready(function() {
            function html_table_to_excel(type) {
                var data = document.getElementById('dataTable');
                var file = XLSX.utils.table_to_book(data, {
                    sheet: "sheet1"
                });
                XLSX.write(file, {
                    bookType: type,
                    bookSST: true,
                    type: 'base64'
                });
                XLSX.writeFile(file, '<?php echo $file_name; ?>.' + type);
            }
            const export_button = document.getElementById('export_button');
            export_button.addEventListener('click', function() {
                html_table_to_excel('xlsx');
            });
            html_table_to_excel('xlsx');
        });
    </script>
</body>

</html>