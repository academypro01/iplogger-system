<?php
Semej::checkSession();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../public/css/main.css">
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <script src="../public/javascript/bootstrap.min.js"></script>
    <script src="../public/javascript/043f718c75.js" crossorigin="anonymous"></script>

    <title>Create !</title>
    <link rel="shortcut icon" href="../public/images/fav.webp" type="image/webp">
</head>

<body>

    <div class="container">
        <h1 class="text-center text-light mt-4 p2 text-responsive">Create a new Link!</h1>
        <p class="text-center text-light text-justify">create a simple link and send it to your friend to see the
            result!</p>
        <hr>
        <?php Semej::show(); ?>
        <form action="<?php echo URLROOT.'create/create'; ?>" method='POST'>
            <div class="form-group">
                <label for="redirect" class="text-light">Redirect link:</label>
                <input autocomplete="off" autofocus type="text" name="redirect_link"
                    placeholder="example: https://google.com" id="redirect" class="form-control">
                <small class="text-light">- we redirect user to this link after get all informations!</small><br>
                <small class="text-light">- the link must start with http:// or https://</small>
            </div>
            <div class="form-group">
                <input disabled id="btn" type="submit" value="Create" class="form-control btn btn-success btn-lg">
            </div>
        </form>
    </div>

    <footer class="text-center footer text-light fixed-bottom p-1">
        Copyright &copy; <?php echo date("Y"); ?> - By <a class="text-decoration-none text-light"
            href="https://instagram.com/Academy.01">Academy01</a>
    </footer>


    <!-- javascript Files  -->
    <script src="../public/javascript/jquery-3.3.1.slim.min.js"></script>
    <script src="../public/javascript/popper.min.js"></script>
    <script>
        $(document).ready(() => {
            $("#redirect").keyup(() => {
                const input = $("#redirect").val();
                const pattern = /^(http|https)?:\/\/[a-zA-Z0-9-\.]+\.[a-z]{2,4}/;
                if (pattern.test(input)) {
                    $("#btn").removeAttr("disabled");
                    // alert('test');
                } else {
                    $("#btn").attr('disabled', 'true');
                    // alert('no');
                }
            });
        });
    </script>
</body>

</html>