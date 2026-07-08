@extends('Admin.users.layouts.user')
@section('title', 'تفاصيل الكورس: ' . $course->title)
@section('bodyClass', 'page-course-details')

@section('styles')
<style nonce="{{ $csp_nonce }}">
    /* الحاوية الرئيسية للكورس */
    .v-course-wrapper {
        display: grid;
        grid-template-columns: 350px 1fr;
        align-items: stretch;
        gap: 30px;
        width: 100%;
        flex-grow: 1;
        min-height: 0;
    }

    /* 1. القائمة (على اليمين) */
    .v-sidebar {
        background: var(--bg-card);
        border: 1px solid var(--glass-border);
        border-radius: 12px;
        display: flex;
        flex-direction: column;
    }

    .v-sidebar-header {
        padding: 20px;
        border-bottom: 1px solid var(--glass-border);
    }

    .v-sidebar-header h3 {
        font-size: 20px;
        color: var(--text-primary);
        margin: 0;
    }

    .v-sessions-list {
        padding: 15px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .v-sessions-list::-webkit-scrollbar { width: 6px; }
    .v-sessions-list::-webkit-scrollbar-track { background: rgba(0,0,0,0.1); }
    .v-sessions-list::-webkit-scrollbar-thumb { background: var(--gold-pale); border-radius: 10px; }

    .v-session-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px;
        border-radius: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
        border: 1px solid transparent;
    }

    .v-session-info {
        display: flex;
        align-items: center;
        gap: 15px;
        overflow: hidden;
    }

    .v-session-order {
        font-weight: 700;
        color: var(--text-primary);
        border: 1px solid var(--text-secondary);
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .v-session-title {
        font-weight: 600;
        color: var(--text-primary);
        font-size: 15px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* حالات العناصر في القائمة */
    .v-session-item.locked { opacity: 0.5; cursor: not-allowed; }
    .v-session-item.unlocked:hover { background: rgba(255, 255, 255, 0.05); }
    .v-session-item.active {
        background: var(--gold-pale);
        border-color: var(--gold-light);
    }
    .v-session-item.active .v-session-order {
        background: var(--gold-light);
        border-color: var(--gold-light);
        color: var(--bg-primary);
    }
    .v-session-item.completed .v-session-title { text-decoration: line-through; color: var(--text-secondary); }

    /* 2. منطقة الفيديو والزراير (على اليسار) */
    .v-content-area {
        min-width: 0;
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    .v-video-box {
        position: relative;
        width: 100%;
        aspect-ratio: 16 / 9;
        background-color: #000;
        background-size: cover;
        background-position: center;
        border-radius: 12px;
        border: 1px solid var(--glass-border);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .v-video-overlay {
        position: absolute;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    .v-play-icon {
        position: absolute;
        font-size: 80px;
        color: rgba(255,255,255,0.8);
        cursor: pointer;
        transition: transform 0.3s ease;
        z-index: 2;
    }

    .v-video-box:hover .v-play-icon {
        transform: scale(1.15);
        color: #fff;
    }

    /* صف الزراير - تم التعديل ليأخذ الزر العرض بالكامل */
    .v-actions-row {
        display: flex;
        width: 100%;
    }

    .v-action-btn {
        flex: 1; /* الزر سيأخذ كل المساحة المتاحة */
        padding: 18px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 18px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        border: 1px solid var(--glass-border);
        color: var(--text-primary);
        background: var(--bg-card);
    }

    .v-action-btn:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: var(--gold-light);
    }

    @media (max-width: 992px) {
        .v-course-wrapper {
            grid-template-columns: 1fr;
        }
        .v-sidebar {
            max-height: 400px;
        }
    }
</style>
@endsection

@section('content')
<div style="margin-bottom: 30px;">
    <h2 style="font-size: 28px; font-weight: 800; color: var(--text-primary); word-break: break-word;">
        {{ $course->title }}
    </h2>
</div>

<div class="v-course-wrapper">
    <!-- 1. القائمة (اليمين) -->
    <div class="v-sidebar">
        <div class="v-sidebar-header">
            <h3>قائمة المحاضرات</h3>
        </div>

        <div class="v-sessions-list">
            @foreach ($sessions as $index => $session)
                @php
                    $is_unlocked = ($index <= $unlockedSessionIndex);
                    $is_active = ($index == $unlockedSessionIndex);
                    $is_completed = $session->user_completed;
                @endphp
                <div class="v-session-item
                    {{ $is_completed ? 'completed' : '' }}
                    {{ $is_unlocked ? 'unlocked' : 'locked' }}
                    {{ $is_active ? 'active' : '' }}"
                    data-session-id="{{ $session->id }}"
                    data-session-title="{{ $session->title }}"
                    data-drive-link="{{ $session->drive_link }}">

                    <div class="v-session-info">
                        <span class="v-session-order">{{ $index + 1 }}</span>
                        <span class="v-session-title" title="{{ $session->title }}">{{ $session->title }}</span>
                    </div>

                    <div class="v-session-icon">
                        @if($is_completed)
                            <i class="fa-solid fa-check" style="color: #27ae60;"></i>
                        @elseif(!$is_unlocked)
                            <i class="fa-solid fa-lock" style="color: var(--text-secondary);"></i>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- 2. منطقة الفيديو والزراير (اليسار) -->
    <div class="v-content-area">
        <!-- الفيديو -->
        <div class="v-video-box" @if($course->image_path) style="background-image: url('{{ asset('storage/' . $course->image_path) }}')" @endif>
            <div class="v-video-overlay"></div>
            <i class="fa-solid fa-play v-play-icon"></i>
        </div>

        <!-- الزراير -->
        <div class="v-actions-row" id="session-actions-container" style="display: none;">
            <!-- زر التحميل (سيأخذ العرض بالكامل الآن) -->
            <a href="#" id="btn-download" target="_blank" class="v-action-btn">
                تحميل المحاضرة
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- إضافة مكتبة SweetAlert2 لعمل Popups احترافية -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js" integrity="sha256-mB3oA3sPS9xGvUopSYG4BbJkUv2t2I1I3aZk2Fj222A=" crossorigin="anonymous"></script>

<script nonce="{{ $csp_nonce }}">
document.addEventListener('DOMContentLoaded', function() {
    // استخدمنا الـ wrapper الرئيسي لتطبيق الـ Event Delegation عشان يقرأ المحاضرات اللي هتتفتح جديد
    const sessionsList = document.querySelector('.v-sessions-list');
    const actionsContainer = document.getElementById('session-actions-container');
    const downloadBtn = document.getElementById('btn-download');

    // الدالة المسؤولة عن تحديث المحتوى عند اختيار محاضرة
    function updateContent(sessionElement) {
        document.querySelectorAll('.v-session-item').forEach(el => el.classList.remove('active'));
        sessionElement.classList.add('active');

        if (sessionElement.dataset.driveLink) {
            actionsContainer.style.display = 'flex';
            downloadBtn.href = sessionElement.dataset.driveLink;
        } else {
            actionsContainer.style.display = 'none';
        }
    }

    // إضافة الحدث للقائمة بالكامل للتعامل مع المحاضرات
    sessionsList.addEventListener('click', function(e) {
        const item = e.target.closest('.v-session-item');
        if (!item) return;

        // منع الدخول لو المحاضرة مقفولة
        if (item.classList.contains('locked')) {
            Swal.fire({
                icon: 'warning',
                title: 'غير مصرح!',
                text: 'يجب عليك تحميل المحاضرة السابقة أولاً لتتمكن من فتح هذه المحاضرة.',
                confirmButtonColor: '#d3b574'
            });
            return;
        }

        updateContent(item);
    });

    // تحديد أول محاضرة نشطة أوتوماتيك
    const firstActive = document.querySelector('.v-session-item.active') || document.querySelector('.v-session-item.unlocked');
    if (firstActive) {
        updateContent(firstActive);
    }

    // لوجيك زر "تحميل المحاضرة" لعمل الـ Popup وفك المحاضرة التالية
    downloadBtn.addEventListener('click', function(e) {
        e.preventDefault(); // منع فتح اللينك مباشرة

        const driveLink = this.getAttribute('href');
        if (driveLink === '#' || !driveLink) return;

        const activeSession = document.querySelector('.v-session-item.active');
        const instructorWhatsapp = "201000000000"; // حط هنا رقم الواتساب بتاع الانستراكتور بالكود الدولي

        Swal.fire({
            title: 'تنبيه هام!',
            html: `
                <div style="margin-bottom: 20px; font-size: 16px;">
                    هذه المحاضرة مشفرة، برجاء التواصل مع الإنستراكتور للحصول على الصلاحية وكود فك التشفير لتتمكن من مشاهدتها.
                </div>
                <a href="https://wa.me/${instructorWhatsapp}" target="_blank" style="display: inline-flex; align-items: center; gap: 10px; background: #25D366; color: white; padding: 12px 25px; border-radius: 8px; text-decoration: none; font-weight: bold; margin-bottom: 10px;">
                    <i class="fa-brands fa-whatsapp" style="font-size: 22px;"></i> تواصل عبر واتساب
                </a>
            `,
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'انتقل للمحاضرة',
            cancelButtonText: 'إلغاء',
            confirmButtonColor: '#d3b574',
            cancelButtonColor: '#444'
        }).then((result) => {
            if (result.isConfirmed) {
                // 1. فتح اللينك الخاص بالمحاضرة
                window.open(driveLink, '_blank');

                // 2. تحديث واجهة المستخدم لفتح المحاضرة اللي بعدها
                unlockNextSession(activeSession);

                // ملاحظة: لو عايز تضمن إن التحديث ده يفضل محفوظ لو اليوزر عمل ريفريش للصفحة
                // هتحتاج تبعت AJAX Request للباك إند هنا عشان تسجل إن الـ session دي اتعملها user_completed
                // fetch(`/api/complete-session/${activeSession.dataset.sessionId}`, { method: 'POST', ... });
            }
        });
    });

    // دالة لفك قفل المحاضرة التالية في الـ DOM
    function unlockNextSession(currentSession) {
        // تعليم المحاضرة الحالية كمكتملة
        currentSession.classList.add('completed');
        const iconContainer = currentSession.querySelector('.v-session-icon');
        if (iconContainer) {
            iconContainer.innerHTML = '<i class="fa-solid fa-check" style="color: #27ae60;"></i>';
        }

        // جلب العنصر التالي (المحاضرة اللي بعدها)
        const nextSession = currentSession.nextElementSibling;

        if (nextSession && nextSession.classList.contains('locked')) {
            // فك قفل المحاضرة اللي بعدها
            nextSession.classList.remove('locked');
            nextSession.classList.add('unlocked');

            // إزالة أيقونة القفل منها
            const nextIconContainer = nextSession.querySelector('.v-session-icon');
            if (nextIconContainer) {
                nextIconContainer.innerHTML = '';
            }
        }
    }
});
</script>
