<?php

use Illuminate\Database\Seeder;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Seeding default list of skills');

        $skills = [
            'language' => [
                'Javascript', 'TypeScript', 'ASP', 'PHP', 'Python', 'HTML', 'XML', 'Java', 'c-sharp' => 'C#', 'Ruby', 'c-plus-plus' => 'C++', 'Erlang',
                'Go', 'Elixir', 'Clojure', 'Haskell', 'NodeJS', 'Swift', 'SQL', 'CSS', 'SASS', 'LESS', 'Stylus',
                'Rust', 'Scala', 'f-sharp'=> 'F#', 'Objective-C', 'Action Script', 'Coffee Script', 'Matlab', 'Perl', 'R'
            ],


            'framework' => [
                'AngularJS', 'Angular 2+', 'React', 'React Native', 'Ruby on Rails', 'jQuery', 'Laravel', 'Django', 'Symfony', 'Codeigniter', 'CakePHP',
                'Zend Framework', 'ASP.NET', 'ExpressJS', 'Drupal', 'Sinatra', 'Vaadin', 'SailJS',
                'Silex', 'VueJS', 'EmberJS', 'Aurelia', 'Ionic', 'yii2', 'CycleJS', 'falcon'
            ],

            'database' => [
                'MSSQL', 'MySQL', 'MariaDB', 'MongoDB', 'Oracle', 'PostgreSQL', 'DB2', 'SAP HANA', 'SQLite', 'Cassandra',
                'Redis', 'MS Access', 'Elastic Search', 'HBase', 'FileMaker', 'CouchDB', 'DynamoDB', 'Firebase',
            ],

            'os' => [
                'Windows', 'OS X', 'Linux', 'Android', 'iOS', 'Windows Server', 'CentOS'
            ],

            'security' => [
                'Cyber Security', 'Penetration Testing', 'Networking', 'Encryption', 'Firewall', 'Security Analysis',
                'Endpoint Security'
            ],

            'ide' => [
                'Atom', 'Visual Studio Code', 'Sublime Text', 'PyCharm', 'WebStorm', 'PHPStorm',  'NetBeans',
                'InteliJ IDEA', 'Eclipse', 'Brackets', 'Notepad++', 'Aptana Studio', 'Dreamweaver', 'Xcode', 'CodeBlocks',
                'Emac editor', 'VIM editor'
            ],


            'other' => [
                'Git', 'GitHub', 'BitBucket', 'GitLab', 'Continuous Integration', 'Webpack', 'Grunt', 'Gulp', 'Babel',
                'Amazon AWS', 'Object Oriented Programming', 'Functional Programming', 'Mathematics', 'Troubleshooting',
                'Photoshop', 'Excel', 'Docker', 'Vagrant', 'UML'
            ]
        ];

        foreach($skills as $skillType => $items) {
            asort($items);

            foreach($items as $slugKey => $skill) {

                if(is_numeric($slugKey)) {
                    $slug = str_slug($skill);
                } else {
                    $slug = str_slug($slugKey);
                }

                \App\Models\Skill::create([
                    'name' => $skill,
                    'type' => $skillType,
                    'slug' => $slug
                ]);
            }
        }

        $this->command->info('Skills loaded');
    }
}
