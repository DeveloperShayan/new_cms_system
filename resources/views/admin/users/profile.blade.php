{{-- <x-admin-top-navbar-information>
</x-admin-top-navbar-information> --}}




<x-admin-master>
    @section('content')
        <h1>Account Holder : {{ $user->name }}</h1>
        <div class="row">
            <div class="col-sm-6">
                <form method="post" action="{{ route('user.profile.update',$user) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <img class="img-profile rounded-circle" src="{{ $user->avatar }}" alt="">
                    </div>
                    <div class="form-group">
                        <input type="file" name="avatar">
                    </div>
 
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input 
                        id="username" 
                        class="form-control {{ $errors->has('username') ? 'is-invalid' : ''}}" 
                        type="text" 
                        name="username"
                        value="{{ $user->username }}"
                        >
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror                        

                    </div>                    
                    <div class="form-group">
                        <label for="Name">Name</label>
                        <input 
                        id="name" 
                        class="form-control" 
                        type="text" 
                        name="name"
                        value="{{ $user->name }}"
                        >
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input 
                        id="email" 
                        class="form-control" 
                        type="text" 
                        name="email" 
                        value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input 
                        id="password" 
                        class="form-control" 
                        type="password" 
                        name="password" 
                        {{-- value="{{ $user->password }}" --}}
                        >
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">Password-Confirm</label>
                        <input 
                        id="password-confirm" 
                        class="form-control" 
                        type="password" 
                        name="password-confirm"
                        >
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="form-control btn btn-success" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
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
                                        <th>ATTACH</th>
                                        <th>DETACH</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td><input 
                                                type="checkbox"
                                                @foreach ($user->roles as $user_role)
                                                    @if ($user_role->slug==$role->slug)
                                                            checked
                                                    @endif  
                                                @endforeach
                                                >
                                            </td>
                                            <td>{{ $role->id }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->slug }}</td>
                                            <td>
                                                <form action="{{ route('user.role.attach',$user) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="role" value="{{ $role->id }}">
                                                    <button 
                                                    class="btn btn-success"
                                                    type="submit"
                                                    @if ($user->roles->contains($role))
                                                        disabled
                                                    @endif
                                                    >Attach</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('user.role.detach',$user) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="role" value="{{ $role->id }}">
                                                    <button 
                                                    class="btn btn-danger"
                                                    type="submit"
                                                    @if (!$user->roles->contains($role))
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
            </div>
        </div>

    @endsection
</x-admin-master>