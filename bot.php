<!DOCTYPE html>
<html lang="en">
<head>
    <title>Chatbot</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body bgcolor="#A020F0">
    <div class="wrapper">
        <div class="title">
            <img src="images/logo2.jpeg" alt="Image placeholder" class="img-fluid rounded-img image-padding" height="90px" width="100px">
            <h4>Royal Estate Design</h4>
        </div>
        <div class="form">
            <div class="bot-inbox inbox">
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="msg-header">
                    <p>Hello there,Please tell your query.</p>
                    <div class="input-data">
                <div id="options" class="options">
                </div>
            </div>
                </div>
            </div>
        </div>
        <div class="typing-field">
            <a href="index.php">Go Back To Site</a>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            const options = [
                "Hi",
                "How are you?",
                "What is the price range?",
                "Can you show me some examples?",
                "Do you offer any discounts?",
                "How can I contact you?",
                "Other"
            ];

            function displayOptions() {
                $('#options').empty();
                options.forEach(option => {
                    const optionBtn = $('<button class="option-btn">' + option + '</button>');
                    optionBtn.on('click', function() {
                        sendMessage(option);
                    });
                    $('#options').append(optionBtn);
                });
            }

            function sendMessage(message) {
                const userMsg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ message +'</p></div></div>';
                $(".form").append(userMsg);

                $.ajax({
                    url: 'message.php',
                    type: 'POST',
                    data: { text: message },
                    success: function(result){
                        const botReply = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>'+ result +'</p></div></div>';
                        $(".form").append(botReply);
                        $(".form").scrollTop($(".form")[0].scrollHeight);
                        displayOptions(); 
                    }
                });
            }

            displayOptions();
        });
    </script>
</body>
</html>
