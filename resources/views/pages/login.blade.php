<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/f59bcd8580.css">
    <style>
        html,
        body {
            height: 100%;
            width: 100%;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f0f2f5;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .auth-container {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
        }

        .form-footer a {
            color: #1877f2;
        }

        .toggle-link {
            text-align: center;
            margin-top: 15px;
        }

        .toggle-link a {
            color: #1877f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="auth-container">
            <div class="auth-header">
                <h1>Đăng nhập</h1>
            </div>
            <div class="container">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <form action="{{ url('auth-login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email"
                        required>
                </div>

                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Nhập mật khẩu" required>
                </div>
                <button type="submit" class="btn btn-dark w-100">Đăng nhập</button>
            </form>

            <div class="form-footer">
                <p>Không có tài khoản? <a href="#" id="show-signup">Đăng Ký</a></p>
            </div>
        </div>

        <div class="auth-container" id="signup-form" style="display:none;">
            <div class="auth-header">
                <h1>Đăng Ký</h1>
            </div>
            <form action="{{ url('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="signup-email">Email</label>
                    <input type="email" class="form-control" id="signup-email" name="email" placeholder="Nhập email"
                        required>
                </div>
                <div class="form-group">
                    <label for="email">Họ và Tên</label>
                    <input type="name" class="form-control" id="text" name="fullname"
                        placeholder="Nhập họ và tên" required>
                </div>
                <div class="form-group">
                    <label for="signup-password">Mật khẩu</label>
                    <input type="password" class="form-control" id="signup-password" name="password"
                        placeholder="Nhập mật khẩu" required>
                </div>
                <div class="form-group">
                    <label for="signup-password-confirm">Xác nhận mật khẩu</label>
                    <input type="password" class="form-control" id="signup-password-confirm"
                        name="password_confirmation" placeholder="Xác nhận mật khẩu" required>
                </div>
                <button type="submit" class="btn btn-dark w-100">Đăng ký</button>
            </form>

            <div class="form-footer">
                <p>Đã có tài khoản? <a href="#" id="show-login">Đăng nhập</a></p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('show-signup').addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector('.auth-container').style.display = 'none';
            document.getElementById('signup-form').style.display = 'block';
        });

        document.getElementById('show-login').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('signup-form').style.display = 'none';
            document.querySelector('.auth-container').style.display = 'block';
        });
    </script>
</body>

</html>
