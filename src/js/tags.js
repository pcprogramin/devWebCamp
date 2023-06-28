
(function(){
    const tagsInput = document.querySelector('#tags_input');
    const tagsDiv = document.querySelector('#tags');
    const tagsInputHidden = document.querySelector('[name="tags"]');
    let tags = [];

   
    if (tagsInput){
   
        if (tagsInputHidden.value !==''){
            tags= tagsInputHidden.value.split(',');
            console.log(tagsInputHidden.value.split(','));
            mostrarTags();
        }
        tagsInput.addEventListener('keypress', guardarTag)

        function guardarTag(e) {
            if(e.keyCode === 44){
                e.preventDefault();
                tags= [...tags,e.target.value.trim()]
                tagsInput.value = '';

                mostrarTags();
            }
        }
        function mostrarTags(){
            tagsDiv.textContent = '';
            tags.forEach(tag=>{
                const etiqueta = document.createElement('LI');
                etiqueta.classList.add ('formulario__tag');
                etiqueta.textContent=  tag;
                etiqueta.ondblclick = eliminarTag;
                tagsDiv.appendChild(etiqueta);
            });
            actualizarInputHidden();
        }
    }
    function actualizarInputHidden (){
        tagsInputHidden.value= tags.toString();
    }
   function eliminarTag(e){
     e.target.remove()
     tags=tags.filter(tag=> tag !== e.target.textContent);
     actualizarInputHidden()

   }
})();