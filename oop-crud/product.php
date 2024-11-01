<?php
require_once "database.php";

class product extends Database
{
    private $table_name = "product";

    // property:
    public $id, $name, $price, $description, $category_id;

    // construct:
    public function __construct()
    {
        $this->conn = $this->getConnections();
    }
    function create()
    {
        $this->name = $this->name;
        $this->price = $this->price;
        $this->description = $this->description;
        $this->category_id = $this->category_id;

        $query = "INSERT INTO $this->table_name(name, price, description, category_id) VALUES ('$this->name', '$this->price', '$this->description','$this->category_id')";

        return $this->conn->query($query);
    }

    function read()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = '$this->id'";

        return $this->conn->query($query);
    }

    function readParam()
    {
        $this->id = $this->id;
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = " . $this->id . "";

        return $this->conn->query($query);
    }

    function update()
    {

        $this->name = $this->name;
        $this->price = $this->price;
        $this->description = $this->description;
        $this->category_id = $this->category_id;
        $this->id = $this->id;

        $query = "UPDATE " . $this->table_name . " SET name=" . $this->name . ", price=" . $this->price . ", description=" . $this->description . ", category_id=" . $this->category_id . " WHERE id=" . $this->id . "";

        return $this->conn->query($query);
    }
    function delete()
    {

        $this->id = $this->id;
        $queryDelete = "DELETE FROM " . $this->table_name . " WHERE id=" . $this->id . "";

        return $this->conn->query($queryDelete);
    }
}




// $database = new Database();
// $db       = $database->getConnections();

$product = new product();

// create:
// $product->name = "Buku";
// $product->price = 10000;
// $product->description = "Buku tulis";
// $product->category_id = 2;

// if ($product->create()) {
//     echo "Data berhasil di input";
// } else {
//     echo "Data gagal di input";
// }

// Read
$result = $product->read();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo $row['name'] . "-" . $row['price'] . "-" . $row['description'] . "-" . $row['category_id'] . "<br>";
    }
}

// Read parameter id:
$product->id = 2;

$result = $product->readParam();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $product->name = $row['name'];
    $product->price = $row['price'];
    $product->description = $row['description'];
    $product->category_id = $row['category_id'];

    echo "Nama: " . $product->name . "<br>";
    echo "Harga: " . $product->price . "<br>";
    echo "Deskripsi: " . $product->description . "<br>";
    echo "Kategori ID: " . $product->category_id . "<br>";
}

// update   
$product->id = 1;
$product->name = "Buku Upload";
$product->price = 25000;
$product->description = "Buku Majalah";
$product->category_id = 4;

if ($product->create()) {
    echo "Data berhasil di input";
} else {
    echo "Data gagal di input";
}

// delete

$product->id = 1;
if ($product->delete()) {
    echo "Data berhasil di hapus";
} else {
    echo "Data gagal di ihapus";
}
