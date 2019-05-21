<?php
//Utilities::debug($_SESSION[AdmissionTestingParents::tbl()],'sd');
//$index = $_SESSION[AdmissionTestingParentsTmp::tbl()][$index]['indexTmp'] ;
?>
<table class="table androidHeader">
    <thead>
        <tr>
            <th style="text-align: center">First Name</th>
            <th style="text-align: center">Last Name</th>
            <th style="text-align: center">RF ID</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="text-align: center"><?php print  $_SESSION[CustomerCards::tbl()]['firstname']; ?></td>
            <td style="text-align: center"><?php print  $_SESSION[CustomerCards::tbl()]['lastname']; ?></td>
            <td style="text-align: center"><?php print  $_SESSION[CustomerCards::tbl()]['rfid']; ?></td>
            <!--<td style="text-align: center"></td>-->
        </tr>
        <?php if($_SESSION[CustomerCards::tbl()]['customer_id']): ?>
                <tr>
                    <td style="text-align: center;" colspan="4">
                        <?php print  CHtml::link('<i class="fa fa-trash"></i> Remove', $this->createUrl('machines/removeCustomer', array('machineID' => $_GET['machineID']))); ?>
                    </td>
                </tr>
        <?php endif; ?>
    </tbody>

</table>