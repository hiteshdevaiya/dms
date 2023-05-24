/*
Template Name: Velzon - Admin & Dashboard Template
Author: Themesbrand
Version: 2.4.0
Website: https://Themesbrand.com/
Contact: Themesbrand@gmail.com
File: Common Plugins Js File
*/

//Common plugins
let dms_URL= 'http://localhost/DMS/public/';
if(document.querySelectorAll("[toast-list]") || document.querySelectorAll('[data-choices]') || document.querySelectorAll("[data-provider]")){ 
  document.writeln("<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/toastify-js'></script>");
  document.writeln("<script type='text/javascript' src='DMS/public/build/libs/choices.js/public/assets/scripts/choices.min.js'></script>");
  document.writeln("<script type='text/javascript' src='DMS/public/build/libs/flatpickr/flatpickr.min.js'></script>");    
}