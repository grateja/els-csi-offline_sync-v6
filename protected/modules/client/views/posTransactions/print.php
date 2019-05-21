<title>Print  Reports</title>


<?php
    ob_start();

    $endDate = $_GET['toDate'];
    $startDate = $_GET['fromDate'];
    $model = new CActiveDataProvider('PosTransactions', array(
        'criteria' => array(
            'order' => 'cust_id, branch_id ASC ,updated_at DESC',
            'condition' => 'is_deleted = :isDeleted AND client_id = :branchID AND date(trans_date) between :startDate AND :endDate',
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

    try {

        ob_clean();
        $mPdf = Yii::app()->ePdf->mpdf('utf-8', 'A4-L', '', '', '15', '15', '20', '18');
        //$mPdf=Yii::app()->ePdf->mpdf('utf-8','',9,'Times',9,9,9,9,5,5); // Portrait

        $mPdf->AddPage();
        $mPdf->setTitle('Report Management');
        $mPdf->SetFont('Times', '', 9);

        $mPdf->SetDisplayMode('fullpage');
//        $mPdf->SetHTMLHeader($header, '', true);
        $mPdf->ignore_invalid_utf8 = true;



        $y = 1;
        $x = 10;
        $mPdf->SetXY(1, $y += 10);
        $mPdf->WriteCell(100, 5, $mPdf->WriteHtml($details), 0, 0, 'C');

        $mPdf->output('Print Transaction Report' . Settings::get_DateTime() . '.pdf', "I");
        ob_end_flush();
    } catch (Exception $ex) {
        print $ex;
        exit(1);
    }
?>