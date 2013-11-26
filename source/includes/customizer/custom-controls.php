<?php

/**
 * Creates Customizer control for description field
 */

class Bramble_Customizer_Description_Control extends WP_Customize_Control {

	public $type = 'description';
	public $description;

	public function render_content() {
	?>
		<p class="description"><?php echo esc_html( $this->description ); ?></p>
	<?php
	}

	public function enqueue() {
		wp_enqueue_style(
			'bramble_customizer_style',
			bramble_customizer_directory_uri() . '/controls.css'
		);
	}

}


/**
 * Creates Customizer control for textarea field
 */

class Bramble_Customizer_Textarea_Control extends WP_Customize_Control {

	public $type = 'textarea';
	public $description;

	public function render_content() {
	?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php if( $this->description ): ?>
				<p class="description"><?php echo esc_html( $this->description ); ?></p>
			<?php endif; ?>
			<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
		</label>
	<?php
	}

}


/**
 * Creates Customizer control for input[type=text] field
 */
class Bramble_Customizer_Text_Control extends WP_Customize_Control {

	public $type = 'text';
	public $description;

	public function render_content() {
	?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php if( $this->description ): ?>
				<p class="description"><?php echo esc_html( $this->description ); ?></p>
			<?php endif; ?>
			<input type="text" <?php $this->link(); ?> value="<?php echo intval( $this->value() ); ?>" />
		</label>
	<?php
	}

}


/**
 * Creates Customizer control for input[type=number] field
 */
class Bramble_Customizer_Number_Control extends WP_Customize_Control {

	public $type = 'number';
	public $description;

	public function render_content() {
	?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php if( $this->description ): ?>
				<p class="description"><?php echo esc_html( $this->description ); ?></p>
			<?php endif; ?>
			<input type="number" <?php $this->link(); ?> value="<?php echo intval( $this->value() ); ?>" />
		</label>
	<?php
	}

}


/**
 * Creates Customizer control for radio replacement images fields
 */
class Bramble_Customizer_Images_Radio_Control extends WP_Customize_Control {

	public $type = 'images_radio';
	public $description;

	public function render_content() {
		if ( empty( $this->choices ) )
			return;

		$name = '_customize-image-radios-' . $this->id;

		/*
		 * Get value of 'choices' array from $options array
		 * This contains paths to images for each option
		 */
		$bramble_customizer_sections = bramble_customizer_get_fields();
		$bramble_customizer_current_section = $bramble_customizer_sections[ $this->section ];
		$bramble_customizer_current_section_fields = $bramble_customizer_current_section['fields'];

		/*
		 * Going through all the fields in this section
		 * and getting the correct one so we could grab its 'choices'
		 */
		foreach ( $bramble_customizer_current_section_fields as $bramble_customizer_current_section_field_key => $bramble_customizer_current_section_field_value ) {

			/*
			 * Not the most sophisiticated way to do it
			 * There could be issues if one field has 'something' as ID
			 * and next one has 'somethi'
			 */
			if ( strpos( $this->id, $bramble_customizer_current_section_field_key ) ) {
				$bramble_customizer_current_control_choices = $bramble_customizer_current_section_fields[ $bramble_customizer_current_section_field_key ]['control_args']['choices'];
			}
		}
		?>


		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php if( $this->description ): ?>
			<p class="description"><?php echo esc_html( $this->description ); ?></p>
		<?php endif; ?>

		<?php
		echo '<div class="image-radio-container">';
			foreach ( $this->choices as $value => $label ) {
				?>
				<input id="<?php echo esc_attr( $name ); ?>_<?php echo esc_attr( $value ); ?>" class="image-radio" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />

				<label for="<?php echo esc_attr( $name ); ?>_<?php echo esc_attr( $value ); ?>">
					<img src="<?php echo $bramble_customizer_current_control_choices[ $value ]['image_src']; ?>" alt="<?php echo $label; ?>" />
				</label>
				<?php
			}
		echo '</div>';
	}

}

/**
 * Creates Customizer control for radio switch fields
 */
class Bramble_Customizer_Radio_Switch_Control extends WP_Customize_Control {

	public $type = 'radio_switch';
	public $description;

	public function render_content() {
		if ( empty( $this->choices ) )
			return;

		$name = '_customize-radio-switch-' . $this->id;

		$bramble_customizer_sections = bramble_customizer_get_fields();
		$bramble_customizer_current_section = $bramble_customizer_sections[ $this->section ];
		$bramble_customizer_current_section_fields = $bramble_customizer_current_section['fields'];

		foreach ( $bramble_customizer_current_section_fields as $bramble_customizer_current_section_field_key => $bramble_customizer_current_section_field_value ) {

			if ( strpos( $this->id, $bramble_customizer_current_section_field_key ) ) {
				$bramble_customizer_current_control_choices = $bramble_customizer_current_section_fields[ $bramble_customizer_current_section_field_key ]['control_args']['choices'];
			}
		}

		$switch_index = 0;

		foreach ( $this->choices as $value ) {
			$switch_index ++;
		}
		?>

		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php if( $this->description ): ?>
			<p class="description"><?php echo esc_html( $this->description ); ?></p>
		<?php endif; ?>

		<div class="switch-toggle switch-candy switch-<?php echo $switch_index; ?>">

			<?php
			foreach ( $this->choices as $value => $label ) {
				?>
				<input id="<?php echo esc_attr( $name ); ?>_<?php echo esc_attr( $value ); ?>" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />

				<label for="<?php echo esc_attr( $name ); ?>_<?php echo esc_attr( $value ); ?>" onclick=""><?php echo esc_attr( $label ); ?></label>
				<?php
			}

			?>

			<a></a>
		</div>

		<?php
	}

}

/**
 * Creates Customizer control for checkbox switch fields
 */
class Bramble_Customizer_Checkbox_Switch_Control extends WP_Customize_Control {

	public $type = 'checkbox_switch';
	public $description, $enables;

	public function render_content() {
		$control_id = $this->id;
		$control_id = str_replace( '[', '_', $control_id );
		$control_id = str_replace( ']', '', $control_id );
		?>

		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php if( $this->description ): ?>
			<p class="description"><?php echo esc_html( $this->description ); ?></p>
		<?php endif; ?>

		<label class="switch-light switch-candy" onclick="">
			<input id="<?php echo $control_id; ?>" name="<?php echo $this->id; ?>" type="checkbox"  <?php $this->link(); checked( $this->value() ); ?>>
			<span class="switch-label">
				<?php _e( 'Enable', 'bramble' ); ?>
				<span><?php _e( 'Off', 'bramble' ); ?></span>
				<span><?php _e( 'On', 'bramble' ); ?></span>
			</span>

			<a></a>
		</label>

		<?php $items = $this->enables; if( $items ): ?>
			<script>
				jQuery(document).ready(function($) {
					$('input#<?php echo $control_id; ?>').next().on('click', function() {
						<?php
							foreach ( $items as $item ) {
								?>
									$('.accordion-section-content').find('li[id$="<?php echo $item; ?>"]').toggleClass('hidden');
								<?php
							}
						?>
					});

					if ( $('input#<?php echo $control_id; ?>').is(':checked') ) {
						<?php
							foreach ( $items as $item ) {
								?>
									$('.accordion-section-content').find('li[id$="<?php echo $item; ?>"]').removeClass('hidden');
								<?php
							}
						?>
					} else {
						<?php
							foreach ( $items as $item ) {
								?>
									$('.accordion-section-content').find('li[id$="<?php echo $item; ?>"]').addClass('hidden');
								<?php
							}
						?>
					}
				});
			</script>
		<?php endif; ?>

		<?php
	}

}

/**
 * Creates Customizer control for theme picker fields
 */
class Bramble_Customizer_Slider_Theme_Picker_Control extends WP_Customize_Control {

	public $type = 'slider_theme_picker';
	public $description;

	public function render_content() {
		global $bramble;
		$slider_themes = bramble_customizer_get_slider_themes();
		?>

		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php if( $this->description ): ?>
			<p class="description"><?php echo esc_html( $this->description ); ?></p>
		<?php endif; ?>
		<?php
		echo '<div class="image-radio-container theme-picker">';
			foreach ( $slider_themes as $theme ) {
				?>
				<input id="<?php echo esc_attr( $theme['id'] ); ?>" class="image-radio" type="radio" value="<?php echo esc_attr( $theme['id'] ); ?>" name="<?php echo $this->id; ?>" <?php $this->link(); checked( $this->value() ); ?> />

				<label for="<?php echo esc_attr( $theme['id'] ); ?>">
					<img src="<?php echo esc_attr( $theme['image'] ); ?>" alt="<?php echo $label; ?>" />
					<span class="theme-picker-label"><?php echo esc_attr( $theme['label'] ); ?></span>
				</label>
				<?php
			}
		echo '</div>';
	}

}

/**
 * Creates Customizer control for post type select fields
 */

class Bramble_Customizer_Select_Control extends WP_Customize_Control {

	public $type = 'select';
	public $description;

	function render_content() {

		if ( empty( $this->choices ) )
			return;
		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if( $this->description ): ?>
					<p class="description"><?php echo esc_html( $this->description ); ?></p>
				<?php endif; ?>
				<select <?php $this->link(); ?>>
					<?php
						foreach ( $this->choices as $value => $label ) {
							$selected = ( in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';
							echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $value . '</option>';
						}
					?>
				</select>
			</label>
		<?php
	}
}

/**
 * Creates Customizer control for post type select fields
 */

class Bramble_Customizer_Multi_Select_Control extends WP_Customize_Control {

	public $type = 'multi_select';
	public $description;

	function render_content() {

		if ( empty( $this->choices ) )
			return;
		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if( $this->description ): ?>
					<p class="description"><?php echo esc_html( $this->description ); ?></p>
				<?php endif; ?>
				<select <?php $this->link(); ?> class="multi-select" multiple="multiple">
					<?php
						foreach ( $this->choices as $value => $label ) {
							$selected = ( in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';
							echo '<option style="padding: 4px;" value="' . esc_attr( $value ) . '"' . $selected . '>' . $value . '</option>';
						}
					?>
				</select>
			</label>
		<?php
	}
}

class Bramble_Customizer_Google_Font_Control extends WP_Customize_Control
{
	public $type = 'font_picker';
	public $fonts, $description, $text;

	/**
	 * Enqueue the styles and scripts
	**/
	public function enqueue()
	{
		global $bramble;

		// scripts
		wp_register_script( 'font-picker-custom-control', $bramble['theme_uri'] .'/includes/customizer/font-picker.js' );
		wp_enqueue_script( 'font-picker-custom-control' );
	}

	/**
	 * Render the content on the theme customizer page
	**/
	public function render_content()
	{
		if ( empty( $this->choices ) )
		{
			// if there are no choices then don't print anything
			return;
		}

		//print links to css files
		$this->fonts->printThemeCustomizerCssLocations();

		//print css to display individual fonts
		$this->fonts->printThemeCustomizerCssClasses();
		?>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php if( $this->description ): ?>
			<p class="description"><?php echo esc_html( $this->description ); ?></p>
		<?php endif; ?>

		<div class="fontPickerCustomControl">
			<select <?php $this->link(); ?>>
				<?php
				foreach ( $this->choices as $value => $label )
					echo '<option value="' . esc_attr( $label ) . '"' . selected( $this->value(), $value, false ) . '>' . $label . '</option>';
				?>
			</select>
			<?php print_r($this->choices); ?>
			<div class="fancyDisplay">
				<ul>
					<?php
					$cssClassArray = $this->fonts->getCssClassArray();
					foreach ($cssClassArray as $key => $value)
					{
						?>
						<li class="<?= $value; ?>"><?php echo $this->text; ?></li>
						<?php
					}
					?>
				</ul>
			</div>
		</div>
		<?php
	}
}


/**
*
* Creates Customizer control for range slider fields
*
**/

class Bramble_Customizer_Range_Slider_Control extends WP_Customize_Control
{
	// Setup control type
	public $type = 'range_slider';
	public $description, $range, $min, $max, $step;

	// Override content render function to output slider HTML
	public function render_content()
	{
		$control_id = $this->id;
		$control_id = str_replace( '[', '_', $control_id );
		$control_id = str_replace( ']', '', $control_id );

		?>
			<div class="slider-control">

				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php if( $this->description ): ?>
						<p class="description"><?php echo esc_html( $this->description ); ?></p>
					<?php endif; ?>
				</label>

				<label for="<?php echo $control_id; ?>" class="range-slider-label">
					<span id="<?php echo $control_id; ?>_value">

						<?php if( $this->range == 'true' ): ?>

							<span class="min">
								<?php _e( 'Min:', 'bramble' ); ?>
								<span></span> px
							</span>
							<span class="max">
								<?php _e( 'Max:', 'bramble' ); ?>
								<span></span> px
							</span>

						<?php else: ?>

							<?php _e( 'Size', 'bramble' ); ?>:
							<span class="value"></span> px

						<?php endif; ?>

					</span>
				</label>
				<input class="hidden" id="<?php echo $control_id; ?>" name="<?php echo $this->id; ?>" type="number" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
				<div id="<?php echo $control_id; ?>_slider"></div>
			</div>

			<script>

				jQuery(document).ready(function($) {
					$('#<?php echo $control_id; ?>_slider').slider({
						range: '<?php echo esc_attr( $this->range ); ?>',
						min: <?php echo esc_attr( $this->min ); ?>,
						max: <?php echo esc_attr( $this->max ); ?>,
						step: <?php echo esc_attr( $this->step ); ?>,

						<?php if( $this->range == 'true' ): ?>

							values: [ <?php echo esc_attr( $this->value() ); ?> ],

							slide: function( event, ui ) {
								e = $.Event('keyup');
								e.keyCode = 40; // Arrow Down

								$('#<?php echo $control_id; ?>')
									.attr( 'value', ui.values[ 0 ] + "," + ui.values[ 1 ] )
									.trigger(e);

								$('#<?php echo $control_id; ?>_value .min span').html( ui.values[ 0 ] );
								$('#<?php echo $control_id; ?>_value .max span').html( ui.values[ 1 ] );
							}

						<?php else: ?>

							value: [ <?php echo esc_attr( $this->value() ); ?> ],

							slide: function( event, ui ) {
								e = $.Event('keyup');
								e.keyCode = 40; // Arrow Down

								$('#<?php echo $control_id; ?>')
									.attr( 'value', ui.value )
									.trigger(e);

								$('#<?php echo $control_id; ?>_value .value').html( ui.value );
							}

						<?php endif; ?>
					});

					<?php if( $this->range == 'true' ): ?>

						$slider_min_value = $( '#<?php echo $control_id; ?>_slider' ).slider( 'values', 0 );
						$slider_max_value = $( '#<?php echo $control_id; ?>_slider' ).slider( 'values', 1 );

						$('#<?php echo $control_id; ?>')
							.attr( 'value', $slider_min_value +','+ $slider_max_value );

						$('#<?php echo $control_id; ?>_value .min span').html( $slider_min_value );
						$('#<?php echo $control_id; ?>_value .max span').html( $slider_max_value );

					<?php else: ?>

						$slider_value = $( '#<?php echo $control_id; ?>_slider' ).slider( 'value' );

						$('#<?php echo $control_id; ?>')
							.attr( 'value', $slider_value );

						$('#<?php echo $control_id; ?>_value .value').html( $slider_value );

					<?php endif; ?>
				});

			</script>
		<?php
	}

	// Function to enqueue the right jquery scripts and styles
	public function enqueue() {

		wp_enqueue_script( 'jquery-ui-slider' );
		wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/cupertino/jquery-ui.css');

	}
}


/**
 * Customize Image Control Class
 */
class Bramble_Customizer_Image_Control extends WP_Customize_Image_Control {
	public $type = 'image';
	public $description;

	public function render_content() {
		$src = $this->value();
		if ( isset( $this->get_url ) )
			$src = call_user_func( $this->get_url, $src );

		?>
		<div class="customize-image-picker">
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if( $this->description ): ?>
					<p class="description"><?php echo esc_html( $this->description ); ?></p>
				<?php endif; ?>
			</label>

			<div class="customize-control-content">
				<div class="dropdown preview-thumbnail" tabindex="0">
					<div class="dropdown-content">
						<?php if ( empty( $src ) ): ?>
							<img style="display:none;" />
						<?php else: ?>
							<img src="<?php echo esc_url( set_url_scheme( $src ) ); ?>" />
						<?php endif; ?>
						<div class="dropdown-status"></div>
					</div>
					<div class="dropdown-arrow"></div>
				</div>
			</div>

			<div class="library">
				<ul>
					<?php foreach ( $this->tabs as $id => $tab ): ?>
						<li data-customize-tab='<?php echo esc_attr( $id ); ?>' tabindex='0'>
							<?php echo esc_html( $tab['label'] ); ?>
						</li>
					<?php endforeach; ?>
				</ul>
				<?php foreach ( $this->tabs as $id => $tab ): ?>
					<div class="library-content" data-customize-tab='<?php echo esc_attr( $id ); ?>'>
						<?php call_user_func( $tab['callback'] ); ?>
					</div>
				<?php endforeach; ?>
			</div>

			<div class="actions">
				<a href="#" class="remove"><?php _e( 'Remove Image' ); ?></a>
			</div>
		</div>
		<?php
	}
}


/**
 * Customize Color Control Class
 */
class Bramble_Customizer_Color_Control extends WP_Customize_Control {

	public $type = 'color_picker';
	public $description;

	public function render_content() {
		$control_id = $this->id;
		$control_id = str_replace( '[', '_', $control_id );
		$control_id = str_replace( ']', '', $control_id );

		?>
		<label>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if( $this->description ): ?>
					<p class="description"><?php echo esc_html( $this->description ); ?></p>
				<?php endif; ?>
			</label>
			<div class="customize-control-content">
				<input id="<?php echo $control_id; ?>" class="bramble-color-picker" type="text" value="<?php echo esc_attr($this->value()); ?>" name="<?php echo $this->id; ?>" <?php $this->link(); ?> />
			</div>
		</label>

		<script>
			jQuery(document).ready(function($) {
				$('#<?php echo $control_id; ?>').spectrum({
					showAlpha: true,
					showInput: true,
					allowEmpty:true,
					showPalette: true,
					palette: [
						['black', 'white', 'red'],
						['rgb(255, 128, 0);', 'hsv 100 70 50', 'lightyellow']
					],
					preferredFormat: 'rgb',
					appendTo: 'parent'
				});
			});
		</script>
		<?php
	}

	public function enqueue() {
		wp_enqueue_style(
			'bramble-color-picker',
			bramble_customizer_directory_uri() . '/color-picker.css'
		);

		wp_enqueue_script(
			'bramble-color-picker',
			bramble_customizer_directory_uri() . '/color-picker.js'
		);
	}
}


/**
 * Action hook that allows you to create your own controls
 */
do_action( 'bramble_customizer_custom_controls' );
