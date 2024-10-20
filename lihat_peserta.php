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
?>
 <header>
 <style>
    h1{
        margin-top: 30px;
    }
table {
  width: 50%;
  border-collapse: collapse;
  margin-top: 20px;
}

th, td {
  text-align: center;
  padding: 8px;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #f2f2f2;
  font-weight: bold;
}

tr:nth-child(even) {
  background-color: #f9f9f9;
}

/* Add some hover effects */
tr:hover {
  background-color: #e0e0e0;
}

/* Style the form */
#form-container {
  width: -400px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
  display: block;
  margin-bottom: 50px;
}

input[type="text"], input[type="password"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 3px;
  box-sizing: border-box;
  margin-bottom: 10px;
}

button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 3px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #3e8e41; /* Darker green on hover */
}
</style>
</header>