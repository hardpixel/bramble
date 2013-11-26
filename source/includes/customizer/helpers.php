<?php


/**
 * Customizer Directory
 *
 * @return	string	The directory in which Customizer Boilerplate is located, no trailing slash
 */
function bramble_customizer_directory_uri() {

	$bramble_customizer_directory_uri = get_template_directory_uri() . '/includes/customizer';

	return apply_filters( 'bramble_customizer_directory_uri', $bramble_customizer_directory_uri );

}


/**
 * Capability Required to Save Theme Options
 *
 * @return	string	The capability to actually use
 */
function bramble_customizer_capability() {

	return apply_filters( 'bramble_customizer_capability', 'edit_theme_options' );

}


/**
 * Name of DB entry under which options are stored if 'type' => 'option'
 * is used for Theme Customizer settings
 *
 * @return	string	DB entry
 */
function bramble_customizer_option() {

	return apply_filters( 'bramble_customizer_option', 'bramble_customizer_theme_options' );

}


/**
 * Get Option Values
 *
 * Array that holds all of the options values
 * Option's default value is used if user hasn't specified a value
 *
 * @uses	bramble_get_theme_customizer_defaults()	defined in /customizer/options.php
 * @return	array									Current values for all options
 */
function bramble_customizer_get_options_values() {

	// Get the option defaults
	$option_defaults = bramble_customizer_get_options_defaults();

	// Parse the stored options with the defaults
	$bramble_customizer_options = wp_parse_args( get_option( bramble_customizer_option(), array() ), $option_defaults );

	// Return the parsed array
	return $bramble_customizer_options;

}


/**
 * Get Option Defaults
 *
 * Returns an array that holds default values for all options
 *
 * @uses	bramble_get_theme_customizer_fields()	defined in /customizer/options.php
 * @return	array	$bramble_option_defaults		Default values for all options
 */
function bramble_customizer_get_options_defaults() {

	// Get the array that holds all theme option fields
	$bramble_sections = bramble_customizer_get_fields();

	// Initialize the array to hold the default values for all theme options
	$bramble_option_defaults = array();

	// Loop through the option parameters array
	foreach ( $bramble_sections as $bramble_section ) {

		$bramble_section_fields = $bramble_section['fields'];

		foreach ( $bramble_section_fields as $bramble_field_key => $bramble_field_value ) {

			// Add an associative array key to the defaults array for each option in the parameters array
			if( isset( $bramble_field_value['setting_args']['default'] ) ) {
				$bramble_option_defaults[$bramble_field_key] = $bramble_field_value['setting_args']['default'];
			} else {
				$bramble_option_defaults[$bramble_field_key] = false;
			}

		}

	}

	// Return the defaults array
	return $bramble_option_defaults;

}

/**
 * Google Font_Collection Class
**/
class Google_Font_Collection
{
	private $fonts;

	/**
	 * Constructor
	**/
	public function __construct($fonts)
	{
		if(empty($fonts))
		{
			//we didn't get the required data
			return false;
		}

		// create fonts
		foreach ($fonts as $key => $value)
		{
			$this->fonts[$value["title"]] = new Google_Font($value["title"], $value["location"], $value["cssDeclaration"], $value["cssClass"]);
		}
	}

	/**
	 * getFontFamilyNameArray Function
	 * this function returns an array containing all of the font family names
	**/
	function getFontFamilyNameArray()
	{
		$result;
		foreach ($this->fonts as $key => $value)
		{
			$result[] = $value->__get("title");
		}
		return $result;
	}

	/**
	 * getTitle
	 * this function returns the font title
	**/
	function getTitle($key)
	{
		return $this->fonts[$key]->__get("title");
	}

	/**
	 * getLocation
	 * this function returns the font location
	**/
	function getLocation($key)
	{
		return $this->fonts[$key]->__get("location");
	}

	/**
	 * getCssDeclaration
	 * this function returns the font css declaration
	**/
	function getCssDeclaration($key)
	{
		return $this->fonts[$key]->__get("cssDeclaration");
	}


	/**
	 * getCssClassArray
	 * this function returns an array of css classes
	 * this function is used when displaying the fancy list of fonts in the theme customizer
	 * this function is used to send a JS file an array for the postMessage transport option in the theme customizer
	**/
	function getCssClassArray()
	{
		$result;
		foreach ($this->fonts as $key => $value)
		{
			$result[$value->__get("title")] = $value->__get("cssClass");
		}
		return $result;
	}

	/**
	 * getTotalNumberOfFonts
	 * this function returns the total number of fonts
	**/
	function getTotalNumberOfFonts()
	{
		return count($this->fonts);
	}

	/**
	 * printThemeCustomizerCssLocations
	 * this function prints the links to the css files for the theme customizer
	**/
	function printThemeCustomizerCssLocations()
	{
		foreach ($this->fonts as $key => $value)
		{
			?>
			<link href="http://fonts.googleapis.com/css?family=<?= $value->__get("location"); ?>" rel='stylesheet' type='text/css'>
			<?php
		}
	}

	/**
	 * printThemeCustomizerCssClasses
	 * this function prints the theme customizer css classes necessary to display all of the fonts
	**/
	function printThemeCustomizerCssClasses()
	{
		?>
		<style type="text/css">
			<?php
			foreach ($this->fonts as $key => $value)
			{
				?>
				.<?=$value->__get("cssClass")?>{
					font-family: <?= $value->__get("cssDeclaration"); ?>;
				}
				<?php
			}
			?>
		</style>
		<?php
	}

}


/**
 * Google_Font Class
**/
class Google_Font
{
	private $title; // the name of the font
	private $location; // the http location of the font file
	private $cssDeclaration; // the css declaration used to reference the font
	private $cssClass; // the css class used in the theme customizer to preview the font

	/**
	 * Constructor
	**/
	public function __construct($title, $location, $cssDeclaration, $cssClass)
	{
		$this->title = $title;
		$this->location = $location;
		$this->cssDeclaration = $cssDeclaration;
		$this->cssClass = $cssClass;
	}

	/**
	 * Getters
	 * taken from: http://stackoverflow.com/questions/4478661/getter-and-setter
	**/
	public function __get($property)
	{
		if (property_exists($this, $property)) {
			return $this->$property;
		}
	}
}


/**
*
* Get slider themes
*
**/

function bramble_customizer_get_slider_themes() {
	global $bramble;

	$themes['basic'] = array(
		'id'	=> 'basic_slider',
		'label' => __( 'Basic', 'bramble' ),
		'image' => $bramble['theme_uri'] . '/images/theme-options/default-slider.png',
	);

	return apply_filters( 'bramble_customizer_register_slider_theme', $themes );
}