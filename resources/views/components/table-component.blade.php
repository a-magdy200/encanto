<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="datatable" class="datatable table table-bordered table-striped">
                        <thead>
                        <tr>
                            @foreach($headings as $heading)
                                <th>{{$heading}}</th>
                            @endforeach
                            @if($actions)
                                <th colspan="all">Actions</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                @foreach($item as $key => $value)
                                    @if($key === 'is_banned')
                                        <td>
                                            @if($item['is_banned'])
                                                <a href="{{$resource}}/restore" class="btn btn-success ml-2">U<i class="fa fa-check"></i></a>
                                            @else
                                                <a href="{{$resource}}/ban" class="btn btn-danger ml-2"><i class="fa fa-ban"></i></a>
                                            @endif
                                        </td>
                                    @else
                                        <td>{{$value}}</td>
                                    @endif
                                @endforeach
                                @if($actions)
                                    <td class="d-flex align-items-center">
                                        <a href="{{$resource}}/{{$item['id']}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                        <a href="{{$resource}}/{{$item['id']}}/edit" class="btn btn-warning mx-2"><i class="fa fa-edit"></i></a>
                                        <a href="{{$resource}}/{{$item['id']}}/danger" class="btn btn-danger"><i class="fa fa-times"></i></a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
