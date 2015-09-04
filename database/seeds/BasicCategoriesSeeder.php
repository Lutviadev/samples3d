<?php

use App\Category;
use App\Maincategory;
use App\Subcategory;
use Illuminate\Database\Seeder;

class BasicCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maincategory = Maincategory::create(['name' => 'Commercial']);

	        $category = Category::create(['maincategory_id' => $maincategory->id, 'name' => 'Defense']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Airbase']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Barracks']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Base']);

	        $category = Category::create(['maincategory_id' => $maincategory->id, 'name' => 'Education']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'College']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Daycare']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Elementary School']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'High school']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Preschool']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Training Facilities']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'University']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'University Campus']);

	        $category = Category::create(['maincategory_id' => $maincategory->id, 'name' => 'Entertainment']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Cinemas']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Museums']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Parks']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Racetracks']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Sport field']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Stadiums']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Theater']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Them parks']);

	        $category = Category::create(['maincategory_id' => $maincategory->id, 'name' => 'Government']);
	        	
	        $category = Category::create(['maincategory_id' => $maincategory->id, 'name' => 'Healthcare']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Clinics']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Dentist']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Hospital']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Outpatient Doctors']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Urgent Care']);

	        $category = Category::create(['maincategory_id' => $maincategory->id, 'name' => 'Hospitality']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => '10 Floors']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => '2 Floors']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => '5 Floors']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Cabins']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Highrise Hotel']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Motel']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Resort']);

	        $category = Category::create(['maincategory_id' => $maincategory->id, 'name' => 'Office']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Office Building']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Rental office']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Warehouse']);

	        $category = Category::create(['maincategory_id' => $maincategory->id, 'name' => 'Retail']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Banks']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Bus Terminals']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Front stores']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Open Air Malls']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Restaurant']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Shopping Malls']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Shopping Plaza']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Strip Malls']);

	        $category = Category::create(['maincategory_id' => $maincategory->id, 'name' => 'Transportation']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Airport']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Boulevards']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Bridges']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Highways']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Parking Structures']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Roads']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Train station']);

        $maincategory = Maincategory::create(['name' => 'Residential']);
	        $category = Category::create(['maincategory_id' => $maincategory->id, 'name' => 'Multi Family']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => '2-4 Floors']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => '4-6 Floors']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => '6-15 Floors']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Clubhouse']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Highrise']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => 'Town Home']);

	        $category = Category::create(['maincategory_id' => $maincategory->id, 'name' => 'Single Family']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => '2-3 Bedroom']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => '3-4 Bedroom']);
	        	$subcategory = Subcategory::create(['maincategory_id' => $maincategory->id, 'category_id' => $category->id, 'name' => '5 + Bedroom']);

    }
}
