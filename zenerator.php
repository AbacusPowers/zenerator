<?php
/*
Plugin Name: Zenerator
Plugin URI: https://bitbucket.org/360zen/zenerator
Version: 1.2.0
Description: Adds portfolio projects post type and functionality to WordPress
Author: Justin Maurer
Author URI: http://360zen.com
Text Domain: zenerator
Domain Path: /languages
*/

//require CMB2 files
if ( file_exists(  __DIR__ . '/cmb2/init.php' ) ) {
    require_once  __DIR__ . '/cmb2/init.php';
}

//require CMB2 files
require_once  __DIR__ . '/post-types.php';

function zenerator_activate() {
    // register taxonomies/post types here
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'zenerator_activate' );

function zenerator_deactivate() {
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'zenerator_deactivate' );

/*************
 * UPDATES via KERNL
 *************/
require 'plugin_update_check.php';
$MyUpdateChecker = new PluginUpdateChecker_2_0 (
    'https://kernl.us/api/v1/updates/565e6863b731728f79f6a4f6/',
    __FILE__,
    'zenerator',
    1
);

/***************
PROJECT FUNCTIONS
 ***************/

function get_project_languages(){
    $languages = get_post_meta(get_the_ID(), '_zenerator_languages');

    echo '<ul>';
    foreach ($languages[0] as $language) {	?>
        <?php
        $urls = array(
            'PHP' => 'http://php.net/',
            'WordPress' => 'https://wordpress.org',
            'JavaScript' => 'https://developer.mozilla.org/en-US/docs/Web/JavaScript',
            'HTML5' => 'http://www.w3.org/html/logo/',
            'CSS3' => 'http://www.w3.org/Style/CSS/Overview.en.html',
            'jQuery' => 'https://jquery.com/',
            'Symfony2' => 'http://symfony.com/',
            'Compass' => 'http://compass-style.org/',
            'SASS' => 'http://sass-lang.com/',
            'Susy' => 'http://susy.oddbird.net/',
            'Velocity' => 'http://julian.com/research/velocity/',
            'Bootstrap' => 'http://getbootstrap.com/',
            'Twig' => 'http://twig.sensiolabs.org/',
            'Git' => 'https://git-scm.com/',
            'Grunt.js' => 'http://gruntjs.com/',
            'Gulp.js' => 'http://gulpjs.com/',
            'Composer' => 'https://getcomposer.org/',
            'Bower' => 'http://bower.io/',
            'YAML' => 'http://yaml.org/',
            'Node.js' => 'https://nodejs.org/en/',
            'NPM' =>'https://www.npmjs.com/'
        );
        ?>
        <li class="project-meta--language"><a href="<?php echo $urls[$language]; ?>" class="language-link" alt="<?php echo $language; ?>" target="_blank"><?php echo $language; ?></a></li>
    <?php }
    echo '</ul>';
}