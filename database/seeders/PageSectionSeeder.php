<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PageSection;
class PageSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PageSection::truncate();
        $page_section = new PageSection;
        $page_section->name = 'Default';
        $page_section->save();

        $page_section = new PageSection;
        $page_section->name = 'Home';
        $page_section->save();
		
		// $page_section = new PageSection;
        // $page_section->name = 'Information';
        // $page_section->save();
		
		// $page_section = new PageSection;
        // $page_section->name = 'Our Clients';
        // $page_section->save();
		
		// $page_section = new PageSection;
        // $page_section->name = 'Technical service';
        // $page_section->save();
		
		// $page_section = new PageSection;
        // $page_section->name = 'Menu';
        // $page_section->save();
		
		
		
		
		
    }
}
