<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


    </head>
    <body class="antialiased">

      <div class="card">
        <div class="card-body">
            <form action="" id="form_submit">
                @csrf
                <div class="form-group">
                    <label for="partner_name">P name</label>
                    <input type="text" class="form-control" name="partner_name" id="exampleInputEmail1" aria-describedby="emailHelp">

                </div>
                <div class="form-group">
                    <label for="partner_type">partner_type</label>
                    <input type="text" class="form-control" name="partner_type" id="partner_type" >

                </div>
                <div class="form-group">
                    <label for="partner_code">partner_code</label>
                    <input type="text" class="form-control" name="partner_code" id="partner_code" >

                </div>
                <div class="form-group">
                    <label for="mobile">mobile</label>
                    <input type="text" class="form-control" name="mobile" id="mobile" >

                </div>
                <div class="form-group">
                    <label for="email">email</label>
                    <input type="text" class="form-control" name="email" id="email" >

                </div>
                <div class="form-group">
                    <label for="upazila_thana">upazila_thana</label>
                    <input type="text" class="form-control" name="upazila_thana" id="upazila_thana" >

                </div>
                <div class="form-group">
                    <label for="district">district</label>
                    <input type="text" class="form-control" name="district" id="district" >

                </div>
                <div class="form-group">
                    <label for="division">division</label>
                    <input type="text" class="form-control" name="division" id="division" >

                </div>
                <div class="form-group">
                    <label for="partner_sign">partner_sign</label>
                    <input type="file" id="imgInp" name="thumb" accept="image/*">
                    <input type="hidden" id="partner_sign"  name="signature" >
                    <img src=""
                    alt="" class="img-fluid" id="uploadPreview" width="100" height="100">
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
      </div>


        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function(){
                  //click file button then image view
                $("#imgInp").change(function () {
                    readURL(this);
                });
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $("#uploadPreview").attr("src", e.target.result);
                            $("#partner_sign").val(e.target.result);
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                }
                $(document).on('submit','#form_submit', function(e){
                    e.preventDefault();
                    let form = $("#form_submit")[0];
                    let data = new FormData(form);
                        $.ajax({
                        url: "/api/partner-info",
                        method: "POST",
                        data: data,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                        dataType: "json",
                        enctype: "multipart/form-data",
                        processData: false,
                        contentType: false,
                        cache: false,
                        beforeSend: function () {

                        },
                        success: function (reflection) {
                            if ($.trim(reflection) != "") {
                                console.log(reflection);

                            }
                        },
                        complete: function (data) {

                        },
                    });
                })

            })
        </script>
    </body>
</html>
