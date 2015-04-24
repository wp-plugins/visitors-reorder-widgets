// flag to test if its the first time mouseenter.
// otherewise only mousedown activates the other times
flag_button_mouseenter=false;
jQuery(function($) {
      // disable on startup
      jQuery( slides ).sortable( "disable" );
      // first time needs only  mouseenter
      $('.widget_vrwil_widget button').on('mouseenter',function(){
        if (flag_button_mouseenter == false)// enter only in first time
      {
        $(this).hide();
        $('.widget_vrwil_widget .tabs').show();
        
        flag_button_mouseenter = true;
        
        //close tabs after 5 seconds if none is clicked by user
        setTimeout('vrwil_close_tabs_and_open_button()', 3000);
      }
   }); //  });//$('button').on('mouseenter',function(){
   
   
   if (document.querySelector){
   // make button width similar to widget  width
   var widget_width = $('.widget_vrwil_widget button').parent().width();
   document.querySelector('.widget_vrwil_widget button').style.width = widget_width + 'px';
   $('.widget_vrwil_widget button').css({ 
    'padding-left': '0',
    'padding-right': '0',
    'border-right': '0',
    'border-left': '0'
    });
    }
}); //jQuery(function($) {



function vrwil_close_tabs_and_open_button() {
  jQuery('.widget_vrwil_widget .tabs').hide();
  jQuery('.widget_vrwil_widget button').show();    
}
// expose the tabs and hide button when click
jQuery(function($) {
      var timerhandler = null;
      $('.widget_vrwil_widget button').on('mousedown',function(){
        $(this).hide();
        $('.widget_vrwil_widget .tabs').show(); 
        //flag_button_mouseenter = true;
        // if button clicks before timer trigers than clear to enable full 3 seconds again 
        clearTimeout(timerhandler);
        //close tabs after 5 seconds if none is clicked by user
        timerhandler = setTimeout('vrwil_close_tabs_and_open_button()', 3000);
   });
});

function vrwil_doYourJob_and_disappear(h3_item){
    var element = h3_item.id;

  if (element == 'dragAndDrop')
  {
    jQuery( slides ).sortable( "enable" );
    jQuery('#' + element).parent().css({ 
    'display': 'none'   
    });
    jQuery('.widget_vrwil_widget button').show();
  }
   else if (element == 'restoreWebSiteOrder')
  {
    jQuery( slides ).sortable( "disable" );
    jQuery('#' + element).parent().css({ 
    'display': 'none'   
    });
     jQuery('.widget_vrwil_widget button').show();
     location.reload();
  }
} 