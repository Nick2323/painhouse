<?php
/* @var $this SiteController */
/* @var $id int */

$this->pageTitle = 'Медіа - ' . Yii::app()->name;

// Get media item by ID
$media = Yii::app()->db->createCommand()
    ->select('*')
    ->from('media')
    ->where('ID=:id', array(':id'=>$id))
    ->queryRow();

if (!$media) {
    throw new CHttpException(404, 'Медіа файл не знайдено');
}

$fileName = $media['MediaFileName'];
$fileType = $media['MediaType'];
$description = $media['Description'];
$isImage = in_array(strtolower($fileType), array('jpg', 'jpeg', 'png', 'gif'));
$isVideo = in_array(strtolower($fileType), array('mp4', 'webm', 'ogg'));
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo CHtml::encode($description); ?></title>
    <style>
        body {
            margin: 0;
            padding: 20px;
            background: #000;
            color: #fff;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .container {
            max-width: 1200px;
            width: 100%;
        }
        .media-container {
            text-align: center;
            margin-bottom: 20px;
        }
        img, video {
            max-width: 100%;
            max-height: 80vh;
            border-radius: 8px;
        }
        .description {
            margin-top: 20px;
            font-size: 18px;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .back-link:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="media-container">
            <?php if ($isImage): ?>
                <img src="<?php echo Yii::app()->baseUrl; ?>/gallery/<?php echo $fileName; ?>.<?php echo $fileType; ?>"
                     alt="<?php echo CHtml::encode($description); ?>">
            <?php elseif ($isVideo): ?>
                <video controls>
                    <source src="<?php echo Yii::app()->baseUrl; ?>/gallery/<?php echo $fileName; ?>.<?php echo $fileType; ?>"
                            type="video/<?php echo $fileType; ?>">
                    Ваш браузер не підтримує відео.
                </video>
            <?php else: ?>
                <p>Непідтримуваний тип файлу</p>
            <?php endif; ?>
        </div>

        <?php if ($description): ?>
            <div class="description">
                <?php echo CHtml::encode($description); ?>
            </div>
        <?php endif; ?>

        <a href="<?php echo Yii::app()->createUrl('site/gallery'); ?>" class="back-link">← Назад до галереї</a>
    </div>
</body>
</html>
