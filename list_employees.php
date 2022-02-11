<?php 

/* Date           User            Description
 * -----------------------------------------------------------------
 * 02/11/2022     Arosenberger    Initial creation of page to list
 *                                employee data.
 * 
 */

        $dsn = 'mysql:host=localhost;dbname=kybgpc';
        $username = 'pcuser';
        $password = 'Pa$$w0rd';
        $db = new PDO($dsn, $username, $password);

        require_once ('./model/database.php');
        require_once ('./model/employee.php');
        
        $employees = EmployeeDB::getEmployees();

?>

<!doctype html>
<!-------------------------------------------------------
  ---
#Original Author: Auri Rosenberger
#Date Created: 26, August 2021
#Version: 1
#Date Last Modified: 17, September 2021
#Modified by: Auri Rosenberger
#Modification log:
- 09/03/2021 - Week 2, project 2
             - Brought in some HTML from Chapter 6's register_2.0
- 09/17/2021 - Removed div with dropdown for country option(s) (revisited the 20th)
             - Added some new classes for CSS mobile handling: limitComments, labelLatel, buttonPlace, copyrightPlace,
               contentSquished, frontPage, greenBorder (revisited 22nd)
---
------------------------------------------------------->
<html lang="en">
  <head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="description" content="We share the world with pests whether we like it or not, but that doesn't mean we have to share the same roof!">
    <meta name="keywords" content="HTML5 framework, Bootstrap, CSS, JavaScript, pest control, insects, bed bugs, fleas, termites, mice,
    rats, cockroaches, ants, exterminator">
    <meta name="author" content="Auri/Aurielle Rosenberger">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
	  <link rel="icon" sizes="192x192" href="images/android-chrome-192x192.png">

    <!-- CSS -->
    <link rel="stylesheet" href="css/contact.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>KYBG Pest Control: Contact</title>
  </head>
  <body>

    <!-- Bootstrap Jumbotron -->
    <header class="jumbotron jumbotron-fluid text-center mb-0">
      <div class="container">
        <h1 class="display-3 frontPage">KYBG Pest Control</h1>
      </div>
    </header>
    <!-- Bootstrap Navigation Bar -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
      <a class="navbar-brand" href="#"></a>

      <!-- Hamburger Menu -->
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Links -->
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link" href="pest_library.html">Pest Library</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.html">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.html">Contact</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="faq.html">FAQ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="newsletter.html">Newsletter</a>
          </li>
          
          <!-- 02/11/2022 ~ New navigation hyperlinks for pages -->
          <li class="nav-item">
            <a class="nav-link" href="admin.php">Admin</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="list_employees.php">Employee List</a>
          </li>
      </ul>
    </div>
    </nav>

    <!-- Main Content Area -->
    <main class="container my-5 contentSquished greenBorder">

      <h1>Employee List</h1>
      <p>
      <ul style="list-style-type: none;">
          <?php foreach ($employees as $employee) : ?>
          <li> <?php echo $employee->getLastName() . ', '
                  . $employee->getFirstName(); ?> </li>
          <?php endforeach; ?>
      </ul>
      </p>
      
      <!-- Old form spot -->

    </main>

    <div class="jumbotron" id="bugsIconBackground">
    <!-- Footer -->
    <footer class="jumbotron-fluid text-center bg-dark p-3">

      <div class="container text-white">
        <p class="copyrightPlace">&copy; Copyright 2021. | All Rights Reserved. | Auri Rosenberger.</p>
      </div>
      
    </footer>
  </div>
    <script src="js/contact.js"></script>
  </body>
</html>