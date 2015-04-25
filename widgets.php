<?php
/**
 * Plugin Name: Visitors Reorder Widgets
 * Description: Enables visitors to reorder widgets vertically on the front end.
 * Version: 1.1
 * Author: Izack Lesher
 * Author URI: http://itziklesher.triplebit.com
 * License: GPLv2 or later
 *
 *  Copyright 2015  Izack Lesher  (email : msher3@gmail.com)

 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License, version 2, as 
 *  published by the Free Software Foundation.

 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.

 *  You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
function vrwil_activate_Widget_Enques_and_Other() {

  // init all scripts
  wp_enqueue_script('jquery');
  wp_enqueue_script('jquery-ui-core');
  wp_enqueue_script('jquery-ui-sortable');
  wp_enqueue_script( 'vrwil_script1',plugins_url( '/js/script1.js' , __FILE__ ));
  wp_enqueue_style( 'vrwil_tabscss',plugins_url( '/css/tabs.css' , __FILE__ ));
  wp_enqueue_script( 'vrwil_tabajs',plugins_url( '/js/tabs.js' , __FILE__ ));
  

 // find out all the sidebars(widgetized areas)
  $dir = plugin_dir_path( __FILE__ );
  require_once($dir.'find_widgets.php');
  $widgets_element_and_classes = vrwil_find_out_widgets();

  $widgets_element_and_classes = array (
      'widget_Element_Type' => $widgets_element_and_classes[0],
      'widget_Class'        => $widgets_element_and_classes[1]
  ); //vrwil_activate_Widget_Enques_and_Other
       
  wp_localize_script( 'vrwil_script1', 'object_array2', $widgets_element_and_classes ); 
}

//-------------------------------------------------------------------------------
// Widget Code
// 
// Creating the widget 
class vrwil_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of widget
        'vrwil_widget', 

        // Widget name will appear in Admin UI
        __('Reorder Widgetst', 'vrwil_widget_domain'), 

        // Widget description
        array( 'description' => __( 'Widget enables control other widget\'s vertical order', 'vrwil_widget_domain' ), ) 
        );// parent::__construct(
    }// function __construct() {

    // Creating widget front-end
    // This is where the action happens (display on the frontend)
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
        // This is where you run the code and display the output
        // echo __( 'Hello, World1!', 'wpb_widget_domain' );
        //-------------tab html code--------------------------------------
        ?>
        <button>Click to reorder</button>
        <div class="tabs" style='z-index:100; position:absolute;background: silver; '>          
          <h3 id='dragAndDrop' onclick='vrwil_doYourJob_and_disappear(this);' style='margin-bottom:0; color:black;' ><a href="#">Drag and  Drop Widgets</a></h3>          
          <h3 id='restoreWebSiteOrder' onclick='vrwil_doYourJob_and_disappear(this);' style='margin-bottom:0;'><a href="#">Restore Web Site Order</a> </h3>
        </div>
        <?php
        //---------------------------------------------------
        echo $args['after_widget'];      
        // activate enques when widget actually displayed on frontend
        vrwil_activate_Widget_Enques_and_Other();
    }// public function widget( $args, $instance ) {

    // Widget Backend (on the admin)
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
        $title = $instance[ 'title' ];
        }
        else {
        $title = __( 'Reorder Widgets', 'vrwil_widget_domain' );
        }
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php 
    }// public function form( $instance ) {

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }// public function update(
} // Class wpb_widget ends here

// Register and load the widget
function vrwil_load_widget() {
  //add_action( 'wp_enqueue_scripts', 'callback1' );
	register_widget( 'vrwil_widget' );
}
add_action( 'widgets_init', 'vrwil_load_widget' );