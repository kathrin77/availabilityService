<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.toast.min.js"></script>
        <script type="text/javascript" src="js/toast.js"></script>
        <script type="text/javascript" src="js/worker.js"></script>

        <link rel="stylesheet" type="text/css" href="css/jquery.toast.min.css"/>
        <link rel="stylesheet" type="text/css" href="css/availabilityStyle.css"/> 

        <title>Availability Service</title>
    </head>
    <body>
        


        <div class="logo">
            <a href="https://www.unisg.ch/universitaet/bibliothek"><img src="img/hsg_logo_de.jpg" width="180px" alt="HSG-Bibliothek"></a>
        </div>
        <header>Verfügbarkeit Kleinmaterialien</header>
        <nav>
            <ul id="navi">
                <li><a href="index.php"><img src="img/refresh.png" alt="Refresh"></a></li>
                <li><a href="info.php"><img src="img/info.png" alt="Info"></a></li>
            </ul>

        </nav>
        <div id="search">
            <input type="text" placeholder="Suche nach..." id="filter-search"/>
        </div>
        <div id="loading"></div>
        <div id="items"></div>
        
        <footer>
            <address>
                <a href="https://www.unisg.ch/universitaet/bibliothek" >HSG-Bibliothek</a> &bull; 
                <a href="mailto:bibliothek@unisg.ch">bibliothek@unisg.ch</a> &bull; 
                +41 71 224 22 70 &bull;
                Dufourstrasse 50 &bull; 
                CH-9000 St.Gallen
            </address>
        </footer>

    </body>
</html>
