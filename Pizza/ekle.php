<?php
$baglan = mysqli_connect("localhost", "root", "", "musteriler");

// uploads klasörü kontrolü
$upload_klasoru = __DIR__ . "/uploads/";
if (!is_dir($upload_klasoru)) {
    mkdir($upload_klasoru, 0777, true); // klasör yoksa oluştur
}

// Formdan gelen veriler
$urunAdi = $_POST['urunAdi'];
$fiyat = $_POST['fiyat'];
$aciklama = $_POST['aciklama'];

// Dosya işlemleri
$resim = $_FILES['resim']['name'];
$tmp_name = $_FILES['resim']['tmp_name'];

// Benzersiz dosya adı
$benzersiz_ad = uniqid() . "_" . basename($resim);
$hedef_yol = $upload_klasoru . $benzersiz_ad;

if (move_uploaded_file($tmp_name, $hedef_yol)) {
    // Veritabanına kayıt
    $sql = "INSERT INTO urun (urunAdi, fiyat, aciklama, resim) 
            VALUES ('$urunAdi', '$fiyat', '$aciklama', '$benzersiz_ad')";
    mysqli_query($baglan, $sql);
} else {
    echo "❌ Dosya yüklenemedi!";
    exit;
}

// Listeleme
mysqli_set_charset($baglan, "utf8");
$sonuc = mysqli_query($baglan, "SELECT * FROM urun");

echo "<table border=1>";
echo "<tr><th>ID</th><th>Adı</th><th>Fiyat</th><th>Açıklama</th><th>Resim</th></tr>";
while ($satir = mysqli_fetch_array($sonuc)) {
    echo "<tr>";
    echo "<td>" . $satir['urunID'] . "</td>";
    echo "<td>" . $satir['urunAdi'] . "</td>";
    echo "<td>" . $satir['fiyat'] . "</td>";
    echo "<td>" . $satir['aciklama'] . "</td>";
    echo "<td><img src='uploads/" . $satir['resim'] . "' width='50'></td>";
    echo "</tr>";
}
echo "</table>";
?>
