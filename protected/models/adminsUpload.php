<?php

class adminsUpload extends CActiveRecord
{
    public $ID;
    public $MediaType;
    public $MediaFileName;
    public $Description;
    public $Extra;

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'media';
    }

    public function attributeLabels()
    {
        return array(
            'ID'=>'ID',
            'MediaType'=>'MediaType',
            'MediaFileName'=>'MediaFileName',
            'Description'=>'Description',
            'Extra'=>'Extra'
        );
    }

}