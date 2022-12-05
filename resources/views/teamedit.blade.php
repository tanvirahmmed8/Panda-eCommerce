<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body style="background-color: rgb(83, 35, 123)">



    <div class="container">
        <div class="card text-start border-0" style="background-color: rgb(83, 35, 123)">
          {{-- <img class="card-img-top" src="holder.js/100px180/" alt="Title"> --}}
          <div class="card-body p-5">
            {{-- <h4 class="card-title">Title</h4> --}}
            {{-- <p class="card-text">Body</p> --}}
          </div>
        </div>
        <div class="row">
            {{-- <img class="card-img-top" src="holder.js/100x180/" alt="Title"> --}}
            <div class="col-3"></div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Team Member</h3>
                    </div>
               <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success" role="alert">
                   {{ session('success') }}
                </div>
                @endif

                <form class="row g-3 needs-validation" novalidate action="{{ url('team/update') }}/{{ $data->id }}" method="POST">
                    @csrf

                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="validationCustom01" required value="{{ $data->name }}">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustom02" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" id="validationCustom02" value="{{ $data->phone }}" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustomUsername" class="form-label">Email</label>
                        <div class="input-group has-validation">
                            {{-- <span class="input-group-text" id="inputGroupPrepend">@</span> --}}
                            <input type="email" name="email" class="form-control" id="validationCustomUsername"
                               value="{{ $data->email }}" required>
                            <div class="invalid-feedback">
                                Please choose a Email.
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </form>
               </div>
            </div>
            </div>
            <div class="col-3"></div>

        </div>

    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js">
    </script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
    </script>
</body>

</html>
