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
$recordSet = mysql_query("SELECT * FROM spot WHERE spot_boolean = 1 AND spot_id = '$id'", $db);
$data = mysql_fetch_assoc($recordSet);

//写真
$recordSetPhoto = mysql_query("SELECT * FROM photo WHERE photo_boolean = 1 AND spot_id='$id'", $db);



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
	
	<!--カルーセルスライダーslick-->
	<link rel="stylesheet" type="text/css" href="slick/slick.css"/>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="slick/slick.min.js"></script>
	<script>
		$(function(){
			$('.slick').slick({
				dots : true,
				slidesToShow: 2,
				slidesToScroll:2,
				autoplay:true,
				autoplaySpeed:10000,
			});
		});
	</script>

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
		<li><a href="../kiso_guide_modify2015"><span class="glyphicon glyphicon-home"></span>ホーム</a></li>
		<li><a href="spot_movie.php?id=<?php echo $id; ?>"><span class="glyphicon glyphicon-facetime-video">動画</a></li>
		<li class="active"><a href="spot_photo.php?id=<?php echo $id; ?>"><span class="glyphicon glyphicon-camera">写真</a></li>
		<li><a href="javascript:location.reload(true);" data-role="button" data-icon="refresh"><span class="glyphicon glyphicon-repeat">更新</a></li>
	</ul>
	<br /><br />	

	<div class="slick">
		 <?php
		 	while($photo_data = mysql_fetch_assoc($recordSetPhoto)){
		 ?>
		 		<div >
		 			<h3 class = "text-center"><?php echo $photo_data['photo_title'];?></h3><br />
		 			<div id="slickimg"><img src="photos/<?php echo $photo_data['photo_url'];?>.jpg" width = 100% class="img-responsive"></div><br />
					<h4 class="text-center"><?php echo $photo_data['photo_text'];?></h4>
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
