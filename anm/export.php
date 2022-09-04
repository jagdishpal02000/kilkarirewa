<?php
session_start();
if (!$_SESSION) die('something went wrong, please login again');
require('../resources/functions/helpers.php');
if (!$_REQUEST['from'] || empty($_REQUEST['from']) || !$_REQUEST['to'] || empty($_REQUEST['to']))
    die('please select valid dates');

$anm_name = $_SESSION['anm_data']['name'];
$SHC = $_SESSION['anm_data']['SHC'];
$block_name = $_SESSION['anm_data']['block'];
$city_name = $_SESSION['anm_data']['city'];
$village_list = getVillages($SHC);
$all_patients_data = getAllPatients($SHC);
$from = $_REQUEST['from'];
$to = $_REQUEST['to'];
$file_name = "kilkarirewa_$from" . "_ " . $to;
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
                <th scope="col">S.No.</th>
                <th class="freeze" style="background-color:white;position:sticky;left:0;z-index:2;" scope="col">Patient Name</th>
                <th scope="col">Mobile</th>
                <th scope="col">Aasha</th>
                <th scope="col">LMP</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($all_patients_data as $patient) {
                $ac1_checked =  $patient['ac1'] == 1 ? 'checked' : '';
                $ac2_checked =  $patient['ac2'] == 1 ? 'checked' : '';
                $ac3_checked =  $patient['ac3'] == 1 ? 'checked' : '';
                $delivery_checked =  $patient['delivery'] == 1 ? 'checked' : '';


                echo "
               <tr>
               <th scope='row'>$i</th>
               <td>" . $patient['name'] . "</td>
               <td>" . $patient['mobile'] . "</td>
               <td>" . $patient['aasha'] . "</td>
               <td>" . $patient['lmp'] . "</td>
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