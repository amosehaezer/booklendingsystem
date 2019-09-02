@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-6">
     <div class="form-group">
      <label>Tgl Awal</label>
      <div class="input-group date">
       <div class="input-group-addon">
              <span class="glyphicon glyphicon-th"></span>
          </div>
          <input placeholder="masukkan tanggal Awal" type="text" class="form-control datepicker" name="tgl_awal">
      </div>
     </div>
     <div class="form-group">
      <label>Tgl Akhir</label>
      <div class="input-group date">
       <div class="input-group-addon">
              <span class="glyphicon glyphicon-th"></span>
          </div>
          <input placeholder="masukkan tanggal Akhir" type="text" class="form-control datepicker" name="tgl_akhir">
      </div>
     </div>
    </div>
   </div>

   <script type="text/javascript">
    $(function(){
     $(".datepicker").datepicker({
         format: 'yyyy-mm-dd',
         autoclose: true,
         todayHighlight: true,
     });
    });
   </script>
@endsection