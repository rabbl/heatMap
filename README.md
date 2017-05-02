# HeatMap

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE.md)
[![Build Status](https://scrutinizer-ci.com/g/rabbl/heatMap/badges/build.png?b=master)](https://scrutinizer-ci.com/g/rabbl/heatMap/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/rabbl/heatMap/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/rabbl/heatMap/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/rabbl/heatMap/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/rabbl/heatMap/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/878a7c8b-f732-43db-8dc8-e8e807a680e4/small.png)](https://insight.sensiolabs.com/projects/878a7c8b-f732-43db-8dc8-e8e807a680e4)

## Features

This library generates pixel images (png) from 2D-Grid values.
You can setup a custom color spectrum for the interpolation.

## Installation

Composer is used for installation. Add the following lines to your ```composer.json``` file:

```
"require": {
    "rabbl/heatmap": "^1.1"
}
```

Or install it on the command line:  ```composer require rabbl/heatmap```

## Usage

```php
$heatMap = new HeatMap();
$heatMap->setData(array(
    [0,1,2,3,5,6,7,8,9],
    [0,1,2,3,5,6,7,8,9],
    [0,1,2,3,5,6,7,8,9],
    [0,1,2,3,5,6,7,8,9],
    [0,1,2,3,5,6,7,8,9],
    [0,1,2,3,5,6,7,8,9]
));
$heatMap->setSpectrum('blue', 'green', 'yellow', 'red');
$fileName = $heatMap->createWithAbsoluteLimits($data, 0, 9);
```

Returns the temporary filename of the generated image.