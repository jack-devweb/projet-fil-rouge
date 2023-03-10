<?php
session_start();?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-4Kt4HkFKzYX9PONoivP8S66xw39ZiD98l2zu4v/G8jtkWz68AZrwHfJ9G/MCv8gjWmZLDtLJQmPX7RjAHNQf5A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" type="text/css" href="style.css">

    <script src="script.js"></script>
    <title>fil rouge </title>
</head>

<body>
    <header id="main-header"> 
        <div id="time">12:00</div>
        <div id="right-icons">
          <i class="fa fa-signal"></i>
          <i class="fa fa-wifi"></i>
          <i class="fa fa-battery-full"></i>
        </div>
    </header>
    <div class="main-background">
        <div class="main-content">
            <h1>Bienvenue à CAT GAMING</h1>
            <p>Vivez pleinement les joies du chat gaming</p>
        </div>
    </div>
    <button class="full-rounded">
    <a href="login.php">
        <span>Continuer<i class="fas fa-arrow-right"></i></span>
        <span class="border"></span>
    </a>
</button>
 
</body>
</html>