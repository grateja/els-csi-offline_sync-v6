
<div class="col-lg-12" id='divRemoteActivation'>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Remote  Activation</h3>

            <div class="box-tools pull-right">
                <?php echo CHtml::link('<i class="fa fa-arrow-left"></i>', $this->createUrl('machines/admin'), array('class' => 'btn btn-xs btn-success pull-right', 'data-toggle' => 'tooltip', 'title' => 'Create')); ?>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" >

            <div class="col-lg-12 col-xs-12">
                <?php $modelwmachine = Machines::model_getAllData_byMachineTypeID(MachineTypes::MACHINE_TYPE_WASHER, Utilities::NO, Settings::get_BranchID()); ?>

                <?php foreach ($modelwmachine as $wmachine): ?>
                        <?php
                        $countWasher = Machines::sql_getTotalCycles_byDateMachineID(Settings::get_Date(), $wmachine->id);
                        if ($wmachine->machine_status_id == MachineStatuses::STATUS_IDLE) {
                            $color = "bg-green";
                        } else if ($wmachine->machine_status_id == MachineStatuses::STATUS_RUNNING) {
                            $color = "bg-yellow";
                        } else {
                            $color = "bg-red";
                        }
                        ?>
                        <div class="col-lg-2 col-xs-6" onClick="showActivateMachineModal(<?= $wmachine->id ?>, '<?= $wmachine->name ?>')" id="<?= 'divMachine' . $wmachine->id; ?>">
                            <div class="small-box <?= $color ?>">
                                <div class="inner">
                                    <h3>  <?= $countWasher ?><sup style="font-size: 20px"></sup></h3>


                                    <p><?= $wmachine->name ?></p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-laptop" style="margin-left: -80px !important;"></i>
                                </div>
                                <span class="small-box-footer"><?= $wmachine->machineStatuses->name . ' <span id="machineTimer' . $wmachine->id . '"> - 00:00</span>' ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
            </div>
            <!-- END RIBBON -->

            <div class="col-lg-12 col-xs-12">
                <?php $modelDryer = Machines::model_getAllData_byMachineTypeID(MachineTypes::MACHINE_TYPE_DRYER, Utilities::NO, Settings::get_BranchID()); ?>

                <?php foreach ($modelDryer as $dryer): ?>
                        <?php
                        $countDryer = Machines::sql_getTotalCycles_byDateMachineID(Settings::get_Date(), $dryer->id);
                        if ($dryer->machine_status_id == MachineStatuses::STATUS_IDLE) {
                            $color = "btn-success";
                        } else if ($dryer->machine_status_id == MachineStatuses::STATUS_RUNNING) {
                            $color = "btn-warning";
                        } else {
                            $color = "btn-danger";
                        }
                        ?>    
                        <div class="col-lg-2 col-xs-6" onClick="showActivateMachineModal(<?= $dryer->id ?>, '<?= $dryer->name ?>')" id="<?= 'divMachine' . $dryer->id; ?>">
                            <div class="small-box <?= $color ?>">
                                <div class="inner">
                                    <h3>  <?= $countDryer ?><sup style="font-size: 20px"></sup></h3>


                                    <p><?= $dryer->name ?></p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-laptop" style="margin-left: -80px !important;"></i>
                                </div>
                                <span class="small-box-footer"><?= $dryer->machineStatuses->name . ' <span id="machineTimer' . $dryer->id . '"> - 00:00</span>' ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
            </div>

            <div class="col-lg-12 col-xs-12">
                <?php $modelTitan = Machines::model_getAllData_byMachineTypeID(MachineTypes::MACHINE_TYPE_TITAN, Utilities::NO, Settings::get_BranchID()); ?>
                <?php foreach ($modelTitan as $titan): ?>
                        <?php
                        $countTitan = Machines::sql_getTotalCycles_byDateMachineID(Settings::get_Date(), $titan->id);
                        if ($titan->machine_status_id == MachineStatuses::STATUS_IDLE) {
                            $color = "btn-success";
                        } else if ($titan->machine_status_id == MachineStatuses::STATUS_RUNNING) {
                            $color = "btn-warning";
                        } else {
                            $color = "btn-danger";
                        }
                        ?>    
                        <div class="col-lg-2 col-xs-6" onClick="showActivateMachineModal(<?= $titan->id ?>, '<?= $titan->name ?>')" id="<?= 'divMachine' . $titan->id; ?>">
                            <div class="small-box <?= $color ?>">
                                <div class="inner">
                                    <h3>  <?= $countTitan ?><sup style="font-size: 20px"></sup></h3>


                                    <p><?= $titan->name ?></p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-laptop" style="margin-left: -80px !important;"></i>
                                </div>
                                <span class="small-box-footer"><?= $titan->machineStatuses->name . ' <span id="machineTimer' . $titan->id . '"> - 00:00</span>' ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
            </div>

            <input type="hidden" id="machineCount" name="machineCount" value="<?= count($modelwmachine) + count($modelDryer) + count($modelTitan) ?>">
        </div>
    </div>
    <!-- /.box -->
</div>
<!-- /.col -->
<style>
    .select2-container {
        width: 100% !important;
        padding: 0;
    }
</style>
<div class="modal modal modal-primary fade " id="machineModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Activate - <span id="machineName"></span></h4>
            </div>
            <div class="modal-body">
                <?php $model = new Customers(); ?>
                <div class="md-form mb-5">
                    <?php echo CHtml::activeDropDownList($model, 'id', CHtml::listData(Customers::model_getAllData_byDeletedCLientID(Utilities::NO, Settings::get_ClientID()), 'id', 'lnameFname'), array('id' => "defaultForm-customer", 'class' => "select form-control validate", 'prompt' => '--select--')); ?>


                    <label data-error="wrong" data-success="right" for="defaultForm-customer">Customer Name</label>
                </div>

                <input type="hidden" id="machineID" name="machineID" >
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline" onCLick="activate()">Activate</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">
        window.onload = function () {

            var machineCount = $('#machineCount').val();



            for (i = 0; i < machineCount; i++) {
                var machineID = parseInt(i + 1);
                $.ajax({
                    type: 'GET',
                    url: '?r=backoffice/machines/getTotalMinutes',
                    data: 'machineID=' + machineID,
                    async: false,
                    success: function (totalMinutes) {
                        //alert(totalMinutes);
                        var fiveMinutes = 60 * totalMinutes;
                        display = document.querySelector('#machineTimer' + machineID);
                        startTimer(fiveMinutes, display);


                    }
                });

            }
//            setTimeout(function () {
//                            location.reload();
//            }, 5000);
        };
        function startTimer(duration, display) {

            var timer = duration, hours, minutes, seconds;

            setInterval(function () {

                hours = parseInt(timer / 60 / 60, 10);
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = ' - ' + hours + ":" + minutes + ":" + seconds;

                if (--timer < 0) {
                    timer = duration;
                }
            }, 1000);

        }


        function showActivateMachineModal(id, name) {

            $('#machineModal').modal('show');
            $('#machineName').html(name);
            $('#machineID').val(id);

        }

        function activate() {

            var custID = $('#defaultForm-customer').val();
            var machineID = $('#machineID').val();

            $.ajax({
                type: 'GET',
                url: '?r=backoffice/machines/remoteActivationSubmit',
                data: 'custID=' + custID + '&machineID=' + machineID,
                async: false,
                success: function (returnMsg) {
                    console.log(returnMsg);

                    var result = JSON.parse(returnMsg);
                    var test =
                        $.get(result.url, '', function (r) {

                            console.log(result.url);/* your callback */
                        });
                    console.log(test);/* your callback */
                    if (result.isError == 0) {
                        messageBox(1, result.message);
                        $('#machineModal').modal('hide');
                        setTimeout(function () {
                            location.reload();
                        }, 1000);

                    } else {

                        messageBox(0, result.message);
                    }
                }
            });

        }

        function messageBox(val, message) {
            if (val == 1) {
                $.smallBox({
                    title: 'Message!',
                    content: message,
                    color: '#739E73',
                    icon: 'fa fa-check shake animated',
                    number: '1',
                    timeout: 2000

                });
            } else {
                $.smallBox({
                    title: 'Warning!',
                    content: message,
                    color: '#C46A69',
                    icon: 'fa fa-warning shake animated',
                    number: '1',
                    timeout: 2000
                });
            }
        }


</script>