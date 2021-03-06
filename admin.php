<?php

use \Hcode\PageAdmin;
use \Hcode\PageChat;
use \Hcode\Model\User;
use \Hcode\Model\ChatAdmin;

$app->get('/admin', function() {

	$users = User::isLogin();
    
	$page = new PageAdmin([
		"data"=>array(
			"users"=>$users
		)
	]);

	$page->setTpl("index", array(
		"users"=>$users
	));

});

/*

$app->get('/admin', function() {

	$iduserLog = User::isLogin(User::verifyLogin()); // id do usuário logado

	$userLog = new User(); // instanciando novo usuário

	$userLog->get((int)$iduserLog); // pegando dados do usuário
    
	$page = new PageAdmin();

	$page->setTpl("index", [
		"users"=>$userLog->getValues()
	]);

});

*/

$app->get('/admin/login', function(){
	$page = new PageAdmin([ 
		"header"=>false,
		"footer"=>false
	]);
	$page->setTpl("login");
});

$app->post('/admin/login', function(){
	User::login($_POST["login"], $_POST["password"]);
	header("Location: /admin");
	exit;
});

$app->get('/admin/logout', function(){
	User::logout();
	header("Location: /admin/login");
	exit;
});

$app->get("/admin/forgot", function() {

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot");	

});

$app->post("/admin/forgot", function(){

	$user = User::getForgot($_POST["email"]);

	header("Location: /admin/forgot/sent");
	exit;

});

$app->get("/admin/forgot/sent", function(){

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot-sent");	

});


$app->get("/admin/forgot/reset", function(){

	$user = User::validForgotDecrypt($_GET["code"]);

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot-reset", array(
		"name"=>$user["desperson"],
		"code"=>$_GET["code"]
	));

});

$app->post("/admin/forgot/reset", function(){

	$forgot = User::validForgotDecrypt($_POST["code"]);	

	User::setFogotUsed($forgot["idrecovery"]);

	$user = new User();

	$user->get((int)$forgot["iduser"]);

	$password = User::getPasswordHash($_POST["password"]);

	$user->setPassword($password);

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot-reset-success");

});

$app->get('/admin/chat', function() {

	$users = User::isLogin();
	
	$chatadmin = ChatAdmin::listAll();
	
	$page = new PageChat([
		"data"=>array(
			"users"=>$users
		),
	]);

	$page->setTpl("index", [
		'chat'=>$chatadmin
	]);

});

$app->post('/admin/chat', function() {

	User::verifyLogin();
    
	$chatadmin = new ChatAdmin();

	$users = User::isLogin();

	$chatadmin->setData($_POST);

	$chatadmin->save($users);

	header('Location: /admin/chat');
	exit;

});

?>