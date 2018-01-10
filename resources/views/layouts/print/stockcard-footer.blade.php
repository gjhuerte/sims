<div id="footer" class="col-sm-12">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th class="col-sm-1">  Prepared By: </th>
        <th class="col-sm-1">  Approved By: </th>
        {{-- <th class="col-sm-1">   </th> --}}
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="text-center">
          <br />
          <br />
          <span id="name" style="margin-top: 30px; font-size: 15px;"> {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
          <br />
          <span id="office" class="text-center" style="font-size:10px;">{{ App\Office::findByCode(Auth::user()->office)->name }}</span>
        </td>
        <td class="text-center">
          <br />
          <br />
          <span id="name" class="text-muted" style="margin-top: 30px; font-size: 15px; ">{{ (App\Office::findByCode(Auth::user()->office)->head != '') ? App\Office::findByCode(Auth::user()->office)->head : '[ Signature Over Printed Name ]' }}</span>
          <br />
          <span id="office" class="text-center" style="font-size:10px;">{{ App\Office::findByCode(Auth::user()->office)->name }}</span>
        </td>
        {{-- <td></td> --}}
      </tr>
    </tbody>
  </table>
</div>