<?php
/**
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'wpa_gourmet-artist');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', '8oT.3a71B');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '9al-{>h~B$wa1B]<uvn=afP*EUjEk7K4MsDlm_%:>9,R3/^OF1XG2|.FI,:u: OD');
define('SECURE_AUTH_KEY', 'a.7.bGAQA~(2%x=rHnQnOLD>=]5LMV-rwAJ@B-c[#lg-<Uv} Ulkjl8{1!gk]ilK');
define('LOGGED_IN_KEY', '`6>(1d+#E0HY1QP%o:3^0Xti4ly.`Qh@ D<Hn2RM`@W{e1]v5.qC>6,&X/l]U*%#');
define('NONCE_KEY', '6}6K_B4-|TRAuXvSK^zT97FjY*/N!Dl?kk.V2GhjXQ|edx9#S1.h26s(a$ti%QB:');
define('AUTH_SALT', 'n$IUtRLs0;mB+=3uV)nQ1bKYF-^jm4a.*8-)h}bj;V&+(+z._|z=GP~6B.f$Q?B4');
define('SECURE_AUTH_SALT', '_|pGJ:Zht-Wn%A|hDBQW4K1gIF<]hX12W^|sV:Z#2!PX}C2uFFpAkQ!KY>gpKrlR');
define('LOGGED_IN_SALT', ',K60E4Ad}X$+<Y[D:q7{J4^4,y|pi,!g0AQ (^&Wv3 TCg>t4vC?& di#Z7x@c,4');
define('NONCE_SALT', '9<,++kqf14g%fzu@XENiLb^m.8e2S1~POB Y=kRx99,xw*51mZOR_Zx(eF4TI4hr');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'ga_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', true);
/* Habilita o inhabilita de forma general varios tipos de actualizaciones */
define ('WP_AUTO_UPDATE_CORE', true);
/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
