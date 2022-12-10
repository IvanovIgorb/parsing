<?php  
    $url = 'http://www.arbitat.ru';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
    $page = curl_exec($curl);

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

	echo"<script charset=\"utf-8\">console.log('$lot3');</script>";
	echo"<script charset=\"utf-8\">console.log('$lot4');</script>";
	echo"<script charset=\"utf-8\">console.log('$lot6');</script>";

    //print_r($page);
?>