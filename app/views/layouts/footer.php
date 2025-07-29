<footer class="footer">
  <div class="footer-container">
<!-- About / Address -->
<div class="footer-section">
  <h3>TUCEE Wellness</h3>
  <p>Empowering the next generation through education and innovation.</p>
  <p>
    <i class="bi bi-geo-alt-fill"></i> DT 2872 Adenta, Accra-Ghana-West Africa<br>
    <i class="bi bi-telephone-fill"></i>
    <a href="tel:+233554111444" class="footer-link">+233 (0) 554-111-444</a> | 
    <a href="tel:+233553888333" class="footer-link">+233 (0) 553-888-333</a> | 
    <a href="tel:+233244996991" class="footer-link">+233 (0) 244-996-991</a><br>
    <i class="bi bi-envelope-fill"></i>
    <a href="mailto:info@tucee.org" class="footer-link">info@tucee.org</a>
  </p>
</div>

<!-- Quick Links -->
<div class="footer-section links">
  <h4>Quick Links</h4>
  <ul>
    <li><a href="/tucee/"><i class="bi bi-house-door-fill"></i> Home</a></li>
    <li><a href="/tucee/about"><i class="bi bi-info-circle-fill"></i> Who We Are</a></li>
    <li><a href="/tucee/services"><i class="bi bi-heart-fill"></i> Counselling Services</a></li>
    <li><a href="/tucee/blog"><i class="bi bi-journal-text"></i> Blog</a></li>
  </ul>
</div>



     <div class="footer-section faq">
        <h4>FAQs</h4>
        <ul>
          <li><a href="/tucee/services">What services do you offer?</a></li>
          <li><a href="#">How do I book a session?</a></li>
          <li><a href="#">Can I volunteer?</a></li>
          <li><a href="#">How do I partner with TUCEE?</a></li>
          <li><a href="#">Where are you located?</a></li>
        </ul>
      </div>

    <!-- Newsletter -->
    <div class="footer-section newsletter">
      <h4>Subscribe to our Newsletter</h4>
      <form class="newsletter-form">
        <input type="email" placeholder="Enter your email" required>
        <button type="submit">Subscribe</button>
      </form>

      <!-- Social Media -->
      <h4>Follow Us</h4>
      <div class="social-icons">
        <a href="#"><i class="bi bi-facebook"></i></a>
        <a href="#"><i class="bi bi-twitter"></i></a>
        <a href="#"><i class="bi bi-linkedin"></i></a>
        <a href="#"><i class="bi bi-instagram"></i></a>
      </div>
    </div>

  </div>

  <div class="footer-bottom">
    <p>© 2025 TUCEE. All rights reserved.</p>
  </div>

<div class="ad-flyer" id="adFlyer">
    <div class="slider">
        <div class="slide-track">
            <img src="assets/images/advert-1.png" alt="Ad Image">
            <img src="assets/images/image-2.jpg" alt="Ad Image">
            <img src="assets/images/image-3.jpg" alt="Ad Image">
            <img src="assets/images/image-1.jpg" alt="Ad Image"> 
            <img src="assets/images/image-2.jpg" alt="Ad Image">
            <img src="assets/images/image-3.jpg" alt="Ad Image">
        </div>
    </div>
    <button class="close-btn" onclick="document.getElementById('adFlyer').style.display='none'">&times;</button>
</div>


<!-- Floating Chat Wrapper -->
<div class="floating-chat">
  
<!-- WhatsApp Chat Button -->
<div class="chat-btn whatsapp-btn" id="WhatsAppChatBtn" >
  <div class="chat-content">
    <div class="chat-icon">
      <i class="bi bi-whatsapp"></i>
    </div>
    <span class="chat-text">Connect Via WhatsApp</span>
  </div>
</div>

<div class="chat-btn livechat-btn" id="liveChatBtn">
  <div class="chat-content">
    <div class="chat-icon">
      <i class="bi bi-chat-dots-fill"></i>
    </div>
    <span class="chat-text">Live Chat</span>
  </div>
</div>


</div>



<!-- Mini Chat Dialog -->
<div class="chat-dialog" id="chatDialog">
  <div class="chat-head">
    <span><i class="fa fa-comments"></i> Live Chat</span>
    <button class="chat-close" id="chatClose">&times;</button>
  </div>

  <div class="chat-body" id="chatBody">
    <div class="message recipient">Hello! How can we help you today?</div>
  </div>

  <div class="chat-footer">
    <input type="text" id="chatInput" placeholder="Type your message..." />
    <button id="sendBtn">Send</button>
  </div>
</div>


<style>
.footer {
  background-color: var(--secondary);
  color: var(--text-light);
  padding: 40px 20px 20px;
  width: 100%;
}

.footer-container {
  display: flex;
  align-items: flex-start;
  justify-content: space-evenly;
  max-width: 1200px;
  margin: 0 auto;
  flex-wrap: nowrap;
  gap: 40px;
}

.footer-section h3,
.footer-section h4 {
  margin-bottom: 15px;
  font-size: 18px;
  font-weight: 600;
}

.footer-section p {
  font-size: 12px;
  line-height: 1.6;
}

.footer-section p a.footer-link {
  color: var(--text-light);
  text-decoration: none;
  margin-left: 4px;
  transition: color 0.3s;
  font-size: 12px;
}

.footer-section p a.footer-link:hover {
  color: var(--primary);
}


.footer-section ul {
  list-style: none;
  padding: 0;
}

.footer-section ul li {
  margin-bottom: 10px;
}

.footer-section ul li a {
  color: var(--text-light);
  text-decoration: none;
  transition: color 0.3s;
  font-size: 12px;
}

.footer-section ul li a:hover {
  color: var(--primary);
}

.footer-section p i,
.footer-section ul li a i {
  margin-right: 8px;
  color: var(--primary);
}


.newsletter-form {
  display: flex;
  margin-bottom: 15px;
  flex-wrap: wrap;
  gap: 8px;
}

.newsletter-form input[type="email"] {
  padding: 8px;
  flex: 1;
  border: none;
  outline: none;
}

.newsletter-form button {
  padding: 8px 16px;
  background-color: var(--primary);
  border: none;
  color: #000;
  cursor: pointer;
  transition: background-color 0.3s;
}

.newsletter-form button:hover {
  background-color: var(--primary-light);
  color: var(--text-light);
}

.social-icons a {
  display: inline-block;
  margin-right: 12px;
  font-size: 20px;
  color: var(--text-light);
  transition: color 0.3s, transform 0.3s;
}

.social-icons a:hover {
  color: var(--primary);
  transform: scale(1.2);
}

/* Footer Bottom */
.floating-chat {
  position: fixed;
  right: 25px;
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 15px;
  z-index: 9999;
}

.chat-btn {
  position: fixed;
  bottom: 30px; /* Lowered from 100px */
  right: 20px;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
  transition: width 0.3s ease, border-radius 0.3s ease;
  overflow: hidden;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
   cursor: pointer;
}

.livechat-btn {
  bottom: 90px;
  background-color: var(--secondary);
}
.whatsapp-btn {
  bottom: 30px;
  background-color: #25d366;
}



.chat-btn:hover {
  width: 240px;
  border-radius: 25px;
  cursor: pointer;
}

.chat-content {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  width: 100%;
  padding: 0 16px;
  gap: 10px;
}

.chat-icon {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 50px;
  height: 50px;
}

.chat-text {
  white-space: nowrap;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.chat-btn:hover .chat-text {
  opacity: 1;
}


/* Hover Animation for coordinated movement */
.floating-chat:hover .chat-btn {
  transform: translateX(0);
}

.floating-chat:hover .chat-btn:nth-child(1):hover ~ .chat-btn:nth-child(2),
.floating-chat:hover .chat-btn:nth-child(2):hover ~ .chat-btn:nth-child(1) {
  transform: translateX(-20px);
}



/* Chat Dialog */
.chat-dialog {
  position: fixed;
  bottom: 100px;
  right: 20px;
  width: 400px;
  background-color: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
  display: none;
  flex-direction: column;
  z-index: 10000;
  overflow: hidden;
}

/* Chat Header */
.chat-head {
  background-color: var(--primary-light);
  color: #fff;
  padding: 12px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

/* Close Button */
.chat-close {
  background: none;
  border: none;
  color: #fff;
  font-size: 20px;
  cursor: pointer;
}

/* Chat Body */
.chat-body {
  padding: 12px;
  flex-grow: 1;
  overflow-y: auto;
  max-height: 200px;
  background-color: #fff;
  display: flex;
  flex-direction: column;
  gap: 8px;
}

/* Chat Messages */
.message {
  padding: 8px 12px;
  border-radius: 4px;
  max-width: 80%;
  word-wrap: break-word;
  font-size: 13px;
}

.recipient {
  background-color: var(--primary-light);
  align-self: flex-start;
}

.sender {
  background-color: var(--secondary);
  align-self: flex-end;
}

/* Chat Footer */
.chat-footer {
  display: flex;
  padding: 8px;
  gap: 8px;
  background-color: #eee;
}

.chat-footer input {
  flex: 1;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 13px;
  outline: none;
}

.chat-footer button {
  padding: 8px 12px;
  background-color: var(--secondary);
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s;
}

/* Responsive Breakpoint ≤ 768px */
@media (max-width: 768px) {
  .chat-dialog {
    width: 90vw;
    right: 5%;
    bottom: 80px;
  }
}

/* Responsive Breakpoint ≤ 480px */
@media (max-width: 480px) {
  /* Chat dialog adjusts to almost full width */
  .chat-dialog {
    width: 95vw;
    right: 2.5%;
    bottom: 80px;
  }

  /* Stack input and button vertically */
  .chat-footer {
    flex-direction: column;
  }

  .chat-footer input,
  .chat-footer button {
    width: 100%;
  }

  /* Floating chat button adjustments */
  .floating-chat {
    bottom: 20px;
    right: 20px;
  }

  .chat-btn {
    width: 45px;
    height: 45px;
  }

  .chat-btn:hover {
    width: 140px;
  }

  .chat-content i {
    font-size: 18px;
  }

  .chat-content .chat-text {
    font-size: 12px;
  }
}



/* ------------------------------------ */
/* AD FLYER */
.ad-flyer {
  position: fixed;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 70vw;
  height: 150px;
  background-color: rgb(212, 212, 212);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
  overflow: hidden;
  z-index: 999;
  display: flex;
  justify-content: center;
  align-items: center;
  transition: opacity 0.5s ease;
}

/* Slider Track */
.slider {
  width: 100%;
  height: 100%;
  overflow: hidden;
  position: relative;
}

.slide-track {
  display: flex;
  width: calc(300px * 6);
  animation: scroll 15s linear infinite;
}

.slide-track img {
  width: 300px;
  height: 100%;
  object-fit: cover;
  flex-shrink: 0;
}

/* Scrolling Animation */
@keyframes scroll {
  0% { transform: translateX(0); }
  100% { transform: translateX(-900px); }
}

/* Close Button */
.close-btn {
  position: absolute;
  top: 5px;
  right: 10px;
  background: none;
  border: none;
  font-size: 24px;
  cursor: pointer;
  color: #888;
  z-index: 1001;
}

.close-btn:hover {
  color: #000;
}

/* ------------------------------------ */
/* RESPONSIVE BREAKPOINT ≤ 992px */
@media (max-width: 992px) {
  .footer-container {
    flex-direction: column;
    text-align: left;
    gap: 40px;
  }

  .newsletter-form {
    flex-direction: column;
    width: 100%;
  }

  .newsletter-form input[type="email"],
  .newsletter-form button {
    width: 100%;
    border-radius: 4px;
  }

  .ad-flyer {
    width: 95vw;
    height: 120px;
  }

  .slide-track img {
    width: 200px;
  }

  .slide-track {
    width: calc(200px * 6);
    animation: scrollSmall 15s linear infinite;
  }

  @keyframes scrollSmall {
    0% { transform: translateX(0); }
    100% { transform: translateX(-600px); }
  }
}

/* RESPONSIVE BREAKPOINT ≤ 576px */
@media (max-width: 576px) {
  .ad-flyer {
    height: 100px;
  }

  .slide-track img {
    width: 150px;
  }

  .slide-track {
    width: calc(150px * 6);
    animation: scrollSmallest 15s linear infinite;
  }

  @keyframes scrollSmallest {
    0% { transform: translateX(0); }
    100% { transform: translateX(-450px); }
  }

  .chat-btn {
    width: 45px;
    height: 45px;
  }

  .chat-btn:hover {
    width: 150px;
  }

  .chat-content i {
    font-size: 18px;
  }

  .chat-content .chat-text {
    font-size: 12px;
  }

  .floating-chat {
    bottom: 20px;
    right: 20px;
  }
}


</style>
</footer>

<script src="/tucee/assets/js/main.js"></script>
<script>

   document.getElementById("WhatsAppChatBtn").addEventListener("click", function () {
    window.open("https://wa.me/233554111444", "_blank");
  });

   document.addEventListener('contextmenu', function (e) {
    e.preventDefault();
  });

  // Disable Developer Tools (F12, Ctrl+Shift+I, Ctrl+U)
  document.addEventListener('keydown', function (e) {
    // Disable F12
    if (e.keyCode === 123) {
        e.preventDefault();
        alert('Developer tools are disabled!');
    }
    // Disable Ctrl + Shift + I (common shortcut for Developer Tools)
    if (e.ctrlKey && e.shiftKey && e.keyCode === 73) {
        e.preventDefault();
        alert('Developer tools are disabled!');
    }
    // Disable Ctrl + U (View Source)
    if (e.ctrlKey && e.keyCode === 85) {
        e.preventDefault();
        alert('View source is disabled!');
    }
  });

  const chatBtn = document.getElementById("liveChatBtn");
  const chatDialog = document.getElementById("chatDialog");
  const chatClose = document.getElementById("chatClose");
  const chatBody = document.getElementById("chatBody");
  const chatInput = document.getElementById("chatInput");
  const sendBtn = document.getElementById("sendBtn");

  let socket;
  let visitorName;

  // Generate a unique visitor name if not already stored
  function generateVisitorName() {
    const adjectives = ["Brave", "Calm", "Witty", "Kind", "Bright", "Quick", "Bold", "Happy"];
    const animals = ["Eagle", "Dolphin", "Tiger", "Fox", "Panda", "Hawk", "Otter", "Lion"];
    const adjective = adjectives[Math.floor(Math.random() * adjectives.length)];
    const animal = animals[Math.floor(Math.random() * animals.length)];
    const number = Math.floor(1000 + Math.random() * 9000);
    return `${adjective}${animal}-${number}`;
  }

  // Load or set visitor name
  if (!localStorage.getItem("visitorName")) {
    localStorage.setItem("visitorName", generateVisitorName());
  }
  visitorName = localStorage.getItem("visitorName");

  chatBtn.addEventListener("click", () => {
    chatDialog.style.display = chatDialog.style.display === "flex" ? "none" : "flex";

    if (!socket || socket.readyState !== WebSocket.OPEN) {
      socket = new WebSocket("ws://192.168.23.1:8080");

      socket.onopen = () => {
        console.log(`Connected as ${visitorName}`);
      };

      socket.onmessage = function (event) {
        const data = JSON.parse(event.data);
        if (data.sender_type === "admin") {
          const msg = document.createElement("div");
          msg.className = "message recipient";
          msg.textContent = data.message; // Only message, no 'Admin:'
          chatBody.appendChild(msg);
          chatBody.scrollTop = chatBody.scrollHeight;
        }
      };


      socket.onerror = error => {
        console.error("WebSocket error:", error);
      };
    }
  });

  chatClose.addEventListener("click", () => {
    chatDialog.style.display = "none";
  });

  sendBtn.addEventListener("click", sendMessage);
  chatInput.addEventListener("keypress", e => {
    if (e.key === "Enter") sendMessage();
  });

  function sendMessage() {
    const message = chatInput.value.trim();
    if (!message || socket.readyState !== WebSocket.OPEN) return;

    const senderMsg = document.createElement("div");
    senderMsg.className = "message sender";
    senderMsg.textContent = message;
    chatBody.appendChild(senderMsg);

    socket.send(JSON.stringify({
      sender_type: "client",
      sender_name: visitorName,
      message: message
    }));

    chatInput.value = "";
    chatBody.scrollTop = chatBody.scrollHeight;
  }
</script>





</body>
</html>
