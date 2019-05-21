<ul>
    <li><?php echo CHtml::link('Create New Post',array('distributors/encode')); ?></li>
    <li><?php echo CHtml::link('Manage Posts',array('distributors/admin')); ?></li>
    <li><?php echo CHtml::link('Approve Comments',array('comment/index'))
              . ' (' . Comment::model()->pendingCommentCount . ')'; ?></li>
    <li><?php echo CHtml::link('Logout',array('site/logout')); ?></li>
</ul>
