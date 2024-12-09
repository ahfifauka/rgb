<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Peringatan</title>
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
                <h5 class="card-title" style="text-align: center; text-transform:uppercase"><u>SURAT
                        {{ $data->status }} {{$data->jenis}}</u> <br>
                </h5>
            </div>
            <div class="card-body">
                <table style="width: 90%; display:flex;">
                    <tr>
                        <td style="width: 100px; vertical-align:baseline">
                            Keterangan :
                        </td>
                        <td style="width: 430px; height:40px">
                            <ol type="none">
                                <li style="text-align: justify;">{{$data->keterangan}}</li>
                            </ol>

                        </td>
                    </tr>
                    <tr>
                        <td style="width: 118px;">
                            Menyatakan :
                        </td>
                        <td style="height: 20px;">
                            <b style="text-transform: uppercase">{{ $data->name }} </b>
                        </td>
                    </tr>
                </table>
                <br>
                <table style="width: 90%; display:flex; margin:auto">
                    <tr>
                        <td style="width: 100px; ">
                            Untuk :
                        </td>
                        <td style="width: 430px; height:40px">
                            <ol type="1">
                                <li style="text-align: justify;"> Melakukan kesalahan Berat saat dalah pekerjaan berlangsung</li>
                                <li> Melakukan tindakan merugikan bagi RGB dan anggota RGB yang lain</li>
                            </ol>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 120px;">
                            Catatan :
                        </td>
                        <td style="height: 30px;">
                            Surat Peringatan ini berlaku di bulan ini
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