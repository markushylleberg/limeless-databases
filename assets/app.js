function submitSignup(clicked) {
    let form = $(clicked).parent()
    $.ajax({
        type: 'POST',
        url: './apis/api-register-user.php',
        data: $(form).serialize()
    }).done(e=>{
        console.log('ok', e)
    }).fail(e=>{
        console.log('fail') 
    })
}
function deleteUser(clicked) {
    let nUserId = $(clicked).data('user-id')
    $.ajax({
        type: 'GET',
        url: './apis/api-delete-user.php?id='+nUserId,
    }).done(e=>{
        console.log('ok')
    }).fail(e=>{
        console.log('fail') 
    })
}
function cancelUser(clicked) {
    let nUserId = $(clicked).data('user-id')
    $.ajax({
        type: 'GET',
        url: './apis/api-cancel-user.php?id='+nUserId,
    }).done(e=>{
        console.log('ok')
    }).fail(e=>{
        console.log('fail') 
    })
}
function submitUserUpdate(clicked) {
    let form = $(clicked).parent()
    $.ajax({
        type: 'POST',
        url: './apis/api-update-user.php',
        data: $(form).serialize()
    }).done(e=>{
        console.log('ok', e)
    }).fail(e=>{
        console.log('fail') 
    })
}
function createCreditCard(clicked) {
    let form = $(clicked).parent()
    $.ajax({
        type: 'POST',
        url: './apis/api-create-credit-card.php',
        data: $(form).serialize()
    }).done(e=>{
        console.log('ok', e)
    }).fail(e=>{
        console.log('fail') 
    })
}
function deleteCreditcard(clicked) {
    let nCreditcardId = $(clicked).data('creditcard-id')
    $.ajax({
        type: 'GET',
        url: './apis/api-delete-creditcard.php?id='+nCreditcardId,
    }).done(e=>{
        console.log('ok')
    }).fail(e=>{
        console.log('fail') 
    })
}
function submitCreditcardUpdate(clicked) {
    let form = $(clicked).parent()
    $.ajax({
        type: 'POST',
        url: './apis/api-update-creditcard.php',
        data: $(form).serialize()
    }).done(e=>{
        console.log('ok', e)
    }).fail(e=>{
        console.log('fail') 
    })
}
function submitPayment(clicked) {
    // console.log('clicked')
    let form = $(clicked).parent()
    $.ajax({
        type: 'POST',
        url: './apis/api-charge-someone.php',
        data: $(form).serialize()
    }).done(e=>{
        console.log('ok', e)
    }).fail(e=>{
        console.log('fail') 
    })
}
function createFoodItem(clicked) {
    let form = $(clicked).parent()
    $.ajax({
        type: 'POST',
        url: './apis/api-create-food-item.php',
        data: $(form).serialize()
    }).done(e=>{
        console.log('ok', e)
    }).fail(e=>{
        console.log('fail') 
    })
}

function submitFoodItemUpdate(clicked) {
    let form = $(clicked).parent()
    $.ajax({
        type: 'POST',
        url: './apis/api-update-food-item.php',
        data: $(form).serialize()
    }).done(e=>{
        console.log('ok', e)
    }).fail(e=>{
        console.log('fail') 
    })
}
function deleteFoodItem(clicked) {
    let nFoodItemId = $(clicked).data('food-item-id')
    $.ajax({
        type: 'GET',
        url: './apis/api-delete-food-item.php?id='+nFoodItemId,
    }).done(e=>{
        console.log('ok')
    }).fail(e=>{
        console.log('fail') 
    })
}