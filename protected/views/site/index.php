<?php
$this->pageTitle=Yii::app()->name;
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content fade-in">
            <h1 class="hero-title">Вітаємо в ансамблі "Воля"</h1>
            <p class="hero-subtitle">Івано-Франківського обласного громадського товариства «Бойківщина»</p>
            <p class="hero-description">Збереження та популяризація бойківських народних пісень вже понад 20 років</p>
            <div class="hero-buttons">
                <a href="<?php echo Yii::app()->createUrl('site/ensemble'); ?>" class="btn-modern btn-primary-modern">Про ансамбль</a>
                <a href="<?php echo Yii::app()->createUrl('site/repertoire'); ?>" class="btn-modern btn-secondary-modern">Репертуар</a>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <div class="cards-grid">
            <div class="modern-card fade-in">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <h3>Про ансамбль</h3>
                <p>Ансамбль розпочав свою діяльність у 2004 році під керівництвом Лариси Дуди. Колектив об'єднує талановитих виконавців, які люблять українську народну пісню.</p>
                <a href="<?php echo Yii::app()->createUrl('site/ensemble'); ?>" class="card-link">
                    Детальніше →
                </a>
            </div>

            <div class="modern-card fade-in">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 18V5l12-2v13"></path>
                        <circle cx="6" cy="18" r="3"></circle>
                        <circle cx="18" cy="16" r="3"></circle>
                    </svg>
                </div>
                <h3>Репертуар</h3>
                <p>У репертуарі ансамблю понад 30 українських народних та авторських пісень. Включає різдвяні пісні, весняні обрядові, жартівливі та ліричні композиції.</p>
                <a href="<?php echo Yii::app()->createUrl('site/repertoire'); ?>" class="card-link">
                    Переглянути →
                </a>
            </div>

            <div class="modern-card fade-in">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                        <polyline points="21 15 16 10 5 21"></polyline>
                    </svg>
                </div>
                <h3>Галерея</h3>
                <p>Фотографії з виступів та участі у фольклорних фестивалях. Незабутні моменти наших концертів та виступів на різних культурних заходах.</p>
                <a href="<?php echo Yii::app()->createUrl('site/gallery'); ?>" class="card-link">
                    Переглянути →
                </a>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">Наша місія</h2>
            <p class="section-subtitle">Збереження української культурної спадщини</p>
        </div>
        <div class="about-content">
            <div class="about-text">
                <p>Ансамбль "Воля" – це колектив однодумців, які об'єдналися навколо ідеї збереження та популяризації бойківських народних пісень. Ми виконуємо автентичні та сучасні аранжування українських народних пісень, беремо участь у фестивалях та концертах.</p>
                <p>Наша діяльність спрямована на те, щоб передати майбутнім поколінням багатство української народної культури, зберегти традиції та звичаї нашого народу.</p>
            </div>
        </div>
    </div>
</section>
