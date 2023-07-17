(function () {
    const ponentesInput = document.querySelector('#ponentes');

    if (ponentesInput) {
        let ponentes = [];
        let ponentesFiltrados = [];
        const listado_ponentes = document.querySelector('#listado_ponentes');
        const ponenteHidden = document.querySelector('[name=ponente_id]')
        ponentesInput.addEventListener('input', buscarPonentes)
        obtenerPonentes();
        
        if (ponenteHidden.value){
            (async()=>{
                const ponente = await obtenerPonente(ponenteHidden.value);

                const ponenteDOM = document.createElement('LI');
                ponenteDOM.classList.add('listado-ponentes__ponente','listado-ponentes__ponente--seleccionado');
                ponenteDOM.textContent=`${ponente.nombre} ${ponente.apellido}`;
                listado_ponentes.appendChild(ponenteDOM);
            })()
        }
        
        async function obtenerPonente(id){
            const url = `/api/ponente?id=${id}`;
            const respuesta = await fetch (url);
            const resultado = await respuesta.json();
            return resultado;
        }

        async function obtenerPonentes() {
            const url = `/api/ponentes`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            formatearPonentes(resultado)
        }

        function formatearPonentes(arrayPonentes = []) {
            ponentes = arrayPonentes.map(ponente => {
                return {
                    nombre: `${ponente.nombre.trim()} ${ponente.apellido.trim()}`,
                    id: ponente.id
                }
            });
        }

        function buscarPonentes(e) {
            const busqueda = e.target.value;
            if (busqueda.length > 3) {
                const expresion = new RegExp(busqueda, "i");
                ponentesFiltrados = ponentes.filter(ponente => {
                    if (ponente.nombre.toLowerCase().search(expresion) != -1) {
                        return ponente
                    }
                })
              
            }else{
                ponentesFiltrados = []
            }
            mostarPonentes();
        }
        function mostarPonentes() {
            while (listado_ponentes.firstChild){
                listado_ponentes.removeChild(listado_ponentes.firstChild);
            }
            if(ponentesFiltrados.length > 0){
                ponentesFiltrados.forEach(ponente => {
                    const ponenteHTML = document.createElement('LI');
                    ponenteHTML.classList.add('listado-ponentes__ponente');
                    ponenteHTML.textContent = ponente.nombre;
                    ponenteHTML.dataset.ponenteId = ponente.id;
                    ponenteHTML.onclick = seleccionarPonente;
                    listado_ponentes.appendChild(ponenteHTML);
    
                });
            }else{
                const noResultado = document.createElement('P')
                noResultado.classList.add('listado-ponentes__no-resultado')
                noResultado.textContent = 'No ha resultado para tu busqueda';
                listado_ponentes.appendChild(noResultado);
            }
           
        }
        function seleccionarPonente (e){
            const ponente = e.target;
            const ponentePrevio = document.querySelector ('.listado-ponentes__ponente--seleccionado');
            if(ponentePrevio){
                ponentePrevio.classList.remove('listado-ponentes__ponente--seleccionado')
            }

            ponente.classList.add ('listado-ponentes__ponente--seleccionado')
            ponenteHidden.value = ponente.dataset.ponenteId; 
        }
    }

})();