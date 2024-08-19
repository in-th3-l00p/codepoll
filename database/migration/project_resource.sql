create table project_resource
(
    id         int auto_increment
        primary key,
    name       varchar(255) not null,
    path       varchar(255) not null,
    project_id int          not null,
    created_at datetime     not null,
    updated_at datetime     null,
    constraint project_fk
        foreign key (project_id) references project (id)
);

