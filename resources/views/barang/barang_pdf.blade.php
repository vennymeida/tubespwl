<!DOCTYPE html>
<html>
    <head>
        <title>2ND MOBIL BEKAS</title>
    </head>
    <body>
        <style type="text/css">
        table tr td,
        table tr th{
            font-size: 9pt;
        }
        </style>
        <center>
            <h5>DATA MOBIL YANG DIJUAL</h4>
        </center>
        <table class='table table-bordered' style="width:95%;margin:0 auto;">
        <thead>
            <tr>
                <th>Merk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Keterangan</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barang as $a)
            <tr>
                <td>{{ $a->merk }}</td>
                <td>{{ $a->harga }}</td>
                <td>{{ $a->stok }}</td>
                <td>{{ $a->keterangan }}</td>
                <td><img width="100px" height="100px"src="{{storage_path('app/public/'.$a->featured_image) }}"></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>