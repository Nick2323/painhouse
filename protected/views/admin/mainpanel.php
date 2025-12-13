<!-- Modern Admin Panel -->
<div class="admin-dashboard">
    <!-- Sidebar Navigation -->
    <aside class="admin-sidebar">
        <div class="admin-logo">
            <h2>🎵 Адмін-панель</h2>
            <p class="admin-subtitle">Ансамбль "Воля"</p>
        </div>

        <nav class="admin-nav">
            <a href="#" class="admin-nav-item active" onclick="showSection('dashboard'); return false;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7"></rect>
                    <rect x="14" y="3" width="7" height="7"></rect>
                    <rect x="14" y="14" width="7" height="7"></rect>
                    <rect x="3" y="14" width="7" height="7"></rect>
                </svg>
                <span>Головна</span>
            </a>

            <a href="#" class="admin-nav-item" onclick="showSection('members'); return false;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <span>Учасники</span>
            </a>

            <a href="#" class="admin-nav-item" onclick="showSection('repertoire'); return false;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 18V5l12-2v13"></path>
                    <circle cx="6" cy="18" r="3"></circle>
                    <circle cx="18" cy="16" r="3"></circle>
                </svg>
                <span>Репертуар</span>
            </a>

            <a href="#" class="admin-nav-item" onclick="showSection('media'); return false;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                    <polyline points="21 15 16 10 5 21"></polyline>
                </svg>
                <span>Медіа</span>
            </a>

            <a href="#" class="admin-nav-item" onclick="showSection('settings'); return false;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="3"></circle>
                    <path d="M12 1v6m0 6v6m5.2-13.2l-4.2 4.2m-5.8 5.8l-4.2 4.2m16.2-4.2l-4.2-4.2m-5.8-5.8l-4.2-4.2"></path>
                </svg>
                <span>Налаштування</span>
            </a>
        </nav>

        <div class="admin-footer">
            <button class="btn-logout" onclick="adminlogout()">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                Вийти
            </button>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="admin-main">
        <!-- Dashboard Section -->
        <section id="section-dashboard" class="admin-section active">
            <header class="section-header">
                <h1>Статистика та огляд</h1>
                <p>Загальна інформація про контент сайту</p>
            </header>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        </svg>
                    </div>
                    <div class="stat-content">
                        <h3 id="stat-members">-</h3>
                        <p>Учасників</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                            <path d="M9 18V5l12-2v13"></path>
                            <circle cx="6" cy="18" r="3"></circle>
                            <circle cx="18" cy="16" r="3"></circle>
                        </svg>
                    </div>
                    <div class="stat-content">
                        <h3 id="stat-songs">-</h3>
                        <p>Пісень у репертуарі</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                            <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                    </div>
                    <div class="stat-content">
                        <h3 id="stat-media">-</h3>
                        <p>Медіа-файлів</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                            <path d="M2 17l10 5 10-5M2 12l10 5 10-5"></path>
                        </svg>
                    </div>
                    <div class="stat-content">
                        <h3 id="stat-categories">-</h3>
                        <p>Категорій</p>
                    </div>
                </div>
            </div>

            <div class="dashboard-content">
                <div class="welcome-card">
                    <h2>👋 Вітаємо в панелі управління!</h2>
                    <p>Тут ви можете керувати всім контентом сайту ансамблю "Воля"</p>
                    <div class="quick-actions">
                        <button class="btn-quick" onclick="showSection('members')">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="16"></line>
                                <line x1="8" y1="12" x2="16" y2="12"></line>
                            </svg>
                            Додати учасника
                        </button>
                        <button class="btn-quick" onclick="showSection('repertoire')">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="16"></line>
                                <line x1="8" y1="12" x2="16" y2="12"></line>
                            </svg>
                            Додати пісню
                        </button>
                        <button class="btn-quick" onclick="showSection('media')">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="17 8 12 3 7 8"></polyline>
                                <line x1="12" y1="3" x2="12" y2="15"></line>
                            </svg>
                            Завантажити медіа
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Members Section -->
        <section id="section-members" class="admin-section">
            <header class="section-header">
                <div>
                    <h1>Управління учасниками</h1>
                    <p>Додавання, редагування та видалення учасників ансамблю</p>
                </div>
                <button class="btn-primary" onclick="openAddMemberModal()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="16"></line>
                        <line x1="8" y1="12" x2="16" y2="12"></line>
                    </svg>
                    Додати учасника
                </button>
            </header>

            <div class="data-table-container">
                <table class="data-table" id="members-table">
                    <thead>
                        <tr>
                            <th>Фото</th>
                            <th>Ім'я</th>
                            <th>Опис</th>
                            <th>Дії</th>
                        </tr>
                    </thead>
                    <tbody id="members-tbody">
                        <tr>
                            <td colspan="4" class="loading-cell">Завантаження...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Repertoire Section -->
        <section id="section-repertoire" class="admin-section">
            <header class="section-header">
                <div>
                    <h1>Управління репертуаром</h1>
                    <p>Додавання, редагування та видалення пісень</p>
                </div>
                <button class="btn-primary" onclick="openAddRepertoireModal()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="16"></line>
                        <line x1="8" y1="12" x2="16" y2="12"></line>
                    </svg>
                    Додати пісню
                </button>
            </header>

            <div class="data-table-container">
                <table class="data-table" id="repertoire-table">
                    <thead>
                        <tr>
                            <th>Назва пісні</th>
                            <th>Категорія</th>
                            <th>Дії</th>
                        </tr>
                    </thead>
                    <tbody id="repertoire-tbody">
                        <tr>
                            <td colspan="3" class="loading-cell">Завантаження...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Media Section -->
        <section id="section-media" class="admin-section">
            <header class="section-header">
                <div>
                    <h1>Управління медіа</h1>
                    <p>Завантаження та видалення медіа-файлів</p>
                </div>
                <button class="btn-primary" onclick="openUploadMediaModal()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                    </svg>
                    Завантажити файл
                </button>
            </header>

            <div class="media-grid" id="media-grid">
                <div class="loading-placeholder">Завантаження...</div>
            </div>
        </section>

        <!-- Settings Section -->
        <section id="section-settings" class="admin-section">
            <header class="section-header">
                <h1>Налаштування</h1>
                <p>Зміна паролю та інші налаштування</p>
            </header>

            <div class="settings-container">
                <div class="settings-card">
                    <h3>Змінити пароль</h3>
                    <form id="change-password-form" onsubmit="changePassword(event)">
                        <div class="form-group">
                            <label>Новий пароль</label>
                            <input type="password" id="new-password-1" class="form-control" required minlength="4">
                        </div>
                        <div class="form-group">
                            <label>Підтвердіть пароль</label>
                            <input type="password" id="new-password-2" class="form-control" required minlength="4">
                        </div>
                        <button type="submit" class="btn-primary">Змінити пароль</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
</div>

<!-- Modals -->
<?php include(dirname(__FILE__).'/modals.php'); ?>

<!-- Styles -->
<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/admin.css">

<!-- Scripts -->
<script src="<?php echo Yii::app()->baseUrl; ?>/js/admin.js"></script>

<script type="text/javascript">
    // Initialize admin panel
    $(document).ready(function() {
        loadStats();
        loadMembers();
        loadRepertoire();
        loadMedia();
    });

    function showSection(sectionName) {
        // Hide all sections
        $('.admin-section').removeClass('active');
        $('.admin-nav-item').removeClass('active');

        // Show selected section
        $('#section-' + sectionName).addClass('active');
        $('.admin-nav-item').each(function() {
            if ($(this).attr('onclick').includes(sectionName)) {
                $(this).addClass('active');
            }
        });

        // Reload data if needed
        if (sectionName === 'members') {
            loadMembers();
        } else if (sectionName === 'repertoire') {
            loadRepertoire();
        } else if (sectionName === 'media') {
            loadMedia();
        } else if (sectionName === 'dashboard') {
            loadStats();
        }
    }

    function adminlogout(){
        $.ajax({
            type:"POST",
            url:'<?php echo Yii::app()->createAbsoluteUrl("site/logout"); ?>',
            data:{},
            dataType:"json",
            success: function(arr) {
                var site=arr['site'];
                login="";
                password="";
                $("#admin_panel").empty();
                $("#admin_panel").append(site);
            },
            error: function() {
                alert("Помилка виходу");
            }
        })
    }
</script>
