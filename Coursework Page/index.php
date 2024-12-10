<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latoya Hall's PHP Course Page</title>
</head>
<style>
        body {
            background-color: #f0f4ff; 
            font-family: Arial, sans-serif; 
            color: #333; 
            margin: 20px; 
        }
        h1 {
            color: #4b0082; 
        }
        h2 {
            color: #5a5a5a; 
        }
        h3 {
            color: #4b0082; 
            border-bottom: 2px solid #8a2be2; 
            padding-bottom: 5px; 
        }
        a {
            color: #000080; 
            text-decoration: none; 
        }
        a:hover {
            text-decoration: underline; 
        }
        ul {
            list-style-type: none; 
            padding: 0; 
        }
        li {
            margin-bottom: 10px; 
        }
        /* Footer styles */
        footer {
            margin-top: 30px;
            text-align: center; 
            font-size: 0.9em;
            color: #888; 
        }
        
        li.final-project {
            list-style: none; 
            margin: 20px 0;
            text-align: center; 
        }

        li.final-project a {
            text-decoration: none; 
            font-size: 30px; 
            font-weight: bold; 
            color: #fff; 
            background-color: #ff5733; 
            padding: 15px 30px; 
            border: 3px solid #ffbd69; 
            border-radius: 10px; 
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); 
            transition: transform 0.2s, background-color 0.3s; 
        }

        li.final-project a:hover {
            background-color: #ffbd69; 
            color: #000; 
            transform: scale(1.1); 
        }
    
    </style>
<body>
    <h1> Fall 2024 PHP Coursework </h1>
    <h2> Latoya Hall </h2>

    <p>GitHub Repo: <a href="https://github.com/KayakCat/SE266-LatoyaH-PHP-SQL/tree/main" target="_blank">My GitHub Repo</a></p>

   
    <h3>PHP Learning Resources</h3>
    <ul>
        <li><a href="https://www.codecademy.com/catalog/language/php" target="_blank">Codecademy</a></li>
        <li><a href="https://www.w3schools.com/php/" target="_blank">W3Schools PHP Tutorial</a></li>
        <li><a href="https://phptherightway.com/" target="_blank">PHP The Right Way</a></li>
    </ul>

    <h3>Git Learning Resources</h3>
    <ul>
        <li><a href="https://git-scm.com/doc" target="_blank">Git Documentation</a></li>
        <li><a href="https://www.atlassian.com/git/tutorials" target="_blank">Atlassian Git Tutorials</a></li>
        <li><a href="https://www.w3schools.com/git/" target="_blank">W3Schools Git Tutorial</a></li>
    </ul>

    <h3>My personal hobbies</h3>
    <ul>
        <li><a href="https://www.rimonthly.com/six-best-spots-for-kayaking-in-rhode-island/" target="_blank">Kayaking</a></li>
        <li><a href="https://www.alltrails.com/" target="_blank">Hiking</a></li>
        <li><a href="https://www.nal.usda.gov/plant-production-gardening/vegetable-gardening" target="_blank">Gardening</a></li>
    </ul>


    
    <h3>Lab Solutions</h3>
    <ul>
        <li><a href="http://localhost/SE266-PHP-SQL/Coursework%20page/index.php" target="_blank">Week 2 - Coursework Page</a></li>
        <li><a href="http://localhost/SE266-PHP-SQL/Week%202/index.php" target="_blank">Week 2 - Patient Intake Form</a></li>
        <li><a href="http://localhost/SE266-PHP-SQL/Week%203/atm.php" target="_blank">Week 3 - ATM</a></li>
        <li><a href="http://localhost/SE266-PHP-SQL/Week%204/index.php" target="_blank"> Week 4 - Patient EHR CRUD</a></li>
        <li><a href="http://localhost/SE266-PHP-SQL/Week%205/index.php" target="_blank">Week 5 - EHR CRUD Continued</a></li>
        <li><a href="http://localhost/SE266-PHP-SQL/Week%206/index.php" target="_blank">Week 6 - Patient Search</a></li>
        <li><a href="" target="_blank">Week 7</a></li>
        <li><a href="" target="_blank">Week 8</a></li>
        <li><a href="" target="_blank">Week 9</a></li>
        <li class="final-project"><a href="http://localhost/SE266-PHP-SQL/Final%20Project/index.php" target="_blank">FINAL PROJECT</a></li>
    </ul>

    <?php include 'includes/index_footer.php'; ?>

</body>
</html>
