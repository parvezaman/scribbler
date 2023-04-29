@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Note') }}</div>
                    <div class="card-body">
                        <div>
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            @endif
                        </div>
                        <form action="{{ $isEdit ? route('notes.update', $note->id) : route('notes.store') }}" method="POST">
                            @csrf
                            @if ($isEdit)
                                @method('PATCH')
                            @endif
                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text"
                                        class="form-control @error('title') is-invalid @enderror" name="title"
                                        value="{{ $isEdit ? $note->title : old('title') }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="description"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                                        name="description">{{ $isEdit ? $note->description : old('description') }}</textarea>

                                </div>
                            </div>

                            <button type="submit">{{ $isEdit ? 'Update Note' : 'Create Note' }}</button>

                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
