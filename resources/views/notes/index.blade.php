@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('notes.create') }}">Create note</a>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Title</td>
                            <td>Created By</td>
                            <td>Created At</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notes as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td>{{ App\Models\User::find($item->user_id)->name }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a href="{{ route('notes.show', $item->id) }}">Show</a>
                                    <a href="{{ route('notes.edit', $item->id) }}">Edit</a>
                                    <form action="{{ route('notes.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button>Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
