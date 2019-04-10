<?php
try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=Becode;charset=utf8', 'Amory', 'user');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}
function todo(){
    $bdd = new PDO('mysql:host=localhost;dbname=Becode;charset=utf8', 'Amory', 'user');
    $data = $bdd->query("SELECT * FROM ToDoList WHERE DO='0'")->fetchAll();
	date_default_timezone_set('Europe/Brussels');
	$dateOfTheDay = date('Y-m-d H:i:s', time());
	$datetime1 = new DateTime($dateOfTheDay);
    foreach ($data as $key => $row) {
		if ($row['DEADLINE']==''){
			echo "<p class='todop'><input type='checkbox' name='DO[]' value='".$row['ID']."' class='checkbox'>".$row['TASK']."</p>";
		} else {
			$datetime2 = new DateTime($row['DEADLINE']);
			$interval = $datetime1->diff($datetime2);
			$dateDeadline = $datetime2->format('d-m-Y H:i:s');
			if ((($interval->d)>=1) && ($datetime1<$datetime2)){
				echo "<p class='todop'><input type='checkbox' name='DO[]' value='".$row['ID']."' class='checkbox'>".$row['TASK'].
				"<i></i><span class='italic'>Deadline: ".$dateDeadline."</span></p>";
			} else if ((($interval->d)==0) && ($datetime1<$datetime2)){
				echo "<p class='todop'><input type='checkbox' name='DO[]' value='".$row['ID']."' class='checkbox'>".$row['TASK'].
				"<i class='fas fa-exclamation-triangle warning'></i><span class='italic'>Deadline: ".$dateDeadline."</span></p>";
			} else if ((($interval->d)>=0) && ($datetime1>=$datetime2)){
				echo "<p class='todop'><input type='checkbox' name='DO[]' value='".$row['ID']."' class='checkbox'>".$row['TASK'].
				"<i class='fas fa-exclamation-triangle deadline'></i><span class='italic'>Deadline: ".$dateDeadline."</span></p>";
			}
		}
    }
}
function isdo(){
    $bdd = new PDO('mysql:host=localhost;dbname=Becode;charset=utf8', 'Amory', 'user');
    $data = $bdd->query("SELECT * FROM ToDoList WHERE DO='1'")->fetchAll();
    // and somewhere later:
    foreach ($data as $key => $row) {
        echo "<p class='isdop'><input type='checkbox' value='".$row['ID']."' class='checkbox' disabled='disabled' checked='checked'>".$row['TASK']."</p>";
    }
}
if(isset($_POST['afaire'])){
	$todelete = $_POST['DO']; 
	$stmt = $bdd->prepare("UPDATE ToDoList SET DO='1' WHERE ID = :ID");
	foreach ($todelete as $id)
    $stmt->execute(array(":ID" => $id));
	header('Location: index.php');
    exit();
}
if(isset($_POST['ajout'])){
	$deadtime = $_POST['deadline'];
    $options = array(
        'task' => FILTER_SANITIZE_STRING
    );
    $result = filter_input_array(INPUT_POST, $options);
    foreach($options as $key => $value) 
    {
       $result[$key]=trim($result[$key]);
    }
    $data = [
        'TASK' => $result['task'],
        'DO' => '0',
		'DEADLINE' => $deadtime,
    ];
    $sql = "INSERT INTO ToDoList (TASK, DO, DEADLINE) VALUES (:TASK, :DO, :DEADLINE)";
    $bdd->prepare($sql)->execute($data);
	header('Location: index.php');
    exit();
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
<!--<i class="fas fa-exclamation-triangle"></i>-->
<h1>ToDo List</h1>
<form id="ToDo" method="post" action="index.php">
    <fieldset class="border border-primary p-3 ToDo">
        <legend class="w-auto">A Faire</legend>
		<p class="legend">
			<i class='fas fa-exclamation-triangle warning'></i>Il reste moins de 24h !!
			<i class='fas fa-exclamation-triangle deadline'></i>La deadline est dépassée !!
		</p>
		<div class="main">
			<div id="afaire" class="col-md-6">
				<?php todo(); ?>
			</div>
		</div>
		<input type="submit" value="Archiver" name="afaire">
    </fieldset>
    <fieldset class="border border-primary p-3">
        <legend class="w-auto">Archive</legend>
		<div class="main">
			<div id="archive" class="col-md-6">
				<?php isdo(); ?>
			</div>
		</div>
    </fieldset>
</form>
<form id="Add" method="post" action="index.php">
    <fieldset class="border border-primary p-3">
        <legend class="w-auto">Ajouter</legend>
        <input type="text" name="task" required class="col-md-6">
		<input type="datetime-local" class="col-md-3 deadtime" name="deadline" value="2019-04-01T17:00" required>
        <input type="submit" value="Ajouter" name="ajout" id="ajout" class="col-md-9">
    </fieldset>
</form>
</body>
</html>