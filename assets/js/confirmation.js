for (var i = 0; i < localStorage.length; i++) {
    let key = localStorage.getItem(localStorage.key(i))
    let value = JSON.parse(key)

    for (let i = 0; i < value.length; i++) {
        const elm = value[i]
        populate(elm)
    }
}

function populate(elm) {
    let arr = []
    let price = parseInt(elm.price)
    let totalSumma = elm.quantity * price
    arr.push(totalSumma)

    let wrapper = document.querySelector(".wrapper")
    wrapper.innerHTML += ` 
    <div>${elm.name}</div>
    <div>${elm.price}</div>
    <div>${elm.quantity}</div>
    <div> <img src="../FE-Project-Shop/admin/images/${elm.image}">
    <div> Totalsumma: ${CountSum(arr)}</div>
    </div>`
}

function CountSum(totalsumma) {
    let sum = 0
    for (let i = 0; i < totalsumma.length; i++) {
        let elm = totalsumma[i]
        sum += elm
    }
    return sum
}
