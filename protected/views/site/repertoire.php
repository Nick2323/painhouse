<?php
$this->pageTitle = 'Репертуар - ' . Yii::app()->name;
?>

<section class="page-header">
    <div class="container">
        <h1 class="page-title">Репертуар ансамблю</h1>
        <p class="page-subtitle">Наша музична скарбниця</p>
    </div>
</section>

<section class="repertoire-section">
    <div class="container">
        <div class="about-content">
            <div class="about-text">
                <p style="font-size: 1.15rem; text-align: center; margin-bottom: 3rem; color: var(--text-dark);">
                    У репертуарі ансамблю близько <strong>30 пісень</strong>, з-поміж яких улюблені бойками
                    українські народні та авторські пісні, а також календарно-обрядові (пісенні жанри зимового
                    та весняного циклу) в обробці для ансамблевого виконання у супроводі бандури та скрипки Лариси Дуди.
                </p>
            </div>

            <?php
            $categories = repertoireDB::model()->findAllBySql("SELECT Category FROM repertoire WHERE Name='' ORDER BY ID");

            foreach($categories as $category):
            ?>
                <div class="repertoire-category">
                    <h3 class="category-title"><?php echo CHtml::encode($category->Category); ?></h3>
                    <ul class="repertoire-list">
                        <?php
                        $repertoires = repertoireDB::model()->findAllBySql("SELECT Name FROM repertoire WHERE Name!='' AND Category='".$category->Category."' ORDER BY ID");
                        foreach($repertoires as $repertoire):
                        ?>
                            <li><?php echo CHtml::encode($repertoire->Name); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
.repertoire-section {
    padding: 3rem 0;
    background: var(--white);
}

.repertoire-category {
    margin-bottom: 2.5rem;
    animation: fadeInUp 0.6s ease;
}

.category-title {
    font-size: 1.6rem;
    color: var(--primary-color);
    margin-bottom: 1.2rem;
    padding: 0.75rem 1.5rem;
    background: linear-gradient(to right, var(--bg-light), transparent);
    border-left: 5px solid var(--accent-color);
    border-radius: 5px;
    font-weight: 600;
}

.repertoire-list {
    list-style: none;
    padding-left: 2.5rem;
}

.repertoire-list li {
    padding: 0.75rem 0;
    font-size: 1.05rem;
    color: var(--text-dark);
    border-bottom: 1px solid var(--bg-light);
    position: relative;
    transition: all 0.3s ease;
}

.repertoire-list li:hover {
    color: var(--primary-color);
    padding-left: 0.5rem;
}

.repertoire-list li:before {
    content: "♪";
    position: absolute;
    left: -2rem;
    color: var(--accent-color);
    font-size: 1.4rem;
    font-weight: bold;
}

.repertoire-list li:last-child {
    border-bottom: none;
}
</style>