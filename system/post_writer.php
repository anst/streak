<?php
if(PHP_SAPI=="cli") { //check if it's run from the CLI!
	include("config.php");
	echo "-----------------------------------------\n";
	echo "  ####  ##### #####  ######   ##   #    #\n"; 
	echo " #        #   #    # #       #  #  #   # \n"; 
	echo "  ####    #   #    # #####  #    # ####  \n"; 
	echo "      #   #   #####  #      ###### #  #  \n"; 
	echo " #    #   #   #   #  #      #    # #   # \n"; 
	echo "  ####    #   #    # ###### #    # #    #\n";
	echo "-----------------------------------------\n";
	echo "Welcome to the post writer! What shall we call your new post? ";
	$post_title = trim(fgets(STDIN));
	$slug = preg_replace("/[\/_|+ -]+/", '-', strtolower(trim(preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $post_title), '-')));
	$file_to_write = @date('Y-m-d').'-'.$slug.'.'.$streak_config["streak_post_extension"];
	$file_stream = fopen('../'.$streak_config["streak_post_directory"].$file_to_write, 'w') or die("can't open file");
	fwrite($file_stream, '@'.$post_title.'\n');
	fclose($file_stream);
	echo "Created post! Open it up and start writing!\n-----------------------------------------\n\n";
}
else {
	header("Location: /404");
}
?>