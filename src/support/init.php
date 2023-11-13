<?php
     // Definido constantes de ambiente para o Projeto
	define('DOC_ROOT', getenv("DOCUMENT_ROOT"));
	define('SITE_ROOT', "/");
	
	define('SUP_DIR', SITE_ROOT."support/");
    define('DBO_DIR', SITE_ROOT."database/");
	define('CSS_DIR', SITE_ROOT."css/");
	define('JS_DIR', SITE_ROOT."js/");
	define('IMG_DIR', SITE_ROOT."images/");
	define('TPL_DIR', SITE_ROOT."templates/");
	define('ACT_DIR', SITE_ROOT."action/");
	define('JS_DIR', DOC_ROOT.SITE_ROOT."js/");
	define('IMP_DIR', DOC_ROOT.SITE_ROOT."files/");

	define("PROJETO","Sistema de Gestão de equipamentos Médicos");

    // Definindo o "Timezone", para que as comparações de data ocorram corretamente
	date_default_timezone_set("Europe/Lisbon");
?>