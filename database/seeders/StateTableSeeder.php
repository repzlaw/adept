<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert($this->getMySates());
    }


    private function getMySates()
    {
        return $state = array(
            array('id' => 1, 'stname' => 'Anambra'),
            array('id' => 2, 'stname' => 'Enugu'),
            array('id' => 3, 'stname' => 'Akwa Ibom'),
            array('id' => 4, 'stname' => 'Adamawa'),
            array('id' => 5, 'stname' => 'Abia'),
            array('id' => 6, 'stname' => 'Bauchi '),
            array('id' => 7, 'stname' => 'Bayelsa'),
            array('id' => 8, 'stname' => 'Benue'),
            array('id' => 9, 'stname' => 'Borno'),
            array('id' => 10, 'stname' => 'Cross River'),
            array('id' => 11, 'stname' => 'Delta'),
            array('id' => 12, 'stname' => 'Ebonyi'),
            array('id' => 13, 'stname' => 'Edo'),
            array('id' => 14, 'stname' => 'Ekiti'),
            array('id' => 15, 'stname' => 'Gombe '),
            array('id' => 16, 'stname' => 'Imo'),
            array('id' => 17, 'stname' => 'Jigawa'),
            array('id' => 18, 'stname' => 'Kaduna'),
            array('id' => 19, 'stname' => 'Kano'),
            array('id' => 20, 'stname' => 'Katsina'),
            array('id' => 21, 'stname' => 'Kebbi'),
            array('id' => 22, 'stname' => 'Kogi'),
            array('id' => 23, 'stname' => 'Kwara'),
            array('id' => 24, 'stname' => 'Lagos'),
            array('id' => 25, 'stname' => 'Nasarawa'),
            array('id' => 26, 'stname' => 'Niger'),
            array('id' => 27, 'stname' => 'Ogun'),
            array('id' => 28, 'stname' => 'Ondo'),
            array('id' => 29, 'stname' => 'Osun'),
            array('id' => 30, 'stname' => 'Oyo'),
            array('id' => 31, 'stname' => 'Plateau'),
            array('id' => 32, 'stname' => 'Rivers'),
            array('id' => 33, 'stname' => 'Sokoto'),
            array('id' => 34, 'stname' => 'Taraba'),
            array('id' => 35, 'stname' => 'Yobe'),
            array('id' => 36, 'stname' => 'Zamfara'),
            array('id' => 37, 'stname' => 'Others'),
            array('id' => 38, 'stname' => 'F.C.T')
        );
    }
}
