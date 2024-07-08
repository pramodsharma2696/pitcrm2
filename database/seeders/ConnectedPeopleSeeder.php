<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use App\Models\ConnectedPerson;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory;


class ConnectedPeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Generate dummy connected people
        $users = User::all();

        foreach ($users as $user) {
            for ($i = 0; $i < 10; $i++) {
                $pan = $faker->regexify('/^[A-Z]{5}\d{4}[A-Z]$/');

                ConnectedPerson::create([
                    'connected_person_id' => $this->generateSequentialNumber(),
                    'iuid' => $this->generateIuid(),
                    'user_id' => $user->id,
                    'type' => $faker->randomElement(['individual', 'entity']),
                    'category_type' => 'connected person',
                    'is_insider' => '0', // Set the value to 0 for all records
                    'name' => $faker->name,
                    'pan' => $pan,
                    'pan_attachment' => null, // TODO: Add attachment logic
                    'declaration_attachment' => null, // TODO: Add attachment logic
                    'permanent_address' => $faker->address,
                    'correspondence_address' => $faker->address,
                    'nature_of_connection' => $faker->randomElement([
                        'Executive Director',
                        'Non Executive Director',
                        'Key Managerial Personnel',
                        'Designated Employee',
                        'Holding Company',
                        'Subsidiary Company',
                        'Associate Company',
                        'Group Company',
                        'Director of Group/Holding/Subsidiary/Associate Company',
                        'Designated Employee of Group/Holding/Subsidiary/Associate Company',
                        'Intermediary/Director of Intermediary/Employee of Intermediary',
                        'Investment Co./Trustee Co./AMC/ Its Directors or Employees',
                        'Official of Stock Exchange',
                        'Member of Board of Trustees/AMC of MF or its Employees',
                        'Member of BOD/ Employee of PFI',
                        'Official of SRO',
                        'Banker',
                        'Body Corporate/AOP/Concern wherein Director/Banker has more than 10% Interest',
                    ]),
                    'email' => $faker->email,
                    'mobile' => $faker->phoneNumber,
                    'demat_account_number' => $faker->unique()->randomNumber(9),
                    'designation' => $faker->jobTitle,
                    'no_of_share_held' => $faker->randomNumber(4),
                    'no_of_entity' => null, // TODO: Add entity logic
                    'entity_permanent_address' => null, // TODO: Add entity logic
                    'entity_correspondence_address' => null, // TODO: Add entity logic
                    'type_of_entity' => null, // TODO: Add entity logic
                    'entity_declaration' => null, // TODO: Add entity logic
                    'entity_registration_number' => null, // TODO: Add entity logic
                    'authorized_personnel_name' => null, // TODO: Add entity logic
                    'authorized_personnel_email' => null, // TODO: Add entity logic
                    'authorized_personnel_mobile_number' => null, // TODO: Add entity logic
                ]);
            }
        }
    }
    public function generateSequentialNumber()
{
    $lastNumber = ConnectedPerson::max('connected_person_id');
    $nextNumber = $lastNumber ? str_pad((intval($lastNumber) + 1), strlen($lastNumber), '0', STR_PAD_LEFT) : '0001';
    return $nextNumber;
}
public function generateIuid()
{
    $lastNumber = ConnectedPerson::max("iuid");
    $nextNumber = $lastNumber
        ? str_pad(
            intval($lastNumber) + 1,
            strlen($lastNumber),
            "0",
            STR_PAD_LEFT,
        )
        : "0001";
    return $nextNumber;
}
}
