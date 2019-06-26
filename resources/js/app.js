require('./bootstrap');
// var $ = require('jquery');

function trimString(titleText) {

  var length = 3;
  var trimmedString = titleText.substring(0, length);
}

function atLeastOne() {

  var form = $('form.search-form');
  var input = form.find('input');

    if (input.val(' ')) {
        $('.genErr').show();
      }
}
// validazione client-side
function validationJQuery() {

  $.validator.addMethod('positiveNumber',
    function (value) {
        return Number(value) > 0;
    }, 'INSERISCI UN NUMERO POSITIVO');

  $('form:not(.search-form)').each(function() {
    $(this).validate({
      rules: {
        img_path: {
          required: true,
          accept: "image/*"
        },
        title: "required",
        description: {
          required: true,
          minlength: 10
        },
        radius: {
          required: true
        },
        address: {
          required: true
        },
        rooms: {
          required: true,
          // number: true,
          positiveNumber: true
        },
        beds: {
          required: true,
          number: true,
          positiveNumber: true
        },
        bathrooms: {
          required: true,
          number: true,
          positiveNumber: true
        },
        mq: {
          required: true,
          number: true,
          positiveNumber: true,
          min: 20
        },
      },
      messages: {
        img_path: {
          required: "QUESTO CAMPO È OBBLIGATORIO",
          accept: "INSERISCI SOLO FILE D'IMMAGINE"
        },
        title: {
          required: "QUESTO CAMPO È OBBLIGATORIO"
        },
        description: {
          required: "QUESTO CAMPO È OBBLIGATORIO",
          minlength: jQuery.validator.format("INSERISCI ALMENO {0} CARATTERI")
        },
        radius: {
          required: "QUESTO CAMPO È OBBLIGATORIO"
        },
        address: {
          required: "QUESTO CAMPO È OBBLIGATORIO",
          number: "INSERISCI UN NUMERO VALIDO"
        },
        rooms: {
          required: "QUESTO CAMPO È OBBLIGATORIO",
          number: "INSERISCI UN NUMERO VALIDO"
        },
        beds: {
          required: "QUESTO CAMPO È OBBLIGATORIO",
          number: "INSERISCI UN NUMERO VALIDO"
        },
        bathrooms: {
          required: "QUESTO CAMPO È OBBLIGATORIO",
          number: "INSERISCI UN NUMERO VALIDO"
        },
        mq: {
          required: "QUESTO CAMPO È OBBLIGATORIO",
          number: "INSERISCI UN NUMERO VALIDO",
          min: "INSERISCI UNA METRATURA UGUALE O SUPERIORE A 20"
        },
      }
    });
  });
}

function init() {

  var title = $(".appartments_container > h3");
  var titleText = title.text();
  trimString(titleText);

  // activeAppColor();
  $('.searchBtn').click(function() {

    validationSearchForm();
  });

  validationJQuery();
}

$(document).ready(init);
