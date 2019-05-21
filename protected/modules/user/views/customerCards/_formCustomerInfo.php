<style>
    td.td0{
        padding-top: 0.3cm;
        padding-bottom: 0.2cm;
        padding-left: 1cm;
            
        colspan: 2;
    }
    td.label1{
        width: 20%;
        text-align: right;
        padding-top: 0.05cm;
        padding-bottom: 0.05cm;
        padding-left: 0.05cm;
        padding-right: 0.3cm;
        font-weight: normal;
    }
    
    td.data{
        text-align: left;
        padding-top: 0.05cm;
        padding-bottom: 0.05cm;
        padding-left: 0.05cm;
        padding-right: 0.05cm;
        font-weight: bold;
    }
    
    td.data2{
        width: 35%;
        text-align: left;
        padding-top: 0.05cm;
        padding-bottom: 0.05cm;
        padding-left: 0.05cm;
        padding-right: 0.05cm;
        font-weight: bold;
    }
</style>


<table style="width: 75%">

    <tr>
        <td class="label1"><?php print 'Client name: ';?> </td>
        <td class="data"><?php print$modelCustomer->clientName;?> </td>
        <td class="label1"><?php print 'Card No.: ';?></td>
        <td class="data"><?php print $modelCards->card_no; ?></td>
    </tr>
    <tr>
        <td class="label1"><?php print ' Date Registered: '; ?></td>
        <td class="data"><?php print Settings::setDateStandard($modelCards->reg_date); ?></td>
        <td class="label1" style="padding-top: 7px;"><?php print CHtml::activeLabel(CustomerTransactions::model(), 'balance') ?>: </td>
        <td class="data" style="margin-top: 2px;">P<?php print Settings::setNumberFormat(CustomerTransactions::sql_getTotalBalance_byCardID($modelCards->id), 2); ?></td>
    </tr>
    <tr>
        <td class="label1"><?php print 'Email: '; ?> </td>
        <td class="data"><?php print $modelCustomer->email; ?></td>
        <td class="label1"><?php  'Mobile: '; ?> </td>
        <td class="data"><?php print $modelCustomer->mobile; ?></td>
    </tr>
    <tr>
        <td class="label1"><?php print 'Phone: '; ?> </td>
        <td class="data"><?php print  $modelCustomer->phone; ?></td>
        <td class="label1"><?php print 'Shop Location: '; ?> </td>
        <td class="data"><?php print  $modelCards->laundryShops->name; ?></td>
    </tr>
  
</table>

<br />