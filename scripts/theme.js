import { getTheme, swapTheme } from "./function"

document.addEventListener("DOMContentLoaded", ()=>{

    getTheme()

    document.querySelector("#theme-button").addEventListener("click", ()=>{
        swapTheme()
    }) 
})