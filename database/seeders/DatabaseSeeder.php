<?php

namespace Database\Seeders;

use App\Models\ArsipBudaya;
use App\Models\Karakter;
use App\Models\Pemeran;
use App\Models\Topeng;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin Default
        $admin = User::firstOrCreate(
            ['email' => 'admin@talepud.desa.id'],
            [
                'name'     => 'I Made Wijaya',
                'password' => Hash::make('password123'),
            ]
        );

        // Bersihkan tabel perantara
        DB::table('karakter_pemeran')->truncate();

        // 2. Data Koleksi Topeng Sakral
        $topengData = [
            [
                'nama_topeng'         => 'Tapel Hanoman',
                'kategori'            => 'Ratu Lingsir',
                'periode_sejarah'     => 'Circa 1924, Banjar Talepud, Gianyar, Bali',
                'bahan_pembuatan'     => 'Kayu Pule, Prada Emas 24k, Bulu Kera Asli',
                'pencipta_pembuat'    => 'I Gede Sangging (Maestro Undagi Talepud)',
                'jenis_koleksi'       => 'Tapel Sakral Petitis',
                'fungsi_pertunjukan'  => 'Sesolahan Tari Utama Lakon Kera Putih Utusan Sri Rama',
                'lokasi_penyimpanan'  => 'Gedong Simpen Pura Bale Bang Talepud',
                'pemilik'             => 'Krama Desa Adat Talepud',
                'pengelola'           => 'Seka Wayang Wong Dewa Kocala Raqta',
                'kondisi_koleksi'     => 'Sangat Terawat (Restorasi Prada 2018)',
                'tanggal_dokumentasi' => '2024-05-19',
                'petugas_dokumentasi' => 'I Kadek Butros Semara Bawa',
                'makna_filosofis'     => 'Hanoman melambangkan kesetiaan tanpa ragu kepada Rama, kekuatan dan keberanian luar biasa, kecerdasan dalam strategi, kesucian hati yang tulus, serta pengabdian penuh (bhakti).',
                'nilai_budaya'        => 'Karakter Hanoman memiliki nilai budaya sebagai bagian dari warisan seni pertunjukan tradisional yang diwariskan dan dilestarikan oleh masyarakat Desa Adat Talepud.',
                'nilai_estetika'      => 'Nilai estetika terdapat pada bentuk wajah, ekspresi, ornamen prada kancana, dan unsur visual topeng yang merepresentasikan karakter Hanoman sebagai kera putih berwibawa.',
                'deskripsi'           => 'Tapel berwajah kera putih suci berhiaskan badong dan prada emas murni, disucikan khusus untuk mengemban misi ke Alengka.',
                'foto_cover'          => 'https://images.unsplash.com/photo-1578632767115-351597cf2477?auto=format&fit=crop&w=800&q=80',
                'model_3d'            => null,
                'id_admin'            => $admin->id,
            ],
            [
                'nama_topeng'         => 'Tapel Sugriwa',
                'kategori'            => 'Ratu Anom',
                'periode_sejarah'     => 'Circa 1935, Banjar Talepud, Gianyar, Bali',
                'bahan_pembuatan'     => 'Kayu Pule, Serbuk Tulang, Pewarna Alami Kencur & Jelaga',
                'pencipta_pembuat'    => 'Ida Bagus Made Gelgel',
                'jenis_koleksi'       => 'Tapel Wanara Raja',
                'fungsi_pertunjukan'  => 'Pementasan Perang Kiskenda & Alengka Pura Bale Bang',
                'lokasi_penyimpanan'  => 'Pelinggih Gedong Bale Bang',
                'pemilik'             => 'Desa Adat Talepud',
                'pengelola'           => 'Seka Wayang Wong Dewa Kocala Raqta',
                'kondisi_koleksi'     => 'Terawat Baik (Warna Alami Asli)',
                'tanggal_dokumentasi' => '2025-02-10',
                'petugas_dokumentasi' => 'I Putu Gede Jati',
                'makna_filosofis'     => 'Keteguhan memegang janji persahabatan sejati dan penegakan kebenaran melawan ketidakadilan tirani.',
                'nilai_budaya'        => 'Simbol kepemimpinan bangsa wanara yang tunduk pada dharma kebajikan.',
                'nilai_estetika'      => 'Warna merah bata tua dengan ornamen taring melengkung tegas memperlihatkan aura kesatria perkasa.',
                'deskripsi'           => 'Topeng raja wanara dari Gua Kiskenda dengan raut tegas, mata membelalak, dan gelung keemasan.',
                'foto_cover'          => 'https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=800&q=80',
                'model_3d'            => null,
                'id_admin'            => $admin->id,
            ],
            [
                'nama_topeng'         => 'Tapel Rahwana',
                'kategori'            => 'Ratu Lingsir',
                'periode_sejarah'     => 'Circa 1918, Banjar Talepud, Gianyar, Bali',
                'bahan_pembuatan'     => 'Kayu Pule Sakral, Gigi Hewan, Prada Kasar',
                'pencipta_pembuat'    => 'Ki Undagi Wayan Taler',
                'jenis_koleksi'       => 'Tapel Raksasa Dasamuka',
                'fungsi_pertunjukan'  => 'Klimaks Lakon Gugurnya Dasamuka / Piodalan Jelih',
                'lokasi_penyimpanan'  => 'Gedong Simpen Utama',
                'pemilik'             => 'Desa Adat Talepud',
                'pengelola'           => 'Seka Wayang Wong Dewa Kocala Raqta',
                'kondisi_koleksi'     => 'Antik & Sakral',
                'tanggal_dokumentasi' => '2023-11-04',
                'petugas_dokumentasi' => 'I Nyoman Cerita',
                'makna_filosofis'     => 'Refleksi angkara murka, nafsu duniawi yang tak terbatas, dan kehancuran tak terelakkan akibat pengabaian etika dharma.',
                'nilai_budaya'        => 'Pengingat moral bagi krama banjar mengenai bahaya ego raksasa dalam diri manusia.',
                'nilai_estetika'      => 'Karakter muka merah menyala dengan mata bulat menjulang serta taring tajam mengintimidasi panggung.',
                'deskripsi'           => 'Tapel Prabu Dasamuka dari Kerajaan Alengka, berwajah merah seram dengan taring kokoh melambangkan angkara murka.',
                'foto_cover'          => 'https://images.unsplash.com/photo-1563089145-599997674d42?auto=format&fit=crop&w=800&q=80',
                'model_3d'            => null,
                'id_admin'            => $admin->id,
            ],
            [
                'nama_topeng'         => 'Tapel Merdah',
                'kategori'            => 'Ratu Anom',
                'periode_sejarah'     => 'Circa 1940, Banjar Talepud, Gianyar, Bali',
                'bahan_pembuatan'     => 'Kayu Pule, Pigmen Cokelat Tanah',
                'pencipta_pembuat'    => 'I Wayan Sudi',
                'jenis_koleksi'       => 'Tapel Punakawan Kanan',
                'fungsi_pertunjukan'  => 'Penerjemah Dialog Filosofis & Lakon Humor',
                'lokasi_penyimpanan'  => 'Gedong Simpen Pura Bale Bang',
                'pemilik'             => 'Desa Adat Talepud',
                'pengelola'           => 'Seka Wayang Wong Dewa Kocala Raqta',
                'kondisi_koleksi'     => 'Terawat Baik',
                'tanggal_dokumentasi' => '2026-01-15',
                'petugas_dokumentasi' => 'I Made Wijaya',
                'makna_filosofis'     => 'Kesederhanaan rakyat jelata yang senantiasa cerdas menafsirkan ajaran dharma dalam senda gurau kehidupan.',
                'nilai_budaya'        => 'Jembatan pemahaman antara bahasa Kawi pementasan kuno dengan krama masa kini.',
                'nilai_estetika'      => 'Bentuk bibir tersenyum ramah dan pipi tembam melambangkan kehangatan serta keceriaan spiritual.',
                'deskripsi'           => 'Punakawan setia pengiring pangeran Rama dengan watak jenaka namun sarat wejangan kebajikan.',
                'foto_cover'          => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=800&q=80',
                'model_3d'            => null,
                'id_admin'            => $admin->id,
            ],
            [
                'nama_topeng'         => 'Tapel Delem',
                'kategori'            => 'Ratu Lingsir',
                'periode_sejarah'     => 'Circa 1938, Banjar Talepud, Gianyar, Bali',
                'bahan_pembuatan'     => 'Kayu Pule, Serbuk Kerang Merah',
                'pencipta_pembuat'    => 'I Gede Sangging',
                'jenis_koleksi'       => 'Tapel Punakawan Kiri',
                'fungsi_pertunjukan'  => 'Iring-iringan Pihak Alengka & Sumpah Prajurit',
                'lokasi_penyimpanan'  => 'Gedong Simpen Pura Bale Bang',
                'pemilik'             => 'Desa Adat Talepud',
                'pengelola'           => 'Seka Wayang Wong Dewa Kocala Raqta',
                'kondisi_koleksi'     => 'Terawat',
                'tanggal_dokumentasi' => '2025-08-20',
                'petugas_dokumentasi' => 'I Kadek Butros Semara Bawa',
                'makna_filosofis'     => 'Sindiran terhadap sifat manusia yang gemar menyombongkan diri dan mencari muka di hadapan penguasa.',
                'nilai_budaya'        => 'Kritik sosial tradisional Bali terhadap kepalsuan dan kepongahan.',
                'nilai_estetika'      => 'Mata juling dengan leher mendongak jenaka yang memancing gelak tawa penonton tanpa kehilangan wibawa panggung.',
                'deskripsi'           => 'Punakawan pengiring pihak Rahwana yang congkak, bertubuh tambun, dan bersuara lantang melengking.',
                'foto_cover'          => 'https://images.unsplash.com/photo-1541701494587-cb58502866ab?auto=format&fit=crop&w=800&q=80',
                'model_3d'            => null,
                'id_admin'            => $admin->id,
            ],
            [
                'nama_topeng'         => 'Tapel Kumbakarna',
                'kategori'            => 'Ratu Lingsir',
                'periode_sejarah'     => 'Circa 1928, Banjar Talepud, Gianyar, Bali',
                'bahan_pembuatan'     => 'Kayu Pule, Pigmen Cokelat Tua, Serat Rami',
                'pencipta_pembuat'    => 'Ki Undagi Wayan Taler',
                'jenis_koleksi'       => 'Tapel Kesatria Raksasa',
                'fungsi_pertunjukan'  => 'Pementasan Gugurnya Kesatria Pembela Tanah Air',
                'lokasi_penyimpanan'  => 'Gedong Simpen Pura Bale Bang',
                'pemilik'             => 'Desa Adat Talepud',
                'pengelola'           => 'Seka Wayang Wong Dewa Kocala Raqta',
                'kondisi_koleksi'     => 'Sangat Baik',
                'tanggal_dokumentasi' => '2024-10-12',
                'petugas_dokumentasi' => 'I Putu Gede Jati',
                'makna_filosofis'     => 'Simbol nasionalisme dan jiwa bela pati pertiwi: berperang bukan demi kejahatan kakaknya, melainkan demi kehormatan tanah kelahirannya.',
                'nilai_budaya'        => 'Teladan moral tertinggi tentang pengorbanan jiwa bagi ibu pertiwi.',
                'nilai_estetika'      => 'Raut muka raksasa berbibir tebal dengan tatapan sayu mencerminkan konflik batin yang mendalam.',
                'deskripsi'           => 'Raksasa bertubuh gunung adik Rahwana yang memilih gugur di medan laga demi mempertahankan bumi Alengka.',
                'foto_cover'          => 'https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?auto=format&fit=crop&w=800&q=80',
                'model_3d'            => null,
                'id_admin'            => $admin->id,
            ]
        ];

        $createdTopengs = [];
        foreach ($topengData as $t) {
            $createdTopengs[$t['nama_topeng']] = Topeng::create($t);
        }

        // 3. Data Tokoh Karakter
        $karakterData = [
            [
                'nama_karakter'   => 'Hanoman',
                'peran'           => 'Panglima Wanara Putih',
                'id_topeng'       => $createdTopengs['Tapel Hanoman']->id_topeng,
                'deskripsi'       => 'Kera putih sakral titisan Batara Bayu dengan kelincahan gerak angin dan kesaktian melompati samudra menuju Alengka.',
                'visual_karakter' => 'https://images.unsplash.com/photo-1578632767115-351597cf2477?auto=format&fit=crop&w=800&q=80',
                'audio_karakter'  => null,
                'video_youtube'   => 'https://www.youtube.com/watch?v=YXXp_zRjFHk',
            ],
            [
                'nama_karakter'   => 'Sugriwa',
                'peran'           => 'Raja Bangsa Wanara Kiskenda',
                'id_topeng'       => $createdTopengs['Tapel Sugriwa']->id_topeng,
                'deskripsi'       => 'Pemimpin bala tentara kera Kiskenda yang mengerahkan pasukannya untuk membangun jembatan Situbanda menyeberangi lautan.',
                'visual_karakter' => 'https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=800&q=80',
                'audio_karakter'  => null,
                'video_youtube'   => 'https://www.youtube.com/watch?v=YXXp_zRjFHk',
            ],
            [
                'nama_karakter'   => 'Rahwana (Dasamuka)',
                'peran'           => 'Raja Raksasa Alengka Diraja',
                'id_topeng'       => $createdTopengs['Tapel Rahwana']->id_topeng,
                'deskripsi'       => 'Antagonis utama yang menculik Dewi Sinta, memiliki kesaktian Aji Pancasona sehingga tak dapat mati jika menyentuh tanah.',
                'visual_karakter' => 'https://images.unsplash.com/photo-1563089145-599997674d42?auto=format&fit=crop&w=800&q=80',
                'audio_karakter'  => null,
                'video_youtube'   => 'https://www.youtube.com/watch?v=YXXp_zRjFHk',
            ],
            [
                'nama_karakter'   => 'Dewi Sinta',
                'peran'           => 'Permaisuri Sri Rama',
                'id_topeng'       => null,
                'deskripsi'       => 'Lambang kesucian, keanggunan, dan keteguhan hati seorang wanita kesatria dalam menghadapi cobaan selama disekap di taman Asoka.',
                'visual_karakter' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=800&q=80',
                'audio_karakter'  => null,
                'video_youtube'   => 'https://www.youtube.com/watch?v=YXXp_zRjFHk',
            ],
            [
                'nama_karakter'   => 'Merdah',
                'peran'           => 'Punakawan Pihak Kanan',
                'id_topeng'       => $createdTopengs['Tapel Merdah']->id_topeng,
                'deskripsi'       => 'Pengiring setia yang bijak, mengurai persoalan rumit kepemimpinan ke dalam tutur bahasa yang dipahami krama desa.',
                'visual_karakter' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=800&q=80',
                'audio_karakter'  => null,
                'video_youtube'   => 'https://www.youtube.com/watch?v=YXXp_zRjFHk',
            ],
            [
                'nama_karakter'   => 'Kumbakarna',
                'peran'           => 'Senopati Raksasa Alengka',
                'id_topeng'       => $createdTopengs['Tapel Kumbakarna']->id_topeng,
                'deskripsi'       => 'Adik kandung Rahwana yang bertubuh raksasa gemar tidur panjang, gugur secara ksatria demi mempertahankan kehormatan negaranya.',
                'visual_karakter' => 'https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?auto=format&fit=crop&w=800&q=80',
                'audio_karakter'  => null,
                'video_youtube'   => 'https://www.youtube.com/watch?v=YXXp_zRjFHk',
            ]
        ];

        $createdKarakters = [];
        foreach ($karakterData as $k) {
            $createdKarakters[$k['nama_karakter']] = Karakter::create($k);
        }

        // 4. Data Seniman Pemeran
        $pemeranData = [
            [
                'nama_pemeran'    => 'I Gede Bawa Sujana',
                'pengalaman'      => '32 Years Experience',
                'biodata_singkat' => 'Gede Bawa Sujana sudah mengabdi memerankan tokoh Hanoman dari tahun 1994 sampai saat ini di Pura Bale Bang Talepud.',
                'foto_pemeran'    => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=800&q=80',
                'video_youtube'   => 'https://www.youtube.com/watch?v=YXXp_zRjFHk',
                'karakters'       => ['Hanoman'],
            ],
            [
                'nama_pemeran'    => 'I Nyoman Cerita',
                'pengalaman'      => '28 Years Experience',
                'biodata_singkat' => 'Maestro penari karakter kera dan raksasa bertubuh tegap yang telah melanglang buana mempopulerkan pakem tari Talepud.',
                'foto_pemeran'    => null,
                'video_youtube'   => 'https://www.youtube.com/watch?v=YXXp_zRjFHk',
                'karakters'       => ['Sugriwa', 'Kumbakarna'],
            ],
            [
                'nama_pemeran'    => 'Ni Wayan Sekariani',
                'pengalaman'      => '35 Years Experience',
                'biodata_singkat' => 'Seniwati penjaga kemurnian sesolahan karakter putri keraton Wayang Wong yang melatih generasi muda putri desa.',
                'foto_pemeran'    => null,
                'video_youtube'   => 'https://www.youtube.com/watch?v=YXXp_zRjFHk',
                'karakters'       => ['Dewi Sinta'],
            ],
            [
                'nama_pemeran'    => 'I Putu Gede Jati',
                'pengalaman'      => '12 Years Experience',
                'biodata_singkat' => 'Penari generasi muda penerus tari punakawan dan tokoh antagonis dengan ketepatan tandang tangkep pementasan.',
                'foto_pemeran'    => null,
                'video_youtube'   => 'https://www.youtube.com/watch?v=YXXp_zRjFHk',
                'karakters'       => ['Merdah', 'Rahwana (Dasamuka)'],
            ],
        ];

        foreach ($pemeranData as $p) {
            $karakterNames = $p['karakters'];
            unset($p['karakters']);

            $pemeran = Pemeran::create($p);

            foreach ($karakterNames as $kName) {
                if (isset($createdKarakters[$kName])) {
                    $pemeran->karakters()->attach($createdKarakters[$kName]->id_karakter, [
                        'keterangan' => 'Pemeran Aktif Piodalan',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        // 5. Data Arsip Budaya & Dokumentasi (Lengkap dengan kolom slug)
        $arsipData = [
            [
                'judul_arsip'       => 'Rekaman Audio Tabuh Lelambatan Wayang Wong',
                'slug'              => Str::slug('Rekaman Audio Tabuh Lelambatan Wayang Wong'),
                'kategori'          => 'Multimedia',
                'tahun_dokumentasi' => 1984,
                'deskripsi'         => 'Dokumentasi pita kaset pita magnetik tabuh iringan gamelan Batel Wayang Wong pementasan Pura Bale Bang.',
                'thumbnail'         => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=800&q=80',
                'file_media'        => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=800&q=80',
                'video_youtube'     => 'https://www.youtube.com/watch?v=YXXp_zRjFHk',
                'id_admin'          => $admin->id,
            ],
            [
                'judul_arsip'       => 'Lontar Naskah Kawi Lampahan Kiskenda Kanda',
                'slug'              => Str::slug('Lontar Naskah Kawi Lampahan Kiskenda Kanda'),
                'kategori'          => 'Literatur',
                'tahun_dokumentasi' => 1972,
                'deskripsi'         => 'Transkripsi naskah lontar pakem tutur pementasan lakon perebutan Subali dan Sugriwa di Talepud.',
                'thumbnail'         => 'https://images.unsplash.com/photo-1457369804613-52c61a468e7d?auto=format&fit=crop&w=800&q=80',
                'file_media'        => 'https://images.unsplash.com/photo-1457369804613-52c61a468e7d?auto=format&fit=crop&w=800&q=80',
                'video_youtube'     => null,
                'id_admin'          => $admin->id,
            ],
            [
                'judul_arsip'       => 'Foto Dokumentasi Piodalan Ageng 1996',
                'slug'              => Str::slug('Foto Dokumentasi Piodalan Ageng 1996'),
                'kategori'          => 'Dokumentasi Pertunjukan',
                'tahun_dokumentasi' => 1996,
                'deskripsi'         => 'Potret arsip visual para maestro Wayang Wong lengkap dengan gelungan dan busana kain prada lawas.',
                'thumbnail'         => 'https://images.unsplash.com/photo-1533158307587-828f0a76ef96?auto=format&fit=crop&w=800&q=80',
                'file_media'        => 'https://images.unsplash.com/photo-1533158307587-828f0a76ef96?auto=format&fit=crop&w=800&q=80',
                'video_youtube'     => 'https://www.youtube.com/watch?v=YXXp_zRjFHk',
                'id_admin'          => $admin->id,
            ]
        ];

        foreach ($arsipData as $a) {
            ArsipBudaya::create($a);
        }
    }
}