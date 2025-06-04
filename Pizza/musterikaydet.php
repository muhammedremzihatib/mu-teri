<?php
$baglan = mysqli_connect("localhost", "root", "", "musteriler");

// Formdan gelen veriler
$adi = $_POST['adi'];
$soyadi = $_POST['soyadi'];
$telefon = $_POST['telefon'];
$eposta = $_POST['eposta'];
$adres = $_POST['adres'];
$semt = $_POST['semt'];
$sehir = $_POST['sehir'];
$puan = $_POST['puan'];

// EKLEME (küçük harflerle yazıldı!)
$sql = "INSERT INTO musteri (adi, soyadi, telefon, eposta, adres, semt, sehir, puan) 
        VALUES ('$adi', '$soyadi', '$telefon', '$eposta', '$adres', '$semt', '$sehir', '$puan')";
mysqli_query($baglan, $sql);

// LİSTELEME
mysqli_set_charset($baglan, "utf8");
$sonuc = mysqli_query($baglan, "SELECT * FROM musteri");

echo "<table border=1 cellpadding=5 cellspacing=0>";
echo "<tr>
        <th>ID</th>
        <th>Ad</th>
        <th>Soyad</th>
        <th>Telefon</th>
        <th>E-Posta</th>
        <th>Adres</th>
        <th>Semt</th>
        <th>Şehir</th>
        <th>Puan</th>
      </tr>";

while ($satir = mysqli_fetch_array($sonuc)) {
    echo "<tr>";
    echo "<td>".$satir['musteriID']."</td>";
    echo "<td>".$satir['adi']."</td>";
    echo "<td>".$satir['soyadi']."</td>";
    echo "<td>".$satir['telefon']."</td>";
    echo "<td>".$satir['eposta']."</td>";
    echo "<td>".$satir['adres']."</td>";
    echo "<td>".$satir['semt']."</td>";
    echo "<td>".$satir['sehir']."</td>";
    echo "<td>".$satir['puan']."</td>";
    echo "</tr>";
}
echo "</table>";
?>
