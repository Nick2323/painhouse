<?php
$this->pageTitle = 'Склад ансамблю - ' . Yii::app()->name;
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="page-title">Склад ансамблю</h1>
        <p class="page-subtitle">Знайомтесь з талановитими учасниками ансамблю "Воля"</p>
    </div>
</section>

<!-- Members Section -->
<section class="members-section">
    <div class="container">
        <?php
        $members = Member::model()->findAll();

        if (!empty($members)): ?>
            <div class="cards-grid">
                <?php foreach ($members as $member): ?>
                    <div class="member-card modern-card fade-in">
                        <?php if ($member->PhotoName): ?>
                            <div class="member-photo">
                                <img src="<?php echo Yii::app()->baseUrl; ?>/photo/<?php echo CHtml::encode($member->PhotoName); ?>"
                                     alt="<?php echo CHtml::encode($member->FullName); ?>" />
                            </div>
                        <?php else: ?>
                            <div class="member-photo member-photo-placeholder">
                                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                        <?php endif; ?>

                        <div class="member-info">
                            <h3 class="member-name"><?php echo CHtml::encode($member->FullName); ?></h3>
                            <?php if ($member->Description): ?>
                                <p class="member-description"><?php echo CHtml::encode($member->Description); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <h3>Дані про учасників ще не завантажено</h3>
                <p>Інформація про склад ансамблю з'явиться найближчим часом</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- About Section -->
<section class="about-section">
    <div class="container">
        <div class="about-content">
            <div class="about-text">
                <h2>Про ансамбль "Воля"</h2>
                <p>Ансамбль "Воля" – це колектив однодумців, які об'єдналися навколо ідеї збереження та популяризації бойківських народних пісень. Діяльність ансамблю розпочалась у 2004 році під керівництвом талановитої бандуристки та музичного керівника Лариси Дуди.</p>
                <p>Колектив об'єднує людей різних професій та віку, які мають спільну любов до української народної пісні. Кожен учасник вносить свій унікальний внесок у створення неповторного звучання ансамблю.</p>
            </div>
        </div>
    </div>
</section>
