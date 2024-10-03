# TryOut

[![License](https://img.shields.io/badge/License-Apache_2.0-blue.svg)](https://opensource.org/licenses/Apache-2.0)
![Workflow Status](https://github.com/Hkaar/TryOut/workflows/CI/badge.svg)
![GitHub deployments](https://img.shields.io/github/deployments/Hkaar/TryOut/production)
[![Maintenance](https://img.shields.io/badge/Maintained%3F-yes-green.svg)](https://GitHub.com/Naereen/StrapDown.js/graphs/commit-activity)

A try out exam webapp

## Requirements

- PHP version >= 8.1
- Composer
- Node.js

## How do i use this?

This is a guide or how to for anyone wanting to use this web app locally

Clone the repo

```bash
git clone https://github.com/Hkaar/TryOut.git
```

Go to the repo folder

```bash
cd TryOut
```

Install the required dependecies

```bash
composer install
```

Generate the env

`Bash` :

```bash
mv .env.example .env && cp .env .env.example
```

`Powershell` :

```powershell
Rename-Item .\.env.example .\.env ; Copy-Item .\.env .\.env.example
```

Install npm dependecy

```bash
npm install
```

Build the assets

```bash
npm run build
```

Generate the app key

```bash
php artisan key:generate
```

Run the migrations

```bash
php artisan migrate
```

Seed the database

```bash
php artisan db:seed
```

And then serve it!

```bash
php artisan serve
```

## How do i contribute?

See on how to contribute by going to the contribution guide of the project

And that's all, btw here's a table for your reward

ʕノ•ᴥ•ʔノ ︵ ┻━┻
