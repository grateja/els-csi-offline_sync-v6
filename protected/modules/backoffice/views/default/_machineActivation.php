<br />
<article class="col-sm-12">
    <div class="jarviswidget jarviswidget-color-trandzendWhite" id="wid-id-4" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
        <h1>Non-Enrollment Payment Headers</h1>

        <header>
            <span class="widget-icon"> <i class="fa fa-edit"></i> </span>  
            <h2>Computerized Machine Activation</h2>
        </header>

        <div class="modal-content"> 
            <?php $this->widget('flashes'); ?>

            <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                <thead>			                
                    <tr>
                        <th data-hide="phone">ID</th>
                        <th data-class="expand"><i class="fa fa-fw fa-calendar text-muted hidden-md hidden-sm hidden-xs"></i> Date</th>
                        <th data-hide="phone"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>Device Name</th>
                        <th data-hide="phone,tablet"><i class="fa fa-fw fa-list txt-color-blue hidden-md hidden-sm hidden-xs"></i>Device Type</th>
                        <th data-hide="phone,tablet"><i class="fa fa-fw fa-gear txt-color-blue hidden-md hidden-sm hidden-xs"></i> Cycle Count per day</th>
                        <th data-hide="phone,tablet"><i class="fa fa-fw fa-gear txt-color-blue hidden-md hidden-sm hidden-xs"></i> Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $model = new Machines();
                    $model = Machines::model_getAllData_byDeleted(Utilities::NO);
                    ?>
                    <?php foreach ($model as $machine): ?>
                        <tr>
                            <td><?php print $machine->id ?></td>
                            <td><?php print Settings::setDateStandard($machine->created_at); ?></td>
                            <td><?php print $machine->name ?></td>
                            <td><?php print $machine->machineTypes->name ?></td>
                            <td><?php print $machine->cycleCountByDate ?></td>
                            <td><?php print $machine->activateBtn ?></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>

        </div>
    </div>
</article>
<br/>


<?php
Yii::app()->clientScript->registerScript("javascript", "
       
    $('select').select2({ width: 'resolve' });
    $('.select2-hidden-accessible').attr('hidden', true);
    $( 'input' ).addClass('form-control' );

    function reinstallDatePicker(id, data) {
            //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
        $('.datePicker').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['ja'],{'dateFormat':'yy-mm-dd'}));
        
        $( 'input' ).addClass('form-control' );
        $('select').select2({ width: 'resolve' });
        $('.select2-hidden-accessible').attr('hidden', true);
        hover();
    }
    
    function hover()
    {
        $('[rel=tooltip]').tooltip();
    }
    
    function checkAll(value) {
        var btns = document.getElementsByClassName(value);
        for(i=0;i<btns.length;i++) {
            btns[i].checked = true;
        }
    }

    function uncheckAll(value) {
        var btns = document.getElementsByClassName(value);
        for(i=0;i<btns.length;i++) {
            btns[i].checked = false;
        }
    }
    
      function saveNavigationAuthorizationByUserAccount() {

        var userAccount = document.getElementById('userAccount').value;

        var chkArray = [];
        var unchkArray = [];

        $('.mod:checked').each(function() {
                chkArray.push($(this).val());
        });

        $('.mod:unchecked').each(function() {
                unchkArray.push($(this).val());
        });

        var selected;
        selected = chkArray.join(',') + ',';
        var unselected;
        unselected = unchkArray.join(',') + ',';       

        //alert(unselected);
        if (userAccount === '' || userAccount === null) {
            alertify.alert('Please select User Account.').set({transition:'fade', title: 'WARNING!', movable: false});
        } else {
            if(selected.length > 1){
                $.ajax({
                    url: '?r=user/users/ajaxSumbitUserAccess',
                    type: 'POST',
                    dataType: 'text',
                    data:{ userAccount:userAccount, selected:selected, unselected:unselected},

                    success: function(data) {
                   // alert(data);
                   console.log(data);
                   var result = JSON.parse(data);
                  //  alert(result.name);
                        alertify.alert(result.message).set({transition:'fade', title: 'SUCCESS!', movable: false});
                    },
                    error:{
                    }
                });	
            }else{
                    alertify.alert('Please Select at least one of the checkbox.').set({transition:'fade', title: 'WARNING!', movable: false});	
            }
        }
    }

    ", 2);
?>
