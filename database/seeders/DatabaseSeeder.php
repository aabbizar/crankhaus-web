<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Super Admin ──────────────────────────────────────────────────────
        User::firstOrCreate(
            ['email' => 'admin@pbsahaja.com'],
            [
                'name'     => 'CRANKHAUS Admin',
                'password' => Hash::make('password123'),
                'role'     => 'admin',
            ]
        );

        // ── 16 Menu Items Bertema Sepeda ──────────────────────────────────────
        $menus = [

            // ── NOODLES (6 items) ─────────────────────────────────────────────
            [
                'name'        => 'Mie Fixie Gear',
                'category'    => 'Makanan Utama',
                'price'       => 38000,
                'description' => 'Mie hitam tinta cumi dengan cabai rawit merah, bawang goreng renyah, dan sambal matah segar. Pedas menguras keringat kayak nge-fixie tanpa rem.',
                'image_url'   => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'name'        => 'Mie Overdrive',
                'category'    => 'Makanan Utama',
                'price'       => 42000,
                'description' => 'Mie kering pedas topping ayam asap slice tebal, irisan cabai serrano, dan saus kecap manis smoky. Rasa kayak masuk gear paling tinggi.',
                'image_url'   => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'name'        => 'Mie Carbon Frame',
                'category'    => 'Makanan Utama',
                'price'       => 45000,
                'description' => 'Mie kuah kaldu beef kaya collagen, irisan wagyu tipis, dan jamur shiitake. Gurih manis yang ringan tapi bertenaga penuh.',
                'image_url'   => 'https://images.unsplash.com/photo-1569058242253-92a9c755a0ec?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'name'        => 'Mie Sprocket',
                'category'    => 'Makanan Utama',
                'price'       => 35000,
                'description' => 'Mie kuning kenyal dalam kaldu ayam kampung bening yang bening seperti air danau. Topping suwiran ayam, daun bawang, dan telur rebus setengah matang.',
                'image_url'   => 'https://images.unsplash.com/photo-1525059696034-4967a8e1dca2?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'name'        => 'Mie Cadence',
                'category'    => 'Makanan Utama',
                'price'       => 39000,
                'description' => 'Soto ayam fusion dengan mie bihun transparan, irisan telur dadar, tauge segar, dan kuah kunyit segar yang harum. Ritme yang pas seperti cadence sempurna.',
                'image_url'   => 'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'name'        => 'Mie Peloton',
                'category'    => 'Makanan Utama',
                'price'       => 48000,
                'description' => 'Mie premium dalam bisque udang kaya rasa, topping seafood mix (udang, kerang, cumi), dan drizzle minyak truffle. Untuk yang riding di barisan terdepan.',
                'image_url'   => 'https://images.unsplash.com/photo-1559847844-5315695dadae?w=800&auto=format&fit=crop&q=80',
            ],

            // ── DIMSUM (5 items) ──────────────────────────────────────────────
            [
                'name'        => 'Udang Crankset',
                'category'    => 'Cemilan',
                'price'       => 32000,
                'description' => 'Bola udang krispi dibungkus keju mozarella meleleh, disajikan melingkar seperti crankset sepeda. Digoreng sempurna dengan saus mayo pedas.',
                'image_url'   => 'https://images.unsplash.com/photo-1563245372-f21724e3856d?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'name'        => 'Pangsit Peloton',
                'category'    => 'Cemilan',
                'price'       => 28000,
                'description' => 'Porsi jumbo pangsit goreng isi daging ayam dan udang, kulit renyah keemasan. Satu porsi untuk satu tim peloton — atau habiskan sendiri.',
                'image_url'   => 'https://images.unsplash.com/photo-1496116218417-1a781b1c416c?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'name'        => 'Siomay Chainring',
                'category'    => 'Cemilan',
                'price'       => 25000,
                'description' => 'Siomay ikan tenggiri kukus tradisional dengan saus kacang homemade yang kaya rempah. Setiap gigitan mengayuh rasa yang menyenangkan.',
                'image_url'   => 'https://images.unsplash.com/photo-1617196034183-421b4040ed20?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'name'        => 'Hakau Dropout',
                'category'    => 'Cemilan',
                'price'       => 30000,
                'description' => 'Steamed har gow dengan kulit translucent tipis berisi campuran udang dan bambu muda. Tekstur kenyal premium, cocok untuk yang tahu kualitas.',
                'image_url'   => 'https://images.unsplash.com/photo-1582878826629-29b7ad1cdc43?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'name'        => 'Bao Handlebar',
                'category'    => 'Cemilan',
                'price'       => 27000,
                'description' => 'Soft steamed bun isi pork belly braised dalam hoisin sauce. Kulit fluffy putih seperti awan, isian gurih manis seperti pencapaian summit.',
                'image_url'   => 'https://images.unsplash.com/photo-1541614101331-1a5a3a194e92?w=800&auto=format&fit=crop&q=80',
            ],

            // ── BEVERAGES (5 items) ───────────────────────────────────────────
            [
                'name'        => 'Es Cadence Booster',
                'category'    => 'Minuman',
                'price'       => 22000,
                'description' => 'Cold brew coffee premium dipadukan soda lemon segar dan daun mint. Elektrolit alami untuk mempertahankan cadence riding di tengah hari panas.',
                'image_url'   => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'name'        => 'Es Peloton Rush',
                'category'    => 'Minuman',
                'price'       => 25000,
                'description' => 'Mocktail stroberi segar dengan lapisan gradient merah-merah muda yang instagrammable. Manis, asam, dan menyegarkan seperti sprint di kilometer terakhir.',
                'image_url'   => 'https://images.unsplash.com/photo-1553361371-9b22f78e8b1d?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'name'        => 'Kopi Fixie Black',
                'category'    => 'Minuman',
                'price'       => 18000,
                'description' => 'Single origin espresso dari biji kopi Gayo Aceh. Pahit, berani, tanpa basa-basi — seperti riding fixie di jalan raya.',
                'image_url'   => 'https://images.unsplash.com/photo-1510707577719-ae7c14805e3a?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'name'        => 'Soda Derailleur',
                'category'    => 'Minuman',
                'price'       => 20000,
                'description' => 'Campuran soda icy dengan buah tropis: markisa, leci, dan jambu biji. Rasa yang switch-up seperti ganti gigi derailleur di tanjakan.',
                'image_url'   => 'https://images.unsplash.com/photo-1534353473418-4cfa0a7ad37e?w=800&auto=format&fit=crop&q=80',
            ],
            [
                'name'        => 'Jus Crankset',
                'category'    => 'Minuman',
                'price'       => 24000,
                'description' => 'Jus mixed tropical segar tanpa gula tambahan: mangga, nanas, jeruk, dan semangka. Power output alami untuk recovery setelah long ride.',
                'image_url'   => 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?w=800&auto=format&fit=crop&q=80',
            ],
        ];

        foreach ($menus as $item) {
            Menu::firstOrCreate(
                ['name' => $item['name']],
                array_merge($item, ['is_available' => true])
            );
        }

        // Seed cycling events
        $this->call(EventSeeder::class);
    }
}
