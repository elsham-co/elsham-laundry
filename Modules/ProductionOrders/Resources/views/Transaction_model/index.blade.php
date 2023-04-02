@extends('layouts.admin')
@section('title')
اضافه و متابعه الوجبات
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/css/dataTables.bootstrap4.css')}}">
@endsection

@section('contentheader')
اضافه الوجبه للانتاج 
@endsection



@section('contentheaderactive')
عرض
@endsection



@section('content')


<div class="card">
  <div class="card-header">
    <h3 class="card-title"> حركه الموديلات بالتفصيل</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>الموديل</th>
        <th>الحركه</th>
        <th>التاريخ</th>

      </tr>
      </thead>
      <tbody>
        @foreach ($data as $info )

      <tr>
        {{-- <td>{{ $info->client_M->client_name  }}</td> --}}
        <td>{{ $info->transaction_M->model_name  }}</td>
        <td>{{ $info->transaction }}</td>
        <td>{{ $info->created_at }}</td>
      </tr>

      @endforeach

      </tfoot>
    </table>
  </div>
  <!-- /.card-body -->
</div>

@endsection

@section('script')

<script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>

<script src="{{ asset('assets/admin/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery.dataTables.js') }}"></script>

<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

@endsection


