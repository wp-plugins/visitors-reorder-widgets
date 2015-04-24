

jQuery(function($) { 

// add style to reduce margin-bottom from title to the bottom
$('.widget h3').css({ 
    'margin-bottom': '0'   
    });

var widget_element_type = object_array2.widget_Element_Type;// aside in 2015
var widget_class = object_array2.widget_Class;
  // make widget_class global since used in tabs.js
  vrwil_widget_class_global = widget_class;
  
// following make slides GLOBAL automatically
slides = $('.' + widget_class).parent();// should be widget-area in 2015
var widget_element_selector = $(widget_element_type);

slides.css({ 
  'overflow': 'auto'
});

slides.sortable({
     axis:'y',              // options
     revert: 300,
     placeholder: 'sortable-placeholder',
     cursor: 'move',
     tolerance:'pointer',
     start: function(){
     slides.addClass('sorting');
  }, // start: function(){
     stop: function(){
       slides
         .addClass('sort-stop')
         .removeClass('sorting');
       setTimeout(function(){
         slides.removeClass('sort-stop'); //:( ugly hack
       }, 310); //  setTimeout(function(){
      }///, // stop: function(){
  }); //slides.sortable({
}); // jQuery(function($) { 