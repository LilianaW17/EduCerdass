<?php
session_start();

require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    if (isset($_POST['login_pelajar'])) {
        $sql = "SELECT * FROM pelajar WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
        if ($user && md5($password) === $user['password']) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = 'Pelajar';
            header("Location: dashboard_pelajar.php");
            exit();
        } else {
            echo "Login gagal. Periksa kembali nama pengguna dan kata sandi Anda.";
        }
    } elseif (isset($_POST['login_tutor'])) {
        $sql = "SELECT * FROM tutors WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $tutor = $result->fetch_assoc();

        if ($tutor && md5($password) === $tutor['password']) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = 'Tutor';
            header("Location: dashboard_tutor.php");
            exit();
        } else {
            echo "Login gagal. Periksa kembali nama pengguna dan kata sandi Anda.";
        }
    } else {
        echo "Invalid button";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCerdas</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('aset/Software\ developer.jpg') no-repeat;
            background-size: cover;
            background-position: center;
        }

        .wrapper {
            width: 420px;
            background: #240750;
            border: 2px solid rgba(255, 255, 255, .2);
            color: white;
            border-radius: 10px;
            padding: 30px 40px;
        }

        .wrapper h1 {
            font-size: 36px;
            text-align: center;
            color: white;
        }

        .wrapper .input-box {
            position: relative;
            width: 90%;
            height: 50px;
            margin: 30px;
        }

        .input-box input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255, 255, 255, .2);
            font-size: 16px;
            color: whi;
            padding: 20px 45px 20px 20px;
        }

        .input-box input::placeholder {
            color: #fff;
        }

        .input-box i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
        }

        .wrapper .remember-forgot {
            display: flex;
            justify-content: space-between;
            font-size: 14.5px;
            margin: -15 0 15px;
        }

        .remember-forgot label input {
            accent-color: #fff;
            margin-right: 3px;
        }

        .remember-forgot a {
            color: #fff;
            text-decoration: none;
        }

        .remember-forgot a:hover {
            text-decoration: underline;
        }

        .wrapper .btn {
            width: 100%;
            height: 45px;
            background: #fff;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            cursor: pointer;
            font-size: 16px;
            color: #333;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .wrapper .register-link {
            font-size: 14.5px;
            text-align: center;
            margin-top: 20px 0 15px;
        }

        .register-link p a {
            color: white;
            text-decoration: none;
            font-weight: 600;
        }
        .input-box input:focus {
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <form action="login.php" method="POST">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" name="username" id="username" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox" name="" id="">Remember me</label>
                <a href="#">Forgot password</a>
            </div>
            <button type="submit" class="btn" name="login_pelajar">Login as Pelajar</button>
            <button type="submit" class="btn" name="login_tutor">Login as Tutor</button>
            <div class="register-link">
                <p>Don't have an account? <a href="daftar.php">Register</a></p>
            </div>
        </form>
    </div>
</body>
</html>
