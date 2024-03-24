

const chatInput = document.querySelector("#chat-input");
const sendButton = document.querySelector("#send-btn");
const chatContainer =document.querySelector(".chat-container");
const themeButton = document.querySelector("#theme-btn");
const deleteButton = document.querySelector("#delete-btn");

let userText =null;
const API_KEY = 'API Key Here';

const loadDataFromLocalstrogae = () => {
    // Load theme color from local storage
    const themeColor = localStorage.getItem("theme-color");
    if (themeColor) {
        document.body.classList.toggle("light-mode", themeColor === "light_mode");
        themeButton.innerText = themeColor === "light_mode" ? "dark_mode" : "light_mode";
    }
    const defaultText = `<div class="default-text">
                           <h1>PrecisionHealth.AI</h1>
                            <p>Let's explore your health journey together.</P>   
                          </div>`
    // Load chat history from local storage
    const savedChats = localStorage.getItem("all-chats") || defaultText;
    if (savedChats) {
        chatContainer.innerHTML = savedChats;
    }
};

document.addEventListener('DOMContentLoaded', (event) => {
    loadDataFromLocalstrogae();
});

const createElement=(html,className)=>{
    //create new Div and apply chat , specified class and set html content of div 
    const chatDiv = document.createElement("div");
    chatDiv.classList.add("chat", className);
    chatDiv.innerHTML = html;
    return chatDiv; //Return the created Div
}

const appendChatResponse = (message) => {
    const html = `<div class="chat-content">
    <div class="chat-details">
         <img src="images/chatbot.png" alt="chatbot-img">
         <p>${message}</p>  
    </div>
   </div>`;
    const incomingChatDiv = createElement(html, "incoming");
    chatContainer.appendChild(incomingChatDiv);
    chatContainer.scrollTo(0, chatContainer.scrollHeight); // Ensure new message is scrolled into view
    localStorage.setItem("all-chats", chatContainer.innerHTML); // Update local storage immediately
}


const getChatResponse = () => {
    const API_URL = "https://api.openai.com/v1/chat/completions";
    const context = "                                                                                             If I mistakenly asked you non-health related question,then don't answer rather say, 'I only answer health related question.' You should only answer health,medical,fitness,gym,food,medicine,execise-plan,yoga,sleep-schedule,work-pressure-stress,disease,bmi,diet-plan,meditation etc which are human health and biology related.Oh! one more thing I forgot to tell you if I ask about you or are you chatgpt? tell me you are PrecisionHealth.AI.So here is a question for you to test you;";
    const message=context.concat(userText);
    const requestOptions = {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Authorization": `Bearer ${API_KEY}`
        },
        body: JSON.stringify({
            messages: [{ role: "system", content: message}],
            model: "gpt-3.5-turbo",
        })
    };

    fetch(API_URL, requestOptions)
        .then(response => response.json())
        .then(data => {
            
            // Correctly accessing the message content from the API response
            const message = data.choices[0].message.content.trim();
            appendChatResponse(message); // Append the response to the chat
        })
        .catch(error => console.error('Error:', error));
       
        localStorage.setItem("all-chats", chatContainer.innerHTML);

}



const showTypingAnimation =()=>{
    const html =` <div class="chat-content">
    <div class="chat-details">
         <img src="images/chatbot.jpg" alt="chatbot-img">
         <div class="typing-animation">
           <div class="typing-dot" style="--delay: 0.2s"></div>
           <div class="typing-dot" style="--delay: 0.3s"></div>
           <div class="typing-dot" style="--delay: 0.4s"></div>
         </div>
    </div>
    <span class="material-icons">content_copy</span>
   </div>`;
  //create an outgoing chat div with user's message and append it to chat container
  const outgoingChatDiv = createElement(html, "incoming");
 // chatContainer.appendChild(outgoingChatDiv);
  chatContainer.scrollTo(0, chatContainer.scrollHeight);
  getChatResponse();
  
}

const handleOutgoingChat = () => {
    userText = chatInput.value.trim();
    if (userText === "") return; // Don't proceed if the user text is empty
    const html = `<div class="chat-content">
    <div class="chat-details">
         <img src="images/user.jpg" alt="user-img">
         <p>${userText}</p>  
    </div>
   </div>`;
    const outgoingChatDiv = createElement(html, "outgoing");
    document.querySelector(".default-text")?.remove();
    chatContainer.appendChild(outgoingChatDiv);
    chatInput.value = ''; // Clear the input after sending
    setTimeout(showTypingAnimation, 500);
}

deleteButton.addEventListener("click", () => {
    if(confirm("Are you sure you want to delete all the chats?")) {
        localStorage.removeItem("all-chats");
        chatContainer.innerHTML = ""; // Clear the chat container on the page as well
    }
});

themeButton.addEventListener("click", () => {
    const isLightMode = document.body.classList.contains("light-mode");
    if (isLightMode) {
        document.body.classList.remove("light-mode");
        themeButton.innerText = "light_mode";
        localStorage.setItem("theme-color", "dark_mode");
    } else {
        document.body.classList.add("light-mode");
        themeButton.innerText = "dark_mode";
        localStorage.setItem("theme-color", "light_mode");
    }
});

const intalHeight =chatInput.scrollHeight;

chatInput.addEventListener("input", ()=>{
    //adjust the height of the input field dynamically based on its content
   chatInput.computedStyleMap.height = `${initialHeight}px`;
   chatInput.computedStyleMap.height = `${chatInput.scrollHeight}px`;
}
);

sendButton.addEventListener("click",handleOutgoingChat);