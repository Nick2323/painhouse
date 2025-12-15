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
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 22.3211C19.4673 22.3211 18.9346 22.2222 18.4019 22.0245C14.6542 20.6402 11.2243 18.267 8.11215 15.1542C5.00935 12.0414 2.63551 8.61153 1.25234 4.86386C0.953271 3.97196 1.25234 2.98131 1.94393 2.28972C2.63551 1.59813 3.62617 1.29907 4.61682 1.49673L7.98131 2.08879C8.87383 2.28645 9.56542 2.97804 9.76308 3.87056L10.5514 7.23505C10.7491 8.12757 10.3551 9.11822 9.66355 9.71028L7.68692 11.2921C9.26869 14.1589 11.4019 16.1355 14.2687 17.618L15.8505 15.6415C16.4421 14.9499 17.4327 14.6508 18.3252 14.8485L21.6897 15.6369C22.5822 15.8346 23.2738 16.5262 23.4715 17.4187L24.0636 20.7832C24.2612 21.6757 23.8673 22.3211 23.1757 22.3211H20Z" fill-opacity="0.9"/>
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
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22 6C22 4.9 21.1 4 20 4H4C2.9 4 2 4.9 2 6V18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6ZM20 6L12 11L4 6H20ZM20 18H4V8L12 13L20 8V18Z" fill-opacity="0.9"/>
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
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22S19 14.25 19 9C19 5.13 15.87 2 12 2ZM12 11.5C10.62 11.5 9.5 10.38 9.5 9C9.5 7.62 10.62 6.5 12 6.5C13.38 6.5 14.5 7.62 14.5 9C14.5 10.38 13.38 11.5 12 11.5Z" fill-opacity="0.9"/>
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