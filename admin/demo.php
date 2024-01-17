<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Block/Unblock Buttons</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-6">
      <button class="btn btn-success" id="unblockBtn" onclick="unblockUser()">Unblock User</button>
    </div>
    <div class="col-md-6">
      <button class="btn btn-danger" id="blockBtn" onclick="blockUser()">Block User</button>
    </div>
  </div>
</div>

<!-- Bootstrap JS and Popper.js (Optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  function blockUser() {
    alert("User blocked!");
    // You can add additional logic here for blocking the user on the server or updating UI.
  }

  function unblockUser() {
    alert("User unblocked!");
    // You can add additional logic here for unblocking the user on the server or updating UI.
  }
</script>

</body>
</html>
