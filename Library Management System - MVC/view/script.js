document.addEventListener('DOMContentLoaded', () => {
    const sections = {
        'new-book-section': document.getElementById('new-book-section'),
        'browse-section': document.getElementById('browse-section'),
        'update-book-section': document.getElementById('update-book-section')
    };

    const controllerPath = '../controller/bookController.php';

    fetchBooks();

    const navButtons = document.querySelectorAll('.nav-btn');
    navButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const targetId = btn.getAttribute('data-target');
            showSection(targetId);
            if (targetId === 'browse-section') fetchBooks();
        });
    });

    function showSection(targetId) {
        Object.values(sections).forEach(section => {
            if (section) section.style.display = 'none';
        });
        if (sections[targetId]) {
            sections[targetId].style.display = 'block';
        }
    }

    const addBookForm = document.getElementById('add-book-form');
    if (addBookForm) {
        addBookForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(addBookForm);
            formData.append('action', 'add');

            var xhttp = new XMLHttpRequest();
            xhttp.onload = function () {
                if (xhttp.status >= 200 && xhttp.status < 300) {
                    var data = JSON.parse(xhttp.responseText);
                    const messageDiv = document.getElementById('add-book-message');
                    messageDiv.textContent = data.message;
                    messageDiv.style.color = data.status === 'success' ? 'green' : 'red';

                    if (data.status === 'success') {
                        addBookForm.reset();
                        setTimeout(() => {
                            messageDiv.textContent = '';
                            showSection('browse-section');
                            fetchBooks();
                        }, 1500);
                    }
                }
            };
            xhttp.open('POST', controllerPath, true);
            xhttp.send(formData);
        });
    }

    function fetchBooks() {
        var xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            if (xhttp.status >= 200 && xhttp.status < 300) {
                var data = JSON.parse(xhttp.responseText);
                const list = document.getElementById('books-list');
                list.innerHTML = '';

                if (data.status === 'success' && data.data.length > 0) {
                    data.data.forEach(book => {
                        list.innerHTML += `
                            <tr>
                                <td>${book.id}</td>
                                <td>${book.title}</td>
                                <td>${book.author}</td>
                                <td>${book.category}</td>
                                <td>${book.availability}</td>
                                <td>
                                    <button class="action-btn edit-btn" onclick="editBook(${book.id})">Edit</button>
                                    <button class="action-btn delete-btn" onclick="deleteBook(${book.id})">Delete</button>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    list.innerHTML = '<tr><td colspan="6" style="text-align:center;">No books found.</td></tr>';
                }
            }
        };
        xhttp.open('GET', `${controllerPath}?action=fetch_all`, true);
        xhttp.send();
    }

    window.deleteBook = (id) => {
        if (confirm('Are you sure you want to delete this book?')) {
            const formData = new FormData();
            formData.append('action', 'delete');
            formData.append('id', id);

            var xhttp = new XMLHttpRequest();
            xhttp.onload = function () {
                if (xhttp.status >= 200 && xhttp.status < 300) {
                    var data = JSON.parse(xhttp.responseText);
                    if (data.status === 'success') {
                        fetchBooks();
                    } else {
                        alert(data.message);
                    }
                }
            };
            xhttp.open('POST', controllerPath, true);
            xhttp.send(formData);
        }
    };

    window.editBook = (id) => {
        var xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            if (xhttp.status >= 200 && xhttp.status < 300) {
                var data = JSON.parse(xhttp.responseText);
                if (data.status === 'success') {
                    const book = data.data;
                    document.getElementById('update-id').value           = book.id;
                    document.getElementById('update-title').value        = book.title;
                    document.getElementById('update-author').value       = book.author;
                    document.getElementById('update-category').value     = book.category;
                    document.getElementById('update-availability').value = book.availability;

                    showSection('update-book-section');
                }
            }
        };
        xhttp.open('GET', `${controllerPath}?action=fetch_single&id=${id}`, true);
        xhttp.send();
    };


    const updateBookForm = document.getElementById('update-book-form');
    if (updateBookForm) {
        updateBookForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(updateBookForm);
            formData.append('action', 'update');

            var xhttp = new XMLHttpRequest();
            xhttp.onload = function () {
                if (xhttp.status >= 200 && xhttp.status < 300) {
                    var data = JSON.parse(xhttp.responseText);
                    const messageDiv = document.getElementById('update-book-message');
                    messageDiv.textContent = data.message;
                    messageDiv.style.color = data.status === 'success' ? 'green' : 'red';

                    if (data.status === 'success') {
                        setTimeout(() => {
                            messageDiv.textContent = '';
                            showSection('browse-section');
                            fetchBooks();
                        }, 1500);
                    }
                }
            };
            xhttp.open('POST', controllerPath, true);
            xhttp.send(formData);
        });
    }

    const cancelUpdate = document.getElementById('cancel-update');
    if (cancelUpdate) {
        cancelUpdate.addEventListener('click', () => {
            showSection('browse-section');
        });
    }
});