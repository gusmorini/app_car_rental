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

---

### Auth

[POST] - /login: faz login e retorna o token de autenticação <br>
<img src="https://user-images.githubusercontent.com/32224862/194557051-6457bd98-1269-40d9-ad8d-516e23d8551e.jpg" />

[POST] - /me: retorna os dados do usuário logado <br>
<img src="https://user-images.githubusercontent.com/32224862/194557055-f3ba9c3e-584f-44e2-92c9-d13d2c44b15d.jpg" />

[POST] - /refresh: faz o refresh token e retorna o token atualizado <br>
<img src="https://user-images.githubusercontent.com/32224862/194557056-ff372d39-043f-49da-bbf5-e06f489b7d93.jpg" />

[POST] - /logout: desativa o token atual <br>
<img src="https://user-images.githubusercontent.com/32224862/194557054-c2c81e76-94f3-46fe-b46b-194bb92663a1.jpg" />

---

### Brand

[GET] - /brand: lista as marcas cadastradas <br>
<img src="https://user-images.githubusercontent.com/32224862/194557833-b9248fbf-1024-4f1c-a86d-a9597c0b9398.jpg" />

[POST] - /brand: salva uma marca <br>
<img src="https://user-images.githubusercontent.com/32224862/194557827-548c0ffe-bb9d-42cd-bbad-88884dd8b806.jpg" />

[GET] - /brand/{id}: retorna dados da marca com id informado <br>
<img src="https://user-images.githubusercontent.com/32224862/194557819-7b5da511-b199-4135-b7bd-6934c187d57f.jpg" />

[PATCH] - /brand/{id}: atualiza dados da marca com id informado <br>
<img src="https://user-images.githubusercontent.com/32224862/194557830-5cea5b62-9514-4360-9566-c08812d203aa.jpg" />

[DEL] - /brand/{id}: remove a marca com id informado <br>
<img src="https://user-images.githubusercontent.com/32224862/194557831-a56c44d1-d756-4a87-9f83-23080a0ceda1.jpg" />

---

### Model

[GET] - /model: lista os modelos cadastrados <br>
<img src="https://user-images.githubusercontent.com/32224862/194558699-3411db6c-189a-456c-b5e3-961e43859429.jpg" />

[POST] - /model: salva um modelo <br>
<img src="https://user-images.githubusercontent.com/32224862/194558702-de6760eb-a777-424b-b2c9-82da554eaa9b.jpg" />

[GET] - /model/{id}: retorna dados do modelo com id informado <br>
<img src="https://user-images.githubusercontent.com/32224862/194558701-283d05fa-1265-4ae8-8ee6-331c0aed0c21.jpg" />

[PATCH] - /model/{id}: atualiza dados do modelo com id informado <br>
<img src="https://user-images.githubusercontent.com/32224862/194558705-f4b4b0fd-fde8-4343-b7dc-d34e17246b14.jpg" />

[DEL] - /model/{id}: remove o modelo com id informado <br>
<img src="https://user-images.githubusercontent.com/32224862/194558697-ad193442-3ca0-4560-8ae8-32f2908287d4.jpg" />

---

### Car

[GET] - /car: lista os carros cadastrados <br>
<img src="https://user-images.githubusercontent.com/32224862/194561202-f9335d06-e7e0-4572-8184-cb52a7c906f0.jpg" />

[POST] - /car: salva um carro <br>
<img src="https://user-images.githubusercontent.com/32224862/194561390-ce97b9ab-8392-49b8-96a1-78e5ebeb7cea.jpg" />

[GET] - /car/{id}: retorna dados do carro com id informado <br>
<img src="https://user-images.githubusercontent.com/32224862/194561296-57771950-d419-4732-928d-a1c5f1025cfd.jpg" />

[PATCH] - /car/{id}: atualiza dados do carro com id informado <br>
<img src="https://user-images.githubusercontent.com/32224862/194561464-c8558c03-b95b-4ef1-8c67-864c37944c6a.jpg" />

[DEL] - /car/{id}: remove o carro com id informado <br>
<img src="https://user-images.githubusercontent.com/32224862/194561540-59d39e98-38d3-4099-b052-4e1cc630b30e.jpg" />

---

### Client

[GET] - /client: lista os clentes cadastrados <br>
<img src="https://user-images.githubusercontent.com/32224862/194561872-1dcda059-a476-42dd-8db7-72c11d5fdd24.jpg" />

[POST] - /client: salva um cliente <br>
<img src="https://user-images.githubusercontent.com/32224862/194561955-f986f59d-dcb0-4050-ae2d-9aca46ed8f42.jpg" />

[GET] - /client/{id}: retorna dados do cliente com id informado <br>
<img src="https://user-images.githubusercontent.com/32224862/194562014-32a35e99-04f5-46f6-82f4-035d4fcee132.jpg" />

[PATCH] - /client/{id}: atualiza dados do cliente com id informado <br>
<img src="https://user-images.githubusercontent.com/32224862/194562078-d94604f7-7a62-4b39-aa93-56c3a11350ce.jpg" />

[DEL] - /client/{id}: remove o cliente com id informado <br>
<img src="https://user-images.githubusercontent.com/32224862/194562159-13a56fa5-7272-47b0-8ae6-e496af7455d3.jpg" />

---

### Location

[GET] - /location: lista as locações cadastradas <br>
<img src="https://user-images.githubusercontent.com/32224862/194562288-ee18e29c-5be7-4a3c-a44d-8e15c08c2642.jpg" />

[POST] - /location: salva uma locação <br>
<img src="https://user-images.githubusercontent.com/32224862/194562366-f1917699-4c0d-4ca5-927c-96efb995b8c6.jpg" />

[GET] - /location/{id}: retorna dados da locação com id informado <br>
<img src="https://user-images.githubusercontent.com/32224862/194562650-391fbf48-91eb-4be6-882e-e974cce8dd6e.jpg" />

[PATCH] - /location/{id}: atualiza dados da locação com id informado <br>
<img src="https://user-images.githubusercontent.com/32224862/194562721-2a881e96-c8cd-4abd-acf6-cb7fcbb279cd.jpg" />

[DEL] - /location/{id}: remove a locação com id informado <br>
<img src="https://user-images.githubusercontent.com/32224862/194562826-691ac117-a66f-4db2-9999-9de782d33be8.jpg" />

---

### WEB - http://127.0.0.1:8000

---

Tela de login <br>
<img src="https://user-images.githubusercontent.com/32224862/194556502-ecf3d6f7-f526-44ee-a6f7-62eb4ada5718.jpg" />

Listagem de marcas <br>
<img src="https://user-images.githubusercontent.com/32224862/194556492-c7a20650-7e1b-4fa1-b3f5-d3ff4e949b6c.jpg" />

campo marca a ser adicionada <br>
<img src="https://user-images.githubusercontent.com/32224862/194556496-fe8cf4e5-9bf1-45bf-b8bd-90d0aec8586a.jpg" />

campo marca adicionado <br>
<img src="https://user-images.githubusercontent.com/32224862/194556499-d2266156-be17-4398-a466-0725f5417eda.jpg" />

paginação <br>
<img src="https://user-images.githubusercontent.com/32224862/194556501-f5b4d76b-4f4e-449d-9794-8cce20087a0c.jpg" />
