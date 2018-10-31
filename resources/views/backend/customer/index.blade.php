@extends('backend.layout')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Khách hàng nhận số
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'customer.index') }}">Khách hàng nhận số</a></li>
    <li class="active">Danh sách</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      @if(Session::has('message'))
      <p class="alert alert-info" >{{ Session::get('message') }}</p>
      @endif     
      <a href="{{ route('customer.create') }}" class="btn btn-info btn-sm" style="margin-bottom:5px">Thêm khách hàng</a>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Bộ lọc</h3>
        </div>
        <div class="panel-body">
          <form class="form-inline" role="form" method="GET" action="{{ route('customer.index') }}" id="frmContact">                                                
            <div class="form-group">
              <label for="name">Email :</label>
              <input type="text" class="form-control" name="email" value="{{ $email }}">
            </div>
            <div class="form-group">
              <label for="name">&nbsp;&nbsp;Phone :</label>
              <input type="text" class="form-control" name="phone" value="{{ $phone }}">
            </div>
            <div class="form-group">
              <label for="name">&nbsp;&nbsp;Trạng thái :</label>
              <select class="form-control" name="status" id="status">
                <option value="">--Tất cả--</option>
                <option value="1" {{ $status == 1  ? "selected" : "" }}>Chưa gửi số</option>
                <option value="2" {{ $status == 2  ? "selected" : "" }}>Đã gửi số</option>
              </select>
            </div>
            <button type="submit" class="btn btn-default">Lọc</button>
          </form>         
        </div>
      </div>
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Danh sách ( <span class="value">{{ $items->total() }} liên hệ )</span></h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
        <!-- <a href="{{ route('customer.export') }}" class="btn btn-info btn-sm" style="margin-bottom:5px;float:right" target="_blank">Export</a> -->
          <div style="text-align:center">
            {{ $items->appends( ['status' => $status, 'email' => $email, 'phone' => $phone] )->links() }}
          </div>  
          <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width: 1%">#</th>                            
              <th>Username</th>
              <th>Email</th>
              <th>Số điện thoại</th>
              <th>Quy đổi</th>
              <th>Thời gian</th>
              <th width="10%">Thời gian gửi</th>
              <th width="1%;white-space:nowrap">Thao tác</th>
            </tr>
            <tbody>
            @if( $items->count() > 0 )
              <?php $i = 0; ?>
              @foreach( $items as $item )
                <?php $i ++; ?>
              <tr id="row-{{ $item->id }}">
                <td><span class="order">{{ $i }}</span></td>                       
                <td>                  
                  
                  @if($item->username != '')
                  {{ $item->username }}</br>
                  @endif
                </td>
                <td>
                  @if($item->email != '')
                  <a href="{{ route( 'customer.edit', [ 'id' => $item->id ]) }}">{{ $item->email }}</a>
                  @endif
                </td>
                <td>
                  @if($item->phone != '')
                  {{ $item->phone }}</br>
                  @endif
                </td>
                <td>                  
                  {{ $item->type == 1 ? "Quy Đổi Tiền Gửi" : "Quy Đổi Tiền Thua Cược" }}
                </td>
                <td>
                  {{ date('d/m/Y', strtotime($item->date_from)) }} - {{ date('d/m/Y', strtotime($item->date_to)) }}
                </td>
                <td style="white-space:nowrap">{{ date('d-m-Y H:i', strtotime($item->created_at)) }}</td>
                <td style="white-space:nowrap;text-align: right;">   
                                                                 
                  <a class="btn btn-success btn-sm" href="{{ route('customer.edit', [ 'id' => $item->id ])}}" ><span class="badge">{{ $item->giftCode->count() }}</span> Số </a>
                 
                  <a href="{{ route( 'customer.edit', [ 'id' => $item->id ]) }}" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
                  <a onclick="return callDelete('{{ $item->username }}','{{ route( 'customer.destroy', [ 'id' => $item->id ]) }}');" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a>
                  
                </td>
              </tr> 
              @endforeach
            @else
            <tr>
              <td colspan="9">Không có dữ liệu.</td>
            </tr>
            @endif

          </tbody>
          </table>
          <div style="text-align:center">
            {{ $items->appends( ['status' => $status, 'email' => $email, 'phone' => $phone] )->links() }}
          </div>  
        </div>        
      </div>
      <!-- /.box -->     
    </div>
    <!-- /.col -->  
  </div> 
</section>
<!-- /.content -->
</div>
@stop
@section('javascript_page')
<script type="text/javascript">
function callDelete(name, url){  
  swal({
    title: 'Bạn muốn xóa "' + name +'"?',
    text: "Dữ liệu sẽ không thể phục hồi.",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes'
  }).then(function() {
    location.href= url;
  })
  return flag;
}
$(document).ready(function(){
  $('#status').change(function(){
    $('#frmContact').submit();
  });
  $('.change-status').click(function(){
    if(confirm('Đã gửi số cho khách hàng ?')){
    var obj = $(this);
    $.ajax({
      url: "{{ route('update-status')}}",
      data:{
        column : obj.data('column'),
        value : obj.data('value'),
        table : obj.data('table'),
        id : obj.data('id')
      },
      type : 'GET',
      success : function(data){
        window.location.reload();
      }
    });
    }
  });
});
</script>
@stop