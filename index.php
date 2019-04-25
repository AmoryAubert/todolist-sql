<?php
$json = file_get_contents("assets/json/todolist.json");
$parsed_json = json_decode($json,false);
function todo($parsed_json){
    foreach ($parsed_json as $value => $row){
        if ($parsed_json[$value]->{'DO'} == 0){
            echo "<p class='todop'><input type='checkbox' name='DO[]' value='".$parsed_json[$value]->{'TACHE'}."' class='checkbox'>".$parsed_json[$value]->{'TACHE'}."</p>";   
        }
    }
}
function isdo($parsed_json){
    foreach ($parsed_json as $value => $row){
        if ($parsed_json[$value]->{'DO'} == 1){
            echo "<p class='isdop'><input type='checkbox' value='".$parsed_json[$value]->{'TACHE'}."' class='checkbox' disabled='disabled' checked='checked'>".$parsed_json[$value]->{'TACHE'}."</p>";
        }
    }
}
if(isset($_POST['ajout'])){
	//$deadtime = $_POST['deadline'];
    $options = array(
        'task' => FILTER_SANITIZE_STRING
    );
    $result = filter_input_array(INPUT_POST, $options);
    foreach($options as $key => $value) 
    {
        $result[$key]=trim($result[$key]);
    }
    $json_arr = json_decode($json, true);
    //var_dump($json_arr.length);
    $json_arr[] = array('TACHE'=>ucfirst($result['task']), 'DATE'=>'22-06', 'DO'=>0);
    //var_dump($newline);
    // $parsed_json[$newline]->{'ID'} = $newline;
    // $parsed_json[$newline]->{'TACHE'} = ucfirst($result['task']);
    // $parsed_json[$newline]->{'DATE'} = "22-06";
    // $parsed_json[$newline]->{'DO'} = 0;
    file_put_contents('todolist.json', json_encode($json_arr));
    // header('Location: index.php');
    // exit();
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link type="text/css" rel="stylesheet" href="./assets/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="./assets/css/style.css">
    <title>ToDo List</title>
</head>
<body>
<h1><i class="far fa-list-alt left"></i>ToDo List<i class="far fa-list-alt right"></i></h1>
<form id="ToDo" method="post" action="index.php">
    <fieldset class="border border-primary p-3 ToDo">
        <legend class="w-auto">A Faire</legend>
		<p class="legend">
			<i class='fas fa-exclamation-triangle warning'></i>Il reste moins de 24h !!
			<i class='fas fa-exclamation-triangle deadline'></i>La deadline est dépassée !!
		</p>
		<div class="main">
			<div id="afaire" class="col-md-6">
				<?php todo($parsed_json) ?>
			</div>
		</div>
		<input type="submit" value="Archiver" name="afaire">
		<input type="submit" value="Supprimer" name="delete">
    </fieldset>
    <fieldset class="border border-primary p-3">
        <legend class="w-auto">Archive</legend>
		<div class="main">
			<div id="archive" class="col-md-6">
				<?php isdo($parsed_json) ?>
			</div>
		</div>
    </fieldset>
</form>
<form id="Add" method="post" action="index.php">
    <fieldset class="border border-primary p-3">
        <legend class="w-auto">Ajouter</legend>
        <input type="text" name="task" required class="col-md-6 adt">
		<input type="datetime-local" class="col-md-3 deadtime adt" name="deadline" value="2019-04-01T17:00" required>
        <input type="submit" value="Ajouter" name="ajout" id="ajout" class="col-md-9">
    </fieldset>
</form>
</body>
</html>