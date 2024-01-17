<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "police_feedback_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the chatbot table
$sql = "SELECT question, response FROM chatbot";
$result = $conn->query($sql);

// Create an array to store predefined responses
$predefinedResponses = array();

if ($result->num_rows > 0) {
    // Fetch each row and add it to the predefinedResponses array
    while ($row = $result->fetch_assoc()) {
        $predefinedResponses[$row['question']] = $row['response'];
    }
}

// Close the database connection
$conn->close();
?>

<button class="chatbot-toggler" style="z-index:100;">
    <span class="material-symbols-rounded">mode_comment</span>
    <span class="material-symbols-outlined">close</span>
</button>
<div class="chatbot" style="z-index:100;">
    <header>
        <h2>Rajasthan Police</h2>
        <span class="close-btn material-symbols-outlined">close</span>
    </header>
    <ul class="chatbox">
        <li class="chat incoming">
            <span class="material-symbols-outlined">badge</span>
            <p>Hi there 👋<br>How can I help you today?</p>
        </li>
    </ul>
    <div class="chat-input">
        <textarea placeholder="Enter a message..." spellcheck="false" required></textarea>
        <span id="send-btn" class="material-symbols-rounded">send</span>
    </div>
</div>

<script>
    // Embed PHP predefined responses into JavaScript
    const predefinedResponses = <?php echo json_encode($predefinedResponses); ?>;

    const chatbotToggler = document.querySelector(".chatbot-toggler");
    const closeBtn = document.querySelector(".close-btn");
    const chatbox = document.querySelector(".chatbox");
    const chatInput = document.querySelector(".chat-input textarea");
    const sendChatBtn = document.querySelector(".chat-input span");

    let userMessage = null;
    const inputInitHeight = chatInput.scrollHeight;

    const createChatLi = (message, className) => {
        const chatLi = document.createElement("li");
        chatLi.classList.add("chat", `${className}`);
        let chatContent = className === "outgoing" ? `<p></p>` : `<span class="material-symbols-outlined">smart_toy</span><p></p>`;
        chatLi.innerHTML = chatContent;
        chatLi.querySelector("p").textContent = message;
        return chatLi;
    }
    const handleChat = () => {
        userMessage = chatInput.value.trim(); // Get user entered message and remove extra whitespace
        if (!userMessage) return;

        // Clear the input textarea and set its height to default
        chatInput.value = "";
        chatInput.style.height = `${inputInitHeight}px`;

        // Log the userMessage before generating a response
        console.log("User Message:", userMessage);

        // Append the user's message to the chatbox
        chatbox.appendChild(createChatLi(userMessage, "outgoing"));
        chatbox.scrollTo(0, chatbox.scrollHeight);

        setTimeout(() => {
            // Display "Thinking..." message while waiting for the response
            const incomingChatLi = createChatLi("Thinking...", "incoming");
            chatbox.appendChild(incomingChatLi);
            chatbox.scrollTo(0, chatbox.scrollHeight);
            generateResponse(incomingChatLi);
        }, 600);
    }

    const generateResponse = (chatElement) => {
        const messageElement = chatElement.querySelector("p");

        // Log predefinedResponses before getting a response
        console.log("Predefined Responses:", predefinedResponses);
        console.log(userMessage.toLowerCase());

        // Use PHP predefined responses directly
        const response = predefinedResponses[userMessage.toLowerCase()] || "I don't know the response for this question.";

        // Log the selected response
        console.log("Selected Response:", response);

        messageElement.textContent = response;

        chatbox.scrollTo(0, chatbox.scrollHeight);
    }


    chatInput.addEventListener("input", () => {
        chatInput.style.height = `${inputInitHeight}px`;
        chatInput.style.height = `${chatInput.scrollHeight}px`;
    });

    chatInput.addEventListener("keydown", (e) => {
        if (e.key === "Enter" && !e.shiftKey && window.innerWidth > 800) {
            e.preventDefault();
            handleChat();
        }
    });

    sendChatBtn.addEventListener("click", handleChat);
    closeBtn.addEventListener("click", () => document.body.classList.remove("show-chatbot"));
    chatbotToggler.addEventListener("click", () => document.body.classList.toggle("show-chatbot"));
</script>