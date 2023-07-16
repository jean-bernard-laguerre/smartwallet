import { getBalance, buildGraph } from "./function"

document.addEventListener("DOMContentLoaded", ()=> {
    getBalance()
    fetch("../functions/transactions.php")
    .then(data => data.json())
    .then(response => {

        let creditAmounts = []
        let debitAmounts = []
        let creditCategories = []
        let debitCategories = []

        let creditTransactionAmounts = []
        let debitTransactionAmounts = []
        let creditTransactionCategories = []
        let debitTransactionCategories = []


        response.AllCredit.forEach(transaction => {
            creditTransactionAmounts.push(Number(transaction.amount))
            creditTransactionCategories.push(transaction.date)
        });

        response.AllDebit.forEach(transaction => {
            debitTransactionAmounts.push(Number(transaction.amount))
            debitTransactionCategories.push(transaction.date)
        });

        const data = {
            labels: debitTransactionCategories,
            datasets: [{
                label: "Credit",
                data: creditTransactionAmounts,
                borderColor: "green",
                fill: false
              },{
                label: "Debit",
                data: debitTransactionAmounts,
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