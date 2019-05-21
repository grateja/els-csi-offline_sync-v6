
<style>

    html {
        font-family: "Verdana";
    }
    .content {
        width: 58mm;
        font-size: 10px;
        padding: 5px;
    }
    .content .title {
        text-align: center;
    }
    .content .head-desc {
        margin-top: 10px;
        display: table;
        width: 100%;
    }
    .content .head-desc > div {
        display: table-cell;
    }
    .content .head-desc .user {
        text-align: right;
    }
    .content .nota {
        text-align: center;
        margin-top: 5px;
        margin-bottom: 5px;
    }
    .content .separate {
        margin-top: 10px;
        margin-bottom: 15px;
        border-top: 1px dashed #000;
    }
    .content .transaction-table {
        width: 100%;
        font-size: 12px;
    }
    .content .transaction-table .name {
        width: 185px;
    }
    .content .transaction-table .qty {
        text-align: center;
    }
    .content .transaction-table .sell-price, .content .transaction-table .final-price {
        text-align: right;
        width: 65px;
                        
    }
    .content .transaction-table tr td {
        vertical-align: top;
    }
    .content .transaction-table .price-tr td {
        padding-top: 7px;
        padding-bottom: 7px;
    }
    .content .transaction-table .discount-tr td {
        padding-top: 7px;
        padding-bottom: 7px;
    }
    .content .transaction-table .separate-line {
        height: 1px;
        border-top: 1px solid #000;
        margin:5px;
                        
    }
    body {-webkit-print-color-adjust: exact; font-family: Arial; }

   @page { size: 65mm 160mm }

</style>

<center>

    <div class="content">
        <div style="text-align:center;">
            <img style="display:inline-block;" height="58px" src="<?php print Settings::get_baseUrl() . '/images/noimage.png' ?>" />
        </div>
        <div class="title">   

            <strong style="font-size:14px;margin-bottom: 2px;"> <?= $model->branches->name; ?> </strong> <br>

            <b>CustomerName:<?= $model->customers->lnameFname; ?></b><br />
            Address: <?= $model->customers->address; ?><br />

            Contact #: <?= $model->customers->phone . '/' . $model->customers->mobile; ?>       
        </div>

        <div class="separate-line"></div>
        <div class="transaction">
            <table class="transaction-table" cellspacing="0" cellpadding="0" style="font-size:10px;border">
                <tbody>
                    <tr>
                        <td colspan="4">
                            <div class="separate-line"></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"> Invoice : <?= $model->or_no; ?> </td>
                        <td colspan="2" style="text-align:right;">  <?= Settings::setDateStandard($model->created_at); ?></td>
                    </tr>

                    <tr>
                        <td colspan="4">
                            <div class="separate-line"></div>
                        </td>
                    </tr>
                    <tr>
                        <th style="text-align:left;"> Item </th>
                        <th style="text-align:center;"> price </th>
                        <th style="text-align:right;"> Qty </th>
                        <th style="text-align:right;"> Amount </th>
                    </tr>

                    <tr>
                        <td colspan="5">
                            <div class="separate-line"></div>
                        </td>

                    </tr>

                    <?php foreach ($modelDetails as $details): ?>
                            <tr>
                                <td style="width:180px;"><?= $details->inventories->name; ?>  <br><span style="font-size:7px;"></span></td>
                                <td><?= $details->price; ?></td>  
                                <td class="sell-price"> <?= $details->qty; ?> </td>  
                                <td class="final-price"> 
                                    <?= $details->amount_paid; ?>                                                
                                </td> 
                            </tr>
                        <?php endforeach; ?>   

                    <tr>
                        <td colspan="4">
                            <div class="separate-line"></div>
                        </td>
                    </tr>              
                    <tr>
                        <td colspan="2" class="final-price">
                            Sub Total :                    
                        </td>                  
                        <td style="text-align:right;"> </td>
                        <td class="final-price">
                            <?= Settings::setNumberFormat($model->payable, 2); ?> 
                        </td>

                    </tr>  

                    <tr>
                        <td colspan="2" class="final-price">
                            Discount :                    
                        </td>                  
                        <td style="text-align:right;"> </td>
                        <td class="final-price">
                            <?= Settings::setNumberFormat(($model->discount), 2); ?> 
                        </td>

                    </tr> 



                    <tr>
                        <td colspan="2" class="final-price">
                            Change :                    
                        </td>                  
                        <td style="text-align:right;"> </td>
                        <td class="final-price">
                            <?php $totalChange = ($model->payable - ($model->amount_net + $model->discount));?>
                            <?= Settings::setNumberFormat($totalChange, 2); ?>
                        </td>

                    </tr>   
                    <tr>
                        <td colspan="4" style="padding:0xp">
                            <div class=" separate-line">
                        </td>
                    </tr>                  
                    <tr>                                            
                    </tr>
                    <tr>                                             
                        <td colspan="4">

                            <div class="separate-line"></div>

                        </td>

                    </tr>                                        
                    <tr>
                        <td colspan="2" class="final-price" style="font-size:15px;">
                            Net Amount                     
                        </td>

                        <td style="text-align:center; font-size:15px;"> : </td>


                        <td class="final-price" style="font-size:15px;">
                            <?= Settings::setNumberFormat($model->amount_net, 2); ?>                 

                        </td>                                         
                    </tr>                               
                    <tr>
                        <td colspan="4">
                            <div class="separate-line"></div>
                        </td>
                    </tr>               
                    <tr style="text-align:center;">
                        <td colspan="4">
                            Thank You! <br>Powered by AppWard
                        </td>
                    </tr>
                </tbody>
            </table>


        </div>
    </div>
</center>