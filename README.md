[![Build Status](https://travis-ci.org/wildlyinaccurate/rpminfo.png?branch=master)](https://travis-ci.org/wildlyinaccurate/rpminfo)

RPMInfo retrieves and parses information about RPM packages.

```php
$query = new RPMInfo\Query('package-name');
$info = $query->getInfo();

// Package information can be accessed using array or object syntax:
$info['name'];
$info->name;

// The following fields are available:
$info->name;
$info->version;
$info->release;
$info->install_date;
$info->group;
$info->size;
$info->signature;
$info->url;
$info->summary;
$info->description;
$info->relocations;
$info->vendor;
$info->build_date;
$info->build_host;
$info->source_rpm;
$info->license;
```

Instead of querying a package name, you can parse a string.

```php
$packageInfo = <<<EOL
Name        : basesystem                   Relocations: (not relocatable)
Version     : 8.0                               Vendor: CentOS
EOL;

$parser = new RPMInfo\Parser;
$info = $parser->parse($packageInfo);

echo $info->name; // "basesystem"
echo $info->relocations; // "(not relocatable)"
echo $info->version; // "8.0"
echo $info->vendor; // "CentOS"
```
