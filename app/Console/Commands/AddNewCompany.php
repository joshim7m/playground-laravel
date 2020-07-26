<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Company;

class AddNewCompany extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contact:company';
    // protected $signature = 'contact:company {name} {phone=N/A}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new company';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $company = Company::create([
        'name'    => 'Test Company',
        'phone'   => '123-123-1234',
      ]);

      $this->info('Added: '.$company->name);




      // $company = Company::create([
      //   'name'    => $this->argument('name'),
      //   'phone'   => $this->argument('phone') ?? 'N/A'
      // ]);
      // $this->info('A info here');
      // $this->warn('A wring here');
      // $this->error('An error here');

    }
}
