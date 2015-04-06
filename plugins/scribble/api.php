<?php

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );

//Authenticate the credentials
$username = $_SERVER['PHP_AUTH_USER'];
$password = $_SERVER['PHP_AUTH_PW'];
$user = wp_authenticate($username, $password);

if (empty($user->ID)) {
    echo json_encode(["status" => "fail", "message" => "Authentication failed, check the credentials in your Scribble 'Config/config.php' file."]);
    exit;
}

//Check the required POST data has been provided
if (empty($_POST['post_title']) || empty($_POST['post_content'])) {
    echo json_encode(["status" => "fail", "message" => "New post data is invalid or incomplete."]);
    exit;
}

//Create new post
wp_insert_post(array('post_title' => $_POST['post_title'], 'post_content' => $_POST['post_content'], 'post_author' => $user->ID, 'post_status' => 'publish'));

//Check for errors
if ( is_wp_error( $return ) ) {
    echo json_encode(["status" => "fail", "message" => $return->get_error_message()]);
}

//All ok let Scribble know
echo json_encode(["status" => "ok"]);