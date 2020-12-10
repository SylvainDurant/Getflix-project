<?php

include('../database/functions.php');
session_start(); // Start a session

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

if (isset($_POST['addBtn'])) {
    // Get input values & validate form
        
    if (!empty($_POST['song_title'])) {
        $title = filter_var($_POST['song_title'], FILTER_SANITIZE_STRING); // Sanitization
        $song['values']['song_title'] = $title;
    } else {
       $song['errors']['song_title'] = "This field is required!";
    }

    if (!empty($_POST['song_artist'])) {
        $artist = filter_var($_POST['song_artist'], FILTER_SANITIZE_STRING); // Sanitization
        $song['values']['song_artist'] = $artist;
    } else {
       $song['errors']['song_artist'] = "This field is required!";
    }

    if (!empty($_POST['song_category'])) {
        $song['values']['song_category'] = $_POST['song_category'];
    } else {
        $song['errors']['song_category'] = "This field is required!";
    }

    if (isset($_POST['song_url'])) {
        $url = filter_var($_POST['song_url'], FILTER_SANITIZE_STRING); // Sanitization
        preg_match('~=(.*?)&~', $url, $output); // Take the part of the url we need (between "=" and "&")
        $song['values']['song_url'] = "https://www.youtube.com/embed/$output[1]"; // Change the Url to embed (https://www.youtube.com/embed/...)
    } else {
       $song['errors']['song_url'] = "This field is required!";
    }

    if (isset($_POST['song_album'])) {
        $album = filter_var($_POST['song_album'], FILTER_SANITIZE_STRING); // Sanitization
        $song['values']['song_album'] = $album;
    }

    if (isset($_POST['song_date'])) {
        $date = $_POST['song_date'];
        $song['values']['song_date'] = $date;
    }

    if (isset($_POST['song_album_image'])) {
        $image = filter_var($_POST['song_album_image'], FILTER_SANITIZE_STRING); // Sanitization

        $check_image = get_headers($image, 1);
        
        if ((get_headers($image, 1) === false) || strpos(get_headers($image, 1)['Content-Type'], 'image/') !== false) {
            $song['values']['song_album_image'] = $image;
        } else {
            $song['values']['song_album_image'] = '../images/Moosic_T2.1.png';
        }           
    }

    if (isset($_POST['song_description'])) {
        $description = filter_var($_POST['song_description'], FILTER_SANITIZE_STRING); // Sanitization
        $song['values']['song_description'] = $description;
    }

    // check if the song already exists in the db
  	$checkSong = fetchSongByTitle($conn,$title,$artist); // array OR false
    // var_dump($checkSong);

    if ($checkSong != false) { // if the user email doesn't exists in the db
        $song['errors']['song_exist'] = "This song already exists!";
    }

    if (isset($song['errors']) && count($song['errors']) > 0){
        $_SESSION['songErrors'] = $song['errors'];
        // the user is redirect the user to the search page
        header('location: ../pages/search.php');
    } else {
        $_SESSION['songValues'] = $song['values'];

        // insert user in the db & connect the user
  		$data = [];
  		$data['title'] = $title;
  		$data['description'] = $artist;
  		$data['source'] = $song['values']['song_url'];
  		$data['artist_name'] = $artist;
        $data['album_name'] = $album;
        $data['album_image'] = $image;
        $data['released_date'] = $date;
        $data['user_id'] = $user['user_id'];
        $data['category_id'] = $song['values']['song_category'];

        createSong($conn, $data);

        // the user is redirect the user to the new video page
        $newSong = fetchSongByTitle($conn,$title,$artist);
        if ($newSong != false){
            header('location: ../pages/video.php?id='.$newSong['id']);
        }
    }
    // var_dump($data);
} else {
    // the user accessed this page without passing by the form => redirect the user to the index page
    header('location: ../pages/404.php');
    exit();
}

?>