
<div id="content">
		<!--
		$data['id'] 		= $news->id;
		$data['title'] 		= $news->title;
		$data['description']= $news->description;
		$data['content'] 	= $news->content;
		$data['imgurl'] 	= urldecode($news->imgurl);
		$data['category'] 	= $news->category;
		$data['reporter'] 	= $news->reporter;
		$data['newsdate'] 	= $news->newsdate;
		-->
		
	<div class="date"><?php echo $newsdate?></div>
<h2></h2>
<h1><?php echo $title ?></h1>
<div class="reporter">
<?php 
echo $reporter;
?>
</div>
<p><img src="<?php echo $imgurl ?>" width="200">
<?php echo $content ?>

</p>
<div class="share" style="
	font-size: 13px;
	background-color: #ff9;
	border: 1px solid #cc9;
	margin: 12px 0 0 0;
	padding: 6px;
	clear: both;">
<h4 style="margin: 0 0 3px 0; padding: 0;">Share Artikel :</h4>
<a href="#">Twitter</a> | 
<a href="#">Email</a>
</div>





<h4>Baca Juga : </h4>
<ul>
	<li><a href="http://news.nurmuhammad.tv/read/2012/04/17/berita-1">berita-1</a></li>
	<li><a href="http://news.nurmuhammad.tv/read/2012/04/16/berita-2">berita-2</a></li>
	<li><a href="http://news.nurmuhammad.tv/read/2012/04/16/berita-3">berita-3</a></li>
</ul>
<hr noshade="" size="1">
	
	<strong>Belum ada komentar yang masuk</strong>	<ul>
		<li>
			<a href="http://news.nurmuhammad.tv/comment/2012/04/17/140958/1894365/4/ini-alasan-utama-pengusaha-bernafsu-punya-jet-pribadi">Baca Komentar
			</a> (0)
		</li>
		<li>
			<a href="http://news.nurmuhammad.tv/comment/form/2012/04/17/140958/1894365/4/ini-alasan-utama-pengusaha-bernafsu-punya-jet-pribadi">Kirim Komentar
			</a>
		</li>
	</ul>
	
	<br>
	<div class="paging">
		<?php echo $link_back ?>
	</div>
	</div>
	
