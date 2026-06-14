<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <style>
            :root {
                --primary-color: #4f46e5;
                --primary-hover: #4338ca;
                --text-main: #1f2937;
                --text-muted: #6b7280;
                --bg-body: #f3f4f6;
                --radius: 16px;
            }

            /* Layout de base */
            .auth-container {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: var(--bg-body);
                padding: 20px;
                font-family: 'Segoe UI', system-ui, sans-serif;
            }

            .auth-card {
                background: white;
                width: 100%;
                max-width: 620px;
                display: flex;
                flex-direction: column;
                border-radius: var(--radius);
                overflow: hidden;
                box-shadow: 0 14px 60px rgba(15, 23, 42, 0.12);
            }

            /* Section Formulaire */
            .auth-form-section {
                flex: 1;
                padding: 48px 42px;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .auth-brand {
                display: inline-flex;
                flex-direction: column;
                gap: 6px;
                margin-bottom: 32px;
                font-size: 0.9rem;
                color: #374151;
            }

            .auth-brand span {
                font-size: 1.1rem;
                font-weight: 700;
                letter-spacing: 0.04em;
            }

            .auth-brand small {
                color: var(--text-muted);
            }

            .form-header h1 {
                font-size: 2.05rem;
                color: var(--text-main);
                margin-bottom: 10px;
                letter-spacing: -0.02em;
            }

            .form-header p {
                color: var(--text-muted);
                margin-bottom: 40px;
            }

            .input-group {
                margin-bottom: 20px;
            }

            .input-group label {
                display: block;
                font-size: 0.9rem;
                font-weight: 600;
                margin-bottom: 8px;
                color: var(--text-main);
            }

            .input-group input {
                width: 100%;
                padding: 12px 16px;
                border: 1px solid #d1d5db;
                border-radius: 8px;
                font-size: 1rem;
                transition: border-color 0.2s;
            }

            .input-group input:focus {
                outline: none;
                border-color: var(--primary-color);
                box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12);
            }

            .input-error {
                display: block;
                margin-top: 8px;
                color: #dc2626;
                font-size: 0.82rem;
            }

            .remember-me {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                color: var(--text-main);
            }

            .remember-me input {
                width: 16px;
                height: 16px;
            }

            .forgot-link {
                color: var(--primary-color);
                text-decoration: none;
            }

            .forgot-link:hover {
                text-decoration: underline;
            }

            .form-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                font-size: 0.9rem;
                margin-bottom: 32px;
                gap: 16px;
                flex-wrap: wrap;
            }

            .btn-login {
                width: 100%;
                padding: 14px 18px;
                background-color: rgb(46, 13, 167);
                color: white;
                border: none;
                border-radius: 12px;
                font-weight: 700;
                cursor: pointer;
                transition: background 0.25s ease, transform 0.15s ease;
            }

            .btn-login:hover {
                background-color: var(--primary-hover);
                transform: translateY(-1px);
            }

            .auth-note {
                margin-top: 24px;
                color: var(--text-muted);
                font-size: 0.88rem;
                line-height: 1.6;
                max-width: 34rem;
            }

            /* Section Image */
            .auth-image-section {
                flex: 1;
                background-image: url('https://images.unsplash.com/photo-1497215728101-856f4ea42174?auto=format&fit=crop&q=80');
                background-size: cover;
                background-position: center;
                position: relative;
                display: flex;
                align-items: flex-end;
            }

            .image-overlay {
                background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
                color: white;
                padding: 40px;
                width: 100%;
            }

            /* Responsive : Mobile First */
            @media (max-width: 768px) {
                .auth-image-section {
                    display: none; /* Cache l'image sur mobile */
                }
                .auth-form-section {
                    padding: 40px 20px;
                }
            }
        </style>
        <title>Login</title>
    </head>

    <body>
        <!-- Begin Page Content -->
            <main>
                {{ $slot ?? '' }}
            </main>
    </body>
</html>
