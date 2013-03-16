<?php
require dirname(__FILE__).'/system/ham.php';

$streak = new streak('index');

$streak->route('/', function($streak) {
	require dirname(__FILE__).'/system/markdown.php';
	require dirname(__FILE__).'/system/config.php';
	$posts = array_reverse(glob($streak_config["streak_post_directory"].'*.'.$streak_config["streak_post_extension"]));
	$posts_detail = [];
	foreach($posts as $post) {
		$date = substr(basename($post, '.'.$streak_config['streak_post_extension']), 0,10);
		$slug = substr(basename($post, '.'.$streak_config['streak_post_extension']), 11);
		$title = substr(explode("\n", file_get_contents($post))[0],1); 
		$post_content = substr(rtrim(strip_tags(Markdown(implode("\n", array_slice(explode("\n", file_get_contents($post)), 1))))),0,$streak_config['streak_post_preview_length']-3);
		array_push($posts_detail, [
			"date" => $date,
			"slug" => $slug,
			"title" => $title,
			"post_content" => $post_content,
			"link" => $streak_config["streak_url"].$streak_config["streak_url_prefix"].str_replace("-","/",$date).'/'.$slug,
		]);
	}
	return $streak->render('home.html', [
		"streak_blog_author" => $streak_config["streak_blog_author"],
		"streak_blog_name" => $streak_config["streak_blog_name"],
		"streak_blog_description" => $streak_config["streak_blog_description"],
		"streak_url" => $streak_config["streak_url"],
		"streak_url_prefix" => $streak_config["streak_url_prefix"],
		"streak_disqus_id" => $streak_config["streak_disqus_id"],
		"posts" => $posts_detail,
	]);
});
$streak->route('/<int>/<int>/<int>/<string>', function($streak, $year,$month,$day,$slug) {
	require dirname(__FILE__).'/system/markdown.php';
	require dirname(__FILE__).'/system/config.php';
	$contents = @file_get_contents($streak_config["streak_post_directory"].$year.'-'.$month.'-'.$day.'-'.$slug.'.'.$streak_config["streak_post_extension"]);
	if($contents === FALSE) {
		return $streak->render('404.html', [
			"streak_blog_name" => $streak_config["streak_blog_name"],
			"streak_blog_description" => $streak_config["streak_blog_description"],
			"streak_url" => $streak_config["streak_url"],
			"streak_url_prefix" => $streak_config["streak_url_prefix"],
		]);
	}
	else {
		$date = $year.'-'.$month.'-'.$day;
		$title = substr(explode("\n", $contents)[0],1); 
		$post_content = $streak_config["streak_enable_markdown"]?Markdown(implode("\n", array_slice(explode("\n", $contents), 1))):implode("\n", array_slice(explode("\n", $contents), 1));
		return $streak->render('post.html', [
			"streak_blog_author" => $streak_config["streak_blog_author"],
			"streak_blog_name" => $streak_config["streak_blog_name"],
			"streak_blog_description" => $streak_config["streak_blog_description"],
			"streak_url" => $streak_config["streak_url"],
			"streak_url_prefix" => $streak_config["streak_url_prefix"],
			"streak_disqus_id" => $streak_config["streak_disqus_id"],
			"date" => $date,
			"title" => $title,
			"post_content" => $post_content,
		]);
	}
});
$streak->route('/<int>/<int>/<int>/', function($streak, $year,$month,$day) {
	require dirname(__FILE__).'/system/markdown.php';
	require dirname(__FILE__).'/system/config.php';
	$posts = array_reverse(glob($streak_config["streak_post_directory"].'*.'.$streak_config["streak_post_extension"]));
	$posts_detail = [];
	foreach($posts as $post) {
		$date = substr(basename($post, '.'.$streak_config['streak_post_extension']), 0,10);
		if($date===($year.'-'.$month.'-'.$day)) {
			$slug = substr(basename($post, '.'.$streak_config['streak_post_extension']), 11);
			$title = substr(explode("\n", file_get_contents($post))[0],1); 
			$post_content = substr(rtrim(strip_tags(Markdown(implode("\n", array_slice(explode("\n", file_get_contents($post)), 1))))),0,$streak_config['streak_post_preview_length']-3);
			array_push($posts_detail, [
				"date" => $date,
				"slug" => $slug,
				"title" => $title,
				"post_content" => $post_content,
				"link" => $streak_config["streak_url"].$streak_config["streak_url_prefix"].str_replace("-","/",$date).'/'.$slug,
			]);
		}
	}
	if(sizeof($posts_detail)==0) {
		return $streak->render('404.html', [
			"streak_blog_name" => $streak_config["streak_blog_name"],
			"streak_blog_description" => $streak_config["streak_blog_description"],
			"streak_url" => $streak_config["streak_url"],
			"streak_url_prefix" => $streak_config["streak_url_prefix"],
		]);
	}
	return $streak->render('home.html', [
		"streak_blog_author" => $streak_config["streak_blog_author"],
		"streak_blog_name" => $streak_config["streak_blog_name"],
		"streak_blog_description" => $streak_config["streak_blog_description"],
		"streak_url" => $streak_config["streak_url"],
		"streak_url_prefix" => $streak_config["streak_url_prefix"],
		"streak_disqus_id" => $streak_config["streak_disqus_id"],
		"posts" => $posts_detail,
	]);
});
$streak->route('/<int>/<int>/', function($streak, $year,$month) {
	require dirname(__FILE__).'/system/markdown.php';
	require dirname(__FILE__).'/system/config.php';
	$posts = array_reverse(glob($streak_config["streak_post_directory"].'*.'.$streak_config["streak_post_extension"]));
	$posts_detail = [];
	foreach($posts as $post) {
		$date = substr(basename($post, '.'.$streak_config['streak_post_extension']), 0,7);
		$actualdate = substr(basename($post, '.'.$streak_config['streak_post_extension']), 0,10);
		if($date===($year.'-'.$month)) {
			$slug = substr(basename($post, '.'.$streak_config['streak_post_extension']), 11);
			$title = substr(explode("\n", file_get_contents($post))[0],1); 
			$post_content = substr(rtrim(strip_tags(Markdown(implode("\n", array_slice(explode("\n", file_get_contents($post)), 1))))),0,$streak_config['streak_post_preview_length']-3);
			array_push($posts_detail, [
				"date" => $actualdate,
				"slug" => $slug,
				"title" => $title,
				"post_content" => $post_content,
				"link" => $streak_config["streak_url"].$streak_config["streak_url_prefix"].str_replace("-","/",$actualdate).'/'.$slug,
			]);
		}
	}
	if(sizeof($posts_detail)==0) {
		return $streak->render('404.html', [
			"streak_blog_name" => $streak_config["streak_blog_name"],
			"streak_blog_description" => $streak_config["streak_blog_description"],
			"streak_url" => $streak_config["streak_url"],
			"streak_url_prefix" => $streak_config["streak_url_prefix"],
		]);
	}
	return $streak->render('home.html', [
		"streak_blog_author" => $streak_config["streak_blog_author"],
		"streak_blog_name" => $streak_config["streak_blog_name"],
		"streak_blog_description" => $streak_config["streak_blog_description"],
		"streak_url" => $streak_config["streak_url"],
		"streak_url_prefix" => $streak_config["streak_url_prefix"],
		"streak_disqus_id" => $streak_config["streak_disqus_id"],
		"posts" => $posts_detail,
	]);
});
$streak->route('/<int>/', function($streak, $year) {
	require dirname(__FILE__).'/system/markdown.php';
	require dirname(__FILE__).'/system/config.php';
	$posts = array_reverse(glob($streak_config["streak_post_directory"].'*.'.$streak_config["streak_post_extension"]));
	$posts_detail = [];
	foreach($posts as $post) {
		$date = substr(basename($post, '.'.$streak_config['streak_post_extension']), 0,4);
		$actualdate = substr(basename($post, '.'.$streak_config['streak_post_extension']), 0,10);
		if($date===($year)) {
			$slug = substr(basename($post, '.'.$streak_config['streak_post_extension']), 11);
			$title = substr(explode("\n", file_get_contents($post))[0],1); 
			$post_content = substr(rtrim(strip_tags(Markdown(implode("\n", array_slice(explode("\n", file_get_contents($post)), 1))))),0,$streak_config['streak_post_preview_length']-3);
			array_push($posts_detail, [
				"date" => $actualdate,
				"slug" => $slug,
				"title" => $title,
				"post_content" => $post_content,
				"link" => $streak_config["streak_url"].$streak_config["streak_url_prefix"].str_replace("-","/",$actualdate).'/'.$slug,
			]);
		}
	}
	if(sizeof($posts_detail)==0) {
		return $streak->render('404.html', [
			"streak_blog_name" => $streak_config["streak_blog_name"],
			"streak_blog_description" => $streak_config["streak_blog_description"],
			"streak_url" => $streak_config["streak_url"],
			"streak_url_prefix" => $streak_config["streak_url_prefix"],
		]);
	}
	return $streak->render('home.html', [
		"streak_blog_author" => $streak_config["streak_blog_author"],
		"streak_blog_name" => $streak_config["streak_blog_name"],
		"streak_blog_description" => $streak_config["streak_blog_description"],
		"streak_url" => $streak_config["streak_url"],
		"streak_url_prefix" => $streak_config["streak_url_prefix"],
		"streak_disqus_id" => $streak_config["streak_disqus_id"],
		"posts" => $posts_detail,
	]);
});
//add custom routes for your own pages
$streak->run();

?>
