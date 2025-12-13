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
                <?php foreach ($members as $index => $member): ?>
                    <div class="member-card modern-card fade-in clickable-card"
                         onclick="openMemberModal(<?php echo $index; ?>)"
                         data-member-id="<?php echo $index; ?>">
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
                                <p class="member-description member-description-preview">
                                    <?php
                                    $desc = CHtml::encode($member->Description);
                                    echo mb_strlen($desc) > 100 ? mb_substr($desc, 0, 100) . '...' : $desc;
                                    ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <div class="card-footer">
                            <span class="view-more">Детальніше →</span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Modal Window -->
            <div id="memberModal" class="modal">
                <div class="modal-content">
                    <span class="modal-close" onclick="closeMemberModal()">&times;</span>
                    <div class="modal-body">
                        <div class="modal-photo-container">
                            <div id="modalPhoto" class="modal-photo"></div>
                        </div>
                        <div class="modal-info-container">
                            <h2 id="modalName" class="modal-name"></h2>
                            <p id="modalDescription" class="modal-description"></p>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                var membersData = [
                    <?php foreach ($members as $member): ?>
                    {
                        name: <?php echo json_encode($member->FullName); ?>,
                        description: <?php echo json_encode($member->Description); ?>,
                        photo: <?php echo json_encode($member->PhotoName); ?>
                    },
                    <?php endforeach; ?>
                ];

                function openMemberModal(index) {
                    var member = membersData[index];
                    var modal = document.getElementById('memberModal');

                    document.getElementById('modalName').textContent = member.name;
                    document.getElementById('modalDescription').textContent = member.description || 'Інформація відсутня';

                    var photoContainer = document.getElementById('modalPhoto');
                    if (member.photo) {
                        photoContainer.innerHTML = '<img src="<?php echo Yii::app()->baseUrl; ?>/photo/' + member.photo + '" alt="' + member.name + '" />';
                    } else {
                        photoContainer.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>';
                        photoContainer.classList.add('modal-photo-placeholder');
                    }

                    modal.style.display = 'block';
                    document.body.style.overflow = 'hidden';

                    setTimeout(function() {
                        modal.classList.add('show');
                    }, 10);
                }

                function closeMemberModal() {
                    var modal = document.getElementById('memberModal');
                    modal.classList.remove('show');

                    setTimeout(function() {
                        modal.style.display = 'none';
                        document.body.style.overflow = 'auto';
                    }, 300);
                }

                window.onclick = function(event) {
                    var modal = document.getElementById('memberModal');
                    if (event.target == modal) {
                        closeMemberModal();
                    }
                }

                document.addEventListener('keydown', function(event) {
                    if (event.key === 'Escape') {
                        closeMemberModal();
                    }
                });
            </script>

            <style>
                .clickable-card {
                    cursor: pointer;
                    position: relative;
                }

                .clickable-card::after {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    border-radius: 15px;
                    transition: all 0.3s ease;
                    pointer-events: none;
                }

                .clickable-card:hover::after {
                    box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.3);
                }

                .card-footer {
                    margin-top: 1rem;
                    padding-top: 1rem;
                    border-top: 1px solid var(--bg-light);
                    text-align: center;
                }

                .view-more {
                    color: var(--secondary-color);
                    font-weight: 600;
                    font-size: 0.95rem;
                    transition: all 0.3s ease;
                }

                .clickable-card:hover .view-more {
                    color: var(--primary-color);
                    transform: translateX(5px);
                    display: inline-block;
                }

                .member-description-preview {
                    max-height: 4.5em;
                    overflow: hidden;
                }

                /* Modal Styles */
                .modal {
                    display: none;
                    position: fixed;
                    z-index: 2000;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0);
                    transition: background-color 0.3s ease;
                }

                .modal.show {
                    background-color: rgba(0, 0, 0, 0.7);
                }

                .modal-content {
                    position: relative;
                    background-color: var(--white);
                    margin: 5% auto;
                    padding: 0;
                    border-radius: 20px;
                    width: 90%;
                    max-width: 800px;
                    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                    opacity: 0;
                    transform: translateY(-50px) scale(0.9);
                    transition: all 0.3s ease;
                }

                .modal.show .modal-content {
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }

                .modal-close {
                    position: absolute;
                    right: 20px;
                    top: 20px;
                    color: var(--text-light);
                    font-size: 35px;
                    font-weight: bold;
                    cursor: pointer;
                    z-index: 10;
                    width: 40px;
                    height: 40px;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    transition: all 0.3s ease;
                    background: transparent;
                }

                .modal-close:hover {
                    color: var(--primary-color);
                    background: var(--bg-light);
                    transform: rotate(90deg);
                }

                .modal-body {
                    display: grid;
                    grid-template-columns: 1fr 1.5fr;
                    gap: 2rem;
                    padding: 3rem;
                }

                .modal-photo-container {
                    display: flex;
                    align-items: flex-start;
                    justify-content: center;
                }

                .modal-photo {
                    width: 100%;
                    max-width: 300px;
                    border-radius: 15px;
                    overflow: hidden;
                    box-shadow: var(--shadow-md);
                }

                .modal-photo img {
                    width: 100%;
                    height: auto;
                    display: block;
                }

                .modal-photo-placeholder {
                    background: var(--gradient-primary);
                    color: var(--white);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    min-height: 300px;
                }

                .modal-info-container {
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                }

                .modal-name {
                    font-size: 2rem;
                    color: var(--primary-color);
                    margin-bottom: 1.5rem;
                    line-height: 1.3;
                }

                .modal-description {
                    font-size: 1.1rem;
                    line-height: 1.8;
                    color: var(--text-dark);
                }

                @media (max-width: 768px) {
                    .modal-body {
                        grid-template-columns: 1fr;
                        padding: 2rem;
                    }

                    .modal-content {
                        margin: 10% auto;
                        width: 95%;
                    }

                    .modal-name {
                        font-size: 1.5rem;
                    }

                    .modal-description {
                        font-size: 1rem;
                    }

                    .modal-photo {
                        max-width: 250px;
                        margin: 0 auto;
                    }

                    .modal-photo-placeholder {
                        min-height: 250px;
                    }
                }
            </style>
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
