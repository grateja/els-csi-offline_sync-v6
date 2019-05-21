<script type="text/javascript">



        function  showQuantityModal(invID) {
            var custID = document.getElementById('customerName').value;
            if (custID.length == 0) {
                smartAlert(0, 'Please select Customer!');
                return false;
            }
            $('#inventoryID').val(invID);

            $('#quantityModal').modal('show');

        }
        function passQuantity(id, value) {
            $('#' + id).val(value);
        }

        function saveInventoryTransaction() {

            $('#quantityModal').modal('hide');
            var custID = document.getElementById('customerName').value;
            var quantity = document.getElementById('quantityValue').value;
            var inventoryID = document.getElementById('inventoryID').value;

            var remarks = $('#refNote').val();


            $.ajax({
                type: 'Get',
                url: '?r=backoffice/posTransactions/saveInventoryTransaction',
                data: 'custID=' + custID + '&inventoryID=' + inventoryID + '&quantity=' + quantity + '&refNOte=' + remarks,
                async: false,
                success: function (data) {
                    console.log(data);
                    var result = JSON.parse(data);
                    if (result.error != 1) {
                        appendTransaction(result.transactionID)
                    } else {

                        smartAlert(0, result.message);
                    }
                }
            });
        }

        function searchTransactions() {

            var custID = document.getElementById('customerName').value;
            $('#posTable tbody tr').remove();
            $.ajax({
                type: 'Get',
                url: '?r=backoffice/posTransactions/searchTransactions',
                data: 'custID=' + custID,
                async: false,
                success: function (data) {
                    var result = JSON.parse(data);
                    var count = 0;
                    var totalAmount = 0;
                    var discount = 0;// $('#discount').val();

                    var totaldiscount = parseInt(discount, 10);

                    for (var i = 0; i < result.length; i++)
                    {

                        count += parseInt(result[i].qty, 10);
                        totalAmount += parseFloat(result[i].amount_net);
                        var totalamountLessDiscount = parseFloat(totalAmount, 10);

                        $('#totalItems').text(count);
//                        $('#totalDiscount').text(totaldiscount.toFixed(2));
                        $('#totalPayable').html(totalamountLessDiscount.toFixed(2));

                        $('#posTable tbody').prepend(
                            "<tr>\n" +
                            "  <td>\n" +
                            "     <span class='badge bg-blue'>" + result[i].transaction_name + "</span>" +
                            "  </td>\n" +
                            " <td class=''>\n" + result[i].qty + "</td>\n" +
                            " <td class=''>\n" + result[i].amount_net + "</td>\n" +
                            " <td class=''>\n\ <button type='button' class='close'>  <span id='deleteSpan" + result[i].id + "' aria-hidden='true' onclick='deleteInventory($(this), " + result[i].id + ", " + result[i].is_saved + ")' >×</span> </button></td>\n" +
                            "</tr>\n"
                            ).fadeIn(3000);
                    }
                    $('#payment').removeAttr("disabled");
                    retrieveCustomerPoints(custID);
                    showHidePaymentButton(custID);


                }
            });

        }
//
        function appendTransaction(transactionID) {

            $.ajax({
                type: 'Get',
                url: '?r=backoffice/posTransactions/appendTransaction',
                data: 'transactionID=' + transactionID,
                async: false,
                success: function (data) {
                    var result = JSON.parse(data);

                    var count = parseInt($('#count').text(), 10);
                    var totalAmount = parseInt($('#total').text(), 10);
                    var discount = 0;

                    var totaldiscount = parseInt(discount, 10);
                    for (var i = 0; i < result.length; i++)
                    {

                        count += parseInt(result[i].qty, 10);
                        totalAmount += parseInt(result[i].amount_net, 10);
                        var totalamountLessDiscount = parseInt(totalAmount, 10);

                        $('#posTable tbody').prepend(
                            "<tr id='trResult" + result[i].id + "'>\n" +
                            "  <td>\n" +
                            "     <span class='badge bg-blue'>" + result[i].transaction_name + "</span>" +
                            "  </td>\n" +
                            " <td class=''>\n" + result[i].qty + "</td>\n" +
                            " <td class=''>\n" + result[i].amount_net + "</td>\n" +
                            " <td class=''>\n\ <button type='button' class='close'>  <span id='deleteSpan" + result[i].id + "' aria-hidden='true' onclick='deleteInventory($(this), " + result[i].id + ", " + result[i].is_saved + ")'>×</span> </button></td>\n" +
                            "</tr>\n"
                            );
                        $('#trResult' + result[i].id).animate({
                            backgroundColor: "#3c8dbc",
                            color: "#fff",
                        }, 1000);
                        $('#trResult' + parseInt(result[i].id - 1)).removeAttr('style');
                    }
                    reCalculate();
                }
            });
        }
//
        function reCalculate() {
            var custID = document.getElementById('customerName').value;
            $.ajax({
                type: 'Get',
                url: '?r=backoffice/posTransactions/searchTransactions',
                data: 'custID=' + custID,
                async: false,
                success: function (data) {
                    var result = JSON.parse(data);
                    var count = 0;
                    var totalAmount = 0;
                    var discount = 0;// $('#discount').val()

                    var totaldiscount = parseInt(discount, 10);

                    for (var i = 0; i < result.length; i++)
                    {
                        var qty = parseInt(result[i].qty, 10);
                        count += qty;
                        totalAmount += parseFloat(result[i].amount_net);
                        var totalamountLessDiscount = parseFloat(totalAmount);
                        $('#totalItems').text(count);
//                        $('#totalDiscount').text(totaldiscount.toFixed(2));
                        $('#totalPayable').html(totalamountLessDiscount.toFixed(2));
                    }
                    showHidePaymentButton(custID);

                }

            });
        }

        function deleteInventory(val, transationID, isSaved) {
            var tableLegnth = parseInt(($('#posTable tbody').children().length - 1), 10);

            if (isSaved === 1) {
                smartAlert(0, 'Cannot delete saved transactions!.');
                return false;
            }

            $.ajax({
                type: 'Get',
                url: '?r=backoffice/posTransactions/deleteInventory',
                data: 'transationID=' + transationID,
                async: false,
                success: function (data) {
                    var result = JSON.parse(data);

                    if (result.isError == 1) {

                        smartAlert(0, result.message);
                    } else {
                        reCalculate();
                        val.closest('tr').remove().fadeOut(3000).fadeOut(1000);
                        if (tableLegnth == 0) {

                            $('#count').text('0.00');
                            $('#total').text('0.00');
                            $('#total-payable').html('0.00');
                        }
                        smartAlert(1, result.message);
                    }

                }
            });
        }
//
        function reloadPage() {

            location.reload();
        }

        function smartAlert(val, message) {
            if (val == 1) {
                $.smallBox({
                    title: 'Message!',
                    content: message,
                    color: '#739E73',
                    icon: 'fa fa-check shake animated',
                    number: '1',
                    timeout: 4000
                });
            } else {
                $.smallBox({
                    title: 'Warning!',
                    content: message,
                    color: '#C46A69',
                    icon: 'fa fa-warning shake animated',
                    number: '1',
                    timeout: 4000
                });
            }

        }
        function  retrieveCustomerPoints(custID) {
            $.ajax({
                type: 'Get',
                url: '?r=backoffice/customers/retrieveCustomerPoints',
                data: 'custID=' + custID,
                async: false,
                success: function (data) {
                    var result = JSON.parse(data);
                    $('#totalPoints').val(result.points);
                    $('#totalLoadBalance').val(result.cust_balance);
                }
            });
        }

        function showDiscountModal() {
            $('#discountModal').modal('show');
        }

        function getDiscountType(val, id) {
            var name = $('#' + id).val();
            var amountPayable = parseFloat($('#total_paying').text().replace(/,/g, ''));
            $.ajax({
                type: 'Get',
                url: '?r=backoffice/posTransactions/getDiscountType',
                data: 'id=' + val,
                async: false,
                success: function (data) {
                    var result = JSON.parse(data);
                    var totalDiscount = parseFloat(amountPayable * (result.value / 100)).toFixed(2);
                    if (result.discount_type_id == 2) {

                        $('#discountValue').val(totalDiscount);



                        $('#discountValue').attr("disabled", true);
                    } else {

                        $('#discountValue').attr("disabled", false);
                        $('#discountValue').val(totalDiscount);
                    }

                    var subTotal = parseFloat($('#total_paying1').text().replace(/,/g, ''));
                    var totalDue1 = parseFloat(subTotal) - parseFloat(totalDiscount);
                    $('#total_due1').text(totalDue1.toFixed(2));

                    $('#discountTypeID').val(result.id);
                    $('#discountTotal').html(totalDiscount);
                    $('#amountChange').html(totalDiscount);


                }
            });
        }

        function showPrintJobOrder() {

            var custID = document.getElementById('customerName').value;
            if (custID.length == 0) {
                smartAlert(0, 'Please select Customer!');
                return false;
            } else {

                alert('oks');
            }
        }

        function saveTransactions() {

            var custID = document.getElementById('customerName').value;

            $.ajax({
                type: 'Get',
                url: '?r=backoffice/posTransactions/saveTransactions',
                data: 'custID=' + custID,
                async: false,
                success: function (data) {
                    showHidePaymentButton(custID);
                    var result = JSON.parse(data);
                    if (result.isError != 1) {
                        smartAlert(1, result.message);
                    } else {

                        smartAlert(0, result.message);
                    }

                }
            });
        }



        function showPaymentModal() {

            var custID = document.getElementById('customerName').value;
            if (custID.length == 0) {
                smartAlert(0, 'Please select Customer!');
                return false;
            } else {

                $('#payModal').modal('show');
            }
            var customerName = $('#customerName option:selected').html();

            var totalPayable = parseFloat($('#totalPayable').text(), 2).toFixed(2);
            var totalPoints = ($('#totalPoints').val() != '') ? parseInt($('#totalPoints').val(), 10) : 0;
            var totalLoadBalance = numberWithCommas(parseFloat(($('#totalLoadBalance').val() != '') ? parseInt($('#totalLoadBalance').val(), 10) : 0, 2).toFixed(2));
            var totalPayableFormatted = numberWithCommas(totalPayable);

            $('#payCustomerName').html(customerName);
            $('#total_paying').html(totalPayableFormatted);
            $('#total_paying1').html(totalPayableFormatted);
            $('#amountPaid').val(totalPayable);
            $('#totalCustomerPoints').text(totalPoints.toFixed(2));
            $('#loadBalance').text(numberWithCommas(totalLoadBalance));

            var discount = parseFloat($('#discountTotal').text().replace(/,/g, ''));
            var totalDue1 = parseFloat(totalPayableFormatted) - parseFloat(discount);
            $('#total_due1').text(totalDue1.toFixed(2));
            $('#amountPaidTotal').text(totalPayableFormatted);

            var amountChange = numberWithCommas(parseFloat(totalPayable - $('#amountPaid').val(), 2).toFixed(2));

            $('#amountChange').html(amountChange);

            showHidePoints();
            showHideDiscount();

        }

        function showHidePoints() {
            IsCheckedCheckBox('pointCheckBOx', 'divPoints');
        }
        function showHideDiscount() {
            IsCheckedCheckBox('discountCheckBOx', 'divDiscount');
        }

        function IsCheckedCheckBox(id, fieldID) {
            if ($("#" + id).is(":checked")) {

                $('#' + fieldID).show();
            } else {

                $('#' + fieldID).hide();
            }
        }
        function  retrieveCustomerPoints(custID) {
            $.ajax({
                type: 'Get',
                url: '?r=backoffice/customers/retrieveCustomerPoints',
                data: 'custID=' + custID,
                async: false,
                success: function (data) {

                    console.log(data);
                    var result = JSON.parse(data);
                    $('#totalPoints').val(result.points);
                    $('#totalLoadBalance').val(result.cust_balance);
                }
            });
        }
        function numberWithCommas(num) {
            var parts = num.toString().split('.');
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            return parts.join('.');
        }


        function computeTotalAmount(value, fieldID) {


            if (fieldID == 'amountPaid') {
                var amountPaid = $('#cardAmountPaid').val().replace(/\.00$/, '');
                if (amountPaid == '')
                    amountPaid = 0;
            }



            if (fieldID == 'cardAmountPaid') {
                var totalLoadBalance = $('#totalLoadBalance').val().replace(/\.00$/, '');

                if (totalLoadBalance == '')
                    totalLoadBalance = 0;

                if (parseFloat(value) > parseFloat(totalLoadBalance)) {

                    $('#cardAmountPaid').val('0');
                    messageBox(0, 'Card Amount Paid cannot be greated than remaining card load!');
                    calculateTotalAmountNet(0, amountPaid);
                    totalLoadBalance = 0;
                }

                var amountPaid = $('#amountPaid').val().replace(/\.00$/, '');
                if (amountPaid == '')
                    amountPaid = 0;
            }
            calculateTotalAmountNet(value, amountPaid);


        }

        function calculateTotalAmountNet(value, amountPaid) {

            var amountDiscount = ($('#discountValue').val() != '') ? parseInt($('#discountValue').val(), 10) : 0;
            var subTotal = parseFloat($('#total_paying').text().replace(/,/g, ''));
            var totalAmountPaid = parseFloat(value) + parseFloat(amountPaid);
            var change = parseFloat(subTotal - amountDiscount - totalAmountPaid).toFixed(2);

            $('#amountPaidTotal').html(parseFloat(totalAmountPaid).toFixed(2));
            if (change >= 0) {

                $('#amountChange').html(numberWithCommas(change));
                $('#discountLabel').text('Balance');
            } else {

                $('#amountChange').html(numberWithCommas(Math.abs(change)));
                $('#discountLabel').text('Change');
            }
        }





        function submitPayment() {

            var remarks = $('#paymentNote').val();
            var custID = $('#customerName').val();
            var points = $('#totalCustomerPoints').val();
            var count = parseInt($('#totalItems').text(), 10);
            var payable = parseFloat($('#total_paying').text().replace(/,/g, ''));
            var discount = parseFloat($('#discountTotal').text().replace(/,/g, ''));
            var totalAmountPaid = parseFloat($('#amountPaidTotal').text().replace(/,/g, ''));
            var change = $('#amountChange').val().replace(/\.00$/, '');
            if (change == '')
                change = 0;

            if (discount == '')
                discount = 0;


            var balance = parseFloat(totalAmountPaid) - parseInt(change);

            var amountPaid = $('#amountPaid').val().replace(/\.00$/, '');
            if (amountPaid == '')
                amountPaid = 0;

            var cardAmountPaid = $('#cardAmountPaid').val().replace(/\.00$/, '');
            if (cardAmountPaid == '')
                cardAmountPaid = 0;



            if (custID.length == 0) {
                messageBox(0, 'Please select Customer!');
                return false;
            }

            if (totalAmountPaid == 0) {
                messageBox(0, 'Please input any valid amount!');
                return false;
            }

            if (amountPaid.length == 0) {
                messageBox(0, 'Please input amount!');
                return false;
            }



            if (!$.isNumeric(amountPaid)) {
                messageBox(0, 'Please input valid amount!');
                return false;
            }

            $.ajax({
                type: 'Get',
                url: '?r=backoffice/posTransactions/submitPayment',
                data: 'custID=' + custID + '&amountPaid=' + amountPaid + '&remarks=' + remarks + '&count=' + count + '&payable=' + payable + '&discount=' + discount + '&cardAmountPaid=' + cardAmountPaid + '&points=' + points + '&totalAmountPaid=' + balance + '&amountChange=' + change,
                async: false,
                success: function (data) {
                    console.log(data);
                    var result = JSON.parse(data);
                    if (result.isError != 1) {

                        $('#payModal').modal('hide');
                        $('#paymentSuccess').modal('show');
                        $('#payment').prop('disabled', 'true');
                        $('#headerID').val(result.headerID);

                    } else {

                        messageBox(0, result.message);
                        $('#payment').prop('disabled', 'true');
                    }
                }
            });
        }
        function printReceipt() {

            var headerID = $('#headerID').val();

            $('#paymentSuccess').modal('hide');
            $.ajax({
                type: 'Get',
                url: '?r=backoffice/posTransactions/printReceipt',
                data: 'headerID=' + headerID,
                async: false,
                success: function (data) {

                    $('#modalPrintResult').html(data);

                    var WindowObject = window.open('', '', 'width=800,height=650,scrollbars=1,menuBar=1');
                    WindowObject.document.write(data);
                    WindowObject.document.close();


                    $(WindowObject.window).on("load", function () {
                        WindowObject.print();
                        WindowObject.close();
                        location.reload();

                    });
                }
            });
        }
        function showHidePaymentButton(custID) {
            $.ajax({
                type: 'Get',
                url: '?r=backoffice/posTransactions/getUnsavedTransactions',
                data: 'custID=' + custID,
                async: false,
                success: function (data) {
                    if (data == 0) {
                        $('#payment').show();
                        $('#saveBtn').hide();
                    } else {

                        $('#payment').hide();
                        $('#saveBtn').show();
                    }

                    if (parseInt($('#totalPayable').text(), 10) == 0) {

                        $('#payment').hide();
                        $('#saveBtn').show();
                    }
                }
            });
        }

        function myFunction() {

            var input, filter, ul, li, a, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();

            ul = document.getElementsByClassName("myProducts");
            for (x = 0; x < ul.length; x++) {

                li = ul[x].getElementsByTagName("li");
                for (i = 0; i < li.length; i++) {
                    a = li[i].getElementsByTagName("a")[0];
                    if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        li[i].style.display = "";
                    } else {
                        li[i].style.display = "none";
                    }
                }
            }


        }

        function  showCustomerModal() {

            $('#customerModal').modal('show');

        }


        function ajaxCreate()
        {

            var data = $("#customer_form").serialize();

            $.ajax({
                type: 'POST',
                url: '?index.php&r=backoffice/customers/ajaxCreate',
                data: data,
                success: function (data) {

                    var result = JSON.parse(data);
                    custID = parseInt(result.id);
                    if (result.error == 0) {
                        selectedCustomer(result.id, result.name)
                        $('#customerModal').modal('hide');
                        messageBox(1, result.message);
                    } else {
                        messageBox(0, result.message);
                        $('#customerModal').modal('hide');
                    }
                },
                error: function (data) { // if error occured
                    messageBox(0, "Error occured.please try again");
                },
                dataType: 'html'
            });

        }

        function selectedCustomer(val, name) {
            $("#customerName").append('<option value=' + parseInt(val) + '>' + name + '</option>');
            $('select[id="customerName"]').find('option[value="' + parseInt(val) + '"]').attr("selected", true).change();
        }

        function getTotalDiscount(discount) {
            var cash = $('#amountPaid').val().replace(/,/g, '');
            var card = $('#cardAmountPaid').val().replace(/,/g, '');
            var payable = parseFloat($('#total_paying').text().replace(/,/g, ''));
            if (cash == '') {
                cash = 0;
            }

            if (card == '') {
                card = 0;
            }

            if (payable == '') {
                payable = 0;
            }

            var amountChange = ((parseFloat(cash) + parseFloat(card) + parseFloat(discount)) - parseFloat(payable));

            $('#discountTotal').text(parseFloat(discount).toFixed(2));
            $('#amountChange').text(amountChange.toFixed(2));

            var subTotal = parseFloat($('#total_paying1').text().replace(/,/g, ''));
            var totalDue1 = parseFloat(subTotal) - parseFloat(discount);
            $('#total_due1').text(totalDue1.toFixed(2));
        }
</script>