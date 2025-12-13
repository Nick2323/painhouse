// Admin Panel JavaScript Functions

// Global variables
let categoriesList = [];

// Load Statistics
function loadStats() {
    $.ajax({
        type: "POST",
        url: baseUrl + "/admin/getstats",
        data: {}, // Using session authentication
        dataType: "json",
        success: function(response) {
            if (response && response.stats) {
                $('#stat-members').text(response.stats.members || 0);
                $('#stat-songs').text(response.stats.songs || 0);
                $('#stat-media').text(response.stats.media || 0);
                $('#stat-categories').text(response.stats.categories || 0);
            }
        },
        error: function() {
            console.error('Failed to load stats');
        }
    });
}

// Load Members
function loadMembers() {
    $.ajax({
        type: "POST",
        url: baseUrl + "/admin/getmembers",
        data: {}, // Using session authentication
        dataType: "json",
        success: function(response) {
            if (response && response.members) {
                renderMembersTable(response.members);
            }
        },
        error: function() {
            $('#members-tbody').html('<tr><td colspan="4" class="loading-cell">Помилка завантаження даних</td></tr>');
        }
    });
}

function renderMembersTable(members) {
    const tbody = $('#members-tbody');
    tbody.empty();

    if (members.length === 0) {
        tbody.html('<tr><td colspan="4" class="loading-cell">Немає даних</td></tr>');
        return;
    }

    members.forEach(member => {
        const photoHtml = member.PhotoName
            ? `<img src="${baseUrl}/photo/${member.PhotoName}" class="table-photo" alt="${member.FullName}">`
            : `<div class="photo-placeholder">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
               </div>`;

        const description = member.Description
            ? (member.Description.length > 50 ? member.Description.substring(0, 50) + '...' : member.Description)
            : '-';

        const row = `
            <tr>
                <td>${photoHtml}</td>
                <td><strong>${escapeHtml(member.FullName)}</strong></td>
                <td>${escapeHtml(description)}</td>
                <td>
                    <div class="table-actions">
                        <button class="btn-edit" onclick="openEditMemberModal(${member.ID})" title="Редагувати">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </button>
                        <button class="btn-delete" onclick="confirmDeleteMember('${escapeHtml(member.FullName)}')" title="Видалити">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
        `;
        tbody.append(row);
    });
}

// Load Repertoire
function loadRepertoire() {
    $.ajax({
        type: "POST",
        url: baseUrl + "/admin/getrepertoire",
        data: {}, // Using session authentication
        dataType: "json",
        success: function(response) {
            if (response && response.repertoire) {
                renderRepertoireTable(response.repertoire);
                categoriesList = response.categories || [];
                updateCategoriesList();
            }
        },
        error: function() {
            $('#repertoire-tbody').html('<tr><td colspan="3" class="loading-cell">Помилка завантаження даних</td></tr>');
        }
    });
}

function renderRepertoireTable(repertoire) {
    const tbody = $('#repertoire-tbody');
    tbody.empty();

    if (repertoire.length === 0) {
        tbody.html('<tr><td colspan="3" class="loading-cell">Немає даних</td></tr>');
        return;
    }

    repertoire.forEach(item => {
        const row = `
            <tr>
                <td><strong>${escapeHtml(item.Name)}</strong></td>
                <td>${escapeHtml(item.Category)}</td>
                <td>
                    <div class="table-actions">
                        <button class="btn-delete" onclick="confirmDeleteRepertoire('${escapeHtml(item.Name)}')" title="Видалити">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
        `;
        tbody.append(row);
    });
}

function updateCategoriesList() {
    const datalist = $('#categories-list');
    datalist.empty();
    categoriesList.forEach(category => {
        datalist.append(`<option value="${escapeHtml(category)}">`);
    });
}

// Load Media
function loadMedia() {
    $.ajax({
        type: "POST",
        url: baseUrl + "/admin/getmedia",
        data: {}, // Using session authentication
        dataType: "json",
        success: function(response) {
            if (response && response.media) {
                renderMediaGrid(response.media);
            }
        },
        error: function() {
            $('#media-grid').html('<div class="loading-placeholder">Помилка завантаження даних</td></div>');
        }
    });
}

function renderMediaGrid(media) {
    const grid = $('#media-grid');
    grid.empty();

    if (media.length === 0) {
        grid.html('<div class="loading-placeholder">Немає медіа-файлів</div>');
        return;
    }

    media.forEach(item => {
        const isImage = ['jpg', 'jpeg', 'png'].includes(item.MediaType.toLowerCase());
        const thumbnailHtml = isImage
            ? `<img src="${baseUrl}/gallery/${item.MediaFileName}.${item.MediaType}" class="media-thumbnail" alt="${item.Description}">`
            : `<div class="media-thumbnail" style="display:flex;align-items:center;justify-content:center;background:#f3f4f6;">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                </svg>
               </div>`;

        const card = `
            <div class="media-item">
                ${thumbnailHtml}
                <div class="media-info">
                    <div class="media-name">${escapeHtml(item.MediaFileName)}.${item.MediaType}</div>
                    <div class="media-actions">
                        <button class="btn-delete btn-sm" onclick="confirmDeleteMedia('${escapeHtml(item.MediaFileName)}')" title="Видалити">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            </svg>
                            Видалити
                        </button>
                    </div>
                </div>
            </div>
        `;
        grid.append(card);
    });
}

// Modal Functions
function openAddMemberModal() {
    openModal('addMemberModal');
}

function openEditMemberModal(memberId) {
    // Load member data and populate form
    // For now, just open the modal
    openModal('editMemberModal');
    $('#edit-member-id').val(memberId);
    // TODO: Load member data via AJAX
}

function openAddRepertoireModal() {
    openModal('addRepertoireModal');
}

function openUploadMediaModal() {
    openModal('uploadMediaModal');
}

// Add Member
function addMember(event) {
    event.preventDefault();

    const name = $('#member-name').val();
    const description = $('#member-description').val();
    const photoInput = document.getElementById('member-photo');
    const file = photoInput.files[0];

    if (!name) {
        showToast('Введіть ім\'я учасника', 'error');
        return;
    }

    if (!file) {
        showToast('Оберіть фото учасника', 'error');
        return;
    }

    const fd = new FormData();
    fd.append('name', name);
    fd.append('description', description);
    fd.append('File', file);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', baseUrl + '/admin/addmember', true);

    xhr.onload = function() {
        if (this.status == 200) {
            const resp = JSON.parse(this.response);
            showToast(resp.text, resp.text.includes('успішно') ? 'success' : 'error');
            if (resp.text.includes('успішно')) {
                closeModal('addMemberModal');
                loadMembers();
                loadStats();
            }
        }
    };

    xhr.onerror = function() {
        showToast('Помилка з\'єднання', 'error');
    };

    xhr.send(fd);
}

// Add Repertoire
function addRepertoire(event) {
    event.preventDefault();

    const name = $('#repertoire-name').val();
    const category = $('#repertoire-category').val();

    if (!name || !category) {
        showToast('Заповніть всі поля', 'error');
        return;
    }

    const data = {
        Name: name,
        Category: category,
        login: login,
        password: password
    };

    $.ajax({
        type: "POST",
        url: baseUrl + "/admin/addrepertoire",
        data: { command: data },
        dataType: "json",
        success: function(response) {
            showToast(response.text, response.text.includes('успішно') ? 'success' : 'error');
            if (response.text.includes('успішно')) {
                closeModal('addRepertoireModal');
                loadRepertoire();
                loadStats();
            }
        },
        error: function() {
            showToast('Помилка з\'єднання', 'error');
        }
    });
}

// Upload Media
function uploadMedia(event) {
    event.preventDefault();

    const fileInput = document.getElementById('media-file');
    const file = fileInput.files[0];
    const description = $('#media-description').val();

    if (!file) {
        showToast('Оберіть файл', 'error');
        return;
    }

    const fileName = file.name.substring(0, file.name.lastIndexOf('.')) || file.name;
    const fileExt = file.name.split('.').pop();

    const fd = new FormData();
    fd.append('file', file);
    fd.append('command', JSON.stringify([fileName, fileExt, description, login, password]));

    const xhr = new XMLHttpRequest();
    xhr.open('POST', baseUrl + '/admin/uploadmedia', true);

    // Progress
    xhr.upload.onprogress = function(e) {
        if (e.lengthComputable) {
            const percent = (e.loaded / e.total) * 100;
            $('#upload-progress').show();
            $('#progress-fill').css('width', percent + '%');
            $('#progress-text').text(Math.round(percent) + '%');
        }
    };

    xhr.onload = function() {
        $('#upload-progress').hide();
        $('#progress-fill').css('width', '0%');

        if (this.status == 200) {
            const text = this.responseText;
            showToast(text, text.includes('успішно') ? 'success' : 'error');
            if (text.includes('успішно')) {
                closeModal('uploadMediaModal');
                loadMedia();
                loadStats();
            }
        }
    };

    xhr.onerror = function() {
        $('#upload-progress').hide();
        showToast('Помилка з\'єднання', 'error');
    };

    xhr.send(fd);
}

// Delete Confirmations
function confirmDeleteMember(name) {
    $('#delete-message').text(`Ви впевнені, що хочете видалити учасника "${name}"?`);
    openModal('confirmDeleteModal');

    $('#confirm-delete-btn').off('click').on('click', function() {
        deleteMember(name);
    });
}

function confirmDeleteRepertoire(name) {
    $('#delete-message').text(`Ви впевнені, що хочете видалити пісню "${name}"?`);
    openModal('confirmDeleteModal');

    $('#confirm-delete-btn').off('click').on('click', function() {
        deleteRepertoire(name);
    });
}

function confirmDeleteMedia(name) {
    $('#delete-message').text(`Ви впевнені, що хочете видалити файл "${name}"?`);
    openModal('confirmDeleteModal');

    $('#confirm-delete-btn').off('click').on('click', function() {
        deleteMedia(name);
    });
}

// Delete Member
function deleteMember(name) {
    const data = {
        name: name,
        login: login,
        password: password
    };

    $.ajax({
        type: "POST",
        url: baseUrl + "/admin/deletemember",
        data: { command: data },
        dataType: "json",
        success: function(response) {
            closeModal('confirmDeleteModal');
            showToast(response.text, response.text.includes('успішно') ? 'success' : 'error');
            if (response.text.includes('успішно')) {
                loadMembers();
                loadStats();
            }
        },
        error: function() {
            closeModal('confirmDeleteModal');
            showToast('Помилка з\'єднання', 'error');
        }
    });
}

// Delete Repertoire
function deleteRepertoire(name) {
    const data = {
        name: name,
        login: login,
        password: password
    };

    $.ajax({
        type: "POST",
        url: baseUrl + "/admin/deleterepertoire",
        data: { command: data },
        dataType: "json",
        success: function(response) {
            closeModal('confirmDeleteModal');
            showToast(response.text, response.text.includes('успішно') ? 'success' : 'error');
            if (response.text.includes('успішно')) {
                loadRepertoire();
                loadStats();
            }
        },
        error: function() {
            closeModal('confirmDeleteModal');
            showToast('Помилка з\'єднання', 'error');
        }
    });
}

// Delete Media
function deleteMedia(name) {
    const data = {
        name: name,
        login: login,
        password: password
    };

    $.ajax({
        type: "POST",
        url: baseUrl + "/admin/deletemedia",
        data: { command: data },
        dataType: "json",
        success: function(response) {
            closeModal('confirmDeleteModal');
            showToast(response.text, response.text.includes('успішно') ? 'success' : 'error');
            if (response.text.includes('успішно')) {
                loadMedia();
                loadStats();
            }
        },
        error: function() {
            closeModal('confirmDeleteModal');
            showToast('Помилка з\'єднання', 'error');
        }
    });
}

// Change Password
function changePassword(event) {
    event.preventDefault();

    const pass1 = $('#new-password-1').val();
    const pass2 = $('#new-password-2').val();

    if (pass1 !== pass2) {
        showToast('Паролі не співпадають', 'error');
        return;
    }

    if (pass1.length < 4) {
        showToast('Пароль має бути не менше 4 символів', 'error');
        return;
    }

    const data = {
        pass1: pass1,
        pass2: pass2,
        login: login,
        password: password
    };

    $.ajax({
        type: "POST",
        url: baseUrl + "/admin/changepass",
        data: { command: data },
        dataType: "json",
        success: function(response) {
            showToast(response.text, response.text.includes('успішно') ? 'success' : 'error');
            if (response.text.includes('успішно')) {
                $('#change-password-form')[0].reset();
                password = pass1; // Update password variable
            }
        },
        error: function() {
            showToast('Помилка з\'єднання', 'error');
        }
    });
}

// Utility Functions
function escapeHtml(text) {
    if (!text) return '';
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.toString().replace(/[&<>"']/g, function(m) { return map[m]; });
}

// Set base URL
const baseUrl = typeof Yii !== 'undefined' && Yii.app && Yii.app.baseUrl
    ? Yii.app.baseUrl
    : '';
