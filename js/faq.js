/* *******************************************************************
***
*Original Author: Auri Rosenberger
*Date Created: 26, August 2021
*Version: 1
*Date Last Modified: 09, September 2021
*Modified by: Auri Rosennberger
*Modification log:

- 09/02/2021 - Added event handler for clicking to expand infomation in FAQ
- 09/03/2021 - Replaced the if-else statements with original toggles
- 09/08/2021 - Brought in JavaScript that was included from Chapter 9's slide_show_fading_2
- 09/09/2021 - Commented out JavaScript from FAQ to replace with jQuery accordion from Chapter 11 (not placed in this file though)
             - 
***
******************************************************************** */

"use strict";

// const $ = selector => document.querySelector(selector);

/* const toggle = evt => {
    evt.preventDefault();
    const linkElement = evt.currentTarget;
    const h2Element = linkElement.parentNode;
    const divElement = h2Element.nextElementSibling;

    h2Element.classList.toggle('minus');
    divElement.classList.toggle('open');
};

document.addEventListener("DOMContentLoaded", () => {
    
    const linkElements = faqDirect.querySelectorAll("#faqDirect a"); //
    
    for (let linkElement of linkElements) {
        linkElement.addEventListener("click", toggle);
    }
    
    linkElements[0].focus();
}); */

// \\ \\ \\ \\ \\ \\ \\ \\ \\ \\ \\ JavaScript for Pest Library page/file // // // // // // // // // //

$(document).ready( () => {
    let nextSlide = $("#slides img:first-child");
    
    setInterval( () => {   
        $("#caption").fadeOut(1500);
        $("#slide").fadeOut(1500,
            () => {
                if (nextSlide.next().length == 0) {
                    nextSlide = $("#slides img:first-child");
                }
                else {
                    nextSlide = nextSlide.next();
                }
                const nextSlideSource = nextSlide.attr("src");
                const nextCaption = nextSlide.attr("alt");
                $("#slide").attr("src", nextSlideSource).fadeIn(1500);                    
                $("#caption").text(nextCaption).fadeIn(1500);
            });
    },
    5000);
});
