CREATE TABLE roles (
    id int ,
    name nvarchar(220),
	created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);
CREATE TABLE purchasings (
    id int ,
    name varchar(220),
    address nvarchar(660),
    phone varchar(11),
   created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);
CREATE TABLE suppliers (
    id int ,
    name varchar(220),
    address nvarchar(660),
    phone varchar(11),
    created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);


CREATE TABLE partners (
    id int ,
    name varchar(220),
    address nvarchar(660),
    phone varchar(11),
    created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

CREATE TABLE type_machines (
    id int ,
    name nvarchar(220),
	created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

CREATE TABLE services (
    id int ,
    name nvarchar(220),
	created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

CREATE TABLE statuses (
    id int ,
    name nvarchar(220),
	created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

CREATE TABLE departments (
    id int ,
    name nvarchar(220),
	created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

CREATE TABLE users (
    id int ,
    name nvarchar(220),
    email nvarchar(220),
    phone varchar(11),
    password varchar(255),
    image blob,
	created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    role_id int ,
	department_id int ,
    PRIMARY KEY (id),
	FOREIGN KEY (role_id) REFERENCES roles(id),
    FOREIGN KEY (department_id) REFERENCES departments(id)
);

ALTER TABLE departments
ADD user_id int,
ADD FOREIGN KEY (user_id) REFERENCES users(id);


CREATE TABLE devices (
    id int ,
    name nvarchar(220),
    pricebuy double,
    pricesales double,
	created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    type_machine_id int ,
	status_id int ,
	department_id int ,
	supplier_id int ,
	purchasing_id int ,
    PRIMARY KEY (id),
	FOREIGN KEY (type_machine_id) REFERENCES type_machines(id),
    FOREIGN KEY (status_id) REFERENCES statuses(id),
    FOREIGN KEY (department_id) REFERENCES departments(id),
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id),
    FOREIGN KEY (purchasing_id) REFERENCES purchasings(id)
);

CREATE TABLE device_partners (
    id int ,
	created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    device_id int ,
	partner_id int ,
	service_id int ,
    PRIMARY KEY (id),
	FOREIGN KEY (device_id) REFERENCES devices(id),
    FOREIGN KEY (partner_id) REFERENCES partners(id),
    FOREIGN KEY (service_id) REFERENCES services(id)
);




