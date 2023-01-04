<?php
switch($_GET['aksi']){
case "tampil": //untuk mengakses aksi=tampil
echo "<h3>Data Penduduk Pindah</h3>";
echo "<a href='?modul=penduduk_pindah&aksi=tambah'><div class='tomboltambah'>Tambah Data Penduduk Pindah</div></a><br>";
$query=mysqli_query($conn,"SELECT * FROM penduduk_keluar order by nik"); 
echo "<table class='tabel' border='1' minWidth='600px'>
<tr>
<th>No</th>
<th>NIK</th>
<th>Nama Penduduk</th>
<th>Tempat Lahir</th>
<th>Tanggal Lahir</th>
<th>Pindah Ke</th>
<th>Edit</th>
<th>Hapus</th>
</tr>"; 
$nomor=1; 
while($tampil=mysqli_fetch_array($query))
{
echo "<td>$nomor</td>";
echo "<td>$tampil[nik]</td>";
echo "<td>$tampil[nama]</td>";
echo "<td>$tampil[tempat_lahir]</td>";
echo "<td>$tampil[tanggal_lahir]</td>";
echo "<td>$tampil[pindah]</td>";
echo "<td><a href='?modul=penduduk_pindah&aksi=edit&nik=$tampil[nik]'>edit</a></td>"; 
echo "<td><a href='?modul=penduduk_pindah&aksi=aksihapus&nik=$tampil[nik]' onclick='return confirm(\"Anda Yakin Menghapus Data Ini?\")'>hapus</a></td>";
echo "</tr>";
$nomor++; 
}
echo "</table>";
break;
case "tambah": //untuk interface tambah barang
echo "<span style='font-size:18pt; font-weight:bold;'>Tambah Data Penduduk Pindah</span></br></br>
<form method='POST' action='?modul=penduduk_pindah&aksi=aksitambah'>
<table class='forminput'>
<tr>
<td>NIK</td><td>: <input type='text' name='nik' maxlength='20' required='required' oninput='setCustomValidity(\"\")' oninvalid='this.setCustomValidity(\"Isi Kode Barang..!\")'/></td>
</tr>
<tr>
<td>Nama Penduduk</td><td>: <input type='text' name='nama' maxlength='50' required='required' oninput='setCustomValidity(\"\")' oninvalid='this.setCustomValidity(\"Isi Nama Barang..!\")'/></td>
</tr>
<td>Tempat Lahir</td><td>: <input type='text' name='tempat_lahir' maxlength='20' required='required' oninput='setCustomValidity(\"\")' oninvalid='this.setCustomValidity(\"Isi tempat_lahir Barang..!\")'/></td>
</tr>
<tr>
<td>Tanggal Lahir</td><td>: <input type='date' name='tanggal_lahir' required='required' oninput='setCustomValidity(\"\")' oninvalid='this.setCustomValidity(\"Isi Harga Barang..!\")'/></td>
</tr>
</tr>
<td>Pindah Ke</td><td>: <input type='text' name='pindah' maxlength='50' required='required' oninput='setCustomValidity(\"\")' oninvalid='this.setCustomValidity(\"Isi tempat_lahir Barang..!\")'/></td>
</tr>
<tr><td colspan='2'><input type='submit' value='Simpan'/><input type='submit' value='Batal' onclick='self.history.back()'/></tr>
<tr></tr>
</table>
";
break;
case "aksitambah": //untuk aksi tambah barang
$sql = mysqli_query($conn,"INSERT INTO penduduk_keluar 
(nik,nama,tempat_lahir,tanggal_lahir,pindah) 
values (
'$_POST[nik]',
'$_POST[nama]',
'$_POST[tempat_lahir]',
'$_POST[tanggal_lahir]',
'$_POST[pindah]')
");  
if (!$sql)
        {
        echo '<script>alert(\'Data Gagal Dimasukkan\')
            setTimeout(\'location.href="?modul=penduduk_pindah&aksi=tampil"\' ,0);</script>';
        }else
        {
        echo '<script>alert(\'Data Berhasil Dimasukkan\')
            setTimeout(\'location.href="?modul=penduduk_pindah&aksi=tampil"\' ,0);</script>';
}
break;
case "edit": //untuk interface edit
$tampil = mysqli_fetch_array(mysqli_query($conn,"select * from penduduk_keluar where nik = '$_GET[nik]'"));
echo "<span style='font-size:18pt; font-weight:bold;'>Edit Data Penduduk</span></br></br>
<form method='POST' action='?modul=penduduk_pindah&aksi=aksiedit'>
<table class='forminput'>
<tr>
<td>NIK</td><td>: <input type='text' value='$tampil[nik]' readonly name='nik' maxlength='20' required='required' oninput='setCustomValidity(\"\")' oninvalid='this.setCustomValidity(\"Isi Kode Barang..!\")'/></td>
</tr>
<tr>
<td>Nama Penduduk</td><td>: <input type='text' value='$tampil[nama]' name='nama' maxlength='50' required='required' oninput='setCustomValidity(\"\")' oninvalid='this.setCustomValidity(\"Isi Nama Barang..!\")'/></td>
</tr>
<td>Tempat Lahir</td><td>: <input type='text' value='$tampil[tempat_lahir]' name='tempat_lahir' maxlength='20' required='required' oninput='setCustomValidity(\"\")' oninvalid='this.setCustomValidity(\"Isi tempat_lahir Barang..!\")'/></td>
</tr>
<tr>
<td>Tanggal Lahir</td><td>: <input type='date' value='$tampil[tanggal_lahir]' name='tanggal_lahir' required='required' oninput='setCustomValidity(\"\")' oninvalid='this.setCustomValidity(\"Isi Harga Barang..!\")'/></td>
</tr>
</tr>
<td>Pindah Ke</td><td>: <input type='text' value='$tampil[pindah]' name='pindah' maxlength='50' required='required' oninput='setCustomValidity(\"\")' oninvalid='this.setCustomValidity(\"Isi tempat_lahir Barang..!\")'/></td>
</tr>
<tr><td colspan='2'><input type='submit' value='Simpan'/><input type='button' value='Batal' onclick='self.history.back()'/></tr>
<tr></tr>
</table>
";
break;
case "aksiedit": //untuk aksi mengedit barang
$sql = mysqli_query($conn,"update penduduk_keluar set
nama = '$_POST[nama]',
tempat_lahir = '$_POST[tempat_lahir]',
tanggal_lahir = '$_POST[tanggal_lahir]',
pindah = '$_POST[pindah]'
where nik = '$_POST[nik]'");  
if (!$sql)
        {
        echo '<script>alert(\'Data Gagal Diubah\')
            setTimeout(\'location.href="?modul=penduduk_pindah&aksi=tampil"\' ,0);</script>';
        }else
        {
        echo '<script>alert(\'Data Berhasil Diubah\')
            setTimeout(\'location.href="?modul=penduduk_pindah&aksi=tampil"\' ,0);</script>';
        }
break;
case "aksihapus": //untuk aksi menghapus data barang
$sql = mysqli_query($conn,"delete from penduduk where nik = '$_GET[nik]'");  
if (!$sql)
        {
        echo '<script>alert(\'Data Gagal Dihapus\')
            setTimeout(\'location.href="?modul=penduduk_pindah&aksi=tampil"\' ,0);</script>';
        }else
        {
        echo '<script>setTimeout(\'location.href="?modul=penduduk_pindah&aksi=tampil"\' ,0);</script>';
        }
break;
}
?>
