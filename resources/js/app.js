require('./bootstrap');
var $ = require('jquery');

function trimString(titleText) {

  var length = 3;
  var trimmedString = titleText.substring(0, length);
}

function init() {

  var title = $(".appartments_container > h3");
  var titleText = title.text();

  trimString(titleText);
}

$(document).ready(init);
