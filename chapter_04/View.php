<?php
class Photos_GetPhotoView {
  public function render($data)
  {
    $html = '<h1>%s</h1>' . PHP_EOL;
    $html .= '<img src="%s" width="%s" height="%s">' . PHP_EOL;
    
    $return = sprintf($html, $data['title'], $data['url'], $data['width'], $data['height']);
    
    return $return;
  }
}
?>