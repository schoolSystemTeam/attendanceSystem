<?php

// 現在の年月を取得
$year = date('Y');
$month = date('n');
$today = date('j');

//フォントの色を黒で初期化

$fontcolor = "#000000";

// 曜日の配列作成
$weekday = array( "日", "月", "火", "水", "木", "金", "土" );

// 月末日を取得
$last_day = date('j', mktime(0, 0, 0, $month + 1, 0, $year));

$calendar = array();
$j = 0;

// 月末日までループ
for ($i = 1; $i < $last_day + 1; $i++) {

    // 曜日を取得
    $week = date('w', mktime(0, 0, 0, $month, $i, $year));

    // 1日の場合
    if ($i == 1) {

        // 1日目の曜日までをループ
        for ($s = 1; $s <= $week; $s++) {

            // 前半に空文字をセット
            $calendar[$j]['day'] = '';
            $j++;

        }

    }

    // 配列に日付をセット
    $calendar[$j]['day'] = $i;
    $j++;

    // 月末日の場合
    if ($i == $last_day) {

        // 月末日から残りをループ
        for ($e = 1; $e <= 6 - $week; $e++) {

            // 後半に空文字をセット
            $calendar[$j]['day'] = '';
            $j++;

        }

    }

}

?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="design.css">
		<link rel="stylesheet" href="content.css">
		<script src="./jquery-1.11.3.min.js"></script>
		<title>メインメニュー画面</title>
	</head>
	<body>
		<div class="container">
			<header class="box">
				<h1 class="title">勤怠管理システム</h1>
			</header>

			<div class="box width70 clearfix">
				<div class="userInfo float-left">
					<p>ユーザー名 : admin / 権限 : 管理者</p>
				</div>
				<div class="userInfo float-right">
					<p><a href="#">ログアウト</a></p>
				</div>
			</div>

			<div class="box menu"><!-- ヘッダーメニュー-->
				<ul id="dropmenu">
	 				<li><a href="#">メニュー</a>
	   			 		<ul>
	    				</ul>
	 				 </li>
	  				<li><a href="#">勤務時間表</a>
	   					<ul>
	   					</ul>
	 				</li>
	 				<li><a href="#">休日設定</a>
	    				<ul>
	   					</ul>
	 				</li>
	  				<li><a href="#">ユーザー設定</a>
	   					<ul>
     					 	<li><a href="#">パスワード変更</a></li>
	     					<li><a href="#">ユーザー設定変更</a></li>
	     					<li><a href="#">ユーザー登録</a></li>
	   					</ul>
	  				</li>
	  				<li><a href="#">休憩時間設定</a>
	   					<ul>
	   					</ul>
	  				</li>
				</ul>
			</div>

			<div class="box main-container mainMenuCalendar">

				<br>
				<br>
				<table>
				<tr>
					<th width="100%" colspan="7" style="background-color: #B3F8FA; text-align: center; font-weight: bold;">
						<a href="#">&lt;&lt;</a> &nbsp;&nbsp; <a href="#">&lt;</a> &nbsp;&nbsp;&nbsp;
						<?php echo $year; ?>年<?php echo $month; ?>月
						&nbsp;&nbsp; <a href="#">&gt;</a> &nbsp;&nbsp;&nbsp; <a href="#">&gt;&gt;</a>
					</th>
				<tr>
    			<tr>
        			<th style="color: red;">日</th>
        			<th>月</th>
        			<th>火</th>
       				 <th>水</th>
        			<th>木</th>
        			<th>金</th>
        			<th style="color: blue;">土</th>
    			</tr>

    			<tr>
    				<?php $cnt = 0; ?>
    				<?php foreach ($calendar as $key => $value): ?>

						<?php
							if($value['day'] == $today){
								$stylecolor="#EEF1F1";
							}else{
								$stylecolor="#FFFFFF";
							}
						?>
							<?php
        					if($cnt == 0){
								$fontcolor="red";
    						}else if($cnt == 6){
								$fontcolor="blue";
    						}else{
    							$fontcolor="#000000";
    						}
        					?>
					        				<td date="insert" style="background-color: <?php echo $stylecolor;?>; color:<?php echo $fontcolor;?>;">
        					<?php $cnt++; ?>

        					<div class="day-calendar">
        						<?php echo $value['day']; ?>
        					</div>
        					<?php if($value['day'] == 8){?>
        					<div class="work-calendar">
        						<a href="#" id="change">神田太郎</a>  12:00~18:00  講
        					</div>
        					<?php }?>
        				</td>

    					<?php if ($cnt == 7): ?>
    					</tr>
    					<tr>
    					<?php $cnt = 0; ?>

   					 <?php endif; ?>
    				<?php endforeach; ?>
   				 </tr>
			</table>
			</div>

			<footer class="box footer">
				<p>Copyright © 2010-2015 FusionOne Co.,Ltd. All Rights Reserved.</p>
			</footer>

		</div>
	</body>
</html>
