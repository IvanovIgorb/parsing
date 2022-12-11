<?php
	function parsing($page){
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
		$matches3[1][2] = preg_replace('/\s+/', '', $matches3[1][2]);
		$matches3[1][3] = preg_replace('/\s+/', '', $matches3[1][3]);
		$matches3[1][5] = preg_replace('/\s+/', '', $matches3[1][5]);
	
		$lot3 = 'Номер торгов: ' . $matches1[1][4] . ' Номер лота: ' . $matches1[1][5] . ' Ссылка на лот: ' . $matches2[2][0] .
		 ' Начальная цена: ' . $matches3[1][2] . ' Дата проведения: ' . $matches4[1][5] . ' Статус проведения: ' . $matches5[1][10];
		$lot4 = 'Номер торгов: ' . $matches1[1][6] . ' Номер лота: ' . $matches1[1][7] . ' Ссылка на лот: ' . $matches2[2][1] .
		 ' Начальная цена: ' . $matches3[1][3] . ' Дата проведения: ' . $matches4[1][7] . ' Статус проведения: ' . $matches5[1][14];
		$lot6 = 'Номер торгов: ' . $matches1[1][10] . ' Номер лота: ' . $matches1[1][11] . ' Ссылка на лот: ' . $matches2[2][2] .
		' Начальная цена: ' . $matches3[1][5] . ' Дата проведения: ' . $matches4[1][11] . ' Статус проведения: ' . $matches5[1][22];
		print($lot3);
		echo '<br>';
		print($lot4);
		echo '<br>';
		print($lot6);
		echo '<br>';
		echo '<--Конец страницы-->';
		echo '<br>';
	
		echo"<script charset=\"utf-8\">console.log('$lot3');</script>";
		echo"<script charset=\"utf-8\">console.log('$lot4');</script>";
		echo"<script charset=\"utf-8\">console.log('$lot6');</script>";
		echo"<script charset=\"utf-8\">console.log('<--Конец страницы-->');</script>";
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
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		"Accept: */*",
		"Accept-Language: ru,en;q=0.9",
		"Cache-Control: no-cache",
		"Connection: keep-alive",
		"Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
		"Cookie: __ddg1_=CUFd7KhERRlzxX3YRvW9; _ym_uid=1670529085873414345; _ym_d=1670529085; ASP.NET_SessionId=dr5vt0vvrwdald5wqzjclag4; _ym_isad=1",
		"Origin: http://www.arbitat.ru",
		"Referer: http://www.arbitat.ru/",
		"User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 YaBrowser/22.11.2.807 Yowser/2.5 Safari/537.36",
		"X-MicrosoftAjax: Delta=true",
		"X-Requested-With: XMLHttpRequest",
	));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
	$page2 = curl_exec($curl);
	curl_close($curl);

	parsing($page2);

  	//print_r($page);
  	//print_r($page1);
?>