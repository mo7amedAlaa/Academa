<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Create root categories
        $rootCategories = [
            ['id' => 1, 'name' => 'Teaching & Academics', 'parent_id' => null],
            ['id' => 2, 'name' => 'Marketing & Sales', 'parent_id' => null],
            ['id' => 3, 'name' => 'Development', 'parent_id' => null],
            ['id' => 4, 'name' => 'Design', 'parent_id' => null],
            ['id' => 5, 'name' => 'Personal Development', 'parent_id' => null],
            ['id' => 6, 'name' => 'Lifestyle', 'parent_id' => null],
            ['id' => 7, 'name' => 'Business', 'parent_id' => null],
            ['id' => 8, 'name' => 'Health & Fitness', 'parent_id' => null],
        ];

        foreach ($rootCategories as $root) {
            Category::factory()->create($root);
        }

        // Create subcategories (2nd Level)
        $subcategories = [
            // Teaching & Academics
            ['name' => 'Language Learning', 'parent_id' => 1],
            ['name' => 'Science & Mathematics', 'parent_id' => 1],
            ['name' => 'Test Prep', 'parent_id' => 1],
            ['name' => 'Education for Children', 'parent_id' => 1],

            // Marketing & Sales
            ['name' => 'Digital Marketing', 'parent_id' => 2],
            ['name' => 'Sales Strategies', 'parent_id' => 2],
            ['name' => 'Branding', 'parent_id' => 2],
            ['name' => 'Social Media Marketing', 'parent_id' => 2],

            // Development
            ['name' => 'Web Development', 'parent_id' => 3],
            ['name' => 'Mobile Development', 'parent_id' => 3],
            ['name' => 'Data Science', 'parent_id' => 3],
            ['name' => 'Game Development', 'parent_id' => 3],

            // Design
            ['name' => 'Graphic Design', 'parent_id' => 4],
            ['name' => 'UI/UX Design', 'parent_id' => 4],
            ['name' => 'Animation', 'parent_id' => 4],
            ['name' => 'Product Design', 'parent_id' => 4],

            // Personal Development
            ['name' => 'Leadership', 'parent_id' => 5],
            ['name' => 'Productivity', 'parent_id' => 5],
            ['name' => 'Stress Management', 'parent_id' => 5],
            ['name' => 'Time Management', 'parent_id' => 5],

            // Lifestyle
            ['name' => 'Cooking', 'parent_id' => 6],
            ['name' => 'Health & Fitness', 'parent_id' => 6],
            ['name' => 'Travel', 'parent_id' => 6],
            ['name' => 'Home Improvement', 'parent_id' => 6],

            // Business
            ['name' => 'Entrepreneurship', 'parent_id' => 7],
            ['name' => 'Leadership & Management', 'parent_id' => 7],
            ['name' => 'Finance & Accounting', 'parent_id' => 7],
            ['name' => 'Negotiation Skills', 'parent_id' => 7],

            // Health & Fitness
            ['name' => 'Yoga', 'parent_id' => 8],
            ['name' => 'Weight Loss', 'parent_id' => 8],
            ['name' => 'Nutrition', 'parent_id' => 8],
            ['name' => 'Mental Health', 'parent_id' => 8],
        ];

        foreach ($subcategories as $sub) {
            Category::factory()->create($sub);
        }

        // Create sub-subcategories (3rd Level)
        $subSubcategories = [
            // Language Learning
            ['name' => 'English', 'parent_id' => 9],
            ['name' => 'Spanish', 'parent_id' => 9],
            ['name' => 'French', 'parent_id' => 9],
            ['name' => 'Mandarin', 'parent_id' => 9],

            // Science & Mathematics
            ['name' => 'Physics', 'parent_id' => 10],
            ['name' => 'Chemistry', 'parent_id' => 10],
            ['name' => 'Biology', 'parent_id' => 10],
            ['name' => 'Mathematics', 'parent_id' => 10],

            // Test Prep
            ['name' => 'GRE', 'parent_id' => 11],
            ['name' => 'GMAT', 'parent_id' => 11],
            ['name' => 'SAT', 'parent_id' => 11],
            ['name' => 'TOEFL', 'parent_id' => 11],

            // Education for Children
            ['name' => 'Math for Kids', 'parent_id' => 12],
            ['name' => 'Science for Kids', 'parent_id' => 12],
            ['name' => 'Reading for Kids', 'parent_id' => 12],
            ['name' => 'Language for Kids', 'parent_id' => 12],

            // Digital Marketing
            ['name' => 'SEO', 'parent_id' => 13],
            ['name' => 'PPC Advertising', 'parent_id' => 13],
            ['name' => 'Content Marketing', 'parent_id' => 13],
            ['name' => 'Email Marketing', 'parent_id' => 13],

            // Sales Strategies
            ['name' => 'Sales Psychology', 'parent_id' => 14],
            ['name' => 'Lead Generation', 'parent_id' => 14],
            ['name' => 'Sales Funnels', 'parent_id' => 14],
            ['name' => 'Cold Calling', 'parent_id' => 14],

            // Branding
            ['name' => 'Branding for Startups', 'parent_id' => 15],
            ['name' => 'Personal Branding', 'parent_id' => 15],
            ['name' => 'Brand Strategy', 'parent_id' => 15],
            ['name' => 'Logo Design', 'parent_id' => 15],

            // Social Media Marketing
            ['name' => 'Facebook Ads', 'parent_id' => 16],
            ['name' => 'Instagram Ads', 'parent_id' => 16],
            ['name' => 'LinkedIn Ads', 'parent_id' => 16],
            ['name' => 'Twitter Ads', 'parent_id' => 16],

            // Web Development
            ['name' => 'Frontend Development', 'parent_id' => 17],
            ['name' => 'Backend Development', 'parent_id' => 17],
            ['name' => 'Full Stack Development', 'parent_id' => 17],
            ['name' => 'Web Frameworks', 'parent_id' => 17],

            // Mobile Development
            ['name' => 'iOS Development', 'parent_id' => 18],
            ['name' => 'Android Development', 'parent_id' => 18],
            ['name' => 'Cross-platform Development', 'parent_id' => 18],
            ['name' => 'React Native', 'parent_id' => 18],

            // Data Science
            ['name' => 'Machine Learning', 'parent_id' => 19],
            ['name' => 'Data Analysis', 'parent_id' => 19],
            ['name' => 'Artificial Intelligence', 'parent_id' => 19],
            ['name' => 'Deep Learning', 'parent_id' => 19],

            // Graphic Design
            ['name' => 'Adobe Photoshop', 'parent_id' => 20],
            ['name' => 'Illustrator', 'parent_id' => 20],
            ['name' => 'Logo Design', 'parent_id' => 20],
            ['name' => 'Packaging Design', 'parent_id' => 20],

            // UI/UX Design
            ['name' => 'User Research', 'parent_id' => 21],
            ['name' => 'Wireframing', 'parent_id' => 21],
            ['name' => 'Prototyping', 'parent_id' => 21],
            ['name' => 'Interaction Design', 'parent_id' => 21],

            // Animation
            ['name' => '2D Animation', 'parent_id' => 22],
            ['name' => '3D Animation', 'parent_id' => 22],
            ['name' => 'Motion Graphics', 'parent_id' => 22],
            ['name' => 'Character Animation', 'parent_id' => 22],

            // Personal Development
            ['name' => 'Leadership', 'parent_id' => 23],
            ['name' => 'Public Speaking', 'parent_id' => 23],
            ['name' => 'Productivity', 'parent_id' => 23],
            ['name' => 'Time Management', 'parent_id' => 23],

            // Cooking
            ['name' => 'Baking', 'parent_id' => 24],
            ['name' => 'Healthy Recipes', 'parent_id' => 24],
            ['name' => 'Cooking for Beginners', 'parent_id' => 24],
            ['name' => 'International Cuisine', 'parent_id' => 24],

            // Health & Fitness
            ['name' => 'Yoga', 'parent_id' => 25],
            ['name' => 'Weight Loss', 'parent_id' => 25],
            ['name' => 'Mental Health', 'parent_id' => 25],
            ['name' => 'Nutrition', 'parent_id' => 25],
        ];

        foreach ($subSubcategories as $subSub) {
            Category::factory()->create($subSub);
        }
    }
}
