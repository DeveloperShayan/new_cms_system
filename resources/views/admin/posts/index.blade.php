<x-admin-master>

    @section('content')
        <h1>All Posts</h1>

          @if (Session('message'))

            <div class="alert alert-danger">{{ Session::get('message') }}</div>

          @elseif (Session('post-created-message'))

          <div class="alert alert-success">{{ Session::get('post-created-message') }}</div>
         
          @elseif (Session('post-updated-message'))

          <div class="alert alert-secondary">{{ Session::get('post-updated-message') }}</div>
          
          @endif

          <!-- DataTales Example -->
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
                      <th>Owner</th>                     
                      <th>TITLE</th>
                      <th>POST IAMGE</th>
                      <th>CREATED AT</th>
                      <th>UPDATED AT</th>
                      <th>DELETE</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($posts as $post)
                      <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td><a href="{{ route('post.edit',$post->id) }}">{{ $post->title }}</a></td>
                        <td><img src="{{ $post->post_image }}" alt="" height="100px"></td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>
                        <td>{{ $post->updated_at->diffForHumans() }}</td>
                        <td>
                          @can('view', $post)

                          <form action="{{ route('post.destroy',$post->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                          </form>

                          @endcan
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
              {{ $posts->links('pagination::bootstrap-4') }}
            </div>
                 
          </div>     
    @endsection

    @section('scripts')
            <!-- Page level plugins -->
            <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

            <!-- Page level custom scripts -->
            {{-- <script src="{{ asset('js/demo/datatables-demo.js') }}"></script> --}}

    @endsection

</x-admin-master>