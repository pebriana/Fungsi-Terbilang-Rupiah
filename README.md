# Fungsi Terbilang Rupiah

 
Copy File `Terbilang.php` ke folder `components`.

Contoh penggunaan dalam coding php (YII Framework)
```php
	    Yii::import("application.components.Terbilang");
	    $nilai = 1500000;
	    $terbilang = new Terbilang();
	    echo $terbilang->rupiah(intval($nilai));
```
Outputnya `satu juta lima ratus ribu rupiah`.
