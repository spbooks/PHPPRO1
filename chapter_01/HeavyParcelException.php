<?php
class HeavyParcelException extends Exception {}

class Courier{
  public function ship(Parcel $parcel) {
    // check we have an address
    if(empty($parcel->address)) {
      throw new Exception('Address not Specified');
    }

    // check the weight
    if($parcel->weight > 5) {
      throw new HeavyParcelException('Parcel exceeds courier limit');
    }
    // otherwise we're cool
    return true;
  }
}

?>