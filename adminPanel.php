<?php

session_start();
include 'config.php' ;
require_once 'Classes/PHPExcel.php';

if($_SESSION['login_user'] == 'admin') {
    $sql = "SELECT * FROM candidat";
    $result = mysqli_query($conn, $sql);
    $row_count = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $objPHPExcel = new PHPExcel();
    $objPHPExcel -> setActiveSheetIndex(0);

    $objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow(0, 1, 'Nr. Leg');
    $objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow(1, 1, 'Dom. Lic.');
    $objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow(2, 1, 'Tip Loc');
    $objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow(3, 1, 'Nume');
    $objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow(4, 1, 'Init T');
    $objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow(5, 1, 'Prenume');
    $objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow(6, 1, 'Tip act');
    $objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow(7, 1, 'MedieBac');
    $objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow(8, 1, 'Nota mate Bac');
    $objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow(9, 1, 'Valoare chitanta');
    $objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow(10, 1, 'Loc Special');
    $objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow(11, 1, 'Obs');


    for ($i = 1; $i <= $row_count; $i++) {
        $objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow(0, $i + 1, $i);
        $objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow(1, $i + 1, 'I');
        $objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow(2, $i + 1, 'XX');
        $objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow(3, $i + 1, $row['name']);
        $objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow(4, $i + 1, $row['nameFather']);
        $objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow(5, $i + 1, $row['surname']);
        $objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow(6, $i + 1, $row['IDtype']);
        $objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow(7, $i + 1, $row['medieBac']);
        $objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow(8, $i + 1, $row['mateBac']);
        //SCUTIRE TAXA
        $objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow(9, $i + 1, $row['taxa']);
        //LOC SCUTIT DE ADMITERE
        $objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow(6, $i + 1, $row['admitereSpeciala']);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }

    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
    // We'll be outputting an excel file
    header('Content-type: application/vnd.ms-excel');

    // It will be called file.xls
    header('Content-Disposition: attachment; filename="tabel-admitere-2018.xlsx"');

    // Write file to the browser
    $objWriter -> save('php://output');
    echo "<html>
            <head>
                <header>
                    Admin FMI
                </header>
            </head>
        
            <body>
                Welcome Admin!
                <button name='buttonTabel'> Print Tabel </button>
            </body>
          </html>";
}
else
    echo "Page avalabile only to admin";

?>


