/*
*
* Backpack Crud
*
*/

jQuery(document).ready(function($){

    'use strict';

    console.log('crud.js');
    setTimeout(function()
    {
      AdminSpaceForm($);
    }, 1000);
    /*($('body').hasClass('segment-space'))
   {
    AdminSpaceForm($);
  }*/
});

function AdminSpaceForm($)
{
 console.log('AdminSpaceForm');

 var locationField = $('input[name="location"]'),
     postcodeField = $('input[name="zip"]'),
     streetField = $('input[name="street"]'),
     cityField = $('input[name="city"]'),
     stateField = $('input[name="state"]'),
     countryField = $('input[name="country"]'),
     locationAutocomplete = $('.ap-input');

 locationAutocomplete.on('change', function()
 {
  var suggestion = JSON.parse(locationField.val());

  if(confirm('Do you want it auto fills those fields'))
  {
   if(suggestion.postcode) postcodeField.val(suggestion.postcode);
   if(suggestion.city) cityField.val(suggestion.city);
   if(suggestion.administrative) stateField.val(suggestion.administrative);
   if(suggestion.country) countryField.val(suggestion.country);

   if(suggestion.type=='city')
   {
    cityField.val(suggestion.name);
   }else if(suggestion.type=='address')
   {
    streetField.val(suggestion.name);
   }
  }
 });
}//end AdminSpaceForm
