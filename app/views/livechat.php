<main>
  <div class="dashboard">
    <div class="sidebar">
      <?php include "layouts/sidebar.php"; ?>
    </div>

    <div class="main-content">
      <div class="dashboard-header">
        <div class="header-content">
          <div class="user-info">
            <span class="username"><?= htmlspecialchars($_SESSION['user']['name'] ?? 'Guest') ?></span>
            <img src="assets/images/TUCEE-Institute-logo.png" alt="User Image" class="user-image">
          </div>
        </div>
      </div>

      <div class="page-name">
        <h2>Chats</h2>

        <div>
          <i class="fa fa-trash"></i>
        </div>
      </div>

      <div class="chats">
        <!-- Sender List -->
        <div class="chat-lists">
          <ul id="senderList">
            <?php foreach ($senders as $sender): ?>
              <li onclick="filterMessages('<?= htmlspecialchars($sender) ?>')" id="sender-<?= htmlspecialchars($sender) ?>">
                <div class="sender-info">
                  <span class="sender-name"><?= htmlspecialchars($sender) ?></span>
                  <span class="message-time" id="time-<?= htmlspecialchars($sender) ?>">
                    <?= htmlspecialchars($lastMessages[$sender]['formatted_time'] ?? '') ?>
                  </span>
                </div>
                <?php if (isset($lastMessages[$sender])): ?>
                  <div class="last-message">
                    <span class="message-snippet"><?= htmlspecialchars(substr($lastMessages[$sender]['message'], 0, 30)) ?>...</span>
                  </div>
                <?php endif; ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>

        <!-- Chat Messages + Input -->
        <div class="chat-window">
          <div class="chat-header" id="chatHeader" style="display: none;">
            <button onclick="closeChat()" class="back-btn">← <span id="chatClientName" style="margin-left: 5px;"></span></button>
          </div>

          <div id="chatMessages" class="chat-body empty-chat">
            <p class="placeholder-text">Select a conversation to view messages</p>
          </div>

          <div class="chat-input" id="chatInput" style="display: none;">
            <input type="text" id="adminMessage" placeholder="Type your response..." />
            <button onclick="sendAdminMessage()">Send</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<style>
  header, footer {
    display: none;
  }

</style>

<script>
  const socket = new WebSocket("ws://192.168.23.1:8080");
  const chatMessages = document.getElementById("chatMessages");
  const adminInput = document.getElementById("adminMessage");
  const chatInput = document.getElementById("chatInput");
  const chatHeader = document.getElementById("chatHeader");
  const chatClientName = document.getElementById("chatClientName");
  const allMessages = <?= json_encode($messages) ?>;

  let currentSender = null;

  function filterMessages(sender) {
    currentSender = sender;
    localStorage.setItem("lastSender", sender);

    document.querySelectorAll(".chat-lists li").forEach(li => li.classList.remove("active"));
    const selectedLi = document.getElementById(`sender-${sender}`);
    if (selectedLi) selectedLi.classList.add("active");

    chatHeader.style.display = "flex";
    chatInput.style.display = "flex";
    chatClientName.textContent = sender;

    chatMessages.innerHTML = "";
    chatMessages.classList.remove("empty-chat");

    const filteredMessages = allMessages.filter(msg => 
        (msg.sender_name === sender) || 
        (msg.sender_type === 'admin' && msg.recipient === sender)
    );

    // Display messages in reverse order (newest at the bottom, older ones at the top)
    filteredMessages.forEach(msg => {
        const div = document.createElement("div");
        div.className = "message " + (msg.sender_type === 'admin' ? 'sender' : 'recipient');
        div.textContent = msg.message;

        const timeDiv = document.createElement("div");
        timeDiv.className = "message-time";

        // Show the exact date and time in the format: "Y-m-d H:i"
        const messageTime = new Date(msg.created_at);
        timeDiv.textContent = messageTime.toLocaleString(); // This will give you a readable date and time like "2023-07-14 15:30"

        div.appendChild(timeDiv);
        chatMessages.appendChild(div);
    });

    chatMessages.scrollTop = chatMessages.scrollHeight;

    // Update the chat list item with relative time format for the latest message
    const lastMessageTime = filteredMessages[filteredMessages.length - 1]?.created_at;
    if (lastMessageTime) {
      const timeElement = document.getElementById(`time-${sender}`);
      const date = new Date(lastMessageTime);
      timeElement.textContent = msg.formatted_time; // For the last message in the list
    }
}

function closeChat() {
    currentSender = null;
    chatHeader.style.display = "none";
    chatInput.style.display = "none";
    chatMessages.classList.add("empty-chat");
    chatMessages.innerHTML = `<p class="placeholder-text">Select a conversation to view messages</p>`;
    document.querySelectorAll(".chat-lists li").forEach(li => li.classList.remove("active"));
    localStorage.removeItem("lastSender");
}

function sendAdminMessage() {
    const msg = adminInput.value.trim();
    if (!msg || !currentSender) return;

    const timestamp = new Date().toISOString();  // ISO format timestamp

    socket.send(JSON.stringify({
      sender_type: "admin",
      sender_name: "Admin",
      message: msg,
      recipient: currentSender,
      created_at: timestamp  // Add timestamp
    }));

    const div = document.createElement("div");
    div.className = "message sender";
    div.textContent = msg;

    const timeDiv = document.createElement("div");
    timeDiv.className = "message-time";
    timeDiv.textContent = new Date(timestamp).toLocaleString();  // Convert to human-readable format

    div.appendChild(timeDiv);
    chatMessages.appendChild(div);

    adminInput.value = "";
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

socket.onmessage = function (event) {
    const data = JSON.parse(event.data);
    if (data.sender_name === currentSender || data.recipient === currentSender) {
        const div = document.createElement("div");
        div.className = "message " + (data.sender_type === 'admin' ? 'sender' : 'recipient');
        div.textContent = data.message;

        const timeDiv = document.createElement("div");
        timeDiv.className = "message-time";
        timeDiv.textContent = new Date(data.created_at).toLocaleString();  // Convert to human-readable format

        div.appendChild(timeDiv);
        chatMessages.appendChild(div);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    allMessages.push(data);
};

window.addEventListener("load", () => {
    const last = localStorage.getItem("lastSender");
    if (last) {
        filterMessages(last);
    } else {
        closeChat();
    }
});
</script>
