<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLevelsTable extends Migration {


    private function migrateUpCamp(){
        Schema::table('camps',function(Blueprint $table) {
            $table->string('level_id')->nullable()->after('level')->index();
        });
        DB::transaction(function(){
            $cache = [];
            Camp::chunk(1000,function($objs) use ($cache){
                foreach($objs as $obj){
                    $key = null;
                    switch($obj->level){
                        case 'ประถม-มัธยม':
                            $key = 'ประถม';
                            break;
                        case 'ประถมปลาย':
                            $key = 'ประถมปลาย';
                            break;
                        case 'มหาวิทยาลัย':
                            $key = 'ปริญญา';
                            break;
                        case 'มัธยม':
                        case 'มัธยม-ประถม':
                            $key = 'มัธยม';
                            break;
                        case 'มัธยมต้น':
                            $key = 'มัธยมต้น';
                            break;
                        case 'มัธยมปลาย':
                            $key = 'มัธยมปลาย';
                            break;
                        case 'มัธยมศึกษาปีที่ 6':
                            $key = 'ม.6';
                            break;
                        default: break;
                    }
                    if(empty($cache[$key])){
                        $level = Level::where('name',$key)->first();
                        if(empty($level)) continue;
                        $cache[$key] = $level->id;
                    }
                    if($key == null) continue;
                    $obj->level_id = $cache[$key];
                    $obj->save();
                }
            });
        });


        Schema::table('camps',function(Blueprint $table) {
            $table->dropColumn('level');
        });
    }

    private function migrateDownCamp(){
        Schema::table('camps',function(Blueprint $table) {
            $table->string('level')->nullable()->after('level_id');
        });

        DB::transaction(function() {
            $cache = [];
            Camp::chunk(1000, function ($objs) use ($cache) {
                foreach ($objs as $obj) {
                    if (empty($cache[$obj->level_id])) {
                        if (empty($obj->level)) continue;
                        $cache[$obj->level_id] = $obj->level->name;
                    }
                    if (empty($cache[$obj->level_id])) continue;
                    $obj->level = $cache[$obj->level_id];
                    $obj->save();
                }
            });
        });

        Schema::table('camps',function(Blueprint $table) {
            $table->dropColumn('level_id');
        });
    }

    private function migrateUpSemester(){
        Schema::table('semesters',function(Blueprint $table) {
            $table->string('level_id')->after('level')->index();
        });

        DB::transaction(function() {
            $cache = [];
            Semester::chunk(1000, function ($objs) use ($cache) {
                foreach ($objs as $obj) {
                    if (empty($cache[$obj->level])) {
                        $key = str_replace('ปี', 'ปี ', $obj->level);
                        if ($key == 'G.10') {
                            $key = 'ม.4';
                        }
                        if ($key == 'G.11') {
                            $key = 'ม.5';
                        }
                        $level = Level::where('name', $key)->first();
                        if (empty($level)) continue;
                        $cache[$obj->level] = $level->id;
                    }
                    $obj->level_id = $cache[$obj->level];
                    $obj->save();
                }
            });
        });

        Schema::table('semesters',function(Blueprint $table) {
            $table->dropColumn('level');
        });
    }

    private function migrateDownSemester(){
        Schema::table('semesters',function(Blueprint $table) {
            $table->string('level')->after('level_id');
        });

        DB::transaction(function() {
            $cache = [];
            Semester::chunk(1000, function ($objs) use ($cache) {
                foreach ($objs as $obj) {
                    if (empty($cache[$obj->level_id])) {
                        if (empty($obj->level)) continue;
                        $cache[$obj->level_id] = $obj->level->name;
                    }
                    if (empty($cache[$obj->level_id])) continue;
                    $obj->level = $cache[$obj->level_id];
                    $obj->save();
                }
            });
        });

        Schema::table('semesters',function(Blueprint $table) {
            $table->dropColumn('level_id');
        });
    }

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Eloquent::unguard();
        Schema::create('levels', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('parent_id')->unsigned()->nullable()->index();
            $table->integer('order')->index();
            $table->timestamps();
        });

        $this->addLevel();
        $this->migrateUpSemester();
        $this->migrateUpCamp();

        Eloquent::reguard();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        $this->migrateDownCamp();
        $this->migrateDownSemester();
        Schema::drop('levels');
	}

    private function addLevel(){
        $primary = Level::create([
            'name'=>'ประถม',
            'order'=>'1',
        ]);
        $primary1 = Level::create([
            'name'=>'ประถมต้น',
            'order'=>'1',
            'parent_id'=>$primary->id
        ]);
        Level::create([
            'name'=>'ป.1',
            'order'=>'1',
            'parent_id'=>$primary1->id
        ]);
        Level::create([
            'name'=>'ป.2',
            'order'=>'2',
            'parent_id'=>$primary1->id
        ]);
        Level::create([
            'name'=>'ป.3',
            'order'=>'3',
            'parent_id'=>$primary1->id
        ]);
        $primary2 = Level::create([
            'name'=>'ประถมปลาย',
            'order'=>'4',
            'parent_id'=>$primary->id
        ]);
        Level::create([
            'name'=>'ป.4',
            'order'=>'4',
            'parent_id'=>$primary2->id
        ]);
        Level::create([
            'name'=>'ป.5',
            'order'=>'5',
            'parent_id'=>$primary2->id
        ]);
        Level::create([
            'name'=>'ป.6',
            'order'=>'6',
            'parent_id'=>$primary2->id
        ]);

        $secondary = Level::create([
            'name'=>'มัธยม',
            'order'=>'10',
        ]);
        $secondary1 = Level::create([
            'name'=>'มัธยมต้น',
            'order'=>'14',
            'parent_id'=>$secondary->id
        ]);
        Level::create([
            'name'=>'ม.1',
            'order'=>'11',
            'parent_id'=>$secondary1->id
        ]);
        Level::create([
            'name'=>'ม.2',
            'order'=>'12',
            'parent_id'=>$secondary1->id
        ]);
        Level::create([
            'name'=>'ม.3',
            'order'=>'13',
            'parent_id'=>$secondary1->id
        ]);
        $secondary2 = Level::create([
            'name'=>'มัธยมปลาย',
            'order'=>'14',
            'parent_id'=>$secondary->id
        ]);
        Level::create([
            'name'=>'ม.4',
            'order'=>'14',
            'parent_id'=>$secondary2->id
        ]);
        Level::create([
            'name'=>'ม.5',
            'order'=>'15',
            'parent_id'=>$secondary2->id
        ]);
        Level::create([
            'name'=>'ม.6',
            'order'=>'16',
            'parent_id'=>$secondary2->id
        ]);

        $degree = Level::create([
            'name'=>'ปริญญา',
            'order'=>'20',
        ]);
        $bachelor = Level::create([
            'name'=>'ปริญญาตรี',
            'order'=>'30',
            'parent_id'=>$degree->id,
        ]);
        Level::create([
            'name'=>'ปี 1',
            'order'=>'31',
            'parent_id'=>$bachelor->id
        ]);
        Level::create([
            'name'=>'ปี 2',
            'order'=>'32',
            'parent_id'=>$bachelor->id
        ]);
        Level::create([
            'name'=>'ปี 3',
            'order'=>'33',
            'parent_id'=>$bachelor->id
        ]);
        Level::create([
            'name'=>'ปี 4',
            'order'=>'34',
            'parent_id'=>$bachelor->id
        ]);
    }
}
