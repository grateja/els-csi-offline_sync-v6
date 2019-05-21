<!-- NEW COL START -->
<br />
<article class="col-sm-12 col-md-12 col-lg-6">
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-4" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">

            <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2>View Machine</h2>
            </header>

            <div class="modal-content">
                <?php $this->widget('Flashes'); ?>
                <div class="widget-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <td><?php echo $model->machineTypes->name;?></td>
                                </tr>                                
                                <tr>
                                    <th>Name</th>
                                    <td><?php echo $model->name;?></td>
                                </tr>
                                <tr>
                                    <th>Ip Address</th>
                                    <td><?php echo $model->ip_address;?></td>
                                </tr>

                                <tr>
                                    <td>Today Usage</td>
                                    <td>
                                        
                                        <?php $todayCycles = Machines::sql_getTotalCycles_byDateMachineID(Settings::get_Date(), $model->id); ?>
                                        <?php $todayMinutes = MachineUsageHeaders::sql_getTotalMinutes_byMachineID_Date(Settings::get_Date(), $model->id);?><?php //print $todayCycles; ?>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center;">Minutes</th>
                                                        <th style="text-align: center;">Cycles</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: center; font-weight: bold;"><?php print $todayMinutes; ?></td>
                                                        <td style="text-align: center; font-weight: bold;"><?php print $todayCycles; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total Usage</td>
                                    <td>
                                        
                                        <?php $totalCycles = Machines::sql_getTotalCycles($model->id); ?>
                                        <?php $totalMinutes = Utilities::setNumberFormat(MachineUsageHeaders::sql_getTotalMinutes_byMachineID($model->id),0); ?>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center;">Minutes</th>
                                                        <th style="text-align: center;">Cycles</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: center; font-weight: bold;"><?php print $totalMinutes; ?></td>
                                                        <td style="text-align: center; font-weight: bold;"><?php print $totalCycles; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>                                        
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td style="font-size: 14px; font-weight: bold;">
                                        <?php 
                                            $machineStatusID = Machines::sql_getMachineStatusID_byID($model->id);
                                            print MachineStatuses::sql_getName_byID($machineStatusID); 
                                        ?>
                                    </td>
                                </tr>         
                                <?php if($machineStatusID == MachineStatuses::STATUS_RUNNING): ?>
                                            <tr>
                                                <th>End Time</th>
                                                <td><?php 
                                                        $machineUsageHeaderID = MachineUsageHeaders::sql_getLastID_byMachineID($model->id);
                                                        print Settings::setDateTimeStandardAmPm(MachineUsageHeaders::sql_getEndDateTime_byID($machineUsageHeaderID));

                                                    ?></td>
                                            </tr>
                                    <?php endif; ?>
                            </thead>
                        </table>
                    </div>
                </div>
            <!-- end widget content -->
            </div>
        </div>
        <!-- end widget div -->
</article>

