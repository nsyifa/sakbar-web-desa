<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2025-01-14 10:27:29 --> Query error: Duplicate entry '1-2025-01-14' for key 'sys_traffic.config_idTanggal' - Invalid query: INSERT INTO `sys_traffic` (`Tanggal`, `ipAddress`, `Jumlah`, `config_id`) VALUES ('2025-01-14', '{\"ip_address\":[\"127.0.0.1\"]}', 1, 1)
ERROR - 2025-01-14 11:12:53 --> 404 Page Not Found: 
ERROR - 2025-01-14 11:12:59 --> 404 Page Not Found: 
ERROR - 2025-01-14 12:03:46 --> 404 Page Not Found: 
ERROR - 2025-01-14 12:15:38 --> 404 Page Not Found: 
ERROR - 2025-01-14 12:16:19 --> 404 Page Not Found: fweb/Profil/index
ERROR - 2025-01-14 12:17:12 --> 404 Page Not Found: fweb/Profil/index
ERROR - 2025-01-14 12:19:50 --> 404 Page Not Found: fweb/Profil/index
ERROR - 2025-01-14 20:35:30 --> GuzzleHttp\Exception\ConnectException: cURL error 6: Could not resolve host: pantau.opensid.my.id (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://pantau.opensid.my.id/api/track/desa?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6bnVsbCwidGltZXN0YW1wIjoxNjAzNDY2MjM5fQ.HVCNnMLokF2tgHwjQhSIYo6-2GNXB4-Kf28FSIeXnZw in C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\vendor\guzzlehttp\guzzle\src\Handler\CurlFactory.php:275
Stack trace:
#0 C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\vendor\guzzlehttp\guzzle\src\Handler\CurlFactory.php(205): GuzzleHttp\Handler\CurlFactory::createRejection(Object(GuzzleHttp\Handler\EasyHandle), Array)
#1 C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\vendor\guzzlehttp\guzzle\src\Handler\CurlFactory.php(157): GuzzleHttp\Handler\CurlFactory::finishError(Object(GuzzleHttp\Handler\CurlHandler), Object(GuzzleHttp\Handler\EasyHandle), Object(GuzzleHttp\Handler\CurlFactory))
#2 C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\vendor\guzzlehttp\guzzle\src\Handler\CurlHandler.php(47): GuzzleHttp\Handler\CurlFactory::finish(Object(GuzzleHttp\Handler\CurlHandler), Object(GuzzleHttp\Handler\EasyHandle), Object(GuzzleHttp\Handler\CurlFactory))
#3 C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\vendor\guzzlehttp\guzzle\src\Handler\Proxy.php(28): GuzzleHttp\Handler\CurlHandler->__invoke(Object(GuzzleHttp\Psr7\Request), Array)
#4 C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\vendor\guzzlehttp\guzzle\src\Handler\Proxy.php(48): GuzzleHttp\Handler\Proxy::GuzzleHttp\Handler\{closure}(Object(GuzzleHttp\Psr7\Request), Array)
#5 C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\vendor\guzzlehttp\guzzle\src\PrepareBodyMiddleware.php(64): GuzzleHttp\Handler\Proxy::GuzzleHttp\Handler\{closure}(Object(GuzzleHttp\Psr7\Request), Array)
#6 C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\vendor\guzzlehttp\guzzle\src\Middleware.php(31): GuzzleHttp\PrepareBodyMiddleware->__invoke(Object(GuzzleHttp\Psr7\Request), Array)
#7 C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\vendor\guzzlehttp\guzzle\src\RedirectMiddleware.php(71): GuzzleHttp\Middleware::GuzzleHttp\{closure}(Object(GuzzleHttp\Psr7\Request), Array)
#8 C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\vendor\guzzlehttp\guzzle\src\Middleware.php(66): GuzzleHttp\RedirectMiddleware->__invoke(Object(GuzzleHttp\Psr7\Request), Array)
#9 C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\vendor\guzzlehttp\guzzle\src\HandlerStack.php(75): GuzzleHttp\Middleware::GuzzleHttp\{closure}(Object(GuzzleHttp\Psr7\Request), Array)
#10 C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\vendor\guzzlehttp\guzzle\src\Client.php(333): GuzzleHttp\HandlerStack->__invoke(Object(GuzzleHttp\Psr7\Request), Array)
#11 C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\vendor\guzzlehttp\guzzle\src\Client.php(169): GuzzleHttp\Client->transfer(Object(GuzzleHttp\Psr7\Request), Array)
#12 C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\vendor\guzzlehttp\guzzle\src\Client.php(189): GuzzleHttp\Client->requestAsync('POST', Object(GuzzleHttp\Psr7\Uri), Array)
#13 C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\vendor\guzzlehttp\guzzle\src\ClientTrait.php(95): GuzzleHttp\Client->request('POST', 'https://pantau....', Array)
#14 C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\donjo-app\helpers\opensid_helper.php(275): GuzzleHttp\Client->post('https://pantau....', Array)
#15 C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\donjo-app\models\Track_model.php(136): httpPost('https://pantau....', Array)
#16 C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\donjo-app\models\Track_model.php(65): Track_model->kirim_data()
#17 C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\donjo-app\controllers\First.php(119): Track_model->track_desa('first')
#18 C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\vendor\codeigniter\framework\system\core\CodeIgniter.php(533): First->index()
#19 C:\laragon\www\OpenSID-2501.0.0\OpenSID-2501.0.0\index.php(284): require_once('C:\\laragon\\www\\...')
#20 {main}
ERROR - 2025-01-14 23:20:23 --> 404 Page Not Found: Halaman_baru/index
ERROR - 2025-01-14 23:21:15 --> 404 Page Not Found: Halaman_baru/index
ERROR - 2025-01-14 23:22:38 --> 404 Page Not Found: Halaman_baru/index
ERROR - 2025-01-14 23:22:47 --> 404 Page Not Found: Halaman_baru/index
ERROR - 2025-01-14 23:53:43 --> 404 Page Not Found: Halaman_baru/index
ERROR - 2025-01-14 23:54:36 --> 404 Page Not Found: Halaman_baru/index
