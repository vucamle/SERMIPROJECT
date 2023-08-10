
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Me
      tas -->
    <title>DevilShop</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="{!! asset('user/images/favicon.ico') !!}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{!! asset('user/images/apple-touch-icon.png') !!}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{!! asset('user/css/bootstrap.min.css') !!}">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{!! asset('user/css/style.css') !!}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{!! asset('user/css/responsive.css') !!}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{!! asset('user/css/custom.css') !!}">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') !!}"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js') !!}/1.4.2/respond.min.js') !!}"></script>
-->
<style>
  {box-sizing: border-box;}

/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: yellow;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  bottom: 23px;
  right: 28px;
  width: 80px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 900px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
  </style>
