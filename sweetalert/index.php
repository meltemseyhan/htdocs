<!DOCTYPE html>
<html>

<head>
    <title> PHP Temel</title>
    <meta charset="UTF-8">
    <meta name="description" content="Meltem PHP Lesson">
    <meta name="keywords" content="HTML, CSS, JavaScript, PHP">
    <meta name="author" content="Meltem Seyhan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>
    <div class="container">
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laborum tenetur ad recusandae. Vero, culpa labore corrupti provident a, cumque nam, voluptas amet quia nisi animi suscipit natus minima libero architecto?
        </p>
        <hr>

        <form id="udemyform">
            <input type="text" id="username" name="username" class="form-control"><br>
            <input type="password" id="password" name="password" class="form-control"><br>
            <button id="udemy" class="btn btn-success">Bildirim Çıkart</div>
        </form>
    </div>
    <script type="text/javascript">  
    /*
        $("#udemy").click(function(){
            /*swal({
                title: "Good job!",
                text: "You clicked the button!",
                icon: "success",
                button: "Aww yiss!",
                });

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                }).then((result) => {
                if (result) {
                    swal("Poof! Your imaginary file has been deleted!", {
                    icon: "success",
                    });
                } else {
                    swal("Your imaginary file is safe!");
                }
                });
        });*/

        $("#udemyform").submit(function(){
            event.preventDefault();
            $.ajax({
                type:"POST",
                url:"islem.php",
                data:$("#udemyform").serialize(),
                success: function(result){
                    var veri = JSON.parse(result);
                    swal({
                        title: veri.status,
                        text: veri.message,
                        icon: "success",
                        button: "Ok",
                        });
                }

            });
            return false;

        });
    </script>
</body>

</html>