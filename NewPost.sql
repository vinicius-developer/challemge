create database if not exists new_post;

use new_post;

CREATE TABLE lojas (
    id_lojas INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) UNIQUE NOT NULL,
    cnpj CHAR(18) UNIQUE NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);


CREATE TABLE usuarios (
    id_usuarios INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    id_lojas INT UNSIGNED NOT NULL,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(72) NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);


CREATE TABLE telefone_usuarios (
    id_telefone_usuarios BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    id_usuarios INT UNSIGNED NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);


CREATE TABLE endereco_lojas (
    id_endereco_lojas BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    id_lojas INT UNSIGNED NOT NULL,
    logradouro VARCHAR(80) NOT NULL,
    numero MEDIUMINT UNSIGNED NOT NULL,
    complemento varchar(50) NULL,
    cep CHAR(9) NOT NULL,
    bairro VARCHAR(80) NOT NULL,
    cidade VARCHAR(80) NOT NULL,
    UF CHAR(2) NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

alter table endereco_lojas 
add constraint  `endereco_lojas_id_loja_foreign`
foreign key (`id_lojas`)
references lojas(`id_lojas`) on delete cascade;

alter table usuarios 
add constraint `usuarios_id_lojas_foreign`
foreign key (`id_lojas`)
references lojas(`id_lojas`);

alter table telefone_usuarios
add constraint `telefone_usuarios_id_usuarios_foreign`
foreign key (`id_usuarios`)
references usuarios(`id_usuarios`) on delete cascade;


insert lojas (
	nome, 
    cnpj
) values (
	"Loja de teste",
    "59.896.084/0001-36"
);

insert endereco_lojas (
	id_Lojas,
    cep,
	logradouro,
    UF,
    bairro,
    cidade,
    numero,
    complemento
) values (
	1,
    '04429-000',
    'Dias de Almeida',
    'SP',
    'Jardim Miriam',
    'São Paulo',
    12233,
    null
);

insert usuarios(
	id_lojas,
	nome,
    email,
    senha
) values (
	1,
	'ADMIN',
	'admin@gmail.com',
    '$2y$12$f9SusqXiYaGvJawTYBIvFuU4fosHP4OIexh4iox2nNLiqxbW56MMC'
);

insert telefone_usuarios(
	id_usuarios,
    telefone
) values (
	1,
    '(11) 99999-9999'
);


#drop database new_post;






