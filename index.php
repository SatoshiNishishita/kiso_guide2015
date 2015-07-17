
<?php

//データベースに接続
require('dbconnect.php');

// MySQLとの接続をオープンにする
$db = mysql_connect($DBSERVER, $DBUSER, $DBPASSWORD) or die(mysql_error());

// データをUTF8で受け取る
mysql_query("SET NAMES UTF8");

// データベースを選択する
$selectdb = mysql_select_db($DBNAME, $db);

?>

<?php

//kiso_guideからデータを取得
$recordSet = mysql_query('SELECT * FROM spot WHERE spot_boolean=1',$db);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>木曽三川公園センター</title>
	
	<!-- Bootstrap-->
	<meta name="viewport" content="initial-scale=1.0, user-scale=no" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
	
	<!--CSS-->
	<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<br />
<div class="container">
	<div id="header">
		<div class="col-xs-2"><br />
			<img src="photos/images.png" class="img-responsive">
		</div>
		<div class="col-xs-8">
			<h1>木曽三川公園センター社会科見学ガイド</h1><br />
			<h4 id="descript">
				このウェブページを社会科見学の事前学習として利用しよう<br />
				木曽三川公園には治水の歴史を知れるスポットがいっぱいあるよ<br />
				この土地に住む人の生の声を聞いてみよう<br />
			</h4>
		</div>
		<div class="col-xs-2">
			<img src="photos/sidouin.png" class="img-responsive">
		</div>	
	</div>
</div>
<hr>
<br />
<br />
<div class="container">

	<ul class="nav nav-pills nav-justified">
		<li class="active"><a href="../kiso_guide2015"><span class="glyphicon glyphicon-home"></span>ホーム</a></li>
		<!--<li><a href="map.php"><span class="glyphicon glyphicon-th-large"></span>地図</a></li>-->
		<li><a href="javascript:location.reload(true);" data-role="button" data-icon="refresh"><span class="glyphicon glyphicon-repeat"></span>更新</a></li>
	</ul>
	
	
	<br />
	<br />	
	<br />

	<!--グリッドレイアウト2段組-->
	<div class="text-center">
	<?php
		//while文で$recordSetからデータベースの情報を一つずつ取り出す
		while($data = mysql_fetch_assoc($recordSet)){
	?>
			<div id="grid">
			<div class="col-xs-6">
			<h3><?php echo $data['spot_name'];?></h3><br /><br />
			<div class="spot_photo"><img src="photos/spot_img<?php echo $data['spot_id']; ?>.jpg"  class="img-responsive "width="100%"></div><br />
			<h4 class="text"><?php echo $data['spot_text'];?><br /><br /></h4>
			<a href="spot_movie.php?id=<?php echo $data['spot_id'];?>">このスポットについて調べる</a><br /><br />
			</div>
			</div>
		<?php
		}
	?>
			
	</div>
	
	

</div>

<footer>
</footer>

</body>
</html>