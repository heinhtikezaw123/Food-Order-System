@extends('user.layouts.master')

@section('content')
    <form action="{{ route('user#createUserContact') }}" method="POST">
        @csrf
        <div class=" d-flex flex-column col-6 offset-3">
            <h3 class="mb-4">Contact Us</h3>
            <div class="row mb-3">
                <div class="col">
                    <label for="">Name</label>
                    <input type="text" name="contactName" value="{{ old('contactName') }}" class="p-2 shadow-sm col me-3 form-control @error('name') is-invalid @enderror" placeholder="Enter your Name">
                    @error('contactName')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="col">
                    <label for="">Email</label>
                    <input type="email" name="contactEmail"
                        class="p-2 shadow-sm col me-3 form-control @error('contactEmail') is-invalid @enderror"
                        value="{{ old('contactEmail') }}"
                        placeholder="Enter your Email">
                    @error('contactEmail')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
            <label>Message</label>
            <textarea name="contactMessage" value="{{ old('contactMessage') }}" class="shadow-sm form-control @error('contactMessage') is-invalid @enderror" id=""
                cols="30" rows="10" placeholder="Enter Messages"></textarea>
            @error('contactMessage')
                <p class="text-danger">
                    {{ $message }}
                </p>
            @enderror

            <div>
                <button type="submit" class="col-2 mt-4 float-right btn btn-sm bg-dark text-white">Submit</button>
            </div>
        </div>
    </form>
@endsection
