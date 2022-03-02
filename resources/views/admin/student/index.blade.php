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
                    Add New Student
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
                           <form method="post" action="{{ route('students.store') }}">
                               @csrf
                               <div class="modal-body">
                                   <div>
                                       <input type="text" class="form-control"
                                              name="name" value="{{ old('name') }}"
                                              placeholder="{{ __('Name') }}">
                                       <br/>
                                   </div>
                                   <div>
                                   <input type="email" class="form-control"
                                          name="email" value="{{ old('email') }}"
                                          placeholder="{{ __('Email') }}">
                                       <br/>
                                   </div>
                                   <div>
                                   <input type="password" class="form-control"
                                          name="password" value="{{ old('password') }}"
                                          placeholder="{{ __('Password') }}">
                                       <br/>
                                   </div>
                                   <div>
                                   <select class="form-control" name="school_id">
                                       <option selected disabled>Choose School</option>
                                       @foreach($schools as $v)
                                           <option value="{{$v->id}}" {{ old('school_id') == $v->id ? 'selected' : '' }} >
                                               {{ $v->name }}
                                           </option>
                                       @endforeach
                                   </select>
                                       <br/>
                                   </div>
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
                            <th scope="col">{{ __('Email') }} </th>
                            <th scope="col">{{ __('School') }}</th>
                            <th scope="col">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $k => $i)
                            <tr>
                                <th scope="row">
                                    {{ ($students->currentpage(1)-1) * $students->perpage() + $k +1 }}
                                </th>
                                <td>
                                    {{ $i->name }}
                                </td>
                                <td>
                                    {{ $i->email }}
                                </td>
                                <td>
                                    {{ $i->schools->name ?? '' }}
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
                                                <form method="post" action="{{ url('students/'.$i->id) }}">
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                    <input type="hidden" name="_method" value="put">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="modal-body">
                                                            <div>
                                                                <input type="text" class="form-control"
                                                                       name="name" value="{{ $i->name }}"
                                                                       placeholder="{{ __('Name') }}">
                                                                <br/>
                                                            </div>
                                                            <div>
                                                                <input type="email" class="form-control"
                                                                       name="email" value="{{ $i->email }}"
                                                                       placeholder="{{ __('Email') }}">
                                                                <br/>
                                                            </div>
                                                            <div>
                                                                <input type="password" class="form-control"
                                                                       name="password" value="{{ old('password') }}"
                                                                       placeholder="{{ __('Password') }}">
                                                                <br/>
                                                            </div>
                                                            <div>
                                                                <select class="form-control" name="school_id">
                                                                    <option selected disabled>Choose School</option>
                                                                    @foreach($schools as $v)
                                                                        <option value="{{$v->id}}" {{ $i->school_id == $v->id ? 'selected' : '' }} >
                                                                            {{ $v->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <br/>
                                                            </div>
                                                        </div>
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
                                                        {!! Form::open(['method' => 'DELETE','route' => ['students.destroy', $i->id]]) !!}
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
                {!! $students->links() !!}
            </div>
        </div>
    </div>
</x-app-layout>
