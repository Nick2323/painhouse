<?php

class Member extends CActiveRecord
{
    public $ID;
    public $FullName;
    public $PhotoName;
    public $Description;

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'members';
    }

    public function attributeLabels()
    {
        return array(
            'ID' => 'ID',
            'FullName' => 'Повне ім\'я',
            'PhotoName' => 'Фото',
            'Description' => 'Опис'
        );
    }
}
