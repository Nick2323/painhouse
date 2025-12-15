<?php
$this->pageTitle = 'Галерея - ' . Yii::app()->name;
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 class="page-title">Фотогалерея</h1>
        <p class="page-subtitle">Найкращі моменти з концертів і виступів ансамблю "Воля"</p>
    </div>
</section>

<!-- Gallery Section -->
<section class="gallery-section">
    <div class="container">
        <?php
        $photos = adminsUpload::model()->findAllBySql("SELECT * FROM media WHERE Extra=0 ORDER BY ID DESC");

        if (!empty($photos)): ?>
            <div class="gallery-grid">
                <?php foreach ($photos as $photo): ?>
                    <div class="gallery-item fade-in">
                        <a href="<?php echo Yii::app()->createUrl('site/photo', array('id' => $photo->ID)); ?>" class="gallery-link">
                            <div class="gallery-image-wrapper">
                                <img src="<?php echo Yii::app()->baseUrl; ?>/gallery/<?php echo CHtml::encode($photo->MediaFileName . '.' . $photo->MediaType); ?>"
                                     alt="<?php echo CHtml::encode($photo->Description ?: 'Фото ансамблю'); ?>"
                                     class="gallery-image" />
                                <div class="gallery-overlay">
                                    <div class="gallery-overlay-content">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <path d="m21 21-4.35-4.35"></path>
                                        </svg>
                                        <p>Переглянути</p>
                                    </div>
                                </div>
                            </div>
                            <?php if ($photo->Description): ?>
                                <div class="gallery-description">
                                    <p><?php echo CHtml::encode($photo->Description); ?></p>
                                </div>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                    <polyline points="21 15 16 10 5 21"></polyline>
                </svg>
                <h3>Фотографії ще не завантажено</h3>
                <p>Фотогалерея з виступів ансамблю з'явиться найближчим часом</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
/* Gallery Section */
.gallery-section {
    padding: 3rem 0;
    background: var(--bg-light);
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.gallery-item {
    background: var(--white);
    border-radius: 15px;
    overflow: hidden;
    box-shadow: var(--shadow-md);
    transition: all 0.3s ease;
}

.gallery-item:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-lg);
}

.gallery-link {
    text-decoration: none;
    color: inherit;
    display: block;
}

.gallery-image-wrapper {
    position: relative;
    width: 100%;
    padding-top: 75%; /* 4:3 Aspect Ratio */
    overflow: hidden;
    background: var(--bg-light);
}

.gallery-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.gallery-item:hover .gallery-image {
    transform: scale(1.1);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(44, 95, 141, 0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-overlay-content {
    color: var(--white);
    text-align: center;
}

.gallery-overlay-content svg {
    margin-bottom: 0.5rem;
}

.gallery-overlay-content p {
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
}

.gallery-description {
    padding: 1.5rem;
}

.gallery-description p {
    color: var(--text-dark);
    line-height: 1.6;
    margin: 0;
    font-size: 0.95rem;
}

@media (max-width: 768px) {
    .gallery-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .gallery-image-wrapper {
        padding-top: 66.67%; /* Slightly shorter on mobile */
    }
}
</style>
