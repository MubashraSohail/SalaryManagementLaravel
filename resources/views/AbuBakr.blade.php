<!DOCTYPE html>
<html>
<head>
    <title>Our First Form</title>
</head>
<body>
    <p>Hello</p>
    <form action="/register"  Method="POST" >
   @csrf
        <div class="form group">
            <label for="name">Enter Your name</label>
            <input type="name" class="form-control" id="name" placeholder="Enter your name" name="name">
        </div>
        <br>
        <div class="form group">
            <label for="lname">Enter Your Last name</label>
            <input type="name" class="form-control" id="lname" placeholder="Enter your Last name" name="lname">
        </div>
        <br>
        <div class="form group">
            <label for="email">Enter Your name</label>
            <input type="email" class="form-control" id="email" placeholder="Enter your Email" name="email">
        </div>
        <br>
       
        <br>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</body>
</html>