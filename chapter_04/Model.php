<?php
class Photos_Model {
  public function getPhoto($options)
  {
    // Retrieve the photo's URL, from a DB, by constructing a file path, etc
    
    // This is hard-coded
    return array(
        'title' => 'Brooke in the Woods',
        'width' => 427,
        'height' => 640,
        'url' => 'http://farm6.static.flickr.com/5142/5584010786_95a4c15e8a_z.jpg',
    );
  }
}
?>