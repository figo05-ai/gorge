<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>إدارة المستخدمين - لوحة التحكم</title>
    <style nonce="{{ $csp_nonce }}">
        :root {
            --bg-primary: #07090f; --bg-secondary: #0c1020; --bg-card: rgba(14, 20, 38, 0.88);
            --glass-border: rgba(255, 255, 255, 0.1); --gold: #c9963a; --gold-light: #f0c76a;
            --blue: #3b7ef5; --green: #27ae60; --red: #eb5757; --text-primary: #edf2ff;
            --text-secondary: #7a92b8; --radius-card: 22px;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Cairo', sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            background-image: radial-gradient(ellipse 40% 55% at 55% 50%, rgba(14, 20, 38, 0.6) 0%, transparent 80%);
        }
        .navbar {
            height: 70px; display: flex; align-items: center; justify-content: space-between; padding: 0 40px;
            background: rgba(7, 9, 15, 0.75);
            border-bottom: 1px solid var(--glass-border);
            position: sticky; top: 0; z-index: 100;
        }
        .navbar-title {
            font-size: 20px; font-weight: 700;
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .admin-container {
            max-width: 1200px; margin: 40px auto; padding: 0 20px;
        }
        .admin-card {
            background: var(--bg-card); border: 1px solid var(--glass-border);
            border-radius: var(--radius-card); padding: 30px; margin-bottom: 30px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.3);
        }
        .admin-card h2 {
            margin-bottom: 24px; font-size: 22px; color: var(--gold-light);
            display: flex; align-items: center; gap: 10px;
        }
        .btn-outline {
            display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px;
            background: transparent; color: var(--gold-light); border: 1px solid var(--gold-light);
            border-radius: 12px; text-decoration: none; font-weight: 700; font-size: 14px;
            transition: all 0.3s ease; font-family: 'Cairo'; cursor: pointer;
        }
        .btn-outline:hover { background: rgba(201, 150, 58, 0.1); transform: translateY(-2px); }

        /* Search Form Styles */
        .search-form { display: flex; gap: 10px; margin-bottom: 25px; }
        .search-input {
            flex-grow: 1; padding: 12px 18px; background: rgba(0,0,0,0.4);
            border: 1px solid var(--glass-border); border-radius: 12px;
            color: var(--text-primary); font-family: 'Cairo', sans-serif; font-size: 15px; transition: all 0.3s;
        }
        .search-input:focus { outline: none; border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201, 150, 58, 0.15); }
        .search-btn {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            padding: 0 28px; background: linear-gradient(135deg, var(--gold-light), var(--gold));
            color: #07090f; border: none; border-radius: 12px; font-weight: 800; font-size: 16px;
            cursor: pointer; transition: all 0.3s ease; font-family: 'Cairo';
        }
        .search-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(201, 150, 58, 0.3); }

        .course-count-badge {
            background: var(--blue-pale, rgba(59, 126, 245, 0.12));
            color: var(--blue, #3b7ef5);
            padding: 4px 10px; border-radius: 8px; font-weight: 700; font-size: 13px;
        }

        /* Table Styles */
        .table-wrapper { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 16px; text-align: right; border-bottom: 1px solid var(--glass-border); font-size: 15px; white-space: nowrap; }
        th { color: var(--text-secondary); font-weight: 700; }
        td { color: var(--text-primary); }
        .user-info { display: flex; align-items: center; gap: 12px; }
        .user-avatar { width: 40px; height: 40px; border-radius: 50%; background: var(--bg-secondary); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 16px; color: var(--gold-light); }
        .user-name { font-weight: 600; }
        .user-email { font-size: 13px; color: var(--text-secondary); }
        .control-buttons { display: flex; gap: 8px; }
        .btn-action {
            padding: 6px 12px; border-radius: 8px; border: 1px solid transparent;
            font-family: 'Cairo'; font-weight: 600; font-size: 13px; cursor: pointer;
            transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 5px;
        }
        .btn-edit { background: rgba(59, 126, 245, 0.1); color: var(--blue); border-color: rgba(59, 126, 245, 0.3); }
        .btn-edit:hover { background: var(--blue); color: #fff; }
        .btn-courses { background: rgba(155, 89, 182, 0.1); color: #9b59b6; border-color: rgba(155, 89, 182, 0.3); }
        .btn-courses:hover { background: #9b59b6; color: #fff; }
        .btn-delete { background: rgba(235, 87, 87, 0.1); color: var(--red); border-color: rgba(235, 87, 87, 0.3); }
        .btn-delete:hover { background: var(--red); color: #fff; }
        .btn-status { background: rgba(39, 174, 96, 0.1); color: var(--green); border-color: rgba(39, 174, 96, 0.3); }
        .btn-status.inactive { background: rgba(122, 146, 184, 0.1); color: var(--text-secondary); border-color: rgba(122, 146, 184, 0.3); }
        .btn-status:hover { background: var(--green); color: #fff; }
        .btn-status.inactive:hover { background: var(--text-secondary); color: var(--bg-primary); }
        .empty-state { text-align: center; padding: 40px; color: var(--text-secondary); font-weight: 600; }

        /* Pagination Styles */
        .pagination { display: flex; justify-content: center; margin-top: 30px; }
        .pagination li { list-style: none; margin: 0 4px; }
        .pagination li a, .pagination li span {
            display: block; padding: 8px 14px; border-radius: 8px; text-decoration: none;
            background: var(--bg-secondary); color: var(--text-secondary); border: 1px solid var(--glass-border);
            font-weight: 700; font-size: 14px; transition: all 0.3s ease;
        }
        .pagination li a:hover { background: var(--gold-pale); color: var(--gold-light); border-color: var(--gold); }
        .pagination li.active span { background: var(--gold); color: var(--bg-primary); border-color: var(--gold); }
        .pagination li.disabled span { opacity: 0.5; cursor: not-allowed; }

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
            border-radius: var(--radius-card); width: 100%; max-width: 800px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.5);
            transform: scale(0.95); transition: all 0.3s ease;
        }
        .modal-overlay.show .modal-content { transform: scale(1); }
        .modal-header {
            padding: 20px 30px; border-bottom: 1px solid var(--glass-border);
            display: flex; justify-content: space-between; align-items: center;
        }
        .modal-header h3 { font-size: 18px; color: var(--gold-light); }
        .modal-header h3 span { color: var(--text-primary); font-weight: 600; }
        .close-modal { background: none; border: none; color: var(--text-secondary); font-size: 28px; cursor: pointer; }
        .modal-body { display: flex; gap: 20px; padding: 30px; }
        .courses-panel { flex: 1; background: var(--bg-primary); padding: 20px; border-radius: 12px; border: 1px solid var(--glass-border); }
        .courses-panel h4 { margin-bottom: 15px; color: var(--text-secondary); font-size: 15px; }
        .courses-panel ul { list-style: none; height: 300px; overflow-y: auto; }
        .courses-panel li {
            padding: 12px; background: var(--bg-secondary); border-radius: 8px;
            margin-bottom: 8px; cursor: pointer; transition: background 0.2s;
            display: flex; justify-content: space-between; align-items: center;
        }
        .courses-panel li:hover { background: rgba(255,255,255,0.05); }
        .courses-panel .delete-course { color: var(--red); font-size: 16px; }
        .courses-panel .delete-course:hover { transform: scale(1.2); }
        .modal-footer {
            padding: 20px 30px; border-top: 1px solid var(--glass-border);
            display: flex; justify-content: flex-end; gap: 12px;
        }
        .btn-secondary {
            padding: 10px 25px; background: var(--bg-card); color: var(--text-secondary);
            border: 1px solid var(--glass-border); border-radius: 10px; font-weight: 700;
            cursor: pointer; transition: all 0.3s;
        }
        .btn-secondary:hover { background: var(--bg-primary); color: var(--text-primary); }
        .btn-primary-modal {
            padding: 10px 25px; background: linear-gradient(135deg, var(--gold-light), var(--gold));
            color: #07090f; border: none; border-radius: 10px; font-weight: 800;
            cursor: pointer; transition: all 0.3s;
        }
        .btn-primary-modal:hover { transform: translateY(-2px); box-shadow: 0 4px 15px rgba(201, 150, 58, 0.3); }

        /* Toast Notification */
        .toast {
            position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%) translateY(20px);
            background: var(--gold-light); color: #000; padding: 12px 30px; border-radius: 50px;
            font-weight: 700; opacity: 0; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: 2000; box-shadow: 0 5px 20px rgba(201,150,58,0.4); pointer-events: none;
        }
        .toast.show { opacity: 1; transform: translateX(-50%) translateY(0); }

        /* SweetAlert Custom Styles */
        .swal2-popup {
            background: var(--bg-secondary) !important;
            color: var(--text-primary) !important;
            border-radius: var(--radius-card) !important;
            border: 1px solid var(--glass-border) !important;
        }
        .swal2-title { color: var(--text-primary) !important; }
        .swal2-html-container { color: var(--text-secondary) !important; }
        .swal2-confirm {
            background: linear-gradient(135deg, var(--gold-light), var(--gold)) !important;
            color: #07090f !important;
            font-weight: 800 !important;
        }
        .swal2-cancel { background-color: var(--bg-card) !important; color: var(--text-secondary) !important; }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-title"><i class="fa-solid fa-users"></i> إدارة المستخدمين</div>
        <div style="display: flex; gap: 12px;">
            <a href="{{ url('/admin') }}" class="btn-outline"><i class="fa-solid fa-arrow-left"></i> العودة</a>
        </div>
    </nav>

    <div class="admin-container">
        <div class="admin-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h2 style="margin-bottom: 0;"><i class="fa-solid fa-table-list"></i> قائمة المستخدمين</h2>
            </div>

            <form action="{{ route('admin.users.index') }}" method="GET" class="search-form">
                <input type="text" name="search" class="search-input" placeholder="ابحث بالاسم أو البريد الإلكتروني..." value="{{ request('search') }}">
                <button type="submit" class="search-btn"><i class="fa-solid fa-search"></i> بحث</button>
            </form>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>الطالب</th>
                            <th>البريد الإلكتروني</th>
                            <th>الكورسات</th>
                            <th>تاريخ التسجيل</th>
                            <th>الحالة</th>
                            <th>تحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar">{{ mb_substr($user->name, 0, 1) }}</div>
                                        <span class="user-name">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="course-count-badge">{{ $user->courses->count() }} كورسات</span>
                                </td>
                                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <button class="btn-action btn-status {{ $user->is_active ? '' : 'inactive' }} btn-toggle-status" data-user-id="{{ $user->id }}">
                                        @if ($user->is_active)
                                            <i class="fa-solid fa-check-circle"></i> <span>نشط</span>
                                        @else
                                            <i class="fa-solid fa-times-circle"></i> <span>غير نشط</span>
                                        @endif
                                    </button>
                                </td>
                                <td>
                                    <div class="control-buttons">
                                        <button class="btn-action btn-edit btn-edit-user"
                                                data-user-id="{{ $user->id }}"
                                                data-user-name="{{ $user->name }}"
                                                data-user-email="{{ $user->email }}">
                                            <i class="fa-solid fa-pen"></i> تعديل
                                        </button>
                                        <button class="btn-action btn-delete btn-delete-user" data-user-id="{{ $user->id }}"><i class="fa-solid fa-trash"></i> حذف</button>
                                        <button class="btn-action btn-courses"
                                                data-user-id="{{ $user->id }}"
                                                data-user-name="{{ $user->name }}"
                                                data-user-courses="{{ json_encode($user->courses->pluck('id')) }}">
                                            <i class="fa-solid fa-graduation-cap"></i> الكورسات
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="fa-solid fa-users-slash fa-2x" style="margin-bottom: 10px;"></i>
                                        <p>لا يوجد مستخدمين لعرضهم حالياً.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination Links --}}
            <div class="pagination">
                {{ $users->appends(request()->query())->links() }}
            </div>

        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="edit-user-modal" class="modal-overlay">
        <div class="modal-content" style="max-width: 500px;">
            <form id="edit-user-form">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h3>تعديل بيانات المستخدم</h3>
                    <button type="button" class="close-modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body" style="flex-direction: column; gap: 15px;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label for="edit-name">الاسم</label>
                        <input type="text" id="edit-name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label for="edit-email">البريد الإلكتروني</label>
                        <input type="email" id="edit-email" name="email" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary close-modal">إلغاء</button>
                    <button type="submit" class="btn-primary-modal">حفظ التغييرات</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Courses Modal -->
    <div id="courses-modal" class="modal-overlay">
        <div class="modal-content">
            <form id="courses-form">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h3>إدارة كورسات: <span id="modal-user-name"></span></h3>
                    <button type="button" class="close-modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="courses-panel">
                        <h4>الكورسات المتاحة</h4>
                        <ul id="available-courses-list">
                            {{-- Populated by JS --}}
                        </ul>
                    </div>
                    <div class="courses-panel">
                        <h4>الكورسات المشترك بها</h4>
                        <ul id="enrolled-courses-list">
                            {{-- Populated by JS --}}
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="cancel-courses-btn" class="btn-secondary">إلغاء</button>
                    <button type="submit" id="save-courses-btn" class="btn-primary-modal">حفظ التغييرات</button>
                </div>
            </form>
        </div>
    </div>

    <div id="toast-notification" class="toast"></div>

<script nonce="{{ $csp_nonce }}">
document.addEventListener('DOMContentLoaded', function () {
    const allCourses = @json($allCourses);
    const modal = document.getElementById('courses-modal');
    const modalUserName = document.getElementById('modal-user-name');
    const availableList = document.getElementById('available-courses-list');
    const enrolledList = document.getElementById('enrolled-courses-list');
    const editUserModal = document.getElementById('edit-user-modal');
    const editUserForm = document.getElementById('edit-user-form');
    const coursesForm = document.getElementById('courses-form');
    let currentUserId = null;

    // Toast Notification Function
    const toast = document.getElementById('toast-notification');
    function showToast(message) {
        toast.textContent = message;
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 3000);
    }
    document.body.addEventListener('click', function(e) {
        // Open modal
        if (e.target.closest('.btn-courses')) {
            const button = e.target.closest('.btn-courses');
            currentUserId = button.dataset.userId;
            const userName = button.dataset.userName;
            const userCourses = JSON.parse(button.dataset.userCourses);

            modalUserName.textContent = userName;
            coursesForm.action = `/admin/users/${currentUserId}/courses`;

            populateLists(userCourses);
            modal.classList.add('show');
        }

        // Open Edit User Modal
        if (e.target.closest('.btn-edit-user')) {
            const button = e.target.closest('.btn-edit-user');
            const userId = button.dataset.userId;
            const userName = button.dataset.userName;
            const userEmail = button.dataset.userEmail;

            editUserForm.action = `/admin/users/${userId}`;
            editUserForm.querySelector('#edit-name').value = userName;
            editUserForm.querySelector('#edit-email').value = userEmail;

            editUserModal.classList.add('show');
        }

        // Close modal
        if (e.target.classList.contains('close-modal') || e.target.id === 'cancel-courses-btn') {
            e.preventDefault();
            modal.classList.remove('show');
            editUserModal.classList.remove('show');
        } else if (e.target.classList.contains('modal-overlay') && !e.target.closest('.modal-content')) {
            modal.classList.remove('show');
        }

        // Move course to enrolled
        if (e.target.closest('#available-courses-list li')) {
            const li = e.target.closest('li');
            enrolledList.appendChild(li);
            // Append icon in a more robust way
            const icon = document.createElement('i');
            icon.className = 'fa-solid fa-trash-can delete-course';
            li.appendChild(document.createTextNode(' '));
            li.appendChild(icon);
        }

        // Move course back to available
        if (e.target.classList.contains('delete-course')) {
            const li = e.target.closest('li');
            const icon = e.target;
            const space = icon.previousSibling;
            if (space && space.nodeType === Node.TEXT_NODE) space.remove();
            icon.remove(); // remove the trash icon
            availableList.appendChild(li);
        }

        // Toggle User Status
        if (e.target.closest('.btn-toggle-status')) {
            const button = e.target.closest('.btn-toggle-status');
            const userId = button.dataset.userId;

            fetch(`/admin/users/${userId}/toggle-status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const icon = button.querySelector('i');
                    const text = button.querySelector('span');
                    if (data.is_active) {
                        button.classList.remove('inactive');
                        icon.className = 'fa-solid fa-check-circle';
                        text.textContent = 'نشط';
                    } else {
                        button.classList.add('inactive');
                        icon.className = 'fa-solid fa-times-circle';
                        text.textContent = 'غير نشط';
                    }
                    showToast(data.success);
                }
            })
            .catch(err => console.error(err));
        }

        // Delete User
        if (e.target.closest('.btn-delete-user')) {
            const button = e.target.closest('.btn-delete-user');
            const userId = button.dataset.userId;

            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لا يمكن التراجع عن حذف هذا المستخدم!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'نعم، احذفه!',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/users/${userId}`, {
                        method: 'DELETE',
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json'}
                    })
                    .then(res => res.json().then(data => ({ status: res.status, body: data })))
                    .then(({ status, body }) => {
                        showToast(body.success || body.error || 'حدث خطأ ما.');
                        if (status === 200 && body.success) {
                            button.closest('tr').remove();
                        }
                    }).catch(err => console.error(err));
                }
            });
        }
    });

    function populateLists(userCourseIds) {
        availableList.innerHTML = '';
        enrolledList.innerHTML = '';

        allCourses.forEach(course => {
            const li = document.createElement('li');
            li.dataset.courseId = course.id;

            if (userCourseIds.includes(course.id)) {
                // Build the element with text and icon safely
                li.textContent = course.title;
                li.innerHTML += ' <i class="fa-solid fa-trash-can delete-course"></i>';
                enrolledList.appendChild(li);
            } else {
                li.textContent = course.title;
                availableList.appendChild(li);
            }
        });
    }

    coursesForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const enrolledIds = Array.from(enrolledList.querySelectorAll('li')).map(li => li.dataset.courseId);

        const formData = new FormData(coursesForm);
        // Clear old course_ids and append new ones
        formData.delete('course_ids[]');
        enrolledIds.forEach(id => formData.append('course_ids[]', id));

        fetch(coursesForm.action, { method: 'POST', body: formData, headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'} })
            .then(res => res.json())
            .then(data => {
                showToast(data.success || 'حدث خطأ ما.');
                if(data.success) setTimeout(() => window.location.reload(), 1500);
            })
            .catch(err => console.error(err));
    });

    editUserForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const action = this.action;

        fetch(action, {
            method: 'POST', // Using POST because of @method('PUT')
            body: formData,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                showToast(data.success);
                editUserModal.classList.remove('show');
                const userId = action.split('/').pop();
                const row = document.querySelector(`.btn-edit-user[data-user-id="${userId}"]`).closest('tr');
                if (row) {
                    row.querySelector('.user-name').textContent = data.user.name;
                    row.querySelector('.user-email').textContent = data.user.email;
                    const editBtn = row.querySelector('.btn-edit-user');
                    editBtn.dataset.userName = data.user.name;
                    editBtn.dataset.userEmail = data.user.email;
                }
            } else {
                let errorMessage = data.message || 'حدث خطأ ما.';
                if (data.errors) {
                    errorMessage = Object.values(data.errors).join('\n');
                }
                Swal.fire('خطأ في الإدخال', errorMessage, 'error');
            }
        })
        .catch(err => console.error(err));
    });
});
</script>
</body>
</html>
