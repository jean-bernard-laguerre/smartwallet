export function duplicate(element) {
    let original = document.querySelector(element)
    let clone  = original.cloneNode(true);
    original.after(clone);
}

export function deleteDuplicate(element) {
    let container = document.getElementsByClassName(element)
    
    if (container.length > 1) {
        container[container.length - 1].remove();
    }
}

export function getBalance() {

    fetch("../functions/balance.php")
    .then(data => data.json())
    .then(response => {
        let balanceContainer = document.querySelector("#Balance")
        balanceContainer.innerHTML = response.balance + "€"

    })
}

export function buildGraph(name, type, content) {

    console.log(content.labels, content.values)

    const data = {
        labels: content.labels,
        datasets: [{
            label: name,
            data: content.values,
            backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)'
            ],
            borderWidth: 1
        }]
    };

    const myChart = new Chart(name, {
        type: type,
        data: data,
        options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          },
      });

      console.log(myChart)
}

export function transactionTable(name, content) {

}

export function getTheme() {
    let theme = localStorage.getItem("theme")

    if (!theme) {
        localStorage.setItem("theme", "light")
    }

    document.body.classList.add(theme)
}

export function swapTheme() {
    let theme = localStorage.getItem("theme")
    document.body.classList.remove(theme)

    switch (theme) {
        case "light":
            theme = "dark"
            break;

        case "dark":
            theme = "light"
            break
    }
    
    document.body.classList.add(theme)
    localStorage.setItem("theme", theme)
}