<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laravel 8 Crud operation using ajax(Real Programmer)</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<style>
    .error {
        color: red;
        /* background-color: #acf; */
    }

</style>

<body>

    <div class="container">
        <h1>Laravel 8 Crud with Ajax</h1>
        <a class="btn btn-success" href="javascript:void(0)" id="createNewUser"> Create New User</a>
        <br><br>
        <span id="success_message"></span>

        <table class="table table-bordered data-table" style="width: 100%;text-align:center;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>FirstName</th>
                    <th>LastName</th>
                    <th width="300px">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>
    {{-- create modal --}}
    <div class="modal fade" id="ajaxModelCreate" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="userFormCreate" name="userFormCreate" class="form-horizontal">
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Firstname</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="firstName" name="firstName"
                                    placeholder="Enter Title" value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Lastname</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="lastName" name="lastName"
                                    placeholder="Enter Title" value="" maxlength="50" required="">
                                {{-- <textarea id="lastName" name="lastName" required="" placeholder="Enter Author"
                                    class="form-control"></textarea> --}}
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtnCreate">Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit modal --}}
    <div class="modal fade ajaxModelEdit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal userFormEdit" name="userFormEdit" >
                        <input type="text" class="user_id "name="user_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Firstname</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control firstName" name="firstName"
                                    placeholder="Enter Title" value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Lastname</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control lastName" name="lastName"
                                    placeholder="Enter Title" value="" maxlength="50" required="">
                                {{-- <textarea id="lastName" name="lastName" required="" placeholder="Enter Author"
                                    class="form-control"></textarea> --}}
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary saveBtnEdit" value="edit">Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script> --}}
    @include('ajax.userAjax')
</body>

</html>
