<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Buscar CEP</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>

	<?php

	function get_endereco($cep)
	{

		$url = "https://viacep.com.br/ws/$cep/xml/";

		$address = simplexml_load_file($url);

		return $address;
	}

	?>

	<h1 class="title">Pesquisar Endereço</h1>

	<form action="" method="post">
		<input type="text" name="cep">
		<button type="submit">Pesquisar</button>
	</form>


	<h2 class="title">Resultado da Pesquisa</h2>
	<?php
	if (isset($_POST['cep'])) {
		$endereco = get_endereco($_POST['cep']);
		$_SESSION['CEP'][$_POST['cep']]['logradouro'] = (string) $endereco->logradouro;
		$_SESSION['CEP'][$_POST['cep']]['bairro'] = (string) $endereco->bairro;
		$_SESSION['CEP'][$_POST['cep']]['cidade'] = (string) $endereco->localidade;
	}
	if (count($_SESSION['CEP']) > 0) {


		foreach ($_SESSION['CEP'] as $cep => $arrValores) {
			echo '
			<p>
				<b>CEP Rua: </b> ' . $cep . '<br>
				<b>Endereço: </b> ' . $arrValores['logradouro'] . '<br>
				<b>Bairro: </b> ' . $arrValores['bairro'] . '<br>
				<b>Cidade: </b> ' . $arrValores['cidade'] . '<br>
			</p>
			';
		}
	}

	?>
	

</body>

</html>