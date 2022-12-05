<x-admin-master>
    
    @section('content')
    
        <h1>Edit Post</h1>

            <form method="POST" action="{{ route('post.update',$post->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                   <label for="">Title</label>
                   <input 
                    type="text" 
                    class="form-control" 
                    id="title" 
                    name="title"
                    value="{{ $post->title }}" 
                    placeholder="Enter a Title"> 
                </div>
 
                 <div class="form-group">
                    <div><img src="{{ $post->post_image }}" alt="" width="200" height="50"></div>
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
                        rows="10">{{ $post->body }}</textarea>
                 </div>

                 <button type="submit" class="btn btn-primary">Add Post</button>

            </form>

    @endsection

</x-admin-master>