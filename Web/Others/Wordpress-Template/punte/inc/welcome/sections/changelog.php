<?php
/**
* Changelog
*/
?>
<div class="featured-section changelog">
<?php
WP_Filesystem();
global $wp_filesystem;
$punte_changelog     		= $wp_filesystem->get_contents( get_template_directory() . '/changelog.txt' );
$changelog_start 			= strpos($punte_changelog,'== Changelog ==');
$punte_changelog_before 	= substr($punte_changelog,0,($changelog_start));
$punte_changelog 			= str_replace($punte_changelog_before,'',$punte_changelog);
$punte_changelog 			= str_replace('== Changelog ==','<h2>== Changelog ==</h2>',$punte_changelog);
$punte_changelog 			= str_replace('*','<br/>*',$punte_changelog);
$punte_changelog 			= str_replace('== 1.0','<br/><br/>== 1.0',$punte_changelog);
$punte_changelog 			= str_replace('== 1.1','<br/><br/>== 1.1',$punte_changelog);
$punte_changelog 			= str_replace('== 1.2','<br/><br/>== 1.2',$punte_changelog);
echo ''.wp_kses_post($punte_changelog);
echo '<hr />';
?>
</div>