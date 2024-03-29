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

function createRecipe(clicked) {
    let form = $(clicked).parent()
    $.ajax({
        type: 'POST',
        url: './apis/api-create-recipe.php',
        data: $(form).serialize()
    }).done(e=>{
        console.log('ok', e)
    }).fail(e=>{
        console.log('fail')
    })
}

function updateRecipe(clicked) {
    const form = $(clicked).parent()
    $.ajax({
        type: 'POST',
        url: './apis/api-update-recipe.php',
        data: $(form).serialize()
    }).done(e=>{
        // console.log('ok', e)
        const container = document.querySelector('.recipe')
        const message = `<a href="index.php">success! go back</a>`
        $(container).append(message)
    }).fail(e=>{
        console.log('fail')
    })

}

function updateRecipeItem(clicked) {
    let form = $(clicked).parent()
    $.ajax({
        type: 'POST',
        url: './apis/api-update-recipe-item.php',
        data: $(form).serialize()
    }).done(e=>{
        console.log('ok', e) 
        const container = document.querySelector('.recipeitem')
        const message = `<a href="index.php">success! go back</a>`
        $(container).append(message)
    }).fail(e=>{
        console.log('fail') 
    })
}

function addIngredientToRecipe(clicked) {
    const form = $(clicked).parent()
    $.ajax({
        type: 'POST',
        url: './apis/api-add-recipe-ingredient.php',
        data: $(form).serialize()
    }).done(e=>{
        console.log('ok', e)
    }).fail(e=>{
        console.log('fail')
    })
}

function searchUsers(clicked){
    let form = clicked.parentElement.parentElement;
    let userName = document.querySelector('#txtFirstNameSearch').value;
    let firstUserRegDate = document.querySelector('#firstDateRegistred').value;
    let seondUserRegDate = document.querySelector('#secondDateRegistred').value;

       $.ajax({
           type: 'GET',
           url: `./apis/api-search-user.php?name=${userName}&firstdate=${firstUserRegDate}&seconddate=${seondUserRegDate}`,
           data: $(form).serialize()
       }).done(e=>{

           // Remove existing results
           let existingResult = document.querySelectorAll('.result');

           existingResult.forEach( (element) => {
               element.remove();
           })

           // Parse e as JSON
           let users = JSON.parse(e);

           console.log(users);
       

           // Loop through each result and output in table
           for(let user of users){
       
               let tr = document.createElement('tr');
               tr.classList.add('result');

               tr.innerHTML = `<td>${user.cName}</td>
                               <td>${user.cSurname}</td>
                               <td>${user.cEmail}</td>
                               <td>${user.cAddress}</td>
                               <td>${user.cPhoneNo}</td>
                               <td>${user.dRegistration}</td>
                                                       `;

           // Append to #searchResults
               document.querySelector('#searchResults').appendChild(tr);

       }


       }).fail(e=>{
           console.log('fail') 
       })
}

function searchRecipesByPantryId(clicked) {
    const iPantryId = $(document.querySelector('#intPantryId')).val() 
    $.ajax({
        url: `./apis/api-search-recipes-by-pantry-id.php?id=${iPantryId}`,
        type: 'GET'
    }).done(e=>{
        // console.log(e);

        const existing = document.querySelectorAll('.recipe-result')
        existing.forEach(elm=>{
            $(elm).remove()
        })
        let recipes = JSON.parse(e);
        for(let recipe of recipes) {
            let tr = document.createElement('tr')
            $(tr).addClass('recipe-result')
            $(tr).html(
                `<td>${recipe.cTitle}</td>
                <td>${recipe.cDescription}</td>
                <td><a href="single-recipe.php?id=${recipe.nRecipeId}">Read full</a></td>`
                )
                $(document.getElementById('recipesSearchResult')).append(tr)
        }


    }).fail(e=>{
        console.log('fail')
    })
}

function createPantry(clicked) {
    let form = $(clicked).parent()
    $.ajax({
        type: 'POST',
        url: './apis/api-create-pantry.php',
        data: $(form).serialize()
    }).done(e=>{
        console.log(e)
    }).fail(e=>{
        console.log('fail')
    })
}

function addFoodItemToPantry(clicked) {
    let form = $(clicked).parent()
    $.ajax({
        type: 'POST',
        url: './apis/api-add-pantry-food-item.php',
        data: $(form).serialize()
    }).done(e=>{
        console.log(e)
    }).fail(e=>{
        console.log('fail')
    })
}

function updatePantryItem(clicked) {
    let form = $(clicked).parent()
    $.ajax({
        type: 'POST',
        url: './apis/api-update-pantry-item.php',
        data: $(form).serialize()
    }).done(e=>{
        // console.log('ok', e) 
        const container = document.querySelector('.pantryitem')
        const message = `<a href="index.php">success! go back</a>`
        $(container).append(message)
    }).fail(e=>{
        console.log('fail') 
    })
}