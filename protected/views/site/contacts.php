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
                    <img src="/images/phone.svg" alt="Phone Icon">
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
                    <img src="/images/email.svg" alt="Email Icon">
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
                    <img src="/images/location.svg" alt="Location Icon">
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
    display: flex;
    flex-direction: column;
}

.contact-icon {
    margin-bottom: 1.5rem;
    order: -1;
}

.contact-icon img {
    width: 60px;
    height: 60px;
    margin: 0 auto;
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