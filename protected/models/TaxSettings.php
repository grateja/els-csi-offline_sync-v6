<?php

/**
 * This is the model class for table "tax_settings".
 *
 * The followings are the available columns in table 'tax_settings':
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $client_id
 * @property integer $branch_id
 * @property integer $loyalty_type_id
 * @property string $name
 * @property string $precentage
 * @property integer $tax_type_id
 * @property integer $tax_option_id
 * @property integer $is_sync
 * @property integer $is_deleted
 */
class TaxSettings extends CActiveRecord {

    CONST TAX_TYPE_INCLUDED = 1;
    CONST TAX_TYPE_ADDED = 2;
    CONST TAX_OPTION_NEW = 1;
    CONST TAX_OPTION_EXISTING = 2;
    CONST TAX_OPTION_ALL = 3;

    public static function get_ActiveTaxType($id = null)
    {
        $active = array(
            self::TAX_TYPE_INCLUDED => 'Included in item',
            self::TAX_TYPE_ADDED => 'Added to items',
        );
        if (is_null($id))
            return $active;
        else
            return $active[$id];
    }

    public static function get_ActiveTaxOption($id = null)
    {
        $active = array(
            self::TAX_OPTION_NEW => 'Apply to new',
            self::TAX_OPTION_EXISTING => 'Apply to existing',
            self::TAX_OPTION_ALL => 'Apply to all',
        );
        if (is_null($id))
            return $active;
        else
            return $active[$id];
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tax_settings';
    }

    public static function tbl()
    {
        return self::tableName();
    }

    public function beforeSave()
    {
        if ($this->isNewRecord)
            $this->created_at = Settings::get_DateTime();
        else
            $this->updated_at = Settings::get_DateTime();

        return parent::beforeSave();
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('created_at', 'required'),
            array('client_id, branch_id, loyalty_type_id, tax_type_id, tax_option_id, is_sync, is_deleted', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 100),
            array('precentage', 'length', 'max' => 12),
            array('updated_at', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, created_at, updated_at, client_id, branch_id, loyalty_type_id, name, precentage, tax_type_id, tax_option_id, is_sync, is_deleted', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'clients' => array(self::BELONGS_TO, 'Clients', 'client_id'),
            'branches' => array(self::BELONGS_TO, 'Branches', 'branch_id'),
            'loyaltyTypes' => array(self::BELONGS_TO, 'LoyaltyTypes', 'loyalty_type_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'Id',
            'created_at' => 'Date Created',
            'updated_at' => 'Last Modified',
            'client_id' => 'Client',
            'branch_id' => 'Branch',
            'loyalty_type_id' => 'Loyalty Type',
            'name' => 'Name',
            'precentage' => 'Precentage',
            'tax_type_id' => 'Tax Type',
            'tax_option_id' => 'Tax Option',
            'is_sync' => 'Is Sync',
            'is_deleted' => 'Is Deleted',
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
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);

        $criteria->compare('created_at', $this->created_at, true);

        $criteria->compare('updated_at', $this->updated_at, true);

        $criteria->compare('client_id', $this->client_id);

        $criteria->compare('branch_id', $this->branch_id);

        $criteria->compare('loyalty_type_id', $this->loyalty_type_id);

        $criteria->compare('name', $this->name, true);

        $criteria->compare('precentage', $this->precentage, true);

        $criteria->compare('tax_type_id', $this->tax_type_id);

        $criteria->compare('tax_option_id', $this->tax_option_id);

        $criteria->compare('is_sync', $this->is_sync);

        $criteria->compare('is_deleted', $this->is_deleted);

        $criteria->order = 'created_at DESC';

        return new CActiveDataProvider('TaxSettings', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Utilities::PAGE_SIZE,
            )
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * @return TaxSettings the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function model_getAllData_byDeleted($isDeleted)
    {
        return self::model()->findAll('is_deleted = :isDeleted', array(':isDeleted' => $isDeleted));
    }

    function getIsDeleted()
    {
        return Utilities::get_ActiveSelect($this->is_deleted);
    }

    function getTaxType()
    {
        return self::get_ActiveTaxType($this->tax_type_id);
    }

    function getTaxOption()
    {
        return self::get_ActiveTaxOption($this->tax_type_id);
    }

}
