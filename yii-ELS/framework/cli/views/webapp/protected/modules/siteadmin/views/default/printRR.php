<title>Print Purchase Order</title>
<?php
//convert to pdf
try {
    ob_clean();
    $mPdf = Yii::app()->ePdf->mpdf('utf-8', '', 9, 'Times', 9, 9, 9, 9, 5, 5);

    $mPdf->AddPage();
    $mPdf->setTitle('Print Delivery Receipt');
    $mPdf->SetFont('Times', '', 9);

    $x = 12;
    $y = 1;
    $mPdf->y = $y;
    $mPdf->SetXY(20, $y += 5);
    $mPdf->WriteCell(170, 6, 'CONSOLIDATED PACKAGING ENTERPRISE', 0, 0, 'C');
    $mPdf->SetXY(20, $y += 5);
    $mPdf->WriteCell(170, 6, 'Receiving Report', 0, 0, 'C');

    $y += 15;
    $mPdf->SetXY($x, $y);
    $mPdf->WriteCell(30, 6, 'Supplier:');
    $mPdf->WriteCell(120, 6, $modelHeader->suppliers->name, 'B');
    $mPdf->WriteCell(10, 6, 'RR#:');
    $mPdf->WriteCell(20, 6, $modelHeader->rr_no, 'B'); //,0,'L');

    $mPdf->SetXY($x, $y += 6);
    $mPdf->WriteCell(30, 6, 'Source Documents:');
    $mPdf->WriteCell(120, 6, $modelHeader->po_no . ', ' . date('M d, Y', strtotime($modelHeader->date)), 'B');
    $mPdf->WriteCell(10, 6, 'Date:');
    $mPdf->WriteCell(20, 6, date('m/d/y'), 'B');

    $y += 10;
    $mPdf->SetXY($x, $y);
    $mPdf->WriteCell(180, 6, '', 'B', 0, 'C'); //print line

    $mPdf->SetXY($x, $y += 6);
    $mPdf->WriteCell(40, 6, 'Supplies Code', 'B', 0, 'C');
    $mPdf->WriteCell(70, 6, 'Item Name', 'B', 0, 'C');
    $mPdf->WriteCell(15, 6, 'Qty', 'B', 0, 'C');
    $mPdf->WriteCell(20, 6, 'Unit', 'B', 0, 'C');
    $mPdf->WriteCell(15, 6, 'Unit Cost', 'B', 0, 'C');
    $mPdf->WriteCell(20, 6, 'Amount', 'B', 0, 'C');

    $grandTotal = 0;
    $ctr = 0;
    foreach ($modelDetails as $detail) {
        $y += 6;
        $mPdf->SetXY($x, $y);
        $mPdf->WriteCell(40, 6, $detail->item_code);
        $mPdf->WriteCell(70, 6, Inventories::sql_getName_byCode($detail->item_code));
        $mPdf->WriteCell(15, 6, $detail->quantity, '', 0, 'C');
        $mPdf->WriteCell(20, 6, $detail->units->abbr, '', 0, 'C');
        $mPdf->WriteCell(15, 6, Settings::setNumberFormat($detail->cost, 2), '', 0, 'R');
        $mPdf->WriteCell(20, 6, Settings::setNumberFormat($detail->total, 2), '', 0, 'R');
        $grandTotal += $detail->total;
        $ctr += 1;
    }

    if ($ctr < 6)
        $y = $y + 30;

    $mPdf->SetXY($x, $y);
    $mPdf->WriteCell(180, 6, '', 'B', 0, 'C'); //print line

    $y += 8;
    $mPdf->SetXY($x + 140, $y);
    $mPdf->WriteCell(20, 6, 'Total: ', '', 0, 'R');
    $mPdf->WriteCell(20, 6, Settings::setNumberFormat($modelHeader->grand_total, 2), 'B', 0, 'R');
    $mPdf->SetXY($x + 160, $y += 1);
    $mPdf->WriteCell(20, 6, '', 'B', 0, 'R'); //print line

    $y += 6;
    $mPdf->SetXY($x, $y += 6);
    $mPdf->WriteCell(45, 6, 'Received and Inspected by:');
    $mPdf->WriteCell(40, 6, '');
    $mPdf->WriteCell(45, 6, 'Reviewed by:');

    $mPdf->SetXY($x, $y += 6);
    $mPdf->WriteCell(45, 6, Settings::setCapitalAll(Employees::sql_getFullName($modelHeader->received_emp_id)), 'B');
    $mPdf->WriteCell(40, 6, '');
    $mPdf->WriteCell(45, 6, Settings::setCapitalAll(Employees::sql_getFullName($modelHeader->reviewed_emp_id)), 'B');

    $mPdf->Output();
    ob_end_flush();
} catch (Exception $ex) {
    print $ex;
    exit(1);
}
?>
