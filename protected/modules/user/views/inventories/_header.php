<!--<div class="page-header">
    <table style="width: 100%;font-family:'Arial'; " >
        <tr>
            <td style="width: 10%;">
                <?php 
                    $model = new Branches();
                    $model = Utilities::model_getByID(Branches::model(), Settings::get_BranchID());
                ?>
                <?php print CHtml::image(Settings::get_baseUrl(). '/' . $model->file_path . '' . $model->file_pics, 'alt', array("width" => "60px", "height" => "60px")); ?>
          </td>

            <td style="margin-top: 10px;">
                <?php
                print '<div style="font-size: 16px;"><strong>' . Settings::model_getValue_byID(Settings::CONFIG_COMPANY_NAME)->value . '</div>
                    <div style="font-size: 12px;">Caloocan City</div>
                    <div style="font-size: 12px;"> 410 - 3343 to 46 / 416 - 1151 / 373 - 2332 Fax</div>
                     <div style="font-size: 12px;">http://www.smcFurniture.com / smcFurniture@gmail.com</div>';
                ?>
            </td>
        </tr> 

    </table>

    <hr style="margin-top: 5px;"/>


</div>-->
