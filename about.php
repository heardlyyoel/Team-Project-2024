<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Bibliotukar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="css/style.css">
</head>
<style>
    .myorder{
    border: dotted;
    border-width: 3;
    display: flex;
    align-items: center;
    justify-content: center;
}
.myorder button {
    border: none;
    height: 30px;
    background-color: #FDFDFD;
    margin-left: 100px;
    margin-right: 100px;
    padding: 10px 20px;
    font-size: x-large;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    color: #062D52;
    cursor: pointer;
    padding-top: 0;
}
.content {
    color: #062D52;
    font-size: 3vh;
    font-weight: bold;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    font-style: italic;
    width: 1000px;
    justify-content: center;
    margin-left: 25%;
}
    .footer {
        background-color: #062D52;
        color: #EFF2F9;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        font-weight: bold;
        height: 150px;
        margin: 0;
        left: 0;
        right: 0;
    }
    </style>

<>
<nav id="navbar">
        <div class="container-logo">
            <a href="home.php">
                <img class="logo-a-img" src="Images/logo-nav.svg">
            </a>
            <div class="container-logo-a-nav">
                <a href="home.php" class="logo-a-nav">
                    Blibliobook
                </a>
            </div>
        </div>
        <div>
            <div id="vertical-line">
            </div>
            <div class="container-li-a-nav">
                <ul class="ul-a-nav";>
                    <li><a class="li-a-nav" href="index.php">Library</a></li>
                    <li><a class="li-a-nav" href="rent_list.php">Rent</a></li>
                    <li><a class="li-a-nav" href="profile.php">Profile</a></li>
                    <li><a class="li-a-nav" href="myCollection.php">Mycollection</a></li>
                    <li><a class="li-a-nav" href="about.php">About</a></li>
                    <li><a class="li-a-nav" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header>
        <div class="container-logo-a-header">
            <a href="home.php" class="logo-a-header">
                Blibliobook
            </a>
        </div>  
    </header>

<div class="myorder">
<button>About Biblio</button>
<button>About Biblio</button>
<button>The Builder</button>
    </div>


<div class="content">
        <p>"A room without books is like a body without a soul. Life without books is like a dark room without lights."</p> <br>
        <p>Bliliobook is a web service that allows users to easily engage with books from the campus library without needing to go there. Our platform is designed to create a knowledge-sharing ecosystem, facilitating broader access to literature without financial barriers. Our goal is to focus on providing readers from the President' University with easy access to book exploration, room reservations, and community connections. This can lead to stronger relationships between everyone from different groups, communities, or forums.</p>
    </div>
    <div class="footer">
        <p style="font-size: xx-large; margin-top: 0; margin-bottom: 0; margin-left: 200px;">Blibliobook</p>
        <hr style="margin-left: 200px; margin-right: 200px;">
        <p style="font-size: large; margin-top: 30px; margin-bottom: 0; margin-left: 200px;">Powered by President University Information System</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    
    <script src="script.js"></script>
</body>
<script>
        window.onscroll = function() {scrollFunction()};
        
        function scrollFunction() {
            if (document.documentElement.scrollTop > 67.5 ) {
                document.getElementById("navbar").style.top = "0";
            } else {
                document.getElementById("navbar").style.top = "";
            }
        }
    </script>
</html>