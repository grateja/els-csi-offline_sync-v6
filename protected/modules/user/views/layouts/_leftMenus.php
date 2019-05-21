<li><?php print CHtml::link('<i class="fa fa-laptop"></i><span>POS</span>', $this->createUrl('default/index')); ?></li>
<li><?php print CHtml::link('<i class="fa fa-gamepad"></i><span>Remote Activation</span>', $this->createUrl('machines/remoteActivation')); ?></li>


<li class="treeview">
    <a href="#">
        <i class="fa fa-print"></i> <span>Reports</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
         <!--<li><?php // print CHtml::link('<i class="fa fa-circle-o"></i><span>P & L</span>', $this->createUrl('posTransactions/profitAndLoss')); ?></li>-->
        <li><?php print CHtml::link('<i class="fa fa-circle-o"></i><span>Transactions</span>', $this->createUrl('posTransactions/printReport')); ?></li>
        <li><?php print CHtml::link('<i class="fa fa-circle-o"></i><span>Unpaid Bills</span>', $this->createUrl('posTransactions/adminUnpaidTransactions')); ?></li>
        <li><?php print CHtml::link('<i class="fa fa-circle-o"></i><span>Receipts</span>', $this->createUrl('posPaymentHeaders/adminReceipts')); ?></li>
        <li><?php print CHtml::link('<i class="fa fa-circle-o"></i><span>Inventories</span>', $this->createUrl('inventories/printReport')); ?></li>
        <li><?php print CHtml::link('<i class="fa fa-circle-o"></i><span>Expenses</span>', $this->createUrl('expenses/printReport')); ?></li>
        <li><?php print CHtml::link('<i class="fa fa-circle-o"></i><span>Purchases</span>', $this->createUrl('purchases/printReport')); ?></li>
        <!--<li><?php // print CHtml::link('<i class="fa fa-circle-o"></i><span>Transactions</span>', $this->createUrl('posTransactions/adminTransactionLists')); ?></li>-->
        <!--<li><?php // print CHtml::link('<i class="fa fa-circle-o"></i><span>Unpaid Bills</span>', $this->createUrl('posTransactions/adminUnpaidTransactions')); ?></li>-->
        <!--<li><?php // print CHtml::link('<i class="fa fa-circle-o"></i><span>Receipts</span>', $this->createUrl('posPaymentHeaders/adminReceipts')); ?></li>-->
    </ul>
</li>
<li class="treeview">
    <a href="#">
        <i class="fa fa-book"></i> <span>People</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><?php print CHtml::link('<i class="fa fa-circle-o"></i><span>Customers</span>', $this->createUrl('customers/admin')); ?></li>
 
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-credit-card"></i> <span>Expenses</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><?php print CHtml::link('<i class="fa fa-circle-o"></i>Expenses Lists', $this->createUrl('expenses/admin')); ?></li>
       <li><?php print CHtml::link('<i class="fa fa-circle-o"></i><span>Purchases</span>', $this->createUrl('purchases/admin')); ?></li>

        <li class="treeview">
            <a href="#">
                <i class="fa fa-credit-card"></i> <span>Create</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><?php print CHtml::link('<i class="fa fa-circle-o"></i>Bills', $this->createUrl('expenses/create')); ?></li>
         
            </ul>
        </li>
    </ul>
</li>
<li class="treeview">
    <a href="#">
        <i class="fa fa-list-alt"></i> <span>Items</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><?php print CHtml::link('<i class="fa fa-circle-o"></i>Item Lists', $this->createUrl('inventories/admin')); ?></li>
        <li><?php print CHtml::link('<i class="fa fa-circle-o"></i>Products', $this->createUrl('inventories/create', array('categoryID' => InventoryCategories::INVENTORY_TYPE_PRODUCT))); ?></li>
        <li><?php print CHtml::link('<i class="fa fa-circle-o"></i>Services', $this->createUrl('inventories/create', array('categoryID' => InventoryCategories::INVENTORY_TYPE_SERVICES))); ?></li>
        <li><?php print CHtml::link('<i class="fa fa-circle-o"></i>Others', $this->createUrl('inventories/create', array('categoryID' => InventoryCategories::INVENTORY_TYPE_OTHERS))); ?></li>

    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-gears"></i> <span>Settings</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
     <li><?php print CHtml::link('<i class="fa fa-circle-o"></i>Change Password', $this->createUrl('users/changePassword', array('id' => Settings::get_UserID()))); ?></li>

    </ul>
</li>