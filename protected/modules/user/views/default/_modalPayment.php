
<div class="modal modal-primary fade" id="payModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Payment  - <span id="payCustomerName"></span></h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <table class="table table-bordered " style="margin-bottom: 0;">
                                    <tbody>
                                        <tr>
                                            <td width="25%" style="text-align: right">Total Points</td>
                                            <td width="25%" class="text-left"><span id="totalCustomerPoints">0.00</span></td>
                                        </tr>
                                        <tr>
                                            <td width="25%" style="text-align: right">Card Load </td>
                                            <td width="25%" class="text-left"><span id="loadBalance">0.00</span></td>
                                        </tr>
                                        <tr>
                                            <td width="25%" style="text-align: right">Sub Total</td>
                                            <td class="text-left"><span id="total_paying">0.00</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6"></div>
                        <div class="clearfix"></div>
                        <br />
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input type="checkbox" id="discountCheckBOx" name="discountCheckBOx" class=" largerCheckbox pull-left" style="font-size: 14px;" onClick="showHideDiscount()"/>
                                    <label for="discountCheckBOx">&nbsp;Discount</label>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="divDiscount">
                            <div class="col-xs-12">
                                <?php $model = new Discounts(); ?>

                                     <div class="form-group"> 
                                    <?php echo CHtml::activeDropDownList($model, 'id', CHtml::listData(Discounts::model_getAllData_byDeletedBranchID(Utilities::NO, Settings::get_BranchID()), 'id', 'name'), array('class' => 'form-control', 'prompt' => '-- Select --', 'style' => 'width: 100%', 'onChange' => 'getDiscountType(this.value, this.id)', 'id' => 'discountTypeName')); ?>
                                </div>  
                                <div class="form-group" id="divDiscountValue">
                                    <?php print CHtml::activeLabelEx($model, 'Discount'); ?>
                                    <?php print CHtml::activeTextField($model, 'value', array('class' => 'form-control', 'placeholder' => '0.00', 'id' => 'discountValue', 'onInput' => 'js: getTotalDiscount(this.value)')); ?>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="amount">Cash</label>                                   
                                    <input name="amount" type="text" id="amountPaid" class="pa form-control kb-pad amount" placeholder="0.00" onInput="computeTotalAmount(this.value, this.id, 0)"/>
                                </div>
                            </div>

                        </div>     
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="card_amount">Card</label>                                   
                                    <input name="card_amount" type="text" id="cardAmountPaid" class="pa form-control kb-pad cash_amount" placeholder="0.00" onInput="computeTotalAmount(this.value, this.id, 0)"/>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-xs-12">   
                                <div class="form-group">
                                    <input type="checkbox" id="pointCheckBOx" name="pointCheckBOx" class=" largerCheckbox pull-left" style="font-size: 14px;" onClick="showHidePoints()"/>
                                    <label for="pointCheckBOx">&nbsp; Redeem Points</label>
                                </div>
                            </div>
                        </div>

                        <div class="row divPoints">
                            <div class="col-xs-12">
                                <label >Point(s)</label>    
                                <div class="form-group">                                 
                                    <input name="points" type="text" id="customerPoints" class="pa form-control kb-pad amount" onInput="getAmountInPeso(this.value)" placeholder="0.00"/>
                                </div>
                            </div>

                        </div>
                        <div class="row divPoints">
                            <div class="col-xs-12">
                                <label >Value in Peso</label> 
                                <div class="form-group">                                 
                                    <input name="points" type="text" id="amountInPeso" class="pa form-control kb-pad amount" disabled="disabled" placeholder="0.00"/>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="note">Remarks</label>                                  
                                    <textarea name="note" id="paymentNote" class="pa form-control kb-text"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6"></div>
                            <div class="col-xs-6">
                                <table class="table table-bordered" width="50%">
                                    <tbody>
                                        <tr>
                                            <td width="25%" style="text-align: right">Sub Total</td>
                                            <td class="text-right"><span id="total_paying1">0.00</span></td>
                                        </tr> 
                                        <tr>
                                            <td  width="70%" style="text-align:right;">Discount</td>
                                            <td class="text-right"><span id="discountTotal">0</span></td>
                                        </tr>
                                        <tr>
                                            <td width="25%" style="text-align: right">Total Due</td>
                                            <td class="text-right"><span id="total_due1" style="font-weight: bold">0.00</span></td>
                                        </tr> 
                                        <tr>
                                            <td  width="70%" style="text-align:right;">Cash</td>
                                            <td class="text-right"><span id="amountPaidTotal">0</span></td>
                                        </tr>

                                        <tr>
                                            <td width="70%" style="text-align:right;"><span id="discountLabel"> Change</span></td>
                                            <td class="text-right"><span id="amountChange">0</span></td>
                                        </tr>

                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" onClick="js: reloadPage()">Close</button>
                <button type="button" class="btn btn-success"  onClick="js: submitPayment()">Submit</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class='col-lg-12' id="modalPrintResult" ></div>