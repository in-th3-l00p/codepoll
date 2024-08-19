create table project
(
    id          int auto_increment
        primary key,
    name        varchar(255)                                 not null,
    description text                                         not null,
    url         varchar(255)                                 null,
    github_url  varchar(255)                                 null,
    visibility  enum ('public', 'private') default 'private' null,
    user_id     int                                          not null,
    created_at  datetime                                     not null,
    updated_at  datetime                                     null,
    constraint name
        unique (name),
    constraint user_fk
        foreign key (user_id) references users (id)
);

