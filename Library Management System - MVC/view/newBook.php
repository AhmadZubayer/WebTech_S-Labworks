<section id="new-book-section" class="form-section" style="display: none;">
    <div class="container-card">
        <h2>Add New Book</h2>
        <form id="add-book-form">
            <div class="form-group">
                <label for="title">Book Title:</label>
                <input type="text" id="title" name="title" required placeholder="Enter book title">
            </div>

            <div class="form-group">
                <label for="author">Author Name:</label>
                <input type="text" id="author" name="author" required placeholder="Enter author name">
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="Science">Science</option>
                    <option value="Fiction">Fiction</option>
                    <option value="History">History</option>
                    <option value="Technology">Technology</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="availability">Availability Status:</label>
                <select id="availability" name="availability" required>
                    <option value="Available">Available</option>
                    <option value="Not Available">Not Available</option>
                </select>
            </div>

            <button type="submit" class="submit-btn">Add Book</button>
            <div id="add-book-message" class="message"></div>
        </form>
    </div>
</section>
