<?php
	session_start();

	/* Valida sessão e redireciona usuário em caso de login inválido */
	if (!isset($_POST['utilizador']) && !isset($_SESSION['utilizadorLogado']))
		die(header('location: ' . SITE_ROOT . 'login.php'));

	/* Controle da sessão */
	$timeout = 600; // Tempo para logout em segundos.

	if(!empty($_SESSION['timeout'])) {
		$tempo_sessao = time() - (int)$_SESSION['timeout'];
		if($tempo_sessao > $timeout) {
			session_unset();
			session_destroy();
			die(header('location: ' . SITE_ROOT . 'login.php'));
		}else{
			$_SESSION['timeout'] = time();
		}
	}
?>