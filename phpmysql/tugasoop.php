<?php
class Database{
    private $host   = "localhost";
    private $user   = "root";
    private $pass   = "";
    private $dbname = "dboo";
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($this->conn->connect_error){
            die("koneksi gagal: " . $this->conn->connect_error);
        }
    }
}

class Participant extends Database{
    public function create($name, $email){
        $stmt = $this->conn->prepare("INSERT INTO participants (nama, email) VALUES(?, ?)");
        $stmt->bind_param("ss", $name, $email);
        if ($stmt->execute()) {
            return "Data berhasil ditambahkan";
        }else{
            return "Error: ". $stmt->error;
        }
    }

    public function getAllSorted(){
        $sql = "SELECT * FROM participants ORDER BY nama ASC";
        $result = $this->conn->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo "ID: ". $row["id"]. " - Nama: " . $row["nama"]. " - Email: " . $row["email"]. "<br>";
            }
        }else{
            echo "0 results";
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $partisipant = new Participant();
    $name = $_POST['name'];
    $email = $_POST['email'];
    echo $partisipant->create($name, $email);
}
?>

<form action="" method="post">
    Nama: <input type="text" name="name" required><br>
    Email: <input type="email" name="email" required><br>
    <input type="submit" value="Tambah">
</form>

<hr>

<h2>Daftar Partisipan</h2>
<?php
$partisipant = new Participant();
$partisipant->getAllSorted();
?>