SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS employees;
DROP TABLE IF EXISTS offices;
DROP TABLE IF EXISTS companies;
SET FOREIGN_KEY_CHECKS=1;

CREATE TABLE companies
(
    id      INT AUTO_INCREMENT    NOT NULL,
    name    VARCHAR(255)          NOT NULL,
    phone   VARCHAR(255)                  ,
    email   VARCHAR(255)                  ,
    website VARCHAR(255)                  ,
    image   VARCHAR(255)                  ,
    head_office_id INT                    ,
    PRIMARY KEY (id)
);

CREATE TABLE offices
(
    id         INT AUTO_INCREMENT NOT NULL,
    name       VARCHAR(255)       NOT NULL,
    address    VARCHAR(255)       NOT NULL,
    city       VARCHAR(255)       NOT NULL,
    zip_code   VARCHAR(255)       NOT NULL,
    country    VARCHAR(255)       NOT NULL,
    email      VARCHAR(255)               ,
    phone      VARCHAR(255)               ,
    company_id INT                NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (company_id) REFERENCES companies (id)
);

ALTER TABLE companies ADD CONSTRAINT companies_id_fk_1 FOREIGN KEY (head_office_id) REFERENCES offices (id);

CREATE TABLE employees
(
    id         INT AUTO_INCREMENT NOT NULL,
    first_name VARCHAR(255)       NOT NULL,
    last_name  VARCHAR(255)       NOT NULL,
    office_id  INT                NOT NULL,
    email      VARCHAR(255)               ,
    phone      VARCHAR(255)               ,
    job_title  VARCHAR(255)               ,
    PRIMARY KEY (id),
    FOREIGN KEY (office_id) REFERENCES offices (id)
);
