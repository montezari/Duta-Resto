<table class="table table-bordered">
<thead>
<tr>
    <th width="8%">Tanggal</th>
    <th>Tgl </th>
    <th>Total Invoice</th>
    <th>Tunai</th>
    <th>CC/Debit</th>
</tr>
</thead>
<tbody>
<tr>
    <td>[grid_blk.cNoInv;noerr;block=tr]</td>
    <td>[grid_blk.dTglInv;frm='dd/mm/yyyy';noerr;block=tr]</td>
    <td class="text-right">[grid_blk.nInvNetto;frm='0,000.00';noerr;block=tr]</td>
    <td class="text-right">[grid_blk.vTotalTunai;frm='0,000.00';noerr;block=tr]</td>
    <td class="text-right">[grid_blk.vTotalDKCard;frm='0,000.00';noerr;block=tr]</td>
</tr>
</tbody>
<tfoot>
    <td colspan="2" class="text-right">TOTAL</td>
    <td class="text-right">[var.vsumtotal;frm='0,000.00';noerr;block=tr]</td>
    <td class="text-right">[var.vsumcash;frm='0,000.00';noerr;block=tr]</td>
    <td class="text-right">[var.vsumcc;frm='0,000.00';noerr;block=tr]</td>
</tfoot>  
</table>
