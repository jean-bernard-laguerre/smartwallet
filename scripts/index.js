import { getBalance, buildGraph } from "./function"

document.addEventListener("DOMContentLoaded", ()=> {
    getBalance()
    fetch("../functions/transactions.php")
    .then(data => data.json())
    .then(response => {

        console.log()

        const data = {
            labels: response.AllDebit.map(row => row.date),
            datasets: [{
                label: "Credit",
                data: response.AllCredit.map(row => row.amount),
                borderColor: "green",
                fill: false
              },{
                label: "Debit",
                data: response.AllDebit.map(row => row.amount),
                borderColor: "red",
                fill: false
              }]
        };
    
        const myChart = new Chart("TransactionOverview", {
            type: "line",
            data: data,
            options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
            },
        });
    })
})