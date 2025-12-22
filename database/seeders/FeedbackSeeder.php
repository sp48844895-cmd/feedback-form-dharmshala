<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        // Define all possible values for each field
        $overallExperiences = ['excellent', 'good', 'average', 'poor'];
        $cleanlinessOptions = ['very_satisfied', 'satisfied', 'somewhat_satisfied', 'not_satisfied'];
        $roomConditions = ['excellent', 'good', 'average', 'poor'];
        $bathroomCleanliness = ['excellent', 'good', 'average', 'poor'];
        $staffBehaviours = ['very_good', 'good', 'average', 'poor'];
        $basicFacilities = ['excellent', 'good', 'average', 'faced_problems'];
        $moneyReturns = ['yes', 'no'];
        $stayAgainOptions = ['yes', 'maybe'];
        $recommendOptions = ['yes', 'maybe'];
        
        // Sample suggestions in Hindi and English
        $sampleSuggestions = [
            'बहुत अच्छा अनुभव था। Very good experience.',
            'सफाई बेहतर हो सकती है। Cleanliness can be improved.',
            'स्टाफ बहुत मददगार था। Staff was very helpful.',
            'कमरे में कुछ समस्याएं थीं। There were some issues in the room.',
            'सब कुछ ठीक था। Everything was fine.',
            'बाथरूम साफ नहीं था। Bathroom was not clean.',
            'बिजली की समस्या थी। There was electricity problem.',
            'पानी की आपूर्ति अच्छी थी। Water supply was good.',
            'भविष्य में फिर से आऊंगा। Will come again in future.',
            'सुझाव: अधिक सुविधाएं जोड़ें। Suggestion: Add more facilities.',
            null, // Some entries without suggestions
            null,
            null,
        ];
        
        // Generate 100+ feedback entries
        $feedbacks = [];
        $usedMobiles = []; // Track used mobile numbers to ensure uniqueness
        
        for ($i = 0; $i < 120; $i++) {
            // Generate unique mobile number (10 digits, starting with 6-9)
            do {
                $mobilePrefix = rand(6, 9);
                $mobileSuffix = $faker->numerify('#########');
                $mobile = $mobilePrefix . $mobileSuffix;
            } while (in_array($mobile, $usedMobiles));
            
            $usedMobiles[] = $mobile;
            
            // Random name (sometimes null for optional name)
            $name = $faker->optional(0.7)->name();
            
            // Random selection for each field
            $overallExperience = $faker->randomElement($overallExperiences);
            $cleanliness = $faker->randomElement($cleanlinessOptions);
            $roomCondition = $faker->randomElement($roomConditions);
            $bathroomClean = $faker->randomElement($bathroomCleanliness);
            $staffBehaviour = $faker->randomElement($staffBehaviours);
            $basicFacility = $faker->randomElement($basicFacilities);
            $moneyReturn = $faker->randomElement($moneyReturns);
            $stayAgain = $faker->randomElement($stayAgainOptions);
            $recommend = $faker->randomElement($recommendOptions);
            
            // Random suggestion (70% chance to have suggestion)
            $suggestion = $faker->optional(0.7)->randomElement($sampleSuggestions);
            
            // Random date within last 30 days
            $createdAt = $faker->dateTimeBetween('-30 days', 'now');
            $updatedAt = $createdAt;
            
            $feedbacks[] = [
                'name' => $name,
                'mobile' => $mobile,
                'overall_experience' => $overallExperience,
                'cleanliness' => $cleanliness,
                'room_condition' => $roomCondition,
                'bathroom_cleanliness' => $bathroomClean,
                'staff_behaviour' => $staffBehaviour,
                'basic_facilities' => $basicFacility,
                'money_return' => $moneyReturn,
                'stay_again' => $stayAgain,
                'recommend' => $recommend,
                'suggestions' => $suggestion,
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ];
        }
        
        // Insert all feedbacks using Query Builder
        DB::table('feedbacks')->insert($feedbacks);
        
        $this->command->info('Successfully created ' . count($feedbacks) . ' feedback entries!');
    }
}
