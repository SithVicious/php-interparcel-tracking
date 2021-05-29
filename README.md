# php-interparcel-tracking

# Introduction
This uses the official Interparcel API to track a parcel in supported countries using API v1.
Tracking codes prefixed with GB (United Kingdom), AU (Australia) and NZ (New Zealand) are supported.

# Installation
Nothing fancy, just copy/paste the class and tailor your code around the example.

# Usage
Check example.php
```php
require_once('classes/class.interparcel.php');

$apiKey = 'YOUR_API_KEY'
$trackingCode = "GB1200218511";

$tracking = new Tracking_Interparcel($apiKey);
$events = $tracking->getTracking($trackingCode);
```
