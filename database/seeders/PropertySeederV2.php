<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PropertySeederV2 extends Seeder
{
    public function run(): void
    {
        $this->command->info('Clearing existing property data...');
        DB::table('property_details')->delete();
        DB::table('property')->delete();
        DB::statement('ALTER TABLE property AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE property_details AUTO_INCREMENT = 1');

        // Clear old property images
        $uploadPath = public_path('upload/property');
        if (is_dir($uploadPath)) {
            $dirs = glob($uploadPath . '/*');
            foreach ($dirs as $dir) {
                if (is_dir($dir)) {
                    File::deleteDirectory($dir);
                }
            }
        }

        $this->command->info('Creating 27 sample properties (3 per category)...');
        $id = 1;

        $categories = [
            'apartment-rent', 'apartment-sale', 'villa-sale', 'villa-short-rent',
            'commercial-rent', 'commercial-sale', 'land', 'pre-sale', 'other',
        ];

        foreach ($categories as $category) {
            $items = $this->getCategoryProperties($category);
            foreach ($items as $index => $item) {
                $imageFilename = $this->createPropertyImage($id, $category, $index + 1);

                $propertyId = DB::table('property')->insertGetId([
                    'category' => $category,
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'user_id' => 1,
                    'name' => $item['name'],
                    'last_name' => $item['last_name'],
                    'email' => 'saber@gmail.com',
                    'tel' => '09379062528',
                    'company' => $item['company'],
                    'province' => $item['province'],
                    'city' => $item['city'],
                    'neighborhood' => $item['neighborhood'],
                    'address' => $item['address'],
                    'area' => $item['area'],
                    'property_type' => $item['property_type'] ?? null,
                    'rooms' => $item['rooms'] ?? null,
                    'status' => 'فعال',
                    '_status' => 'addedd',
                    'date_created' => '1405-04-15 10:00:00',
                    'date_updated' => '1405-04-15 10:00:00',
                    'is_featured' => $item['is_featured'] ?? false,
                    'visit_count' => rand(5, 50),
                    'media' => json_encode([$imageFilename]),
                    'property_view' => $item['property_view'] ?? null,
                    'land_area' => $item['land_area'] ?? null,
                    'building_area' => $item['building_area'] ?? null,
                ]);

                $details = $item['details'] ?? [];
                if (!empty($details)) {
                    $details['property_id'] = $propertyId;
                    DB::table('property_details')->insert($details);
                }

                $id++;
                $this->command->info("  ✓ {$category} #" . ($index + 1));
            }
        }

        $this->command->info("✅ Successfully created 27 sample properties!");
    }

    private function createPropertyImage(int $propertyId, string $category, int $num): string
    {
        $uploadDir = public_path('upload/property/' . $propertyId);
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $filename = 'sample_' . $num . '.jpg';
        $filepath = $uploadDir . '/' . $filename;

        $img = imagecreatetruecolor(800, 600);

        // Category colors
        $colors = [
            'apartment-rent' => [41, 128, 185],
            'apartment-sale' => [52, 152, 219],
            'villa-sale' => [39, 174, 96],
            'villa-short-rent' => [22, 160, 133],
            'commercial-rent' => [243, 156, 18],
            'commercial-sale' => [230, 126, 34],
            'land' => [142, 68, 173],
            'pre-sale' => [192, 57, 43],
            'other' => [44, 62, 80],
        ];

        $rgb = $colors[$category] ?? [128, 128, 128];
        $bgColor = imagecolorallocate($img, $rgb[0], $rgb[1], $rgb[2]);
        $whiteColor = imagecolorallocate($img, 255, 255, 255);
        $darkColor = imagecolorallocate($img, 0, 0, 0);

        // Fill background
        imagefill($img, 0, 0, $bgColor);

        // Add gradient effect
        for ($i = 0; $i < 600; $i++) {
            $alpha = min(127, (int)($i * 0.2));
            $shade = imagecolorallocatealpha($img, 0, 0, 0, $alpha);
            imageline($img, 0, $i, 800, $i, $shade);
        }

        // Category labels
        $labels = [
            'apartment-rent' => ['اجاره آپارتمان', 'APARTMENT FOR RENT'],
            'apartment-sale' => ['فروش آپارتمان', 'APARTMENT FOR SALE'],
            'villa-sale' => ['فروش ویلا', 'VILLA FOR SALE'],
            'villa-short-rent' => ['اجاره کوتاه مدت', 'SHORT TERM RENTAL'],
            'commercial-rent' => ['اجاره تجاری', 'COMMERCIAL FOR RENT'],
            'commercial-sale' => ['فروش تجاری', 'COMMERCIAL FOR SALE'],
            'land' => ['زمین', 'LAND'],
            'pre-sale' => ['پیش فروش', 'PRE-SALE'],
            'other' => ['سایر', 'OTHER'],
        ];

        $label = $labels[$category] ?? ['ملک', 'PROPERTY'];

        // Draw decorative elements
        imagesetthickness($img, 3);
        $lineColor = imagecolorallocate($img, 255, 255, 255);
        // Horizontal lines
        imageline($img, 50, 150, 750, 150, $lineColor);
        imageline($img, 50, 450, 750, 450, $lineColor);
        // Vertical lines
        imageline($img, 50, 150, 50, 450, $lineColor);
        imageline($img, 750, 150, 750, 450, $lineColor);

        // Corner decorations
        imageline($img, 30, 130, 70, 130, $lineColor);
        imageline($img, 30, 130, 30, 170, $lineColor);
        imageline($img, 730, 130, 770, 130, $lineColor);
        imageline($img, 770, 130, 770, 170, $lineColor);
        imageline($img, 30, 470, 70, 470, $lineColor);
        imageline($img, 30, 430, 30, 470, $lineColor);
        imageline($img, 730, 470, 770, 470, $lineColor);
        imageline($img, 770, 430, 770, 470, $lineColor);

        // Add text
        $fontLarge = 5;
        $fontMedium = 4;

        // Persian text
        $persianLabel = $label[0];
        $textWidth = imagefontwidth($fontLarge) * mb_strlen($persianLabel);
        $x = (800 - $textWidth) / 2;
        imagestring($img, $fontLarge, $x, 250, $persianLabel, $whiteColor);

        // English text
        $englishLabel = $label[1];
        $textWidth = imagefontwidth($fontMedium) * strlen($englishLabel);
        $x = (800 - $textWidth) / 2;
        imagestring($img, $fontMedium, $x, 290, $englishLabel, $whiteColor);

        // Property number
        $numText = "Property #$propertyId";
        $textWidth = imagefontwidth($fontMedium) * strlen($numText);
        $x = (800 - $textWidth) / 2;
        imagestring($img, $fontMedium, $x, 350, $numText, $whiteColor);

        // Bottom label
        $bottomText = "Alijenaab Real Estate";
        $textWidth = imagefontwidth(3) * strlen($bottomText);
        $x = (800 - $textWidth) / 2;
        imagestring($img, 3, $x, 480, $bottomText, $whiteColor);

        imagejpeg($img, $filepath, 90);
        imagedestroy($img);

        return $filename;
    }

    private function getCategoryProperties(string $category): array
    {
        $data = [
            'apartment-rent' => [
                [
                    'title' => 'آپارتمان ۲ خوابه مبله در شریعتی بابل',
                    'description' => 'آپارتمان مبله و شیک در بهترین موقعیت شهر بابل. دارای پارکینگ، انباری، آسانسور و بالکن. نورگیر عالی و دید باز.',
                    'name' => 'صابر', 'last_name' => 'احمدپور', 'company' => 'املاک رزم',
                    'province' => 'مازندران', 'city' => 'بابل', 'neighborhood' => 'شریعتی',
                    'address' => 'خیابان شریعتی، نبش کوچه گلستان',
                    'area' => '85', 'rooms' => '2', 'property_type' => 'آپارتمان',
                    'is_featured' => true, 'property_view' => 'خیابان', 'building_area' => '85',
                    'details' => [
                        'mortgage' => '800000000', 'rent' => '8000000',
                        'floor' => '3', 'unit_per_floor' => '2', 'floors_count' => '5',
                        'build_year' => '1400', 'building_direction' => 'جنوب',
                        'floor_type' => 'پارکت', 'document_type' => 'تک‌برگ',
                        'parking' => 'دارد', 'storage' => 'دارد', 'elevator' => 'دارد',
                        'balcony' => 'دارد', 'furnished' => 'مبله',
                        'cooling_system' => 'کولر گازی', 'heating_system' => 'رادیاتور',
                        'kitchen_type' => 'بسته', 'cabinet_material' => 'MDF', 'toilet' => '1',
                    ],
                ],
                [
                    'title' => 'آپارتمان ۳ خوابه لوکس در پارک نوشیروانی',
                    'description' => 'آپارتمان لوکس و نوساز با امکانات کامل. دارای استخر، سونا و تراس بزرگ. ویوی جنگل و دریا.',
                    'name' => 'علی', 'last_name' => 'محمدی', 'company' => 'مشاورین شمال',
                    'province' => 'مازندران', 'city' => 'بابل', 'neighborhood' => 'پارک نوشیروانی',
                    'address' => 'بلوار نوشیروانی',
                    'area' => '120', 'rooms' => '3', 'property_type' => 'آپارتمان',
                    'is_featured' => true, 'property_view' => 'جنگل', 'building_area' => '120',
                    'details' => [
                        'mortgage' => '1500000000', 'rent' => '15000000',
                        'floor' => '4', 'unit_per_floor' => '4', 'floors_count' => '8',
                        'build_year' => '1402', 'building_direction' => 'شمال',
                        'floor_type' => 'سرامیک', 'document_type' => 'تک‌برگ',
                        'parking' => '۲ عدد', 'storage' => 'دارد', 'elevator' => 'دارد',
                        'balcony' => '۲ عدد', 'furnished' => 'مبله',
                        'cooling_system' => 'اسپلیت', 'heating_system' => 'پکیج',
                        'kitchen_type' => 'بسته', 'cabinet_material' => 'های‌گلاس',
                        'toilet' => '2', 'pool' => '1', 'sauna' => '1',
                    ],
                ],
                [
                    'title' => 'آپارتمان ۱ خوابه دانشجویی در مدرس',
                    'description' => 'آپارتمان تمیز و مرتب مناسب دانشجویان. دسترسی آسان به مراکز خرید.',
                    'name' => 'سارا', 'last_name' => 'رضایی', 'company' => 'املاک مدرس',
                    'province' => 'مازندران', 'city' => 'بابل', 'neighborhood' => 'مدرس',
                    'address' => 'خیابان مدرس، کوچه بهار',
                    'area' => '55', 'rooms' => '1', 'property_type' => 'آپارتمان',
                    'is_featured' => false, 'property_view' => 'خیابان', 'building_area' => '55',
                    'details' => [
                        'mortgage' => '400000000', 'rent' => '5000000',
                        'floor' => '2', 'unit_per_floor' => '3', 'floors_count' => '4',
                        'build_year' => '1395', 'building_direction' => 'غرب',
                        'floor_type' => 'سرامیک', 'document_type' => 'تک‌برگ',
                        'parking' => 'ندارد', 'storage' => 'دارد', 'elevator' => 'ندارد',
                        'balcony' => 'ندارد', 'furnished' => 'نیمه‌مبله',
                        'cooling_system' => 'کولر آبی', 'heating_system' => 'بخاری',
                        'kitchen_type' => 'باز', 'cabinet_material' => 'MDF', 'toilet' => '1',
                    ],
                ],
            ],

            'apartment-sale' => [
                [
                    'title' => 'آپارتمان ۳ خوابه نوساز در کمربندی شرقی',
                    'description' => 'آپارتمان نوساز و مجلل با متریال درجه یک. دارای پارکینگ اختصاصی و نورگیر ۴ طرفه.',
                    'name' => 'رضا', 'last_name' => 'کریمی', 'company' => 'املاک کریمی',
                    'province' => 'مازندران', 'city' => 'بابل', 'neighborhood' => 'کمربندی شرقی',
                    'address' => 'بلوار کمربندی شرقی',
                    'area' => '150', 'rooms' => '3', 'property_type' => 'آپارتمان',
                    'is_featured' => true, 'property_view' => 'باز', 'building_area' => '150',
                    'details' => [
                        'price' => '8500000000',
                        'floor' => '5', 'unit_per_floor' => '2', 'floors_count' => '6',
                        'build_year' => '1403', 'building_direction' => 'شمال',
                        'floor_type' => 'پارکت', 'document_type' => 'تک‌برگ',
                        'parking' => '۲ عدد', 'storage' => 'دارد', 'elevator' => 'دارد',
                        'balcony' => '۲ عدد', 'furnished' => 'خالی',
                        'cooling_system' => 'اسپلیت', 'heating_system' => 'پکیج',
                        'kitchen_type' => 'بسته', 'cabinet_material' => 'های‌گلاس',
                        'toilet' => '2', 'has_loan' => '0', 'building_facade' => 'سنگ',
                    ],
                ],
                [
                    'title' => 'آپارتمان ۲ خوابه خوش‌نقشه در هلال احمر',
                    'description' => 'آپارتمان با نقشه عالی و متراژ مناسب. نزدیک به مدرسه و درمانگاه.',
                    'name' => 'مریم', 'last_name' => 'حسینی', 'company' => 'مشاورین هلال',
                    'province' => 'مازندران', 'city' => 'بابل', 'neighborhood' => 'هلال احمر',
                    'address' => 'خیابان هلال احمر',
                    'area' => '95', 'rooms' => '2', 'property_type' => 'آپارتمان',
                    'is_featured' => false, 'property_view' => 'خیابان', 'building_area' => '95',
                    'details' => [
                        'price' => '5200000000',
                        'floor' => '2', 'unit_per_floor' => '3', 'floors_count' => '4',
                        'build_year' => '1398', 'building_direction' => 'جنوب',
                        'floor_type' => 'سرامیک', 'document_type' => 'تک‌برگ',
                        'parking' => 'دارد', 'storage' => 'دارد', 'elevator' => 'ندارد',
                        'balcony' => 'دارد', 'furnished' => 'خالی',
                        'cooling_system' => 'کولر گازی', 'heating_system' => 'رادیاتور',
                        'kitchen_type' => 'بسته', 'cabinet_material' => 'MDF', 'toilet' => '1',
                    ],
                ],
                [
                    'title' => 'آپارتمان ۴ خوابه ویلایی در کمربندی غربی',
                    'description' => 'آپارتمان ویلایی با متراژ بالا. دارای حیاط اختصاصی و باغچه.',
                    'name' => 'حسن', 'last_name' => 'عباسی', 'company' => 'املاک عباسی',
                    'province' => 'مازندران', 'city' => 'بابل', 'neighborhood' => 'کمربندی غربی',
                    'address' => 'کمربندی غربی، خیابان گلها',
                    'area' => '200', 'rooms' => '4', 'property_type' => 'آپارتمان',
                    'is_featured' => true, 'property_view' => 'باغ', 'building_area' => '200',
                    'details' => [
                        'price' => '12000000000',
                        'floor' => '1', 'unit_per_floor' => '1', 'floors_count' => '2',
                        'build_year' => '1401', 'building_direction' => 'شمال',
                        'floor_type' => 'چوب', 'document_type' => 'تک‌برگ',
                        'parking' => '۲ عدد', 'storage' => 'دارد',
                        'balcony' => '۳ عدد', 'furnished' => 'مبله',
                        'cooling_system' => 'اسپلیت', 'heating_system' => 'پکیج',
                        'kitchen_type' => 'بسته', 'cabinet_material' => 'های‌گلاس',
                        'toilet' => '3', 'has_loan' => '0',
                    ],
                ],
            ],

            'villa-sale' => [
                [
                    'title' => 'ویلای مدرن استخردار در چالوس',
                    'description' => 'ویلای مدرن و لوکس با استخر آب گرم اختصاصی. دارای باغ میوه و تراس بزرگ.',
                    'name' => 'مهدی', 'last_name' => 'احمدی', 'company' => 'ویلاهای شمال',
                    'province' => 'مازندران', 'city' => 'چالوس', 'neighborhood' => 'مرزن‌آباد',
                    'address' => 'جاده چالوس، کیلومتر ۱۵',
                    'area' => '350', 'rooms' => '4', 'property_type' => 'ویلا',
                    'is_featured' => true, 'property_view' => 'جنگل',
                    'land_area' => '500', 'building_area' => '350',
                    'details' => [
                        'price' => '45000000000',
                        'floor_count' => '2', 'building_type' => 'ویلایی مستقل',
                        'building_direction' => 'شمال', 'floor_type' => 'سرامیک',
                        'document_type' => 'تک‌برگ',
                        'parking' => '۲ عدد', 'storage' => 'دارد',
                        'balcony' => '۳ عدد', 'furnished' => 'مبله',
                        'cooling_system' => 'اسپلیت', 'heating_system' => 'پکیج',
                        'pool' => '1', 'pool_type' => 'آب گرم',
                        'sauna' => '1', 'jacuzzi' => '1', 'toilet' => '3',
                    ],
                ],
                [
                    'title' => 'ویلای جنگلی سنتی در بابلسر',
                    'description' => 'ویلای سنتی و دنج در دل جنگل. مناسب کسانی که به دنبال آرامش هستند.',
                    'name' => 'فاطمه', 'last_name' => 'نوری', 'company' => 'املاک جنگل',
                    'province' => 'مازندران', 'city' => 'بابلسر', 'neighborhood' => 'بهنمیر',
                    'address' => 'جاده بابلسر، روستای گز',
                    'area' => '200', 'rooms' => '3', 'property_type' => 'ویلا',
                    'is_featured' => false, 'property_view' => 'جنگل',
                    'land_area' => '800', 'building_area' => '200',
                    'details' => [
                        'price' => '28000000000',
                        'floor_count' => '1', 'building_type' => 'ویلایی مستقل',
                        'building_direction' => 'شمال', 'floor_type' => 'سرامیک',
                        'document_type' => 'تک‌برگ',
                        'parking' => 'دارد', 'balcony' => '۲ عدد',
                        'furnished' => 'نیمه‌مبله',
                        'cooling_system' => 'کولر گازی', 'heating_system' => 'بخاری',
                        'pool' => '0', 'toilet' => '2',
                    ],
                ],
                [
                    'title' => 'ویلای مدرن دوبلکس در آمل',
                    'description' => 'ویلای دوبلکس مدرن با طراحی داخلی خاص. دارای روف گاردن و استخر روباز.',
                    'name' => 'امیر', 'last_name' => 'جعفری', 'company' => 'ویلاهای مدرن',
                    'province' => 'مازندران', 'city' => 'آمل', 'neighborhood' => 'گاودشت',
                    'address' => 'جاده آمل، منطقه گاودشت',
                    'area' => '280', 'rooms' => '3', 'property_type' => 'ویلا',
                    'is_featured' => true, 'property_view' => 'کوهستان',
                    'land_area' => '400', 'building_area' => '280',
                    'details' => [
                        'price' => '38000000000',
                        'floor_count' => '2', 'building_type' => 'دوبلکس',
                        'building_direction' => 'شمال', 'floor_type' => 'چوب',
                        'document_type' => 'تک‌برگ',
                        'parking' => '۲ عدد', 'storage' => 'دارد',
                        'balcony' => '۲ عدد', 'furnished' => 'مبله',
                        'cooling_system' => 'اسپلیت', 'heating_system' => 'پکیج',
                        'pool' => '1', 'pool_type' => 'روباز',
                        'sauna' => '1', 'toilet' => '3',
                    ],
                ],
            ],

            'villa-short-rent' => [
                [
                    'title' => 'ویلای استخردار اجاره‌ای در چالوس',
                    'description' => 'ویلای شیک و مبله با استخر آب گرم. مناسب اقامت کوتاه‌مدت خانوادگی.',
                    'name' => 'زهرا', 'last_name' => 'کاظمی', 'company' => 'اجاره ویلای شمال',
                    'province' => 'مازندران', 'city' => 'چالوس', 'neighborhood' => 'هیچ‌رود',
                    'address' => 'جاده چالوس، منطقه توریستی',
                    'area' => '180', 'rooms' => '3', 'property_type' => 'ویلا',
                    'is_featured' => true, 'property_view' => 'جنگل', 'building_area' => '180',
                    'details' => [
                        'daily_rent' => '3500000', 'regular_days' => '3000000',
                        'weekend' => '4000000', 'special_days' => '5000000',
                        'capacity' => '8', 'standard_capacity' => '6', 'extra_capacity' => '2',
                        'rental_period' => 'شبانه', 'check_in_time' => '14:00',
                        'check_out_time' => '12:00', 'minimum_stay' => '۲ شب',
                        'floor_count' => '2', 'building_type' => 'ویلایی مستقل',
                        'building_direction' => 'شمال', 'floor_type' => 'سرامیک',
                        'parking' => 'دارد', 'balcony' => 'دارد', 'furnished' => 'مبله',
                        'pool' => '1', 'pool_type' => 'آب گرم',
                        'cooling_system' => 'اسپلیت', 'toilet' => '2',
                    ],
                ],
                [
                    'title' => 'سوئیت مبله اقتصادی در بابلسر',
                    'description' => 'سوئیت تمیز و مرتب. مناسب زوج‌ها. نزدیک به ساحل.',
                    'name' => 'نیما', 'last_name' => 'شریفی', 'company' => 'اقامتگاه ساحل',
                    'province' => 'مازندران', 'city' => 'بابلسر', 'neighborhood' => 'ساحلی',
                    'address' => 'خیابان ساحلی',
                    'area' => '60', 'rooms' => '1', 'property_type' => 'سوئیت',
                    'is_featured' => false, 'property_view' => 'دریا', 'building_area' => '60',
                    'details' => [
                        'daily_rent' => '1500000', 'regular_days' => '1200000',
                        'weekend' => '1800000', 'special_days' => '2500000',
                        'capacity' => '4', 'standard_capacity' => '2', 'extra_capacity' => '2',
                        'rental_period' => 'شبانه', 'check_in_time' => '15:00',
                        'check_out_time' => '11:00', 'minimum_stay' => '۱ شب',
                        'floor_count' => '1', 'building_type' => 'آپارتمانی',
                        'building_direction' => 'شمال', 'floor_type' => 'سرامیک',
                        'parking' => 'ندارد', 'balcony' => 'دارد', 'furnished' => 'مبله',
                        'pool' => '0', 'cooling_system' => 'اسپلیت', 'toilet' => '1',
                    ],
                ],
                [
                    'title' => 'ویلای لاکچری با استخر و سونا در ساری',
                    'description' => 'ویلای لاکچری با امکانات هتل ۵ ستاره. دارای استخر سرپوشیده و سینمای خانگی.',
                    'name' => 'امید', 'last_name' => 'رستمی', 'company' => 'ویلاهای لاکچری',
                    'province' => 'مازندران', 'city' => 'ساری', 'neighborhood' => 'دودانگه',
                    'address' => 'جاده ساری، منطقه ییلاقی',
                    'area' => '400', 'rooms' => '5', 'property_type' => 'ویلا',
                    'is_featured' => true, 'property_view' => 'جنگل', 'building_area' => '400',
                    'details' => [
                        'daily_rent' => '8000000', 'regular_days' => '6000000',
                        'weekend' => '10000000', 'special_days' => '15000000',
                        'extra_person_cost' => '500000',
                        'capacity' => '12', 'standard_capacity' => '10', 'extra_capacity' => '2',
                        'rental_period' => 'شبانه', 'check_in_time' => '14:00',
                        'check_out_time' => '12:00', 'minimum_stay' => '۲ شب',
                        'floor_count' => '2', 'building_type' => 'ویلایی مستقل',
                        'building_direction' => 'شمال', 'floor_type' => 'چوب',
                        'parking' => '۳ عدد', 'balcony' => '۴ عدد', 'furnished' => 'مبله',
                        'pool' => '1', 'pool_type' => 'سرپوشیده',
                        'sauna' => '1', 'jacuzzi' => '1',
                        'cooling_system' => 'اسپلیت', 'toilet' => '4',
                    ],
                ],
            ],

            'commercial-rent' => [
                [
                    'title' => 'مغازه ۵۰ متری در خیابان اصلی بابل',
                    'description' => 'مغازه با موقعیت عالی در خیابان پرتردد. مناسب فروشگاه یا طلافروشی.',
                    'name' => 'کامران', 'last_name' => 'مهدوی', 'company' => 'املاک تجاری',
                    'province' => 'مازندران', 'city' => 'بابل', 'neighborhood' => 'شریعتی',
                    'address' => 'خیابان شریعتی، پلاک ۱۲۰',
                    'area' => '50', 'property_type' => 'مغازه',
                    'is_featured' => true, 'property_view' => 'خیابان', 'building_area' => '50',
                    'details' => [
                        'rent' => '25000000', 'mortgage' => '3000000000',
                        'floor' => '1', 'floor_type' => 'سرامیک',
                        'building_type' => 'تجاری', 'building_direction' => 'شمال',
                        'document_type' => 'تک‌برگ', 'current_status' => 'تخلیه',
                        'usage_type' => 'مغازه', 'toilet' => '1',
                        'cooling_system' => 'اسپلیت',
                    ],
                ],
                [
                    'title' => 'دفتر کار ۸۰ متری در بلوار آزادی',
                    'description' => 'دفتر کار حرفه‌ای. مناسب شرکت‌ها. دارای پارکینگ و نگهبانی.',
                    'name' => 'نسرین', 'last_name' => 'صالحی', 'company' => 'دفاتر کار',
                    'province' => 'مازندران', 'city' => 'بابل', 'neighborhood' => 'کمربندی شرقی',
                    'address' => 'بلوار آزادی، طبقه ۳',
                    'area' => '80', 'property_type' => 'دفتر کار',
                    'is_featured' => false, 'property_view' => 'باز', 'building_area' => '80',
                    'details' => [
                        'rent' => '35000000', 'mortgage' => '5000000000',
                        'floor' => '3', 'floor_type' => 'سنگ',
                        'building_type' => 'اداری', 'building_direction' => 'جنوب',
                        'document_type' => 'تک‌برگ', 'current_status' => 'تخلیه',
                        'usage_type' => 'اداری', 'parking' => '۲ عدد',
                        'elevator' => 'دارد', 'toilet' => '2',
                    ],
                ],
                [
                    'title' => 'باغ رستوران با پارکینگ در جاده مازندران',
                    'description' => 'باغ رستوران با فضای سبز بزرگ. ظرفیت ۲۰۰ نفر.',
                    'name' => 'بهروز', 'last_name' => 'امیری', 'company' => 'املاک تجاری شمال',
                    'province' => 'مازندران', 'city' => 'ساری', 'neighborhood' => 'جاده مازندران',
                    'address' => 'جاده مازندران، کیلومتر ۱۰',
                    'area' => '500', 'property_type' => 'باغ',
                    'is_featured' => true, 'property_view' => 'باغ',
                    'land_area' => '1000', 'building_area' => '500',
                    'details' => [
                        'rent' => '80000000', 'mortgage' => '10000000000',
                        'building_type' => 'تجاری',
                        'document_type' => 'تک‌برگ', 'current_status' => 'تخلیه',
                        'usage_type' => 'رستوران', 'parking' => '۲۰ عدد',
                        'toilet' => '4', 'pool' => '1', 'pool_type' => 'تزئینی',
                    ],
                ],
            ],

            'commercial-sale' => [
                [
                    'title' => 'مغازه ۱۰۰ متری در مرکز شهر آمل',
                    'description' => 'مغازه بزرگ و لوکس در بهترین موقعیت تجاری آمل.',
                    'name' => 'سعید', 'last_name' => 'پورمحمدی', 'company' => 'املاک تجاری آمل',
                    'province' => 'مازندران', 'city' => 'آمل', 'neighborhood' => 'مرکز شهر',
                    'address' => 'خیابان خیام، پلاک ۴۵',
                    'area' => '100', 'property_type' => 'مغازه',
                    'is_featured' => true, 'property_view' => 'خیابان', 'building_area' => '100',
                    'details' => [
                        'price' => '25000000000',
                        'floor' => '1', 'floor_type' => 'سنگ',
                        'building_type' => 'تجاری', 'building_direction' => 'شمال',
                        'document_type' => 'تک‌برگ', 'current_status' => 'تخلیه',
                        'usage_type' => 'مغازه', 'toilet' => '1',
                    ],
                ],
                [
                    'title' => 'واحد تجاری ۲۰۰ متری در پاساژ مدرن',
                    'description' => 'واحد تجاری بزرگ در پاساژ مدرن با تردد بالا.',
                    'name' => 'علیرضا', 'last_name' => 'فتحی', 'company' => 'پاساژ مدرن',
                    'province' => 'مازندران', 'city' => 'ساری', 'neighborhood' => 'مرکز شهر',
                    'address' => 'پاساژ مدرن، طبقه همکف',
                    'area' => '200', 'property_type' => 'واحد تجاری',
                    'is_featured' => true, 'property_view' => 'پاساژ', 'building_area' => '200',
                    'details' => [
                        'price' => '40000000000',
                        'floor' => '1', 'floor_type' => 'سرامیک',
                        'building_type' => 'تجاری', 'building_direction' => 'شمال',
                        'document_type' => 'تک‌برگ', 'current_status' => 'تخلیه',
                        'usage_type' => 'فروشگاه', 'parking' => '۵ عدد',
                        'elevator' => 'باربر', 'toilet' => '2',
                    ],
                ],
                [
                    'title' => 'کارگاه صنعتی ۳۰۰ متری در شهرک صنعتی',
                    'description' => 'کارگاه صنعتی با تجهیزات کامل در شهرک صنعتی بابل.',
                    'name' => 'جمشید', 'last_name' => 'نعمتی', 'company' => 'املاک صنعتی',
                    'province' => 'مازندران', 'city' => 'بابل', 'neighborhood' => 'شهرک صنعتی',
                    'address' => 'شهرک صنعتی بابل، خیابان صنعت',
                    'area' => '300', 'property_type' => 'کارگاه',
                    'is_featured' => false, 'property_view' => 'صنعتی', 'building_area' => '300',
                    'details' => [
                        'price' => '15000000000',
                        'floor_type' => 'سیمانی',
                        'building_type' => 'صنعتی',
                        'document_type' => 'تک‌برگ', 'current_status' => 'تخلیه',
                        'usage_type' => 'کارگاه', 'parking' => '۱۰ عدد', 'toilet' => '3',
                    ],
                ],
            ],

            'land' => [
                [
                    'title' => 'زمین ۵۰۰ متری مسکونی در بابل',
                    'description' => 'زمین مسکونی با موقعیت عالی. دارای پروانه ساخت و تمامی انشعابات.',
                    'name' => 'رضا', 'last_name' => 'محمدی', 'company' => 'املاک زمین',
                    'province' => 'مازندران', 'city' => 'بابل', 'neighborhood' => 'کمربندی شرقی',
                    'address' => 'جاده فرعی کمربندی شرقی',
                    'area' => '500', 'property_type' => 'زمین',
                    'is_featured' => true, 'property_view' => 'باز', 'land_area' => '500',
                    'details' => [
                        'price' => '12000000000', 'usage_type' => 'مسکونی',
                        'document_status' => 'سند تک‌برگ', 'property_location' => 'سه نبش',
                        'building_permit' => 'پروانه ساخت', 'has_old_building' => 'خیر',
                        'exchangeable' => 'بله',
                        'utilities' => json_encode(['آب', 'برق', 'گاز', 'فاضلاب']),
                    ],
                ],
                [
                    'title' => 'زمین کشاورزی ۲۰۰۰ متری در آمل',
                    'description' => 'زمین کشاورزی حاصلخیز با آب کافی. مناسب کشت برنج.',
                    'name' => 'احد', 'last_name' => 'رستمی', 'company' => 'املاک کشاورزی',
                    'province' => 'مازندران', 'city' => 'آمل', 'neighborhood' => 'دابودشت',
                    'address' => 'جاده دابودشت',
                    'area' => '2000', 'property_type' => 'زمین کشاورزی',
                    'is_featured' => false, 'property_view' => 'مزارع', 'land_area' => '2000',
                    'details' => [
                        'price' => '8000000000', 'usage_type' => 'کشاورزی',
                        'document_status' => 'سند ششدانگ', 'property_location' => 'چهارگوش',
                        'has_old_building' => 'خیر', 'exchangeable' => 'خیر',
                        'utilities' => json_encode(['آب', 'برق']),
                    ],
                ],
                [
                    'title' => 'زمین ویلایی ۱۰۰۰ متری در چالوس',
                    'description' => 'زمین ویلایی با ویوی دریا و جنگل. دارای جواز ساخت.',
                    'name' => 'محمدرضا', 'last_name' => 'حیدری', 'company' => 'زمین‌های لوکس',
                    'province' => 'مازندران', 'city' => 'چالوس', 'neighborhood' => 'مرزن‌آباد',
                    'address' => 'جاده مرزن‌آباد',
                    'area' => '1000', 'property_type' => 'زمین ویلایی',
                    'is_featured' => true, 'property_view' => 'دریا', 'land_area' => '1000',
                    'details' => [
                        'price' => '25000000000', 'usage_type' => 'ویلایی',
                        'document_status' => 'سند تک‌برگ', 'property_location' => 'دو نبش',
                        'building_permit' => 'جواز ساخت', 'has_old_building' => 'خیر',
                        'exchangeable' => 'بله',
                        'utilities' => json_encode(['آب', 'برق', 'گاز']),
                    ],
                ],
            ],

            'pre-sale' => [
                [
                    'title' => 'پیش‌فروش آپارتمان ۳ خوابه در بابل',
                    'description' => 'پیش‌فروش آپارتمان لوکس با ۴۰٪ پیشرفت فیزیکی. تحویل ۱۸ ماهه.',
                    'name' => 'محمود', 'last_name' => 'قاسمی', 'company' => 'سازندگان معتبر',
                    'province' => 'مازندران', 'city' => 'بابل', 'neighborhood' => 'شریعتی',
                    'address' => 'خیابان شریعتی، پروژه آسمان',
                    'area' => '130', 'rooms' => '3', 'property_type' => 'آپارتمان',
                    'is_featured' => true, 'property_view' => 'خیابان', 'building_area' => '130',
                    'details' => [
                        'price' => '7000000000', 'propertyCondition' => 'نوساز',
                        'projectType' => 'مسکونی', 'roomCount' => '۳ خوابه',
                        'participationPercent' => '۴۰٪',
                        'initialPayment' => '۲.۸',
                        'deliveryPayment' => '۴.۲',
                        'projectStatus' => 'در حال ساخت',
                        'deliveryYear' => '۱۴۰۶', 'deliveryMonth' => '۶',
                        'physicalProgress' => '۴۰', 'unitsPerFloor' => '۴',
                        'minUnitArea' => '۱۱۰', 'builderName' => 'گروه ساختمانی آسمان',
                        'constructionPermit' => 'پروانه شماره ۱۲۳۴',
                        'exchange' => 'بله', 'building_direction' => 'شمال',
                    ],
                ],
                [
                    'title' => 'پیش‌فروش ویلای مدرن در ساری',
                    'description' => 'پیش‌فروش ویلای مدرن با استخر. ۶۰٪ پیشرفت فیزیکی.',
                    'name' => 'علی', 'last_name' => 'نوری', 'company' => 'ویلاهای مدرن',
                    'province' => 'مازندران', 'city' => 'ساری', 'neighborhood' => 'دودانگه',
                    'address' => 'جاده دودانگه',
                    'area' => '250', 'rooms' => '4', 'property_type' => 'ویلا',
                    'is_featured' => true, 'property_view' => 'جنگل', 'building_area' => '250',
                    'details' => [
                        'price' => '35000000000', 'propertyCondition' => 'نوساز',
                        'projectType' => 'ویلایی', 'roomCount' => '۴ خوابه',
                        'participationPercent' => '۶۰٪',
                        'initialPayment' => '۲۱',
                        'deliveryPayment' => '۱۴',
                        'projectStatus' => 'در حال ساخت',
                        'deliveryYear' => '۱۴۰۶', 'deliveryMonth' => '۳',
                        'physicalProgress' => '۶۰', 'unitsPerFloor' => '۱',
                        'minUnitArea' => '۲۵۰', 'builderName' => 'گروه ساختمانی ویلا',
                        'constructionPermit' => 'پروانه شماره ۵۶۷۸',
                        'exchange' => 'بله',
                    ],
                ],
                [
                    'title' => 'پیش‌فروش واحد اداری در مرکز شهر',
                    'description' => 'پیش‌فروش واحد اداری لوکس. ۳۰٪ پیشرفت فیزیکی.',
                    'name' => 'مریم', 'last_name' => 'احمدی', 'company' => 'برج‌های اداری',
                    'province' => 'مازندران', 'city' => 'ساری', 'neighborhood' => 'مرکز شهر',
                    'address' => 'میدان مرکزی، برج اداری',
                    'area' => '100', 'property_type' => 'دفتر کار',
                    'is_featured' => false, 'property_view' => 'شهر', 'building_area' => '100',
                    'details' => [
                        'price' => '15000000000', 'propertyCondition' => 'نوساز',
                        'projectType' => 'اداری', 'roomCount' => '۱',
                        'participationPercent' => '۳۰٪',
                        'initialPayment' => '۴.۵',
                        'deliveryPayment' => '۱۰.۵',
                        'projectStatus' => 'در حال ساخت',
                        'deliveryYear' => '۱۴۰۷', 'deliveryMonth' => '۶',
                        'physicalProgress' => '۳۰', 'unitsPerFloor' => '۶',
                        'minUnitArea' => '۸۰', 'builderName' => 'شرکت ساختمانی البرز',
                        'constructionPermit' => 'پروانه شماره ۹۰۱۲',
                        'exchange' => 'خیر',
                    ],
                ],
            ],

            'other' => [
                [
                    'title' => 'انبار ۲۰۰ متری در شهرک صنعتی',
                    'description' => 'انبار بزرگ و مسقف. مناسب نگهداری کالا.',
                    'name' => 'جواد', 'last_name' => 'موسوی', 'company' => 'انبارهای صنعتی',
                    'province' => 'مازندران', 'city' => 'بابل', 'neighborhood' => 'شهرک صنعتی',
                    'address' => 'شهرک صنعتی بابل، خیابان ۵',
                    'area' => '200', 'property_type' => 'انبار',
                    'is_featured' => false, 'property_view' => 'صنعتی', 'building_area' => '200',
                    'details' => [
                        'price' => '5000000000', 'usage_type' => 'انبار',
                        'document_status' => 'سند شورایی', 'parking' => '۵ عدد',
                    ],
                ],
                [
                    'title' => 'پارکینگ طبقاتی ۵۰ واحدی',
                    'description' => 'پارکینگ طبقاتی با ظرفیت ۵۰ خودرو. مناسب سرمایه‌گذاری.',
                    'name' => 'احسان', 'last_name' => 'رحیمی', 'company' => 'پارکینگ‌های عمومی',
                    'province' => 'مازندران', 'city' => 'ساری', 'neighborhood' => 'مرکز شهر',
                    'address' => 'خیابان امام خمینی',
                    'area' => '500', 'property_type' => 'پارکینگ',
                    'is_featured' => false, 'property_view' => 'شهر', 'building_area' => '500',
                    'details' => [
                        'price' => '20000000000', 'usage_type' => 'پارکینگ',
                        'document_status' => 'سند تک‌برگ', 'floor_count' => '۵',
                    ],
                ],
                [
                    'title' => 'هتل آپارتمان ۱۰ واحدی در بابلسر',
                    'description' => 'هتل آپارتمان با ۱۰ واحد مبله. مناسب سرمایه‌گذاری.',
                    'name' => 'فرهاد', 'last_name' => 'جوانمرد', 'company' => 'هتل‌های شمال',
                    'province' => 'مازندران', 'city' => 'بابلسر', 'neighborhood' => 'ساحلی',
                    'address' => 'خیابان ساحلی',
                    'area' => '800', 'property_type' => 'هتل آپارتمان',
                    'is_featured' => true, 'property_view' => 'دریا', 'building_area' => '800',
                    'details' => [
                        'price' => '80000000000', 'usage_type' => 'هتل آپارتمان',
                        'document_status' => 'سند تک‌برگ', 'floor_count' => '۴',
                        'parking' => '۱۰ عدد', 'pool' => '1', 'pool_type' => 'روباز',
                        'sauna' => '1',
                    ],
                ],
            ],
        ];

        return $data[$category] ?? [];
    }
}
