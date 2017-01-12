<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'riosulvalley');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '123');

/** nome do host do MySQL */
define('DB_HOST', 'localhost:8888');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'V9.-HC:+#/8WKOM@zB+)jTqBo>g~Q3%J`@-cbw)xvT}|gUM$@Z{~P,m1~e{E5A#h');
define('SECURE_AUTH_KEY',  'hO;|-8tMvQXBa_1nwlWUn-l.,^SoBCU39L8^Zu+Bate^g<n]J)X%!sT5HW/e 83H');
define('LOGGED_IN_KEY',    '.Z!m.1iS+^IBRC-Q&-a|8q4VF|Uo>=dvu[<8IoVc%|BZa01u>)Gc$THrqt8k%Kiu');
define('NONCE_KEY',        '-Nb%XH.JM~H+?bnS!!F]S!lQ%X>)SN;&z]@pnjq|gW_z2XHc5Cs+:gSFUfZ[;SWH');
define('AUTH_SALT',        'le/LO5*7I.V,?`XmMZ{;J,|Y_-J2PPYec))TEkJJalB, %gAsK9B}VCEnaacOyaq');
define('SECURE_AUTH_SALT', ',4{@gJeIrQ=[HU5nEXPR|2d|(-*J^UA+I/AZ(/u*B|Fmn[P2-Ix)bS,e__eU6WWk');
define('LOGGED_IN_SALT',   's1W-Tk8}MF b#w.X+<fW2u=G@xk9:DYLt^L]%wJbG#8FO)*;,f_T7SwEABP+^xg)');
define('NONCE_SALT',       '2m|{-|.Uy+U@~Ay,qhIWl(E#;~+`Ujqgfg1X3;EOFj*)s[{i u#xb5/VeQ^1)>-v');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';


/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
