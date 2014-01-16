<?php
class Image {
	/**
	 * Contains the image. Only supports jpg, png, gif
	 * @var image handler
	 */
	protected $image;

	/**
	 * Contains the width dimention
	 * @var integer
	 */
	protected $width;

	/**
	 * Contains the height dimention
	 * @var integer
	 */
	protected $height;

	/**
	 * Contains the image mime type
	 * @var string
	 */
	protected $mimetype;
	
	/**
	 * opens an image and starts a file handler.
	 * Uses a read buffer to handle file types like jpeg, gif, png..etc
	 * also extracts image information for display. 
	 * @param [type] $filename [description]
	 */
	function __construct($filename) {
		
		// read the image file to a binary buffer
		$handle = fopen($filename, 'rb') or die("Image '$filename' not found!");
		$buffer = '';
		while(!feof($handle))
			$buffer .= fgets($handle, 4096);
		
		// create the image from the bufferfer
		$this->image = imagecreatefromstring($buffer);
		
		// extract image information
		$info = getimagesize($filename);
		$this->width = $info[0];
		$this->height = $info[1];
		$this->mimetype = $info['mime'];
	}

	/**
	 * Displays the image after the image file was read
	 * @return the image
	 */
	public function display() {
		header("Content-type: {$this->mimetype}");
		switch($this->mimetype) {
			case 'image/jpeg': imagejpeg($this->image); break;
			case 'image/png': imagepng($this->image); break;
			case 'image/gif': imagegif($this->image); break;
		}
		//exit;
	}
}

class Thumbnail extends Image {
	
	/**
	 * Creates a thumbnail object by providing exact dimensions and the original image
	 * @param string $image  The image of interest
	 * @param integer $width  Width of image
	 * @param integer $height Height of image
	 */
	function __construct($image, $width, $height) {
		
		// We want to gather the image information using the Image class constructor
		parent::__construct($image);
		
		// modify the image based on the provided width and height
		$thumb = imagecreatetruecolor($width, $height);
		imagecopyresampled($thumb, $this->image, 0, 0, 0, 0, $width, $height, $this->width, $this->height);
		$this->image = $thumb;
	}
}

// Test the classes
// uncomment $image to display original image
// $image = new Image('eggs.jpg');
// $image->display();
$thumbnail = new Thumbnail('http://placehold.it/350x150',350,150);
$thumbnail->display();
?>
