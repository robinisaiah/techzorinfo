<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h2 class="text-center text-primary">User Registration</h2>
        <form id="userForm" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" id="name" name="name" class="form-control" placeholder="Name">
                <span class="text-danger error-name"></span>
            </div>
            <div class="form-group">
                <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                <span class="text-danger error-email"></span>
            </div>
            <div class="form-group">
                <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Mobile Number">
                <span class="text-danger error-mobile"></span>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                <span class="text-danger error-password"></span>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
    </div>
</div>


    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-center text-success">User List</h2>
            <div class="table-responsive">
                <table id="userTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('users.sendEmail') }}" class="btn btn-success">Send Email</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#userTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.get') }}",
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'mobile' },
                    { data: 'created_at' }
                ]
            });

            $('#userForm').submit(function (e) {
            e.preventDefault();
            $('.text-danger').text(''); // Clear previous errors

            $.ajax({
                url: "{{ route('users.store') }}",
                type: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    alert(response.success);
                    $('#userForm')[0].reset();
                    setTimeout(function() {
        location.reload(); // Reloads the page after 2 seconds
    }, 2000);
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        if (errors.name) $('.error-name').text(errors.name[0]);
                        if (errors.email) $('.error-email').text(errors.email[0]);
                        if (errors.mobile) $('.error-mobile').text(errors.mobile[0]);
                        if (errors.password) $('.error-password').text(errors.password[0]);
                    }
                }
            });
        });
        });
    </script>
</body>
</html>
