<?php


// ** MySQL settings ** //
/** The name of the database for WordPress */
define('DB_NAME', 'sixthlie_wp6');

/** MySQL database username */
define('DB_USER', 'sixthlie_user');

/** MySQL database password */
define('DB_PASSWORD', 'Gunma014');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('AUTH_KEY',         'J]+XlRfeWg_obCB-)QMRyqs0!|nJ@gDq||`LslVQ1&&53aWxHCa,_K~DuSKTQD+3');
define('SECURE_AUTH_KEY',  'JwX[-~e{j89pj;nBHm-Mz]C6<*vz~-C#/%09Okel;B:ROXmC%U)(Y#j1jlguC1yy');
define('LOGGED_IN_KEY',    'q5OZQ+vt^R KN$%W Ub uj8~SA8[ajE[g~v(M65[!Gca-hEw^C_b=/%iSHm5 y:-');
define('NONCE_KEY',        'xtE|&J%j+A7q:g(_|Er4W97,!A#u`gr-;PqTL:-rY?stXOTOI5Z^j<tgwA2e)sM<');
define('AUTH_SALT',        '){^68/VTreQ A@%j.HL|<1s@98J2m3OyN!uZZHP.%t7EPHW(dsLzSfs2*~e~|e:n');
define('SECURE_AUTH_SALT', 'NP|/Ow#L@f#R<2[LPmjX{X@O|XEN(j,&^e4|U1Usyd1p~{qcqe01ZQENu],Pae|X');
define('LOGGED_IN_SALT',   'AqGE+z_*W|eE%x;9f4mb)q9,0K@T,+Vmk|6MFZx|cb>Ch<DKZTw|K|@|Vx)@b4_h');
define('NONCE_SALT',       'uzSZ~|S~i95PJk24dciYo2Hkc]BAK:Ifms2erKIs% rsbjgo(+mZy,iI8vtQX=Y%');


$table_prefix = 'wp6_';


define( 'WP_HOME', 'http://thesixthlie.jp' );
define( 'WP_SITEURL', 'http://thesixthlie.jp' );
define( 'JETPACK_DEV_DEBUG', false );
define( 'WP_DEBUG', false );
define( 'FORCE_SSL_ADMIN', false );
define( 'SAVEQUERIES', false );



/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
