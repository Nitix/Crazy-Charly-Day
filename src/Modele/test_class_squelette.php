<?php


include_once 'Base.php';
//include_once '.php';

echo "<h1>test ....</h1>";

echo "<b>Test 1 : parcours des **** : </b><br/>" ;
$lc = ****::findAll();

foreach ($lc as $cat) {
    // echo "userid : " . $cat->userid . "<br/>" ;
    // echo "login : " . $cat->login . "<br/>" ;
    // echo "mail : " . $cat->mail . "<br/><br/>" ;
}

echo "<b>Test 2 : ajout d'un **** : </b><br/>" ;

$c= new ****();
// $c->login = "**** test";
// $c->password ="password test";
// $c->mail = "mail **** test";
$c->insert();

echo "userid du nouvel **** : ".$c->userid .'<br/>';

echo "<br/>nouvelle liste : <br/>";
foreach (****::findAll() as $cat) {
    // echo "userid : " . $cat->userid . "<br/>" ;
    // echo "login : " . $cat->login . "<br/>" ;
    // echo "mail : " . $cat->mail . "<br/><br/>" ;
}

echo "<b>Test 3 : modification de la **** : </b><br/>" ;
$c->mail= "nouvelle descrption de la **** de test";
$c->update();


echo "<b>Test 4 : retrouver une **** </b><br/>";
$cm = ****::findByLogin($c->login);
// echo "userid : " . $cm->userid . "<br/>" ;
// echo "login : " . $cm->login. "<br/>" ;
// echo "mail : " . $cm->mail . "<br/><br/>" ;

echo "<b>Test 5 : supprimer une **** </b><br/>";
$cm->delete();

// echo"<b> Test 6 mot de pass et login<b>";
// $test= new ****();

// $test->login = "testeur";
// $test->password ="jesuisuntest";
// $test->mail = "testeur@test.fr";
// $test->insert();


// echo ****::verif("testeur","jesuisuntest");
// echo "</br>";
// echo ****::verif("testeue'r","jesuisuntest");
// echo "</br>";
// echo ****::verif("testeur","jesuisuntzest");


