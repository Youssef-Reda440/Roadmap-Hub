<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CreatorApplication;
use App\Models\Resource;
use App\Models\Review;
use App\Models\Roadmap;
use App\Models\RoadmapEnrollment;
use App\Models\SavedRoadmap;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */

        $password = Hash::make('password123');

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@roadhub.test',
            'password' => $password,
            'role' => 'admin',
        ]);

        $creator1 = User::create([
            'name' => 'Ahmed Hassan',
            'email' => 'ahmed@roadmaphub.test',
            'password' => $password,
            'role' => 'creator',
        ]);

        $creator2 = User::create([
            'name' => 'Mariam Ali',
            'email' => 'mariam@roadmaphub.test',
            'password' => $password,
            'role' => 'creator',
        ]);

        $learner1 = User::create([
            'name' => 'Omar Khaled',
            'email' => 'omar@roadmaphub.test',
            'password' => $password,
            'role' => 'learner',
        ]);

        $learner2 = User::create([
            'name' => 'Sara Mohamed',
            'email' => 'sara@roadmaphub.test',
            'password' => $password,
            'role' => 'learner',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        $web = Category::create([
            'name' => 'تطوير الويب',
            'slug' => 'web-development',
            'description' => 'تعلم تطوير مواقع وتطبيقات الويب من الأساسيات إلى المستويات المتقدمة.',
        ]);

        $ai = Category::create([
            'name' => 'الذكاء الاصطناعي',
            'slug' => 'artificial-intelligence',
            'description' => 'مسارات تعليمية في الذكاء الاصطناعي وتعلم الآلة وتحليل البيانات.',
        ]);

        $mobile = Category::create([
            'name' => 'تطبيقات الموبايل',
            'slug' => 'mobile-development',
            'description' => 'تعلم تطوير تطبيقات Android و iOS باستخدام التقنيات الحديثة.',
        ]);

        $devops = Category::create([
            'name' => 'DevOps والشبكات',
            'slug' => 'devops-networking',
            'description' => 'تعلم Linux والشبكات وDevOps وأساسيات البنية التحتية.',
        ]);

        $cybersecurity = Category::create([
            'name' => 'الأمن السيبراني',
            'slug' => 'cybersecurity',
            'description' => 'تعلم أساسيات الأمن السيبراني واختبار الاختراق وحماية الأنظمة.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Roadmaps
        |--------------------------------------------------------------------------
        */

        $roadmaps = [];

        $roadmaps[] = Roadmap::create([
            'creator_id' => $creator1->id,
            'category_id' => $web->id,
            'title' => 'Web Development Fundamentals',
            'description' => 'مسار أساسي لتعلم HTML وCSS وJavaScript وبناء أساس قوي في تطوير الويب.',
            'level' => 'beginner',
            'status' => 'published',
        ]);

        $roadmaps[] = Roadmap::create([
            'creator_id' => $creator2->id,
            'category_id' => $web->id,
            'title' => 'Frontend Development with JavaScript',
            'description' => 'مسار عملي لتعلم JavaScript وتطوير واجهات ويب تفاعلية.',
            'level' => 'intermediate',
            'status' => 'published',
        ]);

        $roadmaps[] = Roadmap::create([
            'creator_id' => $creator1->id,
            'category_id' => $ai->id,
            'title' => 'Artificial Intelligence Fundamentals',
            'description' => 'مقدمة عملية في مفاهيم الذكاء الاصطناعي وتعلم الآلة.',
            'level' => 'beginner',
            'status' => 'published',
        ]);

        $roadmaps[] = Roadmap::create([
            'creator_id' => $creator2->id,
            'category_id' => $ai->id,
            'title' => 'Machine Learning Basics',
            'description' => 'مسار أساسي لفهم خوارزميات تعلم الآلة وتطبيقاتها.',
            'level' => 'intermediate',
            'status' => 'published',
        ]);

        $roadmaps[] = Roadmap::create([
            'creator_id' => $creator1->id,
            'category_id' => $mobile->id,
            'title' => 'Android Development Fundamentals',
            'description' => 'تعلم أساسيات تطوير تطبيقات Android وبناء أول تطبيقاتك.',
            'level' => 'beginner',
            'status' => 'published',
        ]);

        $roadmaps[] = Roadmap::create([
            'creator_id' => $creator2->id,
            'category_id' => $mobile->id,
            'title' => 'Flutter Mobile Development',
            'description' => 'مسار عملي لتعلم Flutter وبناء تطبيقات موبايل متعددة المنصات.',
            'level' => 'intermediate',
            'status' => 'published',
        ]);

        $roadmaps[] = Roadmap::create([
            'creator_id' => $creator1->id,
            'category_id' => $devops->id,
            'title' => 'Linux and Networking Fundamentals',
            'description' => 'أساسيات Linux والشبكات الضرورية لأي مهندس أنظمة أو DevOps.',
            'level' => 'beginner',
            'status' => 'published',
        ]);

        $roadmaps[] = Roadmap::create([
            'creator_id' => $creator2->id,
            'category_id' => $devops->id,
            'title' => 'DevOps Fundamentals',
            'description' => 'مقدمة عملية في Git وDocker وCI/CD ومفاهيم DevOps الأساسية.',
            'level' => 'intermediate',
            'status' => 'published',
        ]);

        $roadmaps[] = Roadmap::create([
            'creator_id' => $creator1->id,
            'category_id' => $cybersecurity->id,
            'title' => 'Cybersecurity Fundamentals',
            'description' => 'مسار أساسي لفهم الشبكات والأنظمة ومفاهيم الأمن السيبراني.',
            'level' => 'beginner',
            'status' => 'pending_review',
        ]);

        $roadmaps[] = Roadmap::create([
            'creator_id' => $creator2->id,
            'category_id' => $cybersecurity->id,
            'title' => 'Web Application Security',
            'description' => 'مقدمة عملية في أمن تطبيقات الويب والثغرات الشائعة.',
            'level' => 'intermediate',
            'status' => 'pending_review',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Resources
        |--------------------------------------------------------------------------
        */

        $resourceSets = [
            // Web Development Fundamentals
            1 => [
                [
                    'HTML Basics',
                    'https://developer.mozilla.org/en-US/docs/Learn_web_development/Core/Structuring_content',
                    'documentation',
                    'Learn the fundamentals of HTML and how to structure web pages.',
                ],
                [
                    'CSS Basics',
                    'https://developer.mozilla.org/en-US/docs/Learn_web_development/Core/Styling_basics',
                    'documentation',
                    'Learn how CSS is used to style and design web pages.',
                ],
                [
                    'JavaScript Guide',
                    'https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide',
                    'documentation',
                    'A practical guide to the core concepts of JavaScript.',
                ],
                [
                    'HTTP Overview',
                    'https://developer.mozilla.org/en-US/docs/Web/HTTP/Overview',
                    'documentation',
                    'Understand HTTP and how browsers communicate with web servers.',
                ],
                [
                    'Git Tutorial',
                    'https://git-scm.com/docs/gittutorial',
                    'documentation',
                    'Learn the basic Git workflow for managing source code.',
                ],
            ],

            // Frontend Development with JavaScript
            2 => [
                [
                    'JavaScript First Steps',
                    'https://developer.mozilla.org/en-US/docs/Learn_web_development/Core/Scripting',
                    'documentation',
                    'Learn variables, functions, conditions, loops, and basic JavaScript concepts.',
                ],
                [
                    'DOM Introduction',
                    'https://developer.mozilla.org/en-US/docs/Web/API/Document_Object_Model/Introduction',
                    'documentation',
                    'Understand the DOM and how JavaScript interacts with web pages.',
                ],
                [
                    'JavaScript Events',
                    'https://developer.mozilla.org/en-US/docs/Web/API/Document_Object_Model/Events',
                    'documentation',
                    'Learn how to handle user interactions and browser events.',
                ],
                [
                    'Fetch API',
                    'https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API',
                    'documentation',
                    'Learn how JavaScript applications communicate with APIs.',
                ],
                [
                    'JavaScript Modules',
                    'https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Modules',
                    'documentation',
                    'Understand JavaScript modules and how to organize frontend code.',
                ],
            ],

            // Artificial Intelligence Fundamentals
            3 => [
                [
                    'Python Tutorial',
                    'https://docs.python.org/3/tutorial/',
                    'documentation',
                    'Learn Python fundamentals required for working with AI and data.',
                ],
                [
                    'NumPy Quickstart',
                    'https://numpy.org/doc/stable/user/quickstart.html',
                    'documentation',
                    'Learn the fundamentals of numerical computing with NumPy.',
                ],
                [
                    'Pandas Getting Started',
                    'https://pandas.pydata.org/docs/getting_started/intro_tutorials/',
                    'documentation',
                    'Learn how to work with and analyze structured datasets using Pandas.',
                ],
                [
                    'Introduction to Machine Learning',
                    'https://developers.google.com/machine-learning/intro',
                    'article',
                    'An introduction to machine learning concepts and common workflows.',
                ],
                [
                    'AI Fundamentals',
                    'https://www.ibm.com/think/topics/artificial-intelligence',
                    'article',
                    'Understand the main concepts, applications, and terminology of AI.',
                ],
            ],

            // Machine Learning Basics
            4 => [
                [
                    'Machine Learning Crash Course',
                    'https://developers.google.com/machine-learning/crash-course',
                    'link',
                    'A practical introduction to machine learning concepts and techniques.',
                ],
                [
                    'Supervised Learning',
                    'https://scikit-learn.org/stable/supervised_learning.html',
                    'documentation',
                    'Explore common supervised learning algorithms and their use cases.',
                ],
                [
                    'Unsupervised Learning',
                    'https://scikit-learn.org/stable/unsupervised_learning.html',
                    'documentation',
                    'Learn clustering and other unsupervised learning techniques.',
                ],
                [
                    'Model Evaluation',
                    'https://scikit-learn.org/stable/modules/model_evaluation.html',
                    'documentation',
                    'Learn how to evaluate machine learning models effectively.',
                ],
                [
                    'Scikit-learn User Guide',
                    'https://scikit-learn.org/stable/user_guide.html',
                    'documentation',
                    'Reference material for implementing practical machine learning workflows.',
                ],
            ],

            // Android Development Fundamentals
            5 => [
                [
                    'Android Developers Training',
                    'https://developer.android.com/courses',
                    'link',
                    'Official training resources for learning Android development.',
                ],
                [
                    'Android App Fundamentals',
                    'https://developer.android.com/guide/components/fundamentals',
                    'documentation',
                    'Understand the fundamental components of Android applications.',
                ],
                [
                    'Kotlin Documentation',
                    'https://kotlinlang.org/docs/home.html',
                    'documentation',
                    'Learn Kotlin fundamentals for modern Android development.',
                ],
                [
                    'Jetpack Compose Basics',
                    'https://developer.android.com/develop/ui/compose/documentation',
                    'documentation',
                    'Learn the basics of building Android interfaces with Jetpack Compose.',
                ],
                [
                    'Android Architecture',
                    'https://developer.android.com/topic/architecture',
                    'documentation',
                    'Understand recommended architecture patterns for Android applications.',
                ],
            ],

            // Flutter Mobile Development
            6 => [
                [
                    'Flutter Get Started',
                    'https://docs.flutter.dev/get-started/install',
                    'documentation',
                    'Set up Flutter and build your first cross-platform application.',
                ],
                [
                    'Dart Language Tour',
                    'https://dart.dev/language',
                    'documentation',
                    'Learn the Dart language fundamentals used by Flutter.',
                ],
                [
                    'Flutter Widgets',
                    'https://docs.flutter.dev/ui/widgets',
                    'documentation',
                    'Understand Flutter widgets and how interfaces are constructed.',
                ],
                [
                    'Flutter State Management',
                    'https://docs.flutter.dev/data-and-backend/state-mgmt',
                    'documentation',
                    'Learn the fundamentals of managing application state in Flutter.',
                ],
                [
                    'Flutter Navigation',
                    'https://docs.flutter.dev/ui/navigation',
                    'documentation',
                    'Learn how to navigate between screens in Flutter applications.',
                ],
            ],

            // Linux and Networking Fundamentals
            7 => [
                [
                    'Linux Command Line',
                    'https://ubuntu.com/tutorials/command-line-for-beginners',
                    'documentation',
                    'Learn essential Linux command-line concepts and commands.',
                ],
                [
                    'Linux Filesystem',
                    'https://refspecs.linuxfoundation.org/FHS_3.0/fhs/index.html',
                    'documentation',
                    'Understand the Linux filesystem hierarchy and common directories.',
                ],
                [
                    'TCP/IP Overview',
                    'https://developer.mozilla.org/en-US/docs/Glossary/TCP',
                    'article',
                    'Understand the fundamentals of TCP and reliable network communication.',
                ],
                [
                    'DNS Explained',
                    'https://www.cloudflare.com/learning/dns/what-is-dns/',
                    'article',
                    'Learn how DNS translates domain names into network addresses.',
                ],
                [
                    'HTTP Networking',
                    'https://developer.mozilla.org/en-US/docs/Web/HTTP',
                    'documentation',
                    'Understand HTTP communication between clients and servers.',
                ],
            ],

            // DevOps Fundamentals
            8 => [
                [
                    'Git Documentation',
                    'https://git-scm.com/doc',
                    'documentation',
                    'Learn version control concepts and professional Git workflows.',
                ],
                [
                    'Docker Get Started',
                    'https://docs.docker.com/get-started/',
                    'documentation',
                    'Learn containerization concepts and build your first Docker containers.',
                ],
                [
                    'Docker Images',
                    'https://docs.docker.com/get-started/docker-concepts/the-basics/what-is-an-image/',
                    'documentation',
                    'Understand Docker images and how containers are created from them.',
                ],
                [
                    'GitHub Actions',
                    'https://docs.github.com/en/actions',
                    'documentation',
                    'Learn how to automate software workflows using GitHub Actions.',
                ],
                [
                    'CI/CD Introduction',
                    'https://docs.github.com/en/actions/get-started/continuous-integration',
                    'documentation',
                    'Understand continuous integration and automated software delivery.',
                ],
            ],

            // Cybersecurity Fundamentals
            9 => [
                [
                    'OWASP Top 10',
                    'https://owasp.org/www-project-top-ten/',
                    'documentation',
                    'Learn about the most important web application security risks.',
                ],
                [
                    'OWASP Web Security Testing Guide',
                    'https://owasp.org/www-project-web-security-testing-guide/',
                    'documentation',
                    'A structured guide for testing the security of web applications.',
                ],
                [
                    'PortSwigger Web Security Academy',
                    'https://portswigger.net/web-security',
                    'link',
                    'Hands-on training for learning practical web application security.',
                ],
                [
                    'NIST Cybersecurity Framework',
                    'https://www.nist.gov/cyberframework',
                    'documentation',
                    'Learn the fundamentals of identifying and managing cybersecurity risks.',
                ],
                [
                    'Cybersecurity Fundamentals',
                    'https://www.cisa.gov/topics/cyber-threats-and-advisories',
                    'article',
                    'Explore fundamental cybersecurity concepts and common cyber threats.',
                ],
            ],

            // Web Application Security
            10 => [
                [
                    'Cross-Site Scripting',
                    'https://portswigger.net/web-security/cross-site-scripting',
                    'link',
                    'Learn how XSS vulnerabilities work and how web applications can prevent them.',
                ],
                [
                    'SQL Injection',
                    'https://portswigger.net/web-security/sql-injection',
                    'link',
                    'Understand SQL injection vulnerabilities and secure database queries.',
                ],
                [
                    'Authentication Vulnerabilities',
                    'https://portswigger.net/web-security/authentication',
                    'link',
                    'Learn common authentication weaknesses and secure authentication practices.',
                ],
                [
                    'Access Control',
                    'https://portswigger.net/web-security/access-control',
                    'link',
                    'Understand authorization failures and access control vulnerabilities.',
                ],
                [
                    'CSRF',
                    'https://portswigger.net/web-security/csrf',
                    'link',
                    'Learn how CSRF attacks work and how applications defend against them.',
                ],
            ],
        ];

        foreach ($roadmaps as $index => $roadmap) {
            foreach ($resourceSets[$index + 1] as $resource) {
                Resource::create([
                    'roadmap_id' => $roadmap->id,
                    'title' => $resource[0],
                    'url' => $resource[1],
                    'type' => $resource[2],
                    'description' => $resource[3],
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Enrollments
        |--------------------------------------------------------------------------
        */

        $publishedRoadmaps = array_slice($roadmaps, 0, 8);

        $enrollments = [
            [$learner1->id, $publishedRoadmaps[0]->id],
            [$learner1->id, $publishedRoadmaps[1]->id],
            [$learner1->id, $publishedRoadmaps[2]->id],
            [$learner1->id, $publishedRoadmaps[4]->id],
            [$learner1->id, $publishedRoadmaps[6]->id],

            [$learner2->id, $publishedRoadmaps[0]->id],
            [$learner2->id, $publishedRoadmaps[2]->id],
            [$learner2->id, $publishedRoadmaps[3]->id],
            [$learner2->id, $publishedRoadmaps[5]->id],
            [$learner2->id, $publishedRoadmaps[7]->id],
        ];

        foreach ($enrollments as [$userId, $roadmapId]) {
            RoadmapEnrollment::create([
                'user_id' => $userId,
                'roadmap_id' => $roadmapId,
                'enrolled_at' => now()->subDays(rand(1, 20)),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Saved Roadmaps
        |--------------------------------------------------------------------------
        */

        $savedRoadmaps = [
            [$learner1->id, $publishedRoadmaps[1]->id],
            [$learner1->id, $publishedRoadmaps[3]->id],
            [$learner1->id, $publishedRoadmaps[5]->id],

            [$learner2->id, $publishedRoadmaps[0]->id],
            [$learner2->id, $publishedRoadmaps[4]->id],
            [$learner2->id, $publishedRoadmaps[6]->id],
            [$learner2->id, $publishedRoadmaps[7]->id],
        ];

        foreach ($savedRoadmaps as [$userId, $roadmapId]) {
            SavedRoadmap::create([
                'user_id' => $userId,
                'roadmap_id' => $roadmapId,
                'saved_at' => now()->subDays(rand(1, 15)),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Reviews
        |--------------------------------------------------------------------------
        */

        $reviews = [
            [$learner1->id, 1, 5, 'مسار ممتاز ومنظم جدًا، مناسب جدًا للبداية.'],
            [$learner2->id, 1, 5, 'المصادر مختارة بشكل ممتاز والشرح واضح.'],

            [$learner1->id, 2, 4, 'محتوى جيد جدًا وساعدني في فهم JavaScript بشكل أفضل.'],
            [$learner2->id, 2, 5, 'مسار عملي ومفيد جدًا.'],

            [$learner1->id, 3, 5, 'شرح ممتاز للمفاهيم الأساسية في الذكاء الاصطناعي.'],
            [$learner2->id, 3, 4, 'مفيد جدًا كبداية في المجال.'],

            [$learner1->id, 4, 5, 'المصادر ممتازة والمسار مرتب.'],
            [$learner2->id, 4, 5, 'تجربة جيدة جدًا للمبتدئين.'],

            [$learner1->id, 5, 4, 'شرح واضح والمصادر ساعدتني أبدأ Android.'],
            [$learner2->id, 5, 5, 'مسار ممتاز كبداية لتطوير تطبيقات Android.'],

            [$learner1->id, 6, 5, 'Flutter أصبح أوضح بالنسبة لي بعد المسار ده.'],
            [$learner2->id, 6, 4, 'محتوى عملي ومنظم.'],

            [$learner1->id, 7, 5, 'من أفضل المسارات لفهم Linux والشبكات.'],
            [$learner2->id, 7, 5, 'المصادر ممتازة والأساسيات مشروحة بشكل جيد.'],

            [$learner1->id, 8, 4, 'مقدمة ممتازة في Docker وCI/CD ومفاهيم DevOps.'],
            [$learner2->id, 8, 5, 'المسار ساعدني أفهم Workflow الخاص بالـ DevOps.'],
        ];

        foreach ($reviews as [$userId, $roadmapIndex, $rating, $comment]) {
            if ($roadmapIndex === 0) {
                continue;
            }

            Review::create([
                'user_id' => $userId,
                'roadmap_id' => $publishedRoadmaps[$roadmapIndex - 1]->id,
                'rating' => $rating,
                'comment' => $comment,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Creator Application
        |--------------------------------------------------------------------------
        */

        CreatorApplication::create([
            'user_id' => $learner2->id,
            'status' => 'pending',
        ]);
    }
}
