<?php
session_start();

//add the following PHP code to turn on error reporting:
ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once ('vendor/autoload.php');

$f3 = Base::instance();

$f3->route('GET /', function (){

    $view = new Template();
    echo $view ->render('views/home.html');
});


$f3->route('GET|POST /order', function($f3) {

    //Check if the form has been posted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {


        //Get the data from
        $petType = $_POST['petType'];
        $petColor = $_POST["petColor"];

        //Validate the data
        if (empty($petType)) {
            //Data is invalid
            echo "Please supply a pet type";
        }else{
            $f3->set('SESSION.petType',$petType);
            $f3->set("SESSION.color", $petColor);
            $f3->reroute("summary");
        }
    }

    $view = new Template();
    echo $view->render('views/pet-order.html');
});

// Summary page route
$f3->route('GET /summary', function($f3) {
    $view = new Template();
    echo $view->render('views/summary.html');
});

$f3->run();