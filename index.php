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
    // and somewhere later:
    foreach ($data as $key => $row) {
        echo "<p class='todop'><input type='checkbox' name='DO[]' value='".$row['ID']."' class='checkbox'>".$row['TASK']."</p>";
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
    ];
    $sql = "INSERT INTO ToDoList (TASK, DO) VALUES (:TASK, :DO)";
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
    <link type="text/css" rel="stylesheet" href="./assets/css/style.css">
    <title>ToDo List</title>
</head>
<body>
<h1>ToDo List</h1>
<form id="ToDo" method="post" action="index.php">
    <fieldset class="border border-primary p-3 ToDo">
        <legend class="w-auto">A Faire</legend>
        <div id="afaire">
            <?php todo(); ?>
        </div>
        <input type="submit" value="Archiver" name="afaire">
    </fieldset>
    <fieldset class="border border-primary p-3">
        <legend class="w-auto">Archive</legend>
		<div id="archive">
            <?php isdo(); ?>
        </div>
    </fieldset>
</form>
<form id="Add" method="post" action="index.php">
    <fieldset class="border border-primary p-3">
        <legend class="w-auto">Ajouter</legend>
        <textarea name="task" rows="2" required class="col-md-9"></textarea>
        <input type="submit" value="Ajouter" name="ajout" id="ajout" class="col-md-9">
    </fieldset>
</form>
</body>
</html>