window.addEventListener('load',()=>{

    // identifier le formulaire
    const myForm = document.querySelector('#my-form')
    
    
    myForm.onsubmit = (e) => {
        e.preventDefault()
        // recup les données
        const nom = document.querySelector('#nom')
        const email = document.querySelector('#email')
        const message = document.querySelector('#message')
    
    
        // considèrer que c'est invalid
        var errorNom = true
        var errorEmail = true
        var errorMessage = true 
    
        // validation des données 
        if(nom.value == "")
        {
            nom.classList.add('is-invalid')
            errorNom = true
        }else{
            nom.classList.remove('is-invalid')
            errorNom = false
        }
    
        if(email.value == "")
        {
            email.classList.add('is-invalid')
            errorEmail = true
        }else{
            email.classList.remove('is-invalid')
            errorEmail = false
        }
    
        if(message.value == "")
        {
            message.classList.add('is-invalid')
            errorMessage = true
        }else{
            message.classList.remove('is-invalid')
            errorMessage = false
        }
    
        if(!errorNom && !errorEmail && !errorMessage)
        {
            myForm.submit()
        }
    
    }
})