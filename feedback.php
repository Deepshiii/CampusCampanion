<!-- Student Feedback Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Feedback Form</title>
    <style>
        form {
            width: max-content;
        }
        .feedback-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .rating {
            display: flex;
            gap: 10px;
        }
        .rating input {
            margin: 0 5px;
        }
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .submit-btn {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .submit-btn:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }
    </style>
</head>
<body onload="feedback_status()">
<h1>College Feedback Form</h1>
    <div class="feedback-container">
        <form action="submit_feedback.php" method="post">
            <div class="form-group">
                <label for="college-experience">1. How would you rate your overall experience at the college?</label>
                <div class="rating">
                    <label>Very Satisfied<input type="radio" name="college_experience" value="1" required></label>
                    <label>Satisfied<input type="radio" name="college_experience" value="2"></label>
                    <label>Neutral<input type="radio" name="college_experience" value="3"></label>
                    <label>Bad<input type="radio" name="college_experience" value="4"></label>
                    <label>Very Bad<input type="radio" name="college_experience" value="5"></label>
                </div>
            </div>

            <div class="form-group">
                <label for="teacher-effectiveness">2. How effective are your teachers in delivering course content?</label>
                <div class="rating">
                    <label>Very Satisfied<input type="radio" name="teacher_effectiveness" value="1" required></label>
                    <label>Satisfied<input type="radio" name="teacher_effectiveness" value="2"></label>
                    <label>Neutral<input type="radio" name="teacher_effectiveness" value="3"></label>
                    <label>Bad<input type="radio" name="teacher_effectiveness" value="4"></label>
                    <label>Very Bad<input type="radio" name="teacher_effectiveness" value="5"></label>
                </div>
            </div>

            <div class="form-group">
                <label for="classroom-facilities">3. How satisfied are you with the classroom facilities?</label>
                <div class="rating">
                    <label>Very Satisfied<input type="radio" name="classroom_facilities" value="1" required></label>
                    <label>Satisfied<input type="radio" name="classroom_facilities" value="2"></label>
                    <label>Neutral<input type="radio" name="classroom_facilities" value="3"></label>
                    <label>Bad<input type="radio" name="classroom_facilities" value="4"></label>
                    <label>Very Bad<input type="radio" name="classroom_facilities" value="5"></label>
                </div>
            </div>

            <div class="form-group">
                <label for="support-services">4. How would you rate the availability and quality of support services?</label>
                <div class="rating">
                    <label>Very Satisfied<input type="radio" name="support_services" value="1" required></label>
                    <label>Satisfied<input type="radio" name="support_services" value="2"></label>
                    <label>Neutral<input type="radio" name="support_services" value="3"></label>
                    <label>Bad<input type="radio" name="support_services" value="4"></label>
                    <label>Very Bad<input type="radio" name="support_services" value="5"></label>
                </div>
            </div>

            <div class="form-group">
                <label for="campus-infrastructure">5. How satisfied are you with the overall campus infrastructure?</label>
                <div class="rating">
                    <label>Very Satisfied<input type="radio" name="campus_infrastructure" value="1" required></label>
                    <label>Satisfied<input type="radio" name="campus_infrastructure" value="2"></label>
                    <label>Neutral<input type="radio" name="campus_infrastructure" value="3"></label>
                    <label>Bad<input type="radio" name="campus_infrastructure" value="4"></label>
                    <label>Very Bad<input type="radio" name="campus_infrastructure" value="5"></label>
                </div>
                <textarea name="suggestion" rows="4" placeholder="Suggestion If any!" required></textarea>
            </div>

            <button type="submit" class="submit-btn" id='sp'>Submit Feedback</button>
        </form>
    </div>
    <script>
        function feedback_status() {
            const submitButton = document.getElementById('sp');
            $.ajax({
                url: 'get_feedback_status.php',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.feedback_active == 0) {
                        submitButton.disabled= true;
                        
                    } 
                    else {
                        submitButton.disabled= false;
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching feedback status:', error);
                    // submitButton.prop('disabled', true);
                }
            });
        };
    </script>
</body>
</html>
