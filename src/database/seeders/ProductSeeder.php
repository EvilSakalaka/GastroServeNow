<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::create([
            'name' => 'Pizza Margherita',
            'category' => 'Étel',
            'price' => 1200.00,
            'status' => 'available',
            'photo_url' => 'https://cookingitalians.com/wp-content/uploads/2024/11/Margherita-Pizza.jpg',
            'is_featured' => true,
            'area_id' => 1, // kitchen
        ]);

        \App\Models\Product::create([
            'name' => 'Coca-Cola',
            'category' => 'ital',
            'price' => 400.00,
            'status' => 'available',
            'photo_url' => 'https://pngimg.com/uploads/cocacola/cocacola_PNG5.png',
            'is_featured' => false,
            'area_id' => 2, // bar
        ]);

        \App\Models\Product::create([
            'name' => 'Caesar Saláta',
            'category' => 'Étel',
            'price' => 900.00,
            'status' => 'unavailable',
            'photo_url' => 'https://example.com/photos/caesar_salad.jpg',
            'is_featured' => false,
            'area_id' => 1, // kitchen
        ]);

        \App\Models\Product::create([
            'name' => 'Falusi Húsleves',
            'category' => 'Étel',
            'price' => 2250.00,
            'status' => 'available',
            'photo_url' => 'https://www.noinetcafe.hu/images/AAAreceptek/husleves80001.jpg',
            'is_featured' => true,
            'area_id' => 1, // kitchen
        ]);

        \App\Models\Product::create([
            'name' => 'Fokhagyma krémleves házi cipóban',
            'category' => 'Étel',
            'price' => 2250.00,
            'status' => 'available',
            'photo_url' => 'https://hir.mediamarkt.hu/magazin/wp-content/uploads/2023/12/Sult-fokhagymakremleves-cipoban-talalva.jpg',
            'is_featured' => true,
            'area_id' => 1, // kitchen
        ]);

        \App\Models\Product::create([
            'name' => 'Zúza pörkölt nokedlivel',
            'category' => 'Étel',
            'price' => 3100.00,
            'status' => 'available',
            'photo_url' => 'https://receptneked.hu/wp-content/uploads/2016/11/zu00fazapu00f6rku00f6lt-nokedli.jpg',
            'is_featured' => true,
            'area_id' => 1, // kitchen
        ]);

        \App\Models\Product::create([
            'name' => 'Csoki szufflé erdei gyümölcs öntlettel',
            'category' => 'Étel',
            'price' => 1580.00,
            'status' => 'available',
            'photo_url' => 'https://tuttibisztro.hu/wp-content/uploads/2025/08/csokolade-szufle.jpg',
            'is_featured' => false,
            'area_id' => 1, // kitchen
        ]);

        \App\Models\Product::create([
            'name' => 'Kókuszos-barackos Panna cotta',
            'category' => 'Étel',
            'price' => 1380.00,
            'status' => 'available',
            'photo_url' => 'https://img-global.cpcdn.com/recipes/3001df9f80cf53c8/680x781cq80/kokusztejes-panna-cotta-nektarinnal-recept-foto.jpg',
            'is_featured' => false,
            'area_id' => 1, // kitchen
        ]);

        \App\Models\Product::create([
            'name' => 'Gombás-tejszínes csirkemell tagliatelle',
            'category' => 'Étel',
            'price' => 3480.00,
            'status' => 'available',
            'photo_url' => 'https://blog.matusz-vad.hu/wp-content/uploads/2022/02/image0-2-scaled.jpeg',
            'is_featured' => false,
            'area_id' => 1, // kitchen
        ]);

        \App\Models\Product::create([
            'name' => 'Lazac steak',
            'category' => 'Étel',
            'price' => 4990.00,
            'status' => 'available',
            'photo_url' => 'https://image-api.nosalty.hu/nosalty/images/recipes/Qx/fq/lazac-steak-spenotos-tejszines-tesztaval.jpeg?w=1200&h=920&s=96b8d1c2bbd16d9c29f1535eedf706c4',
            'is_featured' => false,
            'area_id' => 1, // kitchen
        ]);

        \App\Models\Product::create([
            'name' => 'Szüzérme bacon kötösben',
            'category' => 'Étel',
            'price' => 4980.00,
            'status' => 'available',
            'photo_url' => 'https://kep.cdn.indexvas.hu/1/0/4775/47758/477585/47758582_e517a0534256aa73417a842fc6e2d35d_wm.jpg',
            'is_featured' => false,
            'area_id' => 1, // kitchen
        ]);

        \App\Models\Product::create([
            'name' => 'Citromos-tárkonyos borjúraguleves',
            'category' => 'Étel',
            'price' => 1690.00,
            'status' => 'available',
            'photo_url' => 'https://cdn.mindmegette.hu/2024/04/Zqaahkxv1aiYhc2vKfkeXpAumxdbULKHQw5Jkm_Go24/fill/0/0/no/1/aHR0cHM6Ly9jbXNjZG4uYXBwLmNvbnRlbnQucHJpdmF0ZS9jb250ZW50L2NlMTYzOGYzMzY1NjRkMDNhNzIzNzBkMzI5M2VjNmQ3.webp',
            'is_featured' => false,
            'area_id' => 1, // kitchen
        ]);

        \App\Models\Product::create([
            'name' => 'Kávé (Eszpresszó)',
            'category' => 'ital',
            'price' => 500.00,
            'status' => 'available',
            'photo_url' => '',
            'is_featured' => false,
            'area_id' => 2, // bar
        ]);

        \App\Models\Product::create([
            'name' => 'Sör (0,5L)',
            'category' => 'ital',
            'price' => 800.00,
            'status' => 'available',
            'photo_url' => '',
            'is_featured' => false,
            'area_id' => 2, // bar
        ]);

        \App\Models\Product::create([
            'name' => 'Bor (Vörös)',
            'category' => 'ital',
            'price' => 1200.00,
            'status' => 'available',
            'photo_url' => '',
            'is_featured' => false,
            'area_id' => 2, // bar
        ]);


        
    }
}
