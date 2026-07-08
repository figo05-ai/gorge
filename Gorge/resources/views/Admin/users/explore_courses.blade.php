@extends('Admin.users.layouts.user')

@section('title', 'استكشف الكورسات')

@section('styles')
<style nonce="{{ $csp_nonce }}">
    /* Course Grid */
    .courses-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 25px;
    }
    .course-card {
        background: var(--bg-card);
        border: 1px solid var(--glass-border);
        border-radius: var(--radius-card);
        padding: 25px;
        display: flex;
        flex-direction: column;
        transition: all 0.4s ease;
        cursor: pointer;
    }
    .course-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.4);
        border-color: rgba(201, 150, 58, 0.3);
    }
    .course-card h3 {
        font-size: 20px;
        color: var(--gold-light);
        margin-bottom: 12px;
    }
    .course-card p {
        color: var(--text-secondary);
        font-size: 15px;
        line-height: 1.7;
        flex-grow: 1;
        margin-bottom: 20px;
    }
    .course-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid var(--glass-border);
        padding-top: 15px;
        margin-top: auto;
    }
    .course-price {
        font-size: 22px;
        font-weight: 800;
        color: var(--text-primary);
    }
    .course-price span {
        font-size: 14px;
        font-weight: 500;
        color: var(--text-secondary);
    }
    .btn-details {
        padding: 10px 20px;
        background: linear-gradient(135deg, var(--gold-light), var(--gold));
        color: #07090f;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s;
    }
    .btn-details:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(201, 150, 58, 0.3);
    }

    /* Modal Styles */
    .modal-overlay {
        position: fixed; inset: 0; background: rgba(0,0,0,0.7); z-index: 1000;
        display: flex; align-items: center; justify-content: center;
        padding: 20px; backdrop-filter: blur(8px);
        opacity: 0; visibility: hidden; transition: all 0.3s ease;
    }
    .modal-overlay.show { opacity: 1; visibility: visible; }
    .modal-content {
        background: var(--bg-secondary); border: 1px solid var(--glass-border);
        border-radius: var(--radius-card); width: 100%; max-width: 600px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.5);
        transform: scale(0.95); transition: all 0.3s ease;
    }
    .modal-overlay.show .modal-content { transform: scale(1); }
    .modal-header {
        padding: 20px 30px; border-bottom: 1px solid var(--glass-border);
        display: flex; justify-content: space-between; align-items: center;
    }
    .modal-header h3 { font-size: 20px; color: var(--gold-light); margin: 0; }
    .close-modal { background: none; border: none; color: var(--text-secondary); font-size: 28px; cursor: pointer; line-height: 1; }
    .modal-body { padding: 30px; }
    .modal-body p { color: var(--text-secondary); line-height: 1.8; font-size: 16px; margin-bottom: 25px; }
    .modal-price { text-align: center; margin-bottom: 30px; }
    .modal-price .price-value {
        font-size: 48px;
        font-weight: 900;
        color: var(--text-primary);
        background: linear-gradient(135deg, var(--gold-light), var(--gold));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .modal-price .price-currency {
        font-size: 20px;
        font-weight: 600;
        color: var(--text-secondary);
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
<div class="section-header">
    <h2 class="section-title">استكشف <span class="highlight">كورساتنا</span></h2>
    <p class="section-subtitle">
        أنت على بعد خطوة واحدة من بدء رحلتك التعليمية. اختر الكورس الذي يناسبك وتواصل معنا للاشتراك.
    </p>
</div>

<div class="courses-grid">
    @forelse ($data as $course)
        <div class="course-card" data-course-id="{{ $course->id }}">
            <h3>{{ $course->title }}</h3>
            <p>{{ Str::limit($course->description, 150) }}</p>
            <div class="course-card-footer">
                <div class="course-price">{{ $course->price }} <span>EGP</span></div>
                <button class="btn-details">عرض التفاصيل</button>
            </div>
        </div>
    @empty
        <p>لا توجد كورسات متاحة حالياً.</p>
    @endforelse
</div>

<!-- Details Modal -->
<div id="details-modal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modal-course-title"></h3>
            <button type="button" class="close-modal" aria-label="Close">&times;</button>
        </div>
        <div class="modal-body">
            <p id="modal-course-description"></p>
            <div class="modal-price">
                <span class="price-value" id="modal-course-price"></span>
                <span class="price-currency">EGP</span>
            </div>
            <a href="https://wa.me/201229004186" target="_blank" class="btn-whatsapp">
                <i class="fab fa-whatsapp"></i>
                تواصل للاشتراك
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script nonce="{{ $csp_nonce }}">
document.addEventListener('DOMContentLoaded', function () {
    const courses = @json($data);
    const modal = document.getElementById('details-modal');
    const modalTitle = document.getElementById('modal-course-title');
    const modalDescription = document.getElementById('modal-course-description');
    const modalPrice = document.getElementById('modal-course-price');

    document.querySelectorAll('.course-card').forEach(card => {
        card.addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-details') || e.target.closest('.btn-details')) {
                const courseId = this.dataset.courseId;
                const course = courses.find(c => c.id == courseId);

                if (course) {
                    modalTitle.textContent = course.title;
                    modalDescription.textContent = course.description;
                    modalPrice.textContent = course.price;
                    modal.classList.add('show');
                }
            }
        });
    });

    // Close modal logic
    modal.addEventListener('click', function (e) {
        if (e.target.classList.contains('close-modal') || e.target.classList.contains('modal-overlay')) {
            modal.classList.remove('show');
        }
    });
});
</script>
