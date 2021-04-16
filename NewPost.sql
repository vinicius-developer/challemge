create database if not exists new_post;

use new_post;

create table lojas(
	id_lojas int unsigned primary key auto_increment,
    nome varchar(100) not null,
	cnpj char(14) unique not null,
	created_at timestamp,
    updated_at timestamp
);

create table usuarios(
	id_usuarios int unsigned primary key auto_increment,
    id_lojas int unsigned not null,
    nome varchar(100) not null,
    email varchar(100) unique not null,
    senha varchar(72) not null,
    created_at timestamp,
    updated_at timestamp
);

create table telefone_usuarios(
	id_telefone_usuarios bigint unsigned primary key auto_increment,
    id_usuarios int unsigned not null,
	telefone varchar(11) not null,
    created_at timestamp,
    updated_at timestamp
);

create table endereco_lojas (
	id_endereco_lojas bigint unsigned primary key auto_increment,
    id_lojas int unsigned not null,
    logradouro varchar(80) not null,
    nuemro mediumint unsigned not null,
    cep char(8) not null,
    bairro varchar(80) not null,
    cidade varchar(80) not null,
    UF char(2) not null,
    created_at timestamp,
    updated_at timestamp
);

alter table endereco_lojas 
add constraint  `endereco_lojas_id_loja_foreign`
foreign key (`id_lojas`)
references lojas(`id_lojas`);

alter table usuarios 
add constraint `usuarios_id_lojas_foreign`
foreign key (`id_lojas`)
references lojas(`id_lojas`);

alter table telefone_usuarios
add constraint `telefone_usuarios_id_usuarios_foreign`
foreign key (`id_usuarios`)
references usuarios(`id_usuarios`);





