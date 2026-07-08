<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>أعمال متدربين أكاديمية مكتب فني</title>
    <style nonce="{{ $csp_nonce }}">
        /* ============================================================
           CSS CUSTOM PROPERTIES
        ============================================================ */
        :root {
            --bg-primary: #07090f;
            --bg-secondary: #0c1020;
            --bg-card: rgba(14, 20, 38, 0.88);
            --glass-bg: rgba(255, 255, 255, 0.035);
            --glass-border: rgba(255, 255, 255, 0.07);
            --gold: #c9963a;
            --gold-light: #f0c76a;
            --gold-pale: rgba(201, 150, 58, 0.12);
            --blue: #3b7ef5;
            --blue-pale: rgba(59, 126, 245, 0.12);
            --text-primary: #edf2ff;
            --text-secondary: #7a92b8;
            --text-muted: #3a4a68;
            --radius-card: 22px;
            --radius-lg: 28px;
            --offset: 230px;
            --ease-smooth: cubic-bezier(0.23, 1, 0.32, 1);
        }

        /* ============================================================
           RESET + BASE
        ============================================================ */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* ============================================================
           ANIMATED BACKGROUND MESH
        ============================================================ */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            background:
                radial-gradient(ellipse 70% 55% at 15% 8%, rgba(201, 150, 58, 0.09) 0%, transparent 65%),
                radial-gradient(ellipse 55% 45% at 85% 85%, rgba(59, 126, 245, 0.08) 0%, transparent 65%),
                radial-gradient(ellipse 40% 55% at 55% 50%, rgba(14, 20, 38, 0.6) 0%, transparent 80%);
        }

        body::after {
            content: '';
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            opacity: 0.025;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='1'/%3E%3C/svg%3E");
            background-size: 200px 200px;
        }

        body>* {
            position: relative;
            z-index: 1;
        }

        /* ============================================================
           NAVBAR
        ============================================================ */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 200;
            height: 110px;
            padding: 0 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(7, 9, 15, 0.75);
            backdrop-filter: blur(24px) saturate(160%);
            -webkit-backdrop-filter: blur(24px) saturate(160%);
            border-bottom: 1px solid var(--glass-border);
        }

        .navbar-inner {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .navbar-emblem {
            width: 60px;
            height: 38px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            font-weight: 900;
            color: #07090f;
            flex-shrink: 0;
            box-shadow: 0 2px 16px rgba(201, 150, 58, 0.35);
        }

        .navbar-enroll {
            /* التوسيط المطلق في منتصف الـ Navbar */
            position: absolute;
            left: 50%;
            transform: translateX(-50%);

            /* باقي التنسيقات بتاعتك زي ما هي */
            width: 90px;
            height: 50px;
            border-radius: 102px;
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            font-weight: 900;
            color: #07090f;
            flex-shrink: 0;
            box-shadow: 0 2px 16px rgba(201, 150, 58, 0.35);
            text-decoration: none;
            /* عشان لو هو تاج <a> ميبقاش تحته خط */
        }

        .navbar-title {
            font-size: 19px;
            font-weight: 700;
            background: linear-gradient(135deg, var(--gold-light) 0%, var(--gold) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: 0.3px;
        }

        .navbar-logo {
            height: 100px;
            width: auto;
            object-fit: contain;
            filter: drop-shadow(0 2px 8px rgba(255, 255, 255, 0.15));
        }

        /* ============================================================
           SECTION HEADERS
        ============================================================ */
        .section-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 64px 24px 12px;
        }

        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--gold-pale);
            border: 1px solid rgba(201, 150, 58, 0.28);
            border-radius: 100px;
            padding: 6px 20px;
            font-size: 12.5px;
            font-weight: 700;
            color: var(--gold-light);
            margin-bottom: 18px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .badge-dot {
            width: 6px;
            height: 6px;
            background: var(--gold);
            border-radius: 50%;
            flex-shrink: 0;
            animation: pulseDot 2.2s ease-in-out infinite;
        }

        @keyframes pulseDot {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.4;
                transform: scale(0.65);
            }
        }

        .master-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 28px;
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            color: #07090f;
            font-size: 15px;
            font-weight: 800;
            border-radius: 100px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(201, 150, 58, 0.2);
        }

        .master-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(201, 150, 58, 0.4);
        }

        .section-title {
            font-size: clamp(26px, 5vw, 46px);
            font-weight: 900;
            color: var(--text-primary);
            line-height: 1.25;
            margin-bottom: 18px;
        }

        .section-title .highlight {
            background: linear-gradient(125deg, var(--gold-light) 0%, var(--gold) 60%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-rule {
            width: 56px;
            height: 3px;
            border-radius: 3px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        /* ============================================================
           CAROUSEL
        ============================================================ */
        .carousel-wrapper {
            padding: 20px 0 8px;
        }

        .carousel-container {
            position: relative;
            height: 420px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            cursor: grab;
            user-select: none;
            -webkit-user-select: none;
        }

        .carousel-card {
            position: absolute;
            width: 340px;
            background: var(--bg-card);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius-lg);
            padding: 14px 14px 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: all 0.52s var(--ease-smooth);
            cursor: pointer;
            transform: scale(0.55);
            opacity: 0;
            filter: blur(8px);
            z-index: 1;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.45), inset 0 1px 0 rgba(255, 255, 255, 0.05);
            overflow: hidden;
        }

        .carousel-card::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background: linear-gradient(120deg, transparent 25%, rgba(255, 255, 255, var(--glare-opacity, 0)) var(--glare-pos, 50%), transparent 75%);
            pointer-events: none;
            z-index: 10;
        }

        .carousel-card.active {
            transform: scale(1.05);
            opacity: 1;
            filter: blur(0);
            z-index: 3;
            border-color: rgba(201, 150, 58, 0.35);
            box-shadow: 0 0 0 1px rgba(201, 150, 58, 0.18), 0 24px 64px rgba(0, 0, 0, 0.55), 0 0 50px rgba(201, 150, 58, 0.10);
        }

        .carousel-card.active::after {
            content: '';
            position: absolute;
            top: 0;
            left: 12%;
            right: 12%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold-light), transparent);
            border-radius: 0 0 2px 2px;
            pointer-events: none;
        }

        .carousel-card.prev {
            transform: translateX(calc(-1 * var(--offset))) scale(0.78);
            opacity: 0.45;
            filter: blur(3.5px);
            z-index: 2;
        }

        .carousel-card.next {
            transform: translateX(var(--offset)) scale(0.78);
            opacity: 0.45;
            filter: blur(3.5px);
            z-index: 2;
        }

        .carousel-container.dragging .carousel-card {
            transition: none;
        }

        .carousel-img-link {
            display: block;
            width: 100%;
            border-radius: 16px;
            overflow: hidden;
        }

        .carousel-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
            border-radius: 16px;
            transition: transform 0.5s var(--ease-smooth);
        }

        .carousel-card.active .carousel-img {
            transform: scale(1.02);
        }

        .carousel-card-footer {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 14px;
            padding: 0 4px;
        }

        .carousel-label {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-muted);
            letter-spacing: 0.4px;
            transition: color 0.35s ease;
        }

        .carousel-card.active .carousel-label {
            color: var(--gold-light);
        }

        .facebook-logo {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 100px;
            background: rgba(24, 119, 242, 0.1);
            border: 1px solid rgba(24, 119, 242, 0.25);
            color: #e8f0fe;
            font-size: 12.5px;
            font-weight: 700;
            text-decoration: none;
            opacity: 0;
            transform: translateY(8px);
            transition: opacity 0.4s var(--ease-smooth), transform 0.4s var(--ease-smooth), background 0.3s ease, border-color 0.3s ease;
        }

        .facebook-logo i {
            font-size: 14px;
            color: #5b9cf6;
        }

        .carousel-card.active .facebook-logo {
            opacity: 1;
            transform: translateY(0);
        }

        .facebook-logo:hover {
            background: rgba(24, 119, 242, 0.22);
            border-color: rgba(24, 119, 242, 0.5);
        }

        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 1px solid var(--glass-border);
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            color: var(--gold-light);
            font-size: 16px;
            cursor: pointer;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s var(--ease-smooth);
        }

        .carousel-btn:hover {
            background: var(--gold-pale);
            border-color: rgba(201, 150, 58, 0.45);
            box-shadow: 0 0 22px rgba(201, 150, 58, 0.22);
            transform: translateY(-50%) scale(1.1);
        }

        .carousel-btn:active {
            transform: translateY(-50%) scale(0.93);
        }

        .carousel-btn--prev {
            left: 18px;
        }

        .carousel-btn--next {
            right: 18px;
        }

        .carousel-dots {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            padding: 22px 0 12px;
        }

        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--text-muted);
            cursor: pointer;
            transition: all 0.38s var(--ease-smooth);
            flex-shrink: 0;
        }

        .dot:hover {
            background: var(--text-secondary);
            transform: scale(1.25);
        }

        .dot.active {
            width: 30px;
            border-radius: 4px;
            background: var(--gold);
            box-shadow: 0 0 12px rgba(201, 150, 58, 0.55);
        }

        /* ============================================================
           SOFTWARE GRID
        ============================================================ */
        .boxes-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 24px;
            padding: 16px 32px 90px;
            opacity: 0;
            transform: translateY(44px);
            transition: opacity 0.85s ease-out, transform 0.85s ease-out;
        }

        .boxes-section.show {
            opacity: 1;
            transform: translateY(0);
        }

        .boxes-row {
            display: flex;
            justify-content: center;
            gap: 24px;
            flex-wrap: wrap;
            width: 100%;
            max-width: 1060px;
        }

        .box-link {
            text-decoration: none;
            color: inherit;
            display: block;
            outline: none;
        }

        .box-item {
            position: relative;
            width: 300px;
            height: 220px;
            border-radius: var(--radius-card);
            overflow: hidden;
            cursor: pointer;
            background: var(--bg-card);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            transition: transform 0.45s var(--ease-smooth), box-shadow 0.45s var(--ease-smooth), border-color 0.45s ease;
            box-shadow: 0 4px 28px rgba(0, 0, 0, 0.35);
            isolation: isolate;
        }

        @property --spin-angle {
            syntax: '<angle>';
            initial-value: 0deg;
            inherits: false;
        }

        @keyframes borderSpin {
            to {
                --spin-angle: 360deg;
            }
        }

        .box-item::before {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: calc(var(--radius-card) + 2px);
            background: conic-gradient(from var(--spin-angle), transparent 0deg, var(--gold) 60deg, var(--blue) 130deg, transparent 200deg);
            z-index: -1;
            opacity: 0;
            transition: opacity 0.38s ease;
        }

        .box-item:hover::before {
            opacity: 1;
            animation: borderSpin 3.2s linear infinite;
        }

        .box-item::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--gold), var(--blue), transparent);
            transform: scaleX(0);
            transform-origin: center;
            transition: transform 0.42s var(--ease-smooth);
            z-index: 4;
        }

        .box-item:hover::after {
            transform: scaleX(1);
        }

        .box-item:hover {
            transform: translateY(-13px);
            border-color: rgba(201, 150, 58, 0.22);
            box-shadow: 0 24px 56px rgba(0, 0, 0, 0.55), 0 0 32px rgba(201, 150, 58, 0.08);
        }

        .box-icon-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 158px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.35);
            padding: 18px;
            overflow: hidden;
        }

        .box-icon {
            max-width: 100%;
            max-height: 116px;
            object-fit: contain;
            transition: transform 0.5s var(--ease-smooth), filter 0.4s ease;
            filter: drop-shadow(0 4px 14px rgba(0, 0, 0, 0.4));
        }

        .box-item:hover .box-icon {
            transform: scale(1.1) translateY(-5px);
            filter: drop-shadow(0 8px 18px rgba(0, 0, 0, 0.5));
        }

        .box-divider {
            position: absolute;
            top: 158px;
            left: 0;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--glass-border), transparent);
            z-index: 2;
            transition: background 0.3s ease;
        }

        .box-item:hover .box-divider {
            background: linear-gradient(90deg, transparent, rgba(201, 150, 58, 0.3), transparent);
        }

        .box-item h2 {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 62px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 0 16px;
            font-size: 14.5px;
            font-weight: 700;
            color: var(--text-secondary);
            text-align: center;
            z-index: 3;
            letter-spacing: 0.3px;
            transition: color 0.35s ease;
        }

        .box-item:hover h2 {
            color: var(--gold-light);
        }

        /* ============================================================
           CONTACT SECTION
        ============================================================ */
        .contact-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 16px;
            padding: 10px 32px 80px;
            max-width: 1000px;
            margin: 0 auto;
            opacity: 0;
            transform: translateY(44px);
            transition: opacity 0.85s ease-out, transform 0.85s ease-out;
        }

        .contact-section.show {
            opacity: 1;
            transform: translateY(0);
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 24px 10px 14px;
            background: var(--bg-card);
            border: 1px solid var(--glass-border);
            border-radius: 100px;
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 700;
            font-size: 14.5px;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            transition: all 0.4s var(--ease-smooth);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            opacity: 0;
            transform: translateY(20px) scale(0.95);
        }

        .contact-section.show .contact-item {
            animation: riseIn 0.65s var(--ease-smooth) forwards;
        }

        .contact-section.show .contact-item:nth-child(1) {
            animation-delay: 0.0s;
        }

        .contact-section.show .contact-item:nth-child(2) {
            animation-delay: 0.1s;
        }

        .contact-section.show .contact-item:nth-child(3) {
            animation-delay: 0.2s;
        }

        .contact-section.show .contact-item:nth-child(4) {
            animation-delay: 0.3s;
        }

        .contact-section.show .contact-item:nth-child(5) {
            animation-delay: 0.4s;
        }

        .contact-section.show .contact-item:nth-child(6) {
            animation-delay: 0.5s;
        }

        .contact-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            transition: all 0.4s var(--ease-smooth);
        }

        .contact-item:hover {
            transform: translateY(-5px) scale(1.03);
        }

        .contact-item:hover .contact-icon {
            transform: scale(1.1) rotate(10deg);
        }

        .contact-item.email:hover {
            border-color: var(--gold-light);
            box-shadow: 0 8px 25px rgba(240, 199, 106, 0.15);
            color: var(--gold-light);
        }

        .contact-item.email:hover .contact-icon {
            background: var(--gold-light);
            color: #07090f;
            border-color: var(--gold-light);
        }

        .contact-item.phone:hover {
            border-color: var(--blue);
            box-shadow: 0 8px 25px rgba(59, 126, 245, 0.15);
            color: #82aaff;
        }

        .contact-item.phone:hover .contact-icon {
            background: var(--blue);
            color: #fff;
            border-color: var(--blue);
        }

        .contact-item.youtube:hover {
            border-color: #FF0000;
            box-shadow: 0 8px 25px rgba(255, 0, 0, 0.15);
            color: #FF4444;
        }

        .contact-item.youtube:hover .contact-icon {
            background: #FF0000;
            color: #fff;
            border-color: #FF0000;
        }

        .contact-item.tiktok:hover {
            border-color: #00f2fe;
            box-shadow: 0 8px 25px rgba(0, 242, 254, 0.15);
            color: #00f2fe;
        }

        .contact-item.tiktok:hover .contact-icon {
            background: #07090f;
            color: #fff;
            border-color: #fe0051;
            box-shadow: inset 0 0 5px #00f2fe;
        }

        .contact-item.instagram:hover {
            border-color: #E1306C;
            box-shadow: 0 8px 25px rgba(225, 48, 108, 0.15);
            color: #E1306C;
        }

        .contact-item.instagram:hover .contact-icon {
            background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
            color: #fff;
            border-color: transparent;
        }

        /* ============================================================
           FLOATING WHATSAPP
        ============================================================ */
        .floating-whatsapp {
            position: fixed;
            bottom: 45px;
            right: 30px;
            width: 60px;
            height: 60px;
            background-color: #25D366;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4);
            z-index: 9999;
            text-decoration: none;
            opacity: 0;
            visibility: hidden;
            transform: translateX(100px);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .floating-whatsapp::after {
            content: "احجز الآن";
            position: absolute;
            bottom: -34px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--bg-card);
            color: var(--text-primary);
            font-size: 13.5px;
            font-weight: 700;
            font-family: 'Cairo', sans-serif;
            padding: 4px 14px;
            border-radius: 100px;
            border: 1px solid var(--glass-border);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.25);
            pointer-events: none;
            white-space: nowrap;
            transition: all 0.3s ease;
        }

        .floating-whatsapp.show {
            transform: translateX(0);
            opacity: 1;
            visibility: visible;
        }

        .floating-whatsapp:hover {
            background-color: #20b858;
            transform: translateX(0) scale(1.1);
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.6);
        }

        .floating-whatsapp:hover::after {
            color: var(--gold-light);
            border-color: rgba(201, 150, 58, 0.4);
        }

        /* ============================================================
           FOOTER & RESPONSIVE
        ============================================================ */
        .page-footer {
            text-align: center;
            padding: 28px 20px;
            border-top: 1px solid var(--glass-border);
            color: var(--text-muted);
            font-size: 13px;
            font-weight: 500;
        }

        @media (max-width: 900px) {
            :root {
                --offset: 185px;
            }
        }

        @media (max-width: 680px) {
            :root {
                --offset: 150px;
            }

            .navbar {
                padding: 0 18px;
                height: 90px;
            }

            .navbar-title {
                font-size: 16px;
            }

            .navbar-logo {
                height: 80px;
            }

            .section-header {
                padding: 48px 20px 10px;
            }

            .carousel-container {
                height: 380px;
            }

            .carousel-card {
                width: 290px;
            }

            .carousel-img {
                height: 185px;
            }

            .carousel-btn {
                width: 42px;
                height: 42px;
                font-size: 14px;
            }

            .carousel-btn--prev {
                left: 8px;
            }

            .carousel-btn--next {
                right: 8px;
            }

            .boxes-section {
                padding: 16px 18px 64px;
                gap: 18px;
            }

            .boxes-row {
                gap: 18px;
            }

            .box-item {
                width: 270px;
                height: 210px;
            }

            .floating-whatsapp {
                bottom: 40px;
                right: 20px;
                width: 50px;
                height: 50px;
                font-size: 28px;
            }

            .floating-whatsapp::after {
                bottom: -28px;
                font-size: 12px;
                padding: 3px 12px;
            }

            .contact-item {
                width: calc(50% - 8px);
                justify-content: flex-start;
                padding: 10px 16px 10px 10px;
            }
        }

        @media (max-width: 480px) {
            :root {
                --offset: 125px;
            }

            .carousel-card {
                width: 250px;
                border-radius: 18px;
                padding: 12px 12px 14px;
            }

            .carousel-img {
                height: 160px;
                border-radius: 13px;
            }

            .box-item {
                width: min(300px, calc(100vw - 40px));
                height: 210px;
            }

            .box-item::before {
                display: none;
            }

            .contact-item {
                width: 100%;
                justify-content: flex-start;
            }
        }

        .boxes-section .box-link:nth-child(1) .box-item {
            transition-delay: 0.00s;
        }

        .boxes-section .box-link:nth-child(2) .box-item {
            transition-delay: 0.07s;
        }

        .boxes-section .box-link:nth-child(3) .box-item {
            transition-delay: 0.14s;
        }

        .boxes-section.show .box-link:nth-child(1) {
            animation: riseIn 0.65s var(--ease-smooth) 0.00s both;
        }

        .boxes-section.show .box-link:nth-child(2) {
            animation: riseIn 0.65s var(--ease-smooth) 0.10s both;
        }

        .boxes-section.show .box-link:nth-child(3) {
            animation: riseIn 0.65s var(--ease-smooth) 0.20s both;
        }

        .boxes-row:last-child .boxes-section.show .box-link:nth-child(1) {
            animation-delay: 0.28s;
        }

        .boxes-row:last-child .boxes-section.show .box-link:nth-child(2) {
            animation-delay: 0.38s;
        }

        @keyframes riseIn {
            from {
                opacity: 0;
                transform: translateY(28px) scale(0.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="navbar-inner">
            <div class="navbar-emblem">المكتب</div>
            <span class="navbar-title">الفني لأعمال اللاندسكيب</span>
        </div>
        <a href="{{ route('login') }}" class="navbar-enroll">اشترك الان</a>
        <img src="{{ asset('images/Logo.png') }}" alt="شعار الأكاديمية" class="navbar-logo">
    </nav>

    <div class="section-header">
        <div class="section-badge">
            <span class="badge-dot"></span>
            لوحة الشرف
        </div>
        <h2 class="section-title">أعمال <span class="highlight">متدربينا المتميزين</span></h2>
        <div class="section-rule"></div>
        @if ($setting->master_drive_link)
            <div style="margin-top: 24px;">
                <a href="{{ $setting->master_drive_link }}" target="_blank" class="master-btn">
                    <i class="fa-brands fa-google-drive"></i> رابط أعمال المتدربين (Google Drive)
                </a>
            </div>
        @endif
    </div>

    <div class="carousel-wrapper">
        <div class="carousel-container">
            <button class="carousel-btn carousel-btn--prev" aria-label="السابق">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
            <button class="carousel-btn carousel-btn--next" aria-label="التالي">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
        </div>
        <div class="carousel-dots"></div>
    </div>

    <div class="section-header" style="padding-top: 28px;">
        <div class="section-badge">
            <span class="badge-dot"></span>
            البرامج التدريبية
        </div>
        <h2 class="section-title">أعمال <span class="highlight">المتدربين</span></h2>
        <div class="section-rule"></div>
    </div>

    <div class="boxes-section">
        <div class="boxes-row">
            <a href="{{ $setting->sketchup_link ?? '#' }}" target="_blank" class="box-link" id="card-link-sketchup">
                <div class="box-item">
                    <div class="box-icon-wrapper">
                        <img src="{{ asset('images/Lumun & SketchUP.png') }}" alt="Sketchup" class="box-icon">
                    </div>
                    <div class="box-divider"></div>
                    <h2>Sketchup &amp; Lumion</h2>
                </div>
            </a>
            <a href="{{ $setting->max_link ?? '#' }}" target="_blank" class="box-link" id="card-link-3dsmax">
                <div class="box-item">
                    <div class="box-icon-wrapper">
                        <img src="{{ asset('images/3DMAXandCorona.png') }}" alt="3Ds Max" class="box-icon">
                    </div>
                    <div class="box-divider"></div>
                    <h2>3Ds Max &amp; Corona</h2>
                </div>
            </a>
            <a href="{{ $setting->autocad_link ?? '#' }}" target="_blank" class="box-link" id="card-link-autocad">
                <div class="box-item">
                    <div class="box-icon-wrapper">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6e/AutoCad_new_logo.svg/960px-AutoCad_new_logo.svg.png"
                            alt="Autocad" class="box-icon">
                    </div>
                    <div class="box-divider"></div>
                    <h2>Autocad</h2>
                </div>
            </a>
        </div>

        <div class="boxes-row">
            <a href="{{ $setting->manual_link ?? '#' }}" target="_blank" class="box-link" id="card-link-manual">
                <div class="box-item">
                    <div class="box-icon-wrapper">
                        <img src="{{ asset('images/manual-artistry.png') }}" alt="Manual Sketch" class="box-icon">
                    </div>
                    <div class="box-divider"></div>
                    <h2>Manual Sketch</h2>
                </div>
            </a>
            <a href="{{ $setting->landscape_link ?? '#' }}" target="_blank" class="box-link"
                id="card-link-landscape">
                <div class="box-item">
                    <div class="box-icon-wrapper">
                        <img src="{{ asset('images/RealTime.png') }}" alt="Landscape" class="box-icon">
                    </div>
                    <div class="box-divider"></div>
                    <h2>Real Time Landscape</h2>
                </div>
            </a>
        </div>
    </div>

    <div class="section-header" style="padding-top: 0;">
        <div class="section-badge">
            <span class="badge-dot"></span>
            تواصل معنا
        </div>
        <h2 class="section-title">قنوات <span class="highlight">التواصل</span></h2>
        <div class="section-rule"></div>
    </div>

    <div class="contact-section">
        <a href="mailto:info@landscape-technical-office.com" class="contact-item email">
            <div class="contact-icon"><i class="fa-solid fa-envelope"></i></div>
            <span>البريد الإلكتروني</span>
        </a>
        <a href="tel:+201080537163" class="contact-item phone">
            <div class="contact-icon"><i class="fa-solid fa-phone"></i></div>
            <span>الهاتف</span>
        </a>
        <a href="https://www.youtube.com/@landscapetechnicaloffice" target="_blank" class="contact-item youtube">
            <div class="contact-icon"><i class="fa-brands fa-youtube"></i></div>
            <span>يوتيوب</span>
        </a>
        <a href="https://www.tiktok.com/@eslamelshaer83" target="_blank" class="contact-item tiktok">
            <div class="contact-icon"><i class="fa-brands fa-tiktok"></i></div>
            <span>تيك توك</span>
        </a>
        <a href="https://www.instagram.com/Landscape_technical_office" target="_blank"
            class="contact-item instagram">
            <div class="contact-icon"><i class="fa-brands fa-instagram"></i></div>
            <span>إنستجرام</span>
        </a>
    </div>

    <footer class="page-footer">
        جميع الحقوق محفوظة ©أكاديمية مكتب فني 2026
    </footer>

    <a href="https://wa.me/201080537163" target="_blank" class="floating-whatsapp"
        aria-label="تواصل معنا عبر واتساب">
        <i class="fa-brands fa-whatsapp"></i>
    </a>

   <script nonce="{{ $csp_nonce }}">
    // ── 1. جلب بيانات المشاريع من لارافيل مباشرة ──
    // لارافيل هيحول البيانات لمصفوفة جافاسكريبت تلقائياً
    const projectsData = @json($projects);

    // ── 2. مراجع العناصر ──
    const carouselContainer = document.querySelector('.carousel-container');
    const prevBtn = document.querySelector('.carousel-btn--prev');
    const nextBtn = document.querySelector('.carousel-btn--next');
    const dotsContainer = document.querySelector('.carousel-dots');
    let cards = [];

    // ── 3. الحالة (State) ──
    let activeIndex = 0;
    let autoPlayInterval;
    const OFFSET = 230;

    // ── 4. تحميل البيانات للواجهة (الكاروسيل فقط) ──
    const loadDataToUI = () => {
        // الروابط تم ربطها خلاص بـ Blade في الـ HTML فمش محتاجين الجافاسكريبت فيها

        // حقن كروت المشاريع ديناميكياً
        if (projectsData && projectsData.length > 0) {
            projectsData.forEach((p, index) => {
                const card = document.createElement('div');
                card.classList.add('carousel-card');

                // لاحظ استخدام p.image_path و p.drive_link و p.facebook_link
                // ولاحظ استخدام مسار /storage/ عشان الصور تظهر
                card.innerHTML = `
                    <a href="${p.drive_link}" target="_blank" class="carousel-img-link">
                        <img src="/storage/${p.image_path}" alt="مشروع ${index + 1}" class="carousel-img">
                    </a>
                    <div class="carousel-card-footer">
                        <span class="carousel-label">مشروع ${index + 1}</span>
                        <a href="${p.facebook_link}" target="_blank" class="facebook-logo">
                            <i class="fa-brands fa-facebook"></i> تابعنا
                        </a>
                    </div>
                `;
                carouselContainer.insertBefore(card, prevBtn);
            });
        }

        cards = document.querySelectorAll('.carousel-card');

        // إعداد كليك الكروت للـ Navigation
        if (cards.length > 0) {
            cards.forEach(card => {
                const links = card.querySelectorAll('a');
                links.forEach(link => {
                    link.addEventListener('click', (e) => {
                        if (isDragged || card.classList.contains('prev') || card.classList.contains('next')) {
                            e.preventDefault();
                        }
                    });
                });

                card.addEventListener('click', () => {
                    if (isDragged) return;
                    if (card.classList.contains('prev')) {
                        goToPrev();
                        startAutoPlay();
                    } else if (card.classList.contains('next')) {
                        goToNext();
                        startAutoPlay();
                    }
                });
            });
        }
    };

    // ── 5. تحديث الكاروسيل ──
    const updateCarousel = () => {
        if (!cards.length) return;
        cards.forEach((card, i) => {
            card.classList.remove('active', 'prev', 'next');
            const prevIndex = (activeIndex - 1 + cards.length) % cards.length;
            const nextIndex = (activeIndex + 1) % cards.length;

            if (i === activeIndex) card.classList.add('active');
            else if (i === prevIndex) card.classList.add('prev');
            else if (i === nextIndex) card.classList.add('next');
        });
        updateDots();
    };

    // ── 6. تحديث النقاط (Dots) ──
    const updateDots = () => {
        document.querySelectorAll('.dot').forEach((dot, i) => {
            dot.classList.toggle('active', i === activeIndex);
        });
    };

    // ── 7. التنقل (Navigation) ──
    const goToNext = () => {
        if (!cards.length) return;
        activeIndex = (activeIndex + 1) % cards.length;
        updateCarousel();
    };
    const goToPrev = () => {
        if (!cards.length) return;
        activeIndex = (activeIndex - 1 + cards.length) % cards.length;
        updateCarousel();
    };

    // ── 8. التشغيل التلقائي (AutoPlay) ──
    const startAutoPlay = () => {
        if (!cards.length) return;
        clearInterval(autoPlayInterval);
        autoPlayInterval = setInterval(goToNext, 3500);
    };

    // ── 9. أحداث الأزرار ──
    nextBtn.addEventListener('click', () => {
        goToNext();
        startAutoPlay();
    });
    prevBtn.addEventListener('click', () => {
        goToPrev();
        startAutoPlay();
    });
    carouselContainer.addEventListener('mouseenter', () => {
        clearInterval(autoPlayInterval);
    });
    carouselContainer.addEventListener('mouseleave', () => {
        if (!isDragging) startAutoPlay();
    });

    // ── 10. السحب (Drag / Swipe) ──
    let isDragging = false;
    let isDragged = false;
    let startPos = 0;

    const handleDragStart = (e) => {
        if (!cards.length) return;
        isDragging = true;
        isDragged = false;
        startPos = e.type.includes('mouse') ? e.clientX : e.touches[0].clientX;
        clearInterval(autoPlayInterval);
        carouselContainer.style.cursor = 'grabbing';
        carouselContainer.classList.add('dragging');
    };

    const handleDragMove = (e) => {
        if (!isDragging || !cards.length) return;
        const currentPos = e.type.includes('mouse') ? e.clientX : e.touches[0].clientX;
        const movedBy = currentPos - startPos;
        if (Math.abs(movedBy) > 10) isDragged = true;

        const dragRatio = Math.min(Math.max(movedBy / OFFSET, -1), 1);
        const clampedMove = dragRatio * OFFSET;

        cards.forEach(card => {
            if (card.classList.contains('active')) {
                const scale = 1.05 - Math.abs(dragRatio) * 0.27;
                const opacity = 1 - Math.abs(dragRatio) * 0.3;
                const blur = Math.abs(dragRatio) * 4;
                const rotate = dragRatio * -25;
                const shadowX = rotate * -1;
                const glarePos = 50 + (rotate * 2);
                const glareOpacity = (Math.abs(rotate) / 25) * 0.55;
                card.style.transform = `translateX(${clampedMove}px) scale(${scale}) rotateY(${rotate}deg)`;
                card.style.opacity = opacity;
                card.style.filter = `blur(${blur}px)`;
                card.style.boxShadow = `${shadowX}px 15px ${10 + scale * 10}px rgba(0,0,0,${scale * 0.18})`;
                card.style.setProperty('--glare-pos', `${glarePos}%`);
                card.style.setProperty('--glare-opacity', glareOpacity);
            } else if (card.classList.contains('prev')) {
                const scale = 0.78 + Math.max(0, dragRatio) * 0.27;
                const opacity = 0.45 + Math.max(0, dragRatio) * 0.55;
                const blur = 3.5 - Math.max(0, dragRatio) * 3.5;
                const rotate = 25 - Math.max(0, dragRatio) * 25;
                const shadowX = rotate * -1;
                const glarePos = 50 + (rotate * 2);
                const glareOpacity = (Math.abs(rotate) / 25) * 0.55;
                card.style.transform = `translateX(${-OFFSET + clampedMove}px) scale(${scale}) rotateY(${rotate}deg)`;
                card.style.opacity = opacity;
                card.style.filter = `blur(${blur}px)`;
                card.style.boxShadow = `${shadowX}px 15px ${10 + scale * 10}px rgba(0,0,0,${scale * 0.18})`;
                card.style.setProperty('--glare-pos', `${glarePos}%`);
                card.style.setProperty('--glare-opacity', glareOpacity);
            } else if (card.classList.contains('next')) {
                const scale = 0.78 + Math.max(0, -dragRatio) * 0.27;
                const opacity = 0.45 + Math.max(0, -dragRatio) * 0.55;
                const blur = 3.5 - Math.max(0, -dragRatio) * 3.5;
                const rotate = -25 + Math.max(0, -dragRatio) * 25;
                const shadowX = rotate * -1;
                const glarePos = 50 + (rotate * 2);
                const glareOpacity = (Math.abs(rotate) / 25) * 0.55;
                card.style.transform = `translateX(${OFFSET + clampedMove}px) scale(${scale}) rotateY(${rotate}deg)`;
                card.style.opacity = opacity;
                card.style.filter = `blur(${blur}px)`;
                card.style.boxShadow = `${shadowX}px 15px ${10 + scale * 10}px rgba(0,0,0,${scale * 0.18})`;
                card.style.setProperty('--glare-pos', `${glarePos}%`);
                card.style.setProperty('--glare-opacity', glareOpacity);
            }
        });
    };

    const handleDragEnd = (e) => {
        if (!isDragging || !cards.length) return;
        isDragging = false;
        carouselContainer.style.cursor = 'grab';
        carouselContainer.classList.remove('dragging');

        cards.forEach(card => {
            card.style.transform = '';
            card.style.opacity = '';
            card.style.filter = '';
            card.style.boxShadow = '';
            card.style.removeProperty('--glare-pos');
            card.style.removeProperty('--glare-opacity');
        });

        const endPos = e.type.includes('mouse') ? e.clientX : e.changedTouches[0].clientX;
        const movedBy = endPos - startPos;
        const threshold = 55;

        if (movedBy < -threshold) goToNext();
        else if (movedBy > threshold) goToPrev();

        startAutoPlay();
    };

    // ربط أحداث السحب واللمس
    carouselContainer.addEventListener('touchstart', handleDragStart, { passive: true });
    carouselContainer.addEventListener('touchmove', handleDragMove, { passive: true });
    carouselContainer.addEventListener('touchend', handleDragEnd);
    carouselContainer.addEventListener('mousedown', handleDragStart);
    carouselContainer.addEventListener('mousemove', handleDragMove);
    window.addEventListener('mouseup', handleDragEnd);
    carouselContainer.addEventListener('dragstart', (e) => e.preventDefault());

    // ── 11. بناء النقاط (Dots) ──
    const buildDots = () => {
        if (!cards.length) return;
        cards.forEach((_, i) => {
            const dot = document.createElement('span');
            dot.classList.add('dot');
            dot.addEventListener('click', () => {
                activeIndex = i;
                updateCarousel();
                startAutoPlay();
            });
            dotsContainer.appendChild(dot);
        });
    };

    // ── 12. التشغيل المبدئي ──
    const init = () => {
        loadDataToUI();
        buildDots();
        updateCarousel();
        startAutoPlay();
    };
    init();

    // ── 13. تأثيرات ظهور الأقسام عند التمرير (Scroll Reveal) ──
    const animatedSections = document.querySelectorAll('.boxes-section, .contact-section');
    const scrollObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });

    animatedSections.forEach(sec => scrollObserver.observe(sec));

    // ── 14. ظهور زر الواتساب ──
    const floatingWhatsApp = document.querySelector('.floating-whatsapp');
    if (floatingWhatsApp) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                floatingWhatsApp.classList.add('show');
            } else {
                floatingWhatsApp.classList.remove('show');
            }
        });
    }
</script>
</body>

</html>
