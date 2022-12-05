<x-admin-master>
    @section('content')

        <div class="row">
            <div class="col-sm-12">
                <h1>Permission</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                @if (session()->has('permission-deleted'))
                <div class="alert alert-danger">
                    {{ session('permission-deleted') }}
                </div>
                @endif               
            </div>
        </div>
        <div class="row">
            
            <div class="col-sm-3">
                <form action="{{ route("permissions.store") }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="permission Name">Name</label>
                        <input type="text" class="form-control" name="name" id="name">
                        <div>
                            @error('name')
                                <span><strong style="color: red">{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-block" style="width: 100%">Add permission</button>
                </form>
            </div>

            <div class="col-sm-9">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">permissions</h6>
                      </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered bg-dark text-white" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NAME</th>
                                        <th>SLUG</th>
                                        <th>CREATED</th>
                                        <th>UPDATED</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                            <td>{{ $permission->id }}</td>
                                            <td><a href="{{ route('permissions.edit',$permission->id) }}">{{ $permission->name }}</a></td>
                                            <td>{{ $permission->slug }}</td>
                                            <td>{{ $permission->created_at->diffForHumans() }}</td>
                                            <td>{{ $permission->updated_at->diffForHumans() }}</td>
                                            <td>
                                                <form action="{{ route('permissions.destroy',$permission->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button 
                                                    class="btn btn-success"
                                                    @if ($permission->name == "View Dashboard")
                                                        disabled
                                                    @endif
                                                    >DELETE</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>                    
                </div>                
            </div>

        </div>
    @endsection
</x-admin-master>