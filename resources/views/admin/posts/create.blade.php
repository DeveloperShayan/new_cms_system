<x-admin-master>
    
    @section('content')
    
        <h1>Create</h1>

            <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                   <label for="">Title</label>
                   <input 
                    type="text" 
                    class="form-control" 
                    id="title" 
                    name="title" 
                    placeholder="Enter a Title"> 
                </div>
 
                 <div class="form-group">
                    <label for="">File</label>
                    <input 
                     type="file" 
                     class="form-control" 
                     id="post_image" 
                     name="post_image" 
                     placeholder="Enter a Title"> 
                 </div>                 

                 <div class="form-group">
                    <label for="">Body</label>
                    <textarea 
                        class="form-control" 
                        name="body" 
                        id="body" 
                        cols="30" 
                        rows="10"></textarea>
                 </div>

                 <button type="submit" class="btn btn-primary">Add Post</button>

            </form>

    @endsection

</x-admin-master>