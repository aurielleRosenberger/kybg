/* *******************************************************************
***
*Original Author: Auri Rosenberger
*Date Created: 26, August 2021
*Version: 1
*Date Last Modified: 17, September 2021
*Modified by: Auri Rosenberger
*Modification log:

- 09/03/2021 - Created contact.js
             - Inserted code from Chapter 6's email_list
             - Lines 61-64 for alert after submission and form resets (along with other tweaked places)
- 09/17/2021 - Tweaked document.querySelector (revisited the 20th)
             - Added some [0] for some of the constants (revisited the 20th)
             - Merged regex, probably tweaked some other pieces (added the for loop near the bottom for the span) (revisited the 20th)
***
******************************************************************** */

"use strict";

// Old `$` method that can overwrite jQuery
// const $ = (selector) => document.querySelector(selector);
const select = (selector) => document.querySelector(selector);

// document.querySelector('#my-id')

document.addEventListener("DOMContentLoaded", () => {
    
    $("#join_list")[0].addEventListener("click", () => {
        const email1 = $("#email_1")[0];
        const email2 = $("#email_2")[0];
        const firstName = $("#first_name")[0];

        const emailPattern = /^[\w\.\-]+@[\w\.\-]+\.[a-zA-Z]+$/;
        const firstNamePattern = /^[a-zA-Z]+$/;

        let booleanVariable = true;

        if (!emailPattern.test(email1.value)) { 
            email1.nextElementSibling.textContent = "Please enter a valid email.";
            booleanVariable = false;
        }
        else {
            email1.nextElementSibling.textContent = "";
        }
    
        if (email2.value == "") { 
            email2.nextElementSibling.textContent = "Second email is required.";
            booleanVariable = false;
        }
        else {
            email2.nextElementSibling.textContent = "";
        }
    
        if (email1.value != email2.value) {
            email2.nextElementSibling.textContent = "Both emails must match.";
            booleanVariable = false;
        }
    
        if (!firstNamePattern.test(firstName.value)) {
            firstName.nextElementSibling.textContent = "First name is required.";
            booleanVariable = false;
        }
        else {
            firstName.nextElementSibling.textContent = "";
        }
    
        if (booleanVariable) { //
            resetForm(); //
            alert("You're all set, you will be notfied when there are discounts!"); //
        }
    });

    $("#clear_form")[0].addEventListener("click", () => {
        resetForm();
        $("#email_1")[0].focus();
    });
    
    $("#email_1")[0].focus();
});

function resetForm() { //
    $("#email_1")[0].value = "";
    $("#email_2")[0].value = "";
    $("#first_name")[0].value = "";

    for (const span of $("form span.star")) {
        span.textContent = "*";
    }

}
