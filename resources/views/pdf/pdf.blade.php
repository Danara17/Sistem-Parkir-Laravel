<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Keuangan</title>
</head>
<body>
    <figure class="text-center mt-5" style="text-align: center;">
        <blockquote class="blockquote">
            <h3>Laporan Keuangan Go Parkir</h3>
        </blockquote>
        <figcaption class="blockquote-footer">
            Tanggal : {{ $waktu }} <cite>by -admin</cite>
        </figcaption>
    </figure>

    <p style="margin: 0">Mall : <span style="font-weight: bold">{{$mall}}</span></p>
    <table border="1" style="text-align: center;  border-collapse: collapse;
    border: 1px solid black; width: 100%;">
        <thead style="background-color: darkgray">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Platnomor</th>
                <th scope="col">masuk</th>
                <th scope="col">keluar</th>
                <th scope="col">Ruangan</th>
                <th scope="col">biaya</th>
            </tr>
        </thead>
        <tbody>
            @php $jumlah = 0; @endphp @foreach ($data as $pdf)
            <tr>
                <td class="text-secondary">{{$loop->iteration}}</td>
                <td style="font-weight: bold">{{$pdf->platnomor}}</td>
                <td>{{$pdf->tglmasuk}}</td>
                <td>{{$pdf->tglkeluar}}</td>
                <td>{{$pdf->lantai . $pdf->namaruang}}</td>
                <td>Rp. {{ number_format($pdf->biayaparkir, 0, ',', '.')}}</td>
            </tr>
            @php $jumlah += $pdf->biayaparkir; @endphp @endforeach

            <tr >
                <td colspan="5"  style="background-color: darkgray; font-weight: bold">Jumlah</td>
                <td style="font-weight: bold">
                    Rp. {{ number_format($jumlah, 0, ",", ".") }}
                </td>
            </tr>
        </tbody>
    </table>

</body>
</html>