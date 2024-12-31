let showboxbtn=document.querySelector("#showboxbtn")
let box1=document.getElementById("showbox1")
let box2=document.getElementById("showbox2")
let box3=document.getElementById("showbox3")
let box4=document.getElementById("showbox4")

let box5=document.getElementById("showbox5")
let box6=document.getElementById("showbox6")
let box7=document.getElementById("showbox7")
let box8=document.getElementById("showbox8")
let allcontent=document.getElementById("allcontent")


function showbox1(){
    box1.style.display="block"
    allcontent.style.display="none"
}
function showbox2(){
    box2.style.display="block"
    allcontent.style.display="none"
}
function showbox3(){
    box3.style.display="block"
    allcontent.style.display="none"
}
function showbox4(){
    box4.style.display="block"
    allcontent.style.display="none"
}


function showbox5(){
    box5.style.display="block"
    allcontent.style.display="none"
}
function showbox6(){
    box6.style.display="block"
    allcontent.style.display="none"
}
function showbox7(){
    box7.style.display="block"
    allcontent.style.display="none"
}
function showbox8(){
    box8.style.display="block"
    allcontent.style.display="none"
}


// Open Form
function openForm() {
    document.getElementById('formOverlay').style.display = 'flex';
}

// Close Form
function closeForm() {
    document.getElementById('formOverlay').style.display = 'none';
}
