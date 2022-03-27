Dear Customer,<br><br>
Pesanan a.n <b>[var.rep_namacust;noerr;] [Kode Pesan : [var.rep_kodebook;noerr;]]</b> sudah kami terima dan pesanan tersebut sudah dalam proses.<br>
Total pembayaran pesanan anda adalah Rp. <b>[var.rep_totalbayar;noerr;].</b><br>
Adapun detail pesanan sebagai berikut : <br>
<table width="700" border="1" style="background-color:#FFFFFF;border-collapse:collapse;border:1px solid #000000;color:#000000;" cellpadding="3" cellspacing="3">
  <tr>
    <td width="5" align="center">No</td>
    <td width="295" align="center">Nama Pesanan</td>
    <td width="80" align="center">Qty</td>
    <td width="120" align="center">Harga</td>
    <td width="200" align="center">Keterangan</td>
  </tr>
  <tr>
    <td>[blksql.#; block=tr;noerr]</td>
    <td>[blksql.vNamaBarang; block=tr;noerr;]</td>
    <td align="right">[blksql.vQty; block=tr;noerr;]</td>
    <td align="right">[blksql.vTotalHarga; block=tr;frm='0,000.';noerr;]</td>
    <td>[blksql.cKeterangan; block=tr;noerr;]</td>
  </tr>
</table>
Jika ada yang ingin di konfirmasikan maka dapat menghubungi 021-7551234<br><br>
Regards,<br>
Management DutaRESTO<br>