### pre-requisitos:

-   php 7.3 + php-mbstring php-zip php-dom php-mysql
-   composer
-   redis
-   banco de dados mysql
-   nodejs + npm

---

dentro do projeto copie o arquivo .env.example e renomeie para .env, configure os dados do ambiente local

---

### comandos

composer install
npm install
npm run dev

php artisan key:generate
php artisan migrate
php artisan storage:link
php artisan serve

---

##### WEB: http://127.0.0.1:8000

##### API: http://127.0.0.1:8000/api/v1

---

### Endpoints API

[METHOD] - se refere a que tipo de método está presente na requisição

[API] - a esquerda da barra "/" será considerado a url da api no caso: http://127.0.0.1:8000/api/v1

<i>na pasta insomnia segue o arquivo com as rotas já pre-configurado</i>

### Auth

[POST] - /login: faz login e retorna o token de autenticação
<img src="https://user-images.githubusercontent.com/32224862/194557051-6457bd98-1269-40d9-ad8d-516e23d8551e.jpg" />

[POST] - /me: retorna os dados do usuário logado
<img src="https://user-images.githubusercontent.com/32224862/194557055-f3ba9c3e-584f-44e2-92c9-d13d2c44b15d.jpg" />

[POST] - /refresh: faz o refresh token e retorna o token atualizado
<img src="https://user-images.githubusercontent.com/32224862/194557056-ff372d39-043f-49da-bbf5-e06f489b7d93.jpg" />

[POST] - /logout: desativa o token atual
<img src="https://user-images.githubusercontent.com/32224862/194557054-c2c81e76-94f3-46fe-b46b-194bb92663a1.jpg" />

### Brand

[GET] - /brand: lista as marcas cadastradas
<img src="https://user-images.githubusercontent.com/32224862/194557833-b9248fbf-1024-4f1c-a86d-a9597c0b9398.jpg" />

[POST] - /brand: salva uma marca
<img src="https://user-images.githubusercontent.com/32224862/194557827-548c0ffe-bb9d-42cd-bbad-88884dd8b806.jpg" />

[GET] - /brand/{id}: retorna dados da marca com id informado
<img src="https://user-images.githubusercontent.com/32224862/194557819-7b5da511-b199-4135-b7bd-6934c187d57f.jpg" />

[PATCH] - /brand/{id}: atualiza dados da marca com id informado
<img src="https://user-images.githubusercontent.com/32224862/194557830-5cea5b62-9514-4360-9566-c08812d203aa.jpg" />

[DEL] - /brand/{id}: remove a marca com id informado
<img src="https://user-images.githubusercontent.com/32224862/194557831-a56c44d1-d756-4a87-9f83-23080a0ceda1.jpg" />

### Model

[GET] - /model: lista os modelos cadastrados
<img src="https://user-images.githubusercontent.com/32224862/194558699-3411db6c-189a-456c-b5e3-961e43859429.jpg" />

[POST] - /model: salva um modelo
<img src="https://user-images.githubusercontent.com/32224862/194558702-de6760eb-a777-424b-b2c9-82da554eaa9b.jpg" />

[GET] - /model/{id}: retorna dados do modelo com id informado
<img src="https://user-images.githubusercontent.com/32224862/194558701-283d05fa-1265-4ae8-8ee6-331c0aed0c21.jpg" />

[PATCH] - /model/{id}: atualiza dados do modelo com id informado
<img src="https://user-images.githubusercontent.com/32224862/194558705-f4b4b0fd-fde8-4343-b7dc-d34e17246b14.jpg" />

[DEL] - /model/{id}: remove o modelo com id informado
<img src="https://user-images.githubusercontent.com/32224862/194558697-ad193442-3ca0-4560-8ae8-32f2908287d4.jpg" />

### Car

[GET] - /car: lista os carros cadastrados
[POST] - /car: salva um carro
[GET] - /car/{id}: retorna dados do carro com id informado
[PATCH] - /car/{id}: atualiza dados do carro com id informado
[DEL] - /car/{id}: remove o carro com id informado

### Client

[GET] - /client: lista os clentes cadastrados
[POST] - /client: salva um cliente
[GET] - /client/{id}: retorna dados do cliente com id informado
[PATCH] - /client/{id}: atualiza dados do cliente com id informado
[DEL] - /client/{id}: remove o cliente com id informado

### Location

[GET] - /location: lista os clentes cadastrados
[POST] - /location: salva um cliente
[GET] - /location/{id}: retorna dados do cliente com id informado
[PATCH] - /location/{id}: atualiza dados do cliente com id informado
[DEL] - /location/{id}: remove o cliente com id informado
