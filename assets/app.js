/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
import $ from 'jquery';
// start the Stimulus application
import 'bootstrap';
// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// You can specify which plugins you need
// import { Tooltip, Toast, Popover } from 'bootstrap';


$(function() {
  const applyFiltersButton = $('#applyFiltersButton');
  const filterInputs = $('.filter-input');

  // Fonction pour appliquer les filtres
  const applyFilters = async () => {
    const targetYear = parseInt($('#year').val()) || 0;
    const targetMileage = parseInt($('#mileage').val()) || 0;
    const targetPrice = parseInt($('#price').val()) || 0;
console.log(targetPrice);
    try {

        const requestData = {};
              
        // Vérifie si les valeurs sont valides avant de les inclure dans la requête

        if (!isNaN(targetYear) && targetYear !== 0) {
          requestData.year = targetYear;
        }
        if (!isNaN(targetMileage) && targetMileage !== 0) {
          requestData.Mileage = targetMileage;
        }
        if (!isNaN(targetPrice) && targetPrice !== 0) {
          requestData.Price = targetPrice;
        }

        const response = await $.ajax({
          url: '/filter',
          method: 'GET',
          data: requestData,
      });

      console.log(requestData);

      // Remplace le contenu de la div qui contient les cartes
      $('.cartes-container').html(response);

    } catch (error) {
      console.error('Erreur AJAX :', error);
    }
  };

  // Associe l'événement click au bouton "Valider"
  applyFiltersButton.on('click', applyFilters);

  // Associe l'événement keyup à tous les champs de filtre pour déclencher l'application des filtres
  filterInputs.on('keyup', function(event) {
    // Applique les filtres si la touche "Enter" est pressée
    if (event.key === 'Enter') {
      applyFilters();
    }
  });
});