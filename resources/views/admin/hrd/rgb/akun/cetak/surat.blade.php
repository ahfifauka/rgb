<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Penugasan Security</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table {
            font-size: 11px;
        }

        .card-header {
            margin-top: 0;
            padding-top: 0;
            top: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title" style="text-align: center;">PT RAJAWALI BUANA - 86 <br> SECURITY SYSTEM</h2>
                <h5 class="card-title" style="text-align: center; text-transform:uppercase"><u>SURAT PERINTAH TUGAS
                        {{ $data->status }}</u> <br>
                    {{ $data->no_surat }}</h5>
            </div>
            <div class="card-body">
                <table style="width: 90%; display:flex;">
                    <tr>
                        <td style="width: 100px; vertical-align:baseline">
                            Dasar :
                        </td>
                        <td style="width: 430px; height:70px">
                            <ol type="1">
                                <li style="text-align: justify;">Surat Perjanjian <b>NO. : 010/MKT/RGB-86 SS/MoU/VI/2023
                                        tanggal 00 000 0000</b> tentang Kerjasama Jasa Pengamanan antara RAJAWALI GARDA
                                    BUANA-86 SECURITY SERVICE dengan UNIT, Surat Perjanjian <b>No.
                                        000/PKWT/HRD/RGB-86SS/V1/2023</b> tentang kontrak kerja </li>
                            </ol>

                        </td>
                    </tr>
                    <tr>
                        <td style="width: 118px;">
                            Memerintahkan :
                        </td>
                        <td style="height: 20px;">
                            <b style="text-transform: uppercase">{{ $data->name }} </b>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 115px;">
                            Pindah Area :
                        </td>
                        <td style="height: 30px;">
                            <b style="text-transform: uppercase"> {{ $data->area }} </b>
                        </td>
                    </tr>
                </table>
                <br>
                <table style="width: 90%; display:flex; margin:auto">
                    <tr>
                        <td style="width: 100px; ">
                            Untuk :
                        </td>
                        <td style="width: 430px; height:140px">
                            <ol type="1">
                                <li style="text-align: justify;"> Melaksanakan tugas pengamanan dilingkungan (UNIT)
                                    sesuai dengan standar oprasional kerja RAJAWALI GARDA BUANA-86 SECURITY SYSTEM.</li>
                                <li> Melaporkan setiap perkembangan situasi dilingkungan kerja kepada manajemen
                                    perusahaan</li>
                                <li> Mencatat setiap kejadian/peristiwa yang terjadi di lingkungan perusahaan di buku
                                    mutasi yang sudah disiapkan</li>
                                <li style="text-align: justify;"> Melaksanakan tugas dengan waspada, cermat dan teliti
                                </li>
                                <li style="text-align: justify;"> Tugas di laksanakan sesuai dengan prosedur & jadwal
                                    kerja yang telah ditetapkan</li>
                            </ol>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 120px;">
                            Catatan :
                        </td>
                        <td style="height: 30px;">
                            Surat perintah tugas ini berlaku sampai dengan ada pencabutan
                        </td>
                    </tr>
                </table>
                <table style="width: 90%; display:flex; margin:auto">
                    <tr>
                        <td style="width: 300px;"></td>
                        <td style="display: flex; justify-content:space-between; width:100px">
                            DIkeluarkan :
                        </td>
                        <td>
                            Bandung
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="display: flex; justify-content:space-between; width:100px">
                            Tanggal :
                        </td>
                        <td>
                            {{ \Carbon\Carbon::now()->toDateString() }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 255px;"></td>
                        <td colspan="2" style="text-align: center;">
                            <b>RAJAWALI GARDA BUANA-86</b> <br>SECURITY SERVICE
                            <br><br><br><br>
                            <u>(ERNA MULYANI)</u><br>HRD. Dept
                        </td>
                    </tr>
                </table>
                <table style="width: 90%; display:flex; margin:auto">
                    <tr>
                        <td style="display: flex; gap:2px; width:30px">
                            Cc :
                        </td>
                        <td>
                            <ul type="none">
                                <li>- Man Oprational</li>
                                <li>- Payroll</li>
                                <li>- Arsip</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 100px;"></td>
                        <td style="width:100px"></td>
                        <td style="text-align: center; width:100px">
                            (Amran BHS)<br> Man Ops
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
