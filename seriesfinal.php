<?php 
	
	session_start();

	// definir variável de sessão 'para_assistir', array pré-preenchido desde
	// que a variável de sessão 'assistidos' esteja vazia)
	if (!isset($_SESSION['para_assistir']) || !count($_SESSION['para_assistir'])) {
		$_SESSION['para_assistir'] = array(
			'Na rota do dinheiro sujo',
            'The family - Democracia ameaçada',
            'Queer eye',
		);
	}

	// definir variável de sessão 'assistidos', array pré-preenchido desde
	// que a variável de sessão 'assistidos' esteja vazia)
	if (!isset($_SESSION['assistidos']) || !count($_SESSION['assistidos'])) {
		$_SESSION['assistidos'] = array(
			'True detective',
            'Game of Thrones',
            'The Handmaid\'s Tale',
            'Westworld',
            'Mister Robot',
            'Silicon Valley',
            'Patriot Act',
            'Billions',
            'House of Cards',
            'Mad Men',
            'Cosmos',
            'Dr. House',
            'Lúcifer',
            'Black Mirror',
            'Sense 8',
            'Rotten',
            'Olhos que condenam',
            'The Newsroom',
            'Halt and catch fire',
            'Chernobyl',
            'Years and years',
            'Santa Clarita diet',
            'Fleabag',
            'Downtown Abbey',
		);
	}

	// definir variável de sessão 'disponiveis', array pré-preenchido desde
	// que a variável de sessão 'assistidos' esteja vazia)
	if (!isset($_SESSION['disponiveis']) || !count($_SESSION['disponiveis'])) {

		$_SESSION['disponiveis'] = array(
			'Arrested Development',
			'Merlí',
			'Godless',
			'Walking dead',
			'Girls',
			'Euphoria',
		);
	}

	if (isset($_GET['de']) && ($_GET['de'] == 'para_assistir')) {

		if (isset($_GET['para'])) {

			// obtém o valor da variável de sessão 'id' (código)
			$id = $_GET['id'];

			switch ($_GET['para']) {

				case 'disponiveis':
				
					$_SESSION['disponiveis'][] = $_SESSION['para_assistir'][$id];
					unset($_SESSION['para_assistir'][$id]);

					break;
				
				case 'assistidos':

					$_SESSION['assistidos'][] = $_SESSION['para_assistir'][$id];
					unset($_SESSION['para_assistir'][$id]);

					break;

				default:
					break;
			}
		}
	} 
	elseif (isset($_GET['de']) && ($_GET['de'] == 'assistidos')) {

		// obtém o valor da variável de sessão 'id' (código)
		$id = $_GET['id'];

		$_SESSION['para_assistir'][] = $_SESSION['assistidos'][$id];
		unset($_SESSION['assistidos'][$id]);

	}
	else {
		if (isset($_GET['para'])) {

			// obtém o valor da variável de sessão 'id' (código)
			$id = $_GET['id'];

			switch ($_GET['para']) {

				case 'para_assistir':
				
					$_SESSION['para_assistir'][] = $_SESSION['disponiveis'][$id];
					unset($_SESSION['disponiveis'][$id]);

					break;
				
				case 'assistidos':

					$_SESSION['assistidos'][] = $_SESSION['para_assistir'][$id];
					unset($_SESSION['para_assistir'][$id]);

					break;

				default:
					break;
			}
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Lista de séries 🎞</title>
        <link type="text/css" rel="stylesheet" href="css/series.css?v=<?= rand() ?>">
    </head>
    <body>
        
        <h1 id="site_title">Minha lista de Séries 📽</h1>
        
        <div class="col-33">
            <h2 class="category_title">🎞 Disponíveis</h2>
            <ul>
                <?php 

                    foreach ($_SESSION['disponiveis'] as $index => $serie) {
                        echo "<li><a href=\"?para=para_assistir&id=$index\">$serie ▶</a></li>";
                    }

                ?>
            </ul>
        </div>

        <div class="col-33">
            <h2 class="category_title">🍿 Para Assistir</h2>
            <ul>
                <?php
                    foreach ($_SESSION['para_assistir'] as $index => $serie) {
                        echo "<li>$serie <a href=\"?de=para_assistir&para=disponiveis&id=$index\">◀</a> <a href=\"?de=para_assistir&para=assistidos&id=$index\">▶</a></li>";
                    }
                ?>
            </ul>
        </div>

        <div class="col-33">
            <h2 class="category_title">🥰 Assistidos</h2>
            <ul>
                <?php
                    foreach ($_SESSION['assistidos'] as $index => $serie) {
                        echo "<li><a href=\"?de=assistidos&id=$index\">◀ $serie</a></li>";
                    }
                ?>
            </ul>
        </div>
    <hr>
    <pre><?php 
        print_r($_SESSION);
        ?>
    </pre>

    </body>
</html>