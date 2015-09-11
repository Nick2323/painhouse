<?php // ДОДАЮ КАРТИНКИ З КЛАСОМ IMG mystyle.css

//$find=adminsUpload::model()->findAllBySql("SELECT * FROM media WHERE Extra=0 ORDER BY ID DESC");
echo "<div class='image_layout'>";
$find=adminsUpload::model()->findAllBySql("SELECT * FROM media WHERE Extra=0 ORDER BY ID");
foreach($find as $one){
    echo "<div class='image_holder'>";
    echo CHtml::link($one->MediaFileName,array('site/photo?id='.$one->ID));
    echo CHtml::image(Yii::app()->baseUrl.'/gallery/'.$one->MediaFileName.'.'.$one->MediaType,'alt',array('class'=>'img'));
    echo "</div>";
}
echo "</div>";