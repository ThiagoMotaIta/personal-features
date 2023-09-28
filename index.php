<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
    <body>
        <div align="center">
            <img src="logo.png" />
            <h3>Quorum Coding Challenge</h3>
            Working with Legislative Data
        </div>
        <hr/>
        <div align="center">
            <p>
                <a class="btn btn-primary" href="legislators-support-oppose.php">Generate legislators-support-oppose-count.csv</a>
                <br/><br/>
                <a class="btn btn-primary" href="bills.php">Generate bills.csv</a>
            </p>
        </div>

        <div class="alert alert-warning" align="center">
            <?php
                $path = "csv/";
                $dir = dir($path);

                echo "Generated files list:<br />";
                while($file = $dir -> read()){
                echo "<a href='".$path.$file."'>".$file."</a><br />";
                }
                $dir -> close();
            ?>
        </div>
        <hr/>
        <div align="center">
            <small>Developed by: Thiago Mota 
                <br/> 
                <a href="mailto:thiagomotaita1@gmail.com">thiagomotaita1@gmail.com</a>
            </small>
        </div>
    </body>
</html>