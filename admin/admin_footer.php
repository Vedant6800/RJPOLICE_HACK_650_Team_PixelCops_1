<footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2023</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        $('.blockBtn').click(function() {
            var userName = $(this).closest('tr').find('td:first-child').text();
            var button = $(this);

            // Make an AJAX request to update the ac_status column
            $.ajax({
                type: 'POST',
                url: 'updateStatus.php', // Change this to the actual path of your PHP script
                data: {
                    userName: userName
                },
                success: function(response) {
                    // Update the UI based on the response
                    if (response === 'blocked') {
                        button.text('Unblock').removeClass('btn-danger').addClass('btn-success');
                    } else if (response === 'unblocked') {
                        button.text('Block').removeClass('btn-success').addClass('btn-danger');
                    }
                }
            });
        });
    });
</script>






</body>

</html>