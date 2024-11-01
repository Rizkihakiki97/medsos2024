<?php
class Penduduk
{
    public $nama;
    protected $umur;
    private $alamat = "Jakarta";

    public function getAlamat()
    {
        return $this->alamat;
    }
}

class Bansos extends Penduduk
{
    public $nama = "Anton";
    protected $umur = 24;
    public $status = "Miskin";

    public function showPenduduk()
    {
        echo $this->nama . "<br>";
        echo $this->status . "<br>";
        echo $this->umur . "<br>";
        echo $this->getAlamat() . "<br><br>"; // Menggunakan getAlamat() untuk mengakses $alamat
    }
}

$penduduk = new Bansos();
$penduduk->showPenduduk(); // Menampilkan Anton, Miskin, 24, Jakarta

echo $penduduk->nama . "<br>"; // Anton
echo $penduduk->status . "<br>"; // Miskin
// echo $penduduk->umur."<br>"; // Fatal Error, karena $umur adalah protected
// echo $penduduk->alamat."<br>"; // Undefined, karena $alamat adalah private dan tidak bisa diakses langsung