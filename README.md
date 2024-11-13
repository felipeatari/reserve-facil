## NOTA:
- Desenvolvi o sistema utilizando Laravel 11, Vue.js 3 com Inertia, Tailwind CSS e MySQL.
- Durante o desenvolvimento, rodei a aplicação via Docker com o Sail.
- Caso opte por não rodar via Docker, recomendo utilizar o PHP 8.2+.
- Independentemente da forma como for rodar, é obrigatório ter o Composer instalado.
- Também é necessário ter o npm instalado para rodar o Tailwind CSS caso não for utilizar o Sail.

## Configurações:
- Após baixar o projeto do GitHub, localize o arquivo ".env.example".
- Faça uma cópia e renomeie uma das cópias de ".env.example" para ".env".
- Obs.: É importante manter um arquivo ".env.example", pois o ".env" não é commitado.

### Baixar as dependencias:
```bash
composer install
```

### Configurações do ".env":
- Para a rota, localize e altere se nececssário:
```env
APP_URL=http://localhost
APP_PORT=8080
```

---

- Para o banco de dados, localize e altere se nececssário:
```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

---

### Rodar o Laravel:
- Se for via Docker:
```bash
./vendor/bin/sail up -d
```
- Se não for via Docker:
```bash
php artisan serve
```

### Gerar a key:
- No ".env" localize a variável:
```env
APP_KEY=
```
- Vai está vazia.
- Se for via Docker rode:
```bash
./vendor/bin/sail artisan key:generate
```
- Se não for via Docker rode:
```bash
php artisan key:generate
```
- Após rodar esse comando, veja que a variável vai está preenchida.
- Obs.: Esse passo é obrigatório.
  
---

### Rodar as migrations:
- Se for via Docker:
```bash
./vendor/bin/sail artisan migrate
```
- Se não for via Docker:
```bash
php artisan migrate
```

### Preenche o banco de dados com dados fake (opicional):
- Se for via Docker:
```bash
./vendor/bin/sail artisan db:seed
```
- Se não for via Docker:
```bash
php artisan db:seed
```

---

### Buildar o Tailwind CSS:
- Se for via Docker:
```bash
./vendor/bin/sail npm install && ./vendor/bin/sail npm run build
```
- Se não for via Docker:
```bash
npm install && npm run build
```
