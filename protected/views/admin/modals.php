<!-- Add Member Modal -->
<div id="addMemberModal" class="admin-modal">
    <div class="modal-dialog">
        <div class="modal-header">
            <h3>Додати учасника</h3>
            <button class="modal-close" onclick="closeModal('addMemberModal')">&times;</button>
        </div>
        <div class="modal-body">
            <form id="add-member-form" onsubmit="addMember(event)">
                <div class="form-group">
                    <label for="member-name">Повне ім'я *</label>
                    <input type="text" id="member-name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="member-photo">Фото</label>
                    <div class="file-upload-wrapper">
                        <input type="file" id="member-photo" accept="image/jpeg,image/png,image/jpg" class="file-input">
                        <label for="member-photo" class="file-label">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="17 8 12 3 7 8"></polyline>
                                <line x1="12" y1="3" x2="12" y2="15"></line>
                            </svg>
                            <span id="member-photo-name">Обрати фото</span>
                        </label>
                    </div>
                    <small>Формат: JPG, PNG. Максимум 5MB</small>
                </div>

                <div class="form-group">
                    <label for="member-description">Опис</label>
                    <textarea id="member-description" class="form-control" rows="4"></textarea>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-secondary" onclick="closeModal('addMemberModal')">Скасувати</button>
                    <button type="submit" class="btn-primary">Додати</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Member Modal -->
<div id="editMemberModal" class="admin-modal">
    <div class="modal-dialog">
        <div class="modal-header">
            <h3>Редагувати учасника</h3>
            <button class="modal-close" onclick="closeModal('editMemberModal')">&times;</button>
        </div>
        <div class="modal-body">
            <form id="edit-member-form" onsubmit="updateMember(event)">
                <input type="hidden" id="edit-member-id">

                <div class="form-group">
                    <label for="edit-member-name">Повне ім'я *</label>
                    <input type="text" id="edit-member-name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="edit-member-photo">Змінити фото</label>
                    <div class="file-upload-wrapper">
                        <input type="file" id="edit-member-photo" accept="image/jpeg,image/png,image/jpg" class="file-input">
                        <label for="edit-member-photo" class="file-label">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="17 8 12 3 7 8"></polyline>
                                <line x1="12" y1="3" x2="12" y2="15"></line>
                            </svg>
                            <span id="edit-member-photo-name">Обрати нове фото</span>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="edit-member-description">Опис</label>
                    <textarea id="edit-member-description" class="form-control" rows="4"></textarea>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-secondary" onclick="closeModal('editMemberModal')">Скасувати</button>
                    <button type="submit" class="btn-primary">Зберегти</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Repertoire Modal -->
<div id="addRepertoireModal" class="admin-modal">
    <div class="modal-dialog">
        <div class="modal-header">
            <h3>Додати пісню</h3>
            <button class="modal-close" onclick="closeModal('addRepertoireModal')">&times;</button>
        </div>
        <div class="modal-body">
            <form id="add-repertoire-form" onsubmit="addRepertoire(event)">
                <div class="form-group">
                    <label for="repertoire-name">Назва пісні *</label>
                    <input type="text" id="repertoire-name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="repertoire-category">Категорія *</label>
                    <input type="text" id="repertoire-category" class="form-control" list="categories-list" required>
                    <datalist id="categories-list">
                        <!-- Will be populated dynamically -->
                    </datalist>
                    <small>Виберіть існуючу або введіть нову категорію</small>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-secondary" onclick="closeModal('addRepertoireModal')">Скасувати</button>
                    <button type="submit" class="btn-primary">Додати</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Upload Media Modal -->
<div id="uploadMediaModal" class="admin-modal">
    <div class="modal-dialog">
        <div class="modal-header">
            <h3>Завантажити медіа-файл</h3>
            <button class="modal-close" onclick="closeModal('uploadMediaModal')">&times;</button>
        </div>
        <div class="modal-body">
            <form id="upload-media-form" onsubmit="uploadMedia(event)">
                <div class="form-group">
                    <label for="media-file">Файл *</label>
                    <div class="file-upload-wrapper">
                        <input type="file" id="media-file" accept="image/*,video/*,audio/*" class="file-input" required>
                        <label for="media-file" class="file-label">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="17 8 12 3 7 8"></polyline>
                                <line x1="12" y1="3" x2="12" y2="15"></line>
                            </svg>
                            <span id="media-file-name">Обрати файл</span>
                        </label>
                    </div>
                    <small>Формат: JPG, PNG, MP3, MP4. Максимум 50MB</small>
                </div>

                <div class="form-group">
                    <label for="media-description">Опис</label>
                    <textarea id="media-description" class="form-control" rows="3"></textarea>
                </div>

                <div class="upload-progress" id="upload-progress" style="display:none;">
                    <div class="progress-bar">
                        <div class="progress-fill" id="progress-fill"></div>
                    </div>
                    <span class="progress-text" id="progress-text">0%</span>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-secondary" onclick="closeModal('uploadMediaModal')">Скасувати</button>
                    <button type="submit" class="btn-primary" id="upload-btn">Завантажити</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Confirm Delete Modal -->
<div id="confirmDeleteModal" class="admin-modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-header">
            <h3>Підтвердження видалення</h3>
            <button class="modal-close" onclick="closeModal('confirmDeleteModal')">&times;</button>
        </div>
        <div class="modal-body">
            <p id="delete-message">Ви впевнені, що хочете видалити цей елемент?</p>
            <div class="modal-actions">
                <button type="button" class="btn-secondary" onclick="closeModal('confirmDeleteModal')">Скасувати</button>
                <button type="button" class="btn-danger" id="confirm-delete-btn">Видалити</button>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notifications -->
<div id="toast-container"></div>

<script>
// File input handlers
document.addEventListener('DOMContentLoaded', function() {
    // Member photo
    const memberPhoto = document.getElementById('member-photo');
    if (memberPhoto) {
        memberPhoto.addEventListener('change', function() {
            const fileName = this.files[0] ? this.files[0].name : 'Обрати фото';
            document.getElementById('member-photo-name').textContent = fileName;
        });
    }

    // Edit member photo
    const editMemberPhoto = document.getElementById('edit-member-photo');
    if (editMemberPhoto) {
        editMemberPhoto.addEventListener('change', function() {
            const fileName = this.files[0] ? this.files[0].name : 'Обрати нове фото';
            document.getElementById('edit-member-photo-name').textContent = fileName;
        });
    }

    // Media file
    const mediaFile = document.getElementById('media-file');
    if (mediaFile) {
        mediaFile.addEventListener('change', function() {
            const fileName = this.files[0] ? this.files[0].name : 'Обрати файл';
            document.getElementById('media-file-name').textContent = fileName;
        });
    }
});

// Modal functions
function openModal(modalId) {
    document.getElementById(modalId).classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.remove('show');
    document.body.style.overflow = 'auto';

    // Reset forms
    const modal = document.getElementById(modalId);
    const form = modal.querySelector('form');
    if (form) form.reset();
}

// Close modal on outside click
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('admin-modal')) {
        closeModal(e.target.id);
    }
});

// Toast notification
function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerHTML = `
        <div class="toast-icon">
            ${type === 'success' ? '✓' : type === 'error' ? '✕' : 'ℹ'}
        </div>
        <div class="toast-message">${message}</div>
    `;

    document.getElementById('toast-container').appendChild(toast);

    setTimeout(() => {
        toast.classList.add('show');
    }, 10);

    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}
</script>
