<?php
// Aktifkan tampilan kesalahan
error_reporting(E_ALL);
ini_set('display_errors', 1);

// koneksi ke database
$servername = "localhost";
$username = "root"; // ganti dengan username database Anda
$password = ""; // ganti dengan password database Anda
$dbname = "admin";

$conn = new mysqli($servername, $username, $password, $dbname);

// cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// proses login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST['username']; // pastikan penamaan variabel konsisten
    $input_password = $_POST['password'];

    // ambil data pengguna dari database
    $sql = "SELECT * FROM masuk WHERE ussername = ?"; // pastikan nama kolom sesuai
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // verifikasi password tanpa enkripsi
        if ($input_password === $row['password']) { // Bandingkan langsung
            // arahkan ke halaman daftar peserta
            header("Location: daftar_peserta.php");
            exit();
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Username tidak ditemukan!";
    }
}

$conn->close();
?>


</html>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #98d1ff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 4px;
        }

        input[type="submit"],
        input[type="button"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 4px;
        }

        input[type="submit"]:hover,
        input[type="button"]:hover {
            background-color: #c2c2c29;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Form Login Admin</h2>
        <form method="post" action="">
            Username: <input type="text" name="username" required><br>
            Password: <input type="password" name="password" required><br>
            <input type="submit" value="Login"> 
            <a href="pendaftaran.php"><input type="button" value="Daftar"></a>
            