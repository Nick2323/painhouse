<?php /* @var $this Controller */
header("Content-Type: text/html; charset=UTF-8")
?>
<!DOCTYPE html>
<html lang="uk">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="language" content="uk" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/reset.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/style_3.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/shop-item.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/modern.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl;?>/jc/bootstrap.js"></script>
    <script src="<?php echo Yii::app()->baseUrl;?>/jc/bootstrap.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl;?>/jc/main.js"></script>
    <script src="<?php echo Yii::app()->baseUrl;?>/jc/modernizr.js"></script>
    <script src="<?php echo Yii::app()->baseUrl;?>/jc/snap.svg-min.js"></script>

    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700&display=swap' rel='stylesheet' type='text/css'>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body class="main">

<div class="pageMain1" id="page">
    <header class="modern-header">
        <div class="container">
            <div class="header-content">
                <div class="brand">
                    <a href="<?php echo Yii::app()->baseUrl; ?>/index.php?r=site/index">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a7/React-icon.svg/1200px-React-icon.svg.png" alt="Ансамбль Воля Логотип" style="height: 50px;">
                    </a>
                </div>
            </div>
        </div>
    </header>

    <nav class="modern-nav">
        <div class="container">
            <ul class="nav-menu">
                <li class="<?php echo Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'index' ? 'active' : ''; ?>">
                    <?php echo CHtml::link('Головна', array('site/index')); ?>
                </li>
                <li class="<?php echo Yii::app()->controller->action->id == 'ensemble' ? 'active' : ''; ?>">
                    <?php echo CHtml::link('Склад ансамблю', array('site/ensemble')); ?>
                </li>
                <li class="<?php echo in_array(Yii::app()->controller->action->id, array('gallery', 'photo', 'video')) ? 'active' : ''; ?>">
                    <?php echo CHtml::link('Галерея', array('site/gallery')); ?>
                </li>
                <li class="<?php echo Yii::app()->controller->action->id == 'repertoire' ? 'active' : ''; ?>">
                    <?php echo CHtml::link('Репертуар', array('site/repertoire')); ?>
                </li>
                <li class="<?php echo Yii::app()->controller->action->id == 'contacts' ? 'active' : ''; ?>">
                    <?php echo CHtml::link('Контакти', array('site/contacts')); ?>
                </li>
            </ul>
        </div>
    </nav>

    <main class="content modern-content">
	    <?php echo $content; ?>
    </main>

	<div class="clear"></div>

    <footer class="modern-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Ансамбль "Воля"</h3>
                    <p>Український народний вокально-інструментальний ансамбль</p>
                </div>
                <div class="footer-section">
                    <h4>Навігація</h4>
                    <ul class="footer-menu">
                        <li><?php echo CHtml::link('Головна', array('site/index')); ?></li>
                        <li><?php echo CHtml::link('Склад ансамблю', array('site/ensemble')); ?></li>
                        <li><?php echo CHtml::link('Галерея', array('site/gallery')); ?></li>
                        <li><?php echo CHtml::link('Репертуар', array('site/repertoire')); ?></li>
                        <li><?php echo CHtml::link('Контакти', array('site/contacts')); ?></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Контакти</h4>
                    <p>м. Київ, Україна</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> Ансамбль "Воля". Всі права захищені.</p>
            </div>
        </div>
    </footer>
</div>

</body>
</html>
