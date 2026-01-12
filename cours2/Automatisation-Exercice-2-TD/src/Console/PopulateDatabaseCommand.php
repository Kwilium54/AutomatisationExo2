<?php

namespace App\Console;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Office;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\Facades\Schema;
use Slim\App;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PopulateDatabaseCommand extends Command
{
    private App $app;

    public function __construct(App $app)
    {
        $this->app = $app;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('db:populate');
        $this->setDescription('Populate database');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Populate database...');

        /** @var \Illuminate\Database\Capsule\Manager $db */
        $db = $this->app->getContainer()->get('db');

        $db->getConnection()->statement("SET FOREIGN_KEY_CHECKS=0");
        $db->getConnection()->statement("TRUNCATE `employees`");
        $db->getConnection()->statement("TRUNCATE `offices`");
        $db->getConnection()->statement("TRUNCATE `companies`");
        $db->getConnection()->statement("SET FOREIGN_KEY_CHECKS=1");

        $faker = Factory::create('fr_FR');
        // gen de 2 à 4 entreprises
        $numberOfCompanies = rand(2, 4);
        $allOffices = [];

        for ($i = 0; $i < $numberOfCompanies; $i++) {            
            $company = $this->createCompany($faker);
            
            // gen de 2 à 3 bureaux par entreprise
            $numberOfOffices = rand(2, 3);
            $offices = [];
            
            for ($j = 0; $j < $numberOfOffices; $j++) {
                $isHeadOffice = ($j === 0);
                $office = $this->createOffice($faker, $company, $isHeadOffice);
                $offices[] = $office;
                $allOffices[] = $office;
                
                if ($isHeadOffice) {
                    $company->head_office_id = $office->id;
                    $company->save();
                }
            }
        }

        // gen de 10 employés 
        $totalEmployees = 10;
        $output->writeln("Creating $totalEmployees employees...");
        
        foreach ($allOffices as $office) {
            $this->createEmployee($faker, $office);
        }
        
        $remainingEmployees = $totalEmployees - count($allOffices);
        for ($i = 0; $i < $remainingEmployees; $i++) {
            $randomOffice = $allOffices[array_rand($allOffices)];
            $this->createEmployee($faker, $randomOffice);
        }

        $output->writeln('Database populated successfully!');
        return 0;
    }

    // Crée une entreprise avec des données aléatoires
    private function createCompany(Generator $faker): Company
    {
        $company = new Company();
        $company->name = $faker->company();
        $company->phone = $faker->phoneNumber();
        $company->email = $faker->companyEmail();
        $company->website = $faker->url();
        $company->image = $faker->imageUrl(1920, 1080, 'business', true);
        $company->save();

        return $company;
    }

    // Crée un bureau avec des données aléatoires
    private function createOffice(Generator $faker, Company $company, bool $isHeadOffice): Office
    {
        $office = new Office();
        $office->name = $isHeadOffice ? 'Siège social' : 'Bureau de ' . $faker->city();
        $office->address = $faker->streetAddress();
        $office->city = $faker->city();
        $office->zip_code = $faker->postcode();
        $office->country = 'France';
        $office->email = $faker->optional(0.7)->companyEmail();
        $office->phone = $faker->optional(0.6)->phoneNumber();
        $office->company_id = $company->id;
        $office->save();

        return $office;
    }

    // Crée un employé avec des données aléatoires
    private function createEmployee(Generator $faker, Office $office): Employee
    {
        $employee = new Employee();
        $employee->first_name = $faker->firstName();
        $employee->last_name = $faker->lastName();
        $employee->email = $faker->email();
        $employee->phone = $faker->optional(0.7)->phoneNumber();
        $employee->job_title = $faker->jobTitle();
        $employee->office_id = $office->id;
        $employee->save();

        return $employee;
    }
}
