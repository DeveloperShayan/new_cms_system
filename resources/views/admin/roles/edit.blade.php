<x-admin-master>
    @section('content')
        <h1>Edit Role : {{ $role->name }}</h1>
        <div class="row">
            <div class="col-sm-12">
                @if (session()->has('role-updated'))
                <div class="alert alert-success">
                    {{ session('role-updated') }}
                </div>
                @endif               
            </div>            
        </div>

        <div class="row">
            <div class="col-sm-6">
                <form action="{{ route('roles.update',$role->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="Name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $role->name }}" @if ($role->name == "Admin")
                            readonly
                        @endif />
                    </div>
                    <button class="btn btn-success btn-block" type="submit" @if ($role->name == "Admin")
                        disabled
                    @endif>Update</button>
                </form>                
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @if ($permissions->isNotEmpty())
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
                      </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered bg-dark text-white" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>OPTION</th>
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
                                            <td><input 
                                                type="checkbox"
                                                @foreach ($role->permissions as $role_permission)
                                                    @if ($role_permission->slug==$permission->slug)
                                                            checked
                                                    @endif  
                                                @endforeach
                                                >
                                            </td>
                                            <td>{{ $permission->id }}</td>
                                            <td><a href="">{{ $permission->name }}</a></td>
                                            <td>{{ $permission->slug }}</td>
                                            <td>{{ $permission->created_at->diffForHumans() }}</td>
                                            <td>{{ $permission->updated_at->diffForHumans() }}</td>
                                            <td>
                                                <form action="{{ route('role.permission.attach',$role) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="permission" value="{{ $permission->id }}">
                                                    <button 
                                                    class="btn btn-success"
                                                    type="submit"
                                                    @if ($role->permissions->contains($permission))
                                                        disabled
                                                    @endif
                                                    >Attach</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('role.permission.detach',$role) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="permission" value="{{ $permission->id }}">
                                                    <button 
                                                    class="btn btn-success"
                                                    type="submit"
                                                    @if (!$role->permissions->contains($permission))
                                                        disabled
                                                    @endif
                                                    >Detach</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>                    
                </div>                    
                @endif                
            </div>
        </div>


    @endsection
</x-admin-master>