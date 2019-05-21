
<style>

    html {
        font-family: "Verdana";
    }
    .printContent {
        width: 58mm;
        font-size: 10px;
        padding: 5px;
    }
    .printContent .title {
        text-align: center;
    }
    .printContent .head-desc {
        margin-top: 10px;
        display: table;
        width: 100%;
    }
    .printContent .head-desc > div {
        display: table-cell;
    }
    .printContent .head-desc .user {
        text-align: right;
    }
    .printContent .nota {
        text-align: center;
        margin-top: 5px;
        margin-bottom: 5px;
    }
    .printContent .separate {
        margin-top: 10px;
        margin-bottom: 15px;
        border-top: 1px dashed #000;
    }
    .printContent .transaction-table {
        width: 100%;
        font-size: 12px;
    }
    .printContent .transaction-table .name {
        width: 185px;
    }
    .printContent .transaction-table .qty {
        text-align: center;
    }
    .printContent .transaction-table .sell-price, .content .transaction-table .final-price {
        text-align: right;
        width: 65px;
                        
    }
    .printContent .transaction-table tr td {
        vertical-align: top;
    }
    .printContent .transaction-table .price-tr td {
        padding-top: 7px;
        padding-bottom: 7px;
    }
    .printContent .transaction-table .discount-tr td {
        padding-top: 7px;
        padding-bottom: 7px;
    }
    .printContent .transaction-table .separate-line {
        height: 1px;
        border-top: 1px solid #000;
        margin:5px;
                        
    }
    body {-webkit-print-color-adjust: exact; font-family: Arial; }

    @page { size: 65mm 160mm }

</style>

<center>

    <div class="printContent">
        <div style="text-align:center;">
            <img style="display:inline-block;" height="58px" src="<?php print Settings::get_baseUrl() . '/' . $model->branches->file_path . '' . $model->branches->file_pics; ?>" />
        </div>
        <div class="title">   

            <strong style="font-size:14px;margin-bottom: 2px;"> <?= $model->branches->name; ?> </strong> <br>

            Address: <?= $model->branches->address; ?><br />
            Contact #: <?= $model->branches->contact_no; ?> <br />    
            Email Address #: <?= $model->branches->email_address; ?> <br />
        </div>

        <div class="separate-line"></div>


        <div class="separate-line"></div>
        <div class="transaction">
            <table class="transaction-table" cellspacing="0" cellpadding="0" style="font-size:10px;border" width="100%">
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
                        <td colspan="4" style="text-align:center;"> <?= $model->branches->header_rcpt_msg; ?> </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="separate-line"></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align:center;">Customer Name: <?= $model->customers->lnameFname; ?> </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="separate-line"></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"> Transaction Details</td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="separate-line"></div>
                        </td>
                    </tr>
                    <tr>
                        <th style="text-align:left;"> Item </th>
                        <th style="text-align:center;"> Price </th>
                        <th style="text-align:center;"> Qty </th>
                        <th style="text-align:right;"> Amount </th>
                    </tr>

                    <tr>
                        <td colspan="5">
                            <div class="separate-line"></div>
                        </td>

                    </tr>

                    <?php foreach ($modelDetails as $details): ?>
                            <?php $pointsEarned += $details->posTransactions->points;?>
                            <tr>
                                <td style="width:180px;"><?= $details->inventories->name; ?>  <br><span style="font-size:7px;"></span></td>
                                <td><?= $details->price; ?></td>  
                                <td class="sell-price" style="text-align:center;"> <?= $details->qty; ?> </td>  
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
                            <span> Sub Total :    </span>                
                        </td>                  
                        <td style="text-align:right;"> </td>
                        <td class="final-price">
                            <?= Settings::setNumberFormat($model->payable, 2); ?> 
                        </td>

                    </tr>  

                    <tr>
                        <td colspan="2" class="final-price">
                            <span>Discount : </span>                   
                        </td>                  
                        <td style="text-align:right;"> </td>
                        <td class="final-price">
                            <?= Settings::setNumberFormat(($model->discount), 2); ?> 
                        </td>

                    </tr> 
                    <tr>
                        <td colspan="2" class="final-price">
                            <span>Total Due :      </span>              
                        </td>                  
                        <td style="text-align:right;"> </td>
                        <td class="final-price">
                            <b> <?= Settings::setNumberFormat(($model->payable - $model->discount), 2); ?> </b>
                        </td>

                    </tr> 
                    <tr>
                        <td colspan="4">
                            <div class="separate-line"></div>
                        </td>
                    </tr>  
                    <tr>
                        <td colspan="2" class="final-price">
                            <span style="font-weight: bold">Payment Type:   </span>                
                        </td>

                    </tr>   
                    <tr>
                        <td colspan="2" class="final-price">
                            <span>Cash    </span>                
                        </td>

                        <td style="text-align:right;"> </td>


                        <td class="final-price">
                            <?= Settings::setNumberFormat($model->amount_cash, 2); ?>                 

                        </td>                                         
                    </tr>   

                    <tr>
                        <td colspan="2" class="final-price">
                            <span>Card    </span>                
                        </td>

                        <td style="text-align:right;"> </td>


                        <td class="final-price">
                            <?= Settings::setNumberFormat($model->amount_card, 2); ?>                 

                        </td>                                         
                    </tr> 

                    <tr>
                        <td colspan="2" class="final-price">
                            <span>Points   </span>                
                        </td>

                        <td style="text-align:right;"> </td>


                        <td class="final-price">
                            <?= Settings::setNumberFormat($model->amount_points, 2); ?>                 

                        </td>                                         
                    </tr> 
                    <tr> 
                        <td colspan="2" class="final-price">
                            <br />
                        </td>
                    </tr>   

                    <tr>
                        <td colspan="2" class="final-price">

                            <?php $totalChange = (($model->amount_cash + $model->amount_card + $model->amount_points + $model->discount) - $model->payable); ?>
                            <?php if (number_format($totalChange) >= 0): ?>
                                    <span> Change : </span>  
                                <?php else: ?>
                                    <span>Balance : </span>
                            <?php endif; ?>
                        </td>                  
                        <td style="text-align:right;"> </td>
                        <td class="final-price">
                            <?= Settings::setNumberFormat($totalChange, 2); ?>
                        </td>

                    </tr>  
                    <tr>
                        <td colspan="4">
                            <div class="separate-line"></div>
                        </td>
                    </tr>  
                    <tr>
                        <td colspan="2" class="final-price">
                            <span style=" font-weight: bold">Loyalty and Rewards:  </span>                
                        </td>

                    </tr> 
                    <tr>
                        <td colspan="2" class="final-price">
                            <span>Points Earned</span>
                        </td>                  
                        <td style="text-align:right;"> </td>
                        <td class="final-price">
                            <?=  Settings::setNumberFormat($pointsEarned); ?>
                        </td>

                    </tr> 

                    <tr>
                        <td colspan="2" class="final-price">
                            <span> Points Used</span>
                        </td>                  
                        <td style="text-align:right;"> </td>
                        <td class="final-price">
                            <?=  Settings::setNumberFormat($model->points); ?>
                        </td>

                    </tr> 

                    <tr>
                        <td colspan="2" class="final-price">
                            <span> Total Available Points</span>
                        </td>                  
                        <td style="text-align:right;"> </td>
                        <td class="final-price">
                            <?=  Settings::setNumberFormat($model->customers->points); ?>
                        </td>

                    </tr> 
                    <tr>
                        <td colspan="4">
                            <div class="separate-line"></div>
                        </td>
                    </tr>               
                    <tr>
                        <td colspan="4" style="text-align:center;"> <?= $model->branches->footer_rcpt_msg; ?> </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="separate-line"></div>
                        </td>
                    </tr>  
                    <tr style="text-align:left;">
                        <td colspan="4">
                            This shop is installed with ELS Phillippines - CSI <span><center>(Card System Intelligence)</center></span>
                        </td>
                    </tr>
                </tbody>
            </table>


        </div>
    </div>
</center>