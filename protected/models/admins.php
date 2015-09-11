<?php

class admins extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'admins';
    }

    public function attributeLabels()
    {
        return array(
            'ID'=>'ID',
            'Login'=>'Login',
            'Password'=>'Password'
        );
    }

}