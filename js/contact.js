/* *******************************************************************
***
*Original Author: Auri Rosenberger
*Date Created: 26, August 2021
*Version: 1
*Date Last Modified: 17, September 2021
*Modified by: Auri Rosenberger
*Modification log:

- 09/03/2021 - Created contact.js
             - Brought in JavaScript that was included from Chapter 6's register_2.0
             - Lines 66-67 to give a confirmation alert versus redirecting to another page
             - Lines 77-78 fixed so that it wouldn't clash with navigation ul
- 09/17/2021 - Removed dropdown for country (revisited the 20th)
             - Put in regex and merged it with existing code/statements (revisited the 20th)
             - Added some [0] (revisited the 20th)
             - Edited if statement in the resetForm (revisited the 20th)

***
******************************************************************** */

"use strict";

const displayErrorMsgs = msgs => {
    const ul = document.createElement("ul");
    ul.classList.add("messages");

    for (let msg of msgs) {
        const li = document.createElement("li");
        const text = document.createTextNode(msg);
        li.appendChild(text);
        ul.appendChild(li);
    }

    const node = $("ul.messages");
    if (node.length == 0) {
        const form = $("form");

        form[0].parentNode.insertBefore(ul, form[0]);
    } else {
        node[0].parentNode.replaceChild(ul, node[0]);
    }
}

const processEntries = () => {
    const email = $("#email_address").val(); 
    const phone = $("#phone").val();
    const terms = $("#terms")[0].checked;
    const comments = $("#comments").val();

    const emailPattern = /^[\w\.\-]+@[\w\.\-]+\.[a-zA-Z]+$/;
    const phonePattern = /^\d{3}-\d{3}-\d{4}$/;

    const msgs = [];

    let isValid = true;
    if (!emailPattern.test(email) ) {
        isValid = false;
        msgs[msgs.length] = "Please enter a valid email.";
    }
    if (!phonePattern.test(phone) ) {
        isValid = false;
        msgs[msgs.length] = "Please enter a phone number in NNN-NNN-NNNN format.";
    }
    if (terms == false) {
        msgs[msgs.length] = "You must agree to the terms of service."; 
    }
    if (comments == "") {
        msgs[msgs.length] = "Please leave an entry for comments.";
    } 

    if (msgs.length == 0) {
        // alert("Submission successful! We'll be in contact!");
        resetForm(); //
    }
    else {
        displayErrorMsgs(msgs);
    }

};

const resetForm = () => {
    $("form")[0].reset();

    const errorMsg = $("ul.messages");
    if (errorMsg.length > 0) errorMsg.remove();
    
    $("#email_address").focus();
};

document.addEventListener("DOMContentLoaded", () => {
    document.querySelector("#submit").addEventListener("click", processEntries);
    document.querySelector("#reset_form").addEventListener("click", resetForm);  
    document.querySelector("#email_address").focus();
});