<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>لوحة الإدارة - أكاديمية مكتب فني</title>
    <style nonce="{{ $csp_nonce }}">
        :root {
            --bg-primary:      #07090f;
            --bg-secondary:    #0c1020;
            --bg-card:         rgba(14, 20, 38, 0.88);
            --glass-border:    rgba(255, 255, 255, 0.07);
            --gold-pale:       rgba(201, 150, 58, 0.12);
            --gold:            #c9963a;
            --gold-light:      #f0c76a;
            --blue:            #3b7ef5;
            --text-primary:    #edf2ff;
            --text-secondary:  #7a92b8;
            --radius-card:     22px;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Cairo', sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            background-image:
                radial-gradient(ellipse 40% 55% at 55% 50%, rgba(14, 20, 38, 0.6) 0%, transparent 80%);
        }
        /* النافذة العلوية */
        .navbar {
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            background: rgba(7, 9, 15, 0.75);
            border-bottom: 1px solid var(--glass-border);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .navbar-title {
            font-size: 20px;
            font-weight: 700;
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .admin-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .admin-card {
            background: var(--bg-card);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-card);
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.3);
        }
        .admin-card h2 {
            margin-bottom: 24px;
            font-size: 22px;
            color: var(--gold-light);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        /* الكورسات جريد */
        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }
        .course-card {
            background: rgba(0,0,0,0.3);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s;
            cursor: pointer; /* لإظهار أنه يمكن الضغط عليه */
        }
        .course-card:hover {
            border-color: var(--gold);
            transform: translateY(-5px);
        }
        .course-card-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
        .course-card-body {
            padding: 20px;
        }
        .course-card-body h3 {
            color: var(--gold-light);
            margin-bottom: 10px;
            font-size: 18px;
        }
        .course-card-body p {
            font-size: 14px;
            color: var(--text-secondary);
            margin-bottom: 15px;
            line-height: 1.5;
        }
        .course-card-footer {
            display: flex;
            gap: 8px;
            border-top: 1px solid var(--glass-border);
            padding-top: 15px;
        }
        .btn-action {
            flex: 1;
            padding: 8px 0;
            border: none;
            border-radius: 8px;
            font-family: 'Cairo';
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }
        .btn-manage { background: rgba(59, 126, 245, 0.15); color: #3b7ef5; }
        .btn-manage:hover { background: #3b7ef5; color: #fff; }
        .btn-edit { background: rgba(240, 199, 106, 0.15); color: var(--gold-light); }
        .btn-edit:hover { background: var(--gold-light); color: #000; }
        .btn-delete { background: rgba(235, 87, 87, 0.15); color: #eb5757; }
        .btn-delete:hover { background: #eb5757; color: #fff; }

        /* الفورم */
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block; margin-bottom: 8px; color: var(--text-secondary);
            font-weight: 600; font-size: 14px;
        }
        .form-control {
            width: 100%; padding: 14px 18px; background: rgba(0,0,0,0.4);
            border: 1px solid var(--glass-border); border-radius: 12px;
            color: var(--text-primary); font-family: 'Cairo', sans-serif; font-size: 15px; transition: all 0.3s;
        }
        .form-control:focus { outline: none; border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201, 150, 58, 0.15); }

        /* الزراير */
        .btn-primary {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            padding: 14px 28px; background: linear-gradient(135deg, var(--gold-light), var(--gold));
            color: #07090f; border: none; border-radius: 12px; font-weight: 800; font-size: 16px;
            cursor: pointer; transition: all 0.3s ease; font-family: 'Cairo'; width: 100%;
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(201, 150, 58, 0.3); }
        .btn-outline {
            display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px;
            background: transparent; color: var(--gold-light); border: 1px solid var(--gold-light);
            border-radius: 12px; text-decoration: none; font-weight: 700; font-size: 14px;
            transition: all 0.3s ease; font-family: 'Cairo'; cursor: pointer;
        }
        .btn-outline:hover { background: rgba(201, 150, 58, 0.1); transform: translateY(-2px); }

        /* رسائل الإشعار Toast */
        .toast {
            position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%) translateY(20px);
            background: var(--gold-light); color: #000; padding: 12px 30px; border-radius: 50px;
            font-weight: 700; opacity: 0; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: 1000; box-shadow: 0 5px 20px rgba(201,150,58,0.4); pointer-events: none;
        }
        .toast.show { opacity: 1; transform: translateX(-50%) translateY(0); pointer-events: auto; }

        /* Modals POPs */
        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.8); backdrop-filter: blur(5px);
            display: flex; justify-content: center; align-items: center;
            z-index: 1000; opacity: 0; visibility: hidden; transition: all 0.3s;
        }
        .modal-overlay.show { opacity: 1; visibility: visible; }
        .modal-content {
            background: var(--bg-card); border: 1px solid var(--glass-border);
            border-radius: var(--radius-card); padding: 30px; width: 90%; max-width: 500px;
            transform: translateY(-20px); transition: all 0.3s;
        }
        .modal-overlay.show .modal-content { transform: translateY(0); }
        .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .modal-header h3 { color: var(--gold-light); }
        .close-modal { background: none; border: none; color: var(--text-secondary); font-size: 24px; cursor: pointer; }
        .close-modal:hover { color: #eb5757; }

        /* تنسيقات خاصة بـ POP السيشنات المزدوجة */
        .sessions-split-layout {
            display: flex;
            gap: 30px;
            align-items: flex-start;
        }
        .session-form-panel {
            flex: 1;
        }
        .sessions-list-panel {
            flex: 1;
            border-right: 1px solid var(--glass-border);
            padding-right: 30px;
            max-height: 400px;
            overflow-y: auto;
        }

        /* تنسيقات عناصر السيشن وتأثير الـ Hover */
        .session-item {
            background: rgba(0,0,0,0.3);
            margin-bottom: 12px;
            padding: 12px 15px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid transparent;
            transition: all 0.3s ease;
        }
        .session-item:hover {
            border-color: var(--gold-light);
            background: rgba(0,0,0,0.5);
        }
        .session-item .control-buttons {
            opacity: 0;
            visibility: hidden;
            display: flex;
            gap: 8px;
            transition: all 0.3s ease;
        }
        /* إظهار الزراير عند وقوف الماوس */
        .session-item:hover .control-buttons {
            opacity: 1;
            visibility: visible;
        }

        .session-drag-handle { color: var(--text-secondary); cursor: grab; }
        .session-title { font-weight: 600; font-size: 15px; }
        .empty-state { text-align: center; padding: 30px; color: var(--text-secondary); font-weight: 600; }

        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 16px; text-align: right; border-bottom: 1px solid var(--glass-border); font-size: 15px; }
        th { color: var(--text-secondary); font-weight: 700; }
        .btn-danger {
            background: rgba(235, 87, 87, 0.1); color: #eb5757; border: 1px solid rgba(235, 87, 87, 0.3);
            padding: 8px 14px; border-radius: 8px; cursor: pointer; font-family: 'Cairo'; font-weight: 600; transition: all 0.3s;
        }
        .btn-danger:hover { background: #eb5757; color: #fff; }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-title"><i class="fa-solid fa-gear"></i> لوحة الإدارة - أكاديمية مكتب فني</div>
        <div style="display: flex; gap: 12px;">
            <form action="{{ url('/logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-outline" style="color: #eb5757; border-color: rgba(235, 87, 87, 0.4); cursor: pointer;">
                    <i class="fa-solid fa-right-from-bracket"></i> تسجيل الخروج
                </button>
            </form>
            <button id="add-course-btn" class="btn-outline"><i class="fa-solid fa-plus"></i> إنشاء كورس</button>
            <a href="{{ route('admin.users.index') }}" class="btn-outline"><i class="fa-solid fa-users"></i> إدارة المستخدمين</a>
        </div>
    </nav>

    @if(session('success'))
        <div id="laravel-toast" class="toast show">{{ session('success') }}</div>
    @endif

    <div class="admin-container" id="dashboard-view" style="max-width: 1200px;">

        <div class="admin-card">
            <h2><i class="fa-solid fa-book-open"></i> إدارة الكورسات</h2>
            <div id="courses-grid" class="courses-grid">
                @forelse ($courses as $course)
                    <div class="course-card" data-course-id="{{ $course->id }}" data-course-details="{{ $course->toJson() }}">
                        <img src="{{ asset($course->image_path ? 'storage/' . $course->image_path : 'images/default-course.jpg') }}" alt="{{ $course->title }}" class="course-card-img">
                        <div class="course-card-body">
                            <h3>{{ $course->title }}</h3>
                            <p>{{ Str::limit($course->description, 100) }}</p>
                            <div class="course-card-footer">
                                <button class="btn-action btn-manage btn-manage-sessions"><i class="fa-solid fa-list-check"></i> السيشنات</button>
                                <button class="btn-action btn-edit btn-edit-course"><i class="fa-solid fa-pen"></i> تعديل</button>
                                <button class="btn-action btn-delete btn-delete-course"><i class="fa-solid fa-trash"></i> حذف</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <p id="no-courses-message" class="empty-state" style="grid-column: 1 / -1;">لا توجد كورسات مضافة حالياً.</p>
                @endforelse
            </div>
        </div>

        <!-- Card for Managing Settings (Program Links) -->
        <div class="admin-card">
            <h2><i class="fa-solid fa-link"></i> إدارة روابط البرامج (لاندنج بيدج)</h2>
            <form action="{{ url('/admin/settings') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="master_drive_link">رابط أعمال المتدربين العام (Google Drive)</label>
                    <input type="url" id="master_drive_link" name="master_drive_link" class="form-control" value="{{ old('master_drive_link', $setting->master_drive_link) }}" placeholder="https://...">
                </div>
                <hr style="border-color: var(--glass-border); margin: 25px 0;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="sketchup_link">رابط Sketchup & Lumion</label>
                        <input type="url" id="sketchup_link" name="sketchup_link" class="form-control" value="{{ old('sketchup_link', $setting->sketchup_link) }}" placeholder="https://..." required>
                    </div>
                    <div class="form-group">
                        <label for="max_link">رابط 3Ds Max & Corona</label>
                        <input type="url" id="max_link" name="max_link" class="form-control" value="{{ old('max_link', $setting->max_link) }}" placeholder="https://..." required>
                    </div>
                    <div class="form-group">
                        <label for="autocad_link">رابط Autocad</label>
                        <input type="url" id="autocad_link" name="autocad_link" class="form-control" value="{{ old('autocad_link', $setting->autocad_link) }}" placeholder="https://..." required>
                    </div>
                    <div class="form-group">
                        <label for="manual_link">رابط Manual Sketch</label>
                        <input type="url" id="manual_link" name="manual_link" class="form-control" value="{{ old('manual_link', $setting->manual_link) }}" placeholder="https://..." required>
                    </div>
                    <div class="form-group">
                        <label for="landscape_link">رابط Real Time Landscape</label>
                        <input type="url" id="landscape_link" name="landscape_link" class="form-control" value="{{ old('landscape_link', $setting->landscape_link) }}" placeholder="https://..." required>
                    </div>
                </div>
                <button type="submit" class="btn-primary" style="margin-top: 10px;"><i class="fa-solid fa-save"></i> حفظ روابط البرامج</button>
            </form>
        </div>

        <!-- Card for Managing Carousel Projects -->
        <div class="admin-card">
            <h2><i class="fa-solid fa-images"></i> إدارة أعمال المتدربين (الكاروسيل)</h2>
            <form action="{{ url('/admin/projects') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="project_image">صورة المشروع</label>
                    <input type="file" id="project_image" name="image" class="form-control" accept="image/*" required>
                </div>
                <div class="form-group">
                    <label for="project_facebook_link">رابط منشور الفيسبوك</label>
                    <input type="url" id="project_facebook_link" name="facebook_link" class="form-control" placeholder="https://..." required>
                </div>
                <div class="form-group">
                    <label for="project_drive_link">رابط المشروع على جوجل درايف</label>
                    <input type="url" id="project_drive_link" name="drive_link" class="form-control" placeholder="https://..." required>
                </div>
                <button type="submit" class="btn-primary"><i class="fa-solid fa-plus"></i> إضافة مشروع جديد للكاروسيل</button>
            </form>

            <hr style="border-color: var(--glass-border); margin: 30px 0;">

            <h3 style="margin-bottom: 20px; color: var(--text-secondary);">المشاريع المضافة حالياً</h3>
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>الصورة</th>
                            <th>رابط الفيسبوك</th>
                            <th>رابط الدرايف</th>
                            <th>تحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($projects as $project)
                            <tr>
                                <td><img src="{{ asset('storage/' . $project->image_path) }}" alt="Project Image" style="width: 100px; height: 60px; object-fit: cover; border-radius: 8px;"></td>
                                <td><a href="{{ $project->facebook_link }}" target="_blank">رابط</a></td>
                                <td><a href="{{ $project->drive_link }}" target="_blank">رابط</a></td>
                                <td>
                                    <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا المشروع؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger"><i class="fa-solid fa-trash"></i> حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="empty-state">لا توجد مشاريع مضافة في الكاروسيل حالياً.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Course Modal (Create/Edit) -->
    <div id="course-modal" class="modal-overlay">
        <div class="modal-content">
            <form id="course-form" enctype="multipart/form-data">
                <div class="modal-header">
                    <h3 id="course-modal-title">إنشاء كورس جديد</h3>
                    <button type="button" class="close-modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_method" id="course-method-input">
                    <input type="hidden" name="course_id" id="course-id-input">
                    <div class="form-group">
                        <label for="title-input">اسم الكورس</label>
                        <input type="text" id="title-input" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="image-input">صورة الكورس</label>
                        <input type="file" id="image-input" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="description-input">وصف الكورس (ديسكربشن)</label>
                        <textarea id="description-input" name="description" class="form-control" required rows="4"></textarea>
                    </div>
                    <!-- تركت السعر اذا كنت تحتاجه، أو يمكنك حذفه لو لم يطلبه الديزاين -->
                    <div class="form-group">
                        <label for="price-input">السعر (EGP)</label>
                        <input type="number" id="price-input" name="price" class="form-control" required min="0" step="0.01">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-primary"><i class="fa-solid fa-plus"></i> إنشاء الكورس</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Sessions Modal -->
    <div id="sessions-modal" class="modal-overlay">
        <div class="modal-content" style="max-width: 900px; width: 95%;">
            <div class="modal-header">
                <h3 id="sessions-modal-title"></h3>
                <button type="button" class="close-modal" aria-label="Close">&times;</button>
            </div>

            <div class="modal-body sessions-split-layout">
                <!-- النصف الأيمن: إضافة سيشن -->
                <div class="session-form-panel">
                    <h4 id="session-form-title" style="margin-bottom: 20px; color: var(--gold-light);"><i class="fa-solid fa-plus"></i> إضافة سيشن</h4>
                    <form id="session-form">
                        <input type="hidden" name="session_id" id="session-id">
                        <div class="form-group">
                            <label for="session-title-input">اسم السيشن</label>
                            <input type="text" id="session-title-input" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="session-drive-link-input">لينك السيشن</label>
                            <input type="url" id="session-drive-link-input" name="drive_link" class="form-control" placeholder="https://..." required>
                        </div>
                        <button type="submit" class="btn-primary"><i class="fa-solid fa-plus"></i> إضافة سيشن</button>
                        <button type="button" id="cancel-edit-session-btn" class="btn-outline" style="display: none; margin-top: 10px; width: 100%;">إلغاء التعديل</button>
                    </form>
                </div>

                <!-- النصف الأيسر: قائمة السيشنات -->
                <div class="sessions-list-panel">
                    <h4 style="margin-bottom: 20px; color: var(--gold-light);"><i class="fa-solid fa-list-ul"></i> السيشنات المضافة</h4>
                    <ul id="sessions-list" style="list-style: none; padding: 0;"></ul>
                </div>
            </div>
        </div>
    </div>


    <script nonce="{{ $csp_nonce }}">
        document.addEventListener("DOMContentLoaded", function() {
            const toast = document.getElementById('laravel-toast');
            if (toast) {
                setTimeout(() => toast.classList.add('show'), 100);
                setTimeout(() => {
                    toast.classList.remove('show');
                }, 3000);
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js" integrity="sha256-ipiJrswvAR4VA/N+2Ok0w9xI/L8JIPY0F27Vl3mfs/c=" crossorigin="anonymous"></script>
    <script nonce="{{ $csp_nonce }}">
        document.addEventListener('DOMContentLoaded', function () {
            const csrfToken = '{{ csrf_token() }}';

            // --- Modals ---
            const courseModal = document.getElementById('course-modal');
            const sessionsModal = document.getElementById('sessions-modal');

            // --- Forms & Grids ---
            const coursesGrid = document.getElementById('courses-grid');
            const courseForm = document.getElementById('course-form');
            const sessionForm = document.getElementById('session-form');

            // --- Elements ---
            let currentCourseIdForSessions = null;
            let sortable = null;

            // --- Toast Notification ---
            function showToast(message) {
                const toast = document.getElementById('laravel-toast') || document.createElement('div');
                if (!document.getElementById('laravel-toast')) {
                    toast.id = 'laravel-toast';
                    toast.className = 'toast';
                    document.body.appendChild(toast);
                }
                toast.textContent = message;
                toast.classList.add('show');
                setTimeout(() => toast.classList.remove('show'), 3000);
            }

            // --- Modal Handling ---
            function openModal(modal) { modal.classList.add('show'); }
            function closeModal(modal) { modal.classList.remove('show'); }

            document.querySelectorAll('.close-modal').forEach(btn => {
                btn.addEventListener('click', () => {
                    closeModal(courseModal);
                    closeModal(sessionsModal);
                });
            });

            // --- Course Card Template ---
            function createCourseCard(course) {
                const defaultImage = '{{ asset("images/default-course.jpg") }}';
                const imageUrl = course.image_path ? `/storage/${course.image_path}` : defaultImage;
                return `
                    <div class="course-card" data-course-id="${course.id}" data-course-details='${JSON.stringify(course)}'>
                        <img src="${imageUrl}" alt="${course.title}" class="course-card-img">
                        <div class="course-card-body">
                            <h3>${course.title}</h3>
                            <p>${course.description.substring(0, 100)}...</p>
                            <div class="course-card-footer">
                                <button class="btn-action btn-manage btn-manage-sessions"><i class="fa-solid fa-list-check"></i> السيشنات</button>
                                <button class="btn-action btn-edit btn-edit-course"><i class="fa-solid fa-pen"></i> تعديل</button>
                                <button class="btn-action btn-delete btn-delete-course"><i class="fa-solid fa-trash"></i> حذف</button>
                            </div>
                        </div>
                    </div>
                `;
            }

            // --- Course CRUD ---
            document.getElementById('add-course-btn').addEventListener('click', () => {
                courseForm.reset();
                courseForm.action = '{{ route("admin.courses.store") }}';
                courseModal.querySelector('#course-modal-title').textContent = 'إنشاء كورس جديد';
                courseForm.querySelector('#course-method-input').value = 'POST';
                openModal(courseModal);
            });

            courseForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const isEditing = formData.get('_method') === 'PUT';

                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        showToast("تم الإنشاء بنجاح"); // رسالة مخصصة كما طلبت
                        closeModal(courseModal);
                        const newCardHTML = createCourseCard(data.course);
                        if (isEditing) {
                            const oldCard = coursesGrid.querySelector(`.course-card[data-course-id="${data.course.id}"]`);
                            if (oldCard) oldCard.outerHTML = newCardHTML;
                        } else {
                            const noCoursesMsg = document.getElementById('no-courses-message');
                            if(noCoursesMsg) noCoursesMsg.remove();
                            coursesGrid.insertAdjacentHTML('beforeend', newCardHTML);
                        }
                    } else {
                        showToast('حدث خطأ ما.');
                    }
                }).catch(err => console.error(err));
            });

            // --- Event Delegation for Course Cards ---
            coursesGrid.addEventListener('click', e => {
                const courseCard = e.target.closest('.course-card');
                if (!courseCard) return;
                const courseId = courseCard.dataset.courseId;
                const course = JSON.parse(courseCard.dataset.courseDetails);

                // Edit Course
                if (e.target.closest('.btn-edit-course')) {
                    courseForm.reset();
                    courseForm.action = `/admin/courses/${courseId}`;
                    courseModal.querySelector('#course-modal-title').textContent = `تعديل: ${course.title}`;
                    courseForm.querySelector('#course-method-input').value = 'PUT';
                    courseForm.querySelector('#title-input').value = course.title;
                    courseForm.querySelector('#description-input').value = course.description;
                    courseForm.querySelector('#price-input').value = course.price;
                    openModal(courseModal);
                    return;
                }

                // Delete Course
                if (e.target.closest('.btn-delete-course')) {
                    if (confirm('هل أنت متأكد من حذف هذا الكورس؟')) {
                        fetch(`/admin/courses/${courseId}`, {
                            method: 'DELETE',
                            headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                showToast(data.success);
                                courseCard.remove();
                            }
                        }).catch(err => console.error(err));
                    }
                    return;
                }

                // فتح موديل السيشنات عند الضغط على الكورس (صورة، تايتل، أو زر السيشنات)
                if (e.target.closest('.btn-manage-sessions') || e.target.closest('.course-card-img') || e.target.closest('h3') || e.target.closest('.course-card-body')) {
                    currentCourseIdForSessions = courseId;
                    sessionsModal.querySelector('#sessions-modal-title').textContent = `إدارة سيشنات: ${course.title}`;
                    loadSessions(courseId);
                    openModal(sessionsModal);
                }
            });

            // --- Session CRUD (inside Sessions Modal) ---
            const sessionsListEl = sessionsModal.querySelector('#sessions-list');

            function loadSessions(courseId) {
                fetch(`/admin/courses/${courseId}/sessions`)
                    .then(res => res.json())
                    .then(data => {
                        sessionsListEl.innerHTML = '';
                        if (data.length > 0) {
                            data.forEach(session => sessionsListEl.appendChild(createSessionItem(session)));
                        } else {
                            sessionsListEl.innerHTML = '<div class="empty-state">لا توجد سيشنات بعد.</div>';
                        }
                        resetSessionForm();
                        initializeSortable();
                    });
            }

            function createSessionItem(session) {
                const li = document.createElement('li');
                li.className = 'session-item';
                li.dataset.id = session.id;
                li.dataset.session = JSON.stringify(session);
                li.innerHTML = `
                    <div class="session-info" style="display: flex; align-items: center; gap: 15px;">
                        <i class="fa-solid fa-grip-vertical session-drag-handle"></i>
                        <span class="session-title">${session.title}</span>
                    </div>
                    <div class="control-buttons">
                        <button class="btn-action btn-edit btn-edit-session" style="padding: 5px 10px;"><i class="fa-solid fa-pen"></i></button>
                        <button class="btn-action btn-delete btn-delete-session" style="padding: 5px 10px;"><i class="fa-solid fa-trash"></i></button>
                    </div>
                `;
                return li;
            }

            sessionForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const sessionId = this.querySelector('#session-id').value;
                const isEditing = !!sessionId;
                const url = isEditing ? `/admin/sessions/${sessionId}` : `/admin/courses/${currentCourseIdForSessions}/sessions`;
                const formData = new FormData(this);
                if (isEditing) formData.append('_method', 'PUT');

                fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        showToast(isEditing ? 'تم التعديل بنجاح' : 'تم إضافة السيشن بنجاح');
                        loadSessions(currentCourseIdForSessions); // Reload list
                    }
                }).catch(err => console.error(err));
            });

            sessionsListEl.addEventListener('click', e => {
                const sessionItem = e.target.closest('.session-item');
                if (!sessionItem) return;
                const session = JSON.parse(sessionItem.dataset.session);

                if (e.target.closest('.btn-edit-session')) {
                    sessionForm.querySelector('#session-id').value = session.id;
                    sessionForm.querySelector('#session-title-input').value = session.title;
                    sessionForm.querySelector('#session-drive-link-input').value = session.drive_link || '';
                    document.getElementById('cancel-edit-session-btn').style.display = 'block';
                    sessionForm.querySelector('.btn-primary').innerHTML = '<i class="fa-solid fa-save"></i> حفظ التعديلات';
                }

                if (e.target.closest('.btn-delete-session')) {
                    if (confirm('هل أنت متأكد من حذف هذه السيشن؟')) {
                        fetch(`/admin/sessions/${session.id}`, {
                            method: 'DELETE',
                            headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                showToast("تم الحذف بنجاح");
                                sessionItem.remove();
                            }
                        }).catch(err => console.error(err));
                    }
                }
            });

            function resetSessionForm() {
                sessionForm.reset();
                sessionForm.querySelector('#session-id').value = '';
                document.getElementById('cancel-edit-session-btn').style.display = 'none';
                sessionForm.querySelector('.btn-primary').innerHTML = '<i class="fa-solid fa-plus"></i> إضافة سيشن';
            }

            document.getElementById('cancel-edit-session-btn').addEventListener('click', resetSessionForm);

            function initializeSortable() {
                if (sortable) sortable.destroy();
                sortable = new Sortable(sessionsListEl, {
                    animation: 150,
                    handle: '.session-drag-handle',
                    ghostClass: 'sortable-ghost',
                    onEnd: function () {
                        const order = Array.from(sessionsListEl.children).map(item => item.dataset.id);
                        fetch('{{ route("admin.sessions.reorder") }}', {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json', 'Accept': 'application/json' },
                            body: JSON.stringify({ order: order })
                        })
                        .then(res => res.json())
                        .then(data => { if (data.success) showToast("تم إعادة الترتيب بنجاح"); });
                    }
                });
            }
        });
    </script>
</body>
</html>
