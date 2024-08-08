<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Installation

run command 
```shell
git add submodule https://github.com/WilsonParker/ai-generate-models.git app/Modules/Models
```

in composer.json
```json
{
  "autoload": {
    "psr-4": {
      "App\\": "app/",
      "AIGenerate\\Model\\": "app/Modules/Models/src",
      "AIGenerate\\Model\\OpenAI": "app/Modules/Models/src/OpenAI",
      ...
    }
  }
  ...
}
```