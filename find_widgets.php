<?php
/*
// find out all the sidebars(widgetized areas)
*/
function vrwil_find_out_widgets()
{
  // declare variables to be passed to jQjuery
  $widget_element_type ="";
  $widgets_info[] = null;
  foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) 
     { 

        $classes_array = [];// init
        $class_string = $sidebar[before_widget];
        
        // find out the widget element(aside, div, etec.)
        $widget_element_type_start = 1;// must be just one after the '<' 
        $widget_element_type_start_end = strpos($class_string," ", $widget_element_type_start);
        $widget_element_type = substr($class_string, $widget_element_type_start,
                $widget_element_type_start_end);       
        $widgets_info[0] = $widget_element_type;                
        $class_attribute_position = strpos($class_string,'class');
        if ($class_attribute_position !== false)
        {           
             $class_value_start_position_double_quotes = strpos($class_string, '"', $class_attribute_position) + 1;
             $class_value_start_position_single_quotes = strpos($class_string, "'", $class_attribute_position) + 1;
             if (($class_value_start_position_single_quotes == false) || 
                     ($class_value_start_position_single_quotes < 5 ))
             {
                 $class_value_start_position = $class_value_start_position_double_quotes;
             }
             if (($class_value_start_position_double_quotes == false) || 
                     ($class_value_start_position_double_quotes < 5 ))
             {
                 $class_value_start_position = $class_value_start_position_single_quotes;
             }
             
             // find the last character position. It could be ended with ",' or space
             $class_value_position_end_double_quotes = strpos($class_string, '"', $class_value_start_position);
             $class_value_position_end_single_quotes = strpos($class_string, '\'', $class_value_start_position);
             $class_value_position_end_space = strpos($class_string, ' ', $class_value_start_position);
             // actual value is the smaller value
             if ($class_value_position_end_double_quotes !== false ||
                    ($class_value_position_end_double_quotes > $class_value_start_position ))
             {
                 $class_value_position_end = $class_value_position_end_double_quotes;
             }
             if ($class_value_position_end_single_quotes !== false||
                    ($class_value_position_end_single_quotes > $class_value_start_position ))
             {
                  if ($class_value_position_end_single_quotes < $class_value_position_end_double_quotes)
                    $class_value_position_end = $class_value_position_single_quotes;
             }
             if (($class_value_position_end_space !== false)||
                    ($class_value_position_end_space > $class_value_start_position ))
             {
                 if ($class_value_position_end > $class_value_position_end_space)
                 {
                     $class_value_position_end = $class_value_position_end_space;
                 }
             }
                 
            
        }//if ($class_attribute_position !== false)
        else 
        {
             error_log( "$class_attribute_position == false" ); 
        }////if ($class_attribute_position !== false)
      
        // calculatr the actual class
        $class_value_length = $class_value_position_end - $class_value_start_position;
        $class_value = substr($class_string, $class_value_start_position, $class_value_length);
        // array_push($classes_array, "class1");
        array_push($widgets_info, $class_value);
        
        
     }//foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) 
  return $widgets_info;
}// function find_out_sidebars()find_out_sidebars()
