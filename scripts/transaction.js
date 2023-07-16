import { getBalance } from "./function";

function deleteTransaction(event) {

    let data = {table: "transaction",
            id: this.id}

    fetch('../functions/remove.php', {
                method: 'POST',
                headers: {
                    'Content-Type':'application/json'
                },
                body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(response => {
        if (response["success"]) {

            let row = this.parentNode.parentNode.parentNode;
            row.remove();
            getBalance();
        }
    })
}

function detailTransaction() {

    let data = {id: this.id}

    fetch('../functions/details.php', {
                method: 'POST',
                headers: {
                    'Content-Type':'application/json'
                },
                body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(response => {
        if (response["success"]) {

            document.querySelector("#Detail-amount").textContent = response.transaction.amount
            document.querySelector("#Detail-date").textContent = response.transaction.date
            document.querySelector("#Detail-description").textContent = response.transaction.description
        }
    })

    let editor = document.getElementById("edit")
    editor.classList.toggle("hidden")
}

addEventListener("DOMContentLoaded", () => {

    getBalance()
    
    let deleteButtons = document.querySelectorAll(".remove")
    deleteButtons.forEach(button => {
        
        button.addEventListener("click", deleteTransaction)
    });

    let editButtons = document.querySelectorAll(".edit")
    editButtons.forEach(button => {
        
        button.addEventListener("click", detailTransaction)
    });

    let closeButton = document.querySelector("#close-button")
    closeButton.addEventListener("click", detailTransaction)
    
})
