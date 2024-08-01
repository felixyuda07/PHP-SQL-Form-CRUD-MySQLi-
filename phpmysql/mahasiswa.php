<?php
class Database {
    private $host   = "localhost";
    private $user   = "root";
    private $pass   = "";
    private $dbname = "dataMhs";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }
}

class Mahasiswa extends Database {
    
    // Menambahkan data
    public function create($nim, $nama, $tempat_lahir, $tanggal_lahir, $jurusan, $program_studi, $ipk) {
        $stmt = $this->conn->prepare("INSERT INTO mahasiswa (nim, nama, tempat_lahir, tanggal_lahir, jurusan, program_studi, ipk) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $nim, $nama, $tempat_lahir, $tanggal_lahir, $jurusan, $program_studi, $ipk);
        if ($stmt->execute()) {
            return "Data berhasil ditambahkan";
        } else {
            return "Error: " . $stmt->error;
        }
    }

    // Membaca data
    public function read() {
        $sql = "SELECT * FROM mahasiswa";
        $result = $this->conn->query($sql);
        return $result;
    }

    // Memperbarui data 
    public function update($nim, $nama, $tempat_lahir, $tanggal_lahir, $jurusan, $program_studi, $ipk) {
        $stmt = $this->conn->prepare("UPDATE mahasiswa SET nama=?, tempat_lahir=?, tanggal_lahir=?, jurusan=?, program_studi=?, ipk=? WHERE nim=?");
        $stmt->bind_param("sssssss", $nama, $tempat_lahir, $tanggal_lahir, $jurusan, $program_studi, $ipk, $nim);
        if ($stmt->execute()) {
            return "Data berhasil diperbarui";
        } else {
            return "Error: " . $stmt->error;
        }
    }

    // Menghapus Data
    public function delete($nim) {
        $stmt = $this->conn->prepare("DELETE FROM mahasiswa WHERE nim=?");
        $stmt->bind_param("s", $nim);
        if ($stmt->execute()) {
            return "Data berhasil dihapus";
        } else {
            return "Error: " . $stmt->error;
        }
    }
}
$mahasiswa = new Mahasiswa();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['create'])) {
        // Handle Create
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $jurusan = $_POST['jurusan'];
        $program_studi = $_POST['program_studi'];
        $ipk = $_POST['ipk'];
        echo $mahasiswa->create($nim, $nama, $tempat_lahir, $tanggal_lahir, $jurusan, $program_studi, $ipk);
    } elseif (isset($_POST['update'])) {
        // Handle Update
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $jurusan = $_POST['jurusan'];
        $program_studi = $_POST['program_studi'];
        $ipk = $_POST['ipk'];
        echo $mahasiswa->update($nim, $nama, $tempat_lahir, $tanggal_lahir, $jurusan, $program_studi, $ipk);
    } elseif (isset($_POST['delete'])) {
        // Handle Delete
        $nim = $_POST['nim'];
        echo $mahasiswa->delete($nim);
    }
}
?>

<h2>Tambah Data Mahasiswa</h2>
<form action="" method="post">
    NIM: <input type="text" name="nim" required><br>
    Nama: <input type="text" name="nama" required><br>
    Tempat Lahir: <input type="text" name="tempat_lahir" required><br>
    Tanggal Lahir: <input type="date" name="tanggal_lahir" required><br>
    Jurusan: <input type="text" name="jurusan" required><br>
    Program Studi: <input type="text" name="program_studi" required><br>
    IPK: <input type="text" name="ipk" required><br>
    <input type="submit" name="create" value="Tambah">
</form>

<hr>

<h2>Update Data Mahasiswa</h2>
<form action="" method="post">
    NIM: <input type="text" name="nim" required><br>
    Nama: <input type="text" name="nama"><br>
    Tempat Lahir: <input type="text" name="tempat_lahir"><br>
    Tanggal Lahir: <input type="date" name="tanggal_lahir"><br>
    Jurusan: <input type="text" name="jurusan"><br>
    Program Studi: <input type="text" name="program_studi"><br>
    IPK: <input type="text" name="ipk"><br>
    <input type="submit" name="update" value="Update">
</form>

<hr>

<h2>Hapus Data Mahasiswa</h2>
<form action="" method="post">
    NIM: <input type="text" name="nim" required><br>
    <input type="submit" name="delete" value="Hapus">
</form>

<hr>

<h2>Daftar Mahasiswa</h2>
<?php
$result = $mahasiswa->read();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "NIM: " . $row["nim"] . " - Nama: " . $row["nama"] . " - Tempat Lahir: " . $row["tempat_lahir"] . " - Tanggal Lahir: " . $row["tanggal_lahir"] . " - Jurusan: " . $row["jurusan"] . " - Program Studi: " . $row["program_studi"] . " - IPK: " . $row["ipk"] . "<br>";
    }
} else {
    echo "0 results";
}
?>

