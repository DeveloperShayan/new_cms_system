<x-admin-master>
    @section('content')
        <h1>Users</h1>

        @if (Session('user-deleted'))

        <div class="alert alert-danger">{{ Session::get('user-deleted') }}</div>

      @elseif (Session('user-created-message'))

      <div class="alert alert-success">{{ Session::get('user-created-message') }}</div>
     
      @elseif (Session('user-updated-message'))

      <div class="alert alert-secondary">{{ Session::get('user-updated-message') }}</div>
      
      @endif



        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>USERNAME</th>
                      <th>AVATAR</th>                     
                      <th>NAME</th>
                      <th>EMAIL</th>
                      <th>CREATED AT</th>
                      <th>UPDATED AT</th>
                      <th>DELETE</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($users as $user)
                      <tr>
                        <td>{{ $user->id }}</td>
                        <td><a href="{{ route('user.profile.show',$user->id) }}">{{ $user->username }}</a></td>
                        <td><img src="{{ asset('storage/$user->avatar') }}" alt="" height="100px"></td>
                        <td><a>{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                        <td>{{ $user->updated_at->diffForHumans() }}</td>
                        <td>
                            <form action="{{ route('user.destroy',$user->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-success">DELETE</button>
                            </form>
                        </td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div>
        
        <div class="d-flex">
            <div class="mx-auto">
              {{-- {{ $users->links('pagination::bootstrap-4') }} --}}
            </div>
                 
        </div>     
    @endsection

    @section('scripts')
            <!-- Page level plugins -->
            <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

            <!-- Page level custom scripts -->
            <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

    @endsection

</x-admin-master>