<?php $this->renderPartial('myStyle'); ?>
<?php $this->renderPartial('myJs');   ?>
<?php $this->renderPartial('myPOS', array('posTransactions' => $posTransactions)); ?>
<?php $this->renderPartial('_modals')?>
<?php $this->renderPartial('_modalPayment')?>
