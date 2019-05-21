<title>Print  Reports</title>


<?php
    ob_start();
    $endDate = $_GET['toDate'];
    $startDate = $_GET['fromDate'];
    $model = new CActiveDataProvider('Expenses', array(
        'criteria' => array(
            'order' => 'branch_id ASC,  updated_at DESC',
            'condition' => ' is_deleted = :isDeleted AND client_id = :branchID AND date(updated_at) between :startDate AND :endDate',
            'params' => array(
                'endDate' => $endDate,
                'startDate' => $startDate,
                'isDeleted' => Utilities::NO,
                'branchID' => Settings::get_ClientID(),
            ),
        ),
        'sort' => false,
        'pagination' => false //no pagination!!!
    ));
    $details .= $this->renderPartial('_print', array(
        'model' => $model,
        'endDate' => $endDate,
        'startDate' => $startDate,
        ), true, false);
    ob_end_clean();


    ob_start();
    $this->renderPartial('_header');
    $header = ob_get_clean();
    $count = count($model);
    $html .= "<pagebreak />";

    try {
        ob_clean();
        $mPdf = Yii::app()->ePdf->mpdf('utf-8', 'A4-L', '', '', '15', '15', '20', '18');

        $mPdf->AddPage();
        $mPdf->setTitle('Print Expenses Report');
        $mPdf->SetFont('Arial', '', 11);

        $mPdf->SetDisplayMode('fullpage');
        $mPdf->SetHTMLHeader($header, '', true);
        $mPdf->ignore_invalid_utf8 = true;

        $y = 1;
        $x = 10;
        $mPdf->SetXY(1, $y += 30);
        $mPdf->WriteCell(100, 5, $mPdf->WriteHtml($details), 0, 0, 'C');

        $mPdf->output('Print Expenses Report' . $details . '.pdf', "I");
        ob_end_flush();
        exit();
    } catch (Exception $ex) {
        print $ex;
        exit(1);
    }
?>