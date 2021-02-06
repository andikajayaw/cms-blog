<!-- Footer -->
<?php 
    $year = date('Y');
?>
<footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; CMS by @andikajayaw - <?php echo $year; ?></p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- TOASTR -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- PUSHER -->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('8c6a8ca7bc6d41570f0f', {
        cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
        toastr.success(JSON.stringify(data));
        });
    // 
    </script>
</body>

</html>
