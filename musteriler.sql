
-- musteri tablosu
CREATE TABLE musteri (
    musteriID INT AUTO_INCREMENT PRIMARY KEY,
    adi VARCHAR(100),
    soyadi VARCHAR(100),
    telefon VARCHAR(20),
    eposta VARCHAR(100),
    adres TEXT,
    semt VARCHAR(100),
    sehir VARCHAR(100),
    puan INT
);

-- urun tablosu
CREATE TABLE urun (
    urunID INT AUTO_INCREMENT PRIMARY KEY,
    urunAdi VARCHAR(255),
    fiyat DECIMAL(10,2),
    aciklama TEXT,
    resim VARCHAR(255)
);

-- siparis tablosu
CREATE TABLE siparis (
    siparisID INT AUTO_INCREMENT PRIMARY KEY,
    musteriID INT,
    urunID INT,
    adet INT,
    fiyat DECIMAL(10,2),
    toplam DECIMAL(10,2),
    tarih DATE,
    FOREIGN KEY (musteriID) REFERENCES musteri(musteriID) ON DELETE CASCADE,
    FOREIGN KEY (urunID) REFERENCES urun(urunID) ON DELETE CASCADE
);
