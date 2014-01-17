<h1>Image manipulation</h1>
<h2>How to Use:</h2>
<p>Create either an Image or Thumbnail object entering the local image path or direct http link</p>
<p>Example:</p>
<ul>
	<li><pre>$image = new Image('eggs.jpg');</pre></li>
	<li><pre>$thumbnail = new Thumbnail('http://placehold.it/350x150',350,150);</pre></li>
</ul>
<p>The Image class will display the output of the image to a browser in it's original dimentions</p>
<p>The Thumbnail class will alter the original image to the provided width and height.</p>
<p>Look in Image.php to see how to use</p>