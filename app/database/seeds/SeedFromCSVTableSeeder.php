<?php

class SeedFromCSVTableSeeder extends Seeder {

    public function run() {
        $controller = new mix5003\Hualaem\Backend\ImportUserController();
        $arr = json_decode(file_get_contents(storage_path('seed_data/post.json')), true);
        copy(storage_path('seed_data/profile.csv'), storage_path('tmp/person.csv'));
        copy(storage_path('seed_data/school.csv'), storage_path('tmp/school.csv'));
        copy(storage_path('seed_data/camp.csv'), storage_path('tmp/camp.csv'));
        \Session::set('import_data',$arr);
        $controller->postStep3();
    }

}
