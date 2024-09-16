//Read messages from datebase
let msgdiv = document.querySelector(".msg");
setInterval(() => {
    fetch("readmsg.php").then(
        response => {
            if (response.ok) {
                return response.text();
            }
        }
    ).then(
        data => {
            msgdiv.innerHTML = data;
        }
    )
}, 500);



window.onkeydown = (e) => {
    if (e.key === "Enter") {
        update();
    }
}
function update() {
    let msg = input_msg.value;
    fetch(`addmsg.php?msg=${msg}`)
        .then(response => {
            if (response.ok) {
                return response.text();
            }
        })
        .then(data => {
            console.log("message added");
            msgdiv.scrollTop = (msgdiv.scrollHeight - msgdiv.clientHeight) + 50;
        })
        .finally(() => {
            input_msg.value = ""; // Clear the input after sending
        });
}