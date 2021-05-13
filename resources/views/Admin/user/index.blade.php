@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-sm-12 ">
                    <table class="table table-responsive-sm">
                        <thead>
                            <tr>
                                <th class="text-center">Registered At</th>
                                <th class="text-center">User name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Website</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $task)
                            <tr>
                                <td class="text-center">{{ $task->created_at }}</td>
                                <td class="text-center">{{ $task->name }}</td>
                                <td class="text-center">{{ $task->email }}</td>
                                <td class="text-center"><?php echo $retVal = ($task->website == "") ? "No website" : $task->website ;  ?></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$user->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection