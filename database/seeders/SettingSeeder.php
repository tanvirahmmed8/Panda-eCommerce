<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('settings')->insert([
        //     'setting_key' => 'contact_number',
        //     'created_at' => Carbon::now()
        // ]);
        // DB::table('settings')->insert([
        //     'setting_key' => 'contact_email',
        //     'created_at' => Carbon::now()
        // ]);
        // DB::table('settings')->insert([
        //     'setting_key' => 'contact_address',
        //     'created_at' => Carbon::now()
        // ]);
        // DB::table('settings')->insert([
        //     'setting_key' => 'contact_info',
        //     'created_at' => Carbon::now()
        // ]);
        // DB::table('settings')->insert([
        //     'setting_key' => 'get_in_touch',
        //     'created_at' => Carbon::now()
        // ]);
        // DB::table('settings')->insert([
        //     'setting_key' => 'address_information',
        //     'created_at' => Carbon::now()
        // ]);
        // DB::table('settings')->insert([
        //     'setting_key' => 'newsletter_text',
        //     'created_at' => Carbon::now()
        // ]);
        // DB::table('settings')->insert([
        //     'setting_key' => 'copyright_area',
        //     'created_at' => Carbon::now()
        // ]);
        // DB::table('settings')->insert([
        //     'setting_key' => 'location_map',
        //     'created_at' => Carbon::now()
        // ]);

        //logo seeder
        DB::table('logos')->insert([
            'logo_key' => 'frontend_header_logo',
            'created_at' => Carbon::now()
        ]);
        DB::table('logos')->insert([
            'logo_key' => 'frontend_footer_logo',
            'created_at' => Carbon::now()
        ]);
        DB::table('logos')->insert([
            'logo_key' => 'backend_logo',
            'created_at' => Carbon::now()
        ]);
        DB::table('logos')->insert([
            'logo_key' => 'fav_icon',
            'created_at' => Carbon::now()
        ]);


    }
}
