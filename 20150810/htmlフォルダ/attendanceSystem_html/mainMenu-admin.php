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
		<link rel="stylesheet" href="./jquery-ui.css">
		<script src="./jquery-1.11.3.min.js"></script>
		<script src="./jquery-ui.js"></script>
		<script>
		jQuery( function() {
	   		jQuery( '#jquery-ui-tabs' ) . tabs( {
	        	active: 1,
	    	} );
		} );

		jQuery( function() {
		    jQuery( '#jquery-ui-dialog-opener' ) . click( function() {
		        jQuery( '#jquery-ui-dialog' ) . dialog( 'open' );
		    } );
		    var name = jQuery( '#jquery-ui-dialog-form-name' );
		    var hour = jQuery( '#jquery-ui-dialog-form-hour' );
		    var minute = jQuery( '#jquery-ui-dialog-form-minute' );
		    var endhour = jQuery( '#jquery-ui-dialog-form-endhour' );
		    var endminute = jQuery( '#jquery-ui-dialog-form-endminute' );
		    jQuery( '#jquery-ui-dialog' ) . dialog( {
		        autoOpen: false,
		        width: 350,
		        show: 'explode',
		        hide: 'explode',
		        modal: true,
		        buttons: {
		            '登録': function() {
		                if ( name . val() || hour . val() ) {
		                    jQuery( 'div#work' ) . after(
		                        '<div id="work"><span id="change">' + name . val() +
		                        '</span> ' + hour . val() +
		                        ':' + minute . val() + '~' + endhour . val() +
		                        ':' + endminute . val() + '</div>'
		                    );
		                    jQuery( this ).dialog( 'close' );
		                }
		                jQuery( this ) . dialog( 'close' );
		            },
		            'キャンセル': function() {
		                jQuery( this ) . dialog( 'close' );
		            },
		        }
		    } );
		} );

		jQuery( function() {
		    jQuery( 'span#change' ) . click( function() {
		        jQuery( '#jquery-ui-dialog2' ) . dialog( 'open' );
		    } );
		    var hour2 = jQuery( '#jquery-ui-dialog-form-hour2' );
		    var minute2 = jQuery( '#jquery-ui-dialog-form-minute2' );
		    var endhour2 = jQuery( '#jquery-ui-dialog-form-endhour2' );
		    var endminute2 = jQuery( '#jquery-ui-dialog-form-endminute2' );
		    jQuery( '#jquery-ui-dialog2' ) . dialog( {
		        autoOpen: false,
		        width: 350,
		        show: 'explode',
		        hide: 'explode',
		        modal: true,
		        buttons: {
	            '変更': function() {
	                if ( hour2 . val() ) {
	                    jQuery( 'div#work' ) . html(
	    	                '<span id="change">神田太郎</span> ' +
	    	                hour2 . val() + ':' + minute2 . val() +
	    	                '~' + endhour2 . val() + ':' + endminute2 . val()
	                    );
	                    jQuery( this ).dialog( 'close' );
	                }
	                jQuery( this ) . dialog( 'close' );
	            },
	            'キャンセル': function() {
	                jQuery( this ) . dialog( 'close' );
	            },
	        }
	    } );
	} );
		</script>
		<style>
		<!--
			#jquery-ui-dialog-table {
		    	font-size: 13px;
			}

			#jquery-ui-dialog-table th , #jquery-ui-dialog-table td {
   				border: 1px solid gray;
			}

			#jquery-ui-tabs {
   				font-size: 16px;
			}
		-->
		</style>
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

				<div id="jquery-ui-tabs">
    				<ul>
        				<li><a href="#jquery-ui-tabs-1">1ヶ月</a></li>
        				<li><a href="#jquery-ui-tabs-2">2ヶ月</a></li>
        				<li><a href="#jquery-ui-tabs-3">3ヶ月</a></li>
    				</ul>
    				<div id="jquery-ui-tabs-1">

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
        						<div id="work"><span id="change">神田太郎</span>  12:00~18:00  講</div>
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
    <div id="jquery-ui-tabs-2">
        <p>タブメニュー②の内容。</p>
        <p>ページ読み込み時に、タブメニュー②の内容を表示させるように設定した。</p>
    </div>
    <div id="jquery-ui-tabs-3">
        <p>タブメニュー③の内容。</p>
    </div>
</div>
			</div>

<table id="jquery-ui-dialog-table" class="ui-widget ui-widget-content">
    <thead>
        <tr class="ui-widget-header ">
            <th id="table-th-name">名前</th>
            <th id="table-th-hour">時間</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>ALPHASIS</td>
            <td>Hellow!</td>
        </tr>
    </tbody>
</table>
<div class="jquery-ui-button">
    <button id="jquery-ui-dialog-opener">追加</button>
</div>

<div id="jquery-ui-dialog" title="勤務登録">
    <form>
    <fieldset>
        <p>
            <label for="jquery-ui-dialog-form-name">名前</label>
            <select name="jquery-ui-dialog-form-name" id="jquery-ui-dialog-form-name" class="text ui-widget-content ui-corner-all" />
            	<option value="神田太郎">神田太郎</option>
            	<option value="東京太郎">東京太郎</option>
            	<option value="秋葉流">秋葉流</option>
            </select>
        </p>

        <p>
            <label for="jquery-ui-dialog-form-hour">出勤時間</label>
            <select name="jquery-ui-dialog-form-hour" id="jquery-ui-dialog-form-hour" class="text ui-widget-content ui-corner-all" />
            	<option value="1">1</option>
            	<option value="2">2</option>
            	<option value="3">3</option>
            	<option value="4">4</option>
            </select>
   			時
   			<select name="jquery-ui-dialog-form-minute" id="jquery-ui-dialog-form-minute" class="text ui-widget-content ui-corner-all" />
            	<option value="00">00</option>
            	<option value="30">30</option>
            </select>
			 分
        </p>

        <p>
            <label for="jquery-ui-dialog-form-endhour">退勤時間</label>
            <select name="jquery-ui-dialog-form-endhour" id="jquery-ui-dialog-form-endhour" class="text ui-widget-content ui-corner-all" />
            	<option value="17">17</option>
            	<option value="18">18</option>
            	<option value="19">19</option>
            	<option value="20">20</option>
            </select>
   			時
   			<select name="jquery-ui-dialog-form-endminute" id="jquery-ui-dialog-form-endminute" class="text ui-widget-content ui-corner-all" />
            	<option value="00">00</option>
            	<option value="30">30</option>
            </select>
			 分
        </p>
    </fieldset>
    </form>
</div>

<div id="jquery-ui-dialog2" title="出勤状況確認">
    <form>
    <fieldset>
        <p>
            <label for="jquery-ui-dialog-form-hour2">出勤時間</label>
            <select name="jquery-ui-dialog-form-hour2" id="jquery-ui-dialog-form-hour2" class="text ui-widget-content ui-corner-all" />
            	<option value="1">1</option>
            	<option value="2">2</option>
            	<option value="3">3</option>
            	<option value="4">4</option>
            </select>
   			時
   			<select name="jquery-ui-dialog-form-minute2" id="jquery-ui-dialog-form-minute2" class="text ui-widget-content ui-corner-all" />
            	<option value="00">00</option>
            	<option value="30">30</option>
            </select>
			 分
        </p>

        <p>
            <label for="jquery-ui-dialog-form-endhour2">退勤時間</label>
            <select name="jquery-ui-dialog-form-endhour2" id="jquery-ui-dialog-form-endhour2" class="text ui-widget-content ui-corner-all" />
            	<option value="17">17</option>
            	<option value="18">18</option>
            	<option value="19">19</option>
            	<option value="20">20</option>
            </select>
   			時
   			<select name="jquery-ui-dialog-form-endminute2" id="jquery-ui-dialog-form-endminute2" class="text ui-widget-content ui-corner-all" />
            	<option value="00">00</option>
            	<option value="30">30</option>
            </select>
			 分
        </p>
    </fieldset>
    </form>
</div>

			<footer class="box footer">
				<p>Copyright © 2010-2015 FusionOne Co.,Ltd. All Rights Reserved.</p>
			</footer>

		</div>
	</body>
</html>
