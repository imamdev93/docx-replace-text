## Instalation
- git clone `https://github.com/imamdev93/docx-replace-text.git`
- cd `docx-replace-text`
- composer install
- cp `env.example .env`
- config .env
  - `CONVERT_API_SECRET=<value-secret>` [Documentation](https://www.convertapi.com/doc)

## How To Run
- php artisan serve
- Server Running on [http://127.0.0.1:8000](http://127.0.0.1:8000)

## Library / Third Party
1. Replace Text Docx File `https://phpoffice.github.io/PHPWord/usage/template.html`
2. Convert Docx to PDF `https://github.com/ConvertAPI/convertapi-php`
