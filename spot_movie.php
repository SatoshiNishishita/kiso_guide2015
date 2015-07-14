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

//index.phpからIDを受け取る
$id = $_GET['id'];

//受け取ったspot_idを参照してスポットの情報を受け取る
$recordSet = mysql_query("SELECT * FROM spot WHERE spot_id = '$id'", $db);
$data = mysql_fetch_assoc($recordSet);

//動画
$recordSetMovie = mysql_query("SELECT * FROM movie WHERE spot_id='$id'", $db);



?>


<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>木曽三川公園センター</title>
	
	<!-- Bootstrap-->
	<meta name="viewport" content="initial-scale=1.0, user-scale=no" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!-- CSS-->
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
<br />
<br />

<div class="container">
	
	<ul class="nav nav-pills nav-justified">
		<li><a href="../kiso_guide2015"><span class="glyphicon glyphicon-home"></span>ホーム</a></li>
		<li class="active"><a href="spot_movie.php?id=<?php echo $id; ?>"><span class="glyphicon glyphicon-facetime-video">動画</a></li>
		<li><a href="spot_photo.php?id=<?php echo $id; ?>"><span class="glyphicon glyphicon-camera">写真</a></li>
		<li><a href="javascript:location.reload(true);" data-role="button" data-icon="refresh"><span class="glyphicon glyphicon-repeat">更新</a></li>
	</ul>
	<br /><br />	

	<!--グリッドレイアウト2段組-->
	<div class="text-center">
		<?php
			while($movie_data = mysql_fetch_assoc($recordSetMovie)){
		?>
			<div id="left">
				<div class="col-xs-6">
					<h3><?php echo $movie_data['movie_title'];?></h3><br /><br />
					<div id="movie"><video src="movies/<?php echo $movie_data['movie_url'];?>.mp4" poster= "photos/<?php echo $movie_data['video_img']?>.png"width="100%" controls preload="none"></div><br /><br />
					<h4><?php echo $movie_data['movie_text'];?></h4>
					
				</div>
			</div>
			
			<div id="right">
				<div class="col-xs-6">
					<?php $movie_data=mysql_fetch_assoc($recordSetMovie); ?>
					<h3><?php echo $movie_data['movie_title'];?></h3><br /><br />
					<div id="movie"><video src="movies/<?php echo $movie_data['movie_url'];?>.mp4" poster= "photos/<?php echo $movie_data['video_img']?>.png"width="100%" controls preload="none"></div><br /><br />
					<h4><?php echo $movie_data['movie_text'];?></h4>

					
				</div>
			</div>
			
		<?php
			}
		?>
		
	</div>	
	
</div>

<footer>
</footer>

<script>
</script>


</body>
</html>
