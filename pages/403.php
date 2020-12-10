<?php
include('../database/functions.php');
session_start(); // Start a session
?>

<!-- HTML content -->
<?php include('../layouts/master.php'); ?>
<?php include('../layouts/header.php'); ?>

<div class="container text-center p-4">
    <h1>403 Forbidden!</h1>
    <img src="https://memegenerator.net/img/instances/72679403.jpg" alt="NOPE" style="width: 50%;">
</div>

<?php 
        // $image = 'https://media1.giphy.com/media/hyBjcpooaAwuY/200.gif';
        // $image = 'https://www.youtube.com/watch?v=ZHsrTGBD72U&ab_channel=benzaieTV';
        $image = 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxMTEhUTEhIWFhUWGBgYGBcWFxUdGBgXGxcaGBUYGBcYHSggGBolGxgXITEiJSkrLi4uGB8zODMtNygtLisBCgoKDg0OGhAQGi0lHyUtLS0tLSstLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLf/AABEIAOEA4QMBIgACEQEDEQH/xAAbAAABBQEBAAAAAAAAAAAAAAAEAAECAwUGB//EAD8QAAEDAgMFBgQEBQIGAwAAAAEAAhEDIQQSMQVBUWFxIoGRobHwEzLB0QZCUuEUI2Jy8RWCQ5KywtLiFlOi/8QAGQEAAwEBAQAAAAAAAAAAAAAAAAECAwQF/8QAJxEAAgICAgIBBAIDAAAAAAAAAAECESExEkEDURMEYXHwMpEigaH/2gAMAwEAAhEDEQA/APPi9Q+Ihw9WUXNzDM0kTeDDiORIIHguajosX8QOKup19bFE7UpYajXrUM1Zpp5gKhNMsDoGUvYylmySQLEnRDnZzhiThXVWl+YMzS/KH6ZflnviE4uLVv1f+iXJ9FD68HROMR7kKZ2UH5i3EUSGXfeqMjRMuIcySJgdkG5Gif8A0xnwn1GYhr2sDdGvBOYua0QdLsd3Qd4TuH6mCcil+K5jz+yrOP5I7DbHNal8RlRvzOaQ4EZMoDnOc7c3K5t7yTEShjsoOtRrMqPloFMNeC4kgdkuABAmTMWvuQpeO6E+QMcceAVFSuXCDGs6I/8A0kF3w2V6b6umRucBx/Syo5uUu3CYkq7G4PDUvhhza81KbKh/mUhlzT2Y+FciN8KlOCeETUnsyGiVZkA1cJ8fNF7Q2e1gpvpvL6dUOLS4Q4Fph7XAWkEi4sUGGnqrUk1aCmSwuINMzEyCDcgweBFwbaq2q1sNeAQSTLSZuIMzvF/VOwgCT3T9Fs7H2Q+o4FzHtpDtEu7M8g03va8REpWUlimW7';
        $check_image = get_headers($image, 1);
        
        if (($check_image === false) || strpos($check_image['Content-Type'], 'image/') === false) {
            $song['values']['song_album_image'] = '../images/Moosic_T2.1.png';
        } else {
            $song['values']['song_album_image'] = $image;
        }   

var_dump($check_image);
var_dump($song['values']['song_album_image']);


?>

<?php include('../layouts/footer.php'); ?>
<!-- end HTML content -->