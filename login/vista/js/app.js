Swal.fire({
    title: 'Codigo de Ingreso',
    input: 'text',
    inputAttributes: {
      autocapitalize: 'off'
    },
    showCancelButton: false,
    confirmButtonText: 'Ingresar',
    showLoaderOnConfirm: true,
    preConfirm: (login) => {
        
        let url = 'fetch/login.fetch.php'

        let data = new FormData()
        data.append('login',login)

      return fetch(url,{
          method: 'post',
          body:data
      })
        .then(response => {

          if (!response.ok) {
            throw new Error(response.statusText)
          }

          return response.json()
          
        })
        .then(resp => {
          
          if(resp){
            
            document.cookie = "login" + resp.url + "=true; expires=Thu, 31 Dec 2025 23:59:59 UTC; path=/";
          

            let urlRedirect = `../../../index.php?ruta=inicio`
            
            if(resp.url == 'gestionfeedlot')
              urlRedirect = `../../../${resp.url}/index.php`

            if(resp.url == 'caseQuality')
              urlRedirect = `../../../${resp.url}/`
 
            window.location = urlRedirect

          }else{

            Swal.fire({
              icon: 'error',
              title: 'El codigo no es valido',
            })
            .then(resp=>{
              
              if(resp.value || resp.dismiss == 'backdrop'){

                window.location = 'index.php'
                
              }
            
            })

          }

        })

        .catch(error => Swal.showValidationMessage(error))
    },
    allowOutsideClick:false, 
    allowEscapeKey:false,
  }).then((result) => {

    
  })

