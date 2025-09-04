<!DOCTYPE html>
<html>
<head>
    <title>Submit Feedback</title>
    <link rel="stylesheet" href="../view/feedback.css">
</head>
<body>

<div class="container">
    <h2>Submit Your Feedback</h2>

    <form id="feedbackForm" action="../control/success.php" method="POST">
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <td>Your Name:</td>
                <td>
                    <input type="text" name="name" id="name" required>
                    <div class="error" id="nameErr"></div>
                </td>
            </tr>
            <tr>
                <td>Email Address:</td>
                <td>
                    <input type="email" name="email" id="email" required>
                    <div class="error" id="emailErr"></div>
                </td>
            </tr>
            <tr>
                <td>Rating:</td>
                <td>
                    <select name="rating" id="rating" required>
                        <option value="">Select</option>
                        <option value="5">★★★★★ - Excellent</option>
                        <option value="4">★★★★ - Good</option>
                        <option value="3">★★★ - Average</option>
                        <option value="2">★★ - Poor</option>
                        <option value="1">★ - Terrible</option>
                    </select>
                    <div class="error" id="ratingErr"></div>
                </td>
            </tr>
            <tr>
                <td>Feedback Message:</td>
                <td>
                    <textarea name="message" id="message" rows="5" cols="40" required></textarea>
                    <div class="error" id="messageErr"></div>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Send Feedback">
                </td>
            </tr>
        </table>
        <br>
        <a href="client_cart.php">Back to Menu</a>
    </form>
</div>

</body>
</html>
