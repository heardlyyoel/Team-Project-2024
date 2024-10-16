<?php
session_start(); // Mulai session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BliblioBook - Presuniv</title>
    <link rel="stylesheet" href="css/style.css">    
    <style>
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
</head>
<body>
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
                    <li><a class="li-a-nav" href="logout.php">logout</a></li>
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
    <main>
        <div class="container-library">
            <div class="container-image-library">
                <img class="image-library" src="Images/library-illustration-fr.jpg" >
            </div>
            <div class="container-library-a-sec">
                <div class="library-a-sec">
                    <h1>Library</h1>
                    <p class="p-bold">Campus library is too far!</p>
                    <p>
                        We provide for You  a place where you can order books from the campus library. 
                        That way you still got a free time and your feet will not get sore anymore :D
                    </p>
                    <p style="margin-top: 6rem; font-size: 1.1rem;">
                        View <b><a href="index.php" class="a-sec" data-replace="Library"><span>Library</span></a></b>
                    </p>
                </div>
            </div>
        </div>
        <div class="container-sec2">
            <div class="container-sec2-p">
                <h1 class="sec2-p-bold">EXPLORE THIS WEBSITE</h1>
                <p class="sec2-p">by exploring this website, you will find something very extraordinary, that you have never found, where we will provide all the best features that are still in development</p>
            </div>
            <div class="container-sec2-nav">
                <div class="container-sec2-nav-a"> 
                    <a class="sec2-nav-a" href="index.php">
                        <img class="sec2-nav-img-library" src="Images/Icon/books (1).png">
                    </a>
                        <p class="sec2-a-p">~~<strong>All Book</strong>   This feature will display all books that are available for loan, these books belong to our literacy friends~~</p>
                </div>
                <div class="container-sec2-nav-a">
                    <a class="sec2-nav-a" href="bookmark_list.php">
                        <img class="sec2-nav-img-thumbtack" src="Images/Icon/thumbtack.png">
                    </a>
                        <p class="sec2-a-p">~~<strong>Bookmarking</strong> is a place where when you are looking for a book and you are interested in a book but are still not sure about borrowing it, therefore you will bookmark it and you will see it here~~</p>
                </div>
                <div class="container-sec2-nav-a">
                    <a class="sec2-nav-a" href="rent_list.php">
                        <img class="sec2-nav-img-cart" src="Images/Icon/shopping-cart.png">
                    </a>
                        <p class="sec2-a-p">~~Are you interested in the book?
                            You can borrow them, and they will all be visible here, but don't forget only the ones that are still available~~</p>                
                </div>
            </div>        
        </div>
        <div class="container-sec3" style="background-color: #FDFDFD;">
            <div class="container-sec3-p">
            </div>
            <div class="container-sec3-nav">
            </div>
        </div>
    </main>
    <div class="footer">
        <p style="font-size: xx-large; margin-top: 0; margin-bottom: 0; margin-left: 200px;">Blibliobook</p>
        <hr style="margin-left: 200px; margin-right: 200px;">
        <p style="font-size: large; margin-top: 30px; margin-bottom: 0; margin-left: 200px;">Powered by President University Information System</p>
    </div>
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