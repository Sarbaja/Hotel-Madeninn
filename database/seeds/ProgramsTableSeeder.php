 <?php

use Illuminate\Database\Seeder;

class ProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('programs')->truncate();

        DB::table('programs')->insert([
        			[
	        			'title'=>'Nepal Tours',
	        			'slug'=>str_slug('Nepal Tours', '-'),
	        			'image'=>'',
	        			'category'=>rand(0,1),
	        			'display'=>rand(0,1),
	        			'description'=>'Whats new in Nepal Tours',
	        			'long_content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor neque voluptate vel facere aliquam incidunt iusto esse unde reprehenderit, reiciendis, exercitationem tempora vitae eaque at, sequi doloribus fugit ad nisi?',
	        			'parent_id' => '0',
	        			'child'=>'0',
	        			'order_item'=>rand(0,100),
	        			'created_by'=>'deathZone',
	        			'updated_by'=>''
	        		],
	        		[
	        			'title'=>'Europe Tours',
	        			'slug'=>str_slug('Europe Tours', '-'),
	        			'image'=>'',
	        			'category'=>rand(0,1),
	        			'display'=>rand(0,1),
	        			'description'=>'Whats new in Europe Tours',
	        			'long_content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor neque voluptate vel facere aliquam incidunt iusto esse unde reprehenderit, reiciendis, exercitationem tempora vitae eaque at, sequi doloribus fugit ad nisi?',
	        			'parent_id' => '0',
	        			'child'=>'0',
	        			'order_item'=>rand(0,100),
	        			'created_by'=>'deathZone',
	        			'updated_by'=>''
	        		],
	        		[
	        			'title'=>'Program 1',
	        			'slug'=>str_slug('Program 1', '-'),
	        			'image'=>'',
	        			'category'=>rand(0,1),
	        			'display'=>rand(0,1),
	        			'description'=>'Whats new in Program 1',
	        			'long_content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor neque voluptate vel facere aliquam incidunt iusto esse unde reprehenderit, reiciendis, exercitationem tempora vitae eaque at, sequi doloribus fugit ad nisi?',
	        			'parent_id' => '0',
	        			'child'=>'0',
	        			'order_item'=>rand(0,100),
	        			'created_by'=>'deathZone',
	        			'updated_by'=>''
	        		],
	        		[
	        			'title'=>'Program 2',
	        			'slug'=>str_slug('Program 2', '-'),
	        			'image'=>'',
	        			'category'=>rand(0,1),
	        			'display'=>rand(0,1),
	        			'description'=>'Whats new in Program 2',
	        			'long_content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem a saepe debitis eligendi rem nulla delectus laborum alias dolor neque, dolorum soluta reiciendis impedit vel dolore, officiis earum odit quasi.',
	        			'parent_id' => '0',
	        			'child'=>'0',
	        			'order_item'=>rand(0,100),
	        			'created_by'=>'deathZone',
	        			'updated_by'=>''
	        		],
	        		[
	        			'title'=>'Program 3',
	        			'slug'=>str_slug('Program 3', '-'),
	        			'image'=>'',
	        			'category'=>rand(0,1),
	        			'display'=>rand(0,1),
	        			'description'=>'Whats new in Program 3',
	        			'long_content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati est iste consectetur reiciendis dicta ipsum, nobis hic modi distinctio vero quod fugiat facilis sapiente officia, suscipit, ipsa a. Velit, saepe.',
	        			'parent_id' => '0',
	        			'child'=>'0',
	        			'order_item'=>rand(0,100),
	        			'created_by'=>'deathZone',
	        			'updated_by'=>''
	        		]
	        	]);
    }
}
