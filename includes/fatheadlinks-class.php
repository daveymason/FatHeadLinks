<?php
class Fathead_Links_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		parent::__construct(
			'fathead_links_widget', // Base ID
			esc_html__( 'Fathead Links Widget', 'sl_domain' ), // Name
			array( 'description' => esc_html__( 'Adds fathead media icon links to widgets', 'sl_domain' ), ) // Args
		);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
        $links = array(
            'facebook' => esc_attr($instance['facebook_link']),
            'instagram' => esc_attr($instance['instagram_link']),
            'deliveroo' => esc_attr($instance['deliveroo_link']),
			'email' => esc_attr($instance['email_link']),
            'phone' => esc_attr($instance['phone_link']),
        );

        $icons = array(
            'facebook' => esc_attr($instance['facebook_icon']),
            'instagram' => esc_attr($instance['instagram_icon']),
            'deliveroo' => esc_attr($instance['deliveroo_icon']),
			'email' => esc_attr($instance['email_icon']),
            'phone' => esc_attr($instance['phone_icon']),

            'icon_width' => esc_attr($instance['deliveroo_icon']),
        );

        $icon_width=$instance['icon_width'];

        echo $args['before_widget'];

        //Call frontend function - learn more here
        $this->getFatheadLinks($links, $icons, $icon_width);

        echo $args['after_widget'];
       
	}

	/**
	 * Outputs the options form on admin learn more here
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
        //Call backend Function
        $this->getForm($instance);
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
        // Get the links from user
		$instance = array(
            'facebook_link' => (!empty($new_instance['facebook_link'])) ? strip_tags($new_instance['facebook_link']) : '',
            'instagram_link' => (!empty($new_instance['instagram_link'])) ? strip_tags($new_instance['instagram_link']) : '',
            'deliveroo_link' => (!empty($new_instance['deliveroo_link'])) ? strip_tags($new_instance['deliveroo_link']) : '',
			'email_link' => (!empty($new_instance['email_link'])) ? strip_tags($new_instance['email_link']) : '',
            'phone_link' => (!empty($new_instance['phone_link'])) ? strip_tags($new_instance['phone_link']) : '',

            'facebook_icon' => (!empty($new_instance['facebook_icon'])) ? strip_tags($new_instance['facebook_icon']) : '',
            'instagram_icon' => (!empty($new_instance['instagram_icon'])) ? strip_tags($new_instance['instagram_icon']) : '',
            'deliveroo_icon' => (!empty($new_instance['deliveroo_icon'])) ? strip_tags($new_instance['deliveroo_icon']) : '',
			'email_icon' => (!empty($new_instance['email_icon'])) ? strip_tags($new_instance['email_icon']) : '',
            'phone_icon' => (!empty($new_instance['phone_icon'])) ? strip_tags($new_instance['phone_icon']) : '',
        
            'icon_width' => (!empty($new_instance['icon_width'])) ? strip_tags($new_instance['icon_width']) : ''
        );
        return $instance;
    }

    
    	/**
	 * Gets and Displays Form
	 *
	 * @param array $instance The widget options
	 */
	public function getForm( $instance ) {
       //Get fathead links
       if(isset($instance['facebook_link'])){
        $facebook_link = esc_attr($instance['facebook_link']);
       } else {
           $facebook_link = 'https://www.facebook.com';
       }  
       
       if(isset($instance['instagram_link'])){
        $instagram_link = esc_attr($instance['instagram_link']);
       } else {
           $instagram_link = 'https://www.instagram.com';
       } 

       if(isset($instance['deliveroo_link'])){
        $deliveroo_link = esc_attr($instance['deliveroo_link']);
       } else {
           $deliveroo_link = 'https://www.deliveroo.com';
       } 

	   if(isset($instance['email_link'])){
        $email_link = esc_attr($instance['email_link']);
       } else {
           $email_link = 'mailto:info@osaka.ie';
       } 

	   if(isset($instance['phone_link'])){
        $phone_link = esc_attr($instance['phone_link']);
       } else {
           $phone_link = 'tel:0214274317';
       } 

       //ICONS

       if(isset($instance['facebook_icon'])){
        $facebook_icon = esc_attr($instance['facebook_icon']);
       } else {
           $facebook_icon = plugins_url() . '/fatheadlinks/img/facebook.png';
       }  
       
       if(isset($instance['instagram_icon'])){
        $instagram_icon = esc_attr($instance['instagram_icon']);
       } else {
           $instagram_icon= plugins_url() . '/fatheadlinks/img/instagram.png';
       } 

       if(isset($instance['deliveroo_icon'])){
        $deliveroo_icon = esc_attr($instance['deliveroo_icon']);
       } else {
           $deliveroo_icon = plugins_url() . '/fatheadlinks/img/deliveroo.png';
       } 

	   if(isset($instance['email_icon'])){
        $email_icon = esc_attr($instance['email_icon']);
       } else {
           $email_icon = plugins_url() . '/fatheadlinks/img/email.png';
       } 

	   if(isset($instance['phone_icon'])){
        $phone_icon = esc_attr($instance['phone_icon']);
       } else {
           $phone_icon = plugins_url() . '/fatheadlinks/img/phone.png';
       }

       if(isset($instance['icon_width'])){
        $icon_width = esc_attr($instance['icon_width']);
       } else {
           $icon_width = 32;
       }

       ?>
     	<h4>Facebook</h4>
		<p>
		<label for="<?php echo $this->get_field_id('facebook_link'); ?>"><?php _e('Link:'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('facebook_link'); ?>" name="<?php echo $this->get_field_name('facebook_link'); ?>" type="text" value="<?php echo esc_attr( $facebook_link); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('facebook_icon'); ?>"><?php _e('Icon:'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('facebook_icon'); ?>" name="<?php echo $this->get_field_name('facebook_icon'); ?>" type="text" value="<?php echo esc_attr( $facebook_icon); ?>">
		</p>

		<h4>Instagram</h4>
		<p>
		<label for="<?php echo $this->get_field_id('instagram_link'); ?>"><?php _e('Link:'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('instagram_link'); ?>" name="<?php echo $this->get_field_name('instagram_link'); ?>" type="text" value="<?php echo esc_attr( $instagram_link); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('instagram_icon'); ?>"><?php _e('Icon:'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('instagram_icon'); ?>" name="<?php echo $this->get_field_name('instagram_icon'); ?>" type="text" value="<?php echo esc_attr( $instagram_icon); ?>">
		</p>

		<h4>Deliveroo</h4>
		<p>
		<label for="<?php echo $this->get_field_id('deliveroo_link'); ?>"><?php _e('Link:'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('deliveroo_link'); ?>" name="<?php echo $this->get_field_name('deliveroo_link'); ?>" type="text" value="<?php echo esc_attr( $deliveroo_link); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('deliveroo_icon'); ?>"><?php _e('Icon:'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('deliveroo_icon'); ?>" name="<?php echo $this->get_field_name('deliveroo_icon'); ?>" type="text" value="<?php echo esc_attr( $deliveroo_icon); ?>">
		</p>

		<h4>E-mail</h4>
		<p>
		<label for="<?php echo $this->get_field_id('email_link'); ?>"><?php _e('Link:'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('email_link'); ?>" name="<?php echo $this->get_field_name('email_link'); ?>" type="text" value="<?php echo esc_attr( $email_link); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('email_icon'); ?>"><?php _e('Icon:'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('email_icon'); ?>" name="<?php echo $this->get_field_name('email_icon'); ?>" type="text" value="<?php echo esc_attr( $email_icon); ?>">
		</p>

		<h4>Phone</h4>
		<p>
		<label for="<?php echo $this->get_field_id('phone_link'); ?>"><?php _e('Link:'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('phone_link'); ?>" name="<?php echo $this->get_field_name('phone_link'); ?>" type="text" value="<?php echo esc_attr( $phone_link); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('phone_icon'); ?>"><?php _e('Icon:'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('phone_icon'); ?>" name="<?php echo $this->get_field_name('phone_icon'); ?>" type="text" value="<?php echo esc_attr( $phone_icon); ?>">
		</p>

        <p>
		<label for="<?php echo $this->get_field_id('icon_width'); ?>"><?php _e('Icon Width:'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('icon_width'); ?>" name="<?php echo $this->get_field_name('icon_width'); ?>" type="text" value="<?php echo esc_attr($icon_width); ?>">
		</p>

       <?php
    }
    
    	/**
	 * Gets and Displays Fathead Icons
	 *
	 * @param array $links Fathead Links
     * @param array $icons Fathead Icons
     * @param array $icon_width Width of Icons
	 */
	public function getFatheadLinks( $links, $icons, $icon_width ) {
		//learn why it was pulling social
       ?>
            <div class="fatheadlinks">
				<a target="_blank" href="<?php echo esc_attr($links['facebook']); ?>"><img width="<?php echo esc_attr($icon_width); ?>" src="<?php echo esc_attr($icons['facebook']); ?>"></a>
				<a target="_blank" href="<?php echo esc_attr($links['instagram']); ?>"><img width="<?php echo esc_attr($icon_width); ?>" src="<?php echo esc_attr($icons['instagram']); ?>"></a>
				<a target="_blank" href="<?php echo esc_attr($links['deliveroo']); ?>"><img width="<?php echo esc_attr($icon_width); ?>" src="<?php echo esc_attr($icons['deliveroo']); ?>"></a>
				<a target="_blank" href="<?php echo esc_attr($links['email']); ?>"><img width="<?php echo esc_attr($icon_width); ?>" src="<?php echo esc_attr($icons['email']); ?>"></a>
				<a target="_blank" href="<?php echo esc_attr($links['phone']); ?>"><img width="<?php echo esc_attr($icon_width); ?>" src="<?php echo esc_attr($icons['phone']); ?>"></a>
			</div>
        <?php
    }
}