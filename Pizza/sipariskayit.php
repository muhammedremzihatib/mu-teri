<?php
$baglan = mysqli_connect("localhost", "root", "", "musteriler");
mysqli_set_charset($baglan, "utf8");

if (!$baglan) {
    die("Veritabanı bağlantısı kurulamadı: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $musteriID = $_POST['musteriID'] ?? null;
    $urunID = $_POST['urunID'] ?? null;
    $adet = (int) ($_POST['adet'] ?? 0);
    $fiyat = (float) ($_POST['fiyat'] ?? 0);
    $tarih = $_POST['tarih'] ?? date('Y-m-d');
    
    if (!$musteriID || !$urunID || $adet < 1 || $fiyat <= 0) {
        die("Lütfen tüm alanları doğru şekilde doldurun.");
    }

    $toplam = $adet * $fiyat;

    // Siparişi ekle
    $sql = "INSERT INTO siparis (musteriID, urunID, adet, fiyat, toplam, tarih)
            VALUES ('$musteriID', '$urunID', '$adet', '$fiyat', '$toplam', '$tarih')";
    if (!mysqli_query($baglan, $sql)) {
        die("Sipariş eklenirken hata oluştu: " . mysqli_error($baglan));
    }
}

// Siparişleri listele
$sql = "SELECT s.tarih, m.adi, m.soyadi, m.telefon, u.urunAdi, u.resim, s.adet, s.toplam
        FROM siparis s
        JOIN musteri m ON s.musteriID = m.musteriID
        JOIN urun u ON s.urunID = u.urunID
        ORDER BY s.tarih DESC";

$sonuc = mysqli_query($baglan, $sql);
if (!$sonuc) {
    die("Sipariş listesi alınamadı: " . mysqli_error($baglan));
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Sipariş Listesi</title>
</head>
<body>

<h2>Sipariş Listesi</h2>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Tarih</th>
        <th>Ad</th>
        <th>Soyad</th>
        <th>Telefon</th>
        <th>Ürün</th>
        <th>Resim</th>
        <th>Adet</th>
        <th>Toplam (₺)</th>
    </tr>
    <?php while ($satir = mysqli_fetch_assoc($sonuc)): ?>
    <tr>
        <td><?= htmlspecialchars($satir['tarih']) ?></td>
        <td><?= htmlspecialchars($satir['adi']) ?></td>
        <td><?= htmlspecialchars($satir['soyadi']) ?></td>
        <td><?= htmlspecialchars($satir['telefon']) ?></td>
        <td><?= htmlspecialchars($satir['urunAdi']) ?></td>
        <td>
            <?php if ($satir['resim'] && file_exists("uploads/" . $satir['resim'])): ?>
                <img src="uploads/<?= htmlspecialchars($satir['resim']) ?>" width="50" alt="Ürün Resmi">
            <?php else: ?>
                Yok
            <?php endif; ?>
        </td>
        <td><?= (int)$satir['adet'] ?></td>
        <td><?= number_format($satir['toplam'], 2) ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<br><a href="siparis.php">Yeni Sipariş Ekle</a>

</body>
</html>
