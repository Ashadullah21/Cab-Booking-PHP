<?php require_once('./config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once('inc/header.php'); ?>
  <title>Terms and Conditions</title>
  <style>
    body {
      background-image: url('termbg.jpg'); /* Replace with your car image path */
      background-size: cover;
      background-position: center;
      color: white;
      font-family: Arial, sans-serif;
    }
    .bullet-icon {
      display: inline-block;
      margin-right: 8px;
      vertical-align: middle;
    }
    .container {
      background-color: rgba(0, 0, 0, 0.6);
      border-radius: 8px;
      padding: 40px;
      margin-top: 50px;
      text-align: center;
    }
    h1 {
      color: #b0a0e3;
      font-size: 2.5rem;
    }
    .btn-primary {
      background-color: #6a4b8c;
      border-color: #6a4b8c;
      color: white;
      font-size: 1.2rem;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 5px;
    }
    .btn-primary:hover {
      background-color: #5b3f6c;
    }
	ul {
    list-style: none; /* Remove default bullets */
    padding: 0; /* Remove extra padding */
    margin: 0;
}

ul li {
	//font-family:verdana;
	//font-size:13px;
    display: flex; /* Align icon and text in a single line */
    align-items: flex-start; /* Align text to the top of the icon */
    margin-bottom: 10px; /* Add spacing between list items */
}

ul li .bullet-icon {
    margin-right: 10px; /* Add consistent space between icon and text */
    flex-shrink: 0; /* Prevent the icon from resizing */
}

ul li p {
    margin: 0;
    line-height: 1.5; /* Add spacing between lines of text */
    word-break: break-word; /* Break long words properly to prevent overflow */
}


  </style>
</head>
<body>
  <div class="container py-5">
    <h1>Terms and Conditions</h1>
    <ul>
      <li>
        <span class="bullet-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="violet" width="16" height="16">
                <path d="M5 16a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm14 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4ZM3 9.6L4.4 5.8C4.9 4.4 6.2 3.5 7.7 3.5h8.6c1.5 0 2.8.9 3.3 2.3L21 9.6v7.4h-2v-1H5v1H3V9.6Zm2.4-.6h13.2L18.7 6c-.2-.5-.7-.8-1.3-.8H6.6c-.6 0-1.1.3-1.3.8L5.4 9ZM6 12h12v2H6v-2Z" />
            </svg>
        </span>
        You must provide accurate information during registration.
      </li>
	  <li>
        <span class="bullet-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="violet" width="16" height="16">
                <path d="M5 16a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm14 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4ZM3 9.6L4.4 5.8C4.9 4.4 6.2 3.5 7.7 3.5h8.6c1.5 0 2.8.9 3.3 2.3L21 9.6v7.4h-2v-1H5v1H3V9.6Zm2.4-.6h13.2L18.7 6c-.2-.5-.7-.8-1.3-.8H6.6c-.6 0-1.1.3-1.3.8L5.4 9ZM6 12h12v2H6v-2Z" />
            </svg>
        </span>
        If you wish to cancel your booking, please do so within 5 minutes of confirming the booking.
      </li>
	  <li>
        <span class="bullet-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="violet" width="16" height="16">
                <path d="M5 16a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm14 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4ZM3 9.6L4.4 5.8C4.9 4.4 6.2 3.5 7.7 3.5h8.6c1.5 0 2.8.9 3.3 2.3L21 9.6v7.4h-2v-1H5v1H3V9.6Zm2.4-.6h13.2L18.7 6c-.2-.5-.7-.8-1.3-.8H6.6c-.6 0-1.1.3-1.3.8L5.4 9ZM6 12h12v2H6v-2Z" />
            </svg>
        </span>
        Cancellations made after the 5-minute window will not be accepted, and the ride will be marked as active.
      </li>
      <li>
        <span class="bullet-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="violet" width="16" height="16">
                <path d="M5 16a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm14 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4ZM3 9.6L4.4 5.8C4.9 4.4 6.2 3.5 7.7 3.5h8.6c1.5 0 2.8.9 3.3 2.3L21 9.6v7.4h-2v-1H5v1H3V9.6Zm2.4-.6h13.2L18.7 6c-.2-.5-.7-.8-1.3-.8H6.6c-.6 0-1.1.3-1.3.8L5.4 9ZM6 12h12v2H6v-2Z" />
            </svg>
        </span>
        Enter the exact pickup and dropoff locations, including detailed addresses like street names, house numbers, or landmarks.
      </li>
      <li>
        <span class="bullet-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="violet" width="16" height="16">
                <path d="M5 16a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm14 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4ZM3 9.6L4.4 5.8C4.9 4.4 6.2 3.5 7.7 3.5h8.6c1.5 0 2.8.9 3.3 2.3L21 9.6v7.4h-2v-1H5v1H3V9.6Zm2.4-.6h13.2L18.7 6c-.2-.5-.7-.8-1.3-.8H6.6c-.6 0-1.1.3-1.3.8L5.4 9ZM6 12h12v2H6v-2Z" />
            </svg>
        </span>
        Generic descriptions such as 'Home' or 'College' may result in your booking being canceled without notice.
      </li>
      <li>
        <span class="bullet-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="violet" width="16" height="16">
                <path d="M5 16a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm14 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4ZM3 9.6L4.4 5.8C4.9 4.4 6.2 3.5 7.7 3.5h8.6c1.5 0 2.8.9 3.3 2.3L21 9.6v7.4h-2v-1H5v1H3V9.6Zm2.4-.6h13.2L18.7 6c-.2-.5-.7-.8-1.3-.8H6.6c-.6 0-1.1.3-1.3.8L5.4 9ZM6 12h12v2H6v-2Z" />
            </svg>
        </span>
        Currently, only cash payments are accepted for all bookings.
      </li>
	  <li>
        <span class="bullet-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="violet" width="16" height="16">
                <path d="M5 16a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm14 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4ZM3 9.6L4.4 5.8C4.9 4.4 6.2 3.5 7.7 3.5h8.6c1.5 0 2.8.9 3.3 2.3L21 9.6v7.4h-2v-1H5v1H3V9.6Zm2.4-.6h13.2L18.7 6c-.2-.5-.7-.8-1.3-.8H6.6c-.6 0-1.1.3-1.3.8L5.4 9ZM6 12h12v2H6v-2Z" />
            </svg>
        </span>
        Ensure you have the exact fare ready to avoid inconvenience.
      </li>
	  <li>
        <span class="bullet-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="violet" width="16" height="16">
                <path d="M5 16a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm14 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4ZM3 9.6L4.4 5.8C4.9 4.4 6.2 3.5 7.7 3.5h8.6c1.5 0 2.8.9 3.3 2.3L21 9.6v7.4h-2v-1H5v1H3V9.6Zm2.4-.6h13.2L18.7 6c-.2-.5-.7-.8-1.3-.8H6.6c-.6 0-1.1.3-1.3.8L5.4 9ZM6 12h12v2H6v-2Z" />
            </svg>
        </span>
        Once the booking is confirmed, the driver’s contact details will be shared for coordination purposes.
      </li>
	  <li>
        <span class="bullet-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="violet" width="16" height="16">
                <path d="M5 16a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm14 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4ZM3 9.6L4.4 5.8C4.9 4.4 6.2 3.5 7.7 3.5h8.6c1.5 0 2.8.9 3.3 2.3L21 9.6v7.4h-2v-1H5v1H3V9.6Zm2.4-.6h13.2L18.7 6c-.2-.5-.7-.8-1.3-.8H6.6c-.6 0-1.1.3-1.3.8L5.4 9ZM6 12h12v2H6v-2Z" />
            </svg>
        </span>
        Ensure clear communication with the driver for timely pickups.Ensure clear communication with the driver for timely pickups.
      </li>
	  <li>
        <span class="bullet-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="violet" width="16" height="16">
                <path d="M5 16a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm14 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4ZM3 9.6L4.4 5.8C4.9 4.4 6.2 3.5 7.7 3.5h8.6c1.5 0 2.8.9 3.3 2.3L21 9.6v7.4h-2v-1H5v1H3V9.6Zm2.4-.6h13.2L18.7 6c-.2-.5-.7-.8-1.3-.8H6.6c-.6 0-1.1.3-1.3.8L5.4 9ZM6 12h12v2H6v-2Z" />
            </svg>
        </span>
        Passengers must be ready at the pickup location at the scheduled time.Drivers will wait for a maximum of 10 minutes after arrival before canceling the booking.
      </li>
	  <li>
        <span class="bullet-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="violet" width="16" height="16">
                <path d="M5 16a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm14 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4ZM3 9.6L4.4 5.8C4.9 4.4 6.2 3.5 7.7 3.5h8.6c1.5 0 2.8.9 3.3 2.3L21 9.6v7.4h-2v-1H5v1H3V9.6Zm2.4-.6h13.2L18.7 6c-.2-.5-.7-.8-1.3-.8H6.6c-.6 0-1.1.3-1.3.8L5.4 9ZM6 12h12v2H6v-2Z" />
            </svg>
        </span>
        All bookings are subject to vehicle and driver availability.In case of unavailability, the system will notify the user immediately.
      </li>
	  <li>
        <span class="bullet-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="violet" width="16" height="16">
                <path d="M5 16a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm14 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4ZM3 9.6L4.4 5.8C4.9 4.4 6.2 3.5 7.7 3.5h8.6c1.5 0 2.8.9 3.3 2.3L21 9.6v7.4h-2v-1H5v1H3V9.6Zm2.4-.6h13.2L18.7 6c-.2-.5-.7-.8-1.3-.8H6.6c-.6 0-1.1.3-1.3.8L5.4 9ZM6 12h12v2H6v-2Z" />
            </svg>
        </span>
        Delays due to weather, traffic, or unforeseen circumstances may affect the estimated time of arrival.The company is not liable for such delays.
      </li>
    </ul>
    <a href="<?php echo base_url; ?>" class="btn btn-primary mt-3">Back to Home</a>
  </div>
</body>
</html>
