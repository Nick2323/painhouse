<?php /* @var $this Controller */ 
header("Content-Type: text/html; charset=UTF-8")
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/reset.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/style_3.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/shop-item.css">
    <script src="<?php echo Yii::app()->baseUrl;?>/jc/bootstrap.js"></script>
    <script src="<?php echo Yii::app()->baseUrl;?>/jc/bootstrap.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl;?>/jc/jquery.js"></script>
    <script src="<?php echo Yii::app()->baseUrl;?>/jc/main.js"></script>
    <script src="<?php echo Yii::app()->baseUrl;?>/jc/modernizr.js"></script>
    <script src="<?php echo Yii::app()->baseUrl;?>/jc/snap.svg-min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl;?>/jc/snap.svg-min.js"></script>

<!--    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>-->
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body class="main">

<div class="pageMain1" id="page">
<!--    <div class="topContent">-->
<!--        <div class="topContent-name">-->
<!--            <p>Ансамбль<br> Воля.</p>-->
<!--        </div>-->
<!--    </div>-->
    <div class="head_contain">

    </div>
<!--    <div class="topMenu">-->
<!--        <div class="naviMenu">-->
<!--            <ul>-->
<!--                <li>--><?php //echo CHtml::link('Головна',array('site/index')); ?><!--</li>-->
<!--                <li>--><?php //echo CHtml::link('Склад ансамблю',array('site/ensemble')); ?><!--</li>-->
<!--                <li onmouseleave="NavigationOut(this)" onmouseenter="NavigationSlide(this)">--><?php //echo CHtml::link('Галерея',array('site/gallery')); ?>
<!--                    <ul>-->
<!--                        <li>--><?php //echo CHtml::link('Фото',array('site/photo')); ?><!--</li>-->
<!--                        <li>--><?php //echo CHtml::link('Відео',array('site/video')); ?><!--</li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li>--><?php //echo CHtml::link('Репертуар',array('site/repertoire')); ?><!--</li>-->
<!--                <li>--><?php //echo CHtml::link('Контакти',array('site/contacts')); ?><!--</li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </div>-->

    <div class="content">
	    <?php echo $content; ?>
    </div>

	<div class="clear"></div>

<!-- page -->
           
<!--<div id="footer">-->
<!--            <ul>-->
<!--                <li>--><?php //echo CHtml::link('Головна',array('site/index')); ?><!--</li>-->
<!--                <li>--><?php //echo CHtml::link('Склад ансамблю',array('site/ensemble')); ?><!--</li>-->
<!--                <li>--><?php //echo CHtml::link('Галерея',array('site/gallery')); ?><!--</li>-->
<!--                <li>--><?php //echo CHtml::link('Репертуар',array('site/repertoire')); ?><!--</li>-->
<!--                <li>--><?php //echo CHtml::link('Контакти',array('site/contacts')); ?><!--</li>-->
<!--            </ul>-->
<!--</div>-->
  </div>     
		  
</body>
</html>
