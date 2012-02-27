<?php
class MonotypeDelivery extends Courier
{
  public function ship($parcel) {
    // put in box
    // send
    return true;
  }
}

//Monotype class with Trackable interface
/*class MonotypeDelivery extends Courier implements Trackable
{
  public function ship($parcel) {
    // put in box
    // send and get parcel ID (we'll just pretend)
    $parcelId = 42;
    return $parcelId;
  }

  public function getTrackInfo($parcelId) {
    // look up some information
    return(array("status" => "in transit"));
  }
}*/

?>