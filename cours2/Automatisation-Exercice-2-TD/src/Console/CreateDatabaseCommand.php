<?php

namespace App\Console;

use Slim\App;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateDatabaseCommand extends Command
{
    private App $app;

    public function __construct(App $app)
    {
        $this->app = $app;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('db:create');
        $this->setDescription('Create database');
    }

    protected function execute(InputInterface $input, OutputInterface $output ): int
    {
        $output->writeln('Creating database...');
        $db = $this->app->getContainer()->get('db');

        $db->getConnection()->statement("SET FOREIGN_KEY_CHECKS=0");
        $db->getConnection()->statement("DROP TABLE IF EXISTS `employees`");
        $db->getConnection()->statement("DROP TABLE IF EXISTS `offices`");
        $db->getConnection()->statement("DROP TABLE IF EXISTS `companies`");
        $db->getConnection()->statement("SET FOREIGN_KEY_CHECKS=1");
        $db->getConnection()->statement("
        CREATE TABLE companies
(
    id      INT AUTO_INCREMENT    NOT NULL,
    name    VARCHAR(255)          NOT NULL,
    phone   VARCHAR(255)                  ,
    email   VARCHAR(255)                  ,
    website VARCHAR(255)                  ,
    image   VARCHAR(255)                  ,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    head_office_id INT                    ,
    PRIMARY KEY (id)
);
        ");

        $db->getConnection()->statement("
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
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (company_id) REFERENCES companies (id)
);
        ");

        $db->getConnection()->statement("
        CREATE TABLE employees
(
    id         INT AUTO_INCREMENT NOT NULL,
    first_name VARCHAR(255)       NOT NULL,
    last_name  VARCHAR(255)       NOT NULL,
    office_id  INT                NOT NULL,
    email      VARCHAR(255)               ,
    phone      VARCHAR(255)               ,
    job_title  VARCHAR(255)               ,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (office_id) REFERENCES offices (id)
);
        ");

//        $db->getConnection()->statement("ALTER TABLE companies ADD CONSTRAINT companies_id_fk_1 FOREIGN KEY (head_office_id) REFERENCES offices (id);");

        $output->writeln('Database created successfully!');
        return 0;
    }
}
