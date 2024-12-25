<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
        }

        li {
            text-align: justify;
        }

        .header {
            text-align: center;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .subheader {
            text-align: center;
            font-size: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="header">Surat Perjanjian Kerja Waktu Tertentu</div>
    <div class="subheader">Nomor: {{ $data->no_surat }}</div>

    <p style="font-size: 8px;">PARA PIHAK yang namnya yang tercantum dan bertanggung jawab di bawah ini :</p>

    <table style="font-size: 8px;">
        <tr>
            <td style="width: 20px;">1.</td>
            <td style="width: 100px;">Nama</td>
            <td style="width: 10px;">:</td>
            <td style="width: 500px;">ERNA MULYANI.</td>
        </tr>
        <tr>
            <td></td>
            <td>Jabatan</td>
            <td>:</td>
            <td>Personalia</td>
        </tr>
        <tr>
            <td></td>
            <td>Alamat</td>
            <td>:</td>
            <td>Komplek Permata Kopo Blok B No.76 Bandung 40228</td>
        </tr>
    </table>

    <p style="font-size: 8px;">Selanjutnya disebut sebagai " PIHAK PERTAMA " :</p>

    <table style="font-size: 8px;">
        <tr>
            <td style="width: 20px;">1.</td>
            <td style="width: 100px;">Nama</td>
            <td style="width: 10px;">:</td>
            <td style="width: 300px;"><span style="text-transform: uppercase;">{{$data->name}}</span></td>
        </tr>
        <tr>
            <td></td>
            <td>Tempat Tanggal Lahir</td>
            <td>:</td>
            <td>Bandung, 11 Nov 2003</td>
        </tr>
        <tr>
            <td></td>
            <td>Alamat</td>
            <td>:</td>
            <td>Komplek Permata Kopo Blok B No.76 Bandung 40228</td>
        </tr>
        <tr>
            <td></td>
            <td>No KTP</td>
            <td>:</td>
            <td>3205991832</td>
        </tr>
    </table>

    <p style="font-size: 8px;">Selanjutnya disebut sebagai " PIHAK KEDUA " :</p>
    <p style="font-size: 8px;">Bahwa <b>PIHAK PERTAMA</b> bersama-sama dengan <b>PIHAK KEDUA</b> dengan ini telah saling sepakat untuk membuat perjanjian kerja waktu tertentu dengan syarat syarat dan ketentuan sebagai berikut :</p>

    <br>
    <table style="width: 100%;">
        <tr>
            <td style="width: 45%;">
                <p style="text-align: center; font-size:10px"><b>PASAL 1<br>HUBUNGAN KERJA</b></p>
                <table>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">1.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">"PIHAK PERTAMA bersedia menerima dan memperkerjakan "PIHAK KEDUA" dan "PIHAK KEDUA" Menyatakan menerima dan bersedia bekerja kepada "PIHAK PERTAMA".</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">2.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">"PIHAK PERTAMA" memberi tugas / pekerjaan / perintah kepada "PIHAK KEDUA" dan "PIHAK KEDUA" menerima serta bersedia melaksanakan tugas / pekerjaan perintah tersebut deng sebaik-baiknya dan penuh rasa tanggung jawab.
                        </td>
                    </tr>
                </table>
            </td>
            <td style="width: 8%;"></td>
            <td style="width: 45%;">
                <table>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">5.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Selama masa kerja "PIHAK KEDUA", kecuali dengan izin "PIHAK PERTAMA", "PIHAK KEDUA" tidka diperkenankan bekerja untuk orang lain, perusahaan lain atau melakukan usaha atau praktek profesi yang menimbulkan konflik kepentingan terhadap "PIHAK PERTAMA".</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">6.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">"PIHAK KEDUA" harus merahasiakan segala yang diperoleh atau dilihat serta diketahui yang berhubungan dengan hal-hal yang menyangkut rahasia perusahaan, seperti data konsumen, penghasilan / keuangan dan mengenai praktek perusahaan kepada siapapun selama masih kerja maupun setelah itu.</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="width: 45%;">
                <p style="text-align: center; font-size:10px"><b>PASAL 2<br>KEWAJIBAN DAN TANGGUNG JAWAB</b></p>
                <table>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">1.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">"PIHAK PERTAMA" berkah memperkerjakan "PIHAK KEDUA" sebagaimana mesti tersebut dalam pasal 1.
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">2.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">"PIHAK KEDUA" berkewajiban menerima dan melaksanakan pekerjaan tersebut ayat 1 pasal ini dengan mentaati dan tunduk terhadap semua peraturan, kebijakan, prosedur, perintah, serta petunjuk "PIHAK PERTAMA" dan dengan segala kemampuan selalu mendahulukan kepentingan "PIHAK PERTAMA"</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">3.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Dalam menjalankan tugas dan kewajiban "PIHAK KEDUA diwajibakan untuk selalu berperilaku baik, menjaga suasana kerja yang harmonis dan menjaga nama baik perusahaan.</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">4.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">"PIHAK KEDUA berkewajiban untuk memberikan informasi, data dan masukan kepada "PIHAK PERTAMA" berdasarkan temuan yang didapat dari hasil pelaksanaan tugas operasional sehari-hari, baik secara lisan maupun tulisan.
                        </td>
                    </tr>
                </table>
            </td>
            <td style="width: 8%;"></td>
            <td style="width: 45%;">
                <table>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">7.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Kesalahan atau kelalaian "PIHAK KEDUA" yang menimbulkan kerugian "PIHAK PERTAMA" saat menjalankan tugas yang kurang hati-hati kelalaian, pelanggaran atau kesalahan dan tidak mengikuti prosedut kerja yang telah ditentukan akan menjadi beban dan tanggungjawab "PIHAK KEDUA" yang akan dipotong keupahan maksimal 50% setiap bulannya.</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">8.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Karyawan di dalam menjalankan tugasnya harus mentaati semua hukum undang-undang dan peraturan yang berlaku di wilayah republik Indonesia.</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">9.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">"pihak kedua' tidak diperkenankan mengundurkan diri sebelum 3 bulan masa kerja.
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">10.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Apabila "PIHAK KEDUA" mengundurkan diri sebelum masa kerja 3 bulan berakhir selesai, "PIHAK KEDUA" wajib mengganti kerugian kepada "PIHAK PERTAMA" secara materi sebesar 1 bulan gaji "PIHAK KEDUA".</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table style="width: 100%;">
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td style="width: 45%;">
                <p style="text-align: center; font-size:10px"><b>PASAL 3<br>UPAH</b></p>
                <table>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">1.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Sebagai imbalan atas pelaksanaan tugas pekerjaan / perintah seperti yang bermaksud pasał 1 perjanjian ini "KEDUA BELAH PIHAK sepakat bahwa besarnya upah sesuai standart yang berlaku di perusahaan.</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">2.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Pengupahan menggunakan sistem no work no pay (tidak bekerja tidak dibayar).</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">3.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Upah tersebut akan dibayarkan oleh "PIHAK PERTAMA" kepada "PIHAK KEDUA" pada bulan berikutnya setelah selesai pelaksanaan pekerjaan selama 1 (satu) bulan periode absensi (dimulai dari tanggal 1 sampai dengan tanggal 30 bulan berikutnya) dan hal ini berlaku pada bulan- bulan berikutnya.</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">4.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">"PIHAK KEDUA" akan diikutsertakan dalam program BPJS Ketenagakerjaan dengan ketentuan bahwa "PIHAK PERTAMA" hanya mengacu berdasarkan plavon yang telah ditentukan oleh Pihak BPJS Ketenagakerjaan, adapun kelebihan dadri plavon yang ditetapkan akan menjadi tanggung jawab "PIHAK KEDUA".</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">5.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Jika tanggal di mulainya maupun tanggal berakhirnya perjanjian ini tidak sesuai dengan tanggal awal maupun tanggal akhir dari periode kerja bulanan sesuai ketetapan perusahaan, maka pembayaran upah bulan pertama kerja maupun bulan terakhir saat berakhirnya perjanjian akan dihitung secara profesional sesuai jumlah efektif hari kerja yang telah dijalani dalam periode bulan tersebut.</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">6.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">"PIHAK PERTAMA" memberikan tunjangan hari raya kepada "PIHAK KEDUA" setiap tahunnya pada saat hari raya keagamaan sesuai ketentuan yang berlaku.</td>
                    </tr>
                </table>
            </td>
            <td style="width: 8%;"></td>
            <td style="width: 45%;">
                <p style="text-align: center; font-size:10px"><b>PASAL 5<br>PELANGGARAN</b></p>
                <table>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">1.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Pelanggaran yang dapat dikenakan sanksi surat peringatan pertama (SP I), seperti berikut: <br>
                            <ol type="a">
                                <li>Tidak hadir karena alpa selama 2 (dua) hari secara terus-menerus dalam waktu kurun satu bulan.</li>
                                <li>Beberapa kali datang terlambat masuk kerja tanpa alasan yang jelas.</li>
                                <li>Bertingkah laku tidak sopan baik terhadap atasan, bawahan maupun terhadap sesama pekerja.</li>
                                <li>Tidak melaksanakan tugas dan kewajibannya terhadap perintah atasan yang wajar dengan alasan yang tidak bisa di terima dengan akal sehat.</li>
                                <li>Bergerombol atau bercanda yang berlebihan dalam melaksanakan tugas.</li>
                                <li>Meninggalkan tempat tugas atau pos penjagaan tanpa seizin dari atasan yang berwenang.</li>
                                <li>Meninggalkan tempat kerja tanpa seizin dari atasan yang berwenang.</li>
                                <li>Lalai mengindahkan peraturan-peraturan keselamatan dan kesehatan kerja sehingga dapat membahayakan dirinya dan atau orang lain.</li>
                                <li>Berpenampilan tidak bersih / tidak sesuai dengan sikap tampan anggota satuan pengamanan.</li>
                                <li>Tidak memakai seragam sesuai dengan ketentuan / aturan perusahaan, dan tidak menajga kerapihan, kelengkapandan kebersihan seragam dinas.</li>
                                <li>Pada saat bertugas membaca koran, majalan, menonton televisi, maupun sejenis yang sekirana dapat mengganug konsentrasi bekerja.</li>
                                <li>Memasuki tempat terlarang tanpa izin dari orang yang berwenang</li>
                                <li>Menolak di tempatkan di lokasi yang telah di tentukan berdasarkan sumpah perintah / surat tugas yang di keluarkan oleh atasan yang berwenang.</li>
                            </ol>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="width: 45%;">
                <p style="text-align: center; font-size:10px"><b>PASAL 4<br>PENEMPATAN DAN WAKTU TUGAS</b></p>
                <table>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">1.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">"PIHAK PERTAMA" adalah pihak yang mempunyai usaha penyedia dan pengelola sumber daya manusia, khususnya dalam hal-hal penyelenggara pendidikan dan penyelenggara satuan pengamanan oleh "PIHAK PERTAMA".</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">2.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">"PIHAK KEDUA" bersedia untuk dimutasi, dirotasi dalam ragka kebijakan "PIHAK PERTAMA".</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">3.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Apabila "PIHAK KEDUA" di mutasikan ke tempat kerja yang baru, maka hak dan kewajibannya di sesuaikan dengan peraturan dan ketentuan dimana anggota tersebut di tempatkan.</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">4.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">"PIHAK KEDUA" bersedia tetap bekerja pada hari libur dan hari-hari besar sesuai jadwal kerja yang ditentukan oleh "PIHAK PERTAMA".</td>
                    </tr>
                </table>
            </td>
            <td style="width: 8%;"></td>
            <td style="width: 45%;">
                <table>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">2.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Pelanggaran yang dapat dikenakan sanksi surat peringatan pertama (SP II), seperti berikut: <br>
                            <ol type="a">
                                <li>Mengulangi pelanggaran yang sama dalam jangka waktu peringatan pertama masih berlaku.</li>
                                <li>Tidak masuk kerja selama 3 (tiga) hari terus menerus dalam kurun waktu sebulan.</li>
                                <li>Lalai untuk memeriksa dan memelihara alat- alat perlengkapan kerja sehingga mengakibatkan kerusakan.</li>
                                <li>Lalai mengembalikan barang-barang dan alat-alat perlengkapan tugas pada tempatnya yang mengakibatkan alat tersebut rusak atau hilang.</li>
                                <li>Mengambil, membawa, menguasai, memindahkan atau menjamkan barang- barang ataupun peralatan jasa tanpa ijin petugas yang berwenang.</li>
                                <li>Tidak menjalankan tata tertib (prosedur kerja) yang berlaku.</li>
                                <li>Melakukan pekerjaan yang bukan tugasnya, yang mengakibatkan lalai dalam tugasnya sendiri.</li>
                            </ol>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table style="width: 100%;">
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td style="width: 45%;">
                <table>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">3.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Surat peringatan ketiga / terakhir diberiakn kepada karyawan / wati yang melakukan perbuatan:<br>
                            <ol type="a">
                                <li>Melakukan kesalahan lagi setelah mendapat surat peringatan kedua yang asih berlaku.</li>
                                <li>Melanggar standar kerja sehingga menimbulkan keabnormalan yang besar.</li>
                                <li>Meminjamkan tand pengenal surat keterangan pribadi yang dikeluarkan oleh perusahaan untuk di salah gunakan.</li>
                                <li>Mealkukan propaganda terhadap karyawan/wati lain.</li>
                                <li>Membawa kedalam tempat kerja senjata tajam, senjata api, atau benda-benda lainnya yang berbahaya tanpa ijin resmi.</li>
                                <li>Mempunyai pekerjaan lain, atau tercatat sebagai karyawan perusahaan lain.</li>
                                <li>Tidak masuk kerja tanpa pemberitahuan selama 4 hari berturut-turut.</li>
                            </ol>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">4.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Sanksi pemutusan hubungan kerja di kenakan pada karyawan / wati dengna tanpa surat peringatan terlebih dahulu dan tanpa pemberian uang pesangon adalah yang melakukan perbuatan sebagai berikut:<br>
                            <ol type="a">
                                <li>Menyalahgunakan kepercayaan perusahaan/ pimpinan perusahaan dengan menerima sogokan atau komisi dalam bentuk uang dan atau barang / jasa merugikan perusahaan secara materi.</li>
                                <li>Memanfaatkan jabatan / kewenangan, yang dimiliki dalam proses perekrutan calon karywan, dengan meminta imbalan / menerima suap dari calon karyawan / calon tenaga kerja, yang melamar atau sedang proses seleksi di perusahaan.</li>
                                <li>Secara langsung maupun tidak langsung (melalui pihak ketiga) menganiaya, mengancam atau menghina secara kasar pada perusahaan, keluarga pengusaha, atasan, teman sekerja, keluarga pekerja atau bahaawahhnya baik didalam maupun diluar tempat kerja.</li>
                                <li>Tidak tunduk karywan/wawti sudah tidak dapat di pertanggung jawabakan / membahayakan perusahaan atau karyawan / wati lainnya.</li>
                                <li>Merokok di tempat kerja atau di tempat- tempat lainnya yang dilarang untuk merokok.</li>
                                <li>Mendapat hukuman / vonis hakim karena melakukan tindak pidana yang berlaku di Indonesia.</li>
                                <li>Melakukan pertemuan / rapat helap di dalam tempat kerja.</li>
                                <li>Melakukan sabotase atau agitasi.</li>
                                <li>Berkelahi dengan teman sekerj adi dalam tempat kerja atau dalam waktu yang berhubungan dengan kerja.</li>
                                <li>Memberikan keterangan palsu, ijazah palsu, atau isinya di palsukan, yang menyangkut karyawan/wati sendiri atau keluarganya.</li>
                                <li>Mabuk atau memakai obat terlarang (NAPZA) di dalam kerja / kantor / perusahaan.</li>
                                <li>Berjudi ditempat kerja.</li>
                                <li>Melakukan pencurian / penggelapan.</li>
                                <li>Membujuk atau memikat teman sekerja / keluarga teman sekerja untuk berbuat sesuatu yang melanggar huku atau kesusilaan didalam tempat kerja / perusahaan.</li>
                            </ol>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="width: 8%;"></td>
            <td style="width: 45%;">
                <table>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;"></td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">
                            <ol start="15" type="a">
                                <li>Dengan sengaja merusak barang inventaris miliki perusahaan.</li>
                                <li>Tidak masuk kerja 5 (lima) hari berturut- turut tanpa alasan yang dapat di terima oleh perusahaan dan telah dipanggil selama 2 (dua) kali.</li>
                                <li>Dengan sengaja membocorkan rahasi atau pengusaha dana atau keluarganya, kecuali untuk kepentinga negara.</li>
                                <li>Membawa atau menggunakan kendaraan bermotor milik perusahaan pengguna jasa di dalam atau di luar wilayah perusahaan pada waktu/jadwal kerja tanpa ijin tertulis dari yang berwenang di perusahaan.</li>
                            </ol>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <p style="text-align: center; font-size:10px"><b>PASAL 6<br>MASA BERLAKU</b></p>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">1.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Perjanjian kerja ini berlaku untuk jangka waktu 12 (dua belas) bulan yang berlaku terhitung mulai tanggal 1 (satu), Bulan Mei, Tahun 2024 (dua ribu dua puluh empat) sampai dengan 30 (tiga puluh), Bulan April, Tahun 2025 (Dua ribu dua puluh lima).</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">2.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Hubungan kerja antara karyawan dengan perusahaan akan ditinjau kembali pada akhir waktu perjanjian kerja.</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">3.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Dalam hal perpanjangan perjanjian atau pembahasan perjanjian, PARA PIHAK sepakat bahwa perpanjangan ini dilakukan segera, tanpa tenggang waktu 30 (tiga puluh) hari sebagaimana di maksudkan pasal 3 ayat 8 kepmenaker no.100/men/2004 dan PARA PIHAK sepakat untük melanjutkan hubungan kerja yang dituangkan dalam perjanjian kerja ini. Dalam hal perpanjangan ataupun pembaharuan. tersebut "PIHAK PERTAMA" akan memberitahukan "PIHAK KEDUA" secara tertulis paling lambat 7 ( tujuh ) hari sebelumnya.</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">4.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Apabila perjanjian kerja ini di akhiri sebelum waktunya, baik oleh karywan maupun perusahaan máka upah dan fasilitas lainnya juga di akhiri sesuai tanggal di akhirinya perjanjian kerja ini.</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <p style="text-align: center; font-size:10px"><b>PASAL 7<br>BERAKHIRNYA PERJANJIAN KERJA</b></p>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">1.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Perjanjian kerja ini berakhir dengan sendirinya atau demi hukum dengan berakhirnya waktu seperti di perjanjian pada pasal 6 ayat 1 perjanjian ini.</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">2.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Perjanjian kerja ini juga berakhir apablia perjanjian kerja antara perusahaan dengan pelanggan (pihak pemberi kerja) dimana karyawan di tempatkan dihentikan oleh sebab apapun.</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">3.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Perjanjian kerja ini berakhir dan karyawan di anggap mengundurkan diri, apabila tanpa pemberitahuan karyawan selama 5 (lima) hari berturut-turut tidak masuk kerja.</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table style="width: 100%;">
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td style="width: 45%;">
                <table>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">4.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Perusahaan berkhak sewaktu-waktu memutuskan hubungan kerja dengan karyawna dengan ketentuan bahwa pemutusan hubungan kerja tersebut disampaikan kepada kat awna selambat-lambatnya empat belas hari sebelum pemutusan hubungan kerja tersebut dilaksanakan, kecuali apabila karyawn mealkukan kesalahan besar seperti tercantu pada pasal 5 perjanjian ini atau dengan alsan mendesak bagi perusahaan maka perusahaan dapt langsung memberhentikan karyawan dengan seketika<br></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">5.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Karyawan dapat mengakhiri perjanjian ini sebelum berakhirnya jangka waktu dengan memberitahukan kepada perusahaan minimal empat belas hari sebelumnya tanpa kewajiban bagi perusahaan untuk memberikan pesangon pada karyawan.</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">6.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Pada saat berakhirnya perjanjian ini, karawan wajib mengembalikan semua perlengkapan kerja, inventaris, serta wajib dengan segera menyelesaikan seluruh kewajiban yang terutar kepada perusahaan.</td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">
                        </td>
                        <td>
                            <p style="text-align: center; font-size:10px"><b>PASAL 8<br>SANKSI</b></p>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">1.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Perusahaan berhak menuntut dan memberikan sanksi kepada karyawan atas segala kelalaian dan pelanggaran terhadap isi surat perjanjian ini.</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">2.</td>
                        <td style="width: 200px; font-size: 8px; text-align: justify"> Atas segala kelalaian dan pelanggaran yang di lakukan oleh karyawan, maka selain sanksi pemberian surat peringatan tertulis, diberhentikan perusahaan juga berhak meminta pertanggungjawaban dan ganti rugi kepada karyawan, serta akan di serahkan kepada pihak yang berwajib.</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">
                        </td>
                        <td>
                            <p style="text-align: center; font-size:10px"><b>PASAL 9<br>TIADA PERSAINGAN</b></p>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;"></td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Karyawan menyetujui bahwa selama jangka waktu perjanjian ini, dia tidak dapat mengadakan hubungan kerja dengan pihak lain tanpa terlebih dahulu mengajukan permohonan pengunduran diri dan mendapat persetujuan tertulis dari perusahaan.</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;">
                        </td>
                        <td>
                            <p style="text-align: center; font-size:10px"><b>PASAL 10<br>LAIN-LAIN</b></p>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width: 12px;"></td>
                        <td style="width: 200px; font-size: 8px; text-align: justify">Hal-hal yang belum diatur dalam perjanjian kerja ini akan diputskan oleh perusahaan dengan kebijaksanaan berdasarkan peraturan perundang- udangan yang berlaku.</td>
                    </tr>
                </table>
            </td>
            <td style="width: 8%;"></td>
            <td style="width: 45%;">
                <table>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-size:8;">
                            Bandung.................................
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; width:130px">
                            PIHAK PERTAMA
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            ERNA MULYANI
                            <br>
                            PERSONALIA
                        </td>
                        <td style="font-size: 8px;">PIHAK KEDUA<br><br><br><br>Materai Tempel<br><br><br><br>ISMAIL GILANG MAULANA</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>