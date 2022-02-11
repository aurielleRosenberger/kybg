<?php

/* Date           User            Description
 * -----------------------------------------------------------------
 * 02/11/2022     Arosenberger    Initial creation of visit
 *                                functions.
 * 
 */

function addVisit($email_address, $phone,
        $contact, $terms, $comments) {
    $db = Database::getDB();
    
$query = 'INSERT INTO visit
	(email_address, phone_number, contact_method, tos,
            visit_comment, visit_date, employee_id)
        VALUES
	(:email_address, :phone, :contact, :terms, :comments,
            NOW(), 2)';
    $statement = $db->prepare($query);
    $statement->bindValue(':email_address', $email_address);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':contact', $contact);
    $statement->bindValue(':terms', $terms);
    $statement->bindValue(':comments', $comments);
    $statement->execute();
    $statement->closeCursor();
}

function getVisitByEmp($employee_id) {
    $db = Database::getDB();
    $queryVisit =
               'SELECT visit.email_address, phone_number, 
                   tos, visit_date, contact_method,  visit_comment
                FROM visit
                JOIN employee
                ON visit.employee_id = employee.employee_id
                WHERE employee.employee_id = :employee_id
                ORDER BY visit_date';
            $statement2 = $db->prepare($queryVisit);
            $statement2->bindValue(":employee_id", $employee_id);
            $statement2->execute();
            $visits = $statement2;
            return $visits;
}

function delVisit($visit_id) {
    $db = Database::getDB();
    $queryDelete = 'DELETE FROM visit WHERE visit_id = :visit_id';
        $statement3 = $db->prepare($queryDelete);
        $statement3->bindValue(":visit_id", $visit_id);
        $statement3->execute();
        $statement3->closeCursor();
}

?>