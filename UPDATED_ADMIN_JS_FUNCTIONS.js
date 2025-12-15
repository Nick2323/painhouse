/**
 * ОНОВЛЕНІ JAVASCRIPT ФУНКЦІЇ ДЛЯ АДМІН-ПАНЕЛІ
 *
 * Замініть відповідні функції в /js/admin.js цими версіями
 */

// ============================================
// ДОДАВАННЯ РЕПЕРТУАРУ (ПІСНІ)
// ============================================
function addRepertoire(event) {
    event.preventDefault();

    const name = $('#repertoire-name').val();
    const category = $('#repertoire-category').val();

    if (!name || !category) {
        showToast('Заповніть всі поля', 'error');
        return;
    }

    $.ajax({
        type: "POST",
        url: baseUrl + "/admin/addrepertoire",
        data: {
            Name: name,
            Category: category
        },
        dataType: "json",
        success: function(response) {
            showToast(response.text, response.text.includes('успішно') ? 'success' : 'error');
            if (response.text.includes('успішно')) {
                closeModal('addRepertoireModal');
                $('#repertoire-name').val('');
                $('#repertoire-category').val('');
                loadRepertoire();
                loadStats();
            }
        },
        error: function() {
            showToast('Помилка з\'єднання з сервером', 'error');
        }
    });
}

// ============================================
// ЗАВАНТАЖЕННЯ МЕДІА
// ============================================
function uploadMedia(event) {
    event.preventDefault();

    const fileInput = document.getElementById('media-file');
    const file = fileInput.files[0];
    const description = $('#media-description').val();

    if (!file) {
        showToast('Оберіть файл для завантаження', 'error');
        return;
    }

    // Get file name without extension
    const fileName = file.name.substring(0, file.name.lastIndexOf('.')) || file.name;
    const fileExt = file.name.split('.').pop().toLowerCase();

    const fd = new FormData();
    fd.append('fileName', fileName);
    fd.append('fileType', fileExt);
    fd.append('description', description);
    fd.append('file', file);

    // Show upload progress
    const xhr = new XMLHttpRequest();
    xhr.open('POST', baseUrl + '/admin/uploadmedia', true);

    xhr.upload.onprogress = function(e) {
        if (e.lengthComputable) {
            const percentComplete = (e.loaded / e.total) * 100;
            console.log('Upload progress:', percentComplete + '%');
            // You can update a progress bar here if you have one
        }
    };

    xhr.onload = function() {
        if (this.status == 200) {
            const resp = JSON.parse(this.response);
            showToast(resp.text, resp.text.includes('успішно') ? 'success' : 'error');
            if (resp.text.includes('успішно')) {
                closeModal('uploadMediaModal');
                $('#media-file').val('');
                $('#media-description').val('');
                loadMedia();
                loadStats();
            }
        } else {
            showToast('Помилка при завантаженні файлу', 'error');
        }
    };

    xhr.onerror = function() {
        showToast('Помилка з\'єднання з сервером', 'error');
    };

    xhr.send(fd);
}

// ============================================
// ЗМІНА ПАРОЛЮ
// ============================================
function changePassword(event) {
    event.preventDefault();

    const currentPassword = $('#current-password').val();
    const newPassword = $('#new-password').val();
    const confirmPassword = $('#confirm-password').val();

    if (!currentPassword || !newPassword || !confirmPassword) {
        showToast('Заповніть всі поля', 'error');
        return;
    }

    if (newPassword !== confirmPassword) {
        showToast('Новий пароль та підтвердження не співпадають', 'error');
        return;
    }

    if (newPassword.length < 6) {
        showToast('Пароль має бути не менше 6 символів', 'error');
        return;
    }

    $.ajax({
        type: "POST",
        url: baseUrl + "/admin/changepass",
        data: {
            currentPassword: currentPassword,
            newPassword: newPassword,
            confirmPassword: confirmPassword
        },
        dataType: "json",
        success: function(response) {
            showToast(response.text, response.text.includes('успішно') ? 'success' : 'error');
            if (response.text.includes('успішно')) {
                $('#current-password').val('');
                $('#new-password').val('');
                $('#confirm-password').val('');
            }
        },
        error: function() {
            showToast('Помилка з\'єднання з сервером', 'error');
        }
    });
}

// ============================================
// ВИДАЛЕННЯ УЧАСНИКА
// ============================================
function deleteMember(id, name) {
    if (!confirm('Ви впевнені, що хочете видалити учасника "' + name + '"?')) {
        return;
    }

    $.ajax({
        type: "POST",
        url: baseUrl + "/admin/delmember",
        data: { id: id },
        dataType: "json",
        success: function(response) {
            showToast(response.text, response.text.includes('успішно') ? 'success' : 'error');
            if (response.text.includes('успішно')) {
                loadMembers();
                loadStats();
            }
        },
        error: function() {
            showToast('Помилка з\'єднання з сервером', 'error');
        }
    });
}

// ============================================
// ВИДАЛЕННЯ РЕПЕРТУАРУ
// ============================================
function deleteRepertoire(name) {
    if (!confirm('Ви впевнені, що хочете видалити пісню "' + name + '"?')) {
        return;
    }

    $.ajax({
        type: "POST",
        url: baseUrl + "/admin/delrepertoire",
        data: { name: name },
        dataType: "json",
        success: function(response) {
            showToast(response.text, response.text.includes('успішно') ? 'success' : 'error');
            if (response.text.includes('успішно')) {
                loadRepertoire();
                loadStats();
            }
        },
        error: function() {
            showToast('Помилка з\'єднання з сервером', 'error');
        }
    });
}

// ============================================
// ВИДАЛЕННЯ МЕДІА
// ============================================
function deleteMedia(id, fileName) {
    if (!confirm('Ви впевнені, що хочете видалити файл "' + fileName + '"?')) {
        return;
    }

    $.ajax({
        type: "POST",
        url: baseUrl + "/admin/delmedia",
        data: { id: id },
        dataType: "json",
        success: function(response) {
            showToast(response.text, response.text.includes('успішно') ? 'success' : 'error');
            if (response.text.includes('успішно')) {
                loadMedia();
                loadStats();
            }
        },
        error: function() {
            showToast('Помилка з\'єднання з сервером', 'error');
        }
    });
}
