document.addEventListener('DOMContentLoaded', function() {
    // Get the delete button element by its ID
    var deleteButton = document.getElementById('Delete_Article');

    // Check if the delete button exists before adding the event listener
    if (deleteButton) {
        // Add a click event listener to the delete button
        deleteButton.addEventListener('click', function(event) {
            // Show a confirmation dialog
            var confirmation = confirm('Are you sure you want to delete the article?');

            // If the user cancels the confirmation, prevent the default action of the button
            if (!confirmation) {
                event.preventDefault();
            }
            else {
                // Get the URL of the current page
                var currentURL = window.location.protocol + '//' + window.location.host + window.location.pathname;
                var params = new URLSearchParams(window.location.search);

                // Get the existing 'page' and 'id' parameters
                var pageParam = params.get('page');
                var idParam = params.get('id');

                // Rebuild the URL with existing 'page' and 'id' parameters
                if (pageParam !== null) {
                    currentURL += '?page=' + pageParam;
                }
                if (idParam !== null) {
                    currentURL += '&id=' + idParam;
                }

                // Add 'delete=true' to the URL
                currentURL += '&delete=true';
                event.preventDefault();

                // Perform the redirection
                alert('The article has been deleted');
                window.location.href = currentURL;
            }
        });
    }
});