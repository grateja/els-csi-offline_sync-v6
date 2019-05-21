<?php

    /**
     * This is the model class for table "inventories".
     *
     * The followings are the available columns in table 'inventories':
     * @property integer $id
     * @property string $created_at
     * @property string $updated_at
     * @property integer $branch_id
     * @property integer $client_id
     * @property string $name
     * @property string $desc
     * @property string $bar_code
     * @property integer $category_id
     * @property string $price
     * @property string $cost
     * @property string $tax
     * @property string $margin
     * @property integer $qty_stock
     * @property integer $qty_reorder
     * @property string $file_path
     * @property string $file_pics
     * @property integer $is_sync
     * @property integer $is_deleted
     * @property integer $token
     * @property string $topup_amount
     * @property integer $service_type_id
     * @property integer $group_id
     * @property integer $color
     */
    class Inventories extends CActiveRecord {

        /**
         * @return string the associated database table name
         */
        public function tableName() {
            return 'inventories';
        }

        public static function tbl() {
            return self::tableName();
        }

        public function beforeSave() {
            if ($this->isNewRecord)
                $this->created_at = Settings::get_DateTime();
            else
                $this->updated_at = Settings::get_DateTime();

            return parent::beforeSave();
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules() {
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
            return array(
                array('created_at', 'required'),
                array('branch_id, client_id, category_id, qty_stock, qty_reorder, is_sync, is_deleted, token, service_type_id, group_id, color', 'numerical', 'integerOnly' => true),
                array('name, file_path, file_pics', 'length', 'max' => 100),
                array('bar_code', 'length', 'max' => 50),
                array('price, cost, tax, margin', 'length', 'max' => 12),
                array('updated_at, topup_amount, desc', 'safe'),
// The following rule is used by search().
// Please remove those attributes that should not be searched.
                array('id, created_at, updated_at, branch_id, client_id, name, bar_code, category_id, price, cost, tax, margin, qty_stock, qty_reorder, file_path, file_pics, is_sync, is_deleted, topup_amount, token, service_type_id, group_id, desc, color', 'safe', 'on' => 'search'),
                array('id, created_at, updated_at, branch_id, client_id, name, bar_code, category_id, price, cost, tax, margin, qty_stock, qty_reorder, file_path, file_pics, is_sync, is_deleted, topup_amount, token, service_type_id, group_id, desc, color', 'safe', 'on' => 'searchBranch'),
                array('id, created_at, updated_at, branch_id, client_id, name, bar_code, category_id, price, cost, tax, margin, qty_stock, qty_reorder, file_path, file_pics, is_sync, is_deleted, topup_amount, token, service_type_id, group_id, desc, color', 'safe', 'on' => 'searchClient'),
            );
        }

        /**
         * @return array relational rules.
         */
        public function relations() {
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
            return array(
                'inventoryCategories' => array(self::BELONGS_TO, 'InventoryCategories', 'category_id'),
                'clients' => array(self::BELONGS_TO, 'Clients', 'client_id'),
                'branches' => array(self::BELONGS_TO, 'Branches', 'branch_id'),
                'serviceTypes' => array(self::BELONGS_TO, 'ServiceTypes', 'service_type_id'),
            );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels() {
            return array(
                'id' => 'Id',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
                'branch_id' => 'Branch',
                'client_id' => 'Client',
                'name' => 'Name',
                'bar_code' => 'Bar Code',
                'category_id' => 'Category',
                'price' => 'Price',
                'cost' => 'Cost',
                'tax' => 'Tax',
                'margin' => 'Margin',
                'qty_stock' => 'Qty Stock',
                'qty_reorder' => 'Qty Reorder',
                'file_path' => 'File Path',
                'file_pics' => 'File Pics',
                'is_sync' => 'Is Sync',
                'topup_amount' => 'Free Topup',
                'token' => 'token',
                'service_type_id' => 'Service Type',
                'is_deleted' => 'Is Deleted',
                'group_id' => 'Group',
                'desc' => 'Description',
                'color' => 'Color',
            );
        }

        /**
         * Retrieves a list of models based on the current search/filter conditions.
         *
         * Typical usecase:
         * - Initialize the model fields with values from filter form.
         * - Execute this method to get CActiveDataProvider instance which will filter
         * models according to data in model fields.
         * - Pass data provider to CGridView, CListView or any similar widget.
         *
         * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
         */
        public function search() {
// Warning: Please modify the following code to remove attributes that
// should not be searched.

            $criteria = new CDbCriteria;

            $criteria->compare('id', $this->id);

            $criteria->compare('created_at', $this->created_at, true);

            $criteria->compare('updated_at', $this->updated_at, true);

            $criteria->compare('branch_id', $this->branch_id);

            $criteria->compare('client_id', $this->client_id);

            $criteria->compare('name', $this->name, true);

            $criteria->compare('bar_code', $this->bar_code, true);

            $criteria->compare('category_id', $this->category_id);

            $criteria->compare('price', $this->price, true);

            $criteria->compare('cost', $this->cost, true);

            $criteria->compare('tax', $this->tax, true);

            $criteria->compare('margin', $this->margin, true);

            $criteria->compare('qty_stock', $this->qty_stock);

            $criteria->compare('qty_reorder', $this->qty_reorder);

            $criteria->compare('file_path', $this->file_path, true);

            $criteria->compare('file_pics', $this->file_pics, true);

            $criteria->compare('is_sync', $this->is_sync);

            $criteria->compare('topup_amount', $this->topup_amount);

            $criteria->compare('is_deleted', Utilities::NO);

            $criteria->compare('token', $this->token);

            $criteria->compare('service_type_id', $this->service_type_id);

            $criteria->compare('group_id', $this->group_id);

            $criteria->compare('desc', $this->desc);

            $criteria->compare('color', $this->color);

            $criteria->compare('branch_id', $this->branch_id);


            $criteria->order = 'created_at DESC';

            return new CActiveDataProvider('Inventories', array(
                'criteria' => $criteria,
            ));
        }

        public function searchBranch() {
// Warning: Please modify the following code to remove attributes that
// should not be searched.

            $criteria = new CDbCriteria;

            $criteria->compare('id', $this->id);

            $criteria->compare('created_at', $this->created_at, true);

            $criteria->compare('updated_at', $this->updated_at, true);

            $criteria->compare('branch_id', Settings::get_BranchID());

            $criteria->compare('client_id', $this->client_id);

            $criteria->compare('name', $this->name, true);

            $criteria->compare('bar_code', $this->bar_code, true);

            $criteria->compare('category_id', $this->category_id);

            $criteria->compare('price', $this->price, true);

            $criteria->compare('cost', $this->cost, true);

            $criteria->compare('tax', $this->tax, true);

            $criteria->compare('margin', $this->margin, true);

            $criteria->compare('qty_stock', $this->qty_stock);

            $criteria->compare('qty_reorder', $this->qty_reorder);

            $criteria->compare('file_path', $this->file_path, true);

            $criteria->compare('file_pics', $this->file_pics, true);

            $criteria->compare('is_sync', $this->is_sync);

            $criteria->compare('topup_amount', $this->topup_amount);

            $criteria->compare('is_deleted', Utilities::NO);

            $criteria->compare('token', $this->token);

            $criteria->compare('service_type_id', $this->service_type_id);

            $criteria->compare('group_id', $this->group_id);

            $criteria->compare('desc', $this->desc);

            $criteria->compare('color', $this->color);

            $criteria->compare('branch_id', $this->branch_id);


            $criteria->order = 'created_at DESC';

            return new CActiveDataProvider('Inventories', array(
                'criteria' => $criteria,
            ));
        }

        public function searchClient() {
// Warning: Please modify the following code to remove attributes that
// should not be searched.

            $criteria = new CDbCriteria;

            $criteria->compare('id', $this->id);

            $criteria->compare('created_at', $this->created_at, true);

            $criteria->compare('updated_at', $this->updated_at, true);

            $criteria->compare('branch_id', $this->branch_id);

            $criteria->compare('client_id', Settings::get_ClientID());

            $criteria->compare('name', $this->name, true);

            $criteria->compare('bar_code', $this->bar_code, true);

            $criteria->compare('category_id', $this->category_id);

            $criteria->compare('price', $this->price, true);

            $criteria->compare('cost', $this->cost, true);

            $criteria->compare('tax', $this->tax, true);

            $criteria->compare('margin', $this->margin, true);

            $criteria->compare('qty_stock', $this->qty_stock);

            $criteria->compare('qty_reorder', $this->qty_reorder);

            $criteria->compare('file_path', $this->file_path, true);

            $criteria->compare('file_pics', $this->file_pics, true);

            $criteria->compare('is_sync', $this->is_sync);

            $criteria->compare('topup_amount', $this->topup_amount);

            $criteria->compare('is_deleted', Utilities::NO);

            $criteria->compare('token', $this->token);

            $criteria->compare('service_type_id', $this->service_type_id);

            $criteria->compare('group_id', $this->group_id);

            $criteria->compare('desc', $this->desc);

            $criteria->compare('color', $this->color);

            $criteria->compare('branch_id', $this->branch_id);


            $criteria->order = 'created_at DESC';

            return new CActiveDataProvider('Inventories', array(
                'criteria' => $criteria,
            ));
        }

        /**
         * Returns the static model of the specified AR class.
         * @return Inventories the static model class
         */
        public static function model($className = __CLASS__) {
            return parent::model($className);
        }

        public static function model_getAllData_byDeleted($isDeleted) {
            return self::model()->findAll('is_deleted = :isDeleted', array(':isDeleted' => $isDeleted));
        }

        function getIsDeleted() {
            return Utilities::get_ActiveSelect($this->is_deleted);
        }

        public static function model_getAllData_byCategoryID($categoryID, $isDeleted, $branchID) {
            return self::model()->findAll('is_deleted = :isDeleted  AND category_id = :categoryID AND branch_id =:branchID ORDER by name ASC', array(':isDeleted' => $isDeleted, ':categoryID' => $categoryID, ':branchID' => $branchID));
        }

        public static function model_getAllData_byCategoryIDServiceTypeID($branchID, $isDeleted, $categoryID, $groupID) {
            return self::model()->findAll('branch_id =:branchID AND is_deleted = :isDeleted  AND category_id = :categoryID AND group_id = :groupID ORDER by name ASC', array(':isDeleted' => $isDeleted, ':categoryID' => $categoryID, ':branchID' => $branchID, ':groupID' => $groupID));
        }

        public static function model_getAllProducts($categoryID, $isDeleted, $branchID) {
            return self::model()->findAll('is_deleted = :isDeleted  AND category_id = :categoryID AND branch_id =:branchID ORDER by name ASC', array(':isDeleted' => $isDeleted, ':categoryID' => $categoryID, ':branchID' => $branchID));
        }

        public static function sql_deductQtyStock($id, $quantity) {
            $cnn = Utilities::createConnection();
            $sql = 'UPDATE  ' . self::tbl() . ' set qty_stock = qty_stock - :quantity WHERE id = :ID limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':quantity', $quantity, PDO::PARAM_INT);
            $command->bindValue(':ID', $id, PDO::PARAM_INT);
            return $command->execute();
        }

        public static function sql_addQtyStock($id, $quantity) {
            $cnn = Utilities::createConnection();
            $sql = 'UPDATE  ' . self::tbl() . ' set qty_stock = qty_stock + :quantity WHERE id = :ID limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':quantity', $quantity, PDO::PARAM_INT);
            $command->bindValue(':ID', $id, PDO::PARAM_INT);
            return $command->execute();
        }

        public static function model_getAllProducts_byCategoryID($categoryID, $isDeleted, $branchID) {
            return self::model()->findAll('is_deleted = :isDeleted  AND category_id != :categoryID AND branch_id =:branchID ORDER by name ASC', array(':isDeleted' => $isDeleted, ':categoryID' => $categoryID, ':branchID' => $branchID));
        }

        public static function model_getData_byID($inventoryID, $isDeleted, $branchID) {
            return self::model()->find('is_deleted = :isDeleted  AND id = :ID AND branch_id =:branchID ORDER by name ASC', array(':isDeleted' => $isDeleted, ':ID' => $inventoryID, ':branchID' => $branchID));
        }

        public static function sql_updateCost($id, $amount) {
            $cnn = Utilities::createConnection();
            $sql = 'UPDATE  ' . self::tbl() . ' set cost = :cost WHERE id = :ID limit 1';
            $command = $cnn->createCommand($sql);
            $command->bindValue(':cost', $amount, PDO::PARAM_STR);
            $command->bindValue(':ID', $id, PDO::PARAM_INT);
            return $command->execute();
        }

        function getRowColor() {
            $qtyStock = $this->qty_stock;
            $qtyReorder = $this->qty_reorder;
            $categoryID = $this->category_id;
            if ($categoryID == 1) {
                if ($qtyStock <= $qtyReorder) {
                    $bgcolor = "bg-danger";
                } else {
                    $bgcolor = "";
                }
            }


            return $bgcolor;
        }

        public static function model_getAllProducts_byCategoryIDClientID($categoryID, $isDeleted, $clientID) {
            return self::model()->findAll('is_deleted = :isDeleted  AND category_id != :categoryID AND client_id =:clientID ORDER by name ASC', array(':isDeleted' => $isDeleted, ':categoryID' => $categoryID, ':clientID' => $clientID));
        }

        public static function model_getAllData_byDeletedClientID($isDeleted, $clientID) {
            return self::model()->findAll('is_deleted = :isDeleted AND client_id = :clientID', array(':isDeleted' => $isDeleted, ':clientID' => $clientID));
        }

        public function getInventory($branchID) {

            $model = new Inventories();
            $model = Inventories::model_getAllProducts_byCategoryID(InventoryCategories::INVENTORY_TYPE_SERVICES, Utilities::NO, $branchID);

            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            print $this->renderPartial('/layouts/_dropDownList/_dropDownList', array('model' => $model, 'classficationID' => $branchID, 'name' => null, 'class' => NULL), false, true);
        }

        public static function model_getAllProducts_byCategoryIDClientID_isDeleted($categoryID, $isDeleted, $clientID) {
            return self::model()->findAll('is_deleted = :isDeleted  AND category_id = :categoryID AND client_id =:clientID ORDER by name ASC', array(':isDeleted' => $isDeleted, ':categoryID' => $categoryID, ':clientID' => $clientID));
        }

        public function addRecord() {
            $model = new Inventories();
            $model->created_at = $this->created_at;
            $model->updated_at = $this->updated_at;
            $model->branch_id = $this->branch_id;
            $model->client_id = $this->client_id;
            $model->name = $this->name;
            $model->bar_code = $this->bar_code;
            $model->category_id = $this->category_id;
            $model->price = $this->price;
            $model->cost = $this->cost;
            $model->tax = $this->tax;
            $model->margin = $this->margin;
            $model->qty_stock = $this->qty_stock;
            $model->qty_reorder = $this->qty_reorder;
            $model->file_path = $this->file_path;
            $model->file_pics = $this->file_pics;
            $model->is_sync = $this->is_sync;
            $model->topup_amount = $this->topup_amount;
            $model->token = $this->token;
            $model->service_type_id = $this->service_type_id;
            $model->is_deleted = $this->is_deleted;
            $model->group_id = $this->group_id;
            $model->desc = $this->desc;
            $model->color = $this->color;


            $model->validate();
            if ($model->save()) {
                $ID = $model->id;
                $message = 'Successfully Inserted';
            } else {
                $ID = 0;
                $message = $model->errors;
            }
            return array('ID' => $ID, 'message' => $message);
        }

        public static function model_getAllData_byDeletedCLientID_branchID($isDeleted, $clientID, $branchID) {
            return self::model()->findAll('is_sync = :isDeleted AND client_id = :clientID AND branch_id = :branchID ', array(':isDeleted' => $isDeleted, ':clientID' => $clientID, ':branchID' => $branchID));
        }

    }
    