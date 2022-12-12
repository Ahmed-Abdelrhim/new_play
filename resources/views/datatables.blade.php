@extends('layouts.app')
@section('content')
    <div class="scroller"></div>
    <div class="container">
        <table class="table table-dark" id="datatable-example">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Content</th>
                <th scope="col">Name</th>
                <th scope="col">Time</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {
            var table = $('#datatable-example').DataTable({
                processing: true,
                serverSide: true,
                pagingType: 'full_numbers',
                paging: true,
                pagingTypeSince: 'numbers',
                order: [
                    [0, 'desc']
                ],
                ajax: "{{Route('dataTables.all')}}",
                columns: [{
                    data: 'id',
                    name: 'id',
                },
                    {
                        data: 'title',
                        name: 'title',
                    },
                    {
                        data: 'content',
                        name: 'content',
                    },
                    {
                        data: 'author',
                        name: 'author',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }

                ]
            });
        });
    </script>
    <script src="{{asset('js/datatable.js')}}"></script>
@endpush
