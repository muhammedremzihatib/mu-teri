<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Müşteri Kayıt Formu</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script>
        function formKontrol() {
            const adi = document.getElementById("adi").value.trim();
            const soyadi = document.getElementById("soyadi").value.trim();
            const telefon = document.getElementById("telefon").value.trim();
            const eposta = document.getElementById("eposta").value.trim();
            const puan = document.getElementById("puan").value.trim();

            // Ad kontrolü
            if (adi === "") {
                alert("Lütfen adınızı giriniz.");
                return false;
            }

            // Soyad kontrolü
            if (soyadi === "") {
                alert("Lütfen soyadınızı giriniz.");
                return false;
            }

            // Telefon kontrolü (sadece rakam ve en az 10 karakter)
            const telefonRegex = /^[0-9]{10,15}$/;
            if (!telefonRegex.test(telefon)) {
                alert("Lütfen geçerli bir telefon numarası giriniz (sadece rakam, en az 10 hane).");
                return false;
            }

            // E-posta kontrolü
            const epostaRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!epostaRegex.test(eposta)) {
                alert("Lütfen geçerli bir e-posta adresi giriniz.");
                return false;
            }

            // Puan negatif olamaz
            if (puan < 0) {
                alert("Puan negatif olamaz.");
                return false;
            }

            return true; // her şey doğruysa form gönderilir
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2>Müşteri Kayıt Formu</h2>
        <div class="row">
            <div class="col-md-6">
                <form action="musterikaydet.php" method="POST">
                    <label for="adi">Adı</label>
                    <input type="text" name="adi" id="adi" class="form-control" required>

                    <label for="soyadi" class="mt-2">Soyadı</label>
                    <input type="text" name="soyadi" id="soyadi" class="form-control" required>

                    <label for="telefon" class="mt-2">Telefon</label>
                    <input type="text" name="telefon" id="telefon" class="form-control" required>

                    <label for="eposta" class="mt-2">E-posta</label>
                    <input type="email" name="eposta" id="eposta" class="form-control" required>

                    <label for="adres" class="mt-2">Adres</label>
                    <input type="text" name="adres" id="adres" class="form-control">

                    <label for="semt" class="mt-2">Semt</label>
                    <input type="text" name="semt" id="semt" class="form-control">

                    <label for="sehir" class="mt-2">Şehir</label>
                    <input type="text" name="sehir" id="sehir" class="form-control">

                    <label for="puan" class="mt-2">Puan</label>
                    <input type="number" name="puan" id="puan" class="form-control" value="0" min="0">

                    <button type="submit" class="btn btn-primary mt-3">Kaydet</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
