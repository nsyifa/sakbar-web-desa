<?php
// -------------------------------------------------------------------------
//
// Letakkan username, password dan database sebetulnya di file ini.
// File ini JANGAN di-commit ke GIT. TAMBAHKAN di .gitignore
// -------------------------------------------------------------------------

// Data Konfigurasi MySQL yang disesuaikan

$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root';
$db['default']['password'] = 'eyJpdiI6ImgxZktGTkNXd1FKSWxyZ0EzN2pzOUE9PSIsInZhbHVlIjoiVDBVekU1Vk56enU0YS8vTmNRQWpMUT09IiwibWFjIjoiNGVmOTQ5N2JkOGUwNmM1NGNlYjY5MzkzM2VhOTI2Y2ZmOWRjYzZhOGViOWUzY2U3MTE3MWE2ZmJhZjU0NDU0YiIsInRhZyI6IiJ9';
$db['default']['port']     = 3306;
$db['default']['database'] = 'opensid';
$db['default']['dbcollat'] = 'utf8_general_ci';

/*
| Untuk setting koneksi database 'Strict Mode'
| Sesuaikan dengan ketentuan hosting
*/
$db['default']['stricton'] = true;