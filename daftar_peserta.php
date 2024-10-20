<?php
// Koneksi ke database
$host = "localhost"; // Ganti jika menggunakan server lain
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "registrasi"; // Nama database yang telah dibuat

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses penghapusan peserta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $nama = $conn->real_escape_string($_POST['nama']);
    $sql_delete = "DELETE FROM peserta WHERE nama='$nama'";
    if ($conn->query($sql_delete) === TRUE) {
        echo "Peserta berhasil dihapus.";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Proses penambahan peserta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $nama = $conn->real_escape_string($_POST['nama']);
    $email = $conn->real_escape_string($_POST['email']);
    $institusi = $conn->real_escape_string($_POST['institusi']);
    $country = $conn->real_escape_string($_POST['country']);
    $address = $conn->real_escape_string($_POST['address']);
    
    $sql_add = "INSERT INTO peserta (nama, email, institusi, country, address) VALUES ('$nama', '$email', '$institusi', '$country', '$address')";
    if ($conn->query($sql_add) === TRUE) {
        echo "Peserta berhasil ditambahkan.";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Query untuk mengambil data dari tabel peserta
$sql = "SELECT nama, email, institusi, country, address FROM peserta";
$result = $conn->query($sql);

// Cek apakah ada data yang ditemukan
if ($result->num_rows > 0) {
    // Tampilkan data dalam tabel HTML
    echo "<h1>Data Peserta</h1>";
    echo "<table border='1'>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Institusi</th>
                <th>Negara</th>
                <th>Alamat</th>
            </tr>";
    
    // Output data dari setiap baris
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["nama"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["institusi"] . "</td>
                <td>" . $row["country"] . "</td>
                <td>" . $row["address"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data peserta.";
}
//formulir untuk menghapus
echo '<h2>Hapus Peserta</h2>';
echo '<form method="post">
        <label for="nama">Nama Peserta:</label>
        <input type="text" id="nama" name="nama" required>
        <input type="submit" name="delete" value="Hapus Peserta">
      </form>';
// Formulir untuk menambahkan peserta
echo '<h2>Tambah Peserta</h2>';
echo '<form method="post">
        <label for="nama">Nama Peserta:</label>
        <input type="text" id="nama" name="nama" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="institusi">Institusi:</label>
        <input type="text" id="institusi" name="institusi" required><br>
        <label for="country">Negara:</label>
       <select name="country" required>
            <option value="">Pilih Negara</option>
            <option value="INDONESIA">INDONESIA</option>
            <option value="BAHRAIN">BAHRAIN</option>
            <option value="JEPANG">JEPANG</option>
            <option value="AUSTRALIA">AUSTRALIA</option>
            <option value="ARAB_SAUDI">ARAB SAUDI</option>
        </select><br>
        <label for="address">Alamat:</label>
        <input type="text" id="address" name="address" required><br>
        <input type="submit" name="add" value="Tambah Peserta">
      </form>';

?>
<header>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
}

h2 {
    color: #333;
    margin-bottom: 20px;
}

form {
    background-color: #fff;
    padding: 30px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    width: 400px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"],
input[type="email"],
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #4CAF50; /* Hijau */
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #45a049; /* Hijau lebih gelap */
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    text-align: left;
    padding: 8px;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f0f0f0;
}

/* Style untuk form login */
.login-form {
    background-color: #
}
</style>
</header