create table users
(
    id          int auto_increment
        primary key,
    username    varchar(255) not null,
    email       varchar(255) not null,
    first_name  varchar(255) not null,
    last_name   varchar(255) not null,
    description text         null,
    pfp_path    varchar(255) null,
    password    varchar(255) not null,
    created_at  datetime     not null,
    updated_at  datetime     null,
    constraint email
        unique (email),
    constraint username
        unique (username)
);

