<?php

/* Date           User            Description
 * -----------------------------------------------------------------
 * 02/11/2022     Arosenberger    Initial creation of employee
 *                                and employeeDB model.
 * 
 */

class Employee {
    private $first_name, $last_name;
    public function __construct($first_name, $last_name) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }
    public function getFirstName() {
        return $this->first_name;
    }
    public function getLastName() {
        return $this->last_name;
    }
}

class EmployeeDB {
    public static function getEmployees() {
        $db = Database::getDB(); // Connects to database
        $query = 'SELECT first_name, last_name FROM employee '
                . 'ORDER BY last_name';
        // Then prepare, execute, fetchAll, closeCursor
        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        
        $employees = array();
        foreach ($rows as $row) {
            $employeeObject = new Employee($row['first_name'],
                    $row['last_name']);
            $employees[] = $employeeObject;
        }
        return $employees;
    }
    public static function getEmp() {
        $db = Database::getDB(); // Connects to db
        $queryEmployee = 'SELECT * FROM employee';
            $statement1 = $db->prepare($queryEmployee);
            $statement1->execute();
            $employees = $statement1;
            return $employees;
    }
}

?>