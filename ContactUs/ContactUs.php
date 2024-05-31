<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Contact Us</title>
    <link rel="stylesheet" href="ContactUs.css">
    <link rel="icon" href="/LibraryMS/HomePage/bookgatelogo.png" type="image/png">
</head>
<body>
    <div class="navbar">
        <div>
            <a href="/LibraryMS/HomePage/homepage.php">
                <img src="/LibraryMS/HomePage/bookgatelogo.png" href="/LibraryMS/HomePage/homepage.php">
            </a>
        </div>
        <div class="navbuttons">
            <a href="/LibraryMS/HomePage/homepage.php">Home</a>
            
        </div>
    </div>
    <div class="container">
        <h1>Contact Us</h1>
        <p>Bookgate would love to respond to your queries. <br> Please feel free to get in touch with us. </p>

        <div class="contact-box">
            <div class="contact-left">
                <h3>Send your request</h3>
                <form action="https://formsubmit.co/albano.younes@bilgiedu.net" method="POST">
                    <div class="input-row">
                        <div class="input-group">
                            <label>Name</label>
                            <input type="text" placeholder="John Doe" name="name">
                        </div>
                        <div class="input-group">
                            <label>Phone</label>
                            <input type="text" placeholder="+90 552 876 5483" name="phone">
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-group">
                            <label>Email</label>
                            <input type="text" placeholder="johndoe@gmail.com" name="email">
                        </div>
                        <div class="input-group">
                            <label>Subject</label>
                            <input type="text" placeholder="Website issue" name="subject">
                        </div>
                    </div>
                    <label>Message</label>
                    <textarea rows="5" placeholder="Your Message" name="text"></textarea>
                    <button type="submit">SEND</button>
                </form>
            </div>
            <div class="contact-right">
                <h3>Reach us</h3>
                <table>
                    <tr>
                        <td>Email</td>
                        <td><a href=mailto:“bookgate@gmail.com”>bookgate@gmail.com</a></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>+90 552 834 7685</td>
                    </tr>
                    <tr>
                        <td>Instagram</td>
                        <td>www.instagram.com/Bookgate</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>