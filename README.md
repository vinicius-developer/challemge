# Olá Obrigado por baixar meu repositório!

Esse repositório possui duas pastas uma delas é o back-end e a outra o front-end

Para o repositório funcionar corretamente peço que siga o seguintes paços:

1. Após baixar o projeto vá até a pasta back-end e utilize o `composer` 
para fazer a instalação dos pacotes do laravel com o seguinte comando.

    ```
    composer install
    ```

    Obs. Caso não possua o composer, vá até o [site]{https://getcomposer.org/} para fazer a instação

2. Faça uma cópia exata do arquivo `.env.exemple` com nome de `.env`.

3. Agora vamos setar alguma configurações no seu `.env`.

    * Para fazer a configuração do seu banco da dados insira o
    nome, senha e usuario nas seguintes váriaveis de ambiente.

    ```
    DB_DATABASE=new_post
    DB_USERNAME=
    DB_PASSWORD=

    ```

    * Depois altere a senguinte váriavel, ela irá funcionar
    para gerar nosso token de autenticação, quando estivermos 
    utilizando o front-end.

    Obs. Por favor insira uma string.

    ```
    JWT_ASSING=
    ```

4. Agora que nossa banco de dados já está configurado, podemos criar as nossas tabelas.

    Para criar nossas tabelas temos duas opções, a primeira delas é utilizando o 
    poderosíssimo sistema de migrations do laravel, mas a raiz do repositório também
    possui um arquivo sql para fazer a criação do banco (Utilize a forma que preferir).

    * Caso queira criar pelas migrations rode os seguintes comandos.

    ```
    
    php artisan migrate

    php artisan db:seed

    ```

    Isso irá criar as tabelas e os registros.

5. Certo no momento de criação deste projeto eu utilizei o back-end hospedado 
em 127.0.0.1:8000 e o front-end hospedado através do php em 127.0.0.1:8001.

    * Caso queira rodar com as configurações iguais as minhas 
    primeiramente vá até o back-end e roda o seguinte comando.

    ```
    php artisan serve
    ```

    * Após isso vá até a pasta front-end e rode o seguinte 
    comando.

    ```
    php -S 127.0.0.1:8001
    ``` 

Obs. Caso queira rodar em locais diferentes peço que vá até o arquivo
front-end>js>main.js, procure pelas funções `getDefaultRoute()` e `getUrl()`.

getDefaultRoute() => link do back-end.

getUrl() => link do front-end.

Altere para o link que desejar.

7. Para acessar as telas no front-end, já que as senhas estarão criptografadas com bcrypt
deixei uma conta para que você possa acessar.

    email: admin@gmail.com

    senha: Aa@12345


Obrigado pelo seu tempo e tenha um bom dia!
