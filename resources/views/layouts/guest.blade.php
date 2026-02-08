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
                max-width: 1000px;
                display: flex;
                border-radius: var(--radius);
                overflow: hidden;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            }

            /* Section Formulaire */
            .auth-form-section {
                flex: 1;
                padding: 60px;
            }

            .form-header h1 {
                font-size: 2rem;
                color: var(--text-main);
                margin-bottom: 8px;
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
                box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            }

            .form-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                font-size: 0.85rem;
                margin-bottom: 30px;
            }

            .btn-login {
                width: 100%;
                padding: 14px;
                background-color: rgb(46, 13, 167);
                color: white;
                border: none;
                border-radius: 8px;
                font-weight: 600;
                cursor: pointer;
                transition: background 0.3s;
            }

            .btn-login:hover {
                background-color: var(--primary-hover);
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
