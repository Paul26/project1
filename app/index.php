<?php
/**
 * File name: index.php
 * Project: project1
 * PHP version 5
 * @category  PHP
 * @author    donbstringham <donbstringham@gmail.com>
 * @copyright 2016 © donbstringham
 * @license   http://opensource.org/licenses/MIT MIT
 * @version   GIT: <git_id>
 * @link      http://donbstringham.us
 * $LastChangedDate$
 * $LastChangedBy$
 */



use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
//$users = array();


//Silex for checking headers for application json, then request content, and turns in to an array
$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});


//POST (create) /users
$app->post('/users', function(Request $request) {
    $response = new Response();
    $username = $request->get("username");
    $password = $request->get("password");
    $full_name = $request->get("full_name");

    if (empty($username) || $username == "") {
        $response->setStatusCode(400);
        $response->setContent("Please provide a username.");

        return $response;
    }
    
    if (empty($password) || $password == "") {
        $response->setStatusCode(400);
        $response->setContent("Please provide a password.");
        
        return $response;
    }

    if (empty($full_name) || $full_name == "") {
        $response->setStatuscode(400);
        $response->setContent("Please provide a full name.");

        return $response;
    }
    
    //$user_data = ["username" => $username, "password" => $password, "full_name" => $full_name];

    $response->setStatusCode(201);
    $response->setContent("User successfully created!");
    //$response->setContent(json_encode($user_data));

    return $response;
});


//GET (read) /users
$app->get('/users', function() {
    $users = array();

    $faker = Faker\Factory::create();
    $username = $faker->userName;
    $password = $faker->word;
    $full_name = $faker->name;

    $user_data = ["username" => $username, "password" => $password, "full_name" => $full_name]; 
    array_push($users, $user_data);

    return json_encode($users);
});


//GET /user/id
$app->get('/users/{id}', function($id) {
    $response = new Response();
    
    $faker = Faker\Factory::create();
    $username = $id;
    
    $password = $faker->word;
    $full_name = $faker->name;
    
    $user_data = ["username" => $username, "password" => $password, "full_name" => $full_name];
    
    $response->setStatusCode(200);
    $response->setContent(json_encode($user_data));
    
    return $response;
});


//PUT (update) /users
$app->put('/users', function() {
    $response = new Response();
    
    $response->setStatusCode(405);
    $response->setcontent("Please use /users/id.");

    return $response;
});


//PUT (update) /users/id
$app->put('/users/{id}', function($id) {
    $response = new Response();
    $user_name = $id;
    
    $response->setStatusCode(200);
    $response->setContent("Successfully updated a user.");
    
    return $response;
});


//DELETE (delete) /users
$app->delete('/users', function() {
    $response = new Response();
    
    $response->setStatusCode(405);
    $response->setContent("Please use /users/id.");
    
    return $response;
});


//DELETE (delete) /users/id
$app->delete('/users/{id}', function($id) {
    $response = new Response();
    $user_name = $id;
    
    $response->setStatusCode(200);
    $response->setContent("Successfully deleted a user.");

    return $response;
});





//POST (create) /notes
$app->post('/notes', function (Request $request) {
    $response = new Response();
    $note_name = $request->get("note_name");
    $note_body = $request->get("note_body");
    $user_name = $request->get("user_name");
    
    if (empty($note_name) || $note_name == "") {
        $response->setStatusCode(400);
        $response->setContent("Please provide a note name.");
        
        return $response;
    }
    
    if (empty($note_body) || $note_body == "") {
        $response->setStatusCode(400);
        $response->setContent("Please provide text in the note body.");
        
        return $response;
    }
    
    if (empty($user_name) || $user_name == "") {
        $response->setStatusCode(400);
        $response->setContent("Please provide a user name.");

        return $response;
    }
        
        //$note_data = ["note_name" => $note_name, "note_body" => $note_body, "user_name" => $user_name];
        
        $response->setStatusCode(400);
        $response->setContent("Note successfully created.");
        //$response->setContent(json_encode($note_data));
        
        return $response;
});


//GET (read) /notes
$app->get('/notes', function() {
    $notes = array();

    $faker = Faker\Factory::create();
    $note_name = $faker->userName;
    $note_body = $faker->word;
    $user_name = $faker->name;

    $note_data = ["note_name" => $note_name, "note_body" => $note_body, "user_name" => $user_name];
    array_push($notes, $note_data);

    return json_encode($notes);
});


//GET /notes/id
$app->get('/notes/{id}', function($id) {
    $response = new Response();

    $faker = Faker\Factory::create();
    $note_name = $id;

    $note_body = $faker->word;
    $user_name = $faker->name;

    $note_data = ["note_name" => $note_name, "nobe_body" => $note_body, "user_name" => $user_name];

    $response->setStatusCode(200);
    $response->setContent(json_encode($note_data));

    return $response;
});


//PUT (update) /notes
$app->put('/notes', function() {
    $response = new Response();

    $response->setStatusCode(405);
    $response->setcontent("Please use /notes/id.");

    return $response;
});


//PUT (update) /notes/id
$app->put('/notes/{id}', function($id) {
    $response = new Response();
    $note_name = $id;
    
    $response->setStatusCode(200);
    $response->setContent("Successful update of note.");

    return $response;
});


//DELETE (delete) /notes
$app->delete('/notes', function() {
    $response = new Response();

    $response->setStatusCode(405);
    $response->setContent("Please use /notes/id.");

    return $response;
});


//DELETE (delete) /notes/id
$app->delete('/notes/{id}', function($id) {
    $response = new Response();
    $note_name = $id; 
    
    $response->setStatusCode(200);
    $response->setContent("Successfully deleted a note.");

    return $response;
});


$app->run();



/*
  Project 1 High-Level Requirements

  Project 1 is a a RESTful Web Service that client(s) can create, read, update, delete or list notes. A single note must
contain four fields a name, body, username and tag(s).

  It also has an endpoint to create, update, delete a user. A user object has a username, password (does not need to be
hashed) and full name attributes. The name, body, tag(s), username, password and full name are just plain text.

 
  The RESTful API does NOT require SSL or any type of authentication to be used. The RESTful API does NOT require any
type of persistent storage, meaning everything can be in memory (RAM). In other words use PHP arrays for in-memory
storage. Follow the currently accepted standards concerning RESTful API’s as discussed in class.

  This assignment will be turned via pull-requests on the Github class site (Links to an external site.).

*/



/*
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

$app->before(function (Request $request) {
    $headers = $request->headers;
    $token = $headers->get('Authorization');
    if ($token !== '1') {
        $msg = __FILE__ . ': hey I do NOT know you get a valid dev token';
        echo $msg;
        throw new \RuntimeException($msg);
    }
});

$app->get('/', function () use ($app) {
    return '<h1>Welcome to Project 1</h1>';
});

$app->get('/hello/{name}', function ($name) use ($app) {
    return '<p>Hello <b>' . $app->escape($name) . '</b></p>';
});

$app->get('/server', function (Request $request) use ($app) {
    return '<h3>Web-server: ' . $request->server->get('SERVER_SOFTWARE') . '</h3>';
});

$app->get('/users', function () use ($app) {
    $data = [
        'count' => 2,
        'users' => [
            ['username' => 'joe00'],
            ['username' => 'joe01']
        ]
    ];
    return json_encode($data);
});

$app->run();
*/
