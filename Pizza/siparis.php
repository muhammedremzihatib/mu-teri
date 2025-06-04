<?php
// Veritabanı bağlantısı
$baglan = mysqli_connect("localhost", "root", "", "musteriler");
mysqli_set_charset($baglan, "utf8");

if (!$baglan) {
    die("Veritabanı bağlantısı kurulamadı: " . mysqli_connect_error());
}

// Müşteriler ve ürünler sorgusu
$musteriler = mysqli_query($baglan, "SELECT musteriID, adi, soyadi FROM musteri");
$urunler = mysqli_query($baglan, "SELECT urunID, urunAdi, fiyat FROM urun");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Sipariş Ekle</title>
</head>
<body>

<h2>Sipariş Ekle</h2>

<form method="POST" action="sipariskayit.php">
    <label for="musteriID">Müşteri:</label>
    <select name="musteriID" id="musteriID" required>
        <option value="">Seçiniz</option>
        <?php while ($m = mysqli_fetch_assoc($musteriler)): ?>
            <option value="<?= $m['musteriID'] ?>"><?= htmlspecialchars($m['adi'] . ' ' . $m['soyadi']) ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <label for="urunID">Ürün:</label>
    <select name="urunID" id="urunID" required>
        <option value="">Seçiniz</option>
        <?php while ($u = mysqli_fetch_assoc($urunler)): ?>
            <option value="<?= $u['urunID'] ?>" data-fiyat="<?= $u['fiyat'] ?>">
                <?= htmlspecialchars($u['urunAdi']) ?> (<?= $u['fiyat'] ?> ₺)
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label for="adet">Adet:</label>
    <input type="number" name="adet" id="adet" min="1" value="1" required><br><br>

    <label for="fiyat">Fiyat:</label>
    <input type="number" name="fiyat" id="fiyat" step="0.01" required readonly><br><br>

    <label for="tarih">Tarih:</label>
    <input type="date" name="tarih" id="tarih" value="<?= date('Y-m-d') ?>" required><br><br>

    <input type="submit" value="Sipariş Ekle">
</form>

<script>
// Ürün seçilince fiyat alanını otomatik doldur
document.getElementById('urunID').addEventListener('change', function() {
    var fiyat = this.options[this.selectedIndex].getAttribute('data-fiyat') || 0;
    document.getElementById('fiyat').value = fiyat;
});
</script>

</body>
</html>
