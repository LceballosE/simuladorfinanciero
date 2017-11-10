<?php

$profpic = "bg.jpg";
$icon = "icon.png";

$saldo = 200000000;


if (isset($_POST['ingresos'])) {
	$ingresos = $_POST['ingresos'];
    $ea = $_POST['porcentaje'];
    // $ea = $ea/100;
    $em=1-pow((1-$ea),(1/12));
	if (isset($_POST['egreso'])) {
		$egresos = $_POST['egreso'];
		$cantidadE = count($egresos);
	}
	if (isset($_POST['cantidad'])) {
		$repes = $_POST['cantidad'];
	}
	$totalE = 0;

	for ($i = 0; $i < $cantidadE; $i++) {
		$totalE = $totalE + $egresos[$i] * $repes[$i];
	}
	
	/*if($ingresos > $totalE){
		$totalAhorro = $ingresos - $totalE;
		$ahorroM = $totalAhorro * $em;
		$tmSaldo = $saldo * $em;
		$saldo = $saldo + $tmSaldo + $totalAhorro + $ahorroM;
		$contador = 2;
		while($saldo < 1000000000){
				$saldo = $saldo * $em + $ahorroM + $totalAhorro + $saldo;
				$contador = $contador +1;
		}
		echo'<script>
			alert( "Se demorará en llegar a $1.000.000.000 en '.$contador.' meses");
				</script>';
		}
	else{
		echo'<script>
			alert( "Los ingresos deben ser mayores a tus egresos o no llegaras a la meta :(");
				</script>';
		}*/

$json = file_get_contents('http://equipo2.jevelasquez.com:3000/'.$ingresos.'/'.$totalE.'/'.$ea);
$obj = json_decode($json);


echo'<script>
			alert( "Se demorará en llegar a $1.000.000.000 un total de '.$obj->meses.' Meses ");
				</script>';
	
}


?>


<!doctype html>
<html>
<head>

    <meta charset="utf-8">
    <title>Simulador Financiero</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <!-- Latest compiled and minified CSS -->
    
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

    
    <style>
	.input[type=text] {
		width: 130px;
		-webkit-transition: width 0.4s ease-in-out;
		transition: width 0.4s ease-in-out;
	}
	
	/* When the input field gets focus, change its width to 100% */
	input[type=text]:focus {
		width: 100%;
	}
		</style>
    <link rel="SHORTCUT ICON" href="<?php echo $icon ?>">
</head>

<body style="background-image: url('<?php echo $profpic;?>');">

<div class="container-fluid">

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="jumbotron" style="margin-top: 50px; background-color: rgba(106,156,129,0.8);">

                 <div class="row ">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 style="color: rgb(50,69,59) !important; text-align: center; ">Simulador financiero</h1>
                        <p style="font-size: 18px">¿Tienes $200’000.000 y quieres con una cuota fija y nuestros intereses llegar a tener ahorrados $1.000'000.000? Nosotros te decimos cuanto tardara en alcanzar su meta.</p>
                    </div>

                </div>  
                <hr style=" border: 0; height: 0; border-top: 1px solid rgba(0, 0, 0, 0.1); border-bottom: 1px solid rgba(255, 255, 255, 0.3);" >
                <form method="post" class="form-horizontal">
                <div class="form-group">
                    <div class="row">

                        <div class="col-md-6 col-md-offset-3">
                            
                            <label for="ingresos" > Ingresos:</label>
                    </div>
                    <div class="row">           
                        </div>
                        <div class="col-md-6 col-md-offset-3"> 
                            <div class="input-group">      
                                <span class="input-group-addon">$</span>
                                <input type="number" class="form-control"  id="ingresos" name="ingresos" required>
                            </div>
                                
                        </div>
                      </div>
                      <div class="input_fields_wrap">
                        <div class="row" >
                            
                                <div class="col-md-6 col-md-offset-3">
                                  <label class="control-label" for="Egresos">Egresos:</label>
                                  <button class="add_field_button pull-right btn btn-primary" style="margin-top: 10px">Agregar Egreso</button>
                                </div>
                        </div>
                        <div class="row" style="margin-top: 15px">    
                                <div class="col-md-4 col-md-offset-3" >
                                    <div class="input-group">      
                                      <span class="input-group-addon">$</span>
                                      <input type="number" class="form-control" name="egreso[]" min="0" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                  <select id="cantidad" class="form-control" name="cantidad[]" required>
                                    <option value="">Repeticiones</option>
                                    <option value="1">Mensual (1)</option>
                                    <option value="2">Quincenal (2) </option>
                                    <option value="3">3</option>
                                    <option value="4">Semanal (4)</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">diario (30)</option>
                                  </select>
                                    
                                
                              </div>
                            </div>
                      </div>
                  
                  <div class="row">           
                        
                        <div class="col-md-3 col-md-offset-3"> 
                             <label class="control-label" for="Egresos">Porcentaje:</label>
                            <div class="input-group">      

                                <span class="input-group-addon">%</span>
                                <input type="number" class="form-control"  id="porcentaje" name="porcentaje" required min="0" >
                            </div>
                                
                        </div>
                      </div>
                 </div>
                  <div class="form-group"> 
                    <div class="col-md-12" style="margin-top: 10px">
                      <button type="submit" class="btn btn btn-success btn-lg center-block">Calcular</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>





<script>

<!--Jquery para agregar egresos dinamicamente-->

$(document).ready(function() {
    var max_fields      = 30; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="row" style="margin-top: 10px"><div class="col-md-4 col-md-offset-3"><div class="input-group"><span class="input-group-addon">$</span><input type="number" class="form-control" name="egreso[]" min="0" required> </div></div><div class="col-md-2"><select id="cantidad" class="form-control" name="cantidad[]" required><option value="">Repeticiones</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option></select></div><a href="#" class="remove_field col-md-1" style="color : rgb(35,89,61); ">Eliminar</a></div></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

</body>
</html>

