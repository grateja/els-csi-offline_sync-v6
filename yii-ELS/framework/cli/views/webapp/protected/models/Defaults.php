<?php

/**
 * This is the model class for table "barangays".
 *
 * The followings are the available columns in table 'barangays':
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $municipality_id
 * @property string $name
 * @property integer $is_deleted
 */
class Defaults extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Barangays the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function setClassActive($value = null)
    {
        $_SESSION['default']['classActive'] = $value;
    }

    public static function getClassActive()
    {
        return $_SESSION['default']['classActive'];
    }

    public static function setClassOpen($value = null)
    {
        $_SESSION['default']['classOpen'] = $value;
    }

    public static function getClassOpen()
    {
        return $_SESSION['default']['classOpen'];
    }

}
