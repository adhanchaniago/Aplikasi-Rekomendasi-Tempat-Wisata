SELECT wisata.`nama`, harga_murah, fas_banyak,pengunjung_ramai, jarak_jauh FROM wisata
INNER JOIN hasil_fuzzy ON wisata.`id` = hasil_fuzzy.`id_wisata`
WHERE harga_murah>=0 AND fas_banyak>=0 AND pengunjung_ramai>0 AND jarak_jauh>0 ORDER BY 
harga_murah AND fas_banyak AND pengunjung_ramai AND jarak_jauh DESC; 