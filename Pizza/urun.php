
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ürün Ekle</title>
     <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <h2>Ürün Ekle</h2>
    <form action="ekle.php" method="post" enctype="multipart/form-data">
        <label>Ürün Adı: <input type="text" name="urunAdi" required></label><br><br>
        <label>Fiyat: <input type="number" step="0.01" name="fiyat" required></label><br><br>
        <label>Açıklama:<br>
            <textarea name="aciklama" rows="5" cols="30"></textarea>
        </label><br><br>
        <label>Resim: <input type="file" name="resim" accept="image/*"></label><br><br>
        <input type="submit" value="Kaydet">
    </form>
</body>
</html>
