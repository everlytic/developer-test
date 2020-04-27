@extends('layout')
@section('title', 'User Listingd')
@section('heading', 'User Listing')
@section('content')
    <add-user-button class="form-group"></add-user-button>

    <table>
        <tbody>
            @foreach ($users as $index => $user)
            <tr class="{{ ($index + 1) % 2 !== 0 ? 'odd' : 'even' }}">
                <td class="w-25">{{ $user->full_name }}</td>
                <td class="w-50">{{ $user->email }}</td>
                <td class="w-25 text-align-right"><delete-user-button :user_id="{{ $user->id }}"></delete-user-button></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <?php echo $users->render(); ?>
@endsection