<?php
if ($_SESSION['idioma'] == "br" || !isset($_SESSION['idioma'])){

	// Menus
	$menuJogos = "JOGOS";
	$menuLoja = "LOJA";
	$menuJogar = "JOGAR";
	$menuCriarConta = "CRIAR CONTA";
	$menuEntrar = "ENTRAR";

	$menuMeuPerfil = "MEU PERFIL";
	$menuMeuProgresso = "MEU PROGRESSO";
	$menuSair = "SAIR";

	$menuCampeonatos = "CAMPEONATOS";
	$menuXTreinos = "X-TREINOS";
	$menuLigas = "LIGAS";

	//
	$slogan = "PLATAFORMA DE CAMPEONATOS DE E-SPORTS";
	$mainBannerAmarelo = "MOSTRE QUEM É QUE MANDA...";
	$mainJogueJunto = "JOGUE JUNTO";

	// SIGN-IN
	$contaTitleCriarConta = "CRIE SUA CONTA";
	$nomeCriarConta = "Seu nome";
	$emailCriarConta = "Seu E-mail";
	$emailConfCriarConta = "Confirme seu E-mail";
	$senhaCriarConta = "Crie uma Senha";
	$senhaConfCriarConta = "Confirme sua Senha";
	$contaCriarConta = "Criar Conta";

	// LOG-IN
	$loginTitle = "ENTRAR";
	$loginTitleEsqueceuSenha = "Esqueceu sua Senha?";
	$loginTitleAindaNaoCriouConta = "Ainda não criou sua Conta?";
	$emailLogin = "Seu E-mail";
	$senhaLogin = "Sua Senha";
	$contaLogin = "Entrar";

	$termos = " <small>Criando sua conta, você lê e concorda com nossos <strong><a href='termos.pdf' target='_Blank' class='link' style='color:#ffc107;''>Termos de Uso</a></strong> e <strong><a href='politica-cookies.php' target='_Blank' class='link' style='color:#ffc107;'>Políticas de Cookies</a></strong></small><br/>
                <small id='msnErroConfirmTermos' style='display: none' class='text-danger'>Marque esta opção</small> ";

}

if ($_SESSION['idioma'] == "eng"){

	// Menus
	$menuJogos = "GAMES";
	$menuLoja = "STORE";
	$menuJogar = "GO PLAYER";
	$menuCriarConta = "SIGN-IN";
	$menuEntrar = "LOG-IN";

	$menuMeuPerfil = "MY PROFILE";
	$menuMeuProgresso = "MY PROGRESS";
	$menuSair = "SIGN-OUT";

	$menuCampeonatos = "CHAMPIONSHIPS";
	$menuXTreinos = "X-TRAINING";
	$menuLigas = "LEAGUES";

	//
	$slogan = "WEB PLATAFORM FOR E-SPORTS";
	$mainBannerAmarelo = "show THEM no mercy...";
	$mainJogueJunto = "PLAY TOGETHER";

	// SIGN-IN
	$contaTitleCriarConta = "CREATE YOUR ACCOUNT";
	$nomeCriarConta = "Your Name";
	$emailCriarConta = "Your E-mail";
	$emailConfCriarConta = "Confirm your E-mail";
	$senhaCriarConta = "Crate your Password";
	$senhaConfCriarConta = "Confirm your Password";
	$contaCriarConta = "Create your Account";

	// LOG-IN
	$loginTitle = "LOG-IN";
	$loginTitleEsqueceuSenha = "Remember your Password";
	$loginTitleAindaNaoCriouConta = "Create your Free Account";
	$emailLogin = "Your E-mail";
	$senhaLogin = "Your Password";
	$contaLogin = "Log-in";

	$termos = " <small>By creating your account, you read and agree to our <strong><a href='termos.pdf' target='_Blank' class='link' style='color:#ffc107;''>Terms of Use</a></strong> and <strong><a href='politica-cookies.php' target='_Blank' class='link' style='color:#ffc107;'>Cookie Policies</a></strong></small><br/>
                <small id='msnErroConfirmTermos' style='display: none' class='text-danger'>Marque esta opção</small> ";

}

?>