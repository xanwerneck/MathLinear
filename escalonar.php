<?

if($_POST){

	$k = 1;
	$linhas  = $_POST['linhas'];
	$colunas = $_POST['colunas'];

	$elementos = array();
	for ($i=1; $i <= $linhas ; $i++) { 
		for ($j=1; $j <= $colunas; $j++) { 
			$elementos[$i][$j] = $_POST['col'.$i.'_'.$j];
		}
	}

	$tmp = EliminaLinhasNulas($elementos,$linhas,$colunas);
	$elementos = $tmp[1];
	$linhas    = $tmp[0];
	
	while ($k < $linhas) {

		$elementos = TrocaLinhas($elementos, $linhas, $colunas);

		$elementos = Operacoes($elementos,$colunas,$k);

		$tmp       = EliminaLinhasNulas($elementos,$linhas,$colunas);
		$elementos = $tmp[1];
		$linhas    = $tmp[0];


		$k++;
	}

	echo '<pre>';
	var_dump($elementos);

}

function TrocaLinhas($elementos, $linhas, $colunas){
	$tmp = array();
	for ($i=1; $i <= $linhas; $i++) { 
		$num_zeros = 0;
		for ($j=1; $j <= $colunas; $j++) { 
			if($elementos[$i][$j]==0){
				$num_zeros++;
			}else{
				break;
			}
		}
		if($num_zeros == $i){
			if( $elementos[$num_zeros+1] != NULL){
				$tmp = $elementos[$i];
				$elementos[$i] = $elementos[$num_zeros+1];
				$elementos[$num_zeros+1] = $tmp;
			}
		}
		if($num_zeros > $i){
			if( $elementos[$num_zeros] != NULL){
				$tmp = $elementos[$i];
				$elementos[$i] = $elementos[$num_zeros];
				$elementos[$num_zeros] = $tmp;
			}
		}
	}
	return $elementos;

}

function Operacoes($elementos,$colunas,$k){

	$operador = 0;
	for ($j=1; $j <= $colunas; $j++) { 
		if($elementos[$k+1][$j]!=0 && $operador == 0){
			$operador = $j;
			$cont = $elementos[$k+1][$operador];
		}
		if($operador != 0){
			$tmp = $elementos[$k][$j] * $cont;
			$elementos[$k+1][$j] = $elementos[$k+1][$j] - $tmp;
		}
	}
	return $elementos;
}

function EliminaLinhasNulas($elementos,$linhas,$colunas){
	$count = 0;
	for ($i=1; $i <= $linhas ; $i++) { 
		$count_col_nula=0;	
		for ($j=1; $j <= $colunas; $j++) { 
			if($elementos[$i][$j] == 0){
				$count_col_nula++;
			}
		}
		if($count_col_nula == $colunas){
			$elementos[$i] = NULL;
			$count++;
		}
	}

	$ret[0] = $linhas - $count;
	$ret[1] = array_values(array_filter($elementos));

	$ret[1] = reorgArray($ret[1]);

	return $ret;
}

function reorgArray($elem){
	$ret = array();
	for ($i=0; $i < count($elem); $i++) { 
		$ret[$i+1] = $elem[$i];
	}
	return $ret;
}

?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Math Linear - Um novo formato para você estudar Álgebra Linear</title>

	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/mine.css">
	<link href='http://fonts.googleapis.com/css?family=Signika' rel='stylesheet' type='text/css'>
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	
</head>
<body>
	<nav>
		<li>Origem</li>
		<li>Conceitos</li>
		<li>Equipe</li>
	</nav>
	<header>
		<div class="elem-center">
			<img src="assets/img/logo.png">
			<h1> - MATH LINEAR - </h1>
			<h3>Um novo formato para o estudo da Álgebra Linear!</h3>
		</div>
	</header>

	<section>
		<div class="boxG">

			<form action="escalonar.php" method="post">
			  <fieldset>
			    <legend>Cálculo da Matriz Escalonada</legend>
			    
			    <div class="row-fluid">
					<input class="span1" name="col1_1">
					<input class="span1" name="col1_2">
					<input class="span1" name="col1_3">
				</div>
				<br>
				<div class="row-fluid">
					<input class="span1" name="col2_1">
					<input class="span1" name="col2_2">
					<input class="span1" name="col2_3">
				</div>
				<br>
				<div class="row-fluid">
					<input class="span1" name="col3_1">
					<input class="span1" name="col3_2">
					<input class="span1" name="col3_3">
				</div>
				<br>
				<input type="hidden" id="linhas" name="linhas" value="3">
				<input type="hidden" id="colunas" name="colunas" value="3">
			    <button type="submit" class="btn">Submit</button>
			  </fieldset>
			</form>
		</div>
	</section>

	<footer>
		<h5>Este projeto foi desenvolvido por <a href="http://github.com/xanwerneck">@xanwerneck</a> e pode ser obtido no <a href="http://github.com/xanwerneck/MathLinear">github</a></h5>
	</footer>

	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/mine.js"></script>

</body>
</html>