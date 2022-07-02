// check if the element is on the page
if(document.getElementById('add_new_field')) {

    // get elements need
    const newFieldButton = document.getElementById('add_new_field');
    const newFieldContainer = document.getElementById('new_field');
    const numberOfField = document.getElementById('number_of_field');

    //function to create an input
    newFieldButton.addEventListener('click', () =>{

        // create new elements
        const newField = document.createElement('input');
        const newfieldLabel = document.createElement ("label");

        //add new class
        newField.classList.add('form-control');
        newField.classList.add('new_field');
        newField.classList.add('mb-3');

        // set attritube
        newField.setAttribute('required', 'required');
        newField.setAttribute('min', '0');
        newField.setAttribute('placeholder', '175');

        // define the type
        newField.type = 'number';

        // insert him into a div
        newfieldLabel.innerHTML = 'Size';
        newFieldContainer.appendChild(newfieldLabel);
        newFieldContainer.appendChild(newField);
        

        // get all fields create to rename them
        const newFields = document.getElementsByClassName('new_field');

        // counts the number of fields and attributes the result to the hidden fields 
        numberOfField.value = newFields.length;

        // do a loop and set a unique name and id to each field
        for (let i = 0; i < newFields.length; i++) {
            const newField = newFields[i];
            newField.setAttribute('name', 'new_field' + i)
            newField.setAttribute('id', 'new_field' + i);
            newfieldLabel.setAttribute('for', 'new_field' + i);
            
        }
    })
}