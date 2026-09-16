<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportMongoData extends Seeder
{
    public function run(): void
    {
        // ============================================================
        // USERS
        // ============================================================
        DB::table('users')->insert([
            'id' => 1,
            'tel' => '09379062528',
            'verificationCode' => '8005',
            'type' => 'user',
            'status' => 'verified',
            'address' => 'بابل',
            'bio' => 'سلام من فروشنده املاک هستم',
            'company' => 'رزم',
            'email' => 'saber@gmail.com',
            'instagram' => 'sdjfb',
            'name' => 'صابر احمدپور',
            'telegram' => 'ghj',
            'whatsapp' => 'hjghj',
            'is_agent' => true,
            'avatar' => '1783321756.png',
            'created_at' => '2026-04-23 12:57:36',
            'updated_at' => '2026-07-06 07:09:16',
        ]);

        // ============================================================
        // ADMINS
        // ============================================================
        DB::table('admins')->insert([
            'id' => 1,
            'name' => 'صابر',
            'lname' => 'احمدپور',
            'username' => 'admin',
            'password' => '$2y$12$wMEnmT.i26xhZngeuVY9weEJ8ED98ePUbYAciO5aGugNu8snTx20G',
            'type' => 'admin',
            'verificationCode' => '7831',
            'created_at' => '2026-04-23 13:42:00',
            'updated_at' => '2026-04-23 13:42:00',
        ]);

        // ============================================================
        // CITIES
        // ============================================================
        DB::table('cties')->insert([
            ['id' => 1, 'name' => 'بابل', 'tag' => 'babol', 'order' => '1', 'image' => '/storage/cities/1775562793_babol[1].jpg', 'date_created' => '2026-04-07 11:53:13', 'date_updated' => '2026-04-07 11:53:13'],
            ['id' => 2, 'name' => 'چالوس', 'tag' => 'chalus', 'order' => '5', 'image' => '/storage/cities/1775564665_chalos.jpg', 'date_created' => '2026-04-07 12:24:26', 'date_updated' => '2026-04-07 12:24:26'],
            ['id' => 3, 'name' => 'آمل', 'tag' => 'amol', 'order' => '3', 'image' => '/storage/cities/1775564735_amol.jpg', 'date_created' => '2026-04-07 12:25:35', 'date_updated' => '2026-04-07 12:25:35'],
            ['id' => 4, 'name' => 'بابلسر', 'tag' => 'babolsar', 'order' => '4', 'image' => '/storage/cities/1775564764_babolsar.jpg', 'date_created' => '2026-04-07 12:26:04', 'date_updated' => '2026-04-07 12:26:04'],
            ['id' => 5, 'name' => 'ساری', 'tag' => 'sari', 'order' => '6', 'image' => '/storage/cities/1775564786_sari.jpg', 'date_created' => '2026-04-07 12:26:26', 'date_updated' => '2026-04-07 12:26:26'],
        ]);

        // ============================================================
        // NEIGHBORHOODS
        // ============================================================
        DB::table('neighborhoods')->insert([
            ['id' => 1, 'name' => 'کمربندی غربی', 'tag' => 'west-babol', 'city_id' => 1, 'order' => '0', 'showInMenu' => true, 'image' => null],
            ['id' => 2, 'name' => 'کمربندی شرقی', 'tag' => 'east-babol', 'city_id' => 1, 'order' => '0', 'showInMenu' => true, 'image' => null],
            ['id' => 3, 'name' => 'شریعتی', 'tag' => 'shariati', 'city_id' => 1, 'order' => '0', 'showInMenu' => true, 'image' => null],
            ['id' => 4, 'name' => 'مدرس', 'tag' => 'modares', 'city_id' => 1, 'order' => '0', 'showInMenu' => true, 'image' => null],
            ['id' => 5, 'name' => 'هلال احمر', 'tag' => 'helal-ahmar', 'city_id' => 1, 'order' => '0', 'showInMenu' => false, 'image' => null],
            ['id' => 6, 'name' => 'پارک نوشیروانی', 'tag' => 'park-noshirvani', 'city_id' => 1, 'order' => '0', 'showInMenu' => true, 'image' => null],
            ['id' => 7, 'name' => 'حمزه کلا', 'tag' => 'hamzeh-kola', 'city_id' => 1, 'order' => '0', 'showInMenu' => true, 'image' => null],
        ]);

        // ============================================================
        // PROPERTIES - inserted individually for schema consistency
        // ============================================================
        $properties = [
            [
                'id' => 1, 'category' => 'apartment-rent', 'title' => 'نسشت بیصثسی',
                'description' => "س گقمسیجحسیبسی\r\nبیس\r\nب \r\nسیب\r\nسی\r\nب",
                'user_id' => 1, 'name' => 'صابر احمدپور', 'last_name' => 'س بیسب یس',
                'email' => 'saber@gmail.com', 'tel' => '09379062528', 'company' => 'رزم',
                'province' => 'مازندران', 'city' => 'بابل', 'neighborhood' => 'شریعتی',
                'address' => 'س بیسب سیب', 'area' => '50000', 'property_type' => 'آپارتمان',
                'status' => 'غیرفعال', '_status' => 'addedd',
                'date_created' => '1405-02-25 10:12:44', 'date_updated' => '1405-02-25 12:43:48',
                'is_featured' => true, 'media' => '["1778839964_0.png"]',
            ],
            [
                'id' => 2, 'category' => 'land', 'title' => 'سبیس بیسبیس',
                'description' => 'ب یسب',
                'user_id' => 1, 'name' => 'صابر احمدپور', 'last_name' => 'س بیسب یس',
                'email' => 'saber@gmail.com', 'tel' => '09379062528', 'company' => 'س یب',
                'province' => 'مازندران', 'city' => 'بابل', 'neighborhood' => 'شریعتی',
                'address' => 'سیسب سیب', 'area' => '700',
                'status' => 'ثبت شده', '_status' => 'addedd',
                'date_created' => '1405-02-25 12:45:25', 'date_updated' => '1405-02-25 14:11:45',
                'media' => '["1778849125_0.png"]', 'visit_count' => 1,
            ],
            [
                'id' => 3, 'category' => 'land', 'title' => 'سبیس بیسبیس',
                'description' => 'ب یسب',
                'user_id' => 1, 'name' => 'صابر احمدپور', 'last_name' => 'س بیسب یس',
                'email' => 'saber@gmail.com', 'tel' => '09379062528', 'company' => 'س یب',
                'province' => 'مازندران', 'city' => 'بابل', 'neighborhood' => 'شریعتی',
                'address' => 'سیسب سیب', 'area' => '700',
                'status' => 'ثبت شده', '_status' => 'addedd',
                'date_created' => '1405-02-25 12:45:25', 'date_updated' => '1405-02-25 14:11:45',
                'media' => '["1778849125_0.png"]', 'visit_count' => 1,
            ],
            [
                'id' => 4, 'category' => 'apartment-rent', 'title' => 'نسشت بیصثسی',
                'description' => "س گقمسیجحسیبسی\r\nبیس\r\nب \r\nسیب\r\nسی\r\nب",
                'user_id' => 1, 'name' => 'صابر احمدپور', 'last_name' => 'س بیسب یس',
                'email' => 'saber@gmail.com', 'tel' => '09379062528', 'company' => 'رزم',
                'province' => 'مازندران', 'city' => 'بابل', 'neighborhood' => 'شریعتی',
                'address' => 'س بیسب سیب', 'area' => '50000', 'property_type' => 'آپارتمان',
                'status' => 'غیرفعال', '_status' => 'addedd',
                'date_created' => '1405-02-25 10:12:44', 'date_updated' => '1405-02-25 12:43:48',
                'is_featured' => true, 'media' => '["1778839964_0.png"]',
            ],
            [
                'id' => 5, 'category' => 'apartment-rent', 'title' => 'نسشت بیصثسی',
                'description' => "س گقمسیجحسیبسی\r\nبیس\r\nب \r\nسیب\r\nسی\r\nب",
                'user_id' => 1, 'name' => 'صابر احمدپور', 'last_name' => 'س بیسب یس',
                'email' => 'saber@gmail.com', 'tel' => '09379062528', 'company' => 'رزم',
                'province' => 'مازندران', 'city' => 'بابل', 'neighborhood' => 'شریعتی',
                'address' => 'س بیسب سیب', 'area' => '50000', 'property_type' => 'آپارتمان',
                'status' => 'غیرفعال', '_status' => 'addedd',
                'date_created' => '1405-02-25 10:12:44', 'date_updated' => '1405-02-25 12:43:48',
                'is_featured' => true, 'media' => '["1778839964_0.png"]',
            ],
            [
                'id' => 6, 'category' => 'apartment-rent', 'title' => 'نسشت بیصثسی',
                'description' => "س گقمسیجحسیبسی\r\nبیس\r\nب \r\nسیب\r\nسی\r\nب",
                'user_id' => 1, 'name' => 'صابر احمدپور', 'last_name' => 'س بیسب یس',
                'email' => 'saber@gmail.com', 'tel' => '09379062528', 'company' => 'رزم',
                'province' => 'مازندران', 'city' => 'بابل', 'neighborhood' => 'شریعتی',
                'address' => 'س بیسب سیب', 'area' => '50000', 'property_type' => 'آپارتمان',
                'status' => 'غیرفعال', '_status' => 'addedd',
                'date_created' => '1405-02-25 10:12:44', 'date_updated' => '1405-04-09 08:44:49',
                'is_featured' => true, 'visit_count' => 1, 'property_view' => 'دریا',
                'media' => '["1778839964_0.png"]',
            ],
            [
                'id' => 7, 'category' => 'villa-sale', 'title' => 'یسب سیبس ی',
                'description' => 'یس بسیب',
                'user_id' => 1, 'name' => 'صابر احمدپور', 'last_name' => 'س بیسب یس',
                'email' => 'saber@gmail.com', 'tel' => '09379062528', 'company' => 'یب لبی',
                'province' => 'مازندران', 'city' => 'بابل', 'neighborhood' => 'کمربندی شرقی',
                'address' => 'سیب یسب سیب', 'rooms' => '3',
                'status' => 'ثبت شده', '_status' => 'addedd',
                'date_created' => '1405-04-09 06:50:38', 'date_updated' => '1405-04-09 06:50:38',
                'media' => '["1782802238_0.png"]', 'visit_count' => 1,
            ],
            [
                'id' => 8, 'category' => 'land', 'title' => 'سبیس بیسبیس',
                'description' => 'ب یسب',
                'user_id' => 1, 'name' => 'صابر احمدپور', 'last_name' => 'س بیسب یس',
                'email' => 'saber@gmail.com', 'tel' => '09379062528', 'company' => 'س یب',
                'province' => 'مازندران', 'city' => 'بابل', 'neighborhood' => 'شریعتی',
                'address' => 'سیسب سیب', 'area' => '700',
                'status' => 'تایید شده', '_status' => 'addedd',
                'date_created' => '1405-02-25 12:45:25', 'date_updated' => '2026-07-02 19:04:35',
                'media' => '["1778849125_0.png"]', 'visit_count' => 1,
            ],
        ];

        foreach ($properties as $prop) {
            DB::table('property')->insert($prop);
        }

        // ============================================================
        // PROPERTY_DETAILS
        // ============================================================
        // Apartments (1,4,5,6) share same details
        $aptRent = [
            'build_year' => '1392', 'parking' => 'دارد', 'storage' => 'دارد',
            'elevator' => 'دارد', 'mortgage' => '500000000', 'rent' => '1000000',
            'convertible' => 'on', 'unit_per_floor' => '2', 'floors_count' => '2',
            'building_direction' => 'جنوب', 'floor_type' => 'پارکت', 'toilet' => '1',
            'balcony' => 'دارد', 'cooling_system' => 'کولر گازی', 'heating_system' => 'رادیاتور',
            'pets_allowed' => 'مجاز است', 'kitchen_type' => 'بسته', 'cabinet_material' => 'MDF',
            'rebuilt' => '1', 'pool' => '1', 'sauna' => '1', 'jacuzzi' => '1', 'furnished' => '1',
        ];

        foreach ([1, 4, 5, 6] as $pid) {
            DB::table('property_details')->insert(array_merge(['property_id' => $pid], $aptRent));
        }

        // Lands (2,3,8)
        $land = [
            'price' => '6000000000', 'usage_type' => 'مسکونی',
            'document_status' => 'سند تک‌برگ', 'property_location' => 'سه نبش',
            'building_permit' => 'پروانه اضافه اشکوب', 'has_old_building' => 'بله',
            'exchangeable' => 'بله', 'utilities' => json_encode(['آب']),
        ];

        foreach ([2, 3, 8] as $pid) {
            DB::table('property_details')->insert(array_merge(['property_id' => $pid], $land));
        }

        // Villa-sale (7)
        DB::table('property_details')->insert([
            'property_id' => 7, 'price' => '1000000', 'floor_count' => '10',
            'building_type' => 'ویلایی مستقل', 'parking' => 'دارد', 'storage' => 'دارد',
            'balcony' => 'دارد', 'building_direction' => 'شرق',
            'floor_type' => 'سرامیک', 'toilet' => '1', 'cooling_system' => 'کولر گازی',
            'document_type' => 'تک‌برگ', 'pool_type' => 'ندارد',
        ]);

        // ============================================================
        // BLOGS
        // ============================================================
        DB::table('blogs')->insert([
            'id' => 1, 'title' => 'سیب یسب', 'slug' => 'sdfsf',
            'summary' => "سی بیسب\nیسب \nیسب",
            'image' => '/storage/blogs/1782881272_Screenshot 2024-11-09 161736.png',
            'category' => 'سیبیسب',
            'tags' => json_encode(['سسیب', 'سیب', 'سیب']),
            'status' => 'published', 'views_count' => 1,
            'published_at' => '2026-07-01T08:17',
            'date_created' => '2026-07-01 04:47:52',
            'date_updated' => '2026-07-01 04:48:00',
        ]);

        // ============================================================
        // PAGES
        // ============================================================
        DB::table('pages')->insert([
            'id' => 1, 'item1_title' => 'ایمیل', 'item2_title' => 'تماس با ما',
            'item3_title' => 'ما را دنبال کنید', 'value1' => 'example@email.com',
            'value2' => '(021) 224-1523', 'value3' => '@amlak', 'slug' => 'contact',
        ]);

        $aboutWhyItems = [
            ['icon_svg' => '<svg class="mb-3" xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none"><path fill-rule="evenodd" d="M5.493 32.863a6.53 6.53 0 0 1-5.446-6.441v-3.981a6.53 6.53 0 0 1 1.913-4.619c1.225-1.225 2.887-1.913 4.619-1.913h.435C7.709 7.137 15.048.234 24 .234s16.291 6.903 16.986 15.675h.435a6.53 6.53 0 0 1 6.532 6.532v3.981a6.53 6.53 0 0 1-6.532 6.532z" fill="#fd5631"/></svg>', 'title' => 'پشتیبانی 24/7 آنلاین', 'description' => 'لورم ایپسوم متن ساختگی.'],
            ['icon_svg' => '<svg class="mb-3" xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#fd5631"><path d="M39.976 40.416l-5.667-26.529c-.098-.44-.391-.831-.782-1.026z"/></svg>', 'title' => 'قیمت مناسب', 'description' => 'لورم ایپسوم متن ساختگی.'],
            ['icon_svg' => '<svg class="mb-3" xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#fd5631"><path d="M13.585 21.456a10.416 10.416 0 1 0 20.832 0c0-5.76-4.656-10.464-10.416-10.464z"/></svg>', 'title' => 'امنیت الویت ماست', 'description' => 'لورم ایپسوم متن ساختگی.'],
        ];
        $aboutSteps = [
            ['number' => 1, 'title' => 'انتخاب ملک موردپسند', 'description' => 'از صنعت چاپ و با استفاده از طراحان گرافیک است.'],
            ['number' => 2, 'title' => 'ارسال ملک برای مشاوران', 'description' => 'از صنعت چاپ و با استفاده از طراحان گرافیک است.'],
            ['number' => 3, 'title' => 'پرداخت هزینه از درگاه مطمئن', 'description' => 'از صنعت چاپ و با استفاده از طراحان گرافیک است.'],
        ];
        $aboutTeam = [
            ['name' => 'رضا ملک زاده', 'role' => 'مشاور', 'photo' => '/upload/about/team/1777360641_0_04.jpg', 'facebook' => '@', 'twitter' => '@', 'instagram' => '@'],
            ['name' => 'علی ریاحی', 'role' => 'مشاور', 'photo' => '/upload/about/team/1777360641_1_03.jpg', 'facebook' => 'd', 'twitter' => 'd', 'instagram' => 's'],
        ];
        $aboutTestimonials = [
            ['text' => 'لورم ایپسوم متن ساختگی.', 'company' => 'شرکت اول', 'person_name' => 'علی رضایی', 'person_role' => 'مدیر عامل', 'logo' => '/upload/about/1777360671_t0_22.jpg'],
            ['text' => 'لورم ایپسوم متن ساختگی.', 'company' => 'شرکت دوم', 'person_name' => 'علی رضایی', 'person_role' => 'مدیر عامل', 'logo' => '/upload/about/1777360979_t1_11.jpg'],
        ];

        DB::table('pages')->insert([
            'id' => 2, 'slug' => 'about',
            'hero_title' => 'درباره سایت',
            'hero_description' => 'ما خدمات کاملی را برای فروش، خرید یا اجاره املاک و مستغلات ارائه می دهیم.',
            'hero_button_text' => 'تماس با ما', 'hero_button_link' => '/page/contact',
            'hero_images' => json_encode(['/upload/about/1777360641_02.jpg']),
            'why_title' => 'دلیل انتخاب شرکت ما', 'why_items' => json_encode($aboutWhyItems),
            'steps_title' => 'روند همکاری مشاوران املاک',
            'steps_image' => '/upload/about/1777360641_find.svg',
            'steps_items' => json_encode($aboutSteps),
            'team_title' => 'مشاوران با تجربه سایت املاک',
            'team_members' => json_encode($aboutTeam),
            'testimonials_title' => 'نظرات مشتریان',
            'testimonials' => json_encode($aboutTestimonials),
            'cta_title' => 'با اطمینان ملک بخرید',
            'cta_description' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم.',
            'cta_button_text' => 'ملک خود را پیدا کن!',
            'cta_button_link' => '/browse/apartment',
            'cta_image' => '/upload/about/1777360641_01.png',
            'date_updated' => '2026-04-28 07:22:59',
        ]);

        // ============================================================
        // FAQS
        // ============================================================
        DB::table('faqs')->insert([
            ['id' => 1, 'category' => 'خریداران ملک', 'question' => 'چگونه می توانم درباره حقوق خود به عنوان مستاجر اطلاعات بیشتری کسب کنم؟', 'answer' => 'لورم ایپسوم متن ساختگی.', 'order' => '1'],
            ['id' => 2, 'category' => 'فروشندگان ملک', 'question' => 'چرا نمی توانم هویت خود را تأیید کنم؟', 'answer' => 'لورم ایپسوم متن ساختگی.', 'order' => '1'],
        ]);

        // ============================================================
        // SECTIONS
        // ============================================================
        DB::table('sections')->insert([
            ['id' => 1, 'position' => 'banner', 'title' => 'محاسبه آنلاین و سریع هزینه ملک دلخواه شما', 'desc' => 'ما املاک خوب زیادی داریم.', 'pic' => '/storage/sections/1775556048_1774424416_calculator.svg', 'link_title' => 'شروع کن', 'link' => 'start', 'date_created' => '2026-04-07 08:46:35', 'date_updated' => '2026-04-07 10:00:48'],
            ['id' => 2, 'position' => 'catalog', 'title' => 'اجاره یک ملک', 'desc' => 'لورم ایپسوم ساختار چاپ و متن را در بر می گیرد.', 'pic' => '/storage/sections/1775556008_1774424261_rent.svg', 'link_title' => 'یافتن اجاره خانه', 'link' => 'cc', 'date_created' => '2026-04-07 09:05:51', 'date_updated' => '2026-04-07 10:00:08'],
            ['id' => 3, 'position' => 'catalog', 'title' => 'فروش یک ملک', 'desc' => 'لورم ایپسوم ساختار چاپ و متن را در بر می گیرد.', 'pic' => '/storage/sections/1775556019_1774424302_sell.svg', 'link_title' => 'مکان کسب و کار', 'link' => 'bussiness', 'date_created' => '2026-04-07 09:21:05', 'date_updated' => '2026-04-07 10:00:19'],
            ['id' => 4, 'position' => 'catalog', 'title' => 'خرید یک ملک', 'desc' => 'لورم ایپسوم ساختار چاپ و متن را در بر می گیرد.', 'pic' => '/storage/sections/1775556029_1774424331_buy.svg', 'link_title' => 'جستجوی خانه', 'link' => 'search', 'date_created' => '2026-04-07 09:21:51', 'date_updated' => '2026-04-07 10:00:29'],
            ['id' => 5, 'position' => 'header', 'title' => 'نرخ ارزان خانه در مکان دلخواه شما', 'desc' => 'لورم ایپسوم ساختار چاپ و متن را در بر می گیرد.', 'pic' => '/storage/sections/1775556039_1774444940_hero-image.jpg', 'link_title' => 'مشاهده بیشتر', 'link' => 'more', 'date_created' => '2026-04-07 09:33:14', 'date_updated' => '2026-04-07 10:00:39'],
        ]);

        // ============================================================
        // TOP_AGENTS
        // ============================================================
        DB::table('top_agents')->insert([
            'id' => 1, 'user_id' => 1, 'custom_text' => 'مکسیئبن سیئب', 'order' => '1',
            'created_at' => '2026-07-05 14:17:10', 'updated_at' => '2026-07-05 14:17:10',
        ]);

        $this->command->info('All MongoDB data imported successfully into MySQL!');
    }
}
