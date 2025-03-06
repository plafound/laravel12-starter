@extends('layouts.app-v2')

@section('title', __('Profile'))

@section('tambahan-head')
<!-- Tambahkan Cropper.js -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Account Profile</h3>
                    <p class="text-subtitle text-muted">
                        A page where users can change profile information
                    </p>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('profile.update') }}" method="post">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <label for="name" class="form-label">Name</label>
                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        class="form-control"
                                        value="{{$user->name}}"
                                        required autofocus autocomplete="name" />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        class="form-control"
                                        value="{{$user->email}}"
                                        required autocomplete="username" />
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                </div>
                                <div class="form-group mt-5">
                                    <x-primary-button>{{ __('Save') }}</x-primary-button>

                                    @if (session('status') === 'profile-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-success">{{ __('Saved.') }}</p>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div
                                class="d-flex justify-content-center align-items-center flex-column">
                                <p class="text-small">Role : {{ implode(', ', Auth::user()->getRoleNames()->toArray()) }}</p>
                                <div class="avatar avatar-2xl">
                                    @if (Auth::user()->avatar)
                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" />
                                    @else
                                    <img src="./assets/compiled/jpg/no-ava.jpg" alt="Avatar" />
                                    @endif
                                </div>
                                <form id="uploadForm" action="{{ route('profile.avatar.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <fieldset class="mt-3">
                                        <div class="input-group mb-3">
                                            <input id="avatarInput" type="file" class="form-control form-control-sm" name="avatar" required>
                                            <!-- <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#cropModal"="">Crop & Upload</button> -->
                                        </div>
                                        <!-- Modal untuk crop gambar -->
                                        <div class="modal fade" id="cropModal" tabindex="-1" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Crop Avatar</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img id="cropImage" style="width: 100%; height: auto; max-height: 70vh; display:block; margin:auto;">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-secondary"
                                                            data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Close</span>
                                                        </button>
                                                        <button id="cropButton" type="button" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                                                            <i class="bx bx-check d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Accept</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </fieldset>
                                </form>
                                <form action="{{ route('profile.avatar.delete') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus Avatar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('password.update') }}" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="update_password_current_password" class="form-label">Current Password</label>
                                    <input
                                        type="password"
                                        name="current_password"
                                        id="update_password_current_password"
                                        class="form-control"
                                        autocomplete="current-password" />
                                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-danger" />
                                </div>
                                <div class="form-group">
                                    <label for="update_password_password" class="form-label">New Password</label>
                                    <input
                                        type="password"
                                        name="password"
                                        id="update_password_password"
                                        class="form-control"
                                        autocomplete="new-password" />
                                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-danger" />
                                </div>
                                <div class="form-group">
                                    <label for="update_password_password_confirmation" class="form-label">Confirm Password</label>
                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        id="update_password_password_confirmation"
                                        class="form-control"
                                        autocomplete="new-password" />
                                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-danger" />
                                </div>
                                <div class="form-group">
                                    <x-primary-button>{{ __('Save') }}</x-primary-button>

                                    @if (session('status') === 'password-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-success">{{ __('Saved.') }}</p>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
        <script>
            let cropper;
            const avatarInput = document.getElementById('avatarInput');
            const cropImage = document.getElementById('cropImage');
            const cropButton = document.getElementById('cropButton');

            // Saat user memilih gambar, tampilkan modal dan aktifkan Cropper.js
            avatarInput.addEventListener("change", function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        cropImage.src = e.target.result;

                        // Tampilkan modal
                        const cropModal = new bootstrap.Modal(document.getElementById("cropModal"));
                        cropModal.show();

                        // Tunggu sampai modal benar-benar terbuka sebelum menginisialisasi Cropper.js
                        document.getElementById("cropModal").addEventListener("shown.bs.modal", function() {
                            if (cropper) {
                                cropper.destroy(); // Hancurkan instance lama jika ada
                            }

                            cropper = new Cropper(cropImage, {
                                aspectRatio: 1, // Rasio 1:1 untuk avatar
                                viewMode: 2,
                                autoCropArea: 1, // Crop area memenuhi container
                                responsive: true, // Ukuran menyesuaikan modal
                                zoomOnWheel: true, // Mencegah zoom otomatis
                            });
                        }, {
                            once: true
                        }); // Event listener hanya dijalankan sekali setiap kali modal dibuka
                    };
                    reader.readAsDataURL(file);
                }
            });


            // Saat tombol Crop & Upload ditekan
            cropButton.addEventListener('click', function() {
                if (cropper) {
                    cropper.getCroppedCanvas().toBlob((blob) => {
                        const formData = new FormData();
                        formData.append('avatar', blob, 'cropped.jpg');
                        formData.append('_token', '{{ csrf_token() }}');

                        fetch("{{ route('profile.avatar.update') }}", {
                                method: 'POST',
                                body: formData,
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    location.reload(); // Refresh halaman agar avatar diperbarui
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    }, 'image/jpeg');
                }
            });
        </script>


    </div>
    @endsection