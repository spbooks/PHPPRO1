<?php
class PigeonPost extends Courier
{
  /*public function ship($parcel) {
    // fetch pigeon
    // attach parcel
    // send
    return true;
  }*/
  
  //Type hinting
  public function ship(Parcel $parcel) {
  // sends the parcel to its destination
  return true;
  }
  
}
?>