<li><?php print CHtml::link('<i class="fa fa-list"></i><span>Dealers</span>', $this->createUrl('dealers/admin')); ?></li>
<li><?php print CHtml::link('<i class="fa fa-user"></i><span>Clients</span>', $this->createUrl('clients/admin')); ?></li>
<li><?php print CHtml::link('<i class="fa fa-list"></i><span>Branches</span>', $this->createUrl('branches/admin')); ?></li>
<!--
<li class="treeview">
    <a href="#">
        <i class="fa fa-print"></i> <span>Reports</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><?php //print CHtml::link('<i class="fa fa-circle-o"></i><span>Transactions</span>', $this->createUrl('posTransactions/adminTransactionLists'));     ?></li>
        <li><?php //print CHtml::link('<i class="fa fa-circle-o"></i><span>Unpaid Bills</span>', $this->createUrl('posTransactions/adminUnpaidTransactions'));     ?></li>
        <li><?php //print CHtml::link('<i class="fa fa-circle-o"></i><span>Receipts</span>', $this->createUrl('posPaymentHeaders/adminReceipts'));     ?></li>
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
        <li><?php //print CHtml::link('<i class="fa fa-circle-o"></i><span>Customers</span>', $this->createUrl('customers/admin'));     ?></li>
        <li><?php //print CHtml::link('<i class="fa fa-circle-o"></i><span>Employees</span>', $this->createUrl('employees/admin'));     ?></li>
        <li><?php //print CHtml::link('<i class="fa fa-circle-o"></i><span>Suppliers</span>', $this->createUrl('suppliers/admin'));     ?></li>
        <li><?php //print CHtml::link('<i class="fa fa-circle-o"></i>Users', $this->createUrl('users/admin'));     ?></li>   


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
        <li><?php //print CHtml::link('<i class="fa fa-circle-o"></i>Expenses Lists', $this->createUrl('expenses/admin'));     ?></li>
        <li><?php //print CHtml::link('<i class="fa fa-circle-o"></i>Expense Types', $this->createUrl('expensesTypes/admin'));     ?></li>
       <li><?php //print CHtml::link('<i class="fa fa-circle-o"></i><span>Purchases</span>', $this->createUrl('purchases/admin'));     ?></li>

        <li class="treeview">
            <a href="#">
                <i class="fa fa-credit-card"></i> <span>Create</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><?php //print CHtml::link('<i class="fa fa-circle-o"></i>Salaries', $this->createUrl('expenses/salaries'));     ?></li>
                <li><?php //print CHtml::link('<i class="fa fa-circle-o"></i>Bills', $this->createUrl('expenses/create'));     ?></li>
         
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
        <li><?php //print CHtml::link('<i class="fa fa-circle-o"></i>Item Lists', $this->createUrl('inventories/admin'));     ?></li>
        <li><?php //print CHtml::link('<i class="fa fa-circle-o"></i>Products', $this->createUrl('inventories/create', array('categoryID' => InventoryCategories::INVENTORY_TYPE_PRODUCT)));     ?></li>
        <li><?php //print CHtml::link('<i class="fa fa-circle-o"></i>Services', $this->createUrl('inventories/create', array('categoryID' => InventoryCategories::INVENTORY_TYPE_SERVICES)));     ?></li>
        <li><?php //print CHtml::link('<i class="fa fa-circle-o"></i>Others', $this->createUrl('inventories/create', array('categoryID' => InventoryCategories::INVENTORY_TYPE_OTHERS)));     ?></li>

    </ul>
</li>-->

<li class="treeview">
    <a href="#">
        <i class="fa fa-gears"></i> <span>Settings</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><?php print CHtml::link('<i class="fa fa-circle-o"></i>Create New User', $this->createUrl('users/create', array('id' => Settings::get_UserID()))); ?></li>
        <li><?php print CHtml::link('<i class="fa fa-circle-o"></i>Change Password', $this->createUrl('users/changePassword', array('id' => Settings::get_UserID()))); ?></li>

    </ul>
</li>