<?php
require dirname(__FILE__).'/system/ham.php';

$streak = new Streak('index');

$streak->route('/', function($streak) {
	require dirname(__FILE__).'/system/functions.php';
	require dirname(__FILE__).'/system/markdown.php';
	require dirname(__FILE__).'/system/config.php';
	$posts = array_reverse(glob($streak_config["streak_post_directory"].'*.'.$streak_config["streak_post_extension"]));
	foreach($posts as $post) {
		$date = substr(basename($post, '.'.$streak_config['streak_post_extension']), 0,10);
		$slug = substr(basename($post, '.'.$streak_config['streak_post_extension']), 11);
		$title = substr(explode("\n", file_get_contents($post))[0],1); 
		$post_content = Markdown(implode("\n", array_slice(explode("\n", file_get_contents($post)), 1)));
		echo '<h3>'.$title.' <i>'.$date.'</i></h3><br>'.$post_content.'';
		echo '<a href="'.$streak_config["streak_url"].$streak_config["streak_url_prefix"].str_replace("-","/",$date).'/'.$slug.'">Continue reading...</a>';
	}
});
$streak->route('/<int>/<int>/<int>/<string>', function($streak, $year,$month,$day,$slug) {
	require dirname(__FILE__).'/system/functions.php';
	require dirname(__FILE__).'/system/markdown.php';
	require dirname(__FILE__).'/system/config.php';
	$contents = @file_get_contents($streak_config["streak_post_directory"].$year.'-'.$month.'-'.$day.'-'.$slug.'.'.$streak_config["streak_post_extension"]);
	if($contents === FALSE) {
		die("IMPLEMENT 404 PAGE LOL!");
	}
	else {
		$date = $year.'-'.$month.'-'.$day;
		$title = substr(explode("\n", $contents)[0],1); 
		$post_content = Markdown(implode("\n", array_slice(explode("\n", $contents), 1)));
		echo '<h3>'.$title.' <i>'.$date.'</i></h3><br>'.$post_content.'';
	}
});
//add custom routes for your own pages
$streak->run();

?>