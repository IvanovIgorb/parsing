<?php
if (file_exists('connect.php'))
	include 'connect.php'; // Подключение к БД
function create($torgNumber, $lotNumber, $link, $startPrice, $date, $status)
{
	global $pdo;
	$date = Date('Y-m-d H:i:s', strtotime($date));

	$query = $pdo->prepare("SELECT * FROM `lots` WHERE `torg_number` = ?");
	$query->execute([$torgNumber]);
	$query->setFetchMode(PDO::FETCH_ASSOC); //Устанавливаем режим выборки
	$data = $query->fetchAll();
	if (count($data) == 0) {
		$query = "INSERT INTO `lots` (`torg_number`, `lot_number`, `link`, `start_price`, `date`, `status`)
						VALUES (:torg_number, :lot_number, :link, :start_price, :date, :status)";
		$params = [
			':torg_number' => $torgNumber,
			':lot_number' => $lotNumber,
			':link' => $link,
			':start_price' => $startPrice,
			':date' => $date,
			':status' => $status
		];
		$stmt = $pdo->prepare($query);
		$stmt->execute($params);
	}

	$lot = 'Номер торгов: ' . $torgNumber . ' Номер лота: ' . $lotNumber . ' Ссылка на лот: ' . $link .
		' Начальная цена: ' . $startPrice . ' Дата проведения: ' . $date . ' Статус проведения: ' . $status;
	print($lot);
	echo '<br>';
	echo "<script charset=\"utf-8\">console.log('$lot');</script>";
}
function parsing($page)
{
	$pattern = '/<td class="gridAltColumn"[^>]*?>.+?<a[^>]*?>(.*?)<\/a>.+?<\/td>/si';
	preg_match_all($pattern, $page, $matches1);
	$pattern = '/<a id="ctl00_ctl00_MainContent_ContentPlaceHolderMiddle_PurchasesSearchResult_ctl0(5|6|8)_HyperLink2.*?href="(.*?)"[^>]*?>/us';
	preg_match_all($pattern, $page, $matches2);
	$pattern = '/<td class="columnCurrency[^>]*?>.*?([0-9].*?)<\/td>/us';
	preg_match_all($pattern, $page, $matches3);
	$pattern = '/<td class="alignCenter.*?nowrap[^>]*?>(.*?)<\/td>/us';
	preg_match_all($pattern, $page, $matches4);
	$pattern = '/<td class="gridAltColumn"[^>]*?>(.*?)<\/td>/si';
	preg_match_all($pattern, $page, $matches5);

	$matches3[1][2] = trim($matches3[1][2]); //preg_replace('/\s+/', '', $matches3[1][2]);
	$matches3[1][3] = trim($matches3[1][3]); //preg_replace('/\s+/', '', $matches3[1][3]);
	$matches3[1][5] = trim($matches3[1][5]); //preg_replace('/\s+/', '', $matches3[1][5]);

	$matches4[1][5] = preg_replace('/&#160;/', ' ', $matches4[1][5]);
	$matches4[1][7] = preg_replace('/&#160;/', ' ', $matches4[1][7]);
	$matches4[1][11] = preg_replace('/&#160;/', ' ', $matches4[1][11]);

	create($matches1[1][4], $matches1[1][5], $matches2[2][0], $matches3[1][2], $matches4[1][5], $matches5[1][10]);
	create($matches1[1][6], $matches1[1][7], $matches2[2][1], $matches3[1][3], $matches4[1][7], $matches5[1][14]);
	create($matches1[1][10], $matches1[1][11], $matches2[2][2], $matches3[1][5], $matches4[1][11], $matches5[1][22]);
}
//Первая страница
$url = 'http://www.arbitat.ru';
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$page1 = curl_exec($curl);
curl_close($curl);

parsing($page1);

//Вторая страница
$curl = curl_init($url);
curl_setopt(
	$curl,
	CURLOPT_HTTPHEADER,
		array(
	"POST",
	"Accept: */*",
	"Accept-Language: ru,en;q=0.9,en-GB;q=0.8,en-US;q=0.7",
	"Connection: keep-alive",
	"Content-Length: 0",
	"Content-Type: application/json; charset=UTF-8",
	"Cookie: __ddg1_=TEhOvzby0N5n8iaahJQ7; ASP.NET_SessionId=tgg3me0kgrsvfmkca54eyoq0; _ym_uid=167101136113241122; _ym_d=1671011361; _ym_isad=2",
	"Origin: http://www.arbitat.ru",
	"Referer: http://www.arbitat.ru/",
	"User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36 Edg/108.0.1462.46",
	"X-Requested-With: XMLHttpRequest",
	)
); 

curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$page2 = curl_exec($curl);
curl_close($curl);

parsing($page2);

//print_r($page2);
//print_r($page1);
?>