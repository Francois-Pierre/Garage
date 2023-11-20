/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// You can specify which plugins you need
// import { Tooltip, Toast, Popover } from 'bootstrap';

// start the Stimulus application
import 'bootstrap';

import $ from 'jquery';

console.log('Le fichier JavaScript fonctionne correctement.');

function applyFilters() {
    const priceMin = document.getElementById("priceRangeMin").value;
    const priceMax = document.getElementById("priceRangeMax").value;
    const mileage = document.getElementById("mileage").value;
    const year = document.getElementById("year").value;
  
    $.ajax({
      url: '/filter',
      type: 'GET',
      data: { priceMin, priceMax, mileage, year },
      success: function (data) {
        // Mettez à jour les cards avec les résultats filtrés
      },
      error: function (error) {
        console.error('Error applying filters:', error);
      }
    });
  }
  // Attachez l'événement au chargement du DOM
document.addEventListener("DOMContentLoaded", function () {
    const applyFiltersButton = document.getElementById("applyFiltersButton");
  
    if (applyFiltersButton) {
      applyFiltersButton.addEventListener("click", applyFilters);
    }
  });