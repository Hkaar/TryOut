<div align="center">
    <img src="https://github.com/Hkaar/TryOut/blob/dev/.github/images/cover.png?raw=true" alt="Cover image" width="1280" height="640" /> 
    <h1 style="margin: 0.25rem; border: none; font-weight: 700;">Try Out</h1>
</div>

<p align="center" style="font-size: 1.25rem; margin-bottom: 1.25rem;">
    A website to do online exams for Dimensi Pelajar
</p>

<div align="center">
    <div style="display: flex; justify-content: center; gap: 10px;">
        <a href="https://opensource.org/licenses/Apache-2.0">
            <img src="https://img.shields.io/badge/License-Apache_2.0-blue.svg" alt="License">
        </a>
        <img src="https://github.com/Hkaar/TryOut/workflows/CI/badge.svg" alt="Workflow Status">
        <a href="https://GitHub.com/Naereen/StrapDown.js/graphs/commit-activity">
            <img src="https://img.shields.io/badge/Maintained%3F-yes-green.svg" alt="Maintenance">
        </a>
    </div>
</div>

## Requirements

- PHP version >= 8.1
- Composer
- Node.js

## User Guide

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

Install the npm dependecies

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
