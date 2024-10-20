<?php
// koneksi ke database
$servername = "localhost";
$username = "root"; // ganti dengan username database Anda
$password = ""; // ganti dengan password database Anda
$dbname = "peserta";

$conn = new mysqli($servername, $username, $password, $dbname);

// cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// proses pendaftaran
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reg_username = $_POST['username'];
    $reg_password = $_POST['password']; // Simpan password tanpa enkripsi

    // simpan data pengguna ke database
    $sql = "INSERT INTO masuk (ussername, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $reg_username, $reg_password);

    if ($stmt->execute()) {
        // Arahkan ke halaman login setelah pendaftaran berhasil
        header("Location: login_peserta.php"); // Ganti 'login.php' dengan nama file login Anda
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran</title>
     <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Form Pendaftaran Akun Peserta</h2>
    <form method="post" action="">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Daftar">
    </form>
</body>
</html>