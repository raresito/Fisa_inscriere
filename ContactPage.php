<html>
    <head>
        <title>
            Contact Admin
        </title>

        <link rel="stylesheet" href="css/contactpage.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/custom.js"></script>
    </head>
    <body>
        <form name='contact' method="post" action = "sendComment.php" id="contact">
            <div class='container middle'>
                <h2>Contact</h2>
                <p>Poti trimite un mesaj administratorului, si vei fi contactat in cel mai scurt timp!</p>
                <div>
                    <div class="row col-xs-12 form-group ">
                        <label>
                        Numele tau:
                        </label> <br>
                        <input
                            type="text"
                            class="form-control"
                            name="numeContact">
                    </div>

                    <div class="row col-xs-12 form-group ">
                        <label>
                            Emailul tau:
                        </label> <br>
                        <input
                                type="email"
                                class="form-control"
                                name="email">
                    </div>

                    <div class="row col-xs-12 form-group ">
                        <label>
                            Mesajul tau:
                        </label>
                        <textarea class="form-control" rows="5" name="commentContact"></textarea>
                    </div>
                    <div class="row col-xs-12 form-group">
                        <button type = "submit" form = "contact" > Submit </button>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>