<?php
include('../helpers/functions.php');
session_start(); // Start a session

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

if (isset($_POST['addComment'])) {
    // Get input values & validate form
        
    if (!empty($_POST['comment'])) {
        $text = filter_var($_POST['comment'], FILTER_SANITIZE_STRING); // Sanitization
        $comments['values']['text'] = $text;
    } else {
       $comments['errors']['text'] = "This field is required!";
    }

    var_dump($comments['values']['text']);
    var_dump($_POST['song_id']);
    var_dump($user['user_id']);
    
    // // check if the comment already exists in the db
  	$checkComment = fetchComment($conn,$text,$user['user_id']); // array OR false
    var_dump($checkComment);

    if ($checkComment != false) { // if the user email doesn't exists in the db
        $comments['errors']['comment_exist'] = "You already posted that exact same comment. No spam allowed!";
    }

    if (isset($comments['errors']) && count($comments['errors']) > 0){
        $_SESSION['success_message'] = $comments['errors']['comment_exist'];
        // the user is redirect the user to the search page
        header('location: ../pages/video.php?id='.$_POST['song_id']);
    } else {
        $_SESSION['commentValues'] = $comments['values'];

        // insert user in the db & connect the user
        $data = [];
        $data['text'] = $comments['values']['text'];
        $data['user_id'] = $user['user_id'];
        $data['song_id'] = $_POST['song_id'];

        createComment($conn, $data);

        $newComment = fetchComment($conn,$text,$user['user_id']);

        if ($newComment != false) {
            $_SESSION['success_message'] = "Comment successfully added.";

            // the user is redirected to the new video page with success message
            header('location: ../pages/video.php?id='.$_POST['song_id']);
        }
    }
    
    // var_dump($data);
} else {
    // the user accessed this page without passing by the form => redirect the user to the 403 page
    header('location: ../pages/403.php');
    // exit();
}

?>