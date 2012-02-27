<?php
class Parcel
{
  public $weight;
  public $destinationAddress;
  public $destinationCountry;
  
  public function setWeight($weight) {
    echo "weight set to: " . $weight . "\n";
    $this->weight = $weight;
    return $this;
  }

  public function setCountry($country) {
    echo "destination country is: " . $country . "\n";
    $this->destinationCountry = $country;
    return $this;
  }
} //end of Parcel class

$myparcel = new Parcel();
$myparcel->setWeight(5)->setCountry('Peru');
?>