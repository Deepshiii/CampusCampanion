<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Payment Information</title>
<link rel="stylesheet" href="payment.css">
<link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<style>
  .card-body {
    max-height: 525px; 
    overflow-y: auto; 
  }
</style>
</head>
<body>
<!-- Registration 8 - Bootstrap Brain Component -->
<section class="bg-light p-3 p-md-4 p-xl-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xxl-11">
        <div class="card border-light-subtle shadow-sm">
          <div class="row g-0">
            <div class="col-12 col-md-6">
              <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy" src="./Resources/camilo-botia-k4vFDPJoDZk-unsplash.jpg" alt="Welcome back you've been missed!">
            </div>
            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
              <div class="col-12 col-lg-11 col-xl-10">
                <div class="card-body p-3 p-md-4 p-xl-5">
                  <div class="row">
                    <div class="col-12">
                      <div class="mb-5">
                        <h2 class="h4 text-center">Payment</h2>
                      </div>
                    </div>
                  </div>
                  <form action="payment_process.php" method="POST">
                    <div class="row gy-2 overflow-hidden">
                      <div class="col-12">
                        <div class="form-floating">
                          <input type="text" class="form-control" name="admission_id" id="admission_id" placeholder="Enter your AdmissionID" required>
                          <label for="admission_id" class="form-label">AdmissionID<span class="text-danger">*</label>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-floating">
                          <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name" required>
                          <label for="name" class="form-label">Name<span class="text-danger">*</label>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-floating">
                          <input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="Contact" required>
                          <label for="contact_number" class="form-label">Contact Number<span class="text-danger">*</label>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-floating">
                          <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                          <label for="email" class="form-label">Email<span class="text-danger">*</label>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" name="iAgree" id="iAgree" required>
                          <label class="form-check-label text-secondary" for="iAgree">
                            I agree to the <a href="#!" class="link-primary text-decoration-none">terms and conditions</a>
                          </label>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="d-grid">
                          <button class="btn btn-dark btn-lg" type="submit" name ="pay">Proceed To Pay</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>


