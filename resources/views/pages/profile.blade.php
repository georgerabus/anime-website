@extends('layouts.app')

@section('title', 'Edit User')

@section('profile')
<div class="container">
    <div style="margin-top: 70px">
        <h2>Profile Settings</h2>
        @if(session()->has('success'))
            <div class="alert alert-success" x-data="{show:true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" >
                {{session()->get('success')}}
            </div>
        @endif
        <form action="{{ route('profile-update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="password">New Password</label>
                <input type="password" name="password" id="password" class="form-control">
                <small class="form-text text-muted">Leave blank if you don't want to change the password</small>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group mt-3">
                <label for="password_confirmation">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>            
            <div class="form-group mt-3">
                <label for="photo">Profile Photo</label>
                <input type="file" name="photo" id="photo" class="form-control-file" accept="image/*" onchange="uploadImage(event)">
                @error('photo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="mt-3">
                @if (auth()->user()->photo)
                    <img id="image-preview" src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Profile Picture" class="img-fluid" style="max-width: 400px;">
                @else
                    <img id="image-preview" src="{{ asset('default_photo.jpeg') }}" alt="Default Profile Picture" class="img-fluid" style="max-width: 400px;">
                @endif
            </div>
            
            <!-- Cropping Area -->
            <div class="mt-3" id="crop-area" style="display: none;">
                <button type="button" class="btn btn-primary mt-2" onclick="cropImage()">Crop Image</button>
            </div>
        
            <!-- Update Profile Button -->
            <button type="submit" class="btn btn-primary mt-4">Update Profile</button>
        </form>
    </div>
</div>

<script>
    var cropper;

    function uploadImage(event) {
        var formData = new FormData();
        formData.append('photo', event.target.files[0]);

        // Upload the image via AJAX
        fetch('/upload-photo', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token for security
            }
        }).then(response => response.json())
          .then(data => {
              if (data.success) {
                  var imageUrl = data.url;
                  
                  // Set the uploaded image in the preview area
                  var image = document.getElementById('image-preview');
                  image.src = imageUrl;
                  document.getElementById('crop-area').style.display = 'block'; // Show the crop area

                  // Initialize Cropper.js on the uploaded image
                  if (cropper) {
                      cropper.destroy();
                  }
                  cropper = new Cropper(image, {
                      aspectRatio: 1,  // Maintain a square aspect ratio for cropping
                      viewMode: 1,
                      preview: '#cropped-image-preview',
                  });
              } else {
                  alert('Image upload failed.');
              }
          })
          .catch(error => {
              console.error('Error uploading image:', error);
          });
    }

    function cropImage() {
    if (cropper) {
        var canvas = cropper.getCroppedCanvas({
            width: 200,  // Set the size for the cropped image
            height: 200,
        });

        // Convert the cropped image to a blob and send it via AJAX
        canvas.toBlob(function(blob) {
            var formData = new FormData();
            formData.append('croppedImage', blob);

            // Send cropped image via AJAX
            fetch('/save-cropped-image', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      // Hide the crop area
                      document.getElementById('crop-area').style.display = 'none';

                      // Destroy the Cropper.js instance to remove the cropping box
                      cropper.destroy();
                      cropper = null;

                      // Update the profile image preview with the newly cropped image
                      var imagePreview = document.getElementById('image-preview');
                      var newImageUrl = URL.createObjectURL(blob);  // Create a local URL for the cropped image
                      imagePreview.src = newImageUrl;
                  } else {
                      alert('Failed to save the cropped image.');
                  }
              })
              .catch(error => {
                  console.error('Error saving cropped image:', error);
              });
        });
    }
}


</script>



@endsection
