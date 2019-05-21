<?php

/**
 * This is the model class for table "raw_data".
 *
 * The followings are the available columns in table 'raw_data':
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $date
 * @property string $branch
 * @property integer $job_order
 * @property string $customer_name
 * @property string $wdf
 * @property string $wdp
 * @property integer $hand_wash
 * @property integer $dry_clean
 * @property integer $press_only
 * @property string $total_volume
 * @property string $revenue_wdf
 * @property string $revenue_wdp
 * @property string $revenue_hand_wash
 * @property string $revenue_dry_clean
 * @property string $revenue_press_only
 * @property string $total_revenue
 * @property string $payments
 * @property string $accounts_receivable
 * @property string $rent
 * @property string $salaries
 * @property string $electricity
 * @property string $water
 * @property string $supplies
 * @property string $total_expenses
 * @property integer $is_deleted
 */
class RawData extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'raw_data';
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
            array('created_at, date, branch, customer_name', 'required'),
            array('job_order, hand_wash, dry_clean, press_only, is_deleted', 'numerical', 'integerOnly' => true),
            array('branch, customer_name', 'length', 'max' => 255),
            array('wdf, wdp, total_volume, revenue_wdf, revenue_wdp, revenue_hand_wash, revenue_dry_clean, revenue_press_only, total_revenue, payments, accounts_receivable, rent, salaries, electricity, water, supplies, total_expenses', 'length', 'max' => 12),
            array('updated_at', 'safe'),
// The following rule is used by search().
// Please remove those attributes that should not be searched.
            array('id, created_at, updated_at, date, branch, job_order, customer_name, wdf, wdp, hand_wash, dry_clean, press_only, total_volume, revenue_wdf, revenue_wdp, revenue_hand_wash, revenue_dry_clean, revenue_press_only, total_revenue, payments, accounts_receivable, rent, salaries, electricity, water, supplies, total_expenses, is_deleted', 'safe', 'on' => 'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'Id',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'date' => 'Date',
            'branch' => 'Branch',
            'job_order' => 'Job Order',
            'customer_name' => 'Customer Name',
            'wdf' => 'Wdf',
            'wdp' => 'Wdp',
            'hand_wash' => 'Hand Wash',
            'dry_clean' => 'Dry Clean',
            'press_only' => 'Press Only',
            'total_volume' => 'Total Volume',
            'revenue_wdf' => 'Revenue Wdf',
            'revenue_wdp' => 'Revenue Wdp',
            'revenue_hand_wash' => 'Revenue Hand Wash',
            'revenue_dry_clean' => 'Revenue Dry Clean',
            'revenue_press_only' => 'Revenue Press Only',
            'total_revenue' => 'Total Revenue',
            'payments' => 'Payments',
            'accounts_receivable' => 'Accounts Receivable',
            'rent' => 'Rent',
            'salaries' => 'Salaries',
            'electricity' => 'Electricity',
            'water' => 'Water',
            'supplies' => 'Supplies',
            'total_expenses' => 'Total Expenses',
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

        $criteria->compare('date', $this->date, true);

        $criteria->compare('branch', $this->branch, true);

        $criteria->compare('job_order', $this->job_order);

        $criteria->compare('customer_name', $this->customer_name, true);

        $criteria->compare('wdf', $this->wdf, true);

        $criteria->compare('wdp', $this->wdp, true);

        $criteria->compare('hand_wash', $this->hand_wash);

        $criteria->compare('dry_clean', $this->dry_clean);

        $criteria->compare('press_only', $this->press_only);

        $criteria->compare('total_volume', $this->total_volume, true);

        $criteria->compare('revenue_wdf', $this->revenue_wdf, true);

        $criteria->compare('revenue_wdp', $this->revenue_wdp, true);

        $criteria->compare('revenue_hand_wash', $this->revenue_hand_wash, true);

        $criteria->compare('revenue_dry_clean', $this->revenue_dry_clean, true);

        $criteria->compare('revenue_press_only', $this->revenue_press_only, true);

        $criteria->compare('total_revenue', $this->total_revenue, true);

        $criteria->compare('payments', $this->payments, true);

        $criteria->compare('accounts_receivable', $this->accounts_receivable, true);

        $criteria->compare('rent', $this->rent, true);

        $criteria->compare('salaries', $this->salaries, true);

        $criteria->compare('electricity', $this->electricity, true);

        $criteria->compare('water', $this->water, true);

        $criteria->compare('supplies', $this->supplies, true);

        $criteria->compare('total_expenses', $this->total_expenses, true);

        $criteria->compare('is_deleted', $this->is_deleted);

        $criteria->order = 'created_at DESC';

        return new CActiveDataProvider('RawData', array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * @return RawData the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function model_getAllData_byDeleted($isDeleted)
    {
        return self::model()->findAll('is_deleted = :isDeleted group by branch', array(':isDeleted' => $isDeleted));
    }

    function getIsDeleted()
    {
        return Utilities::get_ActiveSelect($this->is_deleted);
    }

    public function sql_getAllData()
    {
        $cnn = Utilities::createConnection();
        $sql = 'SELECT DISTINCT(branch) FROM ' . self::tbl();
        $command = $cnn->createCommand($sql);
        return $command->queryAll();
    }

    public function sql_getAllCustomers()
    {
        $cnn = Utilities::createConnection();
        $sql = 'SELECT DISTINCT(customer_name) FROM ' . self::tbl();
        $command = $cnn->createCommand($sql);
        return $command->queryAll();
    }

}
