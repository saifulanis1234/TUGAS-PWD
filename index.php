<?php
// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "registrasi";

$conn = new mysqli($host, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari formulir (menggunakan metode POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama_lengkap']; // Menggunakan nama yang konsisten
    $email = $_POST['email'];
    $institusi = $_POST['institusi'];
    $country = $_POST['country'];
    $address = $_POST['alamat']; // Menggunakan nama yang konsisten

    // Validasi data (contoh: pastikan email valid)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Alamat email tidak valid";
        exit();
    }

    // Siapkan query dengan parameter (menggunakan prepared statement untuk mencegah SQL injection)
    $stmt = $conn->prepare("INSERT INTO peserta (nama, email, institusi, country, address) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nama, $email, $institusi, $country, $address);

    // Eksekusi query
    if ($stmt->execute()) {
        // Jika pendaftaran berhasil, arahkan ke daftar_peserta.php
        header("Location: lihat_peserta.php");
        exit(); // Pastikan untuk menghentikan eksekusi skrip setelah pengalihan
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>

<form method="post" action="">
             PENDAFTARAN SEMINAR <br>
    Nama Lengkap: <input type="text" name="nama_lengkap" required><br>
    Email: <input type="email" name="email" required><br>
    Institusi: <input type="text" name="institusi" required><br>
    Negara:
    <select name="country" required>
        <option value="">Pilih Negara</option>
        <option value="INDONESIA">INDONESIA</option>
        <option value="BAHRAIN">BAHRAIN</option>
        <option value="JEPANG">JEPANG</option>
        <option value="AUSTRALIA">AUSTRALIA</option>
        <option value="ARAB_SAUDI">ARAB SAUDI</option>
    </select><br>
    Alamat: <input type="text" name="alamat" required><br>
    <input type="submit" value="DAFTAR">
</form>
<header>
    <style>
        form {
  background-color: #afdafd;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  width: 400px;
  margin: 50px auto;
  text-align: center;
}

form h2 {
  color: #333;
  margin-bottom: 20px;

}

form input[type="text"],
form input[type="email"],
form select {
  width: 100%;
  padding: 10px;
  margin: 10px 0;
  border: 1px solid #ddd;
  border-radius: 4px;
  box-sizing: border-box;
}

form input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
}

form input[type="submit"]:hover {
  background-color: #45a049;
}
</style>
</header>