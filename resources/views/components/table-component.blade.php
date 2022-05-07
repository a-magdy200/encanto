<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
{{--                    <h3 class="card-title">{{$title}}</h3>--}}
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
