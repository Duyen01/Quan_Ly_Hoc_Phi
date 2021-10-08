<style type="text/css">
table {
    width: 100%;
    border-collapse: collapse;
}
th, td {
    padding: 8px;
    text-align: left;
    border: 1px solid #dee2e6;
    white-space: nowrap; /* Ngăn chặn văn bản xuống dòng */
}
</style>
<table style="width: 100%;border-collapse: collapse;border:1px solid black;">
  <tr>
    <th>FullName</th>
    <td>{{($bill->student->firstname) ." ".($bill->student->lastname)}}</td>
  </tr>
  <tr>
    <th>Type of Pay</th>
    <td>{{$typepay->typeofpay}}</td>
  </tr>
  <tr>
    <th>Money</th>
    <td>{{number_format($bill->money)}}</td>
  </tr>
  <tr>
    <th>Giáo vụ</th>
    <td>{{$bill->admin->name}}</td>
  </tr>
  <tr>
    <th>DateTime</th>
    <td>{{date('d-m-Y', strtotime($bill->dateTime));}}</td>
  </tr>
  <tr>
    <th>Note</th>
    <td>{{$bill->note}}</td>
  </tr>
  <tr>
    <td colspan="2"><p class="copyright">Designed by <a href="https://facebook.com/tranvanduc0207" target="_blank" title="TranVanDuc">TVD</a></p></td>
  </tr>
</table>