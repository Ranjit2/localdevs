<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skillsArray = [
            [
                'name' => 'Javascript',
                'category' => 'programming',
                'expertise' => '{"designer": 1,"developer": 1}'
            ],
            [
                'name' => 'Python',
                'category' => 'programming',
                'expertise' => '{"designer": 1,"developer": 1}'
            ],
            [
                'name' => 'PHP',
                'category' => 'programming',
                'expertise' => '{"designer": 1,"developer": 1}'
            ],
            [
                'name' => 'HTML',
                'category' => 'programming',
                'expertise' => '{"designer": 1,"developer": 1, "motion": 1}'
            ],
            [
                'name' => 'CSS',
                'category' => 'programming',
                'expertise' => '{"designer": 1,"developer": 1, "motion": 1}'
            ],
            [
                'name' => 'Java',
                'category' => 'programming',
                'expertise' => '{"designer": 1,"developer": 1}'
            ],
            [
                'name' => 'Go',
                'category' => 'programming',
                'expertise' => '{"designer": 1,"developer": 1}'
            ],
            [
                'name' => 'C#',
                'category' => 'programming',
                'expertise' => '{"designer": 1,"developer": 1}'
            ],
            [
                'name' => 'C and C++',
                'category' => 'programming',
                'expertise' => '{"designer": 1,"developer": 1}'
            ],
            [
                'name' => 'Ruby',
                'category' => 'programming',
                'expertise' => '{"designer": 1,"developer": 1}'
            ],

            //frameworks
            [
                'name' => 'Laravel',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'Symfony',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'Yii',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'CakePHP',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'CodeIgniter',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'ASP.NET',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'Ruby on rails',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'Django',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'Flask',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'Spring',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'Struts',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'Hibernate',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'Node.js',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'React',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1,"designer": 1}'
            ],
            [
                'name' => 'Next js',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'Vue js',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1,"designer": 1}'
            ],
            [
                'name' => 'Nuxt js',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'Angular js',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1,"designer": 1}'
            ],
            [
                'name' => 'Nest js',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'Bootstrap',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1,"designer": 1,"motion": 1}'
            ],
            [
                'name' => 'Tailwindcss',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1,"designer": 1}'
            ],
            [
                'name' => 'Flutter',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'React native',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'Wordpress',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'Drupal',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'Joomla',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'Magento',
                'category' => 'frameworks',
                'expertise' => '{"developer": 1}'
            ],
            

            //databases
            [
                'name' => 'MySQL',
                'category' => 'database',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'PostgreSQL',
                'category' => 'database',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'SQLite',
                'category' => 'database',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'MS SQL Server',
                'category' => 'database',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'Oracle',
                'category' => 'database',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => ' MariaDB',
                'category' => 'database',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'MongoDB',
                'category' => 'database',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'Redis',
                'category' => 'database',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'Firebase',
                'category' => 'database',
                'expertise' => '{"developer": 1}'
            ],

            //motion
            [
                'name' => 'Photoshop',
                'category' => 'motion',
                'expertise' => '{"motion": 1}'
            ],
            [
                'name' => 'Illustrator',
                'category' => 'motion',
                'expertise' => '{"motion": 1}'
            ],
            [
                'name' => 'After Effects',
                'category' => 'motion',
                'expertise' => '{"motion": 1}'
            ],
            [
                'name' => 'Mocha AE',
                'category' => 'motion',
                'expertise' => '{"motion": 1}'
            ],
            [
                'name' => 'Cinema 4D',
                'category' => 'motion',
                'expertise' => '{"motion": 1}'
            ],
            [
                'name' => 'Maya',
                'category' => 'motion',
                'expertise' => '{"motion": 1}'
            ],
            [
                'name' => 'Blender',
                'category' => 'motion',
                'expertise' => '{"motion": 1}'
            ],

            //cloud computing
            [
                'name' => 'Amazon Web Services (AWS)',
                'category' => 'cloud computing',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'Microsoft Azure',
                'category' => 'cloud computing',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'Google Cloud',
                'category' => 'cloud computing',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'IBM Cloud',
                'category' => 'cloud computing',
                'expertise' => '{"developer": 1}'
            ],
            [
                'name' => 'Oracle Cloud',
                'category' => 'cloud computing',
                'expertise' => '{"developer": 1}'
            ],

            //Tools
            [
                'name' => 'Git & Github',
                'category' => 'tools',
                'expertise' => '{"developer": 1,"designer": 1}'
            ],
            [
                'name' => 'Bitbucket',
                'category' => 'tools',
                'expertise' => '{"developer": 1,"designer": 1}'
            ],
            [
                'name' => 'Trello',
                'category' => 'tools',
                'expertise' => '{"developer": 1,"designer": 1}'
            ],
            [
                'name' => 'Jira',
                'category' => 'tools',
                'expertise' => '{"developer": 1,"designer": 1}'
            ],

        ];

        foreach ($skillsArray as $skillArray) {
            Skill::create($skillArray);
        }
    }
}
