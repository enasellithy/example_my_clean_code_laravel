<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @include('layouts.message')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary"
                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add New School
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                           <form method="post" action="{{ route('schools.store') }}">
                               @csrf
                               <div class="modal-body">
                                   <input type="text" class="form-control"
                                          name="name" value="{{ old('name') }}"
                                   placeholder="{{ __('Name') }}">
                               </div>
                               <div class="modal-footer">
                                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                   <button type="submit" class="btn btn-primary">Save</button>
                               </div>
                           </form>
                        </div>
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schools as $k => $i)
                            <tr>
                                <th scope="row">
                                    {{ ($schools->currentpage(1)-1) * $schools->perpage() + $k +1 }}
                                </th>
                                <td>
                                    {{ $i->name }}
                                </td>
                                <td>
                                    <!--Edit-->
                                    <button type="button" class="btn btn-primary"
                                            data-bs-toggle="modal" data-bs-target="#edit_{{$i->id}}">
                                        Edit
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="edit_{{$i->id}}"
                                         tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="post" action="{{ url('schools/'.$i->id) }}">
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                    <input type="hidden" name="_method" value="put">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="text" class="form-control"
                                                               name="name" value="{{ $i->name }}"
                                                               placeholder="{{ __('Name') }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Edit-->
                                    <!--Delete-->
                                    <button type="button" class="btn btn-danger"
                                            data-bs-toggle="modal" data-bs-target="#delete_{{$i->id}}">
                                        Delete
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="delete_{{$i->id}}"
                                         tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                    <div class="modal-body">
                                                        Are You Sure Delete This Element ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        {!! Form::open(['method' => 'DELETE','route' => ['schools.destroy', $i->id]]) !!}
                                                        <button type="submit" class="btn btn-danger">Okay</button>
                                                        {!! Form::close() !!}
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Delete-->

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {!! $schools->links() !!}
            </div>
        </div>
    </div>
</x-app-layout>
