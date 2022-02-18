<?php 
//*********************************************************
// Name     Date        Description
// -------- ----------- -----------------------------------
// Auri     02/04/2022  Initial deployment to show visit
//                      info by employee.
// Auri     02/11/2022  Refactor to use database/db
//                      constructor and visit functions.
//                      New navigation hyperlinks for admin
//                      and employee list pages.
// Auri     02/17/2022  Added a couple text-center tags to
//                      <main> and <table> for CSS
//                      formatting.
//*********************************************************

require_once ('./util/secure_conn.php');
require_once ('./util/valid_admin.php');

    try {
        require_once ('./model/database.php');
        require_once ('./model/visit.php');
        require_once ('./model/employee.php');
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        echo 'DB Error: ' . $error_message;
        exit();
    }

    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
        if ($action == NULL) {
            $action = 'list_visits';
        }
    }
    
    if ($action == 'list_visits') {
        $employee_id = filter_input(INPUT_GET, 'employee_id',
                FILTER_VALIDATE_INT);
        if ($employee_id == NULL || $employee_id == FALSE) {
            $employee_id = filter_input(INPUT_POST, 'employee_id',
                FILTER_VALIDATE_INT);
            if ($employee_id == NULL || $employee_id == FALSE) {
                $employee_id = 1;                
            }
            
        }
        try {
            $employees = EmployeeDB::getEmp();
            $visits = getVisitByEmp($employee_id);            
            
        } catch (PDOException $ex) {
            echo 'Error: ' . $ex->getMessage();
        }
    } else if ($action == 'delete_visit') {
        $visit_id = filter_input(INPUT_POST, 'visit_id',
                FILTER_VALIDATE_INT);
        $employee_id = filter_input(INPUT_POST, 'employee_id',
                FILTER_VALIDATE_INT);
        delVisit($visit_id);
        header("Location: admin.php?employee_id=$employee_id");
    }
?>

<!doctype html>
<!-------------------------------------------------------
  ---
#Original Author: Auri Rosenberger
#Date Created: 02, February 2022
#Version: 1
#Date Last Modified: 02, February 2022
#Modified by: Auri Rosenberger
#Modification log:
- 02/02/2022 - Week 3, project 3

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
    <link rel="stylesheet" href="css/styles.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>KYBG Pest Control: Admin</title>
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
    <main class="container my-5 contentSquished greenBorder text-center">

      <h1>Admin</h1>
      <h3>Select an employee to view the assigned visit information.</h3>
      <aside>
          <ul style="list-style-type: none;">
              <?php foreach ($employees as $employee) : ?>
              <li>
                  <a id="adminNameLinks" href="?employee_id=<?php echo $employee['employee_id']; ?>">
                      <?php echo$employee['first_name'] . ' ' . $employee['last_name']; ?>
                  </a>
              </li>
              <?php endforeach; ?>
          </ul>
      </aside>
      <table class="text-center">
          <tr>
              <th>Email</th>
              <th>Phone Number</th>
              <th>TOS</th>
              <th>Date</th>
              <th>Contact Method</th>
              <th>Message</th>
          </tr>
          <?php foreach ($visits as $visit) : ?>
          <tr>
              <td><?php echo $visit['email_address']; ?></td>
              <td><?php echo $visit['phone_number']; ?></td>
              <td><?php echo $visit['tos']; ?></td>
              <td><?php echo $visit['visit_date']; ?></td>
              <td><?php echo $visit['contact_method']; ?></td>
              <td><?php echo $visit['visit_comment']; ?></td>
              <td><form action="admin.php" method="post">
                      <input type="hidden" name="action"
                             value="delete_visit">
                      <input type="hidden" name="employee_id"
                             value="<?php echo $visit['employee_id']; ?>">
                      <input type="hidden" name="visit_id"
                             value="<?php echo $visit['visit_id']; ?>">
                      <input type="submit" value="Delete">
                  </form></td>
          </tr>
          <?php endforeach; ?>
      </table>

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