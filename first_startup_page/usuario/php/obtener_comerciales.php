<?php

	$db = new mysqli('localhost', 'unituitc_bbdd', 'admin&uni13','unituitc_001') or die("Error");
    $consulta = "SELECT * FROM Comercial";
    $respuesta = $db->query($consulta) or die($db->error);
    $opt_select = "<select id='comercial'><option selected>---</option><option value='Amigo'>Amigo</option><option value='Familiar'>Familiar</option>
    <option value='Redes sociales'>Redes sociales</option>";
    while($row = $respuesta->fetch_array()){
        $opt_select = $opt_select ."<option value='".$row['Nombre']."'>".$row['Nombre']."</option>";
    }
    $opt_select = $opt_select."</select>";
    echo $opt_select;
?>