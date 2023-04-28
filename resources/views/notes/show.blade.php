@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Note') }}</div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" required readonly
                                    value="{{ $note->title }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description"
                                class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control" name="description" required readonly>{{ $note->description }}</textarea>
                            </div>
                        </div>
                        <a href="{{ route('notes.edit', $note->id) }}">Edit</a>
                        <form action="{{ route('notes.destroy', $note->id) }}" method="POST">
                            @csrf {{-- csrf token is a security measure. which indicates the user is not being forced to do the work --}}
                            @method('DELETE')

                            <button type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
