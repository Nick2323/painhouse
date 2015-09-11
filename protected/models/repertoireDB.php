<?php

class repertoireDB extends CActiveRecord
{
    public $ID;
    public $Name;
    public $Category;

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'repertoire';
    }

    public function attributeLabels()
    {
        return array(
            'ID'=>'ID',
            'Name'=>'Name',
            'Category'=>'Category'
        );
    }

}