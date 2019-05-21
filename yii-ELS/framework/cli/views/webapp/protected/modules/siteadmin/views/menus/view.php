<div class="col-lg-4">
    <div class="metronicView">
        <header>
            <span><i class="minia-icon-search"></i>View - Menus</span>
            <?php print CHtml::link('<i class="brocco-icon-plus"></i>', $this->createUrl('menus/create'), array('class' => 'btn-back', 'data-tooltip' => 'Create')); ?>
            <?php print CHtml::link('View/Search', $this->createUrl('menus/admin'), array('class' => 'btn-back')); ?>
        </header>
        <div class ="row">
            <ul class = "col-lg-12 unstyled">
                <li>
                    <span class="icon12 typ-icon-arrow-right"></span>
                    Date Created
                    <strong> <?php echo $model->created_at ?></strong>
                </li> 
                <li>
                    <span class="icon12 typ-icon-arrow-right"></span>
                    Last Modified
                    <strong> <?php echo $model->updated_at ?></strong>
                </li> 
                <li>
                    <span class="icon12 typ-icon-arrow-right"></span>
                    Name
                    <strong> <?php echo $model->name ?></strong>
                </li> 
                <li>
                    <span class="icon12 typ-icon-arrow-right"></span>
                    Modules
                    <strong> <?php echo $model->modules->name ?></strong>
                </li> 
                <li>
                    <span class="icon12 typ-icon-arrow-right"></span>
                    Controllers
                    <strong> <?php echo $model->controllers->name ?></strong>
                </li> 
                <li>
                    <span class="icon12 typ-icon-arrow-right"></span>
                    Action
                    <strong> <?php echo $model->actions->name ?></strong>
                </li> 
                <li>
                    <span class="icon12 typ-icon-arrow-right"></span>
                    Parent
                    <strong> <?php echo $model->is_parent ?></strong>
                </li> 
                <li>
                    <span class="icon12 typ-icon-arrow-right"></span>
                    Url
                    <strong> <?php echo $model->is_url ?></strong>
                </li> 
            </ul>
        </div>
    </div>
</div>