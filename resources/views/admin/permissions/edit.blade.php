<x-admin-master>

    @section('content')
        
    <h1>Edit Permission : {{ $permission->name }}</h1>
    <div class="row">
        <div class="col-sm-12">
            @if (session()->has('permission-updated'))
            <div class="alert alert-success">
                {{ session('permission-updated') }}
            </div>
            @endif               
        </div>            
    </div>

    <div class="row">
        <div class="col-sm-6">
            <form action="{{ route('permissions.update',$permission->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $permission->name }}" @if ($permission->name == "View Dashboard")
                        readonly
                    @endif />
                </div>
                <button class="btn btn-success btn-block" type="submit" @if ($permission->name == "View Dashboard")
                    disabled
                @endif>Update</button>
            </form>                
        </div>
    </div>


    @endsection

</x-admin-master>