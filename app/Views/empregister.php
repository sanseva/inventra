<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centered Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- ✅ jQuery added -->
</head>

<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="card p-4 shadow-lg" style="width: 500px;">
        <div class="text-center mb-3">
            <img src="https://media.licdn.com/dms/image/v2/D4D0BAQGWyQlmAa--Fg/company-logo_200_200/company-logo_200_200/0/1664450763747/palaircmsolutions_logo?e=1749081600&v=beta&t=PUF3WqES9QF2YNBTEPjXOR7-SuXDlZmhFDbhh5GyUN8"
                alt="Logo" class="mb-2" style="width: 60px; height: 60px;">
        </div>
        <h3 class="text-center mb-3">Registration Form</h3>
        <form id="myForm">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="fname" placeholder="Enter firstname">
                </div>
                <div class="col-md-6">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lname" placeholder="Enter lastname">
                </div>

                <div class="col-12">
                    <label for="emailInput" class="form-label">Email</label>
                    <input type="text" class="form-control" id="emailInput" name="email" placeholder="Enter your email">
                </div>

                <div class="col-12">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Phone">
                </div>

                <div class="col-12">
                    <label for="password" class="form-label">Set Account Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Enter your password">
                </div>

                <div class="col-12">
                    <label for="shift_name" class="form-label">Shift Name</label>
                    <select class="form-control" id="shift_name" name="shift_name">
                        <option value="M">Morning Shift</option>
                        <option value="N">Night Shift</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="shiftStart" class="form-label">Shift Start</label>
                    <input type="time" class="form-control" id="shiftStart" name="shiftStart">
                </div>

                <div class="col-md-6">
                    <label for="shiftEnd" class="form-label">Shift End</label>
                    <input type="time" class="form-control" id="shiftEnd" name="shiftEnd">
                </div>

                <div class="col-12 d-grid">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
    </div>

    <script>
    $(document).ready(function() {
        $('#myForm').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            var dataToSend = $(this).serialize(); // Automatically serializes all form data

            $.ajax({
                url: '<?php echo base_url();?>login/save_temp_data', // PHP API endpoint
                type: 'POST',
                data: dataToSend,
                dataType: 'json', // Expect JSON response
                success: function(response) {
                    if (response.success) {
                        alert(response.message); // Show success message
                        $('#myForm')[0].reset();
                    } else {
                        alert("Error: " + response.message); // Show error message
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                    alert("Something went wrong. Please try again.");
                }
            });
        });
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>