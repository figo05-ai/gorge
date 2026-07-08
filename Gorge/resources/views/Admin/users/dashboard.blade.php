@extends('Admin.users.layouts.user')
@section('title', 'لوحة التحكم')

@section('styles')
<style nonce="{{ $csp_nonce }}">
    /* Tabs */
    .tabs-nav {
        display: flex;
        justify-content: flex-start; /* إجبار التابات تيجي يمين */
        gap: 10px;
        border-bottom: 1px solid var(--glass-border);
        margin-bottom: 65px;
        direction: rtl;
    }
.tab-link {
    padding: 15px 25px;
    cursor: pointer;
    font-weight: 700;
    font-size: 16px;
    color: var(--text-secondary);
    border-bottom: 3px solid transparent;
    transition: all 0.3s ease;
    width: 210px;
    text-align: center;
    white-space: nowrap;
}
    .tab-link:hover {
        color: var(--text-primary);
    }
    .tab-link.active {
        color: var(--gold-light);
        border-bottom-color: var(--gold-light);
    }
    .tab-content {
        display: none;
    }
    .tab-content.active {
        display: block;
        animation: fadeIn 0.5s ease;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* --- تنسيقات العنوان الجديد (ملخص تقدمك) --- */
.progress-header {
        display: flex;
        justify-content: flex-start; /* إجبار العنوان ييجي يمين */
        margin-top: 40px;
        margin-bottom: 30px;
        direction: rtl;
        width: 100%;
    }

    .progress-title {
        font-size: 28px;
        color: var(--text-primary);
        position: relative;
        display: inline-block;
        padding-bottom: 12px;
    }

    /* الخط الذهبي الشيك تحت العنوان */
    .progress-title::after {
    content: '';
    position: absolute;
    right: 0;
    bottom: 0;
    width: 70%;
    height: 3px;
    background: linear-gradient(90deg, var(--gold-light, #ffd700), transparent);
    border-radius: 3px;
}

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
        margin-bottom: 40px;
        direction: rtl;
    }

    /* متجاوب مع شاشات الموبايل */
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }

    .stat-card {
        background: var(--bg-card);
        border: 1px solid var(--glass-border);
        border-radius: var(--radius-card);
        padding: 25px;
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .stat-icon {
        font-size: 32px;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: var(--gold-pale);
        color: var(--gold-light);
        flex-shrink: 0;
    }
    .stat-info .stat-number {
        font-size: 28px;
        font-weight: 800;
        color: var(--text-primary);
    }
    .stat-info .stat-label {
        font-size: 15px;
        color: var(--text-secondary);
    }

    /* My Courses Grid */
/* My Courses Grid */
    .my-courses-grid {
        display: grid;
        /* استخدام auto-fill بيظبط العرض حتى لو كورس واحد */
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
        direction: rtl;
        width: 100%; /* ضمان أخذ العرض الكامل للشاشة */
    }

    @media (max-width: 992px) {
        .my-courses-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .my-courses-grid {
            grid-template-columns: 1fr;
        }
    }

    .my-course-card {
        background: var(--bg-card);
        border: 1px solid var(--glass-border);
        border-radius: var(--radius-card);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: all 0.4s ease;
    }

    .my-course-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.4);
        border-color: rgba(59, 126, 245, 0.3);
    }

    .my-course-card .card-body {
        padding: 25px;
        flex-grow: 1;
        text-align: right;
        direction: rtl;
    }

    .my-course-card h3 {
        font-size: 20px;
        color: var(--text-primary);
        margin-bottom: 12px;
        line-height: 1.5;
        word-wrap: break-word;
        overflow-wrap: break-word;
        word-break: break-all;
    }

    .my-course-card .btn-view-course {
        display: block;
        text-align: center;
        padding: 15px;
        background: var(--blue);
        color: white;
        text-decoration: none;
        font-weight: 700;
        transition: background 0.3s;
    }

    .my-course-card .btn-view-course:hover {
        background: #2a68d8;
    }

    /* =========================================
       تنسيقات قسم الكورسات المتاحة (الجديدة)
       ========================================= */
    .explore-courses-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
        direction: rtl;
        margin-bottom: 30px;
    }

    @media (max-width: 992px) {
        .explore-courses-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .explore-courses-grid { grid-template-columns: 1fr; }
    }

    .explore-course-card {
        background: var(--bg-card);
        border: 1px solid var(--glass-border);
        border-radius: var(--radius-card);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: all 0.4s ease;
    }

    .explore-course-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.4);
        border-color: rgba(37, 211, 102, 0.4); /* لون أخضر خفيف متناسق مع الواتساب */
    }

    /* حل مشكلة الصورة العملاقة */
    .explore-course-card .card-img-top {
        width: 100%;
        height: 220px; /* ارتفاع ثابت للصورة */
        object-fit: cover; /* يمنع تشوه الصورة ويقص الزيادة */
        border-bottom: 1px solid var(--glass-border);
    }

    .explore-course-card .card-body {
        padding: 25px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        text-align: right;
    }

    .explore-course-card h3 {
        font-size: 20px;
        color: var(--text-primary);
        margin-bottom: 10px;
        line-height: 1.4;
    }

    .explore-course-card p {
        color: var(--text-secondary);
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 20px;
        flex-grow: 1; /* بيدفع السعر والزرار لتحت */
    }

    .explore-course-card .card-footer {
        border-top: 1px dashed var(--glass-border);
        padding-top: 15px;
    }

    .explore-course-card .course-price {
        font-size: 24px;
        font-weight: 800;
        color: var(--gold-light);
    }
    .explore-course-card .course-price span {
        font-size: 14px;
        color: var(--text-secondary);
        font-weight: normal;
    }

    .btn-whatsapp-card {
        display: block;
        text-align: center;
        padding: 15px;
        background: #25D366; /* لون الواتساب */
        color: white;
        text-decoration: none;
        font-weight: 700;
        font-size: 16px;
        transition: background 0.3s;
    }

    .btn-whatsapp-card:hover {
        background: #128C7E;
        color: white;
    }

    .btn-whatsapp-card i {
        margin-left: 8px;
    }

    /* Welcome Modal Styles */
    .modal-overlay {
        position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 1000;
        display: flex; align-items: center; justify-content: center;
        padding: 20px; backdrop-filter: blur(8px);
        opacity: 0; visibility: hidden; transition: all 0.3s ease;
    }
    .modal-overlay.show { opacity: 1; visibility: visible; }
    .modal-content {
        background: var(--bg-secondary); border: 1px solid var(--glass-border);
        border-radius: var(--radius-card); width: 100%; max-width: 550px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.5);
        transform: scale(0.95); transition: all 0.3s ease;
        text-align: center;
    }
    .modal-overlay.show .modal-content { transform: scale(1); }
    .modal-header {
        padding: 25px 30px;
        border-bottom: 1px solid var(--glass-border);
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .modal-header h3 {
        font-size: 22px;
        color: var(--gold-light);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .modal-body { padding: 30px 40px; }
    .modal-body p {
        color: var(--text-secondary);
        line-height: 1.8;
        font-size: 17px;
        margin-bottom: 30px;
    }
    .btn-whatsapp {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        width: 100%;
        padding: 16px;
        background: #25D366;
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 800;
        font-size: 18px;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s;
    }
    .btn-whatsapp:hover {
        background: #128C7E;
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4);
    }
</style>
@endsection

@section('content')

@if ($totalEnrolledCourses > 0)
    <div class="tabs-container">
        <nav class="tabs-nav">
            <a class="tab-link active" data-tab="my-courses">كورساتي</a>
            <a class="tab-link" data-tab="explore-courses">الكورسات المتاحة</a>
            <a class="tab-link" data-tab="home">ملخص التقدم</a>
        </nav>

        <div id="my-courses" class="tab-content active">
            <div class="progress-header">
                <h2 class="progress-title">كورساتك النشطة</h2>
            </div>
            <div class="my-courses-grid" style="direction: rtl;">
                @forelse ($activeCourses as $course)
                    <div class="my-course-card">
                        <div class="card-body">
                            <h3>{{ $course->title }}</h3>
                        </div>
                        <a href="{{ route('user.course_details', $course->id) }}" class="btn-view-course">
                            <i class="fa-solid fa-play"></i> ابدأ التعلم
                        </a>
                    </div>
                @empty
                    <p style="text-align: right; color: var(--text-secondary); margin-top: 20px;">ليس لديك أي كورسات نشطة حالياً.</p>
                @endforelse
            </div>
        </div>

        <div id="explore-courses" class="tab-content">
            <div class="progress-header">
                <h2 class="progress-title">الكورسات المتاحة للاشتراك</h2>
            </div>
            <div class="explore-courses-grid">
                @forelse ($availableCourses as $course)
                    <div class="explore-course-card">
                        <img src="{{ $course->image_path ? asset('storage/' . $course->image_path) : asset('images/default-course.jpg') }}" alt="{{ $course->title }}" class="card-img-top">
                        <div class="card-body">
                            <h3>{{ $course->title }}</h3>
                            <p>{{ Str::limit($course->description, 120) }}</p>
                            <div class="card-footer">
                                <div class="course-price">{{ $course->price }} <span>EGP</span></div>
                            </div>
                        </div>
                        <a href="https://wa.me/201229004186" target="_blank" class="btn-whatsapp-card">
                            <i class="fab fa-whatsapp"></i>
                            تواصل للاشتراك
                        </a>
                    </div>
                @empty
                    <p style="grid-column: 1 / -1; text-align: right; color: var(--text-secondary); margin-top: 20px;">
                        رائع! أنت مشترك في جميع الكورسات المتاحة حالياً.
                    </p>
                @endforelse
            </div>
        </div>

        <div id="home" class="tab-content">
            <!-- العنوان بالتنسيق الجديد -->
            <div class="progress-header">
                <h2 class="progress-title">ملخص تقدمك</h2>
            </div>

            <!-- الكروت مرصوصة جنب بعض -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-book"></i></div>
                    <div class="stat-info">
                        <div class="stat-number">{{ $totalEnrolledCourses }}</div>
                        <div class="stat-label">كورس مشترك به</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-chart-line"></i></div>
                    <div class="stat-info">
                        <div class="stat-number">{{ $overallProgressPercentage }}%</div>
                        <div class="stat-label">مستوى التقدم العام</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="section-header" style="direction: rtl;">
        <h2 class="section-title">مرحباً بك في <span class="highlight">الأكاديمية</span></h2>
        <p class="section-subtitle">
            حسابك في انتظار التفعيل. يرجى التواصل معنا للاشتراك في أحد كورساتنا وبدء رحلتك التعليمية.
        </p>
    </div>

    <!-- Welcome Modal for new users -->
    <div id="welcome-modal" class="modal-overlay show">
        <div class="modal-content" style="direction: rtl;">
            <div class="modal-header">
                <h3><i class="fa-solid fa-rocket"></i> مرحباً بك في أكاديمية مكتب فني</h3>
            </div>
            <div class="modal-body">
                <p>
                    حسابك غير مفعل بعد. لبدء رحلتك التعليمية وتفعيل حسابك، يرجى الاشتراك في أحد كورساتنا أولاً عبر التواصل معنا.
                </p>
                <a href="https://wa.me/201229004186" target="_blank" class="btn-whatsapp">
                    <i class="fab fa-whatsapp"></i>
                    تواصل معنا للاشتراك
                </a>
            </div>
        </div>
    </div>
@endif
@endsection

@section('scripts')
<script nonce="{{ $csp_nonce }}">
document.addEventListener('DOMContentLoaded', function () {
    @if ($totalEnrolledCourses > 0)
        const tabLinks = document.querySelectorAll('.tab-link');
        const tabContents = document.querySelectorAll('.tab-content');

        tabLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const tabId = this.dataset.tab;

                tabLinks.forEach(l => l.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));

                this.classList.add('active');
                document.getElementById(tabId).classList.add('active');
            });
        });
    @endif
});
</script>
@endsection
