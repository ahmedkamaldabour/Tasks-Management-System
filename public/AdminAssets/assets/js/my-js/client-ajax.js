const clientNameInput = document.querySelector('#client_name');
const clientSearchResults = document.querySelector('#client_search_results');
const form = document.querySelector('#task-form');
const clientPhoneInput = document.querySelector('#client_phone');
const clientIdInput = document.querySelector('#client_id');

clientNameInput.addEventListener('input', function () {
    const searchTerm = clientNameInput.value.trim();
    if (searchTerm !== '') {
        const searchUrl = `/client-search?search=${searchTerm}`;
        fetch(searchUrl)
            .then(response => response.json())
            .then(clients => {
                let resultsHTML = '';

                if (clients.length > 0) {
                    resultsHTML += `<select class="client-select form-control mt-3" onchange="selectClient(this.value)">`;
                    resultsHTML += `<option value="">Select From Existing Clients</option>`;

                    clients.forEach(client => {
                        resultsHTML += `<option value="${client.id}">${client.name}</option>`;
                    });

                    resultsHTML += `</select>`;
                } else {
                    resultsHTML += `<div>Create New Client: ${searchTerm}</div>`;
                }

                clientSearchResults.innerHTML = resultsHTML;
            })
            .catch(error => {
                console.error(error);
                clientSearchResults.innerHTML = '<div class="text-danger">An error occurred while searching for clients</div>';
            });
    } else {
        clientSearchResults.innerHTML = '';
    }
});

function selectClient(clientId) {
    const selectedOption = document.querySelector(`.client-select option[value="${clientId}"]`);
    const clientName = selectedOption ? selectedOption.textContent : '';

    clientIdInput.value = clientId;
    clientNameInput.value = clientName;
}
