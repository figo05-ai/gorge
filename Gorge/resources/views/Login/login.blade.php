<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>تسجيل الدخول - لوحة الإدارة</title>
    <style nonce="{{ $csp_nonce }}">
        :root {
            --bg-primary: #07090f; --bg-card: rgba(14, 20, 38, 0.88);
            --glass-border: rgba(255, 255, 255, 0.07); --gold: #c9963a;
            --gold-light: #f0c76a; --text-primary: #edf2ff; --text-secondary: #7a92b8;
        }
        body {
            font-family: 'Cairo', sans-serif; background-color: var(--bg-primary);
            color: var(--text-primary); min-height: 100vh; display: flex;
            align-items: center; justify-content: center; margin: 0;
            background-image: radial-gradient(ellipse 40% 55% at 55% 50%, rgba(14, 20, 38, 0.6) 0%, transparent 80%);
        }
        .login-card {
            background: var(--bg-card); border: 1px solid var(--glass-border);
            border-radius: 22px; padding: 40px; width: 100%; max-width: 450px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.3);
        }
        .login-card h2 { text-align: center; color: var(--gold-light); margin-bottom: 30px; font-size: 24px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: var(--text-secondary); font-size: 14px; }
        .form-control {
            width: 100%; padding: 14px 18px; background: rgba(0,0,0,0.4);
            border: 1px solid var(--glass-border); border-radius: 12px;
            color: var(--text-primary); font-family: 'Cairo'; font-size: 15px; transition: 0.3s; box-sizing: border-box;
        }
        .form-control:focus { outline: none; border-color: var(--gold); }
        .btn-primary {
            width: 100%; padding: 14px; background: linear-gradient(135deg, var(--gold-light), var(--gold));
            color: #07090f; border: none; border-radius: 12px; font-weight: 800;
            font-size: 16px; cursor: pointer; transition: 0.3s; font-family: 'Cairo'; margin-top: 10px;
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(201, 150, 58, 0.3); }
        .error-message { color: #eb5757; font-size: 13.5px; font-weight: 600; margin-top: 8px; display: block; text-align: center; }
    </style>
</head>
<body>

    <div class="login-card">
        <h2><i class="fa-solid fa-lock"></i> تسجيل الدخول</h2>

        <form action="{{ route('login') }}" method="POST">
            @csrf <!-- حماية لارافيل الإجبارية للنماذج -->

            <div class="form-group">
                <label for="email">البريد الإلكتروني:</label>
                <!-- بنحتفظ بالإيميل المكتوب لو حصل خطأ عن طريق الدالة old() -->
                <input type="email" id="email" name="email" class="form-control" placeholder="admin@example.com" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">كلمة المرور:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>

            <!-- عرض رسالة الخطأ لو الباسورد أو الإيميل غلط -->
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror

            <button type="submit" class="btn-primary">
                <i class="fa-solid fa-arrow-right-to-bracket"></i> دخول
            </button>
        </form>

        <div class="switch-page" style="text-align: center; margin-top: 20px; font-size: 14px; color: var(--text-secondary);">
            ليس لديك حساب؟ <a href="{{ route('register') }}" style="color: var(--gold-light); text-decoration: none; font-weight: 700;">إنشاء حساب جديد</a>
        </div>
    </div>

</body>
</html>
