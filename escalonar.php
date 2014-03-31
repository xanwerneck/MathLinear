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
	
	while ($k <= $linhas) {

		$tmp = Operacoes($elementos,$linhas,$colunas,$k);


		$k++;
	}

	//echo '<pre>';
	//var_dump($tmp);

}

function Operacoes($elementos,$linhas,$colunas,$k){

	for ($i=$k+1; $i <= $linhas; $i++) { 
		for ($j=1; $j < $colunas; $j++) { 
			$c = 1;
			while($elementos[$i][$j]!=0){
				$elementos[$i][$j] = $elementos[$i][$j] - ($c * ($elementos[$i-1][$j]));
				$c++;
			}
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

	$ret[0] = $count;
	$ret[1] = array_values(array_filter($elementos));

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