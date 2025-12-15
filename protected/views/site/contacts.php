<?php
$this->pageTitle = 'Контакти - ' . Yii::app()->name;
?>

<section class="page-header">
    <div class="container">
        <h1 class="page-title">Контакти</h1>
        <p class="page-subtitle">Зв'яжіться з нами</p>
    </div>
</section>

<section class="contacts-section">
    <div class="container">
        <div class="contacts-grid">
            <!-- Телефони -->
            <div class="contact-card modern-card fade-in">
                <div class="contact-icon">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                </div>
                <h3>Телефони</h3>
                <div class="contact-info">
                    <p class="contact-person">
                        <strong>Лариса Дуда</strong><br>
                        <a href="tel:+380506894850">+38 (050) 689-48-50</a><br>
                        <a href="tel:+380962478136">+38 (096) 247-81-36</a>
                    </p>
                    <p class="contact-person">
                        <strong>Дарія Іванівна Петречко</strong><br>
                        <a href="tel:+380673420875">+38 (067) 342-08-75</a><br>
                        <a href="tel:+380990734327">+38 (099) 073-43-27</a>
                    </p>
                </div>
            </div>

            <!-- Email -->
            <div class="contact-card modern-card fade-in" style="animation-delay: 0.1s;">
                <div class="contact-icon">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </div>
                <h3>Електронна пошта</h3>
                <div class="contact-info">
                    <p>
                        <a href="mailto:larysonka@yandex.ua" class="email-link">
                            larysonka@yandex.ua
                        </a>
                    </p>
                </div>
            </div>

            <!-- Локація -->
            <div class="contact-card modern-card fade-in" style="animation-delay: 0.2s;">
                <div class="contact-icon">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                </div>
                <h3>Адреса</h3>
                <div class="contact-info">
                    <p>
                        Івано-Франківське обласне громадське товариство<br>
                        <strong>«Бойківщина»</strong><br>
                        Івано-Франківськ, Україна
                    </p>
                </div>
            </div>
        </div>

        <!-- Форма зворотнього зв'язку -->
        <div class="contact-form-section">
            <h2 class="section-title">Напишіть нам</h2>
            <p class="section-subtitle">Маєте запитання або пропозицію? Ми раді вас почути!</p>

            <div class="contact-form-note">
                <p style="text-align: center; color: var(--text-light); font-size: 1.1rem;">
                    Для зв'язку з нами, будь ласка, використовуйте контактну інформацію вище.<br>
                    Ми завжди раді відповісти на ваші запитання!
                </p>
            </div>
        </div>
    </div>
</section>

<style>
.contacts-section {
    padding: 3rem 0;
    background: var(--bg-light);
}

.contacts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 4rem;
}

.contact-card {
    text-align: center;
}

.contact-icon {
    color: var(--primary-color);
    margin-bottom: 1.5rem;
}

.contact-card h3 {
    font-size: 1.5rem;
    color: var(--primary-color);
    margin-bottom: 1.5rem;
}

.contact-info {
    color: var(--text-dark);
    line-height: 1.8;
}

.contact-person {
    margin-bottom: 1.5rem;
}

.contact-person:last-child {
    margin-bottom: 0;
}

.contact-info a {
    color: var(--secondary-color);
    text-decoration: none;
    transition: color 0.3s ease;
    font-size: 1.05rem;
}

.contact-info a:hover {
    color: var(--primary-color);
    text-decoration: underline;
}

.email-link {
    font-size: 1.2rem !important;
    font-weight: 600;
}

.contact-form-section {
    background: var(--white);
    border-radius: 15px;
    padding: 3rem;
    box-shadow: var(--shadow-md);
    text-align: center;
}

.section-title {
    font-size: 2rem;
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.section-subtitle {
    font-size: 1.1rem;
    color: var(--text-light);
    margin-bottom: 2rem;
}

.contact-form-note {
    padding: 2rem;
    background: var(--bg-light);
    border-radius: 10px;
    border-left: 4px solid var(--accent-color);
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>