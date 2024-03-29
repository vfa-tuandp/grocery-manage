<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tables = DB::select('SHOW TABLES');
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        foreach ($tables as $table) {
            $tableName = $table->{'Tables_in_' . env('DB_DATABASE')};
            if ($tableName == 'migrations') continue;
            DB::table($tableName)->truncate();
        }

        Model::unguard();

        $this->call(CompanySeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(OrderDetailSeeder::class);
    }
}
