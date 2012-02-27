<?php
// Include PEAR_PackageFileManager2
require_once 'PEAR/PackageFileManager2.php';
PEAR::setErrorHandling(PEAR_ERROR_DIE);

// Instantiate the class
$package = new PEAR_PackageFileManager2();

// Set some default settings
$package->setOptions(array(
  'baseinstalldir' => 'Url',
  'packagedirectory' => dirname(__FILE__) . '/Url',
));

// Set the Package Name
$package->setPackage('Url_Shortener');

// Set a package summary
$package->setSummary('Shorten URLs with a variety of services.');

// Set a lengthier description
$package->setDescription('Url_Shortener will let you shorten URLs with Bit.ly, is.gd or Tinyurl');

// We don't have a channel yet, but a valid one is required so just use pear.
$package->setChannel('pear.local');

// Set the Package version and stability
$package->setReleaseVersion('0.2.0');
$package->setReleaseStability('alpha');

// Set the API version and stability
$package->setApiVersion('0.1.0');
$package->setApiStability('alpha');

// Add Release Notes
//$package->setNotes('This is the first release of the Url_Shortener package');
$package->setNotes('Repackaged for release on the pear.local channel.');

// Set the package type (This is a PEAR-style PHP package)
$package->setPackageType('php');

// Add a release section
$package->addRelease();

// Add the pecl_http extension as a dependency
$package->addPackageDepWithChannel('required', 'pecl_http', 'pecl.php.net', '1.7.0', false, '1.7.1', false, 'pecl_http');

// Add a maintainer
$package->addMaintainer('lead', 'dshafik', 'Davey Shafik', 'me@daveyshafik.com');

// Set the minimum PHP version on which the code will run
$package->setPhpDep('5.3.6');

// Set the minimum PEAR install requirement
$package->setPearinstallerDep('1.4.0');

// Add a license
$package->setLicense('Creative Commons Attribution-ShareAlike 3.0 Unported License', 'http://creativecommons.org/licenses/by-sa/3.0/');

// Generate the File list
$package->generateContents(); 

// Write the XML to file
$package->writePackageFile();
?>
