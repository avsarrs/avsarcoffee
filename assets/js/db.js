const initialData = {
    "urunler": [
        {
            "id": 1,
            "isim": "Klasik Espresso",
            "fiyat": "45.00",
            "kategori": "Sıcak Kahveler",
            "aciklama": "Yoğun ve zengin aromalı geleneksel İtalyan espressosu.",
            "gorsel": "assets/images/home-coffee/menu/menu-img1.jpg"
        },
        {
            "id": 2,
            "isim": "Flat White",
            "fiyat": "65.00",
            "kategori": "Sıcak Kahveler",
            "aciklama": "İpeksi süt köpüğü ile dengelenmiş çift shot espresso.",
            "gorsel": "assets/images/home-coffee/menu/menu-img2.jpg"
        },
        {
            "id": 3,
            "isim": "Soğuk Demleme (Cold Brew)",
            "fiyat": "75.00",
            "kategori": "Soğuk Kahveler",
            "aciklama": "12 saat boyunca soğuk suda demlenmiş ferahlatıcı kahve.",
            "gorsel": "assets/images/home-coffee/blog/blog-img1.jpg"
        }
    ],
    "ayarlar": {
        "site_basligi": "Kavruk Co. | Eşsiz Kahve Deneyimi",
        "logo_metni": "KAVRUK CO.",
        "telefon": "+90 212 123 45 67",
        "eposta": "info@kavrukco.com",
        "adres": "Kahve Sokak No:1, Beşiktaş, İstanbul"
    },
    "mesajlar": []
};

// Veritabanını başlat (Eğer yoksa)
if (!localStorage.getItem('kavruk_db')) {
    localStorage.setItem('kavruk_db', JSON.stringify(initialData));
}

const db = {
    get: function() {
        return JSON.parse(localStorage.getItem('kavruk_db'));
    },
    save: function(data) {
        localStorage.setItem('kavruk_db', JSON.stringify(data));
    }
};
