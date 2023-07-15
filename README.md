# yii2-japan-corporate-number-csv
This is a simple webpage to view Japan Corporate Number.
Data is download from [法人番号公表ウェブサイト](https://www.houjin-bangou.nta.go.jp/download/zenken/)

It is release as an yii2 module so that can be added into yii2 web application.

## Add this module into an yii2 web application

### Install the module

Run
```shell
composer require umbalaconmeogia/yii2-japan-corporate-number-csv
```

or add `"umbalaconmeogia/yii2-japan-corporate-number-csv": "*"` to composer.json then run `composer update`

### Edit config

Add to modules in config

```php
$config['modules']['japancorpnum'] = [
    'class' => 'umbalaconmeogia\japancorpnum\Module',
];
```

### Access to the module web page
Now you can access to the module web page via the request `japancorpnum/zipcode/index`.
For example http://app/index.php?r=japancorpnum/zipcode/index

### Add link to the menu
```php
    ['label' => 'ZipcodeCsv', 'url' => ['/japancorpnum/zipcode/index']],
```

## Other operation to maintain the data of the module

* Update to newest data (TBD).
* Set data version
  ```shell
  php yii system-setting/set-zipcode-version <version>
  ```
